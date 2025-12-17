@props([
    'user' => auth()->user(),
    'viewAllUrl' => null,
])

@php
    $avgRating     = $user->averageRating();
    $ratingsCount  = $user->ratingsReceived()->count();
    $latestRatings = $user->ratingsReceived()
        ->with(['fromUser', 'job'])
        ->latest()
        ->take(3)
        ->get();
@endphp

<div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
    <div class="flex items-start justify-between gap-3 mb-4">
        <div>
            <p class="text-[11px] font-medium uppercase tracking-wide text-slate-400">
                Your rating
            </p>

            @if($ratingsCount > 0)
                <div class="mt-1 flex items-center gap-2">
                    <x-star-rating :score="$avgRating" size="w-4 h-4" />
                    <span class="text-xl font-bold text-slate-900">
                        {{ number_format($avgRating, 1) }}/5
                    </span>
                </div>
                <p class="mt-1 text-[12px] text-slate-500">
                    Based on <span class="font-semibold">{{ $ratingsCount }}</span> review{{ $ratingsCount === 1 ? '' : 's' }}.
                </p>
            @else
                <p class="mt-1 text-[12px] text-slate-500">
                    You haven't received any ratings yet.
                </p>
            @endif
        </div>

        <span class="text-[11px] text-slate-400 whitespace-nowrap">
            Private · only visible to you
        </span>
    </div>

    @if($latestRatings->isNotEmpty())
        <div class="mt-4 pt-4 border-t border-slate-100">
            <p class="mb-3 text-[11px] font-medium uppercase tracking-wide text-slate-400">
                Latest reviews
            </p>

            <ul class="space-y-3">
                @foreach($latestRatings as $rating)
                    <li class="flex justify-between gap-3">
                        <div class="flex-1 min-w-0">
                            <p class="text-[13px] font-semibold text-slate-900 truncate">
                                {{ $rating->fromUser->name ?? 'Unknown user' }}
                            </p>

                            @if($rating->job)
                                <p class="text-[11px] text-slate-400 truncate">
                                    On campaign: {{ $rating->job->campaign_name }}
                                </p>
                            @endif

                            @if($rating->comment)
                                <p class="mt-1 text-[11px] text-slate-500 line-clamp-2">
                                    “{{ $rating->comment }}”
                                </p>
                            @endif

                            <p class="mt-1 text-[10px] text-slate-400">
                                {{ $rating->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>

                        <div class="flex flex-col items-end gap-1 shrink-0">
                            <x-star-rating :score="$rating->score" size="w-3 h-3" />
                            <span class="text-[11px] font-medium text-slate-700">
                                {{ $rating->score }}/5
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>

            @if($viewAllUrl)
                <div class="mt-3 flex justify-end">
                    <a href="{{ $viewAllUrl }}"
                       class="text-[11px] font-medium text-primary hover:underline">
                        View all
                    </a>
                </div>
            @endif
        </div>
    @endif
</div>
