@extends('layouts.admin-layout')

@section('title', 'Influentia - Verifications')

@section('content')
  <main class="container mx-auto px-6 py-8 md:px-12 lg:px-24">
    <div class="mb-8 flex items-center justify-between gap-4">
      <div>
        <h1 class="mb-2 text-3xl font-extrabold text-slate-900 tracking-tight md:text-4xl">
          Verification Requests
        </h1>
        <p class="text-slate-500 text-lg">
          Review and approve uploaded verification documents.
        </p>
      </div>

      <a href="{{ route('admin.dashboard') }}"
         class="inline-flex items-center text-sm font-medium text-primary hover:underline">
        ← Back to Dashboard
      </a>
    </div>

    @if(session('success'))
      <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
        {{ session('success') }}
      </div>
    @endif

    <div class="mb-4 flex flex-wrap items-center gap-3 text-sm">
      <span class="text-slate-500">Filter:</span>
      <a href="{{ route('admin.verifications.index') }}"
         class="{{ $status === null ? 'text-primary font-semibold' : 'text-slate-500 hover:text-primary' }}">
        All
      </a>
      <a href="{{ route('admin.verifications.index', ['status' => 'pending']) }}"
         class="{{ $status === 'pending' ? 'text-primary font-semibold' : 'text-slate-500 hover:text-primary' }}">
        Pending
      </a>
      <a href="{{ route('admin.verifications.index', ['status' => 'approved']) }}"
         class="{{ $status === 'approved' ? 'text-primary font-semibold' : 'text-slate-500 hover:text-primary' }}">
        Approved
      </a>
      <a href="{{ route('admin.verifications.index', ['status' => 'rejected']) }}"
         class="{{ $status === 'rejected' ? 'text-primary font-semibold' : 'text-slate-500 hover:text-primary' }}">
        Rejected
      </a>
    </div>

    <div class="overflow-x-auto bg-white border border-slate-200 rounded-2xl shadow-sm">
      <table class="min-w-full text-left text-sm">
        <thead class="bg-slate-50 text-xs font-semibold uppercase text-slate-500">
          <tr>
            <th class="px-6 py-3">User</th>
            <th class="px-6 py-3">Role</th>
            <th class="px-6 py-3">Status</th>
            <th class="px-6 py-3">Document</th>
            <th class="px-6 py-3">Submitted</th>
            <th class="px-6 py-3">Reviewed By</th>
            <th class="px-6 py-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          @forelse($verifications as $verification)
            <tr class="hover:bg-slate-50/60">
              <td class="px-6 py-3">
                <div class="font-medium text-slate-900">
                  {{ $verification->user->name }}
                </div>
                <div class="text-xs text-slate-500">
                  {{ $verification->user->email }}
                </div>
              </td>
              <td class="px-6 py-3">
                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                  @if($verification->user->role === 'brand') bg-indigo-50 text-indigo-700
                  @else bg-emerald-50 text-emerald-700 @endif">
                  {{ ucfirst($verification->user->role) }}
                </span>
              </td>
              <td class="px-6 py-3">
                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                  @if($verification->status === 'pending') bg-amber-50 text-amber-700
                  @elseif($verification->status === 'approved') bg-emerald-50 text-emerald-700
                  @else bg-rose-50 text-rose-700 @endif">
                  {{ ucfirst($verification->status) }}
                </span>
              </td>
              <td class="px-6 py-3">
                <a href="{{ asset('storage/'.$verification->document_path) }}"
                   target="_blank"
                   class="text-primary text-xs font-medium hover:underline">
                  View document
                </a>
              </td>
              <td class="px-6 py-3 text-slate-500 text-xs">
                {{ $verification->created_at->format('d M Y H:i') }}
              </td>
              <td class="px-6 py-3 text-xs text-slate-500">
                @if($verification->reviewer)
                  {{ $verification->reviewer->name }}
                @else
                  —
                @endif
              </td>
              <td class="px-6 py-3 text-right">
                <div class="inline-flex flex-col gap-2 items-end">
                  <div class="inline-flex gap-2">
                    <form method="POST" action="{{ route('admin.verifications.approve', $verification) }}">
                      @csrf
                      <button type="submit"
                        class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-xs font-medium text-emerald-700 hover:bg-emerald-100 disabled:opacity-50"
                        @if($verification->status === 'approved') disabled @endif
                      >
                        Approve
                      </button>
                    </form>

                    <form method="POST" action="{{ route('admin.verifications.reject', $verification) }}">
                      @csrf
                      <input type="hidden" name="notes" value="Rejected by admin.">
                      <button type="submit"
                        class="inline-flex items-center rounded-full border border-rose-200 bg-rose-50 px-3 py-1.5 text-xs font-medium text-rose-700 hover:bg-rose-100 disabled:opacity-50"
                        @if($verification->status === 'rejected') disabled @endif
                      >
                        Reject
                      </button>
                    </form>
                  </div>

                  @if($verification->notes)
                    <p class="text-[11px] text-slate-400 max-w-xs text-right">
                      {{ $verification->notes }}
                    </p>
                  @endif
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="px-6 py-6 text-center text-slate-500">
                No verification requests yet.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-4">
      {{ $verifications->withQueryString()->links() }}
    </div>
  </main>
@endsection
