@extends("layouts.loggedin-layout")

@section("title", "Influentia - Dashboard")

@section("content")
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
    @include("components.dna-banner", ["dnaScore" => $dnaScore ?? null])

    <div class="flex gap-3">
      <a
        href="{{ route("jobs.index") }}"
        class="flex px-6 py-2 text-white text-xs font-bold bg-primary rounded-lg transition-all hover:bg-primary/90 items-center gap-2"
      >
        Find a job
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
          <path d="m9 18 6-6-6-6" />
        </svg>
      </a>

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

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 mb-12 gap-4 sm:grid-cols-2 lg:grid-cols-4">
    <div class="p-6 text-center bg-[#fbf9ff] rounded-xl border border-slate-50">
      <p class="mb-2 text-xs font-bold text-slate-600">Revenue</p>
      <p class="mb-1 text-xl font-bold text-slate-900">$2500</p>
      <p class="text-[10px] text-slate-500">$4500 committed</p>
    </div>

    <div class="p-6 text-center bg-[#fbf9ff] rounded-xl border border-slate-50">
      <p class="mb-2 text-xs font-bold text-slate-600">Current Jobs</p>
      <p class="mb-1 text-xl font-bold text-slate-900">
        {{ $activeJobsCount }}
      </p>
      <p class="text-[10px] text-slate-500">
        {{ $activeJobsCount }} active jobs
      </p>
    </div>

    <div class="p-6 text-center bg-[#fbf9ff] rounded-xl border border-slate-50">
      <p class="mb-2 text-xs font-bold text-slate-600">Applied For</p>
      <p class="mb-1 text-xl font-bold text-slate-900">{{ $appliedCount }}</p>
      <p class="text-[10px] text-slate-500">Total applications</p>
    </div>

    <div class="p-6 text-center bg-[#fbf9ff] rounded-xl border border-slate-50">
      <p class="mb-2 text-xs font-bold text-slate-600">
        Application Success Rate
      </p>
      <p class="mb-1 text-xl font-bold text-slate-900">{{ $successRate }}%</p>
      <p class="text-[10px] text-slate-500">
        Based on {{ $appliedCount }} applications
      </p>
    </div>
  </div>

  <!-- Main Grid -->
  <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
    <!-- LEFT: Jobs -->
    <div class="lg:col-span-2">
      <h2 class="mb-1 text-lg font-bold text-slate-900">Your jobs</h2>
      <p class="mb-6 text-xs text-slate-500">
        Basic information about the job.
      </p>

      <!-- Tabs -->
      <div class="flex mb-8 border-b border-slate-100 gap-6">
        <button
          data-tab="matched"
          class="pb-2 text-sm font-bold text-slate-900 border-b-2 border-slate-900 tab-btn"
        >
          Matched Jobs
        </button>
        <button
          data-tab="applications"
          class="pb-2 text-sm font-medium text-slate-500 hover:text-primary tab-btn"
        >
          My application
        </button>
        <button
          data-tab="active"
          class="pb-2 text-sm font-medium text-slate-500 hover:text-primary tab-btn"
        >
          Active Jobs
        </button>
      </div>

      <!-- Matched Jobs -->
      <div class="space-y-8" data-tab-section="matched">
        @forelse ($matchedJobs as $job)
          @php
            $brandProfile = optional(optional($job->user)->brandProfile);
            $title = $job->campaign_name ?? ($job->title ?? "Untitled Job");
            $brandName = $brandProfile?->company_name ?? (optional($job->user)->name ?? "Brand");
            $location = $brandProfile?->location ?? "Anywhere";
            $description = $job->campaign_overview ?? ($job->description ?? "No description provided.");
            $min = $job->budget_min;
            $max = $job->budget_max;
            $budgetText = $min && $max ? "$" . number_format($min) . " - $" . number_format($max) : "Budget not specified";
          @endphp

          <div class="pb-8 border-b border-slate-50">
            <div class="flex mb-2 justify-between items-start">
              <h3 class="text-base font-bold text-slate-900">
                {{ $title }} -
                <span class="text-primary">
                  {{ $job->match_score ?? 0 }}% Match
                </span>
              </h3>
            </div>

            <div class="flex justify-between items-end">
              <div class="max-w-lg">
                <p class="mb-4 text-sm text-slate-600">
                  {{ \Illuminate\Support\Str::limit($description, 180) }}
                </p>

                <div class="flex text-xs text-slate-500 items-center gap-4">
                  <span class="flex items-center gap-1">
                    <svg
                      width="14"
                      height="14"
                      viewBox="0 0 24 24"
                      class="stroke-current"
                      fill="none"
                      stroke-width="2"
                    >
                      <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                    </svg>
                    {{ $brandName }}
                  </span>

                  <span class="flex items-center gap-1">
                    <svg
                      width="14"
                      height="14"
                      viewBox="0 0 24 24"
                      class="stroke-current"
                      fill="none"
                      stroke-width="2"
                    >
                      <path
                        d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"
                      ></path>
                      <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    {{ $location }}
                  </span>

                  <span class="flex items-center gap-1">
                    <svg
                      width="14"
                      height="14"
                      viewBox="0 0 24 24"
                      class="stroke-current"
                      fill="none"
                      stroke-width="2"
                    >
                      <path
                        d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"
                      ></path>
                      <polyline points="14 2 14 8 20 8"></polyline>
                      <line x1="16" y1="13" x2="8" y2="13"></line>
                      <line x1="16" y1="17" x2="8" y2="17"></line>
                    </svg>
                    {{ $budgetText }}
                  </span>
                </div>
              </div>

              <a
                href="{{ route("jobs.show", $job) }}"
                class="text-xs font-bold text-primary hover:underline"
              >
                View Job
              </a>
            </div>
          </div>
        @empty
          <p class="text-sm text-slate-500">
            No matched jobs yet. Update your profile or browse all jobs.
          </p>
        @endforelse

        <div class="flex pt-2 justify-center">
          <a
            href="{{ route("jobs.index") }}"
            class="px-4 py-2 text-xs font-bold text-white bg-primary rounded-lg transition-colors shadow-sm hover:bg-primary/90"
          >
            View all jobs
          </a>
        </div>
      </div>

      <!-- My application -->
      <div class="hidden space-y-8" data-tab-section="applications">
        @forelse ($applications as $application)
          @php
            $job = $application->job;
            $title = $job->title ?? ($job->campaign_name ?? "Untitled job");
            $description = $job->short_description ?? ($job->description ?? null);
          @endphp

          <div class="pb-8 border-b border-slate-50">
            <div class="flex mb-2 justify-between items-start">
              <h3 class="text-base font-bold text-slate-900">
                {{ $title }}
              </h3>

              <span
                class="text-xs font-semibold @if ($application->status ===
                    '
                                        pending')
                    text-amber-600
                @elseif ($application->status === "declined")
                    text-red-600
                @elseif ($application->status === "completed")
                    text-slate-500
                @else
                    text-emerald-600
                @endif"
              >
                {{ ucfirst($application->status) }}
              </span>
            </div>

            <div class="flex justify-between items-end">
              <div class="max-w-lg">
                <p class="mb-4 text-sm text-slate-600">
                  {{ $description ? Str::limit($description, 160) : "No description provided." }}
                </p>

                <p class="text-xs text-slate-400">
                  Applied on {{ $application->created_at->format("M d, Y") }}
                </p>
              </div>

              <div class="flex items-center gap-2">
                <a
                  href="{{ route("jobs.show", $job) }}"
                  class="flex text-xs font-bold text-slate-900 hover:text-primary items-center gap-1"
                >
                  View job
                  <svg
                    width="12"
                    height="12"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                  >
                    <path d="m9 18 6-6-6-6" />
                  </svg>
                </a>

                @if (in_array($application->status, ["pending", "declined"]))
                  <form
                    method="POST"
                    action="{{ route("influencer.applications.destroy", $application) }}"
                  >
                    @csrf
                    @method("DELETE")
                    <button
                      type="submit"
                      class="px-3 py-1.5 text-xs font-bold text-slate-600 rounded-lg border border-slate-200 transition-colors hover:bg-slate-50"
                    >
                      {{ $application->status === "pending" ? "Cancel" : "Delete" }}
                    </button>
                  </form>
                @endif
              </div>
            </div>
          </div>
        @empty
          <p class="text-sm text-slate-500">
            You haven't applied to any jobs yet.
          </p>
        @endforelse
      </div>

      <!-- Active Jobs -->
      <div class="hidden space-y-8" data-tab-section="active">
        @forelse ($activeJobs as $application)
          @php
            $job = $application->job;
            $title = $job->title ?? ($job->campaign_name ?? "Untitled job");
            $description = $job->short_description ?? ($job->description ?? null);
          @endphp

          <div class="pb-8 border-b border-slate-50">
            <div class="flex mb-2 justify-between items-start">
              <h3 class="text-base font-bold text-slate-900">
                {{ $title }}
              </h3>
              <span class="text-xs font-semibold text-emerald-600">Active</span>
            </div>

            <div class="flex justify-between items-end">
              <div class="max-w-lg">
                <p class="mb-4 text-sm text-slate-600">
                  {{ $description ? Str::limit($description, 160) : "No description provided." }}
                </p>

                <p class="text-xs text-slate-400">
                  Accepted on {{ $application->updated_at->format("M d, Y") }}
                </p>
              </div>

              <a
                href="{{ route("jobs.show", $job) }}"
                class="flex text-xs font-bold text-slate-900 hover:text-primary items-center gap-1"
              >
                View job
                <svg
                  width="12"
                  height="12"
                  viewBox="0 0 24 24"
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
            You don't have any active jobs yet.
          </p>
        @endforelse
      </div>
    </div>

    <!-- RIGHT: Sidebar -->
    <div class="space-y-6">
      <!-- Coins Card -->
      @include("components.coins-card")

      <div class="mt-8">
        <x-ratings-panel-card :user="auth()->user()" />
      </div>

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
            stroke-width="2"
            stroke="currentColor"
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
            stroke-width="2"
            stroke="currentColor"
          >
            <path d="m7 7 10 10" />
            <path d="M17 7v10H7" />
          </svg>
        </button>

        <button
          class="flex w-full p-3 text-sm font-medium text-slate-700 rounded-lg transition-colors items-center justify-between hover:bg-slate-50"
        >
          View stats
          <svg
            width="14"
            height="14"
            viewBox="0 0 24 24"
            fill="none"
            stroke-width="2"
            stroke="currentColor"
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
            stroke-width="2"
            stroke="currentColor"
          >
            <path d="m7 7 10 10" />
            <path d="M17 7v10H7" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const tabButtons = document.querySelectorAll('.tab-btn[data-tab]');
      const sections = document.querySelectorAll('[data-tab-section]');

      tabButtons.forEach((btn) => {
        btn.addEventListener('click', () => {
          const target = btn.dataset.tab;

          tabButtons.forEach((b) => {
            b.classList.remove(
              'border-b-2',
              'border-slate-900',
              'text-slate-900',
              'font-bold',
            );
            b.classList.add('text-slate-500', 'font-medium');
          });
          btn.classList.remove('text-slate-500', 'font-medium');
          btn.classList.add(
            'border-b-2',
            'border-slate-900',
            'text-slate-900',
            'font-bold',
          );

          sections.forEach((sec) => {
            if (sec.dataset.tabSection === target) {
              sec.classList.remove('hidden');
            } else {
              sec.classList.add('hidden');
            }
          });
        });
      });
    });
  </script>
@endsection
