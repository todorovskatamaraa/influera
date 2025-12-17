<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Influentia')</title>
    
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
                        primary: {
                            DEFAULT: "hsl(262 83% 58%)",
                        },
                    }
                }
            }
        }
    </script>

    @stack('head')
</head>
{{-- <body class="font-sans antialiased flex flex-col min-h-screen bg-white"> --}}

    <!-- NAVBAR -->
    <header class="container mx-auto px-6 md:px-12 lg:px-24 pt-6 pb-2">
        <nav class="w-full bg-gradient-to-r from-[#C2F1F5] to-[#E3D9FC] px-6 md:px-8 py-4 rounded-2xl flex items-center justify-between shadow-sm gap-4">

            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <div class="text-primary">
                    <img src="{{ asset('images/icons/logo.png') }}"
         alt="Influentia Logo"
         class="w-10 h-10 object-contain rounded" />
                </div>
                <span class="font-bold text-xl tracking-tight text-slate-900">
                    Influentia
                </span>
            </a>

            <div class="hidden md:flex items-center gap-8">

                <!-- HOME -->
                <a href="{{ url('/') }}"
                   class="text-sm transition-colors
                   {{ request()->is('/') ? 
                        'font-semibold text-slate-900 border-b-2 border-slate-900 pb-0.5' :
                        'font-medium text-slate-700 hover:text-slate-900' }}">
                    Home
                </a>

                <!-- JOBS -->
                <a href="{{ url('/jobs') }}"
                   class="text-sm transition-colors
                   {{ request()->is('jobs') ? 
                        'font-semibold text-slate-900 border-b-2 border-slate-900 pb-0.5' :
                        'font-medium text-slate-700 hover:text-slate-900' }}">
                    Jobs
                </a>

                <!-- DISCOVER -->
                <a href="{{ url('/discover') }}"
                   class="text-sm transition-colors
                   {{ request()->is('discover') ? 
                        'font-semibold text-slate-900 border-b-2 border-slate-900 pb-0.5' :
                        'font-medium text-slate-700 hover:text-slate-900' }}">
                    Discover
                </a>

                <!-- CREATE DNA -->
                <a href="{{ url('/dna/create') }}"
                   class="text-sm transition-colors
                   {{ request()->is('dna/create') ? 
                        'font-semibold text-slate-900 border-b-2 border-slate-900 pb-0.5' :
                        'font-medium text-slate-700 hover:text-slate-900' }}">
                    Create Your DNA
                </a>
            </div>

            <!-- Desktop Right Actions -->
            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('login') }}"
                   class="text-sm font-medium text-slate-700 hover:text-slate-900">
                    Log in
                </a>

                <a href="{{ route('register') }}"
                   class="text-sm font-medium bg-white/40 border border-white/60 hover:bg-white text-slate-900 px-5 py-2 rounded-xl transition-all shadow-sm">
                    Sign Up
                </a>
            </div>

            <!-- Mobile Menu Button -->
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

        <!-- MOBILE MENU -->
        <div id="mobile-menu"
             class="md:hidden mt-3 w-full bg-gradient-to-r from-[#C2F1F5] to-[#E3D9FC] rounded-2xl px-6 py-4 shadow-sm hidden">

            <div class="flex flex-col gap-3 text-sm text-slate-800">
                
                <a href="{{ url('/') }}"
                   class="{{ request()->is('/') ?
                        'font-semibold text-slate-900' : 'text-slate-700 hover:text-slate-900' }}">
                    Home
                </a>

                <a href="{{ url('/jobs') }}"
                   class="{{ request()->is('jobs') ?
                        'font-semibold text-slate-900' : 'text-slate-700 hover:text-slate-900' }}">
                    Jobs
                </a>

                <a href="{{ url('/discover') }}"
                   class="{{ request()->is('discover') ?
                        'font-semibold text-slate-900' : 'text-slate-700 hover:text-slate-900' }}">
                    Discover
                </a>

                <a href="{{ url('/dna/create') }}"
                   class="{{ request()->is('dna/create') ?
                        'font-semibold text-slate-900' : 'text-slate-700 hover:text-slate-900' }}">
                    Create Your DNA
                </a>

                <div class="h-px bg-white/60 my-2"></div>

                <a href="{{ route('login') }}"
                   class="w-full text-center text-sm font-medium text-slate-800 py-2 rounded-xl bg-white/40 border border-white/60 hover:bg-white transition-all">
                    Log in
                </a>

                <a href="{{ route('register') }}"
                   class="w-full text-center text-sm font-semibold text-slate-900 py-2 rounded-xl bg-white hover:bg-slate-50 transition-all shadow-sm">
                    Sign Up
                </a>
            </div>

        </div>
    </header>

    <!-- MAIN CONTENT -->
    {{-- <main class="flex-grow">
        {{-- <div class="container mx-auto px-6 md:px-12 lg:px-24 py-12"> --}}
            @yield('content')
        {{-- </div> --}}
    {{-- </main>  --}}

    <!-- FOOTER -->
    <footer class="bg-[#0B0F19] text-white pt-16 pb-8 mt-4">
        <div class="container mx-auto px-6 md:px-12 lg:px-24">

            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-24">

                <div class="md:col-span-4">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="text-primary">
                            <img src="{{ asset('images/icons/logo.png') }}"
         alt="Influentia Logo"
         class="w-10 h-10 object-contain rounded" />
                        </div>
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
                        <li><a href="#" class="hover:text-white">Browse Jobs</a></li>
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
    <svg width="18" height="18" viewBox="0 0 48 48"
         fill="currentColor">
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
        const btn = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');

        if (btn) {
            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        }
    </script>

    @stack('scripts')
</body>
</html>
