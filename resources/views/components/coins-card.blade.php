<div
  class="flex flex-col p-6 text-center bg-white rounded-2xl border border-slate-100 shadow-sm items-center"
>
  <div
    class="flex w-12 h-12 mb-3 text-white bg-primary rounded-lg items-center justify-center"
  >
    <svg
      width="24"
      height="24"
      viewBox="0 0 24 24"
      fill="none"
      stroke="currentColor"
      stroke-width="2"
    >
      <path d="M12 2v20" />
      <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
    </svg>
  </div>
  <h3 class="mb-1 text-2xl font-bold text-slate-900">25 Coins</h3>

  <button
    class="w-full py-2 mb-3 mt-4 text-slate-900 font-bold text-sm bg-white border border-slate-300 rounded-lg transition-all hover:bg-slate-50"
  >
    Buy more coins
  </button>
  <button
    class="text-xs font-bold text-slate-500 hover:text-primary underline decoration-slate-300 underline-offset-2"
    onclick="window.location.href='{{ route('finances.index') }}'">
    View finances
  </button>
</div>
