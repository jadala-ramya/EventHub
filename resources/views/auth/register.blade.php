<x-guest-layout>
    <!-- Full screen container -->
    <div class="fixed inset-0 w-full h-full flex flex-row">
        
        <!-- BACKGROUND - More vibrant, less dark than login -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?q=80&w=2070&auto=format&fit=crop" 
                 class="w-full h-full object-cover" 
                 alt="Festival crowd">
            <!-- Lighter, more energetic overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-purple-900/60 via-pink-800/40 to-yellow-900/60 mix-blend-overlay"></div>
            <div class="absolute inset-0 bg-black/30"></div>
        </div>

        <!-- LEFT COLUMN: Register Form (45% width - slightly smaller to showcase right column) -->
        <div class="relative z-10 w-[45%] h-full flex items-center justify-center p-8 backdrop-blur-sm overflow-y-auto">
            <div class="relative z-10 w-full max-w-md">
                <!-- Logo / Branding - Same brand, different tagline -->
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-purple-500 to-yellow-500 rounded-2xl shadow-lg mb-3 animate-pulse-slow">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white drop-shadow-lg">Join the Movement</h2>
                    <p class="text-yellow-200 mt-1 text-xs drop-shadow">Start your journey today</p>
                </div>

                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="text-white font-semibold mb-1 block text-xs">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="w-full px-4 py-2 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-yellow-400 text-sm"
                            placeholder="John Doe">
                        @error('name') <p class="mt-1 text-yellow-300 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label class="text-white font-semibold mb-1 block text-xs">Email</label>
                        <input type="email" name="email" id="registerEmail" value="{{ old('email') }}" required
                            class="w-full px-4 py-2 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-yellow-400 text-sm"
                            placeholder="you@example.com">
                        @error('email') <p class="mt-1 text-yellow-300 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="text-white font-semibold mb-1 block text-xs">Password</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-2 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-yellow-400 text-sm"
                            placeholder="Create a strong password">
                        @error('password') <p class="mt-1 text-yellow-300 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label class="text-white font-semibold mb-1 block text-xs">Confirm Password</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full px-4 py-2 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-yellow-400 text-sm"
                            placeholder="Confirm your password">
                    </div>

                    <!-- Verification Code Field (Shows only if email is approved for organizer) -->
                    <div class="mb-4" id="verificationCodeField" style="display: none;">
                        <label class="text-yellow-300 font-semibold mb-1 block text-xs flex items-center gap-2">
                            <span>🔑</span> Verification Code
                        </label>
                        <input type="text" name="verification_code" id="verification_code"
                            class="w-full px-4 py-2 bg-white/10 backdrop-blur-md border border-yellow-500/50 rounded-xl text-yellow-300 placeholder-yellow-500/50 focus:outline-none focus:ring-2 focus:ring-yellow-400 text-sm"
                            placeholder="Enter the 8-digit code from email">
                        <p class="text-yellow-300/50 text-[10px] mt-1">Enter the verification code sent to your email after admin approval</p>
                    </div>

                    <!-- Register Button & Login Link -->
                    <div class="flex items-center justify-between mb-4">
                        <a class="text-xs text-yellow-300 hover:text-white transition" href="{{ route('login') }}">
                            ← Already have an account?
                        </a>
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-purple-600 to-yellow-500 hover:from-purple-700 hover:to-yellow-600 text-white font-bold rounded-xl transition duration-300 shadow-lg text-sm">
                            Join Now →
                        </button>
                    </div>

                    <!-- Terms -->
                    <div class="text-center">
                        <p class="text-white/50 text-[10px]">
                            By joining, you agree to our<br>
                            <a href="#" class="text-yellow-300 hover:text-white transition">Terms of Service</a> and <a href="#" class="text-yellow-300 hover:text-white transition">Privacy Policy</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>

        <!-- RIGHT COLUMN: Discovery & Inspiration (55% width - NEW DESIGN) -->
        <div class="relative z-10 w-[55%] h-full flex flex-col items-center justify-center px-8 py-8 overflow-y-auto">
            
            <!-- Section Title - Different from login -->
            <div class="text-center mb-5">
                <span class="bg-yellow-500/20 backdrop-blur-sm text-yellow-300 px-3 py-1 rounded-full text-xs font-semibold border border-yellow-500/30">
                    🎵 DISCOVER YOUR NEXT EXPERIENCE
                </span>
            </div>

            <!-- Feature Cards Grid - 2 columns, showing benefits of joining -->
            <div class="grid grid-cols-2 gap-4 max-w-2xl mb-6">
                <div class="bg-white/5 backdrop-blur-sm rounded-xl p-3 border border-white/10 hover:bg-white/10 transition group">
                    <div class="text-2xl mb-1">🎧</div>
                    <h3 class="text-white font-semibold text-sm">Curated Events</h3>
                    <p class="text-white/50 text-xs">Personalized recommendations just for you</p>
                </div>
                <div class="bg-white/5 backdrop-blur-sm rounded-xl p-3 border border-white/10 hover:bg-white/10 transition group">
                    <div class="text-2xl mb-1">🤝</div>
                    <h3 class="text-white font-semibold text-sm">Connect</h3>
                    <p class="text-white/50 text-xs">Meet people who share your vibe</p>
                </div>
                <div class="bg-white/5 backdrop-blur-sm rounded-xl p-3 border border-white/10 hover:bg-white/10 transition group">
                    <div class="text-2xl mb-1">🎫</div>
                    <h3 class="text-white font-semibold text-sm">Exclusive Access</h3>
                    <p class="text-white/50 text-xs">Early bird tickets & members-only events</p>
                </div>
                <div class="bg-white/5 backdrop-blur-sm rounded-xl p-3 border border-white/10 hover:bg-white/10 transition group">
                    <div class="text-2xl mb-1">⭐</div>
                    <h3 class="text-white font-semibold text-sm">Rewards</h3>
                    <p class="text-white/50 text-xs">Earn points & unlock perks</p>
                </div>
            </div>

            <!-- Featured Upcoming Events (NEW - replaces stats) -->
            <div class="w-full max-w-2xl mb-5">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-white text-sm font-semibold">🔥 Featured Events This Week</h3>
                    <a href="#" class="text-yellow-300 text-xs hover:underline">View all →</a>
                </div>
                <div class="flex gap-3 overflow-x-auto pb-2 custom-scrollbar">
                    <div class="min-w-[140px] bg-gradient-to-br from-purple-800/40 to-pink-800/40 rounded-xl overflow-hidden border border-white/20">
                        <img src="https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?w=140&h=90&fit=crop" class="w-full h-20 object-cover">
                        <div class="p-2">
                            <p class="text-white text-xs font-semibold">Summer Beats Fest</p>
                            <p class="text-white/40 text-[10px]">Aug 15 • Miami</p>
                        </div>
                    </div>
                    <div class="min-w-[140px] bg-gradient-to-br from-purple-800/40 to-pink-800/40 rounded-xl overflow-hidden border border-white/20">
                        <img src="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=140&h=90&fit=crop" class="w-full h-20 object-cover">
                        <div class="p-2">
                            <p class="text-white text-xs font-semibold">Neon Nights</p>
                            <p class="text-white/40 text-[10px]">Aug 22 • LA</p>
                        </div>
                    </div>
                    <div class="min-w-[140px] bg-gradient-to-br from-purple-800/40 to-pink-800/40 rounded-xl overflow-hidden border border-white/20">
                        <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=140&h=90&fit=crop" class="w-full h-20 object-cover">
                        <div class="p-2">
                            <p class="text-white text-xs font-semibold">EDM Universe</p>
                            <p class="text-white/40 text-[10px]">Sep 05 • NYC</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial / Social Proof (NEW - builds trust) -->
            <div class="w-full max-w-2xl bg-purple-600/20 backdrop-blur-sm rounded-xl p-3 border border-purple-500/30">
                <div class="flex gap-3 items-center">
                    <div class="text-3xl">💬</div>
                    <div>
                        <p class="text-white/80 text-xs italic">"Found my tribe here! The best event platform ever."</p>
                        <p class="text-yellow-300 text-[10px] mt-1">— Sarah K., joined 2 months ago</p>
                    </div>
                </div>
                <div class="flex gap-1 mt-2">
                    <div class="flex -space-x-2">
                        <div class="w-6 h-6 rounded-full bg-purple-500 border border-white flex items-center justify-center text-[10px]">👤</div>
                        <div class="w-6 h-6 rounded-full bg-pink-500 border border-white flex items-center justify-center text-[10px]">👤</div>
                        <div class="w-6 h-6 rounded-full bg-orange-500 border border-white flex items-center justify-center text-[10px]">👤</div>
                    </div>
                    <p class="text-white/40 text-[10px] ml-2">Join 10,000+ happy event-goers</p>
                </div>
            </div>

            <!-- CTA Tagline - Different from login -->
            <p class="text-yellow-300 text-xs mt-5 flex items-center gap-2 drop-shadow">
                <span>🚀</span> Your community is waiting <span>✨</span>
            </p>
        </div>
    </div>

    <!-- Custom Animations & Scrollbar -->
    <style>
        @keyframes pulse-slow {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.95; transform: scale(1.02); }
        }
        .animate-pulse-slow {
            animation: pulse-slow 3s ease-in-out infinite;
        }
        .custom-scrollbar::-webkit-scrollbar {
            height: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 10px;
        }
        
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
    </style>

    <script>
        // Show verification code field when email matches an approved organizer request
        const emailInput = document.getElementById('registerEmail');
        const codeField = document.getElementById('verificationCodeField');
        
        if (emailInput) {
            emailInput.addEventListener('blur', function() {
                const email = this.value;
                if (email) {
                    fetch(`/check-organizer-email?email=${encodeURIComponent(email)}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.is_approved_organizer) {
                                codeField.style.display = 'block';
                                codeField.style.animation = 'fadeIn 0.3s ease-out';
                            } else {
                                codeField.style.display = 'none';
                            }
                        })
                        .catch(() => {});
                }
            });
        }
    </script>
</x-guest-layout>