@extends("layouts.loggedin-layout")

@section("title", "Influentia - Job Details")

@section("content")
@php
  $currentUser = auth()->user();
  $alreadyApplied = $currentUser ? $job->appliedByUser($currentUser->id) : false;
@endphp

<main class="container mx-auto px-6 py-8 md:px-12 lg:px-24">

  {{-- HEADER --}}
  <div
    class="flex flex-col p-6 mb-8 bg-gradient-to-r from-[#eef2ff] to-[#f0fdfa] border border-slate-100 rounded-2xl shadow-sm justify-between items-start gap-6 md:flex-row md:p-8 md:items-center"
  >
    <div class="flex items-center gap-4 md:gap-6">
      <div
        class="flex overflow-hidden w-16 h-16 bg-white rounded-full shadow-md items-center justify-center shrink-0 md:w-20 md:h-20"
      >
        <img
          src="{{ asset(optional($job->user->brandProfile)->company_logo_path ?? 'images/default-logo.jpg') }}"
          alt="{{ $job->user->name }}"
          class="object-cover w-full h-full"
        />
      </div>
      <div>
        <h1 class="mb-1 text-2xl font-bold text-slate-900 md:text-3xl">
          {{ $job->campaign_name }}
        </h1>
        <p class="text-lg font-medium text-slate-600">
          {{ $job->user->name }}
        </p>
      </div>
    </div>

    <div class="flex w-full gap-3 md:w-auto">
      @auth
        @if ($currentUser->role === 'influencer')
          @if ($alreadyApplied)
            <div class="inline-flex px-4 py-2.5 text-sm font-semibold text-green-700 bg-green-100 rounded-lg">
              Already Applied
            </div>
          @else
            <a
              href="{{ route('jobs.apply', $job) }}"
              class="inline-flex px-4 py-2.5 text-sm font-semibold text-white bg-primary rounded-lg shadow-sm hover:bg-primary/90"
            >
              Apply
            </a>
          @endif
        @else
          <div class="inline-flex px-4 py-2.5 text-sm font-semibold text-slate-600 bg-slate-100 rounded-lg">
            -
          </div>
        @endif
      @endauth
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    {{-- LEFT CONTENT --}}
    <div class="lg:col-span-2 space-y-10">

      {{-- ABOUT --}}
      <section>
        <h2 class="mb-4 text-xl font-bold text-slate-900">About this Opportunity</h2>
        <p class="text-slate-600 leading-relaxed">
          {{ $job->campaign_overview }}
        </p>
      </section>

      {{-- DELIVERABLES --}}
      <section>
        <h2 class="mb-4 text-xl font-bold text-slate-900">Deliverables</h2>
        @php
          $platforms = implode(', ', $job->platforms ?? []);
          $deliverables = [
            $job->content_amount.' total deliverables across: '.$platforms,
            'Content tone: '.$job->content_tone,
            'Preferred influencer tier: '.$job->influencer_tier,
            'Audience age: '.$job->age_min.' - '.$job->age_max,
          ];
        @endphp

        <ul class="space-y-3">
          @foreach($deliverables as $item)
            <li class="flex items-start gap-3">
              <span class="font-medium text-slate-700">{{ $item }}</span>
            </li>
          @endforeach
        </ul>
      </section>

    </div>

    {{-- RIGHT SIDEBAR --}}
    <div class="space-y-6">

      @php
        $nicheMatch  = $matchBreakdown['niche'] ?? null;
        $ageMatch    = $matchBreakdown['age'] ?? null;
        $genderMatch = $matchBreakdown['gender'] ?? null;

        $nicheWidth  = is_numeric($nicheMatch) ? max(0, min(100, (int) $nicheMatch)) : 0;
        $ageWidth    = is_numeric($ageMatch) ? max(0, min(100, (int) $ageMatch)) : 0;
        $genderWidth = is_numeric($genderMatch) ? max(0, min(100, (int) $genderMatch)) : 0;
      @endphp

  <div class="flex flex-col min-h-[300px] p-8 bg-white border border-cyan-100 rounded-2xl shadow-sm justify-between">
    <div>
      <div class="flex mb-2 items-center gap-2">
        <span class="text-2xl font-bold text-cyan-500">%</span>
        <h3 class="text-xl font-bold text-slate-900">Your DNA Match</h3>
      </div>

      <p class="mb-6 text-sm text-slate-500">
        How well you align with this campaign
      </p>

      {{-- Main match score --}}
      <div class="flex mb-6 justify-center">
        <div class="text-6xl font-extrabold text-slate-900">
          @if (! is_null($matchScore ?? null))
            {{ (int) $matchScore }}%
          @else
            —
          @endif
        </div>
      </div>

      <div class="space-y-4 text-xs">
        {{-- Niche Match --}}
        <div>
          <div class="flex mb-1 items-center justify-between">
            <span class="font-medium text-slate-700">Niche Match</span>
            <span class="font-semibold text-slate-900">
              @if (! is_null($nicheMatch))
                {{ (int) $nicheMatch }}%
              @else
                —
              @endif
            </span>
          </div>
          <div class="overflow-hidden w-full h-2 bg-slate-100 rounded-full">
            <div class="h-2 rounded-full" style="width: {{ $nicheWidth }}%; background-color: #4f46e5;"></div>
          </div>
        </div>

        {{-- Age Match --}}
        <div>
          <div class="flex mb-1 items-center justify-between">
            <span class="font-medium text-slate-700">Age Match</span>
            <span class="font-semibold text-slate-900">
              @if (! is_null($ageMatch))
                {{ (int) $ageMatch }}%
              @else
                —
              @endif
            </span>
          </div>
          <div class="overflow-hidden w-full h-2 bg-slate-100 rounded-full">
            <div class="h-2 rounded-full" style="width: {{ $ageWidth }}%; background-color: #a855f7;"></div>
          </div>
        </div>

        {{-- Gender Match --}}
        <div>
          <div class="flex mb-1 items-center justify-between">
            <span class="font-medium text-slate-700">Gender Match</span>
            <span class="font-semibold text-slate-900">
              @if (! is_null($genderMatch))
                {{ (int) $genderMatch }}%
              @else
                —
              @endif
            </span>
          </div>
          <div class="overflow-hidden w-full h-2 bg-slate-100 rounded-full">
            <div class="h-2 rounded-full" style="width: {{ $genderWidth }}%; background-color: #06b6d4;"></div>
          </div>
        </div>
      </div>
    </div>

    @if (! $currentUser || $currentUser->role === 'influencer')
      <div class="mt-8">
        @if ($alreadyApplied)
          <div class="w-full py-4 text-lg font-bold text-green-700 text-center bg-green-50 border border-green-100 rounded-xl">
            Already Applied
          </div>
        @else
          <button
            class="w-full py-4 text-lg font-bold text-white bg-primary rounded-xl shadow-lg shadow-primary/20 hover:bg-primary/90"
            onclick="window.location.href='{{ route('jobs.apply', $job) }}'"
          >
            Apply Now
          </button>
        @endif
      </div>
    @endif
  </div>

      {{-- ================= ESCROW BLOCK ================= --}}
      @if($currentUser && $currentUser->id === $job->user_id && $currentUser->role === 'brand')
        @php
          $approvedApplicants = $job->applications()
              ->where('status', 'accepted')
              ->with('user')
              ->get()
              ->map(function ($application) use ($job) {
                  $influencer = $application->user;

                  $escrow = \App\Models\Escrow::where('job_id', $job->id)
                      ->where('influencer_id', $influencer->id)
                      ->first();

                  $priority = 1;
                  if ($escrow && $escrow->status === 'funded')   $priority = 2;
                  if ($escrow && $escrow->status === 'released') $priority = 3;

                  return [
                      'influencer' => $influencer,
                      'escrow'     => $escrow,
                      'priority'   => $priority,
                  ];
              })
              ->sortBy('priority')
              ->values();
        @endphp


        <div class="p-6 bg-white border border-slate-200 rounded-2xl shadow-sm">
          <h3 class="mb-4 text-sm font-semibold text-slate-900">
            Approved creators & Escrow
          </h3>

          @if($approvedApplicants->isEmpty())
            <p class="text-xs text-slate-500">
              No approved creators yet.
            </p>
          @else
            <div class="space-y-4">
             @foreach($approvedApplicants as $row)
                @php
                  $influencer = $row['influencer'];
                  $escrow     = $row['escrow'];
                @endphp

                <div class="border border-slate-100 rounded-xl p-3 text-xs space-y-2">
                  <p class="font-semibold text-slate-900">{{ $influencer->name }}</p>

                  <div class="text-[11px] text-slate-500">
                    @if(!$escrow)
                      No escrow yet
                    @elseif($escrow->status === 'funded')
                      <span class="text-emerald-600 font-medium">
                        Funded €{{ $escrow->amount }}
                      </span>
                    @elseif($escrow->status === 'released')
                      <span class="text-slate-700 font-medium">
                        Released €{{ $escrow->amount }}
                      </span>
                    @endif
                  </div>

                  <div class="flex items-center gap-2 pt-2 border-t border-slate-100">
                    @if(!$escrow)
                      <form method="POST" action="{{ route('escrow.fund', $job) }}" class="flex gap-1">
                        @csrf
                        <input type="hidden" name="influencer_id" value="{{ $influencer->id }}">
                        <input
                          type="number"
                          name="amount"
                          placeholder="€"
                          class="w-20 px-2 py-1 text-[11px] border rounded-lg"
                          required
                        >
                        <button class="px-3 py-1.5 text-[11px] text-white bg-slate-900 rounded-lg">
                          Fund
                        </button>
                      </form>
                    @elseif($escrow->status === 'funded')
                      <form method="POST" action="{{ route('escrow.release', $escrow) }}">
                        @csrf
                        <button class="px-3 py-1.5 text-[11px] text-emerald-700 bg-emerald-50 rounded-lg">
                          Release
                        </button>
                      </form>
                    @endif
                  </div>

                </div>
              @endforeach
            </div>
          @endif
        </div>
      @endif
    </div>
  </div>
</main>
@endsection
