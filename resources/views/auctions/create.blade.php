@vite(['resources/css/app.css'])
<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo phiên đấu giá</title>
</head>
<body class="h-full flex items-center justify-center">
    <div class="w-full max-w-lg bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-center">Tạo phiên đấu giá mới</h1>
        @if($errors->any())
            <div class="mb-4 text-red-600">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('auctions.store') }}" class="space-y-4">
            @csrf
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Tiêu đề</label>
                <input id="title" name="title" type="text" required
                       class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
                <textarea id="description" name="description" rows="3"
                          class="mt-1 block w-full border border-gray-300 rounded px-3 py-2"></textarea>
            </div>
            <div>
                <label for="starting_price" class="block text-sm font-medium text-gray-700">Giá khởi đầu</label>
                <input id="starting_price" name="starting_price" type="number" step="0.01" required
                       class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="start_time" class="block text-sm font-medium text-gray-700">Bắt đầu</label>
                    <input id="start_time" name="start_time" type="datetime-local" required
                           class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
                </div>
                <div>
                    <label for="end_time" class="block text-sm font-medium text-gray-700">Kết thúc</label>
                    <input id="end_time" name="end_time" type="datetime-local" required
                           class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" />
                </div>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Tạo</button>
        </form>
    </div>
</body>
</html>