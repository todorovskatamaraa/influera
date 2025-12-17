@extends("layouts.register-layout")

@section("title", "Register - Create Digital DNA")

@section("content")

  <div class="mb-6 text-center">
    <h1 class="mb-2 text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">
      Create your digital DNA
    </h1>
    <p class="max-w-md mx-auto text-slate-600 text-sm md:text-base">
      Your Digital DNA helps match you with the perfect collaborations.
    </p>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-3xl w-full mx-auto">
    {{-- Business Card --}}
    <div
      class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-lg hover:border-primary/20
             transition-all duration-300 group flex flex-col items-center text-center"
    >
      <div
        class="w-12 h-12 mb-4 bg-[#a78bfa] rounded-xl flex items-center justify-center text-white
               transition-transform duration-300 group-hover:scale-110"
      >
        <img src="/images/icons/building-office.png" class="w-6 h-6 object-contain" />
      </div>

      <h3 class="text-lg font-bold text-slate-900 mb-1">I'm Business</h3>
      <p class="text-slate-500 text-xs mb-5 max-w-[220px]">
        Find the perfect creators to represent your brand and products.
      </p>

      <ul class="space-y-2 text-xs text-slate-600 text-left w-full max-w-[220px] mb-5">
        <li class="flex items-center gap-2">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          Match with aligned creators
        </li>

        <li class="flex items-center gap-2">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          Post collaboration opportunities
        </li>

        <li class="flex items-center gap-2">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          Track campaign performance
        </li>
      </ul>

      <a
        href="{{ route('register-business') }}"
        class="w-full bg-[#a78bfa] hover:bg-[#93c5fd] text-white font-semibold py-2.5 px-4 rounded-xl
               shadow-md shadow-primary/20 text-xs transition-all mt-auto"
      >
        Grow your business
      </a>
    </div>

    {{-- Influencer Card --}}
    <div
      class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-lg hover:border-primary/20
             transition-all duration-300 group flex flex-col items-center text-center"
    >
      <div
        class="w-12 h-12 mb-4 bg-primary rounded-xl flex items-center justify-center text-white
               transition-transform duration-300 group-hover:scale-110"
      >
        <img src="/images/icons/user.png" class="w-6 h-6 object-contain" />
      </div>

      <h3 class="text-lg font-bold text-slate-900 mb-1">I'm an Influencer</h3>
      <p class="text-slate-500 text-xs mb-5 max-w-[220px]">
        Connect with brands that align with your style and audience.
      </p>

      <ul class="space-y-2 text-xs text-slate-600 text-left w-full max-w-[220px] mb-5">
        <li class="flex items-center gap-2">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          Find perfect brand matches
        </li>

        <li class="flex items-center gap-2">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          Apply to relevant opportunities
        </li>

        <li class="flex items-center gap-2">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          Showcase your unique style
        </li>
      </ul>

      <a
        href="{{ route('register-influence') }}"
        class="w-full bg-primary hover:bg-primary/90 text-white font-semibold py-2.5 px-5 rounded-xl
               shadow-md shadow-primary/20 text-xs transition-all mt-auto"
      >
        Grow your influence
      </a>
    </div>
  </div>

  <div class="mt-8 flex items-center justify-center gap-2 text-slate-500 text-[11px] md:text-xs">
    <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
         class="text-primary/50">
      <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/>
    </svg>
    Your DNA profile helps us find your perfect matches
  </div>

  <div class="mt-3 text-center text-[11px] text-slate-600">
    Already have an account?
    <a href="{{ route('login') }}" class="font-semibold text-primary hover:underline">
      Log In
    </a>
  </div>

@endsection
