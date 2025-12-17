@extends('layouts.loggedin-layout')

@section('title', 'Membership Plans')

@section('content')
@php
    $current = $currentPlan ?? (auth()->user()->membership_plan ?? 'standard');
@endphp

<main class="container mx-auto px-6 md:px-12 lg:px-24 py-16 min-h-screen flex flex-col items-center">
    <h1 class="text-2xl font-bold text-slate-900 mb-16">Memberships Plans</h1>

    <div class="flex flex-col lg:flex-row items-center justify-center gap-8 w-full max-w-5xl">

        {{-- MINI PLAN --}}
        <div class="card-gradient rounded-2xl p-8 w-full max-w-sm h-[400px] flex flex-col items-center justify-center shadow-lg border border-purple-50">
            <h2 class="text-xl font-bold text-slate-900 mb-2">Mini</h2>

            <div class="flex items-baseline gap-1 mb-8">
                <span class="text-2xl font-bold text-slate-900">€5</span>
                <span class="text-sm text-slate-500">/monthly</span>
            </div>

            <div class="text-center space-y-2 mb-8">
                <p class="text-sm text-slate-600">5 job applications /</p>
                <p class="text-sm text-slate-600">messages</p>
            </div>

            @if($current === 'mini')
                <p class="text-xs text-slate-500 mt-4">This is your current plan.</p>
            @else
                <a href="{{ route('review.membership-plans', ['plan' => 'mini']) }}"
                   class="bg-[#0f172a] text-white text-xs font-bold py-3 px-12 rounded-lg hover:bg-slate-800 transition-all w-40 text-center">
                    Switch
                </a>
            @endif
        </div>


        {{-- STANDARD PLAN --}}
        <div class="bg-primary rounded-2xl p-8 w-full max-w-sm h-[480px] flex flex-col items-center justify-center shadow-xl scale-105">
            <h2 class="text-2xl font-bold text-white mb-2">Standard</h2>

            <div class="flex items-baseline gap-1 mb-8">
                <span class="text-3xl font-bold text-white">€15</span>
                <span class="text-base text-white/80">/monthly</span>
            </div>

            <div class="mb-4"></div>

            <div class="text-center space-y-2 mb-8">
                <p class="text-base text-white">20 job applications /</p>
                <p class="text-base text-white">messages</p>
            </div>

            <p class="text-base text-white italic font-medium">AI Tips</p>

            @if($current === 'standard')
                <p class="mt-6 text-xs text-white/80">This is your current plan.</p>
            @else
                <a href="{{ route('review.membership-plans', ['plan' => 'standard']) }}"
                   class="mt-6 bg-[#0f172a] text-white text-xs font-bold py-3 px-12 rounded-lg hover:bg-slate-800 transition-all w-40 text-center">
                    Switch
                </a>
            @endif
        </div>


        {{-- MAX PLAN --}}
        <div class="card-gradient rounded-2xl p-8 w-full max-w-sm h-[400px] flex flex-col items-center justify-center shadow-lg border border-purple-50">
            <h2 class="text-xl font-bold text-slate-900 mb-2">Max</h2>

            <div class="flex items-baseline gap-1 mb-8">
                <span class="text-2xl font-bold text-slate-900">€25</span>
                <span class="text-sm text-slate-500">/monthly</span>
            </div>

            <div class="text-center space-y-4 mb-8">
                <p class="text-sm text-slate-600">50 job applications / messages</p>
                <p class="text-sm text-slate-600 italic font-medium">Pro features</p>
                <p class="text-sm text-slate-600 font-medium">Boost</p>
            </div>

            @if($current === 'max')
                <p class="text-xs text-slate-500 mt-4">This is your current plan.</p>
            @else
                <a href="{{ route('review.membership-plans', ['plan' => 'max']) }}"
                   class="bg-[#0f172a] text-white text-xs font-bold py-3 px-12 rounded-lg hover:bg-slate-800 transition-all w-40 text-center">
                    Switch
                </a>
            @endif
        </div>

    </div>
</main>

<style>
    .card-gradient {
        background: linear-gradient(180deg, #FFFFFF 0%, #F3F0FF 100%);
    }
</style>
@endsection
