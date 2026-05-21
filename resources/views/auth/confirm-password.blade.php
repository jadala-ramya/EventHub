<x-guest-layout>
    <!-- Full screen container -->
    <div class="fixed inset-0 w-full h-full flex flex-row">
        
        <!-- BACKGROUND - Using Register page colors (purple to yellow/warm) -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?q=80&w=2070&auto=format&fit=crop" 
                 class="w-full h-full object-cover" 
                 alt="Festival crowd background">
            <!-- Register page color overlay: purple to yellow (warmer) -->
            <div class="absolute inset-0 bg-gradient-to-br from-purple-900/60 via-pink-800/40 to-yellow-900/60 mix-blend-overlay"></div>
            <div class="absolute inset-0 bg-black/30"></div>
        </div>

        <!-- LEFT COLUMN: Confirm Password Form (50% width) -->
        <div class="relative z-10 w-1/2 h-full flex items-center justify-center p-8 backdrop-blur-sm overflow-y-auto">
            <div class="relative z-10 w-full max-w-lg">
                <!-- Logo / Branding - Register colors (purple to yellow) -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-purple-500 to-yellow-500 rounded-2xl shadow-lg mb-4 animate-pulse-slow">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-white drop-shadow-lg">Confirm Password</h2>
                    <p class="text-yellow-200 mt-2 text-sm drop-shadow">Verify it's you</p>
                </div>

                <!-- Security Info Text - Styled with yellow accents -->
                <div class="mb-6 p-4 bg-purple-500/10 border border-yellow-500/30 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0">
                            <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <p class="text-yellow-200 text-sm">
                            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <!-- Password -->
                    <div class="mb-6">
                        <x-input-label for="password" :value="__('Password')" class="text-white font-semibold mb-2 block text-sm drop-shadow" />
                        <x-text-input id="password" 
                            class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent text-sm"
                            type="password"
                            name="password"
                            required 
                            autocomplete="current-password"
                            placeholder="Enter your password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-yellow-300 text-sm" />
                    </div>

                    <div class="flex flex-col gap-4 mt-6">
                        <!-- Confirm Button - Purple to Yellow gradient -->
                        <x-primary-button class="w-full justify-center py-3 bg-gradient-to-r from-purple-600 to-yellow-500 hover:from-purple-700 hover:to-yellow-600 text-white font-bold rounded-xl transition duration-300 shadow-lg text-sm">
                            {{ __('Confirm Identity →') }}
                        </x-primary-button>

                        <!-- Back to Dashboard Link -->
                        <div class="text-center">
                            <a href="{{ route('dashboard') }}" class="text-sm text-yellow-300 hover:text-white transition inline-flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                {{ __('Back to Dashboard') }}
                            </a>
                        </div>
                    </div>
                </form>

                <!-- Additional Security Note -->
                <div class="mt-8 text-center">
                    <p class="text-white/40 text-xs">
                        🔒 This helps us keep your account secure
                    </p>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: Dynamic Visuals (50% width) - Warm/Yellow theme -->
        <div class="relative z-10 w-1/2 h-full flex flex-col items-center justify-center text-center px-8 py-8 backdrop-blur-sm overflow-y-auto">
            <!-- Animated Badge - Yellow themed -->
            <div class="animate-bounce mb-6">
                <span class="bg-gradient-to-r from-purple-600/80 to-yellow-600/80 backdrop-blur-md text-white px-4 py-1.5 rounded-full text-xs font-semibold border border-yellow-500/30">
                    🔐 SECURITY CHECKPOINT 🔒
                </span>
            </div>

            <!-- Main Headline - Yellow gradient -->
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 leading-tight drop-shadow-lg">
                Almost There!<br>
                <span class="bg-gradient-to-r from-purple-400 to-yellow-400 bg-clip-text text-transparent">One Last Step</span><br>
                To Secure Access
            </h1>

            <!-- Subtext -->
            <p class="text-white/90 text-base mb-8 max-w-lg drop-shadow">
                We take security seriously. Please confirm your password to access this protected area of your account.
            </p>

            <!-- Illustration / Visual - Shield/Security icon -->
            <div class="relative mb-8">
                <div class="w-48 h-48 mx-auto bg-gradient-to-br from-purple-500/20 to-yellow-500/20 rounded-full flex items-center justify-center backdrop-blur-sm border border-white/20">
                    <svg class="w-24 h-24 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <!-- Animated rings around the icon -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-56 h-56 border border-purple-500/30 rounded-full animate-ping" style="animation-duration: 3s;"></div>
                </div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-64 h-64 border border-yellow-500/20 rounded-full animate-ping" style="animation-duration: 4s; animation-delay: 1s;"></div>
                </div>
            </div>

            <!-- Security Tips -->
            <div class="grid grid-cols-2 gap-3 max-w-md mb-6">
                <div class="flex items-center gap-2 text-xs text-white/60 bg-white/5 rounded-lg px-3 py-2">
                    <span class="text-green-400">✓</span>
                    <span>End-to-end encrypted</span>
                </div>
                <div class="flex items-center gap-2 text-xs text-white/60 bg-white/5 rounded-lg px-3 py-2">
                    <span class="text-green-400">✓</span>
                    <span>2FA ready</span>
                </div>
            </div>

            <!-- Trust Badge - Yellow theme -->
            <div class="flex items-center gap-2 text-yellow-300 text-xs">
                <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span>Protected Area</span>
                <span class="w-px h-3 bg-white/20 mx-2"></span>
                <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span>Your security matters</span>
            </div>

            <!-- Help Text -->
            <p class="text-white/40 text-xs mt-6">
                Having trouble? <a href="{{ route('password.request') }}" class="text-yellow-300 hover:text-white transition">Reset your password</a>
            </p>

            <!-- CTA Tagline -->
            <p class="text-yellow-300 text-xs mt-6 flex items-center gap-2 drop-shadow">
                <span>🔒</span> Keeping your account safe <span>🛡️</span>
            </p>
        </div>
    </div>

    <!-- Custom Animations -->
    <style>
        @keyframes pulse-slow {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.95; transform: scale(1.02); }
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