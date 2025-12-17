<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Influentia - Match Your Brand')</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
          },
          colors: {
            primary: { DEFAULT: "hsl(262 83% 58%)" },
          }
        }
      }
    }
  </script>

  <style>
    .container { width: 100%; margin-right: auto; margin-left: auto; }
    @media (min-width: 1400px) { .container { max-width: 1400px; } }
  </style>

</head>

<body class="font-sans antialiased flex flex-col min-h-screen bg-white overflow-x-hidden">

  <main class="flex-grow">

   {{-- HERO --}}
<section class="relative overflow-hidden bg-[#a78bfa] h-160vh">

  {{-- Background DNA image --}}
  <div class="absolute inset-0 z-0">
    <img
      src="{{ asset('images/3.png') }}"
      class="w-full h-full object-cover opacity-80"
      alt="DNA Background"
    />
  </div>

  <div class="absolute inset-0 z-10 bg-black/10"></div>

  {{-- NAVBAR --}}
  <header class="container mx-auto px-6 md:px-12 lg:px-24 pt-6 relative z-40">
    <nav class="w-full bg-gradient-to-r from-[#C2F1F5] to-[#E3D9FC] px-6 md:px-8 py-4 rounded-2xl flex items-center justify-between shadow-sm gap-4">
      <a href="{{ url('/') }}" class="flex items-center gap-2">
        <img src="{{ asset('images/icons/logo.png') }}" alt="Influentia Logo" class="w-10 h-10 object-contain rounded" />
        <span class="font-bold text-xl tracking-tight text-slate-900">Influentia</span>
      </a>

      <div class="hidden md:flex items-center gap-8">
        <a href="{{ route('welcome') }}"
           class="text-sm transition-colors {{ request()->is('/') ? 'font-semibold text-slate-900 border-b-2 border-slate-900 pb-0.5' : 'font-medium text-slate-700 hover:text-slate-900' }}">
          Home
        </a>
        <a href="{{ route('jobs.index') }}"
           class="text-sm transition-colors {{ request()->is('jobs') ? 'font-semibold text-slate-900 border-b-2 border-slate-900 pb-0.5' : 'font-medium text-slate-700 hover:text-slate-900' }}">
          Jobs
        </a>
        <a href="{{ route('discover') }}"
           class="text-sm transition-colors {{ request()->is('discover') ? 'font-semibold text-slate-900 border-b-2 border-slate-900 pb-0.5' : 'font-medium text-slate-700 hover:text-slate-900' }}">
          Discover
        </a>
        <a href="#"
           class="text-sm transition-colors">
          Create Your DNA
        </a>
      </div>

      <div class="hidden md:flex items-center gap-4">
        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-700 hover:text-slate-900">Log in</a>
        <a href="{{ route('register') }}"
           class="text-sm font-medium bg-white/40 border border-white/60 hover:bg-white text-slate-900 px-5 py-2 rounded-xl transition-all shadow-sm">
          Sign Up
        </a>
        <span class="text-sm font-medium text-slate-900 pl-2 border-l border-slate-300">ENG | MK</span>
      </div>

      <button
        id="mobile-menu-button"
        class="md:hidden inline-flex items-center justify-center p-2 rounded-lg text-slate-700 hover:bg-white/60"
        type="button">
        <svg width="22" height="22" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round">
          <line x1="4" y1="6" x2="20" y2="6"></line>
          <line x1="4" y1="12" x2="20" y2="12"></line>
          <line x1="4" y1="18" x2="20" y2="18"></line>
        </svg>
      </button>
    </nav>

    <div
      id="mobile-menu"
      class="md:hidden mt-3 w-full bg-gradient-to-r from-[#C2F1F5] to-[#E3D9FC] rounded-2xl px-6 py-4 shadow-sm hidden">
      <div class="flex flex-col gap-3 text-sm text-slate-800">
        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'font-semibold text-slate-900' : 'text-slate-700 hover:text-slate-900' }}">Home</a>
        <a href="{{ url('/jobs') }}" class="{{ request()->is('jobs') ? 'font-semibold text-slate-900' : 'text-slate-700 hover:text-slate-900' }}">Jobs</a>
        <a href="{{ url('/discover') }}" class="{{ request()->is('discover') ? 'font-semibold text-slate-900' : 'text-slate-700 hover:text-slate-900' }}">Discover</a>
        <a href="#">Create Your DNA</a>

        <div class="h-px bg-white/60 my-2"></div>

        <a href="{{ route('login') }}"
           class="w-full text-center block text-sm font-medium text-slate-800 py-2 rounded-xl bg-white/40 border border-white/60 hover:bg-white transition-all">
          Log in
        </a>

        <a href="{{ route('register') }}"
           class="w-full text-center block text-sm font-semibold text-slate-900 py-2 rounded-xl bg-white hover:bg-slate-50 transition-all shadow-sm">
          Sign Up
        </a>
      </div>
    </div>
  </header>

  {{-- HERO CONTENT --}}
  <div class="container mx-auto px-6 md:px-12 lg:px-24 relative z-30">
    <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-10 pt-10 md:pt-14 lg:pt-20 pb-16 md:pb-20 lg:pb-32">

     {{-- Left --}}
      <div class="relative z-50 text-white max-w-3xl pl-10 pt-10">
        <h1 class="text-4xl md:text-5xl font-extrabold leading-[1.05] tracking-tight mb-6">
          Match Your Brand with<br />
          the perfect influencers
        </h1>

        <p class="text-white/90 text-base md:text-lg leading-relaxed max-w-md mb-8">
          Influentia uses Digital DNA to create perfect matches between brands and influencers, ensuring authentic collaborations that resonate with audiences.
        </p>

        <a href="#"
          class="inline-flex items-center justify-center bg-[#06b6d4] hover:bg-[#0891b2] text-white font-bold py-3.5 px-8 rounded-lg transition-all shadow-lg shadow-[#06b6d4]/25 text-sm md:text-base">
          Create your digital DNA
        </a>
      </div>


      {{-- Right --}}
      <div class="relative z-10 md:absolute md:right-8 lg:right-20 md:top-[70%] md:-translate-y-1/2 md:w-[65%] lg:w-[45%] lg:top-[60%] pointer-events-none pr-10">
        <div class="relative w-full translate-y-8 md:translate-y-0">
          <img
            src="{{ asset('images/4.png') }}"
            alt="Influencer with phone"
            class="w-full h-auto drop-shadow-[0_26px_70px_rgba(0,0,0,0.25)] scale-110 md:scale-125 origin-center"
          />
        </div>
      </div>

    </div>
  </div>

  <div class="pointer-events-none absolute inset-x-0 bottom-0 z-30 h-[300px] bg-gradient-to-b from-transparent via-[#a78bfa]/50 to-[#a78bfa]"></div>

</section>




    {{-- WHY INFLUENTIA WORKS --}}
    <section class="relative  py-24 bg-[#a78bfa]">
      <div class="container mx-auto px-6 md:px-12 lg:px-24">
        <h2 class="text-3xl font-bold text-white text-center mb-16">Why Influentia Works</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="bg-[#0f172a] rounded-2xl p-8 border border-white/10 hover:border-primary/50 transition-all">
            <div class="text-cyan-400 mb-4">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M2 12h5"/><path d="M22 12h-5"/><path d="M12 2v5"/><path d="M12 22v-5"/>
                <path d="M12 7a5 5 0 0 1 5 5 5 5 0 0 1-5 5 5 5 0 0 1-5-5 5 5 0 0 1 5-5z"/>
              </svg>
            </div>
            <h3 class="text-white font-bold text-lg mb-3">Digital DNA Matching</h3>
            <p class="text-slate-400 text-sm leading-relaxed">
              Our proprietary algorithm analyzes brand and creator values, audience demographics, and content style for perfect matches.
            </p>
          </div>

          <div class="bg-[#0f172a] rounded-2xl p-8 border border-white/10 hover:border-primary/50 transition-all">
            <div class="text-cyan-400 mb-4">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
              </svg>
            </div>
            <h3 class="text-white font-bold text-lg mb-3">Authentic Audiences</h3>
            <p class="text-slate-400 text-sm leading-relaxed">
              Connect with creators whose audiences genuinely align with your brand values and target demographics.
            </p>
          </div>

          <div class="bg-[#0f172a] rounded-2xl p-8 border border-white/10 hover:border-primary/50 transition-all">
            <div class="text-cyan-400 mb-4">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="20" x2="18" y2="10"/>
                <line x1="12" y1="20" x2="12" y2="4"/>
                <line x1="6" y1="20" x2="6" y2="14"/>
              </svg>
            </div>
            <h3 class="text-white font-bold text-lg mb-3">Performance Insights</h3>
            <p class="text-slate-400 text-sm leading-relaxed">
              Track campaign performance with detailed analytics and actionable insights to optimize your ROI.
            </p>
          </div>
        </div>
      </div>
    </section>

    {{-- HOW IT WORKS --}}
    <section class="py-24 bg-gradient-to-b from-[#a78bfa] to-white relative overflow-hidden">
      <img src="{{ asset('images/6.png') }}" class="absolute top-20 left-0 w-32 opacity-80 blur-sm transform" alt="">
      <img src="{{ asset('images/2.png') }}" class="absolute bottom-40 right-0 w-40 opacity-80 blur-sm" alt="">

      <div class="container mx-auto px-6 md:px-12 lg:px-24 relative z-10">
        <div class="text-center mb-16">
          <h2 class="text-3xl font-bold text-slate-900 mb-2">How it works</h2>
          <p class="text-slate-600 text-sm">A simple process to connect brands with the perfect influencers.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
          <div class="hidden md:block absolute top-6 left-0 w-full h-0.5 bg-purple-200 -z-10 transform translate-y-2"></div>

          <div class="text-center relative">
            <div class="w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center font-bold mx-auto mb-6 relative z-10 border-4 border-white shadow-lg">1</div>
            <h3 class="font-bold text-slate-900 mb-2 text-sm">Create your DNA</h3>
            <p class="text-xs text-slate-500 leading-relaxed max-w-[200px] mx-auto">Complete a quick questionnaire about your brand or content style.</p>
          </div>

          <div class="text-center relative">
            <div class="w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center font-bold mx-auto mb-6 relative z-10 border-4 border-white shadow-lg">2</div>
            <h3 class="font-bold text-slate-900 mb-2 text-sm">Post or Browse Jobs</h3>
            <p class="text-xs text-slate-500 leading-relaxed max-w-[200px] mx-auto">Businesses post opportunities or influencers browse available collaborations.</p>
          </div>

          <div class="text-center relative">
            <div class="w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center font-bold mx-auto mb-6 relative z-10 border-4 border-white shadow-lg">3</div>
            <h3 class="font-bold text-slate-900 mb-2 text-sm">Review Matches</h3>
            <p class="text-xs text-slate-500 leading-relaxed max-w-[200px] mx-auto">See AI-powered match scores and compatibility insights.</p>
          </div>

          <div class="text-center relative">
            <div class="w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center font-bold mx-auto mb-6 relative z-10 border-4 border-white shadow-lg">4</div>
            <h3 class="font-bold text-slate-900 mb-2 text-sm">Get Hired</h3>
            <p class="text-xs text-slate-500 leading-relaxed max-w-[200px] mx-auto">Complete a quick questionnaire about your brand or content style.</p>
          </div>
        </div>
      </div>
    </section>

    {{-- PRICING PLANS --}}
    <section class="py-20 bg-white">
      <div class="container mx-auto px-6 md:px-12 lg:px-24">
        <div class="text-center mb-16">
          <h2 class="text-3xl font-bold text-slate-900 mb-8">Pricing Plans</h2>

          <div class="inline-flex bg-slate-100 rounded-full p-1 mb-8">
            <button class="px-6 py-2 rounded-full bg-primary text-white text-xs font-bold shadow-sm">Annual</button>
            <button class="px-6 py-2 rounded-full text-slate-500 text-xs font-bold hover:text-slate-900">Monthly</button>
          </div>
        </div>

        <div class="flex flex-col lg:flex-row items-center justify-center gap-8 w-full max-w-5xl mx-auto">
          <div class="bg-gradient-to-b from-white to-[#F3F0FF] rounded-2xl p-8 w-full max-w-sm h-[380px] flex flex-col items-center justify-center shadow-lg shadow-purple-100/50 border border-purple-50 relative z-0">
            <h2 class="text-xl font-bold text-slate-900 mb-2">Mini</h2>
            <div class="flex items-baseline gap-1 mb-6">
              <span class="text-2xl font-bold text-slate-900">€5</span>
              <span class="text-sm text-slate-500">/monthly</span>
            </div>
            <div class="text-center space-y-2 mb-8">
              <p class="text-sm text-slate-600">5 job applications /</p>
              <p class="text-sm text-slate-600">messages</p>
            </div>
            <button class="bg-[#0f172a] text-white text-xs font-bold py-3 px-10 rounded-lg hover:bg-slate-800 transition-all">Get Started</button>
          </div>

          <div class="bg-primary rounded-2xl p-8 w-full max-w-sm h-[440px] flex flex-col items-center justify-center shadow-xl shadow-purple-500/30 relative z-10 scale-105 transform">
            <h2 class="text-2xl font-bold text-white mb-2">Standard</h2>
            <div class="flex items-baseline gap-1 mb-4">
              <span class="text-3xl font-bold text-white">€15</span>
              <span class="text-base text-white/80">/monthly</span>
            </div>
            <div class="text-center space-y-2 mb-8">
              <p class="text-base text-white">20 job applications /</p>
              <p class="text-base text-white">messages</p>
            </div>
            <p class="text-base text-white italic font-medium mb-8">AI Tips</p>
            <button class="bg-[#06b6d4] text-white text-xs font-bold py-3 px-10 rounded-lg hover:bg-[#0891b2] transition-all shadow-lg">Get Started</button>
          </div>

          <div class="bg-gradient-to-b from-white to-[#F3F0FF] rounded-2xl p-8 w-full max-w-sm h-[380px] flex flex-col items-center justify-center shadow-lg shadow-purple-100/50 border border-purple-50 relative z-0">
            <h2 class="text-xl font-bold text-slate-900 mb-2">Max</h2>
            <div class="flex items-baseline gap-1 mb-6">
              <span class="text-2xl font-bold text-slate-900">€25</span>
              <span class="text-sm text-slate-500">/monthly</span>
            </div>
            <div class="text-center space-y-4 mb-8">
              <div>
                <p class="text-sm text-slate-600">50 job applications /</p>
                <p class="text-sm text-slate-600">messages</p>
              </div>
              <p class="text-sm text-slate-600 italic font-medium">Pro features, plus</p>
              <p class="text-sm text-slate-600 font-medium">Boost</p>
            </div>
            <button class="bg-[#0f172a] text-white text-xs font-bold py-3 px-10 rounded-lg hover:bg-slate-800 transition-all">Get Started</button>
          </div>
        </div>
      </div>
    </section>

    {{-- DISCOVER PERFECT MATCHES --}}
    <section class="py-20 bg-white">
      <div class="container mx-auto px-6 md:px-12 lg:px-24 text-center">
        <h2 class="text-3xl font-bold text-slate-900 mb-12">Discover Perfect Matches</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
          <div class="border border-slate-100 rounded-2xl p-10 shadow-sm hover:shadow-md transition-all">
            <div class="w-12 h-12 mx-auto mb-4 text-purple-400">
              <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
              </svg>
            </div>
            <h3 class="font-bold text-slate-900 text-lg mb-2">For Influencers</h3>
            <p class="text-xs text-slate-500 mb-6 max-w-xs mx-auto">Discover brands that align with your content style, values, and audience demographics.</p>
            <a href="{{ url('/discover') }}" class="inline-flex bg-[#8b5cf6] text-white text-xs font-bold py-2.5 px-8 rounded-lg hover:bg-[#7c3aed] transition-all">
              Browse Businesses
            </a>
          </div>

          <div class="border border-slate-100 rounded-2xl p-10 shadow-sm hover:shadow-md transition-all">
            <div class="w-12 h-12 mx-auto mb-4 text-purple-400">
              <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
              </svg>
            </div>
            <h3 class="font-bold text-slate-900 text-lg mb-2">For Businesses</h3>
            <p class="text-xs text-slate-500 mb-6 max-w-xs mx-auto">Discover creators that align with your brand style, values, and audience demographics.</p>
            <a href="{{ url('/discover') }}" class="inline-flex bg-[#8b5cf6] text-white text-xs font-bold py-2.5 px-8 rounded-lg hover:bg-[#7c3aed] transition-all">
              Browse Influencers
            </a>
          </div>
        </div>
      </div>
    </section>

    {{-- SEE WHAT ALL THE TALK IS ABOUT + CTA --}}
    <section class="py-20 bg-gradient-to-b from-white to-[#1e1b4b] pb-40">
      <div class="container mx-auto px-6 md:px-12 lg:px-24 text-center">
        <h2 class="text-3xl font-bold text-slate-900 mb-16">See what all the talk is about:</h2>

        <div class="relative w-full max-w-5xl mx-auto h-[400px] md:h-[500px]">
          <img src="{{ asset('images/1.png') }}" class="w-full h-full object-contain" alt="">
        </div>
      </div>

      <section class="text-white py-20 mt-4 relative z-10">
        <div class="container mx-auto px-6 md:px-12 lg:px-24 text-center">
          <h2 class="text-2xl md:text-5xl font-bold mb-4">Ready to Find Your Perfect Match?</h2>
          <p class="text-slate-400 text-sm mb-8">Join Influentia today and discover the power of Digital DNA matching.</p>

          <div class="flex justify-center gap-4">
            <a href="{{ route('register') }}" class="bg-white text-slate-900 text-sm font-bold py-3 px-8 rounded-lg hover:bg-slate-100 transition-all">
              Get Started
            </a>
            <a href="{{ url('/jobs') }}" class="bg-transparent border border-slate-600 text-white text-sm font-bold py-3 px-8 rounded-lg hover:bg-white/10 transition-all">
              Browse Jobs
            </a>
          </div>
        </div>
      </section>
    </section>

  </main>

  {{-- FOOTER --}}
  <footer class="bg-[#0B0F19] text-white pt-16 pb-8">
    <div class="container mx-auto px-6 md:px-12 lg:px-24">
      <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-24">

        <div class="md:col-span-4">
          <div class="flex items-center gap-2 mb-4">
            <img src="{{ asset('images/icons/logo.png') }}" alt="Influentia Logo" class="w-10 h-10 object-contain rounded" />
            <span class="font-bold text-xl tracking-tight">Influentia</span>
          </div>
          <p class="text-slate-400 text-xs leading-relaxed max-w-xs">
            AI-powered platform matching businesses with influencers based on Digital DNA compatibility.
          </p>
        </div>

        <div class="hidden md:block md:col-span-2"></div>

        <div class="md:col-span-2">
          <h3 class="font-medium text-sm mb-6">Platform</h3>
          <ul class="space-y-4 text-xs text-slate-400">
            <li><a href="#" class="hover:text-white">Business DNA</a></li>
            <li><a href="#" class="hover:text-white">Influencer DNA</a></li>
            <li><a href="{{ url('/jobs') }}" class="hover:text-white">Browse Jobs</a></li>
          </ul>
        </div>

        <div class="md:col-span-2">
          <h3 class="font-medium text-sm mb-6">Company</h3>
          <ul class="space-y-4 text-xs text-slate-400">
            <li><a href="#" class="hover:text-white">About</a></li>
            <li><a href="#" class="hover:text-white">Blog</a></li>
            <li><a href="#" class="hover:text-white">Careers</a></li>
          </ul>
        </div>

        <div class="md:col-span-2">
          <h3 class="font-medium text-sm mb-6">Legal</h3>
          <ul class="space-y-4 text-xs text-slate-400">
            <li><a href="#" class="hover:text-white">Privacy</a></li>
            <li><a href="#" class="hover:text-white">Terms</a></li>
            <li><a href="#" class="hover:text-white">Cookies</a></li>
          </ul>
        </div>
      </div>

      <div class="flex flex-col md:flex-row justify-between items-center pt-8 border-t border-white/5">
        <div class="text-[10px] text-slate-500 mb-4 md:mb-0">
          © 2025 Influentia. All rights reserved.
        </div>

        <div class="flex items-center gap-6">
          <a href="#" class="hover:text-primary">
            <svg width="18" height="18" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round">
              <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
              <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
              <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
            </svg>
          </a>

          <a href="#" class="hover:text-primary">
            <svg width="18" height="18" viewBox="0 0 48 48" fill="currentColor">
              <path d="M41 16.1c-3.5-.2-6.8-1.7-9.2-4V30c0 8.3-6.7 15-15 15S2 38.3 2 30s6.7-15 15-15c1.2 0 2.4.2 3.5.5v8.2c-.9-.4-1.9-.7-3-.7-3.6 0-6.5 2.9-6.5 6.5S13.9 36 17.5 36s6.5-2.9 6.5-6.5V2h8c.2 3.6 3.1 6.6 6.8 6.9v7.2z"/>
            </svg>
          </a>

          <a href="#" class="hover:text-primary">
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

  <script>
    const btn  = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');

    if (btn) {
      btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
      });
    }
  </script>

</body>
</html>
