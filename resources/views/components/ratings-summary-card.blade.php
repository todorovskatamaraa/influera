@props([
    'user' => auth()->user(),
])

@php
    $avgRating = $user->averageRating();
    $ratingsCount = $user->ratingsReceived()->count();
@endphp

<div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-slate-900">
            Your rating
        </h2>
        <span class="text-[11px] text-slate-400">
            Private · only visible to you
        </span>
    </div>

    @if($ratingsCount > 0)
        <div class="flex items-center gap-3 mb-2">
            <x-star-rating :score="$avgRating" size="w-5 h-5" />
            <span class="text-2xl font-bold text-slate-900">
                {{ number_format($avgRating, 1) }}/5
            </span>
        </div>
        <p class="text-sm text-slate-500">
            Based on <span class="font-semibold">{{ $ratingsCount }}</span> review{{ $ratingsCount === 1 ? '' : 's' }}.
        </p>
    @else
        <p class="text-sm text-slate-500">
            You haven't received any ratings yet.
        </p>
    @endif
</div>
