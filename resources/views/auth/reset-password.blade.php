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

        <!-- LEFT COLUMN: Reset Password Form (50% width) -->
        <div class="relative z-10 w-1/2 h-full flex items-center justify-center p-8 backdrop-blur-sm overflow-y-auto">
            <div class="relative z-10 w-full max-w-lg">
                <!-- Logo / Branding - Register colors (purple to yellow) -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-purple-500 to-yellow-500 rounded-2xl shadow-lg mb-4 animate-pulse-slow">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-white drop-shadow-lg">Create New Password</h2>
                    <p class="text-yellow-200 mt-2 text-sm drop-shadow">Choose a strong password</p>
                </div>

                <!-- Info Text - Styled with yellow accents -->
                <div class="mb-6 p-4 bg-purple-500/10 border border-yellow-500/30 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0">
                            <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <p class="text-yellow-200 text-sm">
                            {{ __('Create a new password for your account. Make sure it\'s strong and unique.') }}
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') ?? $request->query('token') }}">

                    <!-- Email Address -->
                    <div class="mb-5">
                        <x-input-label for="email" :value="__('Email')" class="text-white font-semibold mb-2 block text-sm drop-shadow" />
                        <x-text-input id="email" 
                            class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent text-sm" 
                            type="email" 
                            name="email" 
                            :value="old('email', $request->email)" 
                            required 
                            autofocus 
                            autocomplete="username"
                            placeholder="you@example.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-yellow-300 text-sm" />
                    </div>

                    <!-- Password -->
                    <div class="mb-5">
                        <x-input-label for="password" :value="__('New Password')" class="text-white font-semibold mb-2 block text-sm drop-shadow" />
                        <x-text-input id="password" 
                            class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent text-sm"
                            type="password"
                            name="password"
                            required 
                            autocomplete="new-password"
                            placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-yellow-300 text-sm" />
                        <!-- Password strength indicator -->
                        <div class="mt-2">
                            <div class="flex gap-1">
                                <div class="h-1 w-full bg-white/10 rounded-full" id="strength-bar-1"></div>
                                <div class="h-1 w-full bg-white/10 rounded-full" id="strength-bar-2"></div>
                                <div class="h-1 w-full bg-white/10 rounded-full" id="strength-bar-3"></div>
                                <div class="h-1 w-full bg-white/10 rounded-full" id="strength-bar-4"></div>
                            </div>
                            <p class="text-white/40 text-xs mt-1" id="strength-text">Password strength: <span id="strength-level">Not set</span></p>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <x-input-label for="password_confirmation" :value="__('Confirm New Password')" class="text-white font-semibold mb-2 block text-sm drop-shadow" />
                        <x-text-input id="password_confirmation" 
                            class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent text-sm"
                            type="password"
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password"
                            placeholder="Confirm your password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-yellow-300 text-sm" />
                    </div>

                    <div class="flex flex-col gap-4 mt-6">
                        <!-- Reset Password Button - Purple to Yellow gradient -->
                        <x-primary-button class="w-full justify-center py-3 bg-gradient-to-r from-purple-600 to-yellow-500 hover:from-purple-700 hover:to-yellow-600 text-white font-bold rounded-xl transition duration-300 shadow-lg text-sm">
                            {{ __('Reset Password →') }}
                        </x-primary-button>

                        <!-- Back to Login Link -->
                        <div class="text-center">
                            <a href="{{ route('login') }}" class="text-sm text-yellow-300 hover:text-white transition inline-flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                {{ __('Back to Login') }}
                            </a>
                        </div>
                    </div>
                </form>

                <!-- Password Requirements -->
                <div class="mt-8 text-center">
                    <div class="grid grid-cols-2 gap-2">
                        <p class="text-white/40 text-[10px] flex items-center justify-center gap-1">
                            <span class="text-green-400">✓</span> 8+ characters
                        </p>
                        <p class="text-white/40 text-[10px] flex items-center justify-center gap-1">
                            <span class="text-green-400">✓</span> 1 uppercase
                        </p>
                        <p class="text-white/40 text-[10px] flex items-center justify-center gap-1">
                            <span class="text-green-400">✓</span> 1 number
                        </p>
                        <p class="text-white/40 text-[10px] flex items-center justify-center gap-1">
                            <span class="text-green-400">✓</span> 1 special char
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: Dynamic Visuals (50% width) - Warm/Yellow theme -->
        <div class="relative z-10 w-1/2 h-full flex flex-col items-center justify-center text-center px-8 py-8 backdrop-blur-sm overflow-y-auto">
            <!-- Animated Badge - Yellow themed -->
            <div class="animate-bounce mb-6">
                <span class="bg-gradient-to-r from-purple-600/80 to-yellow-600/80 backdrop-blur-md text-white px-4 py-1.5 rounded-full text-xs font-semibold border border-yellow-500/30">
                    🔐 RESET YOUR PASSWORD 🔑
                </span>
            </div>

            <!-- Main Headline - Yellow gradient -->
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 leading-tight drop-shadow-lg">
                Time for a<br>
                <span class="bg-gradient-to-r from-purple-400 to-yellow-400 bg-clip-text text-transparent">Fresh Start!</span>
            </h1>

            <!-- Subtext -->
            <p class="text-white/90 text-base mb-8 max-w-lg drop-shadow">
                Create a strong, unique password to keep your account secure. Remember to store it somewhere safe!
            </p>

            <!-- Illustration / Visual - Key/Lock icon -->
            <div class="relative mb-8">
                <div class="w-48 h-48 mx-auto bg-gradient-to-br from-purple-500/20 to-yellow-500/20 rounded-full flex items-center justify-center backdrop-blur-sm border border-white/20">
                    <svg class="w-24 h-24 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
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

            <!-- Password Tips -->
            <div class="grid grid-cols-1 gap-2 max-w-md mb-6">
                <div class="flex items-center gap-2 text-xs text-white/60 bg-white/5 rounded-lg px-3 py-2">
                    <span class="text-yellow-400">💡</span>
                    <span>Tip: Use a passphrase with 3-4 random words</span>
                </div>
                <div class="flex items-center gap-2 text-xs text-white/60 bg-white/5 rounded-lg px-3 py-2">
                    <span class="text-yellow-400">⚠️</span>
                    <span>Avoid using common passwords like "password123"</span>
                </div>
            </div>

            <!-- Trust Badge - Yellow theme -->
            <div class="flex items-center gap-2 text-yellow-300 text-xs">
                <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span>End-to-end encrypted</span>
                <span class="w-px h-3 bg-white/20 mx-2"></span>
                <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span>Password never stored in plain text</span>
            </div>

            <!-- CTA Tagline -->
            <p class="text-yellow-300 text-xs mt-6 flex items-center gap-2 drop-shadow">
                <span>🛡️</span> We take your security seriously <span>🔒</span>
            </p>
        </div>
    </div>

    <!-- Password Strength Checker Script -->
    <script>
        const passwordInput = document.getElementById('password');
        const strengthBars = [
            document.getElementById('strength-bar-1'),
            document.getElementById('strength-bar-2'),
            document.getElementById('strength-bar-3'),
            document.getElementById('strength-bar-4')
        ];
        const strengthLevelSpan = document.getElementById('strength-level');

        function checkPasswordStrength(password) {
            let strength = 0;
            
            // Length check
            if (password.length >= 8) strength++;
            
            // Uppercase check
            if (/[A-Z]/.test(password)) strength++;
            
            // Number check
            if (/[0-9]/.test(password)) strength++;
            
            // Special character check
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            return strength;
        }

        function updateStrengthIndicator() {
            const password = passwordInput.value;
            const strength = checkPasswordStrength(password);
            
            // Reset bars
            strengthBars.forEach(bar => {
                bar.className = 'h-1 w-full bg-white/10 rounded-full';
            });
            
            // Set strength level text
            let strengthText = '';
            let barColor = '';
            
            switch(strength) {
                case 0:
                    strengthText = 'Very Weak';
                    barColor = 'bg-red-500';
                    break;
                case 1:
                    strengthText = 'Weak';
                    barColor = 'bg-orange-500';
                    break;
                case 2:
                    strengthText = 'Medium';
                    barColor = 'bg-yellow-500';
                    break;
                case 3:
                    strengthText = 'Strong';
                    barColor = 'bg-green-500';
                    break;
                case 4:
                    strengthText = 'Very Strong';
                    barColor = 'bg-emerald-500';
                    break;
            }
            
            if (password.length === 0) {
                strengthText = 'Not set';
            }
            
            strengthLevelSpan.textContent = strengthText;
            strengthLevelSpan.className = strength === 0 ? 'text-red-400' : 
                                         strength === 1 ? 'text-orange-400' :
                                         strength === 2 ? 'text-yellow-400' :
                                         strength === 3 ? 'text-green-400' : 'text-emerald-400';
            
            // Fill bars
            for (let i = 0; i < strength; i++) {
                strengthBars[i].className = `h-1 w-full ${barColor} rounded-full`;
            }
        }
        
        passwordInput.addEventListener('input', updateStrengthIndicator);
    </script>

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