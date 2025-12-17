@props([
    'user' => auth()->user(),
])

@php
    $latestRatings = $user->ratingsReceived()
        ->with(['fromUser', 'job'])
        ->latest()
        ->take(5)
        ->get();
@endphp

<div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-slate-900">
            Latest reviews
        </h2>
        <span class="text-[11px] text-slate-400">
            Private
        </span>
    </div>

    @if($latestRatings->isEmpty())
        <p class="text-sm text-slate-500">
            You don't have any reviews yet.
        </p>
    @else
        <ul class="space-y-4">
            @foreach($latestRatings as $rating)
                <li class="border-b border-slate-100 pb-3 last:border-b-0 last:pb-0">
                    <div class="flex items-center justify-between mb-1">
                        <div class="flex flex-col">
                            <span class="text-sm font-semibold text-slate-900">
                                {{ $rating->fromUser->name ?? 'Unknown user' }}
                            </span>
                            @if($rating->job)
                                <span class="text-xs text-slate-400">
                                    On campaign: {{ $rating->job->campaign_name }}
                                </span>
                            @endif
                        </div>

                        <div class="flex items-center gap-2">
                            <x-star-rating :score="$rating->score" size="w-4 h-4" />
                            <span class="text-xs font-medium text-slate-700">
                                {{ $rating->score }}/5
                            </span>
                        </div>
                    </div>

                    @if($rating->comment)
                        <p class="mt-1 text-xs text-slate-600">
                            “{{ $rating->comment }}”
                        </p>
                    @endif

                    <p class="mt-1 text-[11px] text-slate-400">
                        {{ $rating->created_at->format('d M Y, H:i') }}
                    </p>
                </li>
            @endforeach
        </ul>
    @endif
</div>
