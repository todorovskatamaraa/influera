@extends('layouts.loggedin-layout')

@section('title', 'Notification Settings')

@section('content')
<div class="flex flex-col lg:flex-row gap-16">
    {{-- SETTINGS SIDEBAR --}}
    @include('settings._sidebar', ['active' => 'notifications'])

    {{-- MAIN CONTENT --}}
    <div class="flex-1 space-y-6">
        <h2 class="text-xl font-bold text-slate-900 mb-6">Notification Settings</h2>

        {{-- Messages Card --}}
        <div class="border border-slate-200 rounded-xl p-8 bg-white shadow-sm">
            <h3 class="font-bold text-slate-900 text-lg mb-6">Messages</h3>

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-slate-900 mb-2">Show notifications for:</label>
                    <div class="relative max-w-sm">
                        <select
                            class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 appearance-none focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary bg-white">
                            <option>All activity</option>
                            <option>Important only</option>
                            <option>None</option>
                        </select>
                        <div
                            class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-500">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-900 mb-2">Increment message counter for:</label>
                    <div class="relative max-w-sm">
                        <select
                            class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 appearance-none focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary bg-white">
                            <option>All activity</option>
                            <option>Important only</option>
                            <option>None</option>
                        </select>
                        <div
                            class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-500">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 text-sm mb-1">Email</h4>
                    <p class="text-xs text-slate-500">(sending to j*******@gmail.com)</p>
                </div>
            </div>
        </div>

        <div class="border border-slate-200 rounded-xl p-8 bg-white shadow-sm">
            <h3 class="font-bold text-slate-900 text-lg mb-6">Other Email Updates</h3>

            <p class="text-xs font-bold text-slate-900 mb-6">
                Send email notification to j*******@gmail.com when...
            </p>

            <div class="space-y-8">
                <div>
                    <h4 class="font-bold text-slate-900 text-sm mb-4">Recruiting</h4>

                    <div class="mb-6">
                        <label class="block text-xs font-medium text-slate-900 mb-2">
                            Receive recruiting emails for:
                        </label>
                        <div class="relative max-w-sm">
                            <select
                                class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm text-slate-700 appearance-none focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary bg-white">
                                <option>All activity</option>
                                <option>Important only</option>
                                <option>None</option>
                            </select>
                            <div
                                class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-500">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="custom-radio-check">
                            <span class="text-sm font-bold text-slate-700 group-hover:text-slate-900">
                                A campaign is posted or modified
                            </span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="custom-radio-check">
                            <span class="text-sm font-bold text-slate-700 group-hover:text-slate-900">
                                An interview is accepted or terms are updated
                            </span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="custom-radio-check">
                            <span class="text-sm font-bold text-slate-700 group-hover:text-slate-900">
                                An interview or offer is declined or withdrawn
                            </span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="custom-radio-check">
                            <span class="text-sm font-bold text-slate-700 group-hover:text-slate-900">
                                A collaboration offer is accepted
                            </span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="custom-radio-check">
                            <span class="text-sm font-bold text-slate-700 group-hover:text-slate-900">
                                A campaign has expired
                            </span>
                        </label>
                    </div>
                </div>

                {{-- Influencer Proposals & Campaigns Section --}}
                <div>
                    <h4 class="font-bold text-slate-900 text-sm mb-4">Influencer Proposals & Campaigns</h4>

                    <div class="space-y-4">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="custom-radio-check">
                            <span class="text-sm font-bold text-slate-700 group-hover:text-slate-900">
                                An interview is initiated
                            </span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="custom-radio-check">
                            <span class="text-sm font-bold text-slate-700 group-hover:text-slate-900">
                                A brand sends a collaboration or interview invite
                            </span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="custom-radio-check">
                            <span class="text-sm font-bold text-slate-700 group-hover:text-slate-900">
                                A campaign I applied to was canceled or closed
                            </span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" class="custom-radio-check">
                            <span class="text-sm font-bold text-slate-700 group-hover:text-slate-900">
                                I withdrew my proposal
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
