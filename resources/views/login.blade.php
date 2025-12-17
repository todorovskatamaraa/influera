@extends("layouts.register-layout")

@section("title", "Influera - Log In")

@section("content")
    <div
      class="flex flex-col w-full max-w-[420px] p-8 text-center bg-white border border-slate-200 rounded-2xl shadow-sm items-center justify-center"
    >
      <div
        class="flex w-15 h-15 mb-3 rounded-xl items-center justify-center"
      >
        <img
          src="{{ asset("images/icons/logo.png") }}"
          alt="Logo"
          class="object-contain"
        />
      </div>

      <h1 class="mb-6 text-xl font-bold text-slate-900">Log In</h1>

      <form
        method="POST"
        action="{{ route("login.store") }}"
        class="flex flex-col w-full items-center"
      >
        @csrf

        <div class="w-full space-y-4 mb-5 text-left">
          {{-- Email --}}
          <div>
            <label class="block mb-1 ml-1 text-xs font-medium text-slate-700">
              Email
            </label>
            <input
              type="email"
              name="email"
              value="{{ old("email") }}"
              required
              autocomplete="email"
              placeholder="Enter your email"
              class="w-full px-3 py-2.5 text-sm rounded-full border border-slate-300 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('
                                          email')  border-red-500 @enderror"
            />
            @error("email")
              <p class="mt-1 ml-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
          </div>

          {{-- Password --}}
          <div>
            <label class="block mb-1 ml-1 text-xs font-medium text-slate-700">
              Password
            </label>
            <input
              type="password"
              name="password"
              required
              autocomplete="current-password"
              placeholder="Enter your password"
              class="w-full px-3 py-2.5 text-sm rounded-full border border-slate-300 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary @error('
                                          password')  border-red-500 @enderror"
            />
            @error("password")
              <p class="mt-1 ml-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
          </div>
        </div>

        {{-- Login button --}}
        <button
          type="submit"
          class="w-28 py-2 mb-5 text-white font-bold text-xs bg-[#6d28d9] rounded-lg shadow-lg shadow-primary/20 transition-all hover:bg-[#5b21b6]"
        >
          Login
        </button>
      </form>

      {{-- Forgot password --}}
      <a
        href="#"
        class="mb-5 text-[11px] font-medium text-slate-600 hover:text-primary hover:underline"
      >
        Forgot password? Click here to reset.
      </a>

      {{-- Divider --}}
      <div class="flex w-full mb-5 items-center gap-3">
        <div class="flex-1 h-[1px] bg-slate-200"></div>
        <span class="text-[10px] text-slate-500 font-medium">
          or continue with
        </span>
        <div class="flex-1 h-[1px] bg-slate-200"></div>
      </div>

      {{-- Social --}}
      <div class="flex mb-6 gap-3">
        <button class="transition-transform hover:scale-110">
          <svg class="w-5 h-5" viewBox="0 0 24 24">
            <path
              d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
              fill="#4285F4"
            />
            <path
              d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
              fill="#34A853"
            />
            <path
              d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
              fill="#FBBC05"
            />
            <path
              d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
              fill="#EA4335"
            />
          </svg>
        </button>

        <button class="transition-transform hover:scale-110">
          <svg
            class="w-5 h-5"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <rect
              x="2"
              y="2"
              width="20"
              height="20"
              rx="5"
              ry="5"
              class="text-[#E4405F] stroke-[#E4405F]"
            ></rect>
            <path
              d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"
              class="text-[#E4405F] stroke-[#E4405F]"
            ></path>
            <line
              x1="17.5"
              y1="6.5"
              x2="17.51"
              y2="6.5"
              class="text-[#E4405F] stroke-[#E4405F]"
            ></line>
          </svg>
        </button>

        <button class="transition-transform hover:scale-110">
          <svg class="w-5 h-5 fill-black" viewBox="0 0 24 24">
            <path
              d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"
            />
          </svg>
        </button>

        <button class="transition-transform hover:scale-110">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="#0077b5">
            <path
              d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"
            />
          </svg>
        </button>
      </div>

      <p class="text-[11px] text-slate-500">
        Don’t have an account?
        <a
          href="{{ route("register") }}"
          class="font-bold text-slate-900 hover:underline"
        >
          Sign Up
        </a>
      </p>
    </div>
@endsection
