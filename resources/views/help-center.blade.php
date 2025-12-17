@extends('layouts.loggedin-layout')

@section('title', 'Help Center')

@section('content')
<main class="container mx-auto px-6 md:px-12 lg:px-24 py-16 min-h-screen">

    <div class="mb-16">
        <h1 class="text-3xl font-bold text-slate-900 mb-2">Find a solution fast.</h1>
        <p class="text-sm text-slate-600 mb-8">
            Find answers, troubleshoot issues, and get the most out of your influencer collaborations.
        </p>

        <div class="relative max-w-md">
            <input type="text" placeholder="Search"
                   class="w-full pl-4 pr-12 py-3 rounded-full border border-slate-300 text-sm
                          focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary
                          transition-all shadow-sm">
            <svg class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-900" width="18" height="18"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.3-4.3"></path>
            </svg>
        </div>
    </div>

    <div class="mb-16 text-center">
        <h2 class="text-xl font-bold text-slate-900 mb-6">Choose Role for Personalized Assistance</h2>
        <div class="flex justify-center gap-6 max-w-2xl mx-auto">
            <button
                class="flex-1 py-3 px-6 rounded-full border border-slate-200 text-sm font-medium
                       hover:border-primary hover:text-primary transition-all bg-white shadow-sm">
                For Influencers
            </button>
            <button
                class="flex-1 py-3 px-6 rounded-full border border-slate-200 text-sm font-medium
                       hover:border-primary hover:text-primary transition-all bg-white shadow-sm">
                For Brands
            </button>
        </div>
    </div>

    {{-- Help Categories --}}
    <div class="mb-24">
        <h2 class="text-xl font-bold text-slate-900 mb-8 text-center">Browse Help Categories</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            {{-- Category 1 --}}
            <a href="{{ route('getting-started') }}"
               class="group p-6 border border-[#E0D4FC] rounded-lg hover:border-primary hover:shadow-md
                      transition-all bg-white flex flex-col h-32 justify-between">
                <div class="text-primary mb-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path
                            d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z" />
                        <path
                            d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z" />
                        <path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0" />
                        <path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5" />
                    </svg>
                </div>
                <span
                    class="text-xs font-bold text-slate-700 group-hover:text-primary transition-colors">
                    Getting started with influera
                </span>
            </a>

            {{-- Category 2 --}}
            <a href="#"
               class="group p-6 border border-[#E0D4FC] rounded-lg hover:border-primary hover:shadow-md
                      transition-all bg-white flex flex-col h-32 justify-between">
                <div class="text-primary mb-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path d="M12 20h9" />
                        <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z" />
                    </svg>
                </div>
                <span
                    class="text-xs font-bold text-slate-700 group-hover:text-primary transition-colors">
                    Applying to Projects and Managing Collabs
                </span>
            </a>

            {{-- Category 3 --}}
            <a href="#"
               class="group p-6 border border-[#E0D4FC] rounded-lg hover:border-primary hover:shadow-md
                      transition-all bg-white flex flex-col h-32 justify-between">
                <div class="text-primary mb-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path
                            d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z" />
                        <path d="M5 3v4" />
                        <path d="M9 5h4" />
                        <path d="M19 19v4" />
                        <path d="M15 21h4" />
                    </svg>
                </div>
                <span
                    class="text-xs font-bold text-slate-700 group-hover:text-primary transition-colors">
                    Using AI Tools
                </span>
            </a>

            {{-- Category 4 --}}
            <a href="#"
               class="group p-6 border border-[#E0D4FC] rounded-lg hover:border-primary hover:shadow-md
                      transition-all bg-white flex flex-col h-32 justify-between">
                <div class="text-primary mb-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                         stroke-linejoin="round">
                        <rect width="20" height="14" x="2" y="5" rx="2" />
                        <line x1="2" x2="22" y1="10" y2="10" />
                    </svg>
                </div>
                <span
                    class="text-xs font-bold text-slate-700 group-hover:text-primary transition-colors">
                    Credits Subscriptions and Billing
                </span>
            </a>

            {{-- Category 5 --}}
            <a href="#"
               class="group p-6 border border-[#E0D4FC] rounded-lg hover:border-primary hover:shadow-md
                      transition-all bg-white flex flex-col h-32 justify-between">
                <div class="text-primary mb-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path
                            d="m12 8-9.04 9.06a2.82 2.82 0 1 0 3.98 3.98L16 12" />
                        <circle cx="17" cy="7" r="5" />
                    </svg>
                </div>
                <span
                    class="text-xs font-bold text-slate-700 group-hover:text-primary transition-colors">
                    Creating and Managing Campaigns
                </span>
            </a>

            {{-- Category 6 --}}
            <a href="#"
               class="group p-6 border border-[#E0D4FC] rounded-lg hover:border-primary hover:shadow-md
                      transition-all bg-white flex flex-col h-32 justify-between">
                <div class="text-primary mb-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                         stroke-linejoin="round">
                        <rect width="20" height="16" x="2" y="4" rx="2" />
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                    </svg>
                </div>
                <span
                    class="text-xs font-bold text-slate-700 group-hover:text-primary transition-colors">
                    Inbox and Communication Tools
                </span>
            </a>

            {{-- Category 7 --}}
            <a href="#"
               class="group p-6 border border-[#E0D4FC] rounded-lg hover:border-primary hover:shadow-md
                      transition-all bg-white flex flex-col h-32 justify-between">
                <div class="text-primary mb-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                         stroke-linejoin="round">
                        <line x1="12" x2="12" y1="2" y2="22" />
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                    </svg>
                </div>
                <span
                    class="text-xs font-bold text-slate-700 group-hover:text-primary transition-colors">
                    Escrow and Payments
                </span>
            </a>

            {{-- Category 8 --}}
            <a href="#"
               class="group p-6 border border-[#E0D4FC] rounded-lg hover:border-primary hover:shadow-md
                      transition-all bg-white flex flex-col h-32 justify-between">
                <div class="text-primary mb-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                         stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <circle cx="12" cy="10" r="3" />
                        <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662" />
                    </svg>
                </div>
                <span
                    class="text-xs font-bold text-slate-700 group-hover:text-primary transition-colors">
                    Account and Profile Settings
                </span>
            </a>

        </div>
    </div>

    {{-- Still Need Help --}}
    <div
        class="flex flex-col md:flex-row items-center justify-center gap-4 text-center md:text-left max-w-xl mx-auto">
        <div
            class="w-12 h-12 rounded-full bg-cyan-100 text-cyan-500 flex items-center justify-center shrink-0">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round"
                 stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                <path d="M12 17h.01" />
            </svg>
        </div>
        <div>
            <h3 class="text-lg font-bold text-slate-900 mb-1">Still need help?</h3>
            <p class="text-xs text-slate-500 leading-relaxed">
                Reach out anytime at
                <a href="mailto:support@influentia.ai"
                   class="text-slate-900 font-medium hover:underline">
                    support@influentia.ai
                </a>
                or use the in-app support widget.<br>
                We reply within 24 hours on weekdays.
            </p>
        </div>
    </div>

</main>
@endsection
