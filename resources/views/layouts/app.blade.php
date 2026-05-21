<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>EventHub</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])



</head>

<body class="transition-all duration-300 bg-[#0B0B1A] text-white min-h-screen relative overflow-x-hidden">

    <!-- Global Animated Background Particles (Purple/Yellow/Pink) -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute top-20 left-10 w-96 h-96 bg-purple-900/20 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-pink-900/20 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-pulse delay-1000"></div>
        <div class="absolute top-1/3 left-1/3 w-96 h-96 bg-yellow-900/10 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse delay-2000"></div>
    </div>

    <div class="relative z-10 flex flex-col min-h-screen justify-between">
        <div>
            <!-- NAVBAR -->
            <nav class="relative z-50 backdrop-blur-xl bg-purple-950/40 border-b border-purple-900/30 text-white shadow-lg">
                <div class="px-6 mx-auto max-w-7xl">
                    <div class="flex items-center justify-between h-20">
                        <!-- Logo -->
                        <a href="/" class="text-3xl font-black bg-gradient-to-r from-purple-400 to-yellow-400 bg-clip-text text-transparent hover:scale-105 transition-all">
                            EventHub
                        </a>

                        <!-- Menu -->
                        <div class="flex items-center gap-6">
                            <a href="/" class="font-semibold text-purple-200 hover:text-yellow-400 transition-all">
                                Home
                            </a>
                            @auth
                                @if(auth()->user()->role == 'user')
                                    <a href="{{ route('my.bookings') }}" class="font-semibold text-purple-200 hover:text-yellow-400 transition-all">
                                        My Bookings
                                    </a>
                                @endif
                            @endauth
                            <a href="/user/dashboard" class="font-semibold text-purple-200 hover:text-yellow-400 transition-all">
                                Events
                            </a>
                            <a href="{{ route('search.events') }}" class="font-semibold text-purple-200 hover:text-yellow-400 transition-all">
                                Search
                            </a>

                            @auth
                                <!-- USER DROPDOWN -->
                                <div class="relative">
                                    <button onclick="toggleProfileMenu()"
                                            class="flex items-center gap-3 px-4 py-2 transition-all bg-purple-900/30 border border-purple-500/30 text-white rounded-3xl hover:bg-purple-900/50">
                                        <!-- Avatar -->
                                        <div class="flex items-center justify-center w-10 h-10 font-bold text-white rounded-full bg-gradient-to-r from-purple-600 to-yellow-500">
                                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                        </div>
                                        <div class="text-left">
                                            <h3 class="text-sm font-bold text-purple-100">
                                                {{ auth()->user()->name }}
                                            </h3>
                                            <p class="text-xs text-purple-300 capitalize">
                                                {{ auth()->user()->role }}
                                            </p>
                                        </div>
                                        <svg class="w-4 h-4 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>

                                    <!-- DROPDOWN -->
                                    <div id="profileMenu" class="absolute right-0 z-50 hidden mt-4 overflow-hidden bg-purple-950/95 border border-purple-900/50 backdrop-blur-xl shadow-2xl w-72 rounded-3xl text-white">
                                        <!-- Top -->
                                        <div class="p-6 text-white bg-gradient-to-r from-purple-800 to-yellow-600">
                                            <div class="flex items-center gap-4">
                                                <div class="flex items-center justify-center w-16 h-16 text-2xl font-bold text-purple-600 bg-white rounded-full">
                                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <h2 class="text-xl font-bold">
                                                        {{ auth()->user()->name }}
                                                    </h2>
                                                    <p class="text-sm text-purple-200">
                                                        {{ auth()->user()->email }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Menu Items -->
                                        <div class="p-3">
                                            <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-4 py-3 transition rounded-2xl text-white font-semibold hover:bg-white/10 hover:text-yellow-400 !text-white hover:!text-yellow-400">
                                                👤 Profile Settings
                                            </a>
                                            <a href="{{ route('my.bookings') }}" class="flex items-center gap-3 px-4 py-3 transition rounded-2xl text-white font-semibold hover:bg-white/10 hover:text-yellow-400 !text-white hover:!text-yellow-400">
                                                🎟️ My Bookings
                                            </a>
                                            @if(auth()->user()->role == 'organizer')
                                                <a href="{{ route('organizer.dashboard') }}" class="flex items-center gap-3 px-4 py-3 transition rounded-2xl text-white font-semibold hover:bg-white/10 hover:text-yellow-400 !text-white hover:!text-yellow-400">
                                                    📊 Organizer Dashboard
                                                </a>
                                            @endif
                                            @if(auth()->user()->role == 'admin')
                                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 transition rounded-2xl text-white font-semibold hover:bg-white/10 hover:text-yellow-400 !text-white hover:!text-yellow-400">
                                                    🛡️ Admin Dashboard
                                                </a>
                                            @endif
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button class="flex items-center w-full gap-3 px-4 py-3 mt-2 text-red-400 transition rounded-2xl hover:bg-red-950/30 font-semibold !text-red-400">
                                                    🚪 Logout
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="px-5 py-2 text-white bg-red-600/80 hover:bg-red-700 transition rounded-xl">
                                        Logout
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="font-semibold text-purple-200 hover:text-yellow-400 transition-all">
                                    Login
                                </a>
                                <a href="{{ route('register') }}" class="px-5 py-2 text-white bg-gradient-to-r from-purple-600 to-yellow-500 hover:from-purple-700 hover:to-yellow-600 transition rounded-xl">
                                    Register
                                </a>
                            @endauth

                            @auth
                                @if(auth()->user()->role == 'organizer')
                                    <a href="{{ route('organizer.dashboard') }}" class="font-semibold text-yellow-400">
                                        Organizer Dashboard
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <!-- CONTENT -->
            <main>
                @yield('content')
            </main>
        </div>
    </div>

    <script>
    function toggleProfileMenu()
    {
        document.getElementById('profileMenu').classList.toggle('hidden');
    }

    window.onclick = function(event)
    {
        if(!event.target.closest('#profileMenu') && !event.target.closest('button'))
        {
            const menu = document.getElementById('profileMenu');
            if(menu)
            {
                menu.classList.add('hidden');
            }
        }
    }
    </script>
</body>

</html>
