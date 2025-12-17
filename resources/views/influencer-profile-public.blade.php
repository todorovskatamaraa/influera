@extends('layouts.loggedin-layout')

@section('title', 'Influentia - ' . $user->name)

@section('content')

    @php
        $hasCover = ! empty($profile->cover_path);
        $cover = $hasCover ? asset($profile->cover_path) : null;

        $hasAvatar = ! empty($profile->avatar_path);
        $avatar = $hasAvatar ? asset($profile->avatar_path) : null;
        $avatarFallback = asset('images/default-avatar.jpg');
        $initials = collect(explode(' ', $user->name))
            ->filter()
            ->map(fn ($part) => mb_substr($part, 0, 1))
            ->join('');

        $location = $profile->location ?? 'Location not specified';
        $phone    = $profile->phone ?? 'Not provided';

        $niches = is_array($profile->niches)
            ? $profile->niches
            : (json_decode($profile->niches ?? '[]', true) ?? []);

        $collabTypes = is_array($profile->collaboration_types ?? null)
            ? $profile->collaboration_types
            : (json_decode($profile->collaboration_types ?? '[]', true) ?? []);

        $contentTypes = is_array($profile->content_types ?? null)
            ? $profile->content_types
            : (json_decode($profile->content_types ?? '[]', true) ?? []);

        $previousCollabs = $profile->previous_collaborations
            ? array_filter(array_map('trim', explode(',', $profile->previous_collaborations)))
            : [];

        $canContact = auth()->check() && auth()->id() !== $user->id;
        $matchPercent = $matchScore ?? null;
    @endphp

    {{-- Profile Header --}}
    <div class="relative mb-24">
        <div class="h-64 md:h-80 w-full rounded-2xl overflow-hidden relative bg-slate-900">
            @if ($hasCover)
                <img src="{{ $cover }}" class="w-full h-full object-cover" alt="Cover image">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent z-10"></div>
            @else
                <div class="absolute inset-0 bg-slate-900"></div>
                <div class="absolute w-48 h-48 bg-slate-700/50 rounded-full -left-16 top-10 blur-2xl"></div>
                <div class="absolute w-60 h-60 bg-primary/40 rounded-full right-0 bottom-0 blur-3xl"></div>
                <div class="absolute inset-0 flex items-end md:items-center px-8 md:px-12 pb-6">
                    <div>
                        <p class="text-xs font-semibold tracking-wide text-indigo-200 uppercase">Creator space</p>
                        <p class="mt-1 text-lg font-semibold text-slate-100">
                            Make your profile stand out with great visuals.
                        </p>
                    </div>
                </div>
            @endif
        </div>

        <div
            class="absolute -bottom-20 left-0 right-0 px-6 md:px-12 flex flex-col md:flex-row items-end md:items-center justify-between gap-4"
        >
            <div class="flex items-end gap-6 relative z-20">
                <div class="w-32 h-32 rounded-full border-4 border-white bg-black overflow-hidden shadow-lg shrink-0 flex items-center justify-center">
                    @if ($hasAvatar)
                        <img src="{{ $avatar }}" class="w-full h-full object-cover" alt="Avatar">
                    @else
                        <span class="text-3xl font-extrabold text-white">{{ $initials }}</span>
                    @endif
                </div>

                <div class="pb-2">
                    <h1 class="text-3xl font-extrabold text-slate-900">{{ $user->name }}</h1>

                    <div class="flex items-center gap-4 text-slate-500 text-sm font-medium mt-1 flex-wrap">
                        <span class="flex items-center gap-1">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            {{ $location }}
                        </span>

                        <span class="flex items-center gap-1">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect width="20" height="16" x="2" y="4" rx="2" />
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                            </svg>
                            {{ $user->email }}
                        </span>

                        <span class="flex items-center gap-1">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"
                                />
                            </svg>
                            {{ $phone }}
                        </span>
                    </div>
                </div>
            </div>

            @if($canContact)
                <form action="{{ route('messages.contact', $user) }}" method="POST" class="pb-2 pt-10">
                    @csrf
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center px-6 py-2.5 rounded-lg bg-primary text-white text-xs font-semibold shadow-lg shadow-primary/20 hover:bg-primary/90 transition-colors"
                    >
                        Contact
                    </button>
                </form>
            @endif
        </div>
    </div>

    {{-- Grid Layout --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-8">

            {{-- About Me --}}
            <section class="bg-white rounded-2xl border border-slate-100 p-8 shadow-sm">
                <h2 class="text-lg font-bold text-slate-900 mb-4">About me</h2>
                <p class="text-sm text-slate-600 leading-relaxed">
                    {{ $profile->about_me
                        ?: "This creator hasn't added an about section yet, but is open to authentic collaborations." }}
                </p>
            </section>

            {{-- Work History --}}
            <section class="bg-white rounded-2xl border border-slate-100 p-8 shadow-sm">
                <h2 class="text-lg font-bold text-slate-900 mb-4">Work history</h2>
                <p class="text-xs text-slate-500 mb-4">Your past experiences</p>

                <div class="flex gap-6 border-b border-slate-100 mb-6">
                    <button
                        class="text-sm font-bold text-slate-900 border-b-2 border-slate-900 pb-2">
                        Completed Jobs (1)
                    </button>
                    <button
                        class="text-sm font-medium text-slate-500 hover:text-primary pb-2 transition-colors">
                        In progress (1)
                    </button>
                </div>

                <div>
                    <h3 class="font-bold text-slate-900 text-base mb-1">
                        Awareness Campaign - Story and Post
                    </h3>
                    <div class="flex items-center gap-4 text-xs text-slate-500 mb-3">
                        <div class="flex text-yellow-400">
                            @for ($i = 0; $i < 5; $i++)
                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87
                                           1.18 6.88L12 17.77l-6.18 3.25L7 14.14
                                           2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            @endfor
                        </div>
                        <span class="font-bold text-slate-900">5.0</span>
                        <span>Dec 20, 2024 - Dec 25, 2024</span>
                    </div>
                    <p class="text-sm text-slate-600 mb-4 leading-relaxed">
                        {{ $profile->previous_collaborations
                            ?: "This creator is ready to build their first collaborations on Influentia." }}
                    </p>
                    <div class="w-full border-t border-slate-100">
                        <div
                            class="flex justify-between py-3 text-xs font-medium text-slate-500 border-b border-slate-100">
                            <span>Content Type</span>
                            <span>Content Price</span>
                        </div>
                        <div
                            class="flex justify-between py-3 text-sm text-slate-900 border-b border-slate-100">
                            <span>Post</span>
                            <span class="font-bold">
                                {{ $profile->pricing_post ? '$' . $profile->pricing_post : 'On request' }}
                            </span>
                        </div>
                        <div class="flex justify-between py-3 text-sm text-slate-900">
                            <span>Story</span>
                            <span class="font-bold">
                                {{ $profile->pricing_story ? '$' . $profile->pricing_story : 'On request' }}
                            </span>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Projects --}}
            <section class="bg-white rounded-2xl border border-slate-100 p-8 shadow-sm">
                <h2 class="text-lg font-bold text-slate-900 mb-4">Projects</h2>
                <p class="text-xs text-slate-500 mb-6">Share your projects</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div
                        class="border border-slate-100 rounded-xl p-3 flex gap-3 hover:shadow-md transition-shadow cursor-pointer">
                      <div class="w-24 h-20 bg-slate-100 rounded-lg shrink-0 overflow-hidden">
                          <img src="{{ $cover ?? $avatarFallback }}"
                               class="w-full h-full object-cover">
                        </div>
                        <div class="overflow-hidden flex flex-col justify-center">
                            <h4 class="font-bold text-slate-900 text-sm truncate">
                                Featured Campaign
                            </h4>
                            <p class="text-[10px] text-slate-500 line-clamp-2 mt-1">
                                {{ $profile->about_me
                                    ? \Illuminate\Support\Str::limit($profile->about_me, 80)
                                    : 'Creator working with brands on authentic, story-driven content.' }}
                            </p>
                            <p class="text-[10px] text-slate-400 mt-1">
                                {{ now()->format('M d, Y') }}
                            </p>
                        </div>
                    </div>

                    <div
                        class="border border-slate-100 rounded-xl p-3 flex gap-3 hover:shadow-md transition-shadow cursor-pointer">
                      <div class="w-24 h-20 bg-slate-100 rounded-lg shrink-0 overflow-hidden">
                          <img src="{{ $avatar ?? $avatarFallback }}"
                               class="w-full h-full object-cover">
                        </div>
                        <div class="overflow-hidden flex flex-col justify-center">
                            <h4 class="font-bold text-slate-900 text-sm truncate">
                                Creator Highlight
                            </h4>
                            <p class="text-[10px] text-slate-500 line-clamp-2 mt-1">
                                Showcasing lifestyle, behind the scenes and day-to-day content.
                            </p>
                            <p class="text-[10px] text-slate-400 mt-1">
                                {{ now()->subDays(10)->format('M d, Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Collaboration Preferences --}}
            <section class="bg-white rounded-2xl border border-slate-100 p-8 shadow-sm">
                <h2 class="text-lg font-bold text-slate-900 mb-4">Collaboration Preferences</h2>
                <p class="text-xs text-slate-500 mb-6">
                    Let brands know what you're looking for
                </p>

                {{-- Collab types --}}
                <div class="mb-6">
                    <p class="text-xs font-bold text-slate-700 mb-3">
                        Preferred Collaboration Types
                    </p>
                    <div class="flex flex-wrap gap-2">
                        @forelse ($collabTypes as $type)
                            <span class="px-3 py-1 bg-slate-100 text-slate-600 text-xs rounded-md font-medium">
                                {{ $type }}
                            </span>
                        @empty
                            <span class="text-xs text-slate-400">Not specified yet.</span>
                        @endforelse
                    </div>
                </div>

                {{-- Pricing --}}
                <div class="mb-6">
                    <p class="text-xs font-bold text-slate-700 mb-3">Pricing</p>
                    <div class="w-full border-t border-slate-100">
                        <div
                            class="flex justify-between py-3 text-xs font-medium text-slate-500 border-b border-slate-100">
                            <span>Content Type</span>
                            <span>Content Price</span>
                        </div>
                        <div
                            class="flex justify-between py-3 text-sm text-slate-900 border-b border-slate-100">
                            <span>Reel</span>
                            <span class="font-bold">
                                {{ $profile->pricing_reel ? '$' . $profile->pricing_reel : 'On request' }}
                            </span>
                        </div>
                        <div
                            class="flex justify-between py-3 text-sm text-slate-900 border-b border-slate-100">
                            <span>Story</span>
                            <span class="font-bold">
                                {{ $profile->pricing_story ? '$' . $profile->pricing_story : 'On request' }}
                            </span>
                        </div>
                        <div
                            class="flex justify-between py-3 text-sm text-slate-900 border-b border-slate-100">
                            <span>Post</span>
                            <span class="font-bold">
                                {{ $profile->pricing_post ? '$' . $profile->pricing_post : 'On request' }}
                            </span>
                        </div>
                        <div class="flex justify-between py-3 text-sm text-slate-900">
                            <span>Highlight</span>
                            <span class="font-bold">
                                {{ $profile->pricing_highlight ? '$' . $profile->pricing_highlight : 'On request' }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Availability --}}
                <div>
                    <p class="text-xs font-bold text-slate-700 mb-1">Availability</p>
                    <p class="text-sm text-slate-600">
                        {{ $profile->availability ?? 'Availability not specified.' }}
                    </p>
                </div>
            </section>

            {{-- Content Information --}}
            <section class="bg-white rounded-2xl border border-slate-100 p-8 shadow-sm">
                <h2 class="text-lg font-bold text-slate-900 mb-4">Content information</h2>
                <p class="text-xs text-slate-500 mb-6">
                    Tell us about your content style and experience
                </p>

                {{-- Niches --}}
                <div class="mb-6">
                    <p class="text-xs font-bold text-slate-700 mb-3">Niches Categories</p>
                    <div class="flex flex-wrap gap-2">
                        @forelse ($niches as $niche)
                            <span class="px-3 py-1 bg-slate-100 text-slate-600 text-xs rounded-md font-medium">
                                {{ $niche }}
                            </span>
                        @empty
                            <span class="text-xs text-slate-400">No niches added yet.</span>
                        @endforelse
                    </div>
                </div>

                {{-- Content Types --}}
                <div class="mb-6">
                    <p class="text-xs font-bold text-slate-700 mb-3">Content Types</p>
                    <div class="flex flex-wrap gap-2">
                        @forelse ($contentTypes as $type)
                            <span class="px-3 py-1 bg-slate-100 text-slate-600 text-xs rounded-md font-medium">
                                {{ $type }}
                            </span>
                        @empty
                            <span class="text-xs text-slate-400">No content types added yet.</span>
                        @endforelse
                    </div>
                </div>

                {{-- Previous collaborations --}}
                <div class="mb-6">
                    <p class="text-xs font-bold text-slate-700 mb-3">Previous Collaborations</p>
                    <div class="space-y-2">
                        @forelse ($previousCollabs as $collab)
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-slate-200 overflow-hidden">
                                    <img src="{{ $avatar }}" class="w-full h-full object-cover">
                                </div>
                                <span class="text-sm text-slate-700">{{ $collab }}</span>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400">
                                No collaborations listed yet.
                            </p>
                        @endforelse
                    </div>
                </div>

                {{-- Portfolio link --}}
                <div>
                    <p class="text-xs font-bold text-slate-700 mb-1">
                        Portfolio / Media Kit Link
                    </p>
                    @if ($profile->portfolio_link)
                        <a href="{{ $profile->portfolio_link }}" target="_blank"
                           class="text-sm text-slate-600 underline break-all">
                            {{ $profile->portfolio_link }}
                        </a>
                    @else
                        <p class="text-sm text-slate-400">No portfolio link added.</p>
                    @endif
                </div>
            </section>
        </div>

{{-- Sidebar --}}
        <div class="space-y-6">
    {{-- DNA Card --}}
             <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm">
                <h3 class="font-bold text-slate-900 mb-4">
            Influencer DNA with your business
             </h3>

        @php
            $rawScore    = $matchBreakdown['total']  ?? ($matchScore ?? null);
            $score       = !is_null($rawScore) ? max(0, min(100, (int) $rawScore)) : null;
            $angle       = !is_null($score) ? $score * 3.6 : 0;

            $nicheScore  = $matchBreakdown['niches'] ?? null;
            $ageScore    = $matchBreakdown['age']    ?? null;
            $genderScore = $matchBreakdown['gender'] ?? null;
        @endphp

        <div class="flex justify-center mb-6">
            <div class="relative w-24 h-24">
                @if(!is_null($score))
                    <div
                        class="w-full h-full rounded-full flex items-center justify-center"
                        style="background: conic-gradient(hsl(262 83% 58%) {{ $angle }}deg, #e2e8f0 0deg);">
                        <div
                            class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-inner">
                            <span class="text-2xl font-extrabold text-slate-900">
                                {{ $score }}%
                            </span>
                        </div>
                    </div>
                @else
                    <div
                        class="w-full h-full rounded-full flex items-center justify-center bg-slate-100">
                        <div
                            class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-inner">
                            <span class="text-2xl font-extrabold text-slate-400">—</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        @if(!is_null($score))
            <div class="space-y-3 mb-6">
                {{-- Niche Match --}}
                <div>
                    <div class="flex justify-between text-xs font-medium mb-1">
                        <span class="text-slate-600">Niche Match</span>
                        <span class="text-slate-900 font-bold">
                            {{ !is_null($nicheScore) ? $nicheScore . '%' : '—' }}
                        </span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-1.5">
                        <div class="bg-primary h-1.5 rounded-full"
                             style="width: {{ $nicheScore ?? 0 }}%"></div>
                    </div>
                </div>

                {{-- Age Match --}}
                <div>
                    <div class="flex justify-between text-xs font-medium mb-1">
                        <span class="text-slate-600">Age Match</span>
                        <span class="text-slate-900 font-bold">
                            {{ !is_null($ageScore) ? $ageScore . '%' : '—' }}
                        </span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-1.5">
                        <div class="bg-primary h-1.5 rounded-full"
                             style="width: {{ $ageScore ?? 0 }}%"></div>
                    </div>
                </div>

                {{-- Gender Match --}}
                <div>
                    <div class="flex justify-between text-xs font-medium mb-1">
                        <span class="text-slate-600">Gender Match</span>
                        <span class="text-slate-900 font-bold">
                            {{ !is_null($genderScore) ? $genderScore . '%' : '—' }}
                        </span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-1.5">
                        <div class="bg-primary h-1.5 rounded-full"
                             style="width: {{ $genderScore ?? 0 }}%"></div>
                    </div>
                </div>
            </div>
        @else
            <p class="text-xs text-slate-500 mb-6">
                DNA Match will appear when a brand with active campaigns views this creator.
            </p>
        @endif

        <form method="POST" action="{{ route('messages.contact', $user) }}">
            @csrf
            <button
                type="submit"
                class="w-full bg-[#6d28d9] hover:bg-[#5b21b6] text-white font-bold py-3 rounded-lg transition-all shadow-md shadow-primary/20">
                Contact Influencer
            </button>
        </form>
    </div>

    @php
    $profileUser = $authUser ?? $user ?? null;
@endphp

    {{-- Portfolio --}}
<section class="mt-10">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-bold text-slate-900">Portfolio</h2>
        <span class="text-[11px] text-slate-400">
    Selected work from {{ $profileUser?->name }}
</span>

    </div>

    @if($portfolioItems->isEmpty())
        <p class="text-sm text-slate-500">
            This creator hasn’t added any portfolio items yet.
        </p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($portfolioItems as $item)
                @php $stats = $item->stats ?? []; @endphp

                <article class="p-4 bg-white border border-slate-100 rounded-2xl shadow-sm text-xs">
                    <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide">
                        {{ $stats['brand'] ?? 'Client' }}
                    </p>
                    <h3 class="mt-1 text-sm font-bold text-slate-900">
                        {{ $item->title }}
                    </h3>

                    @if($item->campaign_name)
                        <p class="mt-1 text-slate-600">
                            Campaign: {{ $item->campaign_name }}
                        </p>
                    @endif

                    @if($item->platform)
                        <p class="mt-0.5 text-[11px] text-slate-500">
                            Platform: {{ $item->platform }}
                        </p>
                    @endif

                    @if($item->media_url)
                        <a href="{{ $item->media_url }}" target="_blank"
                           class="mt-2 inline-block text-[11px] text-primary underline break-all">
                            View content
                        </a>
                    @endif

                    @if($item->description)
                        <p class="mt-2 text-[11px] text-slate-600">
                            {{ Str::limit($item->description, 140) }}
                        </p>
                    @endif

                    <div class="mt-3 flex flex-wrap gap-3 text-[11px] text-slate-500">
                        @if(!empty($stats['views']))
                            <span>Views: {{ $stats['views'] }}</span>
                        @endif
                        @if(!empty($stats['likes']))
                            <span>Likes: {{ $stats['likes'] }}</span>
                        @endif
                        @if(!empty($stats['comments']))
                            <span>Comments: {{ $stats['comments'] }}</span>
                        @endif
                    </div>

                    @if(!empty($stats['testimonial_name']) || !empty($stats['testimonial_quote']))
                        <div class="mt-3 pt-3 border-t border-slate-100">
                            @if(!empty($stats['testimonial_name']))
                                <p class="text-[11px] font-semibold text-slate-900">
                                    {{ $stats['testimonial_name'] }}
                                </p>
                            @endif
                            @if(!empty($stats['testimonial_quote']))
                                <p class="mt-0.5 text-[11px] text-slate-500 italic">
                                    “{{ $stats['testimonial_quote'] }}”
                                </p>
                            @endif
                        </div>
                    @endif
                </article>
            @endforeach
        </div>
    @endif
</section>


    {{-- Ratings Card --}}
    <div class="mt-2">
        <x-public-rating :user="$user" />
    </div>
    
</div>

    </div>
@endsection

