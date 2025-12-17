<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>@yield("title", "Register")</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Inter:wght@400;500;600&display=swap"
      rel="stylesheet"
    />

    @vite(["resources/css/app.css", "resources/js/app.js"])
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>
  </head>

  <body
    class="
      flex flex-col
      min-h-screen
      text-foreground font-sans
      bg-background
      antialiased
    "
  >
    <div class="bg-curve"></div>

    {{-- Navbar --}}
    <nav class="z-50 w-full bg-white border-b border-slate-100 sticky top-0">
      <div
        class="container h-16 mx-auto px-6 flex items-center justify-between gap-4 md:px-12 lg:px-24"
      >
        <!-- Left -->
        <div class="flex items-center gap-8">
          <div
            class="flex items-center gap-2 cursor-pointer"
            onclick="window.location.href='{{ route('discover') }}'"
          >
            <img
              src="{{ asset('images/icons/logo.png') }}"
              alt="Influentia Logo"
              class="w-6 h-6 object-contain rounded"
            />

            <span class="font-bold text-lg tracking-tight text-slate-900">
              Influentia
            </span>
          </div>

          {{-- MAIN NAV --}}
          <div class="hidden lg:flex items-center gap-6">
            {{-- INFLUENCER --}}
            @if(auth()->user()->role === 'influencer')
              <button
                onclick="window.location.href='{{ route('jobs.index') }}'"
                class="text-xs font-medium text-slate-600 hover:text-primary"
              >
                Find Work
              </button>
            @endif

            {{-- BUSINESS --}}
            @if(auth()->user()->role === 'brand')
              <button
                onclick="window.location.href='{{ route('create-job') }}'"
                class="text-xs font-medium text-slate-600 hover:text-primary"
              >
                Deliver Work
              </button>
            @endif

            {{-- BOTH --}}
            <button
              onclick="window.location.href='{{ route('finances.index') }}'"
              class="text-xs font-medium text-slate-600 hover:text-primary"
            >
              Manage Finances
            </button>

            <button
              onclick="window.location.href='{{ route('discover') }}'"
              class="text-xs font-medium text-slate-600 hover:text-primary"
            >
              Discover
            </button>

            <button
              onclick="window.location.href='{{ route('messages') }}'"
              class="text-xs font-medium text-slate-600 hover:text-primary"
            >
              Messages
            </button>

            <button
              onclick="window.location.href='{{ route('leaderboard') }}'"
              class="text-xs font-medium text-slate-600 hover:text-primary"
            >
              Leaderboard
            </button>
          </div>
        </div>

        {{-- Right --}}
        <div class="flex items-center gap-4">
          {{-- SEARCH --}}
          <div class="hidden md:block relative w-64">
            <input
              type="text"
              placeholder="Search"
              class="w-full pl-4 pr-10 py-2 text-xs rounded-full border border-slate-200
                     focus:outline-none focus:border-primary"
            />
            <svg
              class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400"
              width="14"
              height="14"
              viewBox="0 0 24 24"
              fill="none"
              stroke-width="2"
              stroke="currentColor"
            >
              <circle cx="11" cy="11" r="8"></circle>
              <path d="m21 21-4.3-4.3"></path>
            </svg>
          </div>

          {{-- Icons --}}
          <button
            class="w-8 h-8 flex items-center justify-center border border-slate-200 rounded-full text-slate-500
                   hover:text-primary hover:border-primary"
          >
            <svg
  width="20"
  height="20"
  viewBox="0 0 24 24"
  fill="none"
  stroke="currentColor"
  stroke-width="2"
  stroke-linecap="round"
  stroke-linejoin="round"
>
  <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9" />
  <path d="M13.73 21a2 2 0 0 1-3.46 0" />
</svg>

          </button>

@php
    $user = auth()->user();

    $avatar = $user->avatar_path ?? null;

    if (!$avatar && $user->role === 'influencer' && $user->influencerProfile) {
        $avatar = $user->influencerProfile->avatar_path;
    }

    if (!$avatar && $user->role === 'brand' && $user->brandProfile) {
        $avatar = $user->brandProfile->company_logo_path
            ?? $user->brandProfile->company_cover_path;
    }

    $avatarUrl = $avatar
        ? asset($avatar)
        : asset('images/default-avatar.jpg');
@endphp

<div class="relative" x-data="{ open: false }">
  <button
    @click="open = !open"
    class="w-8 h-8 rounded-full overflow-hidden border-2 border-white focus:outline-none"
  >
    <img
      src="{{ $avatarUrl }}"
      alt="User avatar"
      class="object-cover w-full h-full"
    />
  </button>

            <div
              x-show="open"
              @click.away="open = false"
              class="absolute right-0 mt-2 w-40 bg-white border border-slate-200 rounded-lg shadow-lg py-2 z-50"
            >
              {{-- Profile --}}
              <a
                href="{{ auth()->user()->role === 'influencer'
                          ? route('influencer.profile.private')
                          : route('business.profile.private') }}"
                class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100"
              >
                Profile
              </a>

              {{-- Dashboard --}}
              <a
                href="{{ auth()->user()->role === 'influencer'
                          ? route('influencer-dashboard')
                          : route('business-dashboard') }}"
                class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100"
              >
                Dashboard
              </a>

              {{-- Settings --}}
              <a
                href="{{ route('settings.contact') }}"
                class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100"
              >
                Settings
              </a>

              {{-- Help --}}
              <a
                href="{{ route('help-center') }}"
                class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100"
              >
                Help
              </a>

              {{-- Logout --}}
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button
                  type="submit"
                  class="w-full px-4 py-2 text-left text-sm text-red-600 hover:bg-red-50"
                >
                  Log out
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </nav>

    {{-- Main Content --}}
    <main
      class="
        container
        mx-auto px-6 py-8
        md:px-12
        lg:px-24
      "
    >
      @yield("content")
    </main>

    {{-- Footer --}}
<footer class="py-16 bg-[#0f172a] text-slate-300 mt-16">
  <div class="container mx-auto px-6 md:px-12 lg:px-24">

    <div class="grid grid-cols-1 gap-12 mb-12 md:grid-cols-6">
      <div class="md:col-span-2">
        <div class="flex items-center gap-2 mb-6">
          <div class="flex w-10 h-10 rounded items-center justify-center">
            <img
              src="{{ asset('images/icons/logo.png') }}"
              alt="Influentia Logo"
              class="w-10 h-10 object-contain rounded mb-1"
            />
          </div>
          <span class="font-bold text-lg text-white">Influentia</span>
        </div>

        <p class="max-w-xs mb-6 text-[10px] text-slate-400 leading-relaxed">
          AI-powered platform matching businesses with influencers based on
          Digital DNA compatibility
        </p>
      </div>

      <!-- Brands(FAQ) -->
      <div>
        <h3 class="mb-6 font-bold text-white text-sm">Brands(FAQ)</h3>
        <ul class="space-y-3 text-[11px] text-slate-400">
          <li><a href="#" class="hover:text-white transition-colors">How to hire an influencer</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Influencer Marketplace</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Create a campaign</a></li>
          <li><a href="#" class="hover:text-white transition-colors">AI Matching Explained</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Subscription Plans</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Escrow & Payments</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Contact Support</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Boost your projects</a></li>
        </ul>
      </div>

      <!-- For Influencers (FAQ) -->
      <div>
        <h3 class="mb-6 font-bold text-white text-sm">For Influencers (FAQ)</h3>
        <ul class="space-y-3 text-[11px] text-slate-400">
          <li><a href="#" class="hover:text-white transition-colors">How to apply for projects</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Get started with free credits</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Refill & Credit Packages</a></li>
          <li><a href="#" class="hover:text-white transition-colors">AI Content Assistant (Coming soon)</a></li>
          <li><a href="#" class="hover:text-white transition-colors">How payouts work</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Create a standout profile</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Influencer Academy (Blog/Guide)</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Boost your visibility</a></li>
        </ul>
      </div>

      <!-- Resources -->
      <div>
        <h3 class="mb-6 font-bold text-white text-sm">Resources</h3>
        <ul class="space-y-3 text-[11px] text-slate-400">
          <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
          <li><a href="#" class="hover:text-white transition-colors">FAQ</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Case Studies</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Affiliate Program</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Community & Events</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Influencer of the Month</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Press Kit</a></li>
        </ul>
      </div>

      <!-- Company -->
      <div>
        <h3 class="mb-6 font-bold text-white text-sm">Company</h3>
        <ul class="space-y-3 text-[11px] text-slate-400">
          <li><a href="#" class="hover:text-white transition-colors">About Influentia</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Team & Mission</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Press & Media</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Trust & Safety</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Terms of Use</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
          <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
        </ul>
      </div>
    </div>

    {{-- Bottom bar --}}
    <div class="flex flex-col items-start justify-between gap-4 pt-8 border-t border-slate-800 md:flex-row md:items-center">
      <div class="text-[10px] text-slate-500">
        &copy; 2025 Influentia. All rights reserved.
      </div>

      <div class="flex items-center gap-6">
        {{-- Instagram --}}
        <a href="#" class="text-slate-400 hover:text-white transition-colors">
          <svg width="18" height="18" viewBox="0 0 24 24"
               fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round">
            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
          </svg>
        </a>

        {{-- TikTok --}}
        <a href="#" class="text-slate-400 hover:text-white transition-colors">
          <svg width="18" height="18" viewBox="0 0 48 48" fill="currentColor">
            <path d="M41 16.1c-3.5-.2-6.8-1.7-9.2-4V30c0 8.3-6.7 15-15 15S2 38.3 2 30s6.7-15 15-15c1.2 0 2.4.2 3.5.5v8.2c-.9-.4-1.9-.7-3-.7-3.6 0-6.5 2.9-6.5 6.5S13.9 36 17.5 36s6.5-2.9 6.5-6.5V2h8c.2 3.6 3.1 6.6 6.8 6.9v7.2z"/>
          </svg>
        </a>

        {{-- Twitter --}}
        <a href="#" class="text-slate-400 hover:text-white transition-colors">
          <svg width="18" height="18" viewBox="0 0 24 24"
               fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/>
          </svg>
        </a>
      </div>
    </div>

  </div>
</footer>

  </body>
</html>
