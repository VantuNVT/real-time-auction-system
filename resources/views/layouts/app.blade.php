@vite(['resources/css/app.css'])
<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
</head>
<body class="h-full flex flex-col">
    <header class="bg-white shadow">
        <div class="max-w-4xl mx-auto py-4 px-6 flex justify-between items-center">
            <a href="{{ url('/') }}" class="font-bold">Mini Auction</a>
            <nav class="space-x-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:underline">Dashboard</a>
                    <a href="{{ route('auctions.index') }}" class="text-gray-700 hover:underline">Auctions</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:underline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-700 hover:underline">Register</a>
                @endauth
            </nav>
        </div>
    </header>
    <main class="flex-grow">
        @yield('content')
    </main>
</body>
</html>