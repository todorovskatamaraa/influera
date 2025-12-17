<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use App\Services\DnaMatchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    public function create(Job $job)
    {
        $user        = Auth::user();
        $matchScore  = null;

        if ($user && $user->role === 'influencer') {
            $matchScore = DnaMatchService::calculateInfluencerToJobScore($user, $job);
        }

        return view('job-apply', [
            'job'        => $job,
            'matchScore' => $matchScore,
        ]);
    }

    public function store(Request $request, Job $job)
    {
        $user = $request->user();

        if ($job->appliedByUser($user->id)) {
            return redirect()
                ->route('jobs.show', $job)
                ->with('error', 'You have already applied for this campaign.');
        }

        $validated = $request->validate([
            'payment_type' => ['required', 'in:wire,paypal,payoneer,cash,escrow'],
        ]);

        JobApplication::create([
            'job_id'       => $job->id,
            'user_id'      => $user->id,
            'payment_type' => $validated['payment_type'],
            'status'       => 'pending',
        ]);

        return redirect()
            ->route('jobs.show', $job)
            ->with('success', 'You successfully applied for this campaign.');
    }
}
