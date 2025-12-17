@extends('layouts.loggedin-layout')

@section('title', 'Contact Info')

@section('content')
<div class="flex flex-col lg:flex-row gap-16">
    {{-- SETTINGS SIDEBAR --}}
    @include('settings._sidebar', ['active' => 'get-paid'])

    {{-- MAIN CONTENT --}}
    <div class="flex-1">
        <h2 class="text-xl font-bold text-slate-900 mb-6">Get Paid</h2>
    </div>
</div>
@endsection