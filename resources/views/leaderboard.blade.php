@extends('layouts.loggedin-layout')

@section('title', 'Leaderboard')

@section('content')
<main class="container mx-auto px-6 py-8 md:px-12 lg:px-24">

    <h1 class="text-3xl font-extrabold text-slate-900 mb-6">Leaderboard</h1>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <h2 class="text-lg font-bold text-slate-900 mb-4">Top Influencers</h2>

        @if($topInfluencers->isEmpty())
            <p class="text-slate-500 text-sm">No influencers ranked yet.</p>
        @else
            <div class="space-y-4">

                @foreach($topInfluencers as $rank => $entry)

                    @php
                        $user         = $entry['user'];
                        $profile      = $entry['profile'];
                        $avatar       = $entry['avatar'];
                        $location     = $entry['location'];
                        $primaryNiche = $entry['primary_niche'];
                    @endphp

                    <div class="flex flex-col gap-3 border-b pb-4 last:border-b-0 last:pb-0 md:flex-row md:items-center md:justify-between">

                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full overflow-hidden border bg-slate-100">
                                <img src="{{ $avatar }}" alt="{{ $user->name }} Avatar"
                                     class="w-full h-full object-cover">
                            </div>

                            <div>
                                <p class="font-semibold text-slate-900">
                                    {{ $rank + 1 }}. {{ $user->name }}
                                </p>

                                <p class="text-sm text-slate-500">
                                    {{ $location }}
                                    @if($primaryNiche)
                                        &middot; {{ $primaryNiche }}
                                    @endif
                                </p>

                                <p class="text-sm text-slate-500">
                                    {{ $entry['completed_jobs'] }} completed projects
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">

                            <div class="flex text-yellow-400 text-xl leading-none">
                                @for($i = 1; $i <= 5; $i++)
                                    <span>
                                        @if($i <= round($entry['avg_rating']))
                                            &#9733;
                                        @else
                                            &#9734;
                                        @endif
                                    </span>
                                @endfor
                            </div>

                            <p class="text-slate-700 font-medium">
                                {{ number_format($entry['avg_rating'], 1) }}/5
                            </p>

                        </div>
                    </div>

                @endforeach

            </div>
        @endif

    </div>

</main>
@endsection
