<?php

namespace App\Http\Controllers;

use App\Models\Deliverable;
use App\Models\Job;
use Illuminate\Http\Request;

class DeliverableController extends Controller
{
    public function store(Request $request, Job $job)
    {
        $user = $request->user();

        if ($user->role !== 'influencer') {
            abort(403);
        }

        $hasAccepted = $job->applications()
            ->where('user_id', $user->id)
            ->where('status', 'accepted')
            ->exists();

        if (! $hasAccepted) {
            abort(403);
        }

        $data = $request->validate([
            'title'       => ['nullable', 'string', 'max:255'],
            'content_url' => ['required', 'string', 'max:2048'],
            'notes'       => ['nullable', 'string'],
        ]);

        $data['job_id']       = $job->id;
        $data['user_id']      = $user->id;
        $data['status']       = 'submitted';
        $data['submitted_at'] = now();

        Deliverable::create($data);

        return back()->with('success', 'Deliverable submitted to the brand.');
    }

    public function approve(Request $request, Deliverable $deliverable)
    {
        $user = $request->user();

        if ($user->role !== 'brand' || $deliverable->job->user_id !== $user->id) {
            abort(403);
        }

        $deliverable->update([
            'status'      => 'approved',
            'approved_at' => now(),
            'rejected_reason' => null,
        ]);

        return back()->with('success', 'Deliverable approved.');
    }

    public function reject(Request $request, Deliverable $deliverable)
    {
        $user = $request->user();

        if ($user->role !== 'brand' || $deliverable->job->user_id !== $user->id) {
            abort(403);
        }

        $data = $request->validate([
            'rejected_reason' => ['required', 'string', 'max:2000'],
        ]);

        $deliverable->update([
            'status'          => 'rejected',
            'approved_at'     => null,
            'rejected_reason' => $data['rejected_reason'],
        ]);

        return back()->with('success', 'Deliverable rejected with feedback.');
    }
}
