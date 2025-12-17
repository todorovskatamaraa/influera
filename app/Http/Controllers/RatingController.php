<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, Job $job)
    {
        $user = $request->user();

        $validated = $request->validate([
            'to_user_id' => 'required|exists:users,id',
            'score'      => 'required|integer|min:1|max:5',
            'comment'    => 'nullable|string|max:1000',
        ]);

        if ((int) $validated['to_user_id'] === $user->id) {
            abort(403);
        }

        Rating::updateOrCreate(
            [
                'from_user_id' => $user->id,
                'to_user_id'   => $validated['to_user_id'],
                'job_id'       => $job->id,
            ],
            [
                'score'   => $validated['score'],
                'comment' => $validated['comment'] ?? null,
            ]
        );

        return back()->with('success', 'Your rating has been saved.');
    }

    public function destroy(Request $request, Job $job)
    {
        $user = $request->user();

        Rating::where('from_user_id', $user->id)
            ->where('job_id', $job->id)
            ->delete();

        return back()->with('success', 'Your rating has been removed.');
    }
}
