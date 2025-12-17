@extends('layouts.loggedin-layout')

@section('title', 'Influentia - Account Verification')

@section('content')
  <main class="container mx-auto px-6 py-8 md:px-12 lg:px-24">
    <div class="mb-8">
      <h1 class="mb-2 text-3xl font-extrabold text-slate-900 tracking-tight md:text-4xl">
        Account Verification
      </h1>
      <p class="text-slate-500 text-lg">
        Upload your document to verify your {{ $user->role === 'brand' ? 'business' : 'identity' }}.
      </p>
    </div>

    @if(session('success'))
      <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
        <ul class="list-disc list-inside space-y-1">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="md:col-span-2 bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
        <form method="POST" action="{{ route('account.verification.store') }}" enctype="multipart/form-data" class="space-y-5">
          @csrf

          <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">
              Verification document
            </label>
            <input
              type="file"
              name="document"
              class="block w-full text-sm text-slate-700 border border-slate-200 rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary bg-slate-50"
              required
            >
            <p class="mt-1 text-xs text-slate-400">
              Accepted formats: JPG, PNG, PDF. Max 4 MB.
            </p>
          </div>

          <button
            type="submit"
            class="inline-flex items-center justify-center rounded-xl px-4 py-2.5 text-sm font-semibold text-white bg-primary hover:brightness-110 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
          >
            Submit for review
          </button>
        </form>
      </div>

      <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
        <h2 class="text-sm font-semibold text-slate-900 mb-3">Verification status</h2>

        @if($latest)
          <p class="text-xs text-slate-500 mb-1">
            Last submitted: {{ $latest->created_at->format('d M Y H:i') }}
          </p>

          <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium mb-3
            @if($latest->status === 'pending') bg-amber-50 text-amber-700
            @elseif($latest->status === 'approved') bg-emerald-50 text-emerald-700
            @else bg-rose-50 text-rose-700 @endif">
            {{ ucfirst($latest->status) }}
          </span>

          @if($latest->notes)
            <p class="text-xs text-slate-500">
              Admin note: {{ $latest->notes }}
            </p>
          @endif
        @else
          <p class="text-sm text-slate-500">
            You haven't submitted any verification documents yet.
          </p>
        @endif
      </div>
    </div>
  </main>
@endsection
