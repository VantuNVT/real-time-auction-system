@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto py-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Phiên đấu giá</h1>
        <a href="{{ route('auctions.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-700">Tạo mới</a>
    </div>
    <div class="grid grid-cols-1 gap-4">
        @forelse($auctions as $auction)
            <a href="{{ route('auctions.show', $auction) }}" class="block p-4 bg-white rounded shadow hover:shadow-lg transition">
                <h2 class="font-semibold text-lg">{{ $auction->title }}</h2>
                <p class="text-sm text-gray-600">Giá hiện tại: {{ number_format($auction->current_price,2) }}</p>
                <p class="text-sm text-gray-600">Trạng thái: {{ $auction->status }}</p>
                <p class="text-sm text-gray-500">Bắt đầu: {{ $auction->start_time }}</p>
            </a>
        @empty
            <p>Chưa có phiên nào.</p>
        @endforelse
    </div>
    <div class="mt-6">
        {{ $auctions->links() }}
    </div>
</div>
@endsection
