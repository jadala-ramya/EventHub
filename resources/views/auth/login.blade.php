<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Full screen container -->
    <div class="fixed inset-0 w-full h-full flex flex-row">
        
        <!-- BACKGROUND - Using Register page colors (yellow/warm) -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?q=80&w=2070&auto=format&fit=crop" 
                 class="w-full h-full object-cover" 
                 alt="Festival crowd">
            <!-- Register page color overlay: purple to yellow (warmer) -->
            <div class="absolute inset-0 bg-gradient-to-br from-purple-900/60 via-pink-800/40 to-yellow-900/60 mix-blend-overlay"></div>
            <div class="absolute inset-0 bg-black/30"></div>
        </div>

        <!-- LEFT COLUMN: Login Form (50% width) -->
        <div class="relative z-10 w-1/2 h-full flex items-center justify-center p-8 backdrop-blur-sm overflow-y-auto">
            <div class="relative z-10 w-full max-w-lg">
                <!-- Logo / Branding - Register colors (yellow accent) -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-purple-500 to-yellow-500 rounded-2xl shadow-lg mb-4 animate-pulse-slow">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-white drop-shadow-lg">EventHub</h2>
                    <p class="text-yellow-200 mt-2 text-sm drop-shadow">Book unforgettable experiences</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" class="text-white font-semibold mb-1 block text-sm drop-shadow" />
                        <x-text-input id="email" 
                            class="w-full px-4 py-2.5 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent text-sm" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autofocus 
                            autocomplete="username"
                            placeholder="you@example.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-yellow-300 text-xs" />
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')" class="text-white font-semibold mb-1 block text-sm drop-shadow" />
                        <x-text-input id="password" 
                            class="w-full px-4 py-2.5 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent text-sm"
                            type="password"
                            name="password"
                            required 
                            autocomplete="current-password"
                            placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-yellow-300 text-xs" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between mb-6">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" 
                                class="rounded border-white/30 bg-white/10 text-purple-600 shadow-sm focus:ring-yellow-400 w-3.5 h-3.5">
                            <span class="ms-2 text-xs text-white/80">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-xs text-yellow-300 hover:text-white transition" href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <div class="mb-5">
                        <x-primary-button class="w-full justify-center py-2.5 bg-gradient-to-r from-purple-600 to-yellow-500 hover:from-purple-700 hover:to-yellow-600 text-white font-bold rounded-xl transition duration-300 shadow-lg text-sm">
                            {{ __('LOG IN') }}
                        </x-primary-button>
                    </div>

                    <!-- Register Link -->
                    <div class="text-center">
                        <p class="text-white/80 text-xs drop-shadow">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="text-yellow-300 hover:text-white font-semibold transition">Sign up now!</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>

        <!-- RIGHT COLUMN: Dynamic Event Visuals (50% width) -->
        <div class="relative z-10 w-1/2 h-full flex flex-col items-center justify-center text-center px-8 py-8 backdrop-blur-sm overflow-y-auto">
            <!-- Animated Badge - Yellow themed -->
            <div class="animate-bounce mb-4">
                <span class="bg-gradient-to-r from-purple-600/80 to-yellow-600/80 backdrop-blur-md text-white px-4 py-1.5 rounded-full text-xs font-semibold border border-yellow-500/30">
                    🎉 WELCOME BACK! 🎧
                </span>
            </div>

            <!-- Main Headline -->
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-3 leading-tight drop-shadow-lg">
                Good to<br>
                <span class="bg-gradient-to-r from-purple-400 to-yellow-400 bg-clip-text text-transparent">See You Again!</span>
            </h1>

            <!-- Subtext -->
            <p class="text-white/90 text-base mb-5 max-w-lg drop-shadow">
                Log in to access your personalized events, tickets, and exclusive experiences.
            </p>

            <!-- Stats -->
            <div class="flex gap-8 mb-5">
                <div class="text-center">
                    <div class="text-2xl font-bold bg-gradient-to-r from-purple-400 to-yellow-400 bg-clip-text text-transparent">50K+</div>
                    <div class="text-xs text-white/80 mt-0.5">Happy Attendees</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold bg-gradient-to-r from-yellow-400 to-orange-400 bg-clip-text text-transparent">200+</div>
                    <div class="text-xs text-white/80 mt-0.5">Live Events</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold bg-gradient-to-r from-orange-400 to-yellow-400 bg-clip-text text-transparent">15+</div>
                    <div class="text-xs text-white/80 mt-0.5">Countries</div>
                </div>
            </div>

            <!-- Sliding Images -->
            <div class="w-full max-w-2xl overflow-hidden mt-2">
                <div class="flex gap-4 animate-slide">
                    <img src="https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?w=140&h=140&fit=crop" class="w-28 h-28 rounded-xl object-cover shadow-xl border-2 border-purple-500/50 hover:scale-105 transition-transform duration-300">
                    <img src="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=140&h=140&fit=crop" class="w-28 h-28 rounded-xl object-cover shadow-xl border-2 border-yellow-500/50 hover:scale-105 transition-transform duration-300">
                    <img src="https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?w=140&h=140&fit=crop" class="w-28 h-28 rounded-xl object-cover shadow-xl border-2 border-purple-500/50 hover:scale-105 transition-transform duration-300">
                    <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=140&h=140&fit=crop" class="w-28 h-28 rounded-xl object-cover shadow-xl border-2 border-yellow-500/50 hover:scale-105 transition-transform duration-300">
                    <img src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?w=140&h=140&fit=crop" class="w-28 h-28 rounded-xl object-cover shadow-xl border-2 border-pink-500/50 hover:scale-105 transition-transform duration-300">
                    <img src="https://images.unsplash.com/photo-1524368535928-5b5e00ddc76b?w=140&h=140&fit=crop" class="w-28 h-28 rounded-xl object-cover shadow-xl border-2 border-purple-500/50 hover:scale-105 transition-transform duration-300">
                    <img src="https://images.unsplash.com/photo-1429962714451-bb934ecdc4ec?w=140&h=140&fit=crop" class="w-28 h-28 rounded-xl object-cover shadow-xl border-2 border-yellow-500/50 hover:scale-105 transition-transform duration-300">
                    <img src="https://images.unsplash.com/photo-1459749411173-1bf1f0cbe161?w=140&h=140&fit=crop" class="w-28 h-28 rounded-xl object-cover shadow-xl border-2 border-pink-500/50 hover:scale-105 transition-transform duration-300">
                </div>
            </div>

            <!-- CTA Tagline -->
            <p class="text-yellow-300 text-sm mt-5 flex items-center gap-2 drop-shadow">
                <span>🔥</span> Ready for tonight? Your events are waiting <span>🎧</span>
            </p>
        </div>
    </div>

    <!-- Custom Animations -->
    <style>
        @keyframes slide {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        @keyframes pulse-slow {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.95; transform: scale(1.02); }
        }
        .animate-slide {
            animation: slide 25s linear infinite;
            width: fit-content;
        }
        .animate-slide:hover {
            animation-play-state: paused;
        }
        .animate-pulse-slow {
            animation: pulse-slow 3s ease-in-out infinite;
        }
        
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
    </style>
</x-guest-layout>