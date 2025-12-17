<div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm">
    <h3 class="text-xs font-bold text-slate-900 mb-1">Recommended Influencers</h3>
    <p class="text-[10px] text-slate-500 mb-4">Based on your brand DNA</p>

    <div class="space-y-4">

        @php
            $recommended = [
                ['name' => 'Ana Jankova', 'category' => 'Fitness', 'followers' => '120k', 'match' => '97%', 'image' => null],
                ['name' => 'Mark Tanaka', 'category' => 'Nutrition', 'followers' => '85k', 'match' => '92%', 'image' => null],
                ['name' => 'Lara Chen', 'category' => 'Wellness', 'followers' => '110k', 'match' => '95%', 'image' => null],
                ['name' => 'Omar Ruiz', 'category' => 'Yoga', 'followers' => '75k', 'match' => '90%', 'image' => null],
            ];
        @endphp

        @foreach ($recommended as $item)

            @php
                $parts = explode(' ', $item['name']);
                $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
            @endphp

            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">

                    @if ($item['image'])
                        <div class="w-8 h-8 rounded-full overflow-hidden">
                            <img src="{{ $item['image'] }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center">
                            <span class="text-[10px] font-bold text-primary">
                                {{ $initials }}
                            </span>
                        </div>
                    @endif

                    <div>
                        <p class="text-xs font-bold text-slate-900">{{ $item['name'] }}</p>
                        <p class="text-[10px] text-slate-500">{{ $item['category'] }} - {{ $item['followers'] }}</p>
                    </div>
                </div>

                <span class="text-[10px] font-bold text-slate-400 flex items-center gap-1">
                    <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                    </svg>
                    {{ $item['match'] }}
                </span>
            </div>

        @endforeach
    </div>

    <button class="w-full mt-6 text-xs font-bold text-slate-500 hover:text-primary underline underline-offset-2" onclick="window.location.href='{{ route('discover') }}'">
        Browse more influencers
    </button>
</div>
