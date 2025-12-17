@extends('layouts.loggedin-layout')

@section('title', 'Identify Verification')

@section('content')
<div class="flex flex-col lg:flex-row gap-16">
    {{-- SETTINGS SIDEBAR --}}
    @include('settings._sidebar', ['active' => 'identity'])

    {{-- MAIN CONTENT --}}
    <div class="flex-1">
        <h2 class="text-xl font-bold text-slate-900 mb-6">Identify Verification</h2>

        <!-- Verify Card -->
        <div class="border border-slate-200 rounded-xl p-8 bg-white shadow-sm">

            <div class="flex justify-between items-start mb-8">
                <h3 class="font-bold text-slate-900 text-lg">Verify you identity</h3>
                <button
                    class="px-6 py-2 bg-primary text-white text-xs font-bold rounded-lg hover:bg-primary/90 transition-colors shadow-lg shadow-primary/25">
                    Get Started
                </button>
            </div>

            <div class="space-y-8">
                <!-- Step 1 -->
                <div>
                    <p class="text-sm font-bold text-slate-900 mb-1">1. ID document verification</p>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Upload an official government ID to verify your profile information. Your ID will never be
                        shared with clients.
                        <a href="#" class="text-primary hover:underline font-medium">Learn more.</a>
                    </p>
                </div>

                <!-- Step 2 -->
                <div>
                    <p class="text-sm font-bold text-slate-900 mb-1">2. Location verification</p>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        We'll make sure your profile location matches whats on your ID. In case it doesnt, we'll ask
                        you for some extra documents.
                    </p>
                </div>

                <!-- Step 3 -->
                <div>
                    <p class="text-sm font-bold text-slate-900 mb-1">3. Visual verification</p>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Take a selfie with your camera which matches the picture on your ID.
                        <a href="#" class="text-primary hover:underline font-medium">Learn more.</a>
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
