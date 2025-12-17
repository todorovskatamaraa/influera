@extends(auth()->check() ? "layouts.loggedin-layout" : "layouts.guest-layout")

@section("title", "Influentia - Discover")

@section("content")
  @php
    $isGuest = ! auth()->check();
    $authUser = auth()->user();
    $role = optional($authUser)->role;
    $dnaActiveLocal = $dnaActive ?? false;
    $dnaScoreLocal = $dnaScore ?? null;
    $sort = request("sort");
  @endphp

  @php
    if (! function_exists("resolve_discover_media")) {
      function resolve_discover_media(?string $path): ?string
      {
        if (! $path) {
          return null;
        }

        if (\Illuminate\Support\Str::startsWith($path, ["http://", "https://"])) {
          return $path;
        }

        if (\Illuminate\Support\Str::startsWith($path, "/")) {
          return $path;
        }

        if (\Illuminate\Support\Facades\Storage::disk("public")->exists($path)) {
          return \Illuminate\Support\Facades\Storage::url($path);
        }

        return asset($path);
      }
    }
  @endphp

  <!-- Header Section -->
  <div class="mb-8">
    <h1
      class="mb-2 text-3xl font-extrabold text-slate-900 tracking-tight md:text-4xl"
    >
      Discover
    </h1>
    <p class="text-slate-500 text-lg">
      Discover businesses based on your likings
    </p>
  </div>

  <!-- DNA Match Banner -->
  <div
    class="flex flex-col overflow-hidden w-full p-4 mb-8 bg-gradient-to-r from-[#eef2ff] to-[#f3e8ff] border border-[#e0e7ff] rounded-2xl items-center justify-between gap-4 relative group md:flex-row md:p-6">
    <div class="flex z-10 items-start gap-4">
      <div
        class="hidden p-3 text-primary bg-white rounded-xl shadow-sm sm:block"
      >
        <svg
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path
            d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"
          />
        </svg>
      </div>

      @if (! $dnaActiveLocal)
        {{-- BEFORE DNA MATCH --}}
        <div>
          <h3 class="font-bold text-slate-900 text-lg">Perform a DNA match!</h3>
          <p class="text-slate-600 text-sm">
            Find {{ $role === "brand" ? "influencers" : "brands" }} who match
            your DNA—perfectly.
          </p>
          @if ($isGuest)
            <p class="mt-1 text-xs text-slate-600">
              Log in to run a DNA match and see personalized compatibility
              scores.
            </p>
          @endif
        </div>
      @else
        {{-- AFTER DNA MATCH --}}
        <div class="flex flex-col gap-2">
          <h3 class="font-bold text-slate-900 text-lg">DNA match complete</h3>
          <p class="text-slate-600 text-sm">
            We reordered your best-matching
            {{ $role === "brand" ? "influencers" : "brands" }}
            based on niche, audience and gender.
          </p>
        </div>
      @endif
    </div>

    @if (! $dnaActiveLocal)
      {{-- BUTTON: RUN DNA MATCH --}}

      @if ($isGuest)
        <a
          href="{{ route("login") }}"
          class="z-10 flex px-6 py-2 text-white font-bold text-sm bg-primary rounded-md shadow-lg shadow-primary/25 transition-colors hover:bg-primary/90 items-center"
        >
          Log in to run DNA Match
        </a>
      @else
        <form method="GET" action="{{ route("discover") }}" class="z-10">
          @foreach (request()->except(["dna", "sort"]) as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}" />
          @endforeach

          <input type="hidden" name="dna" value="1" />
          <input type="hidden" name="sort" value="match" />

          <button
            type="submit"
            class="flex px-6 py-2 text-white font-bold bg-primary rounded-md shadow-lg shadow-primary/25 transition-colors hover:bg-primary/90 items-center"
          >
            DNA Match
          </button>
        </form>
      @endif
    @else
      <div class="flex z-10 items-center gap-4">
        <div class="w-16 h-16 relative shrink-0">
          <div
            class="flex w-full h-full rounded-full items-center justify-center"
            style="
              background: conic-gradient(
                #4f46e5 {{ ($dnaScoreLocal ?? 0) * 3.6 }}deg,
                #e5e7eb 0deg
              );
            "
          >
            <div
              class="flex w-12 h-12 bg-white rounded-full shadow-inner items-center justify-center"
            >
              <span class="text-sm font-extrabold text-slate-900">
                @if ($dnaScoreLocal)
                  {{ $dnaScoreLocal }}%
                @else
                  —
                @endif
              </span>
            </div>
          </div>
        </div>

        <form method="GET" action="{{ route("discover") }}">
          @foreach (request()->except(["dna", "sort"]) as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}" />
          @endforeach

          <input type="hidden" name="sort" value="newest" />

          <button
            type="submit"
            class="px-4 py-2 text-xs font-bold text-slate-700 bg-white border border-slate-200 rounded-lg transition-colors hover:bg-slate-50"
          >
            Clear DNA Match
          </button>
        </form>
      </div>
    @endif

    <div
      class="w-40 h-40 bg-primary/10 rounded-full transition-all absolute -right-10 -top-10 blur-3xl group-hover:bg-primary/20 duration-500"
    ></div>
  </div>

  <form
    method="GET"
    action="{{ route("discover") }}"
    class="flex flex-col z-40 w-full mb-8 gap-4 md:flex-row"
  >
    @foreach (request()->except(["sort", "page", "search"]) as $key => $value)
      <input type="hidden" name="{{ $key }}" value="{{ $value }}" />
    @endforeach

    {{-- SEARCH --}}
    <div class="flex-1 relative">
      <input
        type="text"
        name="search"
        value="{{ request("search") }}"
        placeholder="Search"
        class="w-full pl-10 pr-4 py-2.5 text-sm bg-white border border-slate-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
      />
      <svg
        class="text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"
        width="18"
        height="18"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
      >
        <circle cx="11" cy="11" r="8"></circle>
        <path d="m21 21-4.3-4.3"></path>
      </svg>
    </div>

    {{-- SORTING --}}
    <div class="flex w-full gap-2 md:w-auto">
      <div class="w-full relative md:w-[180px]">
        <select
          name="sort"
          class="w-full h-[42px] px-3 text-sm text-slate-700 bg-white border border-slate-200 rounded-xl cursor-pointer shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
          onchange="
                    if (this.value === 'match') {
                        let dnaInput = document.createElement('input');
                        dnaInput.type = 'hidden';
                        dnaInput.name = 'dna';
                        dnaInput.value = '1';
                        this.form.appendChild(dnaInput);
                    }
                    this.form.submit();
                "
        >
          <option disabled {{ ! $sort ? "selected" : "" }}>Sorting</option>
          <option value="match" {{ $sort === "match" ? "selected" : "" }}>
            Match Score
          </option>
          <option value="newest" {{ $sort === "newest" ? "selected" : "" }}>
            Newest
          </option>
        </select>

        <svg
          class="text-slate-400 pointer-events-none absolute right-3 top-1/2 -translate-y-1/2"
          width="14"
          height="14"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path d="m6 9 6 6 6-6" />
        </svg>
      </div>

      <button
        type="button"
        class="flex h-[42px] px-4 text-slate-700 font-medium text-sm bg-white border border-slate-200 rounded-xl shadow-sm transition-colors appearance-none hover:bg-slate-50 items-center gap-2"
      >
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
          <line x1="4" y1="21" x2="4" y2="14"></line>
          <line x1="4" y1="10" x2="4" y2="3"></line>

          <line x1="12" y1="21" x2="12" y2="12"></line>
          <line x1="12" y1="8" x2="12" y2="3"></line>

          <line x1="20" y1="21" x2="20" y2="16"></line>
          <line x1="20" y1="12" x2="20" y2="3"></line>

          <line x1="1" y1="14" x2="7" y2="14"></line>
          <line x1="9" y1="8" x2="15" y2="8"></line>
          <line x1="17" y1="16" x2="23" y2="16"></line>
        </svg>
        Filters
      </button>
    </div>
  </form>

  <!-- Toggle -->
  <div class="flex w-fit p-1 mb-8 bg-slate-100/50 rounded-xl gap-1">
    <button
      type="button"
      data-discover-tab="influencers"
      class="px-6 py-2 text-slate-600 font-medium text-sm rounded-lg transition-colors discover-tab hover:bg-slate-200/50"
    >
      Influencers
    </button>
    <button
      type="button"
      data-discover-tab="businesses"
      class="px-6 py-2 text-white font-medium text-sm bg-primary rounded-lg shadow-sm discover-tab"
    >
      Businesses
    </button>
  </div>

  <div class="container mx-auto px-6 py-8 md:px-12 lg:px-24">
    {{-- GRID: INFLUENCERS --}}
    <div
      id="discover-influencers"
      class="grid grid-cols-1 hidden gap-6 sm:grid-cols-2 lg:grid-cols-3"
    >
      @forelse ($influencers as $profile)
        @php
          $user = $profile->user;
          $cover = resolve_discover_media($profile->cover_path);

          $niches = is_array($profile->niches) ? $profile->niches : json_decode($profile->niches ?? "[]", true) ?? [];
          $primaryNiche = $niches[0] ?? "Creator";

          $followers = $profile->socialAccounts->sum("followers") ?? 0;
          $topAccount = $profile->socialAccounts->sortByDesc("followers")->first();
          $topPlatform = optional($topAccount)->platform ?? "Instagram";

          $isOwn = $authUser && $authUser->id === $user->id;
          $profileUrl = $isOwn
            ? route("influencer.profile.private")
            : route("influencer.profile.public", ["user" => $user->id]);

          $canContact = ! $isGuest && ! $isOwn;
          $contactUrl = $canContact ? route("messages.start", ["user" => $user->id]) : null;

          $matchScore = $profile->match_score ?? null;
        @endphp

        <div
          class="overflow-hidden bg-white rounded-2xl border border-slate-100 shadow-sm transition-all hover:shadow-md"
        >
          <div class="h-48 w-full relative">
            @if ($cover)
              <img
                src="{{ $cover }}"
                alt="{{ $user->name }} cover"
                class="object-cover w-full h-full"
              />
            @else
              <div
                class="flex w-full h-full text-slate-400 text-xs bg-gradient-to-br from-slate-100 to-slate-200 items-center justify-center"
              >
                No cover image
              </div>
            @endif
            <div
              class="px-2 py-1 text-xs font-bold text-primary bg-white/90 rounded-md border border-primary/10 absolute top-3 right-3 backdrop-blur"
            >
              @if ($matchScore)
                @if ($role === "influencer")
                  {{ $matchScore }}%
                @else
                  {{ $matchScore }}% Match
                @endif
              @else
                @if ($role === "influencer")
                  &nbsp;
                @else
                  Match
                @endif
              @endif
            </div>
          </div>

          <div class="p-5">
            <div class="flex mb-3 justify-between items-start">
              <div>
                <h3 class="font-bold text-lg text-slate-900">
                  {{ $user->name }}
                </h3>
                <p class="text-xs text-slate-500 font-medium">
                  {{ $primaryNiche }}
                </p>
              </div>
            </div>

            <p class="mb-4 text-xs text-slate-600 line-clamp-2">
              {{ $profile->previous_collaborations ?: "Influencer focused on authentic content and community engagement." }}
            </p>

            <div
              class="grid grid-cols-3 mb-5 p-2 bg-slate-50 rounded-lg border border-slate-100 gap-2"
            >
              <div class="text-center border-r border-slate-200">
                <p class="mb-0.5 text-[10px] font-bold text-slate-500">
                  Audience
                </p>
                <p class="text-xs font-bold text-slate-900">
                  {{ number_format($followers) }}
                </p>
              </div>
              <div class="text-center border-r border-slate-200">
                <p class="mb-0.5 text-[10px] font-bold text-slate-500">
                  Engagement
                </p>
                <p class="text-xs font-bold text-slate-900">
                  {{ $profile->engagement_rate ? $profile->engagement_rate . "%" : "N/A" }}
                </p>
              </div>
              <div class="text-center">
                <p class="mb-0.5 text-[10px] font-bold text-slate-500">
                  Top Platform
                </p>
                <p class="text-xs font-bold text-slate-900">
                  {{ ucfirst($topPlatform) }}
                </p>
              </div>
            </div>

            <div class="flex gap-3">
              @if ($isGuest)
                <button
                  class="flex-1 py-2 text-xs font-bold text-slate-700 rounded-lg border border-slate-200 transition-colors hover:bg-slate-50"
                  onclick="window.location.href='{{ route("login") }}'"
                >
                  Log in to view profile
                </button>
                <button
                  class="flex-1 py-2 text-xs font-bold text-white bg-primary rounded-lg transition-colors shadow-sm shadow-primary/20 hover:bg-primary/90"
                  onclick="window.location.href='{{ route("login") }}'"
                >
                  Log in to invite
                </button>
              @else
                <button
                  class="flex-1 py-2 text-xs font-bold text-slate-700 rounded-lg border border-slate-200 transition-colors hover:bg-slate-50"
                  onclick="window.location.href='{{ $profileUrl }}'"
                >
                  View Profile
                </button>

                @if ($canContact)
                  <button
                    class="flex-1 py-2 text-xs font-bold text-white bg-primary rounded-lg transition-colors shadow-sm shadow-primary/20 hover:bg-primary/90"
                    onclick="window.location.href='{{ $contactUrl }}'"
                  >
                    Invite to Campaign
                  </button>
                @else
                  <button
                    class="flex-1 py-2 text-xs font-bold text-white bg-primary/60 rounded-lg cursor-not-allowed"
                    disabled
                  >
                    Invite to Campaign
                  </button>
                @endif
              @endif
            </div>
          </div>
        </div>
      @empty
        <p class="text-xs text-slate-500 col-span-full">
          No influencers found.
        </p>
      @endforelse
    </div>

    {{-- GRID: BUSINESSES --}}
    <div
      id="discover-businesses"
      class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3"
    >
      @forelse ($businesses as $brand)
        @php
          $brandUser = $brand->user;
          $isOwnBrand = $authUser && $authUser->id === optional($brandUser)->id;
          $brandProfileUrl = $isOwnBrand
            ? route("business.profile.private")
            : route("business.profile.public", ["user" => $brandUser->id]);

          $canContactBrand = ! $isGuest && ! $isOwnBrand && $brandUser;
          $brandContactUrl = $canContactBrand ? route("messages.start", ["user" => $brandUser->id]) : null;

          $matchScoreBrand = $brand->match_score ?? null;
        @endphp

        <div
          class="overflow-hidden bg-white rounded-2xl border border-slate-100 shadow-sm transition-all hover:shadow-md"
        >
          <div class="h-48 w-full relative">
            @if ($brand->company_cover_path)
              <img
                src="{{ asset($brand->company_cover_path) }}"
                alt="{{ $brand->company_name }}"
                class="object-cover w-full h-full"
              />
            @else
              <div
                class="flex w-full h-full text-slate-400 text-xs bg-slate-100 items-center justify-center"
              >
                No cover image
              </div>
            @endif
            <div
              class="px-2 py-1 text-xs font-bold text-primary bg-white/90 rounded-md border border-primary/10 absolute top-3 right-3 backdrop-blur"
            >
              @if ($matchScoreBrand)
                @if ($role === "brand")
                  {{ $matchScoreBrand }}%
                @else
                  {{ $matchScoreBrand }}% Match
                @endif
              @else
                @if ($role === "brand")
                  &nbsp;
                @else
                  Match
                @endif
              @endif
            </div>
          </div>

          <div class="p-5">
            <div class="flex mb-3 justify-between items-start">
              <div>
                <h3 class="font-bold text-lg text-slate-900">
                  {{ $brand->company_name }}
                </h3>
                <p class="text-xs text-slate-500 font-medium">
                  {{ $brand->location }}
                </p>
              </div>
            </div>

            <p class="mb-4 text-xs text-slate-600 line-clamp-2">
              {{ $brand->about }}
            </p>

            <div
              class="grid grid-cols-3 mb-5 p-2 bg-slate-50 rounded-lg border border-slate-100 gap-2"
            >
              <div class="text-center border-r border-slate-200">
                <p class="mb-0.5 text-[10px] font-bold text-slate-500">
                  Industry
                </p>
                <p class="text-xs font-bold text-slate-900">
                  {{ $brand->industry }}
                </p>
              </div>
              <div class="text-center border-r border-slate-200">
                <p class="mb-0.5 text-[10px] font-bold text-slate-500">
                  Website
                </p>
                <p class="text-[10px] font-bold text-slate-900 truncate">
                  {{ parse_url($brand->website, PHP_URL_HOST) ?? "—" }}
                </p>
              </div>
              <div class="text-center">
                <p class="mb-0.5 text-[10px] font-bold text-slate-500">
                  Growth
                </p>
                <p class="text-xs font-bold text-slate-900">13%</p>
              </div>
            </div>

            <div class="flex gap-3">
              @if ($isGuest)
                <button
                  class="flex-1 py-2 text-xs font-bold text-slate-700 rounded-lg border border-slate-200 transition-colors hover:bg-slate-50"
                  onclick="window.location.href='{{ route("login") }}'"
                >
                  Log in to view profile
                </button>
                <button
                  class="flex-1 py-2 text-xs font-bold text-white bg-primary rounded-lg transition-colors shadow-sm shadow-primary/20 hover:bg-primary/90"
                  onclick="window.location.href='{{ route("login") }}'"
                >
                  Log in to contact
                </button>
              @else
                <button
                  class="flex-1 py-2 text-xs font-bold text-slate-700 rounded-lg border border-slate-200 transition-colors hover:bg-slate-50"
                  onclick="window.location.href='{{ $brandProfileUrl }}'"
                >
                  View Profile
                </button>

                @if ($canContactBrand)
                  <button
                    class="flex-1 py-2 text-xs font-bold text-white bg-primary rounded-lg transition-colors shadow-sm shadow-primary/20 hover:bg-primary/90"
                    onclick="window.location.href='{{ $brandContactUrl }}'"
                  >
                    Contact
                  </button>
                @else
                  <button
                    class="flex-1 py-2 text-xs font-bold text-white bg-primary/60 rounded-lg cursor-not-allowed"
                    disabled
                  >
                    Contact
                  </button>
                @endif
              @endif
            </div>
          </div>
        </div>
      @empty
        <p class="text-xs text-slate-500 col-span-3">No businesses found.</p>
      @endforelse
    </div>

    @if ($businesses->hasMorePages())
      <div class="flex mt-12 justify-center">
        <form method="GET" action="{{ route("discover") }}">
          @foreach (request()->except("page") as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}" />
          @endforeach

          <input
            type="hidden"
            name="page"
            value="{{ $businesses->currentPage() + 1 }}"
          />

          <button
            type="submit"
            class="px-8 py-4 text-white font-bold bg-primary rounded-xl shadow-xl shadow-primary/20 transition-colors hover:bg-primary/90"
          >
            Load More
          </button>
        </form>
      </div>
    @endif
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const tabs = document.querySelectorAll('.discover-tab');
      const influencersGrid = document.getElementById('discover-influencers');
      const businessesGrid = document.getElementById('discover-businesses');

      const defaultTab = @json($role === "brand" ? "influencers" : "businesses");

      function setActiveTab(active) {
        tabs.forEach((tab) => {
          const target = tab.getAttribute('data-discover-tab');

          if (target === active) {
            tab.classList.add('bg-primary', 'text-white', 'shadow-sm');
            tab.classList.remove('text-slate-600', 'hover:bg-slate-200/50');
          } else {
            tab.classList.remove('bg-primary', 'text-white', 'shadow-sm');
            tab.classList.add('text-slate-600', 'hover:bg-slate-200/50');
          }
        });

        if (active === 'influencers') {
          influencersGrid.classList.remove('hidden');
          businessesGrid.classList.add('hidden');
        } else {
          businessesGrid.classList.remove('hidden');
          influencersGrid.classList.add('hidden');
        }
      }

      tabs.forEach((tab) => {
        tab.addEventListener('click', () => {
          const target = tab.getAttribute('data-discover-tab');
          setActiveTab(target);
        });
      });

      setActiveTab(defaultTab);
    });
  </script>
@endsection
