@extends(auth()->check() ? 'layouts.loggedin-layout' : 'layouts.guest-layout')

@section('title', 'Influentia - Help Center - Getting Started')

@section('content')
    <main class="container mx-auto px-6 md:px-12 lg:px-24 py-12 min-h-screen">
        <div class="text-center mb-16">
            <p class="text-xs text-slate-500 mb-2">Help center / Get Started</p>
            <h1 class="text-2xl font-bold text-slate-900">Getting Started with Influentia</h1>
        </div>

        <div class="flex flex-col lg:flex-row gap-16">
            <div class="w-full lg:w-64 shrink-0">
                <nav class="flex flex-col space-y-1 border-l-2 border-slate-100">
                    <a href="#"
                       class="px-4 py-2 text-sm font-bold text-primary border-l-2 border-primary -ml-0.5 bg-purple-50/50">
                        Get Started
                    </a>
                    <a href="#"
                       class="px-4 py-2 text-sm text-slate-500 hover:text-slate-900 hover:border-l-2 hover:border-slate-300 hover:-ml-0.5 transition-all">
                        Build Your Profile
                    </a>
                    <a href="#"
                       class="px-4 py-2 text-sm text-slate-500 hover:text-slate-900 hover:border-l-2 hover:border-slate-300 hover:-ml-0.5 transition-all">
                        Find a Project
                    </a>
                    <a href="#"
                       class="px-4 py-2 text-sm text-slate-500 hover:text-slate-900 hover:border-l-2 hover:border-slate-300 hover:-ml-0.5 transition-all">
                        Start Working
                    </a>
                    <a href="#"
                       class="px-4 py-2 text-sm text-slate-500 hover:text-slate-900 hover:border-l-2 hover:border-slate-300 hover:-ml-0.5 transition-all">
                        Get Paid
                    </a>
                    <a href="#"
                       class="px-4 py-2 text-sm text-slate-500 hover:text-slate-900 hover:border-l-2 hover:border-slate-300 hover:-ml-0.5 transition-all">
                        Payment Issues
                    </a>
                    <a href="#"
                       class="px-4 py-2 text-sm text-slate-500 hover:text-slate-900 hover:border-l-2 hover:border-slate-300 hover:-ml-0.5 transition-all">
                        Account
                    </a>
                    <a href="#"
                       class="px-4 py-2 text-sm text-slate-500 hover:text-slate-900 hover:border-l-2 hover:border-slate-300 hover:-ml-0.5 transition-all">
                        Apps
                    </a>
                    <a href="#"
                       class="px-4 py-2 text-sm text-slate-500 hover:text-slate-900 hover:border-l-2 hover:border-slate-300 hover:-ml-0.5 transition-all">
                        Trust and Security
                    </a>
                    <a href="#"
                       class="px-4 py-2 text-sm text-slate-500 hover:text-slate-900 hover:border-l-2 hover:border-slate-300 hover:-ml-0.5 transition-all">
                        Project Catalog
                    </a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="flex-1">
                <!-- Connects -->
                <div class="mb-12">
                    <h2 class="text-lg font-bold text-slate-900 mb-6">Connects</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-12">
                        <a href="#" class="text-sm text-primary hover:underline underline-offset-2">
                            Connects balance, rollover, and history
                        </a>
                        <a href="#"
                           class="text-sm text-primary hover:underline underline-offset-2 text-right md:text-left md:ml-auto">
                            Returned Connects
                        </a>

                        <a href="#" class="text-sm text-primary hover:underline underline-offset-2">
                            Manage Connects
                        </a>
                        <a href="#"
                           class="text-sm text-primary hover:underline underline-offset-2 text-right md:text-left md:ml-auto">
                            Redeem a Connects reward
                        </a>

                        <a href="#" class="text-sm text-primary hover:underline underline-offset-2">
                            Get Connects
                        </a>
                        <a href="#"
                           class="text-sm text-primary hover:underline underline-offset-2 text-right md:text-left md:ml-auto">
                            Use Connects
                        </a>
                    </div>
                </div>

                <!-- Join Influentia -->
                <div class="mb-12">
                    <h2 class="text-lg font-bold text-slate-900 mb-6">Join Influentia</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-12">
                        <a href="#" class="text-sm text-primary hover:underline underline-offset-2">
                            Connects balance, rollover, and history
                        </a>
                        <a href="#"
                           class="text-sm text-primary hover:underline underline-offset-2 text-right md:text-left md:ml-auto">
                            Returned Connects
                        </a>

                        <a href="#" class="text-sm text-primary hover:underline underline-offset-2">
                            Manage Connects
                        </a>
                        <a href="#"
                           class="text-sm text-primary hover:underline underline-offset-2 text-right md:text-left md:ml-auto">
                            Redeem a Connects reward
                        </a>

                        <a href="#" class="text-sm text-primary hover:underline underline-offset-2">
                            Get Connects
                        </a>
                        <a href="#"
                           class="text-sm text-primary hover:underline underline-offset-2 text-right md:text-left md:ml-auto">
                            Use Connects
                        </a>
                    </div>
                </div>

                <!-- Get Involved -->
                <div class="mb-12">
                    <h2 class="text-lg font-bold text-slate-900 mb-6">Get Involved</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-12">
                        <a href="#" class="text-sm text-primary hover:underline underline-offset-2">
                            Connects balance, rollover, and history
                        </a>
                        <a href="#"
                           class="text-sm text-primary hover:underline underline-offset-2 text-right md:text-left md:ml-auto">
                            Returned Connects
                        </a>

                        <a href="#" class="text-sm text-primary hover:underline underline-offset-2">
                            Manage Connects
                        </a>
                        <a href="#"
                           class="text-sm text-primary hover:underline underline-offset-2 text-right md:text-left md:ml-auto">
                            Redeem a Connects reward
                        </a>

                        <a href="#" class="text-sm text-primary hover:underline underline-offset-2">
                            Get Connects
                        </a>
                        <a href="#"
                           class="text-sm text-primary hover:underline underline-offset-2 text-right md:text-left md:ml-auto">
                            Use Connects
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Still Need Help -->
        <div
            class="mt-24 flex flex-col md:flex-row items-center justify-center gap-4 text-center md:text-left max-w-xl mx-auto">
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
