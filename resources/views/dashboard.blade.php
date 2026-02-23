@extends('layouts.app')
@section('content')
<div class="h-full flex items-center justify-center">
    <div class="w-full max-w-md bg-white p-8 rounded shadow text-center">
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
        <p class="mb-2">Xin chào, <span class="font-semibold">{{ auth()->user()->name }}</span> (<em>{{ auth()->user()->role }}</em>)</p>
        <p class="mb-6">Coin balance: <span class="font-mono">{{ auth()->user()->coin_balance }}</span></p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Logout</button>
        </form>
    </div>
</div>
@endsection
