@php
    $dnaScoreLocal = $dnaScore ?? null;

    $dnaLabel    = null;
    $dnaColor    = 'text-slate-500';
    $dnaSubtitle = 'Complete your profile and connect brands to see your compatibility.';

    if (! is_null($dnaScoreLocal)) {
        $dnaScoreLocal = max(0, min(100, (int) $dnaScoreLocal));

        if ($dnaScoreLocal >= 80) {
            $dnaLabel    = 'Excellent compatibility';
            $dnaColor    = 'text-emerald-500';
            $dnaSubtitle = 'Your profile is a near-perfect match with most brands in our database.';
        } elseif ($dnaScoreLocal >= 60) {
            $dnaLabel    = 'Strong compatibility';
            $dnaColor    = 'text-primary';
            $dnaSubtitle = 'Your profile has a strong match with many brands in our database.';
        } elseif ($dnaScoreLocal >= 40) {
            $dnaLabel    = 'Moderate compatibility';
            $dnaColor    = 'text-amber-500';
            $dnaSubtitle = 'There is a decent match – a few tweaks to your DNA could improve it.';
        } elseif ($dnaScoreLocal > 0) {
            $dnaLabel    = 'Low compatibility';
            $dnaColor    = 'text-rose-500';
            $dnaSubtitle = 'Only a small part of your DNA matches brands right now. Try updating your niches, tones and values.';
        } else {
            $dnaLabel    = 'No compatibility yet';
            $dnaColor    = 'text-slate-400';
            $dnaSubtitle = 'Complete your Influencer DNA and connect with more matching brands.';
        }
    }
@endphp

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
                    @if (! is_null($dnaScoreLocal))
                        {{ $dnaScoreLocal }}%
                    @else
                        —
                    @endif
                </span>
            </div>
        </div>
    </div>

    <div>
        @if (! is_null($dnaScoreLocal))
            <h3 class="text-base font-bold text-slate-900">
                Your Influencer DNA has
                <span class="{{ $dnaColor }}">{{ $dnaLabel }}</span>
            </h3>
            <p class="text-xs text-slate-500">
                {{ $dnaSubtitle }}
            </p>
        @else
            <h3 class="text-base font-bold text-slate-900">
                Set up your Influencer DNA
            </h3>
            <p class="text-xs text-slate-500">
                {{ $dnaSubtitle }}
            </p>
        @endif
    </div>
</div>
