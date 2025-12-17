@extends('layouts.loggedin-layout')

@section('title', 'Influentia - Messages')

@section('content')
    @php
        use Illuminate\Support\Facades\Storage;
        use Illuminate\Support\Str;

        /**
         * Helper за avatar URL
         */
        function resolve_avatar_url(?string $path): ?string {
            if (! $path) {
                return null;
            }

            if (Str::startsWith($path, ['http://', 'https://'])) {
                return $path;
            }

            if (Storage::disk('public')->exists($path)) {
                return Storage::url($path);
            }

            return asset($path);
        }
    @endphp

    {{-- ФИКСНА ВИСИНА НА CONTENT --}}
    <div class="flex flex-1 overflow-hidden py-6 gap-6 h-[calc(100vh-140px)]">

        {{-- Sidebar / Conversations --}}
        <div class="w-full md:w-80 flex flex-col bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm shrink-0 h-full">

            {{-- Sidebar Header --}}
            <div class="p-4 border-b border-slate-100">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-slate-900">Messages</h2>
                    <button class="text-slate-400 hover:text-slate-600">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="19" cy="12" r="1"></circle>
                            <circle cx="5"  cy="12" r="1"></circle>
                        </svg>
                    </button>
                </div>

                {{-- SEARCH --}}
                <form method="GET" action="{{ route('messages') }}" class="relative mb-4">
                    <input
                        type="text"
                        name="search"
                        placeholder="Search"
                        value="{{ request('search') }}"
                        class="w-full pl-3 pr-9 py-2 rounded-lg border border-slate-200 text-xs
                               focus:outline-none focus:border-primary transition-all bg-slate-50"
                    >
                    <svg class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400"
                         width="14" height="14" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.3-4.3"></path>
                    </svg>
                </form>

                <div class="flex items-center justify-between">
                    <button class="flex items-center gap-2 text-slate-600 text-xs font-medium hover:text-primary">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="4" x2="20" y1="12" y2="12"/>
                            <line x1="4" x2="20" y1="6"  y2="6"/>
                            <line x1="4" x2="20" y1="18" y2="18"/>
                        </svg>
                        Filter by:
                    </button>
                    <button class="flex items-center gap-1 text-slate-600 text-xs font-medium hover:text-primary">
                        All
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Conversation List --}}
            <div id="chat-messages" class="flex-1 overflow-y-auto p-2 space-y-1">
                @forelse ($conversations as $conversation)
                    @php
                        $isActive    = optional($activeConversation)->id === $conversation->id;
                        $lastMessage = $conversation->lastMessage;
                        $partner     = $conversation->partner ?? null;
                        $name        = $partner->name ?? 'Conversation';
                        $date        = $lastMessage?->created_at?->timezone(config('app.timezone'))?->format('d/m/Y');
                        $preview     = $lastMessage?->body ? Str::limit($lastMessage->body, 40) : 'No messages yet';

                        $avatarPath = $partner
                            ? (
                                data_get($partner, 'influencerProfile.avatar_path')
                                ?? data_get($partner, 'influencerProfile.profile_photo_path')
                                ?? data_get($partner, 'brandProfile.company_logo_path')
                            )
                            : null;

                        $avatar = resolve_avatar_url($avatarPath);

                        $parts     = explode(' ', $name);
                        $initials  = collect($parts)->map(fn($p) => mb_substr($p,0,1))->join('');
                    @endphp

                    <a href="{{ route('messages', $conversation) }}"
                       class="flex gap-3 p-3 rounded-xl cursor-pointer border border-transparent transition-all
                              {{ $isActive ? 'bg-slate-50 hover:bg-slate-50' : 'hover:bg-slate-50 hover:border-slate-200' }}">
                        <div class="relative shrink-0">
                            @if($avatar)
                                <div class="w-10 h-10 rounded-full overflow-hidden border border-slate-200">
                                    <img src="{{ $avatar }}" class="w-full h-full object-cover" alt="Avatar">
                                </div>
                            @else
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-600 to-indigo-700
                                            flex items-center justify-center text-white text-xs font-bold
                                            shadow-md shadow-purple-200">
                                    {{ $initials }}
                                </div>
                            @endif
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start mb-1">
                                <h3 class="font-bold text-slate-900 text-sm truncate">{{ $name }}</h3>
                                @if($date)
                                    <span class="text-[10px] text-slate-400 whitespace-nowrap">{{ $date }}</span>
                                @endif
                            </div>
                            <p class="text-[11px] text-slate-400 truncate">
                                {{ $preview }}
                            </p>
                        </div>
                    </a>
                @empty
                    <p class="text-xs text-slate-400 px-3 py-4">No conversations yet.</p>
                @endforelse
            </div>
        </div>

        {{-- MAIN AREA (Chat + Right panel) --}}
        <div class="flex-1 h-full">
            @if($activeConversation)
                @php
                    $partner        = $activeConversation->partner ?? null;
                    $name           = $partner?->name ?? 'Conversation';
                    $chatAvatarPath = $partner
                        ? (
                            data_get($partner, 'influencerProfile.avatar_path')
                            ?? data_get($partner, 'influencerProfile.profile_photo_path')
                            ?? data_get($partner, 'brandProfile.company_logo_path')
                        )
                        : null;

                    $chatAvatar = resolve_avatar_url($chatAvatarPath);

                    $location = data_get($partner, 'influencerProfile.country')
                        ?? data_get($partner, 'brandProfile.country')
                        ?? 'Location not specified';
                @endphp

                <div class="flex h-full gap-6">
                    {{-- CHAT COLUMN --}}
                    <div class="flex flex-col flex-1 bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">

                        {{-- Chat Header --}}
                        <div class="p-6 border-b border-slate-100 flex justify-between items-start">
                            <div class="flex items-center gap-3">
                                @if($chatAvatar)
                                    <div class="w-9 h-9 rounded-full overflow-hidden border border-slate-200">
                                        <img src="{{ $chatAvatar }}" class="w-full h-full object-cover" alt="Avatar">
                                    </div>
                                @else
                                    @php
                                        $partsName    = explode(' ', $name);
                                        $initialsName = collect($partsName)->map(fn($p) => mb_substr($p,0,1))->join('');
                                    @endphp
                                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-purple-600 to-indigo-700
                                                flex items-center justify-center text-white text-xs font-bold shadow-md shadow-purple-200">
                                        {{ $initialsName }}
                                    </div>
                                @endif
                                <div>
                                    <h2 class="text-xl font-bold text-slate-900">
                                        {{ $name }}
                                    </h2>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <button class="text-slate-400 hover:text-primary transition-colors">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="23 7 16 12 23 17 23 7"/>
                                        <rect x="1" y="5" width="15" height="14" rx="2" ry="2"/>
                                    </svg>
                                </button>
                                <button class="text-slate-400 hover:text-primary transition-colors">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                        <line x1="16" y1="2" x2="16" y2="6"/>
                                        <line x1="8"  y1="2" x2="8"  y2="6"/>
                                        <line x1="3"  y1="10" x2="21" y2="10"/>
                                    </svg>
                                </button>
                                <button
                                    id="conversation-panel-toggle"
                                    type="button"
                                    class="text-slate-400 hover:text-primary transition-colors"
                                >
                                    <svg id="conversation-panel-arrow"
                                         width="20" height="20" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                         class="transition-transform duration-200">
                                        <polyline points="15 18 9 12 15 6"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Chat Messages --}}
                        @php
                            $currentUser = auth()->user();
                        @endphp

                        <div class="flex-1 overflow-y-auto p-6 space-y-6">
                            @forelse($messages as $message)
                                @php
                                    $author   = $message->user;
                                    $mName    = $author->name ?? 'User';
                                    $time     = $message->created_at?->timezone(config('app.timezone'))?->format('H:i');

                                    $currentUser = auth()->user();
                                    $isMe = $currentUser && $author && $author->id === $currentUser->id;

                                    $rawAvatarPath = $author
                                        ? (
                                            data_get($author, 'influencerProfile.avatar_path') ??
                                            data_get($author, 'influencerProfile.profile_photo_path') ??
                                            data_get($author, 'brandProfile.company_logo_path')
                                        )
                                        : null;

                                    $mAvatar = null;
                                    if ($isMe && $currentUser?->profile_photo_url) {
                                        $mAvatar = $currentUser->profile_photo_url;
                                    } elseif ($rawAvatarPath) {
                                        $mAvatar = resolve_avatar_url($rawAvatarPath);
                                    }

                                    $parts    = explode(' ', $mName);
                                    $initials = collect($parts)->map(fn($p) => mb_substr($p,0,1))->join('');
                                @endphp

                                <div class="flex gap-4">
                                    @if($mAvatar)
                                        <div class="w-10 h-10 rounded-full overflow-hidden border border-slate-200">
                                            <img src="{{ $mAvatar }}" class="w-full h-full object-cover" alt="Avatar">
                                        </div>
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-600 to-indigo-700
                                                    flex items-center justify-center text-white text-xs font-bold shadow-md">
                                            {{ $initials }}
                                        </div>
                                    @endif

                                    <div class="flex-1">
                                        <div class="flex items-baseline gap-2 mb-1">
                                            <span class="font-bold text-slate-900 text-sm">{{ $mName }}</span>
                                            @if($time)
                                                <span class="text-xs text-slate-400">{{ $time }}</span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-slate-600 leading-relaxed">
                                            {{ $message->body }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-xs text-slate-400">No messages yet in this conversation.</p>
                            @endforelse
                                <div id="chat-bottom"></div>

                        </div>

                        {{-- Chat Input --}}
                        <div class="p-6 pt-2">
                            <div class="border border-slate-200 rounded-2xl p-4 shadow-sm bg-white relative
                                        focus-within:border-primary transition-colors">
                                <form id="message-form" action="{{ route('messages.send', $activeConversation) }}" method="POST" class="space-y-0">
                                    @csrf

                                    <textarea
                                        id="message-input"
                                        name="body"
                                        class="w-full resize-none text-sm text-slate-900 placeholder-slate-400
                                               focus:outline-none h-20"
                                        placeholder="Send a message..."
                                    >{{ old('body') }}</textarea>

                                    @error('body')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror

                                    <div class="flex justify-between items-center mt-2 border-t border-slate-100 pt-3">
                                        <div class="flex gap-4 text-slate-400">
                                            <button type="button" class="hover:text-slate-600 font-bold text-xs">H1</button>
                                            <button type="button" class="hover:text-slate-600">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/>
                                                </svg>
                                            </button>
                                            <button type="button" class="hover:text-slate-600">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10"/>
                                                    <path d="M8 14s1.5 2 4 2 4-2 4-2"/>
                                                    <line x1="9" y1="9" x2="9.01" y2="9"/>
                                                    <line x1="15" y1="9" x2="15.01" y2="9"/>
                                                </svg>
                                            </button>
                                        </div>

                                        <button type="submit"
                                                class="flex items-center gap-2 text-xs font-medium text-slate-500
                                                       hover:text-primary transition-colors">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M22 2 11 13"></path>
                                                <path d="M22 2 15 22 11 13 2 9l20-7z"></path>
                                            </svg>
                                            Send
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT INFO PANEL --}}
                    <div id="conversation-side-panel"
                         style="display:none"
                         class="flex w-80 flex-col bg-white rounded-2xl border border-slate-200 shadow-sm p-6 transition-all duration-300">

                        {{-- Top: avatar + name --}}
                        <div class="flex flex-col items-center text-center">
                            @if($chatAvatar)
                                <div class="w-16 h-16 rounded-full overflow-hidden border border-slate-200 mb-3">
                                    <img src="{{ $chatAvatar }}" class="w-full h-full object-cover" alt="Avatar">
                                </div>
                            @else
                                @php
                                    $partsSide    = explode(' ', $name);
                                    $initialsSide = collect($partsSide)->map(fn($p) => mb_substr($p,0,1))->join('');
                                @endphp
                                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-purple-600 to-indigo-700
                                            flex items-center justify-center text-white text-sm font-bold shadow-md mb-3">
                                    {{ $initialsSide }}
                                </div>
                            @endif

                            <h3 class="text-sm font-semibold text-slate-900">{{ $name }}</h3>
                            <p class="text-[11px] text-slate-400 mt-1">{{ $location }}</p>

                            <a href="#"
                               class="mt-4 inline-flex items-center justify-center px-4 py-1.5 text-xs font-medium
                                      text-primary bg-primary/5 rounded-full hover:bg-primary/10 transition-colors">
                                View proposal
                            </a>
                        </div>

                        {{-- Accordions --}}
                        <div class="mt-6 space-y-2 text-sm">
                            <details class="group border border-slate-100 rounded-xl px-4 py-3">
                                <summary class="flex items-center justify-between cursor-pointer list-none">
                                    <span class="text-xs font-medium text-slate-700 flex items-center gap-2">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <path d="m21 21-4.3-4.3"></path>
                                        </svg>
                                        Search Messages
                                    </span>
                                    <span class="text-slate-400 group-open:rotate-180 transition-transform">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m6 9 6 6 6-6"/>
                                        </svg>
                                    </span>
                                </summary>
                                <div class="mt-3 text-xs text-slate-500">
                                    <input type="text"
                                           placeholder="Search in this chat"
                                           class="w-full px-3 py-1.5 rounded-lg border border-slate-200 text-xs
                                                  focus:outline-none focus:border-primary">
                                </div>
                            </details>

                            <details class="group border border-slate-100 rounded-xl px-4 py-3">
                                <summary class="flex items-center justify-between cursor-pointer list-none">
                                    <span class="text-xs font-medium text-slate-700 flex items-center gap-2">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="7" r="4"/>
                                            <path d="M5.5 21a6.5 6.5 0 0 1 13 0"/>
                                        </svg>
                                        Client Profile
                                    </span>
                                    <span class="text-slate-400 group-open:rotate-180 transition-transform">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m6 9 6 6 6-6"/>
                                        </svg>
                                    </span>
                                </summary>
                                <div class="mt-3 text-xs text-slate-500 space-y-1">
                                    <p>Basic info about the brand / influencer can go here.</p>
                                </div>
                            </details>

                            <details class="group border border-slate-100 rounded-xl px-4 py-3">
                                <summary class="flex items-center justify-between cursor-pointer list-none">
                                    <span class="text-xs font-medium text-slate-700 flex items-center gap-2">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M17 21v-8"></path>
                                            <path d="M7 21v-4"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        People
                                    </span>
                                    <span class="text-slate-400 group-open:rotate-180 transition-transform">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m6 9 6 6 6-6"/>
                                        </svg>
                                    </span>
                                </summary>
                                <div class="mt-3 text-xs text-slate-500">
                                    <p>List of participants / teammates later.</p>
                                </div>
                            </details>

                            <details class="group border border-slate-100 rounded-xl px-4 py-3">
                                <summary class="flex items-center justify-between cursor-pointer list-none">
                                    <span class="text-xs font-medium text-slate-700 flex items-center gap-2">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="4" width="8" height="16" rx="1"/>
                                            <rect x="13" y="4" width="8" height="10" rx="1"/>
                                        </svg>
                                        Files and links
                                    </span>
                                    <span class="text-slate-400 group-open:rotate-180 transition-transform">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m6 9 6 6 6-6"/>
                                        </svg>
                                    </span>
                                </summary>
                                <div class="mt-3 text-xs text-slate-500">
                                    <p>Show attachments from this conversation.</p>
                                </div>
                            </details>

                            <details class="group border border-slate-100 rounded-xl px-4 py-3">
                                <summary class="flex items-center justify-between cursor-pointer list-none">
                                    <span class="text-xs font-medium text-slate-700 flex items-center gap-2">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                            <path d="M4 4.5A2.5 2.5 0 0 0 6.5 7H20"></path>
                                            <path d="M4 12h16"></path>
                                        </svg>
                                        Personal notepad
                                    </span>
                                    <span class="text-slate-400 group-open:rotate-180 transition-transform">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m6 9 6 6 6-6"/>
                                        </svg>
                                    </span>
                                </summary>
                                <div class="mt-3 text-xs text-slate-500">
                                    <textarea
                                        class="w-full h-24 border border-slate-200 rounded-lg px-3 py-2 text-xs
                                               focus:outline-none focus:border-primary resize-none"
                                        placeholder="Write private notes about this client..."></textarea>
                                </div>
                            </details>
                        </div>
                    </div>
                </div>
            @else
                <div class="flex h-full items-center justify-center text-sm text-slate-400 bg-white rounded-2xl border border-slate-200 shadow-sm">
                    Select a conversation from the left.
                </div>
            @endif
        </div>
    </div>

    {{-- INLINE SCRIPT ЗА TOGGLE НА ДЕСНИОТ ПАНЕЛ --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('conversation-panel-toggle');
        const arrow     = document.getElementById('conversation-panel-arrow');
        const panel     = document.getElementById('conversation-side-panel');

        if (!toggleBtn || !panel) return;

        let isOpen = false;

        arrow.classList.add('rotate-180');

        toggleBtn.addEventListener('click', function () {
            isOpen = !isOpen;

            if (isOpen) {
                panel.style.display = 'flex';
                arrow.classList.remove('rotate-180');
            } else {
                panel.style.display = 'none';
                arrow.classList.add('rotate-180');
            }
        });
    });
    
document.addEventListener('DOMContentLoaded', function () {
    // ===== AUTO SCROLL TO BOTTOM =====
    const bottomEl = document.getElementById('chat-bottom');
    if (bottomEl) {
        setTimeout(() => {
            bottomEl.scrollIntoView({
                behavior: 'auto',
                block: 'end'
            });
        }, 50);
    }

    // ===== PANEL TOGGLE =====
    const toggleBtn = document.getElementById('conversation-panel-toggle');
    const arrow     = document.getElementById('conversation-panel-arrow');
    const panel     = document.getElementById('conversation-side-panel');

    if (toggleBtn && panel && arrow) {
        let isOpen = false;
        arrow.classList.add('rotate-180');

        toggleBtn.addEventListener('click', function () {
            isOpen = !isOpen;

            if (isOpen) {
                panel.style.display = 'flex';
                arrow.classList.remove('rotate-180');
            } else {
                panel.style.display = 'none';
                arrow.classList.add('rotate-180');
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {

    const textarea = document.getElementById('message-input');
    const form = document.getElementById('message-form');

    if (textarea && form) {

        textarea.addEventListener('keydown', function (e) {

            if (e.key === 'Enter' && e.shiftKey) {
                return;
            }

            if (e.key === 'Enter') {
                e.preventDefault();
                form.submit();
            }
        });
    }
});

</script>


@endsection
