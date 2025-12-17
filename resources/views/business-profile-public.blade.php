@extends("layouts.loggedin-layout")

@section("title", "Influentia - Brand Profile")

@section("content")
  @php
    $cover = $cover ?? asset("images/default-cover.jpg");
    $logo = $logo ?? asset("images/default-avatar.jpg");

    $name = $brand->company_name ?? "Brand";
    $location = $brand->location ?? "Unknown";
    $about = $brand->about ?? "No description yet.";
    $industry = $brand->industry ?? "Industry";
    $website = $brand->website ?? "#";

    $matchScoreLocal = $matchScoreLocal ?? ($matchScore ?? null);

    $angle = $angle ?? 0;

    $matchTitle = $matchTitle ?? "DNA Match unavailable";
    $matchSubtitle = $matchSubtitle ?? "Sign in as an influencer to see how well you match this brand.";

    $valuesMatch = $valuesMatch ?? null;
    $audienceMatch = $audienceMatch ?? null;
    $contentMatch = $contentMatch ?? null;

    $matchBreakdown = $matchBreakdown ?? [
      ["label" => "Niche Match", "value" => $valuesMatch],
      ["label" => "Audience Age Match", "value" => $audienceMatch],
      ["label" => "Audience Gender Match", "value" => $contentMatch],
    ];
  @endphp

  <div class="mb-20 relative">
    <div class="overflow-hidden h-64 w-full rounded-2xl relative md:h-80">
      <div
        class="z-10 bg-gradient-to-t from-black/50 to-transparent absolute inset-0"
      ></div>
      <img
        src="{{ $cover }}"
        class="object-cover w-full h-full"
        alt="Cover image"
      />
    </div>

    <!-- Profile Info Bar -->
    <div
      class="flex flex-col px-6 absolute -bottom-20 left-0 right-0 items-end justify-between gap-4 md:flex-row md:px-12 md:items-center"
    >
      <div class="flex z-20 items-end gap-6 relative">
        <!-- Avatar -->
        <div
          class="overflow-hidden w-32 h-32 bg-black rounded-full border-4 border-white shadow-lg shrink-0"
        >
          <img
            src="{{ $logo }}"
            class="object-cover w-full h-full"
            alt="Logo"
          />
        </div>

        <div class="pb-2">
          <h1 class="text-3xl font-extrabold text-slate-900">{{ $name }}</h1>

          <div
            class="flex mt-1 text-slate-500 text-sm font-medium items-center gap-4"
          >
            {{-- LOCATION --}}
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
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 1 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
              {{ $location }}
            </span>

            {{-- INDUSTRY --}}
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

            {{-- WEBSITE --}}
            <a
              href="{{ $website }}"
              target="_blank"
              class="flex transition-colors items-center gap-1 hover:text-primary"
            >
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
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="2" y1="12" x2="22" y2="12"></line>
                <path d="M12 2a15 15 0 0 1 0 20"></path>
                <path d="M12 2a15 15 0 0 0 0 20"></path>
              </svg>
              Website
            </a>
          </div>
        </div>
      </div>

      <!-- Actions -->
      <div class="flex pb-2 pt-10 gap-3">
        @auth
          @if (auth()->id() !== $user->id)
            <form
              method="POST"
              action="{{ route("messages.contact", $user) }}"
            >
              @csrf
              <button
                type="submit"
                class="py-2 px-6 text-white font-bold bg-primary rounded-lg shadow-lg shadow-primary/20 transition-all hover:bg-primary/90"
              >
                Contact
              </button>
            </form>
          @endif
        @endauth

        <button
          class="py-2 px-6 text-slate-700 font-bold bg-white rounded-lg border border-slate-200 shadow-sm transition-all hover:bg-slate-50"
        >
          Share Profile
        </button>
      </div>
    </div>
  </div>

  <!-- MAIN CONTENT -->
  <div class="grid grid-cols-1 pt-10 gap-8 lg:grid-cols-3">
    <!-- LEFT CONTENT -->
    <div class="space-y-8 lg:col-span-2">
      <div
        class="flex flex-col p-6 bg-gradient-to-r from-[#f3e8ff] to-[#e0f2fe] rounded-2xl border border-slate-100 shadow-sm items-center gap-8 md:flex-row"
      >
        <div class="w-32 h-32 relative shrink-0">
          <div
            class="flex w-full h-full rounded-full items-center justify-center"
            style="
              background: conic-gradient(
                hsl(262 83% 58%) {{ $angle }}deg,
                #e2e8f0 0deg
              );
            "
          >
            <div
              class="flex w-28 h-28 bg-white rounded-full items-center justify-center"
            >
              <span class="text-3xl font-extrabold text-slate-900">
                @if (! is_null($matchScoreLocal))
                  {{ $matchScoreLocal }}%
                @else
                  —
                @endif
              </span>
            </div>
          </div>
        </div>

        <div class="flex-1 w-full">
          <h2 class="mb-1 text-xl font-bold text-slate-900">
            Your Match Score!
          </h2>
          <p class="mb-1 text-slate-900 font-bold text-lg">
            {{ $matchTitle }}
          </p>
          <p class="mb-6 text-slate-600 text-sm">{{ $matchSubtitle }}</p>

          <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
            @foreach ($matchBreakdown as $item)
              <div
                class="p-3 text-center bg-white/70 border border-white/60 rounded-xl shadow-xs"
              >
                <p
                  class="text-[11px] font-bold text-slate-600 tracking-wide uppercase"
                >
                  {{ $item["label"] }}
                </p>
                <p class="text-base font-extrabold text-slate-900">
                  @if (! is_null($item["value"]))
                    {{ $item["value"] }}%
                  @else
                    —
                  @endif
                </p>
              </div>
            @endforeach
          </div>
        </div>
      </div>

      <!-- TABS  -->
      <div class="flex w-fit p-1 bg-[#f3f4f6] rounded-lg gap-1">
        <button
          class="px-6 py-1.5 text-white font-medium text-sm bg-primary rounded-md shadow-sm"
        >
          About
        </button>
        <button
          class="px-6 py-1.5 text-slate-600 font-medium text-sm rounded-md hover:bg-white hover:shadow-sm"
        >
          Jobs
        </button>
        <button
          class="px-6 py-1.5 text-slate-600 font-medium text-sm rounded-md hover:bg-white hover:shadow-sm"
        >
          Collaborations
        </button>
      </div>

      <!-- ABOUT -->
      <section>
        <h3 class="mb-3 text-xl font-bold text-slate-900">About</h3>
        <p class="text-slate-600 leading-relaxed">
          {{ $about }}
        </p>
      </section>

      <!-- BRAND VALUES -->
      <section>
        <h3 class="mb-3 text-lg font-bold text-slate-900">Brand Values</h3>

        @php
          $values = json_decode($brand->brand_values ?? "[]", true);
        @endphp

        <div class="flex flex-wrap gap-2">
          @forelse ($values as $value)
            <span
              class="px-4 py-1 text-slate-600 text-xs font-medium bg-slate-100 rounded-full border border-slate-200"
            >
              {{ $value }}
            </span>
          @empty
            <p class="text-xs text-slate-500">No values added yet.</p>
          @endforelse
        </div>
      </section>
    </div>

    <!-- RIGHT SIDEBAR -->
    <div class="space-y-6">
      <!-- Contact -->
      <div class="p-6 bg-[#f3e8ff] rounded-2xl border border-[#e9d5ff]">
        <h3 class="mb-4 text-base font-bold text-slate-900">
          Contact Information
        </h3>

        <ul class="space-y-3 mb-4 text-sm text-slate-700">
          <!-- EMAIL -->
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
            {{ $user->email }}
          </li>

          <!-- WEBSITE -->
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

            <a
              href="{{ $website }}"
              target="_blank"
              class="hover:text-primary"
            >
              {{ $website }}
            </a>
          </li>
        </ul>

        @auth
          @if (auth()->id() !== $user->id)
            <form
              method="POST"
              action="{{ route("messages.contact", $user) }}"
            >
              @csrf
              <button
                type="submit"
                class="inline-flex w-full px-4 py-2 text-white text-xs font-semibold bg-primary rounded-lg items-center justify-center gap-2 hover:bg-primary/90"
              >
                Contact Brand
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
                  <path d="M22 2 11 13"></path>
                  <path d="M22 2 15 22 11 13 2 9l20-7z"></path>
                </svg>
              </button>
            </form>
          @endif
        @endauth
      </div>

      <!-- Company Details -->
      <div class="p-6 bg-white rounded-2xl border border-cyan-100 shadow-sm">
        <h3 class="mb-4 text-base font-bold text-slate-900">Company Details</h3>

        <ul class="space-y-3 text-sm text-slate-700">
          <!-- INDUSTRY -->
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
            Industry: {{ $industry }}
          </li>

          <!-- LOCATION -->
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
              <path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 1 1 18 0z"></path>
              <circle cx="12" cy="10" r="3"></circle>
            </svg>
            Location: {{ $location }}
          </li>

          <!-- EMPLOYEES -->
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
            Employees: 10–50
          </li>
        </ul>
      </div>

      <div class="mt-2">
        <x-public-rating :user="$user" />
      </div>
    </div>
  </div>
@endsection
