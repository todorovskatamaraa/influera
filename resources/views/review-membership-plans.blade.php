@extends('layouts.loggedin-layout')

@section('title', 'Review Membership Change')

@section('content')
@php
    $plans = [
        'mini' => ['name'=>'Mini','price'=>5,'period'=>'/monthly'],
        'standard' => ['name'=>'Standard','price'=>15,'period'=>'/monthly'],
        'max' => ['name'=>'Max','price'=>25,'period'=>'/monthly'],
    ];

    $currentKey = ($currentPlanKey ?? request('current')) ?? (auth()->user()->membership_plan ?? 'standard');
    if (!isset($plans[$currentKey])) {
        $currentKey = 'standard';
    }

    $newKey = $newPlanKey ?? request('new', request('plan', $currentKey));
    if (!isset($plans[$newKey])) {
        $newKey = $currentKey;
    }

    $currentPlan = $plans[$currentKey];
    $newPlan = $plans[$newKey];
@endphp

<main class="w-full">
    <div class="flex flex-col lg:flex-row gap-16">

        <div class="flex-1 flex items-start justify-center">
            <div class="w-full max-w-3xl border border-slate-200 rounded-xl p-10 bg-white shadow-sm">
                <h1 class="text-xl font-bold text-slate-900 mb-8">Review Membership Change</h1>

                <form method="POST" action="{{ route('membership.switch') }}">
                    @csrf

                    <input type="hidden" name="new_plan" value="{{ $newKey }}">

                    <div class="space-y-10">

                        {{-- Plan Display --}}
                        <div>
                            <h2 class="text-sm font-bold text-slate-900 mb-4">Membership Plan</h2>

                            <div class="grid grid-cols-2 gap-12">
                                <div>
                                    <p class="text-xs text-slate-500 mb-1">Current Plan</p>
                                    <p class="text-sm text-slate-900 font-medium">{{ $currentPlan['name'] }}</p>
                                    <p class="text-sm text-slate-900">€{{ $currentPlan['price'] }} {{ $currentPlan['period'] }}</p>
                                </div>

                                <div>
                                    <p class="text-xs text-slate-500 mb-1">New Plan</p>
                                    <p class="text-sm text-slate-900 font-medium">{{ $newPlan['name'] }}</p>
                                    <p class="text-sm text-slate-900">€{{ $newPlan['price'] }} {{ $newPlan['period'] }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Reason --}}
                        <div>
                            <h2 class="text-sm font-bold text-slate-900 mb-6">Why are you switching?</h2>

                            <div class="space-y-4">
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="radio" name="reason" value="more_applications" class="custom-radio">
                                    <span class="text-sm text-slate-700 group-hover:text-slate-900">I need more job applications/messages</span>
                                </label>

                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="radio" name="reason" value="not_enough_value" class="custom-radio">
                                    <span class="text-sm text-slate-700 group-hover:text-slate-900">I’m not getting enough value from my current plan</span>
                                </label>

                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="radio" name="reason" value="premium_features" class="custom-radio">
                                    <span class="text-sm text-slate-700 group-hover:text-slate-900">I want access to premium features and tools</span>
                                </label>

                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="radio" name="reason" value="testing_plans" class="custom-radio">
                                    <span class="text-sm text-slate-700 group-hover:text-slate-900">I’m testing different plans to see what fits best</span>
                                </label>

                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="radio" name="reason" value="other" class="custom-radio">
                                    <span class="text-sm text-slate-700 group-hover:text-slate-900">Other</span>
                                </label>
                            </div>

                            @error('reason')
                                <p class="mt-2 text-xs text-red-500 mt-4">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end items-center gap-6 pt-4">
                            <a href="{{ route('settings.memberships') }}" class="text-xs font-bold text-primary">Cancel</a>
                            <button type="submit" class="px-8 py-2.5 bg-primary text-white text-xs font-bold rounded-lg shadow-lg hover:bg-primary/90">
                                Switch
                            </button>
                        </div>

                    </div>
                </form>

            </div>
        </div>

    </div>
</main>

<style>
    .custom-radio {
        appearance: none;
        width: 1.25em;
        height: 1.25em;
        border-radius: 50%;
        border: 1px solid hsl(262 83% 58%);
        display: grid;
        place-content: center;
        cursor: pointer;
    }

    .custom-radio::before {
        content: "";
        width: 0.65em;
        height: 0.65em;
        border-radius: 50%;
        transform: scale(0);
        transition: 120ms;
        box-shadow: inset 1em 1em hsl(262 83% 58%);
    }

    .custom-radio:checked::before {
        transform: scale(1);
    }
</style>
@endsection
