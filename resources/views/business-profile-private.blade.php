@extends("layouts.loggedin-layout")

@section("title", "Influentia - My Business Profile")

@section("content")
  @php
    use Illuminate\Support\Str;

    $companyName = $brand->company_name ?? (auth()->user()->name ?? "Your Business");
    $location = $brand->location ?? "Location not set";
    $industry = $brand->industry ?? "Industry not set";

    $parts = explode(" ", trim($companyName));
    $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ""));

    if (! empty($brand->company_logo_path)) {
      $p = ltrim($brand->company_logo_path, "/");
      $hasLogo = true;

      if (Str::startsWith($p, ["http://", "https://", "images/"])) {
        $logo = asset($p);
      } else {
        $logo = asset("storage/" . $p);
      }
    } else {
      $hasLogo = false;
    }

    if (! empty($brand->company_cover_path)) {
      $p = ltrim($brand->company_cover_path, "/");

      if (Str::startsWith($p, ["http://", "https://", "images/"])) {
        $cover = asset($p);
      } else {
        $cover = asset("storage/" . $p);
      }
    } else {
      $cover = null;
    }

    $values = json_decode($brand->brand_values ?? "[]", true) ?: [];
  @endphp

  {{-- HEADER --}}
  <div class="mb-20 relative">
    <div
      class="overflow-hidden h-64 w-full bg-slate-900 rounded-2xl relative md:h-80"
    >
      @if ($cover)
        <img src="{{ $cover }}" class="object-cover w-full h-full" />
        <div class="bg-black/30 absolute inset-0"></div>
      @else
        <div class="bg-slate-900 absolute inset-0"></div>
        <div
          class="w-48 h-48 bg-slate-700/50 rounded-full absolute -left-16 top-10 blur-2xl"
        ></div>
        <div
          class="w-60 h-60 bg-indigo-600/40 rounded-full absolute right-0 bottom-0 blur-3xl"
        ></div>

        <div
          class="flex px-8 pb-6 absolute inset-0 items-end justify-start md:px-12 md:items-center"
        >
          <div>
            <p
              class="text-xs font-semibold tracking-wide text-indigo-200 uppercase"
            >
              Brand space
            </p>
            <p class="mt-1 text-lg font-semibold text-slate-100">
              Make your business stand out with a strong profile.
            </p>
          </div>
        </div>
      @endif
    </div>

    {{-- BAR --}}
    <div
      class="flex flex-col px-6 absolute -bottom-20 left-0 right-0 items-end justify-between gap-4 md:flex-row md:px-12 md:items-center"
    >
      <div class="flex z-20 items-end gap-6">
        <div
          class="flex overflow-hidden w-32 h-32 bg-white rounded-full border-4 border-white shadow-lg items-center justify-center"
        >
          @if ($hasLogo)
            <img src="{{ $logo }}" class="object-cover w-full h-full" />
          @else
            <span class="text-3xl font-extrabold text-slate-700">
              {{ $initials }}
            </span>
          @endif
        </div>

        <div class="pb-2">
          <h1 class="text-3xl font-extrabold text-slate-900">
            {{ $companyName }}
          </h1>

          <div class="flex mt-1 text-slate-500 text-sm font-medium gap-4">
            <span class="flex items-center gap-1">
              <svg
                width="14"
                height="14"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0Z"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
              {{ $location }}
            </span>

            <span class="flex items-center gap-1">
              <svg
                width="14"
                height="14"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <path d="M3 19v-6l6-3v6l-6 3z"></path>
                <path d="M21 19v-6l-6-3v6l6 3z"></path>
                <path d="M9 10V5l3-2 3 2v5"></path>
              </svg>

              {{ $industry }}
            </span>
          </div>
        </div>
      </div>

      {{-- ACTIONS --}}
      <div class="flex pt-10 pb-2 gap-3">
        <button
          class="py-2 px-6 text-white font-bold bg-primary rounded-lg shadow-lg shadow-primary/20 hover:bg-primary/90"
        >
          Edit Profile
        </button>

        <button
          onclick="window.location.href='{{ route("business.profile.public", auth()->id()) }}'"
          class="py-2 px-6 text-slate-700 font-bold bg-white rounded-lg border border-slate-200 shadow-sm hover:bg-slate-50"
        >
          Preview Public Profile
        </button>
      </div>
    </div>
  </div>

  {{-- MAIN GRID --}}
  <div class="grid grid-cols-1 pt-10 gap-8 lg:grid-cols-3">
    {{-- LEFT --}}
    <div class="space-y-8 lg:col-span-2">
      {{-- ABOUT --}}
      <section
        class="p-6 bg-white rounded-2xl border border-slate-100 shadow-sm"
      >
        <div class="flex justify-between items-start gap-4">
          <div>
            <h3 class="mb-3 text-xl font-bold text-slate-900">
              About Your Business
            </h3>
            <p class="text-slate-600 text-sm leading-relaxed">
              {{ $brand->about ?? "Add a short description about your brand, mission and what kind of collaborations you seek." }}
            </p>
          </div>

          <button class="text-xs font-semibold text-primary">Edit</button>
        </div>
      </section>

      {{-- VALUES --}}
      <section
        class="p-6 bg-white rounded-2xl border border-slate-100 shadow-sm"
      >
        <div class="flex justify-between items-start gap-4">
          <div class="w-full">
            <h3 class="mb-3 text-lg font-bold text-slate-900">Brand Values</h3>

            <div class="flex flex-wrap gap-2">
              @forelse ($values as $v))
                <span
                  class="px-4 py-1 text-slate-600 text-xs font-medium bg-slate-100 border border-slate-200 rounded-full"
                >
                  {{ $v }}
                </span>
              @empty
                <p class="text-xs text-slate-400">No values added yet.</p>
              @endforelse
            </div>
          </div>

          <button class="text-xs font-semibold text-primary">Edit</button>
        </div>
      </section>
    </div>

    {{-- RIGHT --}}
    <div class="space-y-6">
      {{-- CONTACT INFO --}}
      <div class="p-6 bg-[#f3e8ff] rounded-2xl border border-[#e9d5ff]">
        <div class="flex mb-3 justify-between items-start">
          <h3 class="text-base font-bold text-slate-900">
            Contact Information
          </h3>
          <button class="text-xs font-semibold text-primary">Edit</button>
        </div>

        <ul class="space-y-3 text-sm text-slate-700">
          {{-- EMAIL --}}
          <li class="flex items-center gap-3">
            <svg
              width="16"
              height="16"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <rect x="3" y="5" width="18" height="14" rx="2"></rect>
              <path d="M3 7l9 6 9-6"></path>
            </svg>
            {{ auth()->user()->email }}
          </li>

          {{-- WEBSITE --}}
          <li class="flex items-center gap-3">
            <svg
              width="16"
              height="16"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <circle cx="12" cy="12" r="10"></circle>
              <line x1="2" y1="12" x2="22" y2="12"></line>
              <path d="M12 2a15 15 0 0 1 0 20"></path>
              <path d="M12 2a15 15 0 0 0 0 20"></path>
            </svg>
            {{ $brand->website ?? "website.com" }}
          </li>

          {{-- PHONE --}}
          <li class="flex items-center gap-3">
            <svg
              width="16"
              height="16"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path
                d="M22 16.92v2a2 2 0 0 1-2.18 2
                         19.8 19.8 0 0 1-8.63-3.07
                         19.4 19.4 0 0 1-6-6
                         A19.8 19.8 0 0 1 2.1 5.18
                         2 2 0 0 1 4.11 3h2
                         a2 2 0 0 1 2 1.72
                         12.2 12.2 0 0 0 .7 2.81
                         2 2 0 0 1-.45 2.11L7.9 11.1
                         a16 16 0 0 0 6 6l1.46-1.46
                         a2 2 0 0 1 2.11-.45
                         12.2 12.2 0 0 0 2.81.7
                         A2 2 0 0 1 22 16.92z"
              ></path>
            </svg>
            {{ $brand->phone ?? "(+000) 00-000-000" }}
          </li>
        </ul>
      </div>

      {{-- COMPANY DETAILS --}}
      <div class="p-6 bg-white rounded-2xl border border-cyan-100 shadow-sm">
        <div class="flex mb-3 justify-between items-start">
          <h3 class="text-base font-bold text-slate-900">Company Details</h3>
          <button class="text-xs font-semibold text-primary">Edit</button>
        </div>

        <ul class="space-y-3 text-sm text-slate-700">
          {{-- FOUNDED --}}
          <li class="flex items-center gap-3">
            <svg
              width="16"
              height="16"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <rect x="3" y="4" width="18" height="18" rx="2"></rect>
              <line x1="3" y1="10" x2="21" y2="10"></line>
              <line x1="9" y1="2" x2="9" y2="6"></line>
              <line x1="15" y1="2" x2="15" y2="6"></line>
            </svg>
            Founded {{ $brand->founded_year ?? "—" }}
          </li>

          {{-- TEAM SIZE --}}
          <li class="flex items-center gap-3">
            <svg
              width="16"
              height="16"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <circle cx="9" cy="9" r="3"></circle>
              <circle cx="17" cy="9" r="3"></circle>
              <path d="M4 21v-1a4 4 0 0 1 4-4h2"></path>
              <path d="M14 16h2a4 4 0 0 1 4 4v1"></path>
            </svg>
            {{ $brand->employees ?? "Team size not set" }}
          </li>

          {{-- INDUSTRY --}}
          <li class="flex items-center gap-3">
            <svg
              width="14"
              height="14"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path d="M3 19v-6l6-3v6l-6 3z"></path>
              <path d="M21 19v-6l-6-3v6l6 3z"></path>
              <path d="M9 10V5l3-2 3 2v5"></path>
            </svg>
            {{ $industry }}
          </li>
        </ul>
      </div>
    </div>
  </div>
@endsection
