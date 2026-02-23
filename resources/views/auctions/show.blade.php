@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto py-6 bg-white rounded shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">{{ $auction->title }}</h1>
        <a href="{{ route('auctions.index') }}" class="text-blue-600 hover:underline">Quay lại</a>
    </div>
    <p class="mb-2"><strong>Mô tả:</strong> {{ $auction->description }}</p>
    <p class="mb-2"><strong>Khởi điểm:</strong> {{ number_format($auction->starting_price,2) }}</p>
    <p class="mb-2"><strong>Giá hiện tại:</strong> {{ number_format($auction->current_price,2) }}</p>
    <p class="mb-2"><strong>Trạng thái:</strong> {{ $auction->status }}</p>
    <p class="mb-2"><strong>Bước giá:</strong> -- chưa thiết lập --</p>
    <p class="mb-6"><strong>Bắt đầu:</strong> {{ $auction->start_time }} | <strong>Kết thúc:</strong> {{ $auction->end_time }}</p>

    {{-- bidding form nếu active --}}
    @if($auction->status === 'active')
        <form method="POST" action="{{ route('auctions.bid', $auction) }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Số tiền đặt (lớn hơn {{ number_format($auction->current_price,2) }})</label>
                <input type="number" name="amount" step="0.01" required
                    class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
            </div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Đặt giá</button>
        </form>
    @endif

    {{-- lịch sử đấu giá --}}
    <section class="mt-6">
        <h3 class="font-semibold">Lịch sử</h3>
        @if($auction->bids->isEmpty())
            <p>Chưa ai đặt giá.</p>
        @else
            <ul class="space-y-1">
                @foreach($auction->bids as $bid)
                    <li class="text-sm">
                        {{ $bid->user->name }} đặt {{ number_format($bid->amount,2) }} vào {{ $bid->created_at }}
                    </li>
                @endforeach
            </ul>
        @endif
    </section>
</div>
@endsection
