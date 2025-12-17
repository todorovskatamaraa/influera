@extends('layouts.loggedin-layout')

@section('title', 'Memberships & Connect')

@section('content')

@php
    $plans = [
        'mini'     => ['name'=>'Mini',     'price'=>5],
        'standard' => ['name'=>'Standard', 'price'=>15],
        'max'      => ['name'=>'Max',      'price'=>25],
    ];

    $planKey = $currentPlan ?? auth()->user()->membership_plan ?? 'standard';
    $plan    = $plans[$planKey];

    $start = auth()->user()->billing_cycle_start
        ? \Carbon\Carbon::parse(auth()->user()->billing_cycle_start)
        : now();

    $end = $start->copy()->addDays(30);

    $formattedStart = $start->format('M d, Y');
    $formattedEnd   = $end->format('M d, Y');
@endphp

<div class="flex flex-col lg:flex-row gap-16">

    {{-- SETTINGS SIDEBAR --}}
    @include('settings._sidebar', ['active' => 'memberships'])

    {{-- MAIN CONTENT --}}
    <div class="flex-1">
        <h2 class="text-xl font-bold text-slate-900 mb-6">Memberships & Connect</h2>

        {{-- Membership Switched Alert --}}
        @if(session('membership_switched'))
            <div class="mb-4">
                <div
                    class="flex items-center justify-between w-full rounded-lg border border-emerald-500 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                    <div class="flex items-center gap-2">
                        <div class="w-5 h-5 rounded-full bg-emerald-500 flex items-center justify-center text-white">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <span>Your membership plan has been updated.</span>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        <!-- Summary Card -->
        <div class="border border-slate-200 rounded-xl p-8 bg-white shadow-sm">
            <h3 class="font-bold text-slate-900 mb-6">Summary</h3>

            <div class="space-y-8">
                <!-- Current Plan -->
                <div>
                    <p class="text-xs font-bold text-slate-900 mb-1">Current Plan</p>
                    <p class="text-sm text-slate-600 mb-3">{{ $plan['name'] }}</p>
                    <div class="flex items-center gap-4">
                        <button
                            class="px-4 py-2 border border-primary text-primary text-xs font-medium rounded
                                   hover:bg-primary/5 transition-colors"
                            onclick="location.href='{{ route('membership-plans') }}'">
                            View or Edit Membership Plan
                        </button>
                        <a href="#" class="text-xs text-primary hover:underline">
                            Have a promo code?
                        </a>
                    </div>
                </div>

                <!-- Available Connect Credits -->
                <div>
                    <p class="text-xs font-bold text-slate-900 mb-1">Available Connect Credits</p>
                    <p class="text-sm text-slate-600 mb-3">
                        75 (used to apply or invite for collaborations)
                    </p>
                    <div class="flex items-center gap-4">
                        <button
                            class="px-4 py-2 bg-primary text-white text-xs font-bold rounded
                                   hover:bg-primary/90 transition-colors shadow-lg shadow-primary/25">
                            Buy Credits
                        </button>
                        <a href="#" class="text-xs text-primary hover:underline">
                            View Credits History
                        </a>
                    </div>
                </div>

                <!-- Monthly Credits -->
                <div>
                    <p class="text-xs font-bold text-slate-900 mb-1">Monthly Credits</p>
                    <p class="text-sm text-slate-600">
                        @if($planKey === 'mini') 5
                        @elseif($planKey === 'standard') 20
                        @else 50
                        @endif per month
                    </p>
                </div>

                <!-- Membership Fee -->
                <div>
                    <p class="text-xs font-bold text-slate-900 mb-1">Membership Fee</p>
                    <p class="text-sm text-slate-600">€{{ $plan['price'] }} /monthly</p>
                </div>

                <!-- Billing Cycle -->
                <div>
                    <p class="text-xs font-bold text-slate-900 mb-1">Current Billing Cycle</p>
                    <p class="text-sm text-slate-600 mb-2">
                        {{ $formattedStart }} - {{ $formattedEnd }}
                    </p>
                    <a href="#" class="text-xs text-primary hover:underline">Learn more</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
