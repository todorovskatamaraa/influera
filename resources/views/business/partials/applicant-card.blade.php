<div
  class="flex flex-col pb-8 border-b border-slate-50 last:border-0 gap-6 md:flex-row"
>
  <!-- Left: Influencer Info -->
  <div class="flex-1">
    <div class="flex mb-4 items-center gap-3">
      <div class="overflow-hidden w-12 h-12 bg-slate-200 rounded-full shrink-0">
        <img src="{{ asset($image) }}" class="object-cover w-full h-full" />
      </div>

      <div>
        <h3 class="font-bold text-slate-900 text-sm">{{ $name }}</h3>

        <div class="flex mt-0.5 text-[10px] text-slate-500 items-center gap-3">
          <span class="flex items-center gap-1">
            <svg
              width="10"
              height="10"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
              <circle cx="9" cy="7" r="4" />
              <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
              <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
            {{ $followers }} followers
          </span>

          <span class="flex items-center gap-1">
            <svg
              width="10"
              height="10"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <polygon
                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
              />
            </svg>
            {{ $match }} Match
          </span>
        </div>
      </div>
    </div>

    <div class="flex gap-2">
      <button
        class="py-1.5 px-4 text-green-800 text-[10px] font-bold bg-[#bbf7d0] transition-colors hover:bg-green-300 rounded"
      >
        Accept
      </button>

      <button
        class="py-1.5 px-4 text-red-800 text-[10px] font-bold bg-[#fecaca] transition-colors hover:bg-red-300 rounded"
      >
        Decline
      </button>

      <button
        class="flex ml-2 text-[10px] font-medium text-slate-500 transition-colors hover:text-primary items-center gap-1"
      >
        View profile
        <svg
          width="10"
          height="10"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
        >
          <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
          <circle cx="12" cy="12" r="3" />
        </svg>
      </button>
    </div>
  </div>

  <!-- Right: Campaign Info -->
  <div
    class="flex p-2 bg-slate-50/50 rounded-lg border border-slate-50 gap-3 shrink-0 md:w-64"
  >
    <div class="overflow-hidden w-16 h-16 bg-slate-200 rounded-lg shrink-0">
      <img
        src="{{ asset($campaignImage) }}"
        class="object-cover w-full h-full"
        alt="{{ $campaign }}"
      />
    </div>

    <div>
      <h4 class="mb-1 font-bold text-slate-900 text-xs">{{ $campaign }}</h4>

      <div class="space-y-1">
        <p class="flex text-[10px] text-slate-500 items-center gap-1">
          <svg
            width="10"
            height="10"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
          >
            <rect width="20" height="14" x="2" y="5" rx="2" />
            <line x1="2" x2="22" y1="10" y2="10" />
          </svg>
          Budget: {{ $budget }}
        </p>

        <p class="flex text-[10px] text-slate-400 items-center gap-1">
          <svg
            width="10"
            height="10"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
          >
            <circle cx="12" cy="12" r="10" />
            <polyline points="12 6 12 12 16 14" />
          </svg>
          Applied: {{ $applied }}
        </p>
      </div>
    </div>
  </div>
</div>
