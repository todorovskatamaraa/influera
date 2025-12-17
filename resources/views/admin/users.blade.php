@extends('layouts.admin-layout')

@section('title', 'Influentia - Admin Users')

@section('content')
  <main class="container mx-auto px-6 py-8 md:px-12 lg:px-24">
    <div class="mb-8 flex items-center justify-between gap-4">
      <div>
        <h1 class="mb-2 text-3xl font-extrabold text-slate-900 tracking-tight md:text-4xl">
          Users
        </h1>
        <p class="text-slate-500 text-lg">
          Approve or reject brand and influencer accounts.
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

    <div class="overflow-x-auto bg-white border border-slate-200 rounded-2xl shadow-sm">
      <table class="min-w-full text-left text-sm">
        <thead class="bg-slate-50 text-xs font-semibold uppercase text-slate-500">
          <tr>
            <th class="px-6 py-3">Name</th>
            <th class="px-6 py-3">Email</th>
            <th class="px-6 py-3">Role</th>
            <th class="px-6 py-3">Status</th>
            <th class="px-6 py-3">Registered</th>
            <th class="px-6 py-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          @forelse($users as $user)
            <tr class="hover:bg-slate-50/60">
              <td class="px-6 py-3">
                <div class="font-medium text-slate-900">{{ $user->name }}</div>
              </td>
              <td class="px-6 py-3 text-slate-600">
                {{ $user->email }}
              </td>
              <td class="px-6 py-3">
                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                  @if($user->role === 'brand') bg-indigo-50 text-indigo-700
                  @elseif($user->role === 'influencer') bg-emerald-50 text-emerald-700
                  @else bg-slate-100 text-slate-700 @endif">
                  {{ ucfirst($user->role) }}
                </span>
              </td>
              <td class="px-6 py-3">
                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                  @if($user->status === 'pending') bg-amber-50 text-amber-700
                  @elseif($user->status === 'approved') bg-emerald-50 text-emerald-700
                  @else bg-rose-50 text-rose-700 @endif">
                  {{ ucfirst($user->status) }}
                </span>
              </td>
              <td class="px-6 py-3 text-slate-500">
                {{ $user->created_at?->format('d M Y') }}
              </td>
              <td class="px-6 py-3 text-right">
                <div class="inline-flex items-center gap-2">
                  <form method="POST" action="{{ route('admin.users.approve', $user) }}">
                    @csrf
                    <button
                      type="submit"
                      class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-xs font-medium text-emerald-700 hover:bg-emerald-100 disabled:opacity-50"
                      @if($user->status === 'approved') disabled @endif
                    >
                      Approve
                    </button>
                  </form>

                  <form method="POST" action="{{ route('admin.users.reject', $user) }}">
                    @csrf
                    <button
                      type="submit"
                      class="inline-flex items-center rounded-full border border-rose-200 bg-rose-50 px-3 py-1.5 text-xs font-medium text-rose-700 hover:bg-rose-100 disabled:opacity-50"
                      @if($user->status === 'rejected') disabled @endif
                    >
                      Reject
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="px-6 py-6 text-center text-slate-500">
                No users found.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </main>
@endsection
