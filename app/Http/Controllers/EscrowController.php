<?php

namespace App\Http\Controllers;

use App\Models\Escrow;
use App\Models\Job;
use Illuminate\Http\Request;

class EscrowController extends Controller
{
    public function fund(Request $request, Job $job)
    {
        $user = $request->user();

        if ($user->role !== 'brand' || $job->user_id !== $user->id) {
            abort(403);
        }

        $data = $request->validate([
            'influencer_id' => ['required', 'exists:users,id'],
            'amount'        => ['nullable', 'integer', 'min:0'],
        ]);

        $hasAccepted = $job->applications()
            ->where('user_id', $data['influencer_id'])
            ->where('status', 'accepted')
            ->exists();

        if (! $hasAccepted) {
            return back()->with('error', 'You can fund escrow only for accepted creators.');
        }

        $escrow = Escrow::updateOrCreate(
            [
                'job_id'        => $job->id,
                'influencer_id' => $data['influencer_id'],
            ],
            [
                'brand_id'   => $user->id,
                'amount'     => $data['amount'] ?? null,
                'currency'   => 'EUR',
                'status'     => 'funded',
                'funded_at'  => now(),
            ]
        );

        return back()->with('success', 'Escrow funded for this creator.');
    }

    public function release(Request $request, Escrow $escrow)
    {

        $user = $request->user();

        if ($user->role !== 'brand' || $escrow->brand_id !== $user->id) {
            abort(403);
        }

        if ($escrow->status !== 'funded') {
            return back()->with('error', 'Escrow is not funded.');
        }

        $escrow->update([
            'status'      => 'released',
            'released_at' => now(),
        ]);

        return back()->with('success', 'Escrow released (payment simulated).');
    }

    public function cancel(Request $request, Escrow $escrow)
    {
        $user = $request->user();

        if ($user->role !== 'brand' || $escrow->brand_id !== $user->id) {
            abort(403);
        }

        if ($escrow->status === 'released') {
            return back()->with('error', 'Released escrow cannot be cancelled.');
        }

        $escrow->update([
            'status'      => 'cancelled',
            'released_at' => null,
        ]);

        return back()->with('success', 'Escrow cancelled.');
    }
}
