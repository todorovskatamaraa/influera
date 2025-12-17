@props([
    'user'
])

@php
    $avgRating = $user->averageRating();
    $ratingsCount = $user->ratingsReceived()->count();
@endphp

@if($ratingsCount > 0)
<div class="flex items-center gap-2">
    <x-star-rating :score="$avgRating" size="w-4 h-4" />

    <span class="text-sm font-semibold text-slate-900">
        {{ number_format($avgRating, 1) }}/5
    </span>

    <span class="text-xs text-slate-500">
        ({{ $ratingsCount }} review{{ $ratingsCount === 1 ? '' : 's' }})
    </span>
</div>
@endif
