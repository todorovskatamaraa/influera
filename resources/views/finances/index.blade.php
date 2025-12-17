@extends('layouts.loggedin-layout')

@section('title', 'Influentia - Manage Finances')

@section('content')
  <main class="container mx-auto px-6 py-8 md:px-12 lg:px-24">
    {{-- Header --}}
    <div class="mb-8">
      <h1 class="mb-2 text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">
        Manage Finances
      </h1>
      <p class="text-slate-500 text-lg">
        @if($type === 'brand')
          Overview of escrow payments for your campaigns.
        @else
          Overview of escrow payments for your collaborations.
        @endif
      </p>
    </div>

    {{-- Summary cards --}}
    @php
      $total = $escrows->sum('amount');
      $funded = $escrows->where('status', 'funded')->sum('amount');
      $released = $escrows->where('status', 'released')->sum('amount');
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
      <div class="p-4 bg-white border border-slate-100 rounded-2xl shadow-sm">
        <p class="text-xs font-medium text-slate-500 mb-1">
          Total escrow value
        </p>
        <p class="text-2xl font-bold text-slate-900">
          €{{ number_format($total, 2) }}
        </p>
      </div>
      <div class="p-4 bg-white border border-slate-100 rounded-2xl shadow-sm">
        <p class="text-xs font-medium text-slate-500 mb-1">
          Funded (on hold)
        </p>
        <p class="text-2xl font-bold text-amber-600">
          €{{ number_format($funded, 2) }}
        </p>
      </div>
      <div class="p-4 bg-white border border-slate-100 rounded-2xl shadow-sm">
        <p class="text-xs font-medium text-slate-500 mb-1">
          Released
        </p>
        <p class="text-2xl font-bold text-emerald-600">
          €{{ number_format($released, 2) }}
        </p>
      </div>
    </div>

    {{-- Table --}}
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
      <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
        <h2 class="text-sm font-semibold text-slate-900">
          Escrow payments
        </h2>
        <span class="text-[11px] text-slate-400">
          {{ $escrows->count() }} record(s)
        </span>
      </div>

      @if($escrows->isEmpty())
        <div class="px-6 py-8 text-sm text-slate-500">
          No escrow payments yet.
        </div>
      @else
        <div class="overflow-x-auto">
          <table class="min-w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wide">
              <tr>
                <th class="px-6 py-3 text-left">Campaign</th>
                <th class="px-6 py-3 text-left">
                  @if($type === 'brand') Creator @else Brand @endif
                </th>
                <th class="px-6 py-3 text-left">Amount</th>
                <th class="px-6 py-3 text-left">Status</th>
                <th class="px-6 py-3 text-left">Updated</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              @foreach($escrows as $escrow)
                <tr>
                  <td class="px-6 py-3">
                    <a
                      href="{{ route('jobs.show', $escrow->job) }}"
                      class="font-medium text-slate-900 hover:text-primary"
                    >
                      {{ $escrow->job->campaign_name }}
                    </a>
                  </td>
                  <td class="px-6 py-3 text-slate-700">
                    @if($type === 'brand')
                      {{ $escrow->influencer?->name ?? '—' }}
                    @else
                      {{ $escrow->job->user?->name ?? '—' }}
                    @endif
                  </td>
                  <td class="px-6 py-3">
                    €{{ number_format($escrow->amount, 2) }}
                  </td>
                  <td class="px-6 py-3">
                    @php
                      $badgeClasses = match($escrow->status) {
                        'funded'   => 'bg-amber-50 text-amber-700',
                        'released' => 'bg-emerald-50 text-emerald-700',
                        'cancelled'=> 'bg-rose-50 text-rose-700',
                        default    => 'bg-slate-50 text-slate-600',
                      };
                    @endphp
                    <span class="inline-flex px-2.5 py-1 rounded-full text-[11px] font-semibold {{ $badgeClasses }}">
                      {{ ucfirst($escrow->status) }}
                    </span>
                  </td>
                  <td class="px-6 py-3 text-slate-500">
                    {{ $escrow->updated_at?->format('d M Y, H:i') }}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </main>
@endsection
