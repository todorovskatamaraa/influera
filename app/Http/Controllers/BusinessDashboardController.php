<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use App\Models\InfluencerProfile;
use App\Services\DnaMatchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessDashboardController extends Controller
{
    public function index(Request $request)
    {
        $brand = Auth::user();

        if (!$brand) {
            abort(401, 'Unauthorized');
        }

        // === JOBS ===
        $jobs = Job::where('user_id', $brand->id)
            ->withCount('applications')
            ->orderByDesc('created_at')
            ->get();

        // === APPLICATIONS ===
        $applications = JobApplication::with([
                'user.influencerProfile.socialAccounts',
                'job',
            ])
            ->whereHas('job', function ($q) use ($brand) {
                $q->where('user_id', $brand->id);
            })
            ->latest()
            ->get();

        $openJobsCount     = $jobs->where('status', '!=', 'completed')->count();
        $applicationsCount = $applications->count();

        // === DNA SCORE ===
        $dnaScore    = null;
        $dnaCoverage = null;

        $brandProfile = $brand->brandProfile;

        if ($brandProfile) {
            $influencers = InfluencerProfile::all();
            $scores      = [];

            foreach ($influencers as $influencer) {
                $scores[] = DnaMatchService::calculateBrandToInfluencerScore(
                    $brandProfile,
                    $influencer
                );
            }

            if (!empty($scores)) {
                $dnaScore = (int) round(array_sum($scores) / count($scores));

                $strong      = array_filter($scores, fn ($s) => $s >= 80);
                $dnaCoverage = (int) round(count($strong) / count($scores) * 100);
            }
        }

        return view('business-dashboard', compact(
            'jobs',
            'applications',
            'openJobsCount',
            'applicationsCount',
            'dnaScore',
            'dnaCoverage',
        ));
    }

    public function acceptApplication(JobApplication $application)
    {
        $brand = Auth::user();

        if (!$brand || $application->job->user_id !== $brand->id) {
            abort(403);
        }

        $application->status = 'accepted';
        $application->save();

        return back()->with('status', 'Application accepted.');
    }

    public function declineApplication(JobApplication $application)
    {
        $brand = Auth::user();

        if (!$brand || $application->job->user_id !== $brand->id) {
            abort(403);
        }

        $application->status = 'declined';
        $application->save();

        return back()->with('status', 'Application declined.');
    }

    public function markComplete(Job $job)
    {
        $brandId = Auth::id();

        if (!$brandId || $job->user_id !== $brandId) {
            abort(403);
        }

        $job->status = 'completed';
        $job->save();

        $job->applications()->update(['status' => 'completed']);

        return redirect()
            ->route('business-dashboard')
            ->with('success', 'Campaign marked as completed.');
    }
}
