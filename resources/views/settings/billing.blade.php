@extends('layouts.loggedin-layout')

@section('title', 'Billing & Payments')

@section('content')

<div class="flex flex-col lg:flex-row gap-16">

    {{-- SETTINGS SIDEBAR --}}
    @include('settings._sidebar', ['active' => 'billing'])

    {{-- MAIN CONTENT --}}
    <div class="flex-1">

        <h2 class="text-xl font-bold text-slate-900 mb-6">Billing & Payments</h2>

        <!-- Billing Methods Card -->
        <div class="border border-slate-200 rounded-xl p-8 bg-white shadow-sm">

            <div class="flex justify-between items-start mb-8">
                <div>
                    <h3 class="font-bold text-slate-900 mb-1">Manage billing methods</h3>
                    <p class="text-xs text-slate-500">Add, update or remove your billing methods.</p>
                </div>
                <button
                    class="bg-primary text-white text-xs font-bold px-6 py-3 rounded-lg
                           hover:bg-primary/90 transition-all shadow-lg shadow-primary/20">
                    Add a new billing method
                </button>
            </div>

            <div class="mb-8">
                <h4 class="font-bold text-slate-900 mb-1">Primary</h4>
                <p class="text-[10px] text-slate-500 mb-6">
                    Your primary billing method is used for all recruiting payments.
                </p>

                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-4">

                        <!-- Mastercard Logo -->
                        <div class="w-10 h-6 relative">
                            <div class="absolute left-0 top-0 w-6 h-6 bg-[#EB001B] rounded-full opacity-80"></div>
                            <div class="absolute left-3 top-0 w-6 h-6 bg-[#F79E1B] rounded-full opacity-80"></div>
                        </div>

                        <span class="text-sm font-medium text-slate-700">Master card ending in ***</span>
                    </div>

                    <div class="flex items-center gap-4 text-xs font-medium">
                        <button class="text-primary hover:text-primary/80 transition-colors">Edit</button>
                        <div class="w-px h-3 bg-slate-300"></div>
                        <button class="text-red-500 hover:text-red-600 transition-colors">Remove</button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection
