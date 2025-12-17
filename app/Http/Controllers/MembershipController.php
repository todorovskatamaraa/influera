<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MembershipController extends Controller
{
    
    private const PLANS = ['mini', 'standard', 'max'];

    public function index(Request $request)
    {
        $currentPlan = $request->user()->membership_plan ?? 'standard';

        return view('settings.memberships', compact('currentPlan'));
    }

    public function plans(Request $request)
    {
        $currentPlan = $request->user()->membership_plan ?? 'standard';

        return view('membership-plans', compact('currentPlan'));
    }

    public function review(Request $request)
    {
        $currentPlan   = $request->user()->membership_plan ?? 'standard';
        $requestedPlan = $request->query('plan', $currentPlan);
        $newPlan       = in_array($requestedPlan, self::PLANS, true)
            ? $requestedPlan
            : $currentPlan;

        return view('review-membership-plans', [
            'currentPlanKey' => $currentPlan,
            'newPlanKey'     => $newPlan,
        ]);
    }

    public function switch(Request $request)
    {
        $validated = $request->validate([
            'new_plan' => ['required', Rule::in(self::PLANS)],
            'reason'   => ['required', 'string', 'max:255'],
        ], [
            'reason.required' => 'This field is required.',
        ]);

        $user = $request->user();

        $user->forceFill([
            'membership_plan'      => $validated['new_plan'],
            'billing_cycle_start'  => now(),
        ])->save();

        return redirect()
            ->route('settings.memberships')
            ->with('membership_switched', true);
    }
}
