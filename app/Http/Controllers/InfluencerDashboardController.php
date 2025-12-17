<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\BrandProfile;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Services\DnaMatchService;

class InfluencerDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $allApplications = JobApplication::with('job')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $activeApplications = $allApplications
            ->where('status', 'accepted')
            ->filter(function ($application) {
                return optional($application->job)->status !== 'completed';
            });

        $myApplications = $allApplications->whereIn('status', ['pending', 'declined', 'completed']);

        $appliedCount    = $allApplications->count();
        $activeJobsCount = $activeApplications->count();
        $successfulCount = $allApplications->whereIn('status', ['accepted', 'completed'])->count();

        $successRate = $appliedCount > 0
            ? round(($successfulCount / $appliedCount) * 100)
            : 0;

        $profile      = $user->influencerProfile;
        $dnaScore     = 0;
        $brandMatches = collect();

        if ($profile) {
            $dnaScore = $profile->calculateDnaScore();

            $brands = BrandProfile::with('user')->get();

            $brandMatches = $brands->map(function (BrandProfile $brand) use ($profile) {

                $detail = DnaMatchService::calculateBrandToInfluencerBreakdown(
                    $brand,
                    $profile
                );

                $brand->match_score     = $detail['total'] ?? 0;
                $brand->match_breakdown = $detail;

                return $brand;
            })->sortByDesc('match_score')->values();
        }

        $jobs = Job::with('user.brandProfile')->latest()->get();

        $matchedJobs = $jobs
            ->map(function (Job $job) use ($user) {
                $job->match_score = DnaMatchService::calculateInfluencerToJobScore($user, $job);
                return $job;
            })
            ->sortByDesc('match_score')
            ->take(3);

        return view('influencer-dashboard', [
            'applications'      => $myApplications,
            'activeJobs'        => $activeApplications,
            'appliedCount'      => $appliedCount,
            'activeJobsCount'   => $activeJobsCount,
            'successRate'       => $successRate,
            'dnaScore'          => $dnaScore,
            'matchedJobs'       => $matchedJobs,
            'brandMatches'      => $brandMatches,
        ]);
    }

    public function destroyApplication(Request $request, JobApplication $application)
    {
        $user = $request->user();

        if ($application->user_id !== $user->id) {
            abort(403);
        }

        if (! in_array($application->status, ['pending', 'declined'])) {
            return back()->with('error', 'Only pending or declined applications can be removed.');
        }

        $application->delete();

        return back()->with('success', 'Application removed.');
    }
}
