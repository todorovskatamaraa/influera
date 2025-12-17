@extends('layouts.admin-layout')

@section('title', 'Influentia - Admin Dashboard')

@section('content')
  <main class="container mx-auto px-6 py-8 md:px-12 lg:px-24">
    <div class="mb-8">
      <h1 class="mb-2 text-3xl font-extrabold text-slate-900 tracking-tight md:text-4xl">
        Admin Dashboard
      </h1>
      <p class="text-slate-500 text-lg">
        Manage users, approvals and platform activity.
      </p>
    </div>

    {{-- USER STATS --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

  <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
    <p class="text-sm text-slate-500 mb-1">Total Users</p>
    <p class="text-3xl font-bold text-slate-900">{{ $totalUsers }}</p>
  </div>

  <div class="bg-white border border-indigo-100 rounded-2xl p-6 shadow-sm">
    <p class="text-sm text-slate-500 mb-1">Pending Approval</p>
    <p class="text-3xl font-bold text-amber-500">{{ $pendingUsers }}</p>
  </div>

  <div class="bg-white border border-emerald-100 rounded-2xl p-6 shadow-sm">
    <p class="text-sm text-slate-500 mb-1">Approved</p>
    <p class="text-3xl font-bold text-emerald-500">{{ $approvedUsers }}</p>
  </div>

  <div class="bg-white border border-rose-100 rounded-2xl p-6 shadow-sm">
    <p class="text-sm text-slate-500 mb-1">Rejected</p>
    <p class="text-3xl font-bold text-rose-500">{{ $rejectedUsers }}</p>
  </div>

</div>

<hr class="my-10 border-slate-200">

{{-- VERIFICATION STATS --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

  <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
    <p class="text-sm text-slate-500 mb-1">Total Verifications</p>
    <p class="text-3xl font-bold text-slate-900">{{ $totalVerifications }}</p>
  </div>

  <div class="bg-white border border-indigo-100 rounded-2xl p-6 shadow-sm">
    <p class="text-sm text-slate-500 mb-1">Pending Approval</p>
    <p class="text-3xl font-bold text-amber-500">{{ $pendingVerifications }}</p>
  </div>

  <div class="bg-white border border-emerald-100 rounded-2xl p-6 shadow-sm">
    <p class="text-sm text-slate-500 mb-1">Approved</p>
    <p class="text-3xl font-bold text-emerald-500">{{ $approvedVerifications }}</p>
  </div>

  <div class="bg-white border border-rose-100 rounded-2xl p-6 shadow-sm">
    <p class="text-sm text-slate-500 mb-1">Rejected</p>
    <p class="text-3xl font-bold text-rose-500">{{ $rejectedVerifications }}</p>
  </div>

</div>

<hr class="my-10 border-slate-200">



    {{-- USER APPROVALS CARD --}}
    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm mb-6">
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-slate-900">User Approvals</h2>
        <a href="{{ route('admin.users.index') }}"
           class="text-sm font-medium text-primary hover:underline">
          View all users
        </a>
      </div>
      <p class="text-sm text-slate-500">
        Quick overview of user status. Use the Users page to approve or reject new registrations.
      </p>
    </div>

    {{-- VERIFICATION APPROVALS CARD --}}
    <div class="bg-white border border-cyan-100 rounded-2xl p-6 shadow-sm">
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-slate-900">Verification Approvals</h2>
        <a href="{{ route('admin.verifications.index') }}"
           class="text-sm font-medium text-primary hover:underline">
          View all verification requests
        </a>
      </div>
      <p class="text-sm text-slate-500">
        Review uploaded documents, approve or reject verification submissions.
      </p>
    </div>

  </main>
@endsection
