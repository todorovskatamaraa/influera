@extends("layouts.loggedin-layout")

@section("title", "Influentia - My Profile")

@section("content")
  @php
    $hasAvatar = ! empty($profile->avatar_path);
    $avatar = $hasAvatar ? asset($profile->avatar_path) : null;
    $avatarFallback = asset("images/default-avatar.jpg");
    $initials = collect(explode(" ", $authUser->name))
      ->filter()
      ->map(fn ($part) => mb_substr($part, 0, 1))
      ->join("");

    $hasCover = ! empty($profile->cover_path);
    $cover = $hasCover ? asset($profile->cover_path) : null;

    $location = $profile->location ?? "Location not set";
    $phone = $profile->phone ?? "Add phone number";
    $bio = $profile->bio ?? "Add a short bio to tell brands more about you and your content style.";

    $dnaScore = $dnaScore ?? 0;
    $portfolioUrl = $profile->portfolio_url ?? "#";
    $coins = $authUser->coins ?? 0;
  @endphp

  <div class="mb-24 relative">
    <div
      class="overflow-hidden h-64 w-full bg-slate-900 rounded-2xl relative md:h-80"
    >
      @if ($hasCover)
        <img
          src="{{ $cover }}"
          class="object-cover w-full h-full"
          alt="Cover image"
        />
        <div
          class="z-10 bg-gradient-to-t from-black/50 to-transparent absolute inset-0"
        ></div>
      @else
        <div class="bg-slate-900 absolute inset-0"></div>
        <div
          class="w-48 h-48 bg-slate-700/50 rounded-full absolute -left-16 top-10 blur-2xl"
        ></div>
        <div
          class="w-60 h-60 bg-primary/40 rounded-full absolute right-0 bottom-0 blur-3xl"
        ></div>
        <div
          class="flex px-8 pb-6 absolute inset-0 items-end md:px-12 md:items-center"
        >
          <div>
            <p
              class="text-xs font-semibold tracking-wide text-indigo-200 uppercase"
            >
              Creator space
            </p>
            <p class="mt-1 text-lg font-semibold text-slate-100">
              Make your profile stand out with great visuals.
            </p>
          </div>
        </div>
      @endif
    </div>

    <!-- Profile Info -->
    <div
      class="flex flex-col px-6 absolute -bottom-20 left-0 right-0 items-end justify-between gap-4 md:flex-row md:px-12 md:items-center"
    >
      <div class="flex z-20 items-end gap-6 relative">
        <div
          class="overflow-hidden flex w-32 h-32 bg-black rounded-full border-4 border-white shadow-lg shrink-0 items-center justify-center"
        >
          @if ($hasAvatar)
            <img
              src="{{ $avatar }}"
              class="object-cover w-full h-full"
              alt="Avatar"
            />
          @else
            <span class="text-3xl font-extrabold text-white">
              {{ $initials }}
            </span>
          @endif
        </div>

        <div class="pb-2">
          <h1 class="text-3xl font-extrabold text-slate-900">
            {{ $authUser->name }}
          </h1>

          <div
            class="flex flex-wrap mt-1 text-slate-500 text-sm font-medium items-center gap-4"
          >
            <span class="flex items-center gap-1">
              <svg
                width="14"
                height="14"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              >
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
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
              >
                <rect width="20" height="16" x="2" y="4" rx="2" />
                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
              </svg>
              {{ $authUser->email }}
            </span>

            <span class="flex items-center gap-1">
              <svg
                width="14"
                height="14"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"
                />
              </svg>
              {{ $phone }}
            </span>
          </div>
        </div>
      </div>

      <div class="flex pb-2 pt-10 gap-3">
        <a
          href="{{ route("influencer.profile.public", ["user" => $authUser->id]) }}"
          class="flex py-2 px-5 text-slate-700 font-bold text-xs bg-white rounded-lg border border-slate-200 shadow-sm hover:bg-slate-50 items-center gap-2"
        >
          See public view
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
            <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"></path>
            <circle cx="12" cy="12" r="3"></circle>
          </svg>
        </a>

        <button
          class="flex py-2 px-5 text-white font-bold text-xs bg-primary rounded-lg shadow-lg shadow-primary/20 hover:bg-primary/90 items-center gap-2"
          type="button"
        >
          Share profile
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
            <circle cx="18" cy="5" r="3" />
            <circle cx="6" cy="12" r="3" />
            <circle cx="18" cy="19" r="3" />
            <line x1="8.59" x2="15.42" y1="13.51" y2="17.49" />
            <line x1="15.41" x2="8.59" y1="6.51" y2="10.49" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- About Me -->
  <section
    class="p-8 mb-8 bg-white rounded-2xl border border-slate-100 shadow-sm relative group"
  >
    <button
      class="flex w-8 h-8 text-slate-400 bg-slate-50 rounded-full transition-all opacity-0 absolute top-4 right-4 items-center justify-center hover:text-primary hover:bg-primary/5 group-hover:opacity-100"
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
        <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z" />
      </svg>
    </button>

    <div class="flex flex-col gap-8 md:flex-row">
      <div class="flex-1">
        <h2 class="mb-4 text-lg font-bold text-slate-900">About me</h2>
        <p class="text-sm text-slate-600 leading-relaxed">
          {{ $bio }}
        </p>
      </div>
      <div
        class="w-full pl-6 space-y-4 border-l border-slate-100 shrink-0 md:w-48"
      >
        <div>
          <p class="text-[10px] font-bold text-slate-500">Revenue</p>
          <p class="text-sm font-bold text-primary">—</p>
        </div>
        <div>
          <p class="text-[10px] font-bold text-slate-500">Open Jobs</p>
          <p class="text-sm font-bold text-slate-900">0</p>
        </div>
        <div>
          <p class="text-[10px] font-bold text-slate-500">
            Pending Applications
          </p>
          <p class="text-sm font-bold text-slate-900">
            {{ $pendingApplicationsCount }}
          </p>
        </div>

        <div>
          <p class="text-[10px] font-bold text-slate-500">Job Success Rate</p>
          <p class="text-sm font-bold text-primary">—</p>
        </div>
      </div>
    </div>
  </section>

  <!-- DNA Banner -->
  <div
    class="flex flex-col p-6 mb-8 bg-white rounded-2xl border border-slate-100 shadow-sm items-center justify-between gap-4 md:flex-row"
  >
    @php
      $dnaScore = (int) ($dnaScore ?? 0);
      $dnaScore = max(0, min(100, $dnaScore));
      $angle = (int) round($dnaScore * 3.6);

      if ($dnaScore >= 80) {
        $compatLabel = "Excellent compatibility";
        $compatColor = "text-emerald-500";
        $compatSubtitle = "Your profile is a near-perfect match with most brands in our database.";
      } elseif ($dnaScore >= 60) {
        $compatLabel = "Strong compatibility";
        $compatColor = "text-primary";
        $compatSubtitle = "Your profile has a strong match with many brands in our database.";
      } elseif ($dnaScore >= 40) {
        $compatLabel = "Moderate compatibility";
        $compatColor = "text-amber-500";
        $compatSubtitle = "There is a decent match – a few tweaks to your DNA could improve it.";
      } elseif ($dnaScore > 0) {
        $compatLabel = "Low compatibility";
        $compatColor = "text-rose-500";
        $compatSubtitle = "Only a small part of your DNA matches brands right now. Try updating your niches, tones and values.";
      } else {
        $compatLabel = "No compatibility yet";
        $compatColor = "text-slate-400";
        $compatSubtitle = "Complete your Influencer DNA and connect with more matching brands.";
      }
    @endphp

    <div class="flex items-center gap-4">
      <div class="w-14 h-14 relative shrink-0">
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
            class="flex w-11 h-11 bg-white rounded-full shadow-inner items-center justify-center"
          >
            <span class="text-sm font-extrabold text-slate-900">
              {{ $dnaScore }}%
            </span>
          </div>
        </div>
      </div>

      <div>
        <h3 class="text-sm font-bold text-slate-900">
          Your Influencer DNA has
          <span class="{{ $compatColor }}">{{ $compatLabel }}</span>
        </h3>

        @if ($dnaScore > 0)
          <p class="text-xs text-slate-500">
            Your profile matches with {{ $dnaScore }}% of the brands in our
            database.
          </p>
        @else
          <p class="text-xs text-slate-500">
            {{ $compatSubtitle }}
          </p>
        @endif
      </div>
    </div>

    <div class="flex gap-3">
      <button
        class="flex px-4 py-2 text-xs font-bold text-slate-700 rounded-lg border border-slate-200 transition-all hover:bg-slate-50 items-center gap-2"
      >
        View DNA stats
        <svg
          width="12"
          height="12"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <circle cx="12" cy="12" r="10" />
          <path d="M12 16v-4" />
          <path d="M12 8h.01" />
        </svg>
      </button>
      <button
        class="flex px-4 py-2 text-xs font-bold text-slate-700 rounded-lg border border-slate-200 transition-all hover:bg-slate-50 items-center gap-2"
      >
        Share DNA
        <svg
          width="12"
          height="12"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <circle cx="18" cy="5" r="3" />
          <circle cx="6" cy="12" r="3" />
          <circle cx="18" cy="19" r="3" />
          <line x1="8.59" x2="15.42" y1="13.51" y2="17.49" />
          <line x1="15.41" x2="8.59" y1="6.51" y2="10.49" />
        </svg>
      </button>
    </div>
  </div>

  <!-- Grid Layout -->
  <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
    <div class="space-y-8 lg:col-span-2">
      <section
        class="p-8 bg-white rounded-2xl border border-slate-100 shadow-sm"
      >
        <h2 class="mb-4 text-lg font-bold text-slate-900">Work history</h2>
        <p class="mb-4 text-xs text-slate-500">Your past experiences</p>

        <div class="flex mb-6 border-b border-slate-100 gap-6">
          <button
            class="pb-2 text-sm font-bold text-slate-900 border-b-2 border-slate-900"
          >
            Completed Jobs (1)
          </button>
          <button
            class="pb-2 text-sm font-medium text-slate-500 transition-colors hover:text-primary"
          >
            In progress (1)
          </button>
        </div>

        <div>
          <h3 class="mb-1 font-bold text-slate-900 text-base">
            Awareness Campaign - Story and Post
          </h3>
          <div class="flex mb-3 text-xs text-slate-500 items-center gap-4">
            <div class="flex text-yellow-400">
              @for ($i = 0; $i < 5; $i++)
                <svg
                  width="14"
                  height="14"
                  fill="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"
                  />
                </svg>
              @endfor
            </div>
            <span class="font-bold text-slate-900">5.0</span>
            <span>Dec 20, 2024 - Dec 25, 2024</span>
          </div>
          <p class="mb-4 text-sm text-slate-600 leading-relaxed">
            FitLife Gear is launching a revolutionary line of compact,
            multi-functional home workout equipment. We're looking for fitness
            creators to partner with us in showcasing how these tools integrate
            into small-space living.
          </p>
          <div class="w-full border-t border-slate-100">
            <div
              class="flex py-3 text-xs font-medium text-slate-500 border-b border-slate-100 justify-between"
            >
              <span>Content Type</span>
              <span>Content Price</span>
            </div>
            <div
              class="flex py-3 text-sm text-slate-900 border-b border-slate-100 justify-between"
            >
              <span>Post</span>
              <span class="font-bold">$500</span>
            </div>
            <div class="flex py-3 text-sm text-slate-900 justify-between">
              <span>Story</span>
              <span class="font-bold">$300</span>
            </div>
          </div>
        </div>
      </section>

      <!-- Projects -->
      <section
        class="p-8 bg-white rounded-2xl border border-slate-100 shadow-sm relative group"
      >
        <button
          class="flex w-8 h-8 text-slate-400 bg-slate-50 rounded-full transition-all opacity-0 absolute top-4 right-4 items-center justify-center hover:text-primary hover:bg-primary/5 group-hover:opacity-100"
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
            <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z" />
          </svg>
        </button>
        <h2 class="mb-4 text-lg font-bold text-slate-900">Projects</h2>
        <p class="mb-6 text-xs text-slate-500">Share your projects</p>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <div
            class="flex p-3 border border-slate-100 rounded-xl transition-shadow cursor-pointer gap-3 hover:shadow-md"
          >
            <div
              class="overflow-hidden w-24 h-20 bg-slate-100 rounded-lg shrink-0"
            >
              <img
                src="{{ $cover ?? $avatarFallback }}"
                class="object-cover w-full h-full"
              />
            </div>
            <div class="overflow-hidden flex flex-col justify-center">
              <h4 class="font-bold text-slate-900 text-sm truncate">
                Fitness Product Campaign
              </h4>
              <p class="mt-1 text-[10px] text-slate-500 line-clamp-2">
                FitLife Gear is launching a revolutionary line of compact...
              </p>
              <p class="mt-1 text-[10px] text-slate-400">May 10, 2025</p>
            </div>
          </div>
          <div
            class="flex p-3 border border-slate-100 rounded-xl transition-shadow cursor-pointer gap-3 hover:shadow-md"
          >
            <div
              class="overflow-hidden w-24 h-20 bg-slate-100 rounded-lg shrink-0"
            >
              <img
                src="{{ $cover ?? $avatarFallback }}"
                class="object-cover w-full h-full"
              />
            </div>
            <div class="overflow-hidden flex flex-col justify-center">
              <h4 class="font-bold text-slate-900 text-sm truncate">
                Fitness Product Campaign
              </h4>
              <p class="mt-1 text-[10px] text-slate-500 line-clamp-2">
                FitLife Gear is launching a revolutionary line of compact...
              </p>
              <p class="mt-1 text-[10px] text-slate-400">May 10, 2025</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Collaboration Preferences -->
      <section
        class="p-8 bg-white rounded-2xl border border-slate-100 shadow-sm relative group"
      >
        <button
          class="flex w-8 h-8 text-slate-400 bg-slate-50 rounded-full transition-all opacity-0 absolute top-4 right-4 items-center justify-center hover:text-primary hover:bg-primary/5 group-hover:opacity-100"
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
            <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z" />
          </svg>
        </button>
        <h2 class="mb-4 text-lg font-bold text-slate-900">
          Collaboration Preferences
        </h2>
        <p class="mb-6 text-xs text-slate-500">
          Let brands know what you're looking for
        </p>

        <div class="mb-6">
          <p class="mb-3 text-xs font-bold text-slate-700">
            Preferred Collaboration Types
          </p>
          <div class="flex flex-wrap gap-2">
            @if (! empty($profile->collaboration_types))
              @foreach ($profile->collaboration_types as $type)
                <span
                  class="px-3 py-1 text-slate-600 text-xs font-medium bg-slate-100 rounded-md"
                >
                  {{ $type }}
                </span>
              @endforeach
            @else
              <span
                class="px-3 py-1 text-slate-600 text-xs font-medium bg-slate-100 rounded-md"
              >
                Sponsored Posts
              </span>
              <span
                class="px-3 py-1 text-slate-600 text-xs font-medium bg-slate-100 rounded-md"
              >
                Giveaways
              </span>
              <span
                class="px-3 py-1 text-slate-600 text-xs font-medium bg-slate-100 rounded-md"
              >
                Event Coverage
              </span>
              <span
                class="px-3 py-1 text-slate-600 text-xs font-medium bg-slate-100 rounded-md"
              >
                Affiliate Marketing
              </span>
            @endif
          </div>
        </div>

        <div class="mb-6">
          <p class="mb-3 text-xs font-bold text-slate-700">Pricing</p>
          <div class="w-full border-t border-slate-100">
            <div
              class="flex py-3 text-xs font-medium text-slate-500 border-b border-slate-100 justify-between"
            >
              <span>Content Type</span>
              <span>Content Price</span>
            </div>
            <div
              class="flex py-3 text-sm text-slate-900 border-b border-slate-100 justify-between"
            >
              <span>Reel</span>
              <span class="font-bold">$500</span>
            </div>
            <div
              class="flex py-3 text-sm text-slate-900 border-b border-slate-100 justify-between"
            >
              <span>Story</span>
              <span class="font-bold">$300</span>
            </div>
            <div
              class="flex py-3 text-sm text-slate-900 border-b border-slate-100 justify-between"
            >
              <span>Post</span>
              <span class="font-bold">$200</span>
            </div>
            <div class="flex py-3 text-sm text-slate-900 justify-between">
              <span>Highlight</span>
              <span class="font-bold">$150</span>
            </div>
          </div>
        </div>

        <div>
          <p class="mb-1 text-xs font-bold text-slate-700">Availability</p>
          <p class="text-sm text-slate-600">
            {{ $profile->availability ?? "Set your availability" }}
          </p>
        </div>
      </section>

      <!-- Content Information -->
      <section
        class="p-8 bg-white rounded-2xl border border-slate-100 shadow-sm relative group"
      >
        <button
          class="flex w-8 h-8 text-slate-400 bg-slate-50 rounded-full transition-all opacity-0 absolute top-4 right-4 items-center justify-center hover:text-primary hover:bg-primary/5 group-hover:opacity-100"
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
            <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z" />
          </svg>
        </button>
        <h2 class="mb-4 text-lg font-bold text-slate-900">
          Content information
        </h2>
        <p class="mb-6 text-xs text-slate-500">
          Tell us about your content style and experience
        </p>

        <div class="mb-6">
          <p class="mb-3 text-xs font-bold text-slate-700">Niches Categories</p>
          <div class="flex flex-wrap gap-2">
            @if (! empty($profile->niches))
              @foreach ($profile->niches as $niche)
                <span
                  class="px-3 py-1 text-slate-600 text-xs font-medium bg-slate-100 rounded-md"
                >
                  {{ $niche }}
                </span>
              @endforeach
            @else
              <span
                class="px-3 py-1 text-slate-600 text-xs font-medium bg-slate-100 rounded-md"
              >
                Fashion
              </span>
              <span
                class="px-3 py-1 text-slate-600 text-xs font-medium bg-slate-100 rounded-md"
              >
                Beauty
              </span>
              <span
                class="px-3 py-1 text-slate-600 text-xs font-medium bg-slate-100 rounded-md"
              >
                Fitness
              </span>
              <span
                class="px-3 py-1 text-slate-600 text-xs font-medium bg-slate-100 rounded-md"
              >
                Technology
              </span>
            @endif
          </div>
        </div>

        <div class="mb-6">
          <p class="mb-3 text-xs font-bold text-slate-700">Content Types</p>
          <div class="flex flex-wrap gap-2">
            @if (! empty($profile->content_types))
              @foreach ($profile->content_types as $type)
                <span
                  class="px-3 py-1 text-slate-600 text-xs font-medium bg-slate-100 rounded-md"
                >
                  {{ $type }}
                </span>
              @endforeach
            @else
              <span
                class="px-3 py-1 text-slate-600 text-xs font-medium bg-slate-100 rounded-md"
              >
                Photo Posts
              </span>
              <span
                class="px-3 py-1 text-slate-600 text-xs font-medium bg-slate-100 rounded-md"
              >
                Video Content
              </span>
              <span
                class="px-3 py-1 text-slate-600 text-xs font-medium bg-slate-100 rounded-md"
              >
                Reels/Shorts
              </span>
            @endif
          </div>
        </div>

        <div class="mb-6">
          <p class="mb-3 text-xs font-bold text-slate-700">
            Previous Collaborations
          </p>
          @if ($profile->previous_collaborations)
            <p class="text-sm text-slate-600">
              {{ $profile->previous_collaborations }}
            </p>
          @else
            <p class="text-sm text-slate-400">No collaborations added yet.</p>
          @endif
        </div>

        <div>
          <p class="mb-1 text-xs font-bold text-slate-700">
            Portfolio / Media Kit Link
          </p>
          <a
            href="{{ $portfolioUrl }}"
            class="text-sm text-slate-600 underline"
          >
            {{ $portfolioUrl !== "#" ? $portfolioUrl : "Add your portfolio link" }}
          </a>
        </div>
      </section>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
      <!-- Coins Card -->
      @include("components.coins-card")
      <!-- Menu -->
      <div class="p-2 bg-white rounded-2xl border border-slate-100 shadow-sm">
        <button
          class="flex w-full p-3 text-sm font-medium text-slate-700 rounded-lg transition-colors items-center justify-between hover:bg-slate-50"
        >
          Favourites
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
            <path d="m7 7 10 10" />
            <path d="M17 7v10H7" />
          </svg>
        </button>
        <button
          class="flex w-full p-3 text-sm font-medium text-slate-700 rounded-lg transition-colors items-center justify-between hover:bg-slate-50"
        >
          Connected accounts
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
            <path d="m7 7 10 10" />
            <path d="M17 7v10H7" />
          </svg>
        </button>
        <button
          class="flex w-full p-3 text-sm font-medium text-slate-700 rounded-lg transition-colors items-center justify-between hover:bg-slate-50"
        >
          View analytics
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
            <path d="m7 7 10 10" />
            <path d="M17 7v10H7" />
          </svg>
        </button>
        <button
          class="flex w-full p-3 text-sm font-medium text-slate-700 rounded-lg transition-colors items-center justify-between hover:bg-slate-50"
        >
          Help Center
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
            <path d="m7 7 10 10" />
            <path d="M17 7v10H7" />
          </svg>
        </button>
      </div>
      @php
        use App\Models\PortfolioItem;

        $portfolioItems = PortfolioItem::where("user_id", auth()->id())
          ->latest()
          ->get();
      @endphp

      <section class="mt-10">
        <div class="flex mb-4 items-center justify-between">
          <h2 class="text-lg font-bold text-slate-900">Portfolio</h2>
          <span class="text-[11px] text-slate-400">
            Only visible to you in edit mode
          </span>
        </div>

        @if (session("success"))
          <div
            class="mb-4 px-3 py-2 text-xs text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-xl"
          >
            {{ session("success") }}
          </div>
        @endif

        <div
          class="p-4 mb-6 bg-white border border-slate-100 rounded-2xl shadow-sm"
        >
          <h3 class="mb-3 text-sm font-semibold text-slate-900">
            Add portfolio item
          </h3>

          <form
            action="{{ route("influencer.portfolio.store") }}"
            method="POST"
            class="space-y-3"
          >
            @csrf

            <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
              <div>
                <label class="block mb-1 text-xs font-medium text-slate-700">
                  Title *
                </label>
                <input
                  type="text"
                  name="title"
                  required
                  class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/70"
                />
              </div>

              <div>
                <label class="block mb-1 text-xs font-medium text-slate-700">
                  Brand
                </label>
                <input
                  type="text"
                  name="brand_name"
                  class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/70"
                />
              </div>

              <div>
                <label class="block mb-1 text-xs font-medium text-slate-700">
                  Campaign name
                </label>
                <input
                  type="text"
                  name="campaign_name"
                  class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/70"
                />
              </div>

              <div>
                <label class="block mb-1 text-xs font-medium text-slate-700">
                  Platform
                </label>
                <input
                  type="text"
                  name="platform"
                  placeholder="Instagram, TikTok..."
                  class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/70"
                />
              </div>
            </div>

            <div>
              <label class="block mb-1 text-xs font-medium text-slate-700">
                Content URL
              </label>
              <input
                type="url"
                name="content_url"
                placeholder="https://..."
                class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/70"
              />
            </div>

            <div>
              <label class="block mb-1 text-xs font-medium text-slate-700">
                Description
              </label>
              <textarea
                name="description"
                rows="3"
                class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/70"
                placeholder="What type of content did you create, what was the goal, results..."
              ></textarea>
            </div>

            <div class="grid grid-cols-1 gap-3 md:grid-cols-3">
              <div>
                <label class="block mb-1 text-xs font-medium text-slate-700">
                  Views
                </label>
                <input
                  type="number"
                  name="stats_views"
                  min="0"
                  class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/70"
                />
              </div>
              <div>
                <label class="block mb-1 text-xs font-medium text-slate-700">
                  Likes
                </label>
                <input
                  type="number"
                  name="stats_likes"
                  min="0"
                  class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/70"
                />
              </div>
              <div>
                <label class="block mb-1 text-xs font-medium text-slate-700">
                  Comments
                </label>
                <input
                  type="number"
                  name="stats_comments"
                  min="0"
                  class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/70"
                />
              </div>
            </div>

            <div>
              <label class="block mb-1 text-xs font-medium text-slate-700">
                Testimonial (who + quote)
              </label>
              <input
                type="text"
                name="testimonial_author"
                placeholder="Ana, Brand Manager @ FitLife"
                class="w-full mb-2 px-3 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/70"
              />
              <textarea
                name="testimonial_text"
                rows="2"
                class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/70"
                placeholder="Short testimonial from the brand (optional)"
              ></textarea>
            </div>

            <button
              type="submit"
              class="inline-flex px-4 py-2.5 text-sm font-semibold text-white bg-primary rounded-xl hover:brightness-110"
            >
              Save portfolio item
            </button>
          </form>
        </div>

        {{-- List of items --}}
        @if ($portfolioItems->isEmpty())
          <p class="mt-4 text-xs text-slate-500">
            You don't have any portfolio items yet.
          </p>
        @else
          <div class="grid grid-cols-1 mt-4 gap-4 md:grid-cols-2">
            @foreach ($portfolioItems as $item)
              @php
                $stats = $item->stats ?? [];
              @endphp

              <div
                class="p-4 text-xs bg-white border border-slate-100 rounded-xl"
              >
                <p class="font-semibold text-slate-900">{{ $item->title }}</p>
                @if (! empty($stats["brand"]))
                  <p class="mt-0.5 text-slate-500">{{ $stats["brand"] }}</p>
                @endif

                @if ($item->campaign_name)
                  <p class="mt-1 text-slate-600">
                    Campaign: {{ $item->campaign_name }}
                  </p>
                @endif

                @if ($item->media_url)
                  <a
                    href="{{ $item->media_url }}"
                    target="_blank"
                    class="inline-block mt-1 text-primary break-all underline"
                  >
                    {{ $item->media_url }}
                  </a>
                @endif

                <div class="flex mt-2 text-[11px] text-slate-500 gap-3">
                  <span>Views: {{ $stats["views"] ?? "—" }}</span>
                  <span>Likes: {{ $stats["likes"] ?? "—" }}</span>
                  <span>Comments: {{ $stats["comments"] ?? "—" }}</span>
                </div>
              </div>
            @endforeach
          </div>
        @endif
      </section>
    </div>
  </div>
@endsection
