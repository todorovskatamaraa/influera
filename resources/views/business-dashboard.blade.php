@extends("layouts.loggedin-layout")

@section("title", "Business Dashboard")

@section("content")
  @php
    $dnaScoreLocal = $dnaScore ?? null;
    $dnaCoverageLocal = $dnaCoverage ?? null;
  @endphp

  <!-- Welcome Header -->
  <div class="flex mb-8 items-center justify-between">
    @if (session("welcome_message") || session("welcome_back"))
      <h1 class="text-2xl font-bold">
        {{ session("welcome_message") ?? session("welcome_back") }}
      </h1>
    @endif
  </div>

  <!-- DNA Banner -->
  <div
    class="flex flex-col p-6 mb-8 bg-white rounded-2xl border border-slate-100 shadow-sm items-center justify-between gap-4 md:flex-row"
  >
    <div class="flex items-center gap-4">
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
      <div>
        @php
          if ($dnaScoreLocal >= 80) {
              $dnaLabel = "Strong compatibility";
              $dnaLabelColor = "text-emerald-600";
          } elseif ($dnaScoreLocal >= 60) {
              $dnaLabel = "Good compatibility";
              $dnaLabelColor = "text-primary";
          } elseif ($dnaScoreLocal) {
              $dnaLabel = "Moderate compatibility";
              $dnaLabelColor = "text-amber-600";
          } else {
              $dnaLabel = null;
              $dnaLabelColor = "text-slate-500";
          }
        @endphp

        @if ($dnaScoreLocal)
          <h3 class="text-base font-bold text-slate-900">
            Your Brand DNA has
            <span class="{{ $dnaLabelColor }}">
              {{ $dnaLabel }}
            </span>
          </h3>
          <p class="text-xs text-slate-500">
            Your profile has a top match

            @if ($dnaCoverageLocal !== null)
              and strong compatibility with {{ $dnaScoreLocal }}% of
              influencers in our database.
            @else
                with influencers in our database.
            @endif
          </p>
        @else
          <h3 class="text-base font-bold text-slate-900">
            Set up your Brand DNA
          </h3>
          <p class="text-xs text-slate-500">
            Complete your profile and run a DNA match to see compatibility with
            influencers.
          </p>
        @endif
      </div>
    </div>

    <div class="flex gap-3">
      <button
        class="flex px-6 py-2 text-xs font-bold text-slate-700 rounded-lg border border-slate-200 transition-all hover:bg-slate-50 items-center gap-2"
        onclick="window.location.href='{{ route("discover", ["dna" => 1]) }}'"
      >
        Find influencer
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
          <path d="M5 12h14"></path>
          <path d="M13 6l6 6-6 6"></path>
        </svg>
      </button>

      <button
        class="flex px-4 py-2 text-xs font-bold text-slate-700 rounded-lg border border-slate-200 transition-all hover:bg-slate-50 items-center gap-2"
      >
        View DNA stats
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
      </button>
    </div>
  </div>

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 mb-12 gap-4 sm:grid-cols-2 lg:grid-cols-4">
    <div class="p-6 text-center bg-[#fbf9ff] rounded-xl border border-slate-50">
      <p class="mb-2 text-xs font-bold text-slate-600">Revenue</p>
      <p class="mb-1 text-xl font-bold text-slate-900">$2500</p>
      <p class="text-[10px] text-slate-500">$4500 committed</p>
    </div>

    <div class="p-6 text-center bg-[#fbf9ff] rounded-xl border border-slate-50">
      <p class="mb-2 text-xs font-bold text-slate-600">Open Jobs</p>
      <p class="mb-1 text-xl font-bold text-slate-900">{{ $openJobsCount }}</p>
      <p class="text-[10px] text-slate-500">
        {{ $openJobsCount }} active listings
      </p>
    </div>

    <div class="p-6 text-center bg-[#fbf9ff] rounded-xl border border-slate-50">
      <p class="mb-2 text-xs font-bold text-slate-600">Pending Applications</p>
      <p class="mb-1 text-xl font-bold text-slate-900">
        {{ $applicationsCount }}
      </p>
      <p class="text-[10px] text-slate-500">
        {{ $applicationsCount }} applications received
      </p>
    </div>

    <div class="p-6 text-center bg-[#fbf9ff] rounded-xl border border-slate-50">
      <p class="mb-2 text-xs font-bold text-slate-600">Job Success Rate</p>
      <p class="mb-1 text-xl font-bold text-slate-900">88%</p>
      <p class="text-[10px] text-slate-500">
        Based on {{ $applicationsCount }} applications
      </p>
    </div>
  </div>

  <!-- Layout Grid -->
  <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
    <!-- LEFT -->
    <div class="lg:col-span-2">
      <h2 class="mb-1 text-lg font-bold text-slate-900">Your jobs</h2>
      <p class="mb-6 text-xs text-slate-500">
        Basic information about your job applicants.
      </p>

      <!-- Tabs -->
      <div class="flex mb-8 border-b border-slate-100 gap-6">
        <button
          class="pb-2 text-sm font-bold text-slate-900 border-b-2 border-slate-900 tab-btn"
          data-tab-btn="applications"
        >
          Review Applications
        </button>
        <button
          class="pb-2 text-sm font-medium text-slate-500 border-b-2 border-transparent tab-btn hover:text-primary"
          data-tab-btn="active"
        >
          Active Campaign
        </button>
        <button
          class="pb-2 text-sm font-medium text-slate-500 border-b-2 border-transparent tab-btn hover:text-primary"
          data-tab-btn="completed"
        >
          Completed
        </button>
      </div>

      @php
        use Illuminate\Support\Str;

        $activeJobs = $jobs->where("status", "!=", "completed");
        $completedJobs = $jobs->where("status", "completed");
      @endphp

      <!-- REVIEW APPLICATIONS -->
      <div class="space-y-8 tab-section" data-tab-section="applications">
        @forelse ($applications as $app)
          @php
            $influencer = $app->user;
            $profile = $influencer->influencerProfile ?? null;

            $avatar = $profile?->avatar_path
                ? asset($profile->avatar_path)
                : asset("images/default-avatar.jpg");

            $followers = $profile?->socialAccounts?->sum("followers") ?? null;

            $job = $app->job;
            $jobTitle = $job->title ?? ($job->campaign_name ?? "Untitled campaign");

            $budget =
                $job->budget_min && $job->budget_max
                    ? '$' . $job->budget_min . ' - $' . $job->budget_max
                    : "Budget not set";
          @endphp

          <div
            class="flex p-4 bg-white border border-slate-100 rounded-2xl shadow-sm job-card gap-4"
          >
            {{-- Avatar --}}
            <div class="flex-shrink-0">
              <div class="overflow-hidden w-16 h-16 bg-slate-100 rounded-full">
                <img
                  src="{{ $avatar }}"
                  alt="{{ $influencer->name }}"
                  class="object-cover w-full h-full"
                />
              </div>
            </div>

            <div class="flex-1">
              <div class="flex mb-1 items-start justify-between">
                <div>
                  <h3 class="text-sm font-bold text-slate-900">
                    {{ $influencer->name }}
                  </h3>
                  <p class="text-[11px] text-slate-500">
                    Applied for:
                    <span class="font-semibold">{{ $jobTitle }}</span>
                  </p>
                </div>

                <span
                  class="text-[11px] font-semibold @if ($app->status ===
                      '
                                              accepted')
                      text-emerald-600
                  @elseif ($app->status === "declined")
                      text-red-600
                  @else
                      text-amber-600
                  @endif"
                >
                  {{ ucfirst($app->status) }}
                </span>
              </div>

              <div
                class="flex flex-wrap mb-3 text-[11px] text-slate-500 items-center gap-x-4 gap-y-1"
              >
                @if ($followers)
                  <span>{{ number_format($followers) }} followers</span>
                @endif

                <span>Budget: {{ $budget }}</span>
                <span>
                  Applied on {{ $app->created_at->format("M d, Y") }}
                </span>
              </div>

              <div class="flex gap-2">
                <form
                  method="POST"
                  action="{{ route("business.applications.accept", $app) }}"
                >
                  @csrf
                  @method("PATCH")
                  <button
                    type="submit"
                    class="px-3 py-1.5 text-xs font-bold text-white bg-emerald-500 rounded-lg transition-colors hover:bg-emerald-600"
                  >
                    Accept
                  </button>
                </form>

                <form
                  method="POST"
                  action="{{ route("business.applications.decline", $app) }}"
                >
                  @csrf
                  @method("PATCH")
                  <button
                    type="submit"
                    class="px-3 py-1.5 text-xs font-bold text-red-600 rounded-lg border border-red-200 transition-colors hover:bg-red-50"
                  >
                    Decline
                  </button>
                </form>
              </div>
            </div>
          </div>
        @empty
          <p class="text-sm text-slate-500">No applications yet.</p>
        @endforelse
      </div>

      <!-- ACTIVE CAMPAIGN -->
      <div class="hidden space-y-8 tab-section" data-tab-section="active">
        @forelse ($activeJobs as $job)
          @php
            $title = $job->title ?? ($job->campaign_name ?? "Untitled campaign");

            $description = $job->short_description ?? ($job->description ?? null);

            $budget =
                $job->budget_min && $job->budget_max
                    ? '$' . $job->budget_min . ' - $' . $job->budget_max
                    : "Budget not set";
          @endphp

          <div class="pb-6 border-b border-slate-100 job-card">
            <div class="flex mb-2 items-start justify-between">
              <h3 class="text-sm font-bold text-slate-900">
                {{ $title }}
              </h3>
              <span class="text-[11px] font-semibold text-emerald-600">
                {{ ucfirst($job->status ?? "active") }}
              </span>
            </div>

            <p class="mb-3 text-sm text-slate-600">
              {{ $description ? Str::limit($description, 160) : "No description provided." }}
            </p>

            <div
              class="flex flex-wrap w-full text-[11px] text-slate-500 items-center justify-between"
            >
              <div class="flex gap-4">
                <span>Budget: {{ $budget }}</span>
                <span>Applications: {{ $job->applications_count }}</span>
              </div>

              <div class="flex items-center gap-3">
                <form
                  method="POST"
                  action="{{ route("business.jobs.complete", $job) }}"
                >
                  @csrf
                  @method("PATCH")
                  <button
                    type="submit"
                    class="px-3 py-1.5 text-xs font-bold text-white bg-primary rounded-lg transition-colors hover:bg-primary/90"
                  >
                    Complete
                  </button>
                </form>

                <a
                  href="{{ route("jobs.show", $job) }}"
                  class="flex text-xs font-bold text-slate-900 hover:text-primary items-center gap-1"
                >
                  View job
                  <svg
                    width="12"
                    height="12"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                  >
                    <path d="m9 18 6-6-6-6" />
                  </svg>
                </a>
              </div>
            </div>
          </div>
        @empty
          <p class="text-sm text-slate-500">
            You don’t have active campaigns yet.
          </p>
        @endforelse
      </div>

      <!-- COMPLETED -->
      <div class="hidden space-y-8 tab-section" data-tab-section="completed">
        @forelse ($completedJobs as $job)
          @php
            $title = $job->title ?? ($job->campaign_name ?? "Untitled campaign");

            $description = $job->short_description ?? ($job->description ?? null);

            $budget =
                $job->budget_min && $job->budget_max
                    ? '$' . $job->budget_min . ' - $' . $job->budget_max
                    : "Budget not set";
          @endphp

          <div class="pb-6 border-b border-slate-100 job-card">
            <div class="flex mb-2 items-start justify-between">
              <h3 class="text-sm font-bold text-slate-900">
                {{ $title }}
              </h3>
              <span class="text-[11px] font-semibold text-slate-500">
                {{ ucfirst($job->status ?? "completed") }}
              </span>
            </div>

            <p class="mb-3 text-sm text-slate-600">
              {{ $description ? Str::limit($description, 160) : "No description provided." }}
            </p>

            <div
              class="flex flex-wrap text-[11px] text-slate-500 items-center justify-between"
            >
              <div class="flex gap-4">
                <span>Budget: {{ $budget }}</span>
                <span>Total applications: {{ $job->applications_count }}</span>
              </div>

              <a
                href="{{ route("jobs.show", $job) }}"
                class="flex text-xs font-bold text-slate-900 hover:text-primary items-center gap-1"
              >
                View job
                <svg
                  width="12"
                  height="12"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                >
                  <path d="m9 18 6-6-6-6" />
                </svg>
              </a>
            </div>
          </div>
        @empty
          <p class="text-sm text-slate-500">
            You don’t have completed campaigns yet.
          </p>
        @endforelse
      </div>

      @php
        $hasMoreThanThree =
            $applications->count() > 3 ||
            $activeJobs->count() > 3 ||
            $completedJobs->count() > 3;
      @endphp

      @if ($hasMoreThanThree)
        <div class="mt-8">
          <button
            id="view-all-btn"
            class="w-full py-3 text-xs font-bold text-slate-600 border border-slate-200 rounded-lg transition-colors hover:bg-slate-50"
          >
            View all
          </button>
        </div>
      @endif
    </div>

    <!-- RIGHT SIDEBAR -->
    <div class="space-y-6">
      <!-- Active Campaigns Card -->
      <div
        class="p-6 text-center bg-white rounded-2xl border border-slate-100 shadow-sm"
      >
        <div
          class="flex w-12 h-12 mb-3 mx-auto text-white bg-primary rounded-lg items-center justify-center"
        >
          <svg
            width="24"
            height="24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
          >
            <rect width="20" height="14" x="2" y="3" rx="2" />
            <line x1="8" x2="16" y1="21" y2="21" />
            <line x1="12" x2="12" y1="17" y2="21" />
          </svg>
        </div>

        <h3 class="mb-1 text-lg font-bold text-slate-900">
          {{ $openJobsCount }} Active campaigns
        </h3>

        <button
          onclick="window.location.href='{{ route("create-job") }}'"
          class="w-full py-2 mb-3 mt-4 text-white font-bold text-sm bg-primary rounded-lg transition-all hover:bg-primary/90"
        >
          Create campaign
        </button>

        <button
          class="text-xs font-bold text-slate-500 hover:text-primary underline underline-offset-2"
        >
          Buy more credits
        </button>
      </div>

      <!-- Ratings Cards -->

      <div class="mt-8">
        <x-ratings-panel-card :user="auth()->user()" />
      </div>

      <!-- Recommended Influencers -->
      @include("business.partials.recommended")

      <!-- Sidebar Menu -->
      <div class="p-2 bg-white rounded-2xl border border-slate-100 shadow-sm">
        <button
          class="flex w-full p-3 text-sm font-medium text-slate-700 rounded-lg items-center justify-between hover:bg-slate-50 transition"
        >
          View analytics
          <svg
            width="14"
            height="14"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
          >
            <path d="m7 7 10 10" />
            <path d="M17 7v10H7" />
          </svg>
        </button>

        <button
          class="flex w-full p-3 text-sm font-medium text-slate-700 rounded-lg items-center justify-between hover:bg-slate-50 transition"
        >
          View stats
          <svg
            width="14"
            height="14"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
          >
            <path d="m7 7 10 10" />
            <path d="M17 7v10H7" />
          </svg>
        </button>

        <button
          class="flex w-full p-3 text-sm font-medium text-slate-700 rounded-lg items-center justify-between hover:bg-slate-50 transition"
        >
          Help Center
          <svg
            width="14"
            height="14"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
          >
            <path d="m7 7 10 10" />
            <path d="M17 7v10H7" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const buttons = document.querySelectorAll('.tab-btn');
      const sections = document.querySelectorAll('.tab-section');
      const viewAllBtn = document.getElementById('view-all-btn');

      let activeSection = null;

      function updateViewAllForSection(section) {
        if (!viewAllBtn || !section) return;

        const cards = Array.from(section.querySelectorAll('.job-card'));

        cards.forEach((card) => card.classList.remove('hidden'));

        if (cards.length <= 3) {
          viewAllBtn.classList.add('hidden');
          viewAllBtn.dataset.state = '';
          return;
        }

        cards.forEach((card, index) => {
          if (index > 2) {
            card.classList.add('hidden');
          }
        });

        viewAllBtn.classList.remove('hidden');
        viewAllBtn.textContent = 'View all';
        viewAllBtn.dataset.state = 'collapsed';
      }

      buttons.forEach((btn) => {
        btn.addEventListener('click', () => {
          const target = btn.getAttribute('data-tab-btn');

          buttons.forEach((b) => {
            b.classList.remove(
              'text-slate-900',
              'font-bold',
              'border-slate-900',
            );
            b.classList.add(
              'text-slate-500',
              'font-medium',
              'border-transparent',
            );
          });
          btn.classList.add('text-slate-900', 'font-bold', 'border-slate-900');
          btn.classList.remove('text-slate-500', 'border-transparent');

          sections.forEach((sec) => {
            if (sec.getAttribute('data-tab-section') === target) {
              sec.classList.remove('hidden');
              activeSection = sec;
            } else {
              sec.classList.add('hidden');
            }
          });

          if (activeSection) {
            updateViewAllForSection(activeSection);
          }
        });
      });

      activeSection =
        Array.from(sections).find((sec) => !sec.classList.contains('hidden')) ||
        sections[0];
      if (activeSection) {
        updateViewAllForSection(activeSection);
      }

      if (viewAllBtn) {
        viewAllBtn.addEventListener('click', () => {
          if (!activeSection) return;

          const cards = Array.from(activeSection.querySelectorAll('.job-card'));
          const state = viewAllBtn.dataset.state || 'collapsed';

          if (state === 'collapsed') {
            cards.forEach((card) => card.classList.remove('hidden'));
            viewAllBtn.textContent = 'View less';
            viewAllBtn.dataset.state = 'expanded';
          } else {
            cards.forEach((card, index) => {
              if (index > 2) {
                card.classList.add('hidden');
              } else {
                card.classList.remove('hidden');
              }
            });
            viewAllBtn.textContent = 'View all';
            viewAllBtn.dataset.state = 'collapsed';
          }
        });
      }
    });
  </script>
@endsection
