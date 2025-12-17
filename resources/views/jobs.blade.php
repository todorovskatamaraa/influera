@extends(auth()->check() ? "layouts.loggedin-layout" : "layouts.guest-layout")

@section("title", "Influentia - Browse Collaboration Opportunities")

@section("content")
  @php
    $isGuest = ! auth()->check();
    $dnaScore = $dnaScore ?? null;
    $requestSort = request("sort");
    $dnaFlag = request()->boolean("dna_match");
    $currentSort = $requestSort ?: ($dnaFlag ? "match" : null);
    $dnaMatched = ($currentSort === "match" || $dnaFlag) && ! is_null($dnaScore);
  @endphp

  <div class="mb-8">
    <h1
      class="mb-2 text-3xl font-extrabold text-slate-900 tracking-tight md:text-4xl"
    >
      Browse Collaboration Opportunities
    </h1>
    <p class="text-slate-500 text-lg">
      Find the perfect brand partnerships that match your content style and
      audience
    </p>
  </div>

  <form method="GET" action="{{ route("jobs.index") }}" id="jobs-filter-form">
{{-- DNA MATCH BANNER --}}
@if ($dnaMatched)
  <div
    class="flex flex-col overflow-hidden w-full p-4 mb-8 bg-gradient-to-r from-[#eef2ff] to-[#f3e8ff] border border-[#e0e7ff] rounded-2xl items-center justify-between gap-4 relative group md:flex-row md:p-6"
  >
    <div class="flex z-10 items-start gap-4">
      <div class="hidden p-3 text-primary bg-white rounded-xl shadow-sm sm:block">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path
            d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"
          />
        </svg>
      </div>

      <div class="flex flex-col gap-2">
        <p class="text-sm font-semibold text-primary">DNA Matched</p>
        <h3 class="font-bold text-slate-900 text-lg leading-snug">Your best campaign match</h3>
        <p class="text-slate-600 text-sm">
          Your top-matching campaign in this list is a {{ $dnaScore }}% fit with your Influencer DNA.
        </p>
      </div>
    </div>

    <div class="flex z-10 items-center gap-4">
      @php
        $safeScore = max(0, min(100, (int) $dnaScore));
        $angle = $safeScore * 3.6;
        $baseParams = request()->except(['dna_match','sort','page']);
      @endphp

      <div class="w-16 h-16 relative shrink-0">
        <div
          class="flex w-full h-full rounded-full items-center justify-center"
          style="background: conic-gradient(#4f46e5 {{ $angle }}deg, #e5e7eb 0deg);"
        >
          <div class="flex w-12 h-12 bg-white rounded-full shadow-inner items-center justify-center">
            <span class="text-sm font-extrabold text-slate-900">{{ $safeScore }}%</span>
          </div>
        </div>
      </div>

      @if ($isGuest)
        <a
          href="{{ route('login') }}"
          class="flex px-6 py-2 text-white font-bold text-sm bg-primary rounded-md shadow-lg shadow-primary/25 transition-colors hover:bg-primary/90 items-center"
        >
          Log in to sort by best match
        </a>
      @else
        <a
          href="{{ route('jobs.index', array_merge($baseParams, ['sort' => 'newest'])) }}"
          class="px-4 py-2 text-xs font-bold text-slate-700 bg-white border border-slate-200 rounded-lg transition-colors hover:bg-slate-50"
        >
          Remove DNA Match
        </a>
      @endif
    </div>

    <div
      class="w-40 h-40 bg-primary/10 rounded-full transition-all absolute -right-10 -top-10 blur-3xl group-hover:bg-primary/20 duration-500"
    ></div>
  </div>
@else
  <div
    class="flex flex-col overflow-hidden w-full p-4 mb-8 bg-gradient-to-r from-[#eef2ff] to-[#f3e8ff] border border-[#e0e7ff] rounded-2xl items-center justify-between gap-4 relative group md:flex-row md:p-6"
  >
    <div class="flex z-10 items-start gap-4">
      <div class="hidden p-3 text-primary bg-white rounded-xl shadow-sm sm:block">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path
            d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"
          />
        </svg>
      </div>

      <div class="space-y-1">
        <p class="text-sm font-semibold text-primary">Perform a DNA match!</p>
        <h3 class="font-bold text-slate-900 text-lg leading-snug">
          Find campaigns that match your DNA—perfectly.
        </h3>
        @if ($isGuest)
          <p class="mt-1 text-xs text-slate-600">
            Log in to run a DNA match and see personalized compatibility scores.
          </p>
        @endif
      </div>
    </div>

    <div class="z-10 mt-2 md:mt-0">
      @if ($isGuest)
        <a
          href="{{ route('login') }}"
          class="flex px-6 py-2 text-white font-bold text-sm bg-primary rounded-md shadow-lg shadow-primary/25 transition-colors hover:bg-primary/90 items-center"
        >
          Log in to match your DNA
        </a>
      @else
        <a
          href="{{ route('jobs.index', array_merge(request()->all(), ['dna_match' => 1])) }}"
          class="flex px-6 py-2 text-white font-bold text-sm bg-primary rounded-md shadow-lg shadow-primary/25 transition-colors hover:bg-primary/90 items-center"
        >
          Match my DNA!
        </a>
      @endif
    </div>

    <div
      class="w-40 h-40 bg-primary/10 rounded-full transition-all absolute -right-10 -top-10 blur-3xl group-hover:bg-primary/20 duration-500"
    ></div>
  </div>
@endif

    <!-- Filter Bar -->
    <div
      class="flex flex-col z-40 mb-8 py-2 bg-[#fafafa]/95 gap-4 top-16 backdrop-blur-sm md:flex-row"
    >
      <div class="flex-1 relative">
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
        <input
          type="text"
          name="search"
          value="{{ request("search") }}"
          placeholder="Search"
          class="w-full pl-10 pr-4 py-2.5 text-sm bg-white border border-slate-200 rounded-xl shadow-sm transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
        />
      </div>

      <div class="flex w-full gap-2 md:w-auto">
        <!-- Sorting Select -->
        <div class="w-full relative md:w-[180px]">
          <select
            id="sort-select"
            name="sort"
            class="w-full h-[42px] px-3 text-sm text-slate-700 bg-white border border-slate-200 rounded-xl cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary/20 appearance-none"
          >
            <option value="" disabled {{ $currentSort ? "" : "selected" }}>
              Sorting
            </option>

            <option
              value="match"
              {{ $currentSort === "match" ? "selected" : "" }}
            >
              Match Score
            </option>

            <option
              value="newest"
              {{ $currentSort === "newest" ? "selected" : "" }}
            >
              Newest
            </option>

            <option
              value="oldest"
              {{ $currentSort === "oldest" ? "selected" : "" }}
            >
              Oldest
            </option>

            <option
              value="price-high"
              {{ $currentSort === "price-high" ? "selected" : "" }}
            >
              Price: High to Low
            </option>

            <option
              value="price-low"
              {{ $currentSort === "price-low" ? "selected" : "" }}
            >
              Price: Low to High
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
          class="flex h-[42px] px-4 text-slate-700 font-medium text-sm whitespace-nowrap bg-white border border-slate-200 rounded-xl shadow-sm hover:bg-slate-50 items-center"
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
            class="mr-2"
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
    </div>

    <div class="flex flex-col gap-8 md:flex-row">
      <!-- Sidebar -->
      <aside class="hidden w-full shrink-0 md:block md:w-64 lg:w-72">
        <div class="space-y-8">
          <div class="flex pb-2 items-center gap-2">
            <svg
              width="20"
              height="20"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="text-slate-900"
            >
              <polygon
                points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"
              ></polygon>
            </svg>
            <h2 class="font-bold text-lg text-slate-900">Filters</h2>
          </div>

          <!-- Categories -->
          <div class="space-y-4">
            <h3 class="text-sm font-bold text-slate-900">Categories</h3>
            <div class="space-y-3">
              @php
                $allNiches = [
                  "Fitness",
                  "Lifestyle",
                  "Wellness",
                  "Health",
                  "Beauty",
                  "Travel",
                  "Fashion",
                  "Food",
                  "Vegan",
                  "Aesthetic",
                  "Minimalism",
                ];
                $selectedCategories = (array) request("categories");
              @endphp

              @foreach ($allNiches as $niche)
                <div class="flex space-x-2 items-center">
                  <input
                    type="checkbox"
                    name="categories[]"
                    value="{{ $niche }}"
                    id="cat-{{ $niche }}"
                    class="h-4 w-4 text-primary border-slate-300 rounded focus:ring-primary"
                    {{ in_array($niche, $selectedCategories) ? "checked" : "" }}
                  />
                  <label
                    for="cat-{{ $niche }}"
                    class="text-sm font-medium text-slate-600 cursor-pointer"
                  >
                    {{ $niche }}
                  </label>
                </div>
              @endforeach
            </div>
          </div>

          <!-- Budget Range -->
          <div class="space-y-4">
            <div class="flex justify-between items-center">
              <h3 class="text-sm font-bold text-slate-900">Budget Range</h3>

              <span class="text-xs font-medium text-slate-500">
                €
                <span id="min-budget-label">
                  {{ request("min_budget", 500) }}
                </span>
                – €
                <span id="max-budget-label">
                  {{ request("max_budget", 10000) }}
                </span>
              </span>
            </div>

            <div class="space-y-3">
              <div class="space-y-1">
                <input
                  id="minBudgetRange"
                  type="range"
                  name="min_budget"
                  min="500"
                  max="10000"
                  step="100"
                  value="{{ request("min_budget", 500) }}"
                  class="w-full h-2 bg-slate-200 rounded-lg cursor-pointer appearance-none"
                />

                <input
                  id="maxBudgetRange"
                  type="range"
                  name="max_budget"
                  min="500"
                  max="10000"
                  step="100"
                  value="{{ request("max_budget", 10000) }}"
                  class="w-full h-2 bg-slate-200 rounded-lg cursor-pointer appearance-none -mt-2"
                />
              </div>

              <div
                class="flex text-xs font-medium text-slate-500 justify-between"
              >
                <span>€500</span>
                <span>€10,000</span>
              </div>
            </div>
          </div>

          <!-- Content Type -->
          <div class="space-y-4">
            <h3 class="text-sm font-bold text-slate-900">Content Type</h3>
            <div class="space-y-3">
              @php
                $selectedPlatforms = (array) request("platforms");
              @endphp

              <div class="flex space-x-2 items-center">
                <input
                  type="checkbox"
                  name="platforms[]"
                  value="instagram_posts"
                  id="type-ig"
                  class="h-4 w-4 text-primary border-slate-300 rounded focus:ring-primary"
                  {{ in_array("instagram_posts", $selectedPlatforms) ? "checked" : "" }}
                />
                <label
                  for="type-ig"
                  class="text-sm font-medium text-slate-600 cursor-pointer"
                >
                  Instagram Posts
                </label>
              </div>

              <div class="flex space-x-2 items-center">
                <input
                  type="checkbox"
                  name="platforms[]"
                  value="stories"
                  id="type-stories"
                  class="h-4 w-4 text-primary border-slate-300 rounded focus:ring-primary"
                  {{ in_array("stories", $selectedPlatforms) ? "checked" : "" }}
                />
                <label
                  for="type-stories"
                  class="text-sm font-medium text-slate-600 cursor-pointer"
                >
                  Stories
                </label>
              </div>

              <div class="flex space-x-2 items-center">
                <input
                  type="checkbox"
                  name="platforms[]"
                  value="reels_tiktok"
                  id="type-reels"
                  class="h-4 w-4 text-primary border-slate-300 rounded focus:ring-primary"
                  {{ in_array("reels_tiktok", $selectedPlatforms) ? "checked" : "" }}
                />
                <label
                  for="type-reels"
                  class="text-sm font-medium text-slate-600 cursor-pointer"
                >
                  Reels/Tiktok
                </label>
              </div>
            </div>
          </div>

          <!-- Duration -->
          <div class="space-y-4">
            <h3 class="text-sm font-bold text-slate-900">Duration</h3>
            @php
              $durationSelected = (array) request("duration_groups");
            @endphp

            <div class="space-y-3">
              <div class="flex space-x-2 items-center">
                <input
                  type="checkbox"
                  name="duration_groups[]"
                  id="dur-short"
                  value="short-term"
                  class="h-4 w-4 text-primary border-slate-300 focus:ring-primary"
                  {{ in_array("short-term", $durationSelected) ? "checked" : "" }}
                />
                <label
                  for="dur-short"
                  class="text-sm font-medium text-slate-600 cursor-pointer"
                >
                  Short-term (&lt;1 month)
                </label>
              </div>
              <div class="flex space-x-2 items-center">
                <input
                  type="checkbox"
                  name="duration_groups[]"
                  id="dur-medium"
                  value="medium-term"
                  class="h-4 w-4 text-primary border-slate-300 focus:ring-primary"
                  {{ in_array("medium-term", $durationSelected) ? "checked" : "" }}
                />
                <label
                  for="dur-medium"
                  class="text-sm font-medium text-slate-600 cursor-pointer"
                >
                  Medium-term (1-3 months)
                </label>
              </div>
              <div class="flex space-x-2 items-center">
                <input
                  type="checkbox"
                  name="duration_groups[]"
                  id="dur-long"
                  value="long-term"
                  class="h-4 w-4 text-primary border-slate-300 focus:ring-primary"
                  {{ in_array("long-term", $durationSelected) ? "checked" : "" }}
                />
                <label
                  for="dur-long"
                  class="text-sm font-medium text-slate-600 cursor-pointer"
                >
                  Long term (3+ months)
                </label>
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="space-y-2">
            <button
              type="submit"
              class="w-full py-2 text-slate-900 font-bold bg-[#22d3ee] rounded-md shadow-sm shadow-cyan-500/20 transition-colors hover:bg-[#06b6d4]"
            >
              Apply Filters
            </button>

            <a
              href="{{ route("jobs.index") }}"
              class="block w-full py-2 text-sm text-slate-600 font-medium text-center bg-slate-50 border border-slate-200 rounded-md transition-colors hover:bg-slate-100"
            >
              Reset Filters
            </a>
          </div>
        </div>
      </aside>

      <!-- Main Grid -->
      <div class="flex-1">
        <div class="flex mb-4 justify-between items-center">
          <p
            class="text-xs font-semibold text-slate-500 tracking-wider uppercase"
          >
            Showing {{ $jobs->count() }} opportunities
          </p>

          @php
            $sort = $currentSort;
          @endphp

          <div
            class="flex text-xs font-medium text-slate-500 items-center gap-1"
          >
            Sort by:
            <span class="text-slate-900">
              @switch($sort)
                @case("match")
                  Match Score

                  @break
                @case("newest")
                  Newest

                  @break
                @case("oldest")
                  Oldest

                  @break
                @case("price-high")
                  Price: High to Low

                  @break
                @case("price-low")
                  Price: Low to High

                  @break
                @default
                  Match Score
              @endswitch
            </span>
            <svg
              class="transition-transform duration-200 {{
                $sort ===
                '
                            price-low'
                  ? "rotate-180"
                  : ""
              }}"
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
        </div>

        <div
          class="grid grid-cols-1 job-grid gap-6 sm:grid-cols-2 lg:grid-cols-3"
        >
          @foreach ($jobs as $job)
            <div
              class="overflow-hidden flex flex-col hidden h-full bg-white rounded-xl border border-transparent shadow-sm transition-all job-card hover:shadow-md duration-300 group"
            >
              <div class="overflow-hidden h-48 bg-slate-100 relative">
                <img
                  src="{{ asset(optional($job->user->brandProfile)->company_logo_path ?? "images/default-logo.jpg") }}"
                  alt="{{ $job->campaign_name }}"
                  class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105"
                />

                <div class="flex flex-wrap absolute bottom-3 left-3 gap-2">
                  @foreach ($job->niches as $niche)
                    <span
                      class="px-2.5 py-0.5 text-white text-xs font-medium bg-black/60 backdrop-blur-md rounded"
                    >
                      {{ $niche }}
                    </span>
                  @endforeach
                </div>
              </div>

              <div class="flex-1 flex flex-col p-5 gap-3">
                <div>
                  <h3
                    class="mb-1 font-bold text-lg text-slate-900 leading-tight line-clamp-1"
                  >
                    {{ $job->campaign_name }}
                  </h3>
                  <p class="text-sm font-semibold text-slate-500">
                    {{ $job->user->name }}
                  </p>

                  @if (isset($job->match_score))
                    <p class="mt-1 text-xs font-semibold text-primary">
                      {{ $job->match_score }}% Match
                    </p>
                  @endif
                </div>

                <p class="text-sm text-slate-600 leading-relaxed line-clamp-2">
                  {{ \Illuminate\Support\Str::limit($job->campaign_overview, 90) }}
                </p>

                <div class="flex flex-col mt-auto pt-2 gap-2">
                  <div
                    class="flex text-xs font-medium text-slate-700 items-center gap-2"
                  >
                    <svg
                      class="text-slate-400"
                      width="14"
                      height="14"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <line x1="12" y1="1" x2="12" y2="23"></line>
                      <path
                        d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"
                      ></path>
                    </svg>
                    <span>
                      €{{ $job->budget_min }} - €{{ $job->budget_max }}
                    </span>
                  </div>

                  <div
                    class="flex text-xs font-medium text-slate-700 items-center gap-2"
                  >
                    <svg
                      class="text-slate-400"
                      width="14"
                      height="14"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <rect
                        width="18"
                        height="18"
                        x="3"
                        y="4"
                        rx="2"
                        ry="2"
                      ></rect>
                      <line x1="16" y1="2" x2="16" y2="6"></line>
                      <line x1="8" y1="2" x2="8" y2="6"></line>
                      <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <span>{{ $job->duration }}</span>
                  </div>
                </div>
              </div>

              <div class="p-5 pt-0">
                @php
                  $jobUrl = $isGuest
                    ? route("login")
                    : route("jobs.show", $job->slug);
                @endphp

                <a
                  href="{{ $jobUrl }}"
                  class="flex w-full h-10 text-white font-semibold text-sm bg-primary rounded-lg shadow-sm shadow-primary/20 transition-colors hover:bg-primary/90 items-center justify-center"
                >
                  {{ $isGuest ? "Log in to view details" : "View Details" }}
                </a>
              </div>
            </div>
          @endforeach
        </div>

        @if ($jobs->count() > 6)
          <div class="flex mt-12 justify-center">
            <button
              id="load-more-btn"
              type="button"
              class="px-8 py-6 text-white font-bold bg-primary rounded-xl shadow-xl shadow-primary/20 transition-colors hover:bg-primary/90"
            >
              Load More
            </button>
          </div>
        @endif
      </div>
    </div>
  </form>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      /* =====================
       LOAD MORE
    ====================== */
      const grid = document.querySelector('.job-grid');
      const cards = [...document.querySelectorAll('.job-card')];
      const btn = document.getElementById('load-more-btn');

      if (grid && cards.length > 0) {
        let visibleCount = 6;

        function getColumns() {
          const style = window.getComputedStyle(grid);
          return style.getPropertyValue('grid-template-columns').split(' ')
            .length;
        }

        function showCards() {
          cards.forEach((card, index) => {
            card.classList.toggle('hidden', index >= visibleCount);
          });

          if (btn && visibleCount >= cards.length) {
            btn.classList.add('hidden');
          }
        }

        showCards();

        if (btn) {
          btn.addEventListener('click', () => {
            const cols = getColumns();
            visibleCount += cols * 3;
            showCards();
          });
        }
      }

      /* =====================
      RANGE
    ====================== */
      const minRange = document.getElementById('minBudgetRange');
      const maxRange = document.getElementById('maxBudgetRange');
      const minLabel = document.getElementById('min-budget-label');
      const maxLabel = document.getElementById('max-budget-label');

      if (minRange && maxRange && minLabel && maxLabel) {
        const minGap = 200;

        function updateLabels() {
          minLabel.textContent = minRange.value;
          maxLabel.textContent = maxRange.value;
        }

        minRange.addEventListener('input', () => {
          let minVal = parseInt(minRange.value);
          let maxVal = parseInt(maxRange.value);

          if (minVal > maxVal - minGap) {
            minVal = maxVal - minGap;
            minRange.value = minVal;
          }

          updateLabels();
        });

        maxRange.addEventListener('input', () => {
          let minVal = parseInt(minRange.value);
          let maxVal = parseInt(maxRange.value);

          if (maxVal < minVal + minGap) {
            maxVal = minVal + minGap;
            maxRange.value = maxVal;
          }

          updateLabels();
        });

        updateLabels();
      }

      /* =====================
       AUTO-SUBMIT
    ====================== */
      const form = document.getElementById('jobs-filter-form');
      const sortSelect = document.querySelector('select[name="sort"]');

      if (form && sortSelect) {
        sortSelect.addEventListener('change', () => {
          let dnaInput = form.querySelector('input[name="dna_match"]');

          if (sortSelect.value === 'match') {
            if (!dnaInput) {
              dnaInput = document.createElement('input');
              dnaInput.type = 'hidden';
              dnaInput.name = 'dna_match';
              dnaInput.value = '1';
              form.appendChild(dnaInput);
            } else {
              dnaInput.value = '1';
            }
          } else {
            if (dnaInput) {
              dnaInput.remove();
            }
          }

          form.classList.add('opacity-60', 'pointer-events-none');
          form.submit();
        });
      }
    });
  </script>
@endsection
