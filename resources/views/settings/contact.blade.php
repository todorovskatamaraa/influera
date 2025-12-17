@extends('layouts.loggedin-layout')

@section('title', 'Contact Info')

@section('content')
@php
    $user = auth()->user();

    $editModalOpen = $errors->has('name')
        || $errors->has('email')
        || $errors->has('phone')
        || $errors->has('country');
@endphp

<div class="flex flex-col lg:flex-row gap-16">
    {{-- SETTINGS SIDEBAR --}}
    @include('settings._sidebar', ['active' => 'contact'])

    {{-- MAIN CONTENT --}}
    <div class="flex-1">
        <h2 class="text-xl font-bold text-slate-900 mb-6">Contact Info</h2>

        {{-- success alert --}}
        @if(session('contact_updated'))
            <div class="mb-4">
                <div class="flex items-center justify-between w-full rounded-lg border border-emerald-500 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                    <div class="flex items-center gap-2">
                        <div class="w-5 h-5 rounded-full bg-emerald-500 flex items-center justify-center text-white">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <span>Your contact information has been updated.</span>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()"
                            class="text-emerald-700 hover:text-emerald-900">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        <!-- Account Card -->
        <div class="border border-slate-200 rounded-xl p-8 bg-white shadow-sm">

            <div class="flex justify-between items-start mb-8">
                <h3 class="font-bold text-slate-900 text-lg">Account</h3>
                <button
                    id="btn-open-edit-contact"
                    class="text-primary hover:text-primary/80 transition-colors p-2 bg-slate-50 rounded-full">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path
                            d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                        </path>
                    </svg>
                </button>
            </div>

            <div class="space-y-6 mb-12">
                <!-- User ID -->
                <div>
                    <p class="text-xs font-bold text-slate-900 mb-1">User ID</p>
                    <p class="text-sm text-slate-600">#{{ $user->id }}</p>
                </div>

                <!-- Full Name -->
                <div>
                    <p class="text-xs font-bold text-slate-900 mb-1">Full Name</p>
                    <p class="text-sm text-slate-600">{{ $user->name }}</p>
                </div>

                <!-- E-mail address -->
                <div>
                    <p class="text-xs font-bold text-slate-900 mb-1">E-mail address</p>
                    <p class="text-sm text-slate-600">{{ $user->email }}</p>
                </div>

                <!-- Phone number -->
                <div>
                    <p class="text-xs font-bold text-slate-900 mb-1">Phone number</p>
                    <p class="text-sm text-slate-600">
                        {{ $user->phone ?? 'Not set' }}
                    </p>
                </div>

                <!-- Country/Location -->
                <div>
                    <p class="text-xs font-bold text-slate-900 mb-1">Country/Location</p>
                    <p class="text-sm text-slate-600">
                        {{ $user->country ?? 'Not set' }}
                    </p>
                </div>

                <!-- Account type -->
                <div>
                    <p class="text-xs font-bold text-slate-900 mb-1">Account type</p>
                    <p class="text-sm text-slate-600">
                        {{ ucfirst($user->role ?? 'influencer') }}
                    </p>
                </div>

                <!-- Joined date -->
                <div>
                    <p class="text-xs font-bold text-slate-900 mb-1">Joined date</p>
                    <p class="text-sm text-slate-600">
                        {{ optional($user->created_at)->format('d/m/Y') }}
                    </p>
                </div>
            </div>

            <div class="flex justify-end">
                <button id="btn-close-account"
                        class="text-xs font-bold text-primary hover:text-primary/80 hover:underline transition-colors">
                    Close my account
                </button>
            </div>

        </div>
    </div>
</div>

{{-- Edit Contact Info Modal --}}
<div id="edit-contact-modal"
     class="fixed inset-0 z-[100] {{ $editModalOpen ? '' : 'hidden' }}"
     aria-labelledby="edit-contact-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div id="edit-contact-backdrop"
         class="fixed inset-0 bg-slate-900/20 backdrop-blur-sm transition-opacity"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">

            <div
                class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg p-8">

                <div class="flex items-start justify-between mb-4">
                    <h3 id="edit-contact-title" class="text-lg font-bold text-slate-900">
                        Edit contact info
                    </h3>
                    <button id="btn-x-edit-contact"
                            class="text-slate-400 hover:text-slate-700 transition-colors">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>

                <form method="POST" action="{{ route('settings.contact.update') }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    {{-- Full Name --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-900 mb-2">Full Name</label>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary bg-white"
                        />
                        @error('name')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-900 mb-2">E-mail address</label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary bg-white"
                        />
                        @error('email')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-900 mb-2">Phone number</label>
                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone', $user->phone) }}"
                            class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary bg-white"
                        />
                        @error('phone')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Country  --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-900 mb-2">Country / Location</label>
                        <select
                            name="country"
                            class="w-full border border-slate-200 rounded-lg px-4 py-2.5 text-sm bg-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                        >
                            <option value="">Select your country</option>
                            @php
                                $countries = [
                                    'North Macedonia',
                                    'Albania',
                                    'Bosnia and Herzegovina',
                                    'Bulgaria',
                                    'Croatia',
                                    'Greece',
                                    'Kosovo',
                                    'Montenegro',
                                    'Serbia',
                                    'Slovenia',
                                    'Austria',
                                    'Germany',
                                    'Switzerland',
                                    'United Kingdom',
                                    'United States',
                                    'Canada',
                                    'Other',
                                ];
                                $selectedCountry = old('country', $user->country);
                            @endphp

                            @foreach($countries as $country)
                                <option value="{{ $country }}" {{ $selectedCountry === $country ? 'selected' : '' }}>
                                    {{ $country }}
                                </option>
                            @endforeach
                        </select>
                        @error('country')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-4 pt-4">
                        <button type="button" id="btn-cancel-edit-contact"
                                class="px-6 py-2.5 text-xs font-bold text-slate-500 hover:text-slate-700 transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-6 py-2.5 bg-primary text-white text-xs font-bold rounded-lg hover:bg-primary/90 transition-colors shadow-lg shadow-primary/25">
                            Save changes
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="close-account-modal" class="fixed inset-0 z-[90] hidden"
     aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div id="close-account-backdrop"
         class="fixed inset-0 bg-slate-900/20 backdrop-blur-sm transition-opacity"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">

            <div
                class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl p-10">

                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Close account</h3>
                        <h4 class="text-sm font-bold text-slate-900 mb-4">
                            Leaving so soon? We hate to see you go.
                        </h4>
                    </div>
                    <button id="btn-x-close"
                            class="text-slate-400 hover:text-slate-700 transition-colors">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>

                <p class="text-xs text-slate-500 mb-8 leading-relaxed max-w-xl">
                    If there's anything we can do to improve your experience connecting with brands,
                    let us know. You can also reach us at +1-xxx-xxx-xxxx and press option 3 to speak
                    with our support team, available 8am-12am PT (Mon-Fri) and 9am-5pm PT (Sat-Sun)
                </p>

                <div class="mb-8">
                    <h5 class="text-sm font-bold text-slate-900 mb-4">
                        Select a reason for leaving
                    </h5>
                    <div class="space-y-3">
                        @foreach ([
                            "I'm closing a duplicate account",
                            "The platform is difficult to use",
                            "I didn't find suitable influencers/brands",
                            "The collaborations didn't meet my expectations",
                            "I no longer need influencer/brand partnerships",
                            "Other",
                        ] as $text)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="leave_reason" class="peer sr-only">
                                <div
                                    class="w-5 h-5 rounded-full border border-primary peer-checked:border-primary peer-checked:bg-white flex items-center justify-center">
                                    <div
                                        class="w-2.5 h-2.5 rounded-full bg-primary scale-0 peer-checked:scale-100 transition-transform">
                                    </div>
                                </div>
                                <span class="text-sm text-slate-700 group-hover:text-slate-900">
                                    {{ $text }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end gap-6 pt-2">
                    <button id="btn-cancel-close"
                            class="px-6 py-2.5 text-xs font-bold text-slate-500 hover:text-slate-700 transition-colors">
                        Cancel
                    </button>
                    <button
                        class="px-6 py-2.5 bg-primary text-white text-xs font-bold rounded-lg hover:bg-primary/90 transition-colors shadow-lg shadow-primary/25">
                        Close account
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const editModal        = document.getElementById('edit-contact-modal');
        const editBackdrop     = document.getElementById('edit-contact-backdrop');
        const btnOpenEdit      = document.getElementById('btn-open-edit-contact');
        const btnCancelEdit    = document.getElementById('btn-cancel-edit-contact');
        const btnXEdit         = document.getElementById('btn-x-edit-contact');

        const toggleEditModal = (show) => {
            if (!editModal) return;
            editModal.classList.toggle('hidden', !show);
        };

        if (btnOpenEdit) {
            btnOpenEdit.addEventListener('click', () => toggleEditModal(true));
        }
        if (btnCancelEdit) {
            btnCancelEdit.addEventListener('click', () => toggleEditModal(false));
        }
        if (btnXEdit) {
            btnXEdit.addEventListener('click', () => toggleEditModal(false));
        }
        if (editBackdrop) {
            editBackdrop.addEventListener('click', () => toggleEditModal(false));
        }

        const closeModal    = document.getElementById('close-account-modal');
        const closeBackdrop = document.getElementById('close-account-backdrop');
        const btnCloseAcc   = document.getElementById('btn-close-account');
        const btnCancelClose= document.getElementById('btn-cancel-close');
        const btnXClose     = document.getElementById('btn-x-close');

        const toggleCloseModal = (show) => {
            if (!closeModal) return;
            closeModal.classList.toggle('hidden', !show);
        };

        if (btnCloseAcc) {
            btnCloseAcc.addEventListener('click', () => toggleCloseModal(true));
        }
        if (btnCancelClose) {
            btnCancelClose.addEventListener('click', () => toggleCloseModal(false));
        }
        if (btnXClose) {
            btnXClose.addEventListener('click', () => toggleCloseModal(false));
        }
        if (closeBackdrop) {
            closeBackdrop.addEventListener('click', () => toggleCloseModal(false));
        }
    });
</script>
@endsection
