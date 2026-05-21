<x-app-layout>
    <style>
        /* Custom Animations & Gamified Elements */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }
        @keyframes pulse-ring {
            0% { transform: scale(0.8); opacity: 0.5; }
            100% { transform: scale(1.3); opacity: 0; }
        }
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        @keyframes confetti-fall {
            0% { transform: translateY(-100vh) rotate(0deg); opacity: 1; }
            100% { transform: translateY(100vh) rotate(360deg); opacity: 0; }
        }
        @keyframes slide-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes glow-pulse {
            0%, 100% { box-shadow: 0 0 5px rgba(168,85,247,0.5); }
            50% { box-shadow: 0 0 20px rgba(168,85,247,0.8); }
        }

        .animate-float { animation: float 3s ease-in-out infinite; }
        .animate-slide-up { animation: slide-up 0.5s ease-out forwards; }
        .glow-pulse { animation: glow-pulse 2s ease-in-out infinite; }
        
        .stat-card {
            background: linear-gradient(135deg, rgba(168,85,247,0.15) 0%, rgba(236,72,153,0.15) 100%);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .stat-card:hover {
            transform: translateY(-4px) scale(1.02);
            border-color: rgba(168,85,247,0.5);
            background: linear-gradient(135deg, rgba(168,85,247,0.25) 0%, rgba(236,72,153,0.25) 100%);
        }
        
        .level-progress {
            background: linear-gradient(90deg, #a855f7, #ec4899, #f59e0b);
            background-size: 200% 100%;
            animation: shimmer 2s ease-in-out infinite;
        }
        
        .achievement-badge {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .achievement-badge:hover {
            transform: scale(1.1) rotate(5deg);
        }
        
        .confetti {
            position: fixed;
            width: 10px;
            height: 10px;
            background: linear-gradient(135deg, #a855f7, #ec4899, #f59e0b);
            pointer-events: none;
            z-index: 1000;
            animation: confetti-fall 3s ease-out forwards;
        }
        
        .xp-gain {
            animation: slide-up 0.5s ease-out forwards;
            color: #f59e0b;
            font-weight: bold;
            text-shadow: 0 0 5px rgba(245,158,11,0.5);
        }
        
        .quest-card {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.1);
            transition: all 0.3s ease;
        }
        .quest-card:hover {
            background: rgba(168,85,247,0.15);
            border-color: rgba(168,85,247,0.4);
        }
        
        .streak-flame {
            filter: drop-shadow(0 0 8px #f59e0b);
            animation: float 2s ease-in-out infinite;
        }
    </style>

    <!-- Gamified Background with Animated Particles -->
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-pink-900 relative overflow-hidden">
        
        <!-- Animated Background Particles -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-72 h-72 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl animate-pulse delay-1000"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-orange-500 rounded-full mix-blend-multiply filter blur-3xl animate-pulse delay-2000"></div>
            <!-- Floating particles -->
            <div class="absolute top-10 left-[20%] w-1 h-1 bg-purple-400 rounded-full animate-ping"></div>
            <div class="absolute bottom-20 right-[30%] w-1.5 h-1.5 bg-pink-400 rounded-full animate-ping delay-300"></div>
            <div class="absolute top-40 right-[15%] w-1 h-1 bg-orange-400 rounded-full animate-ping delay-700"></div>
        </div>

        <div class="relative z-10">
            <!-- Header with Gamified Elements -->
            <div class="bg-black/20 backdrop-blur-md border-b border-white/10">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div class="flex items-center gap-4">
                            <!-- Level Badge with XP Progress -->
                            <div class="relative">
                                <div class="w-16 h-16 bg-gradient-to-br from-purple-600 to-pink-600 rounded-2xl flex items-center justify-center shadow-lg glow-pulse">
                                    <span class="text-2xl font-bold text-white">Lv.7</span>
                                </div>
                                <div class="absolute -top-2 -right-2 w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center text-xs font-bold text-black animate-bounce">
                                    🎯
                                </div>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold bg-gradient-to-r from-purple-400 via-pink-400 to-orange-400 bg-clip-text text-transparent">
                                    {{ __('Dashboard') }}
                                </h1>
                                <div class="flex items-center gap-3 mt-1">
                                    <p class="text-purple-200 text-sm">
                                        Welcome back, <span class="font-semibold text-white">{{ Auth::user()->name }}</span>!
                                    </p>
                                    <!-- Streak Counter -->
                                    <div class="flex items-center gap-1 bg-white/10 rounded-full px-2 py-0.5">
                                        <span class="streak-flame">🔥</span>
                                        <span class="text-orange-400 text-sm font-bold">15</span>
                                        <span class="text-white/60 text-xs">day streak</span>
                                    </div>
                                </div>
                                <!-- XP Progress Bar -->
                                <div class="mt-2">
                                    <div class="flex justify-between text-xs text-white/60 mb-1">
                                        <span>XP to next level</span>
                                        <span>350 / 500 XP</span>
                                    </div>
                                    <div class="w-48 h-1.5 bg-white/10 rounded-full overflow-hidden">
                                        <div class="level-progress h-full rounded-full" style="width: 70%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Live Badge with Notification -->
                        <div class="flex items-center gap-3">
                            <div class="relative group cursor-pointer">
                                <div class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 hover:bg-white/20 transition">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                    </svg>
                                </div>
                                <span class="absolute -top-1 -right-1 w-3 h-3 bg-orange-500 rounded-full animate-ping"></span>
                                <span class="absolute -top-1 -right-1 w-3 h-3 bg-orange-500 rounded-full"></span>
                            </div>
                            <div class="hidden md:flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 border border-white/20">
                                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                <span class="text-white/80 text-sm">Live Mode</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gamified Dashboard Content -->
            <div class="py-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    
                    <!-- ==== GAMIFIED STATS CARDS (Animated on hover) ==== -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 animate-slide-up" style="animation-delay: 0.1s">
                        <!-- Stat 1: Total Events -->
                        <div class="stat-card rounded-2xl p-5 cursor-pointer group" onclick="showAchievement('Event Explorer')">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-purple-200 text-sm">Total Events</p>
                                    <p class="text-3xl font-bold text-white mt-1">24</p>
                                    <p class="text-green-400 text-xs mt-1">↑ +3 this month</p>
                                </div>
                                <div class="w-12 h-12 bg-purple-500/30 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-3 h-1 bg-white/10 rounded-full overflow-hidden">
                                <div class="w-3/4 h-full bg-gradient-to-r from-purple-500 to-pink-500 rounded-full"></div>
                            </div>
                        </div>
                        
                        <!-- Stat 2: Tickets Booked -->
                        <div class="stat-card rounded-2xl p-5 cursor-pointer group" onclick="showAchievement('Ticket Master')">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-pink-200 text-sm">Tickets Booked</p>
                                    <p class="text-3xl font-bold text-white mt-1">156</p>
                                    <p class="text-green-400 text-xs mt-1">🎫 12 this week</p>
                                </div>
                                <div class="w-12 h-12 bg-pink-500/30 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-3 h-1 bg-white/10 rounded-full overflow-hidden">
                                <div class="w-full h-full bg-gradient-to-r from-pink-500 to-orange-500 rounded-full"></div>
                            </div>
                        </div>
                        
                        <!-- Stat 3: Total Spent with XP Bonus -->
                        <div class="stat-card rounded-2xl p-5 cursor-pointer group" onclick="addXP(50)">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-orange-200 text-sm">Total Spent</p>
                                    <p class="text-3xl font-bold text-white mt-1">$2,847</p>
                                    <p class="text-yellow-400 text-xs mt-1">✨ +50 XP on next purchase</p>
                                </div>
                                <div class="w-12 h-12 bg-orange-500/30 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Stat 4: Reward Points -->
                        <div class="stat-card rounded-2xl p-5 cursor-pointer group" onclick="showAchievement('Points Collector')">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-yellow-200 text-sm">Reward Points</p>
                                    <p class="text-3xl font-bold text-white mt-1">3,240</p>
                                    <p class="text-yellow-400 text-xs mt-1">⭐ 160 to next reward</p>
                                </div>
                                <div class="w-12 h-12 bg-yellow-500/30 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ==== ORIGINAL CONTENT CARD (Preserved - Now with Gamified Border) ==== -->
                    <div class="premium-card rounded-2xl shadow-2xl overflow-hidden border border-purple-500/30 animate-slide-up" style="animation-delay: 0.2s">
                        <!-- Card Header with Gamified Accent -->
                        <div class="relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-purple-500/20 to-pink-500/20 rounded-full blur-3xl"></div>
                            <div class="px-8 py-6 border-b border-white/20 bg-white/5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center animate-float">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <h2 class="text-xl font-semibold text-white">
                                        {{ __('Dashboard Overview') }}
                                    </h2>
                                    <span class="px-3 py-1 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full text-xs text-white shadow-lg">
                                        🎮 Premium Member
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body - ORIGINAL CONTENT EXACTLY AS IS -->
                        <div class="p-8 text-gray-200">
                            {{ __("You're logged in!") }}
                            
                            <!-- Original content preserved + Gamified contextual info -->
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-center gap-3 p-3 bg-white/5 rounded-xl group hover:bg-white/10 transition">
                                    <div class="w-8 h-8 bg-green-500/20 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                                        <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-white/60 text-xs">Account Status</p>
                                        <p class="text-white text-sm font-semibold">Active & Verified ✅</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-white/5 rounded-xl group hover:bg-white/10 transition">
                                    <div class="w-8 h-8 bg-purple-500/20 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                                        <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-white/60 text-xs">Member Since</p>
                                        <p class="text-white text-sm font-semibold">2024</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer with Quick Actions -->
                        <div class="px-8 py-4 bg-white/5 border-t border-white/20">
                            <div class="flex flex-wrap gap-3">
                                <button onclick="showAchievement('Event Explorer')" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 rounded-lg text-white text-sm font-semibold hover:from-purple-700 hover:to-pink-700 transition shadow-lg hover:scale-105 transform">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                    </svg>
                                    Browse Events
                                </button>
                                <button onclick="showAchievement('Profile Master')" class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 rounded-lg text-white text-sm font-semibold hover:bg-white/20 transition border border-white/20 hover:scale-105 transform">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    My Profile
                                </button>
                                <button onclick="addXP(25)" class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 rounded-lg text-white text-sm font-semibold hover:bg-white/20 transition border border-white/20 hover:scale-105 transform">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                    </svg>
                                    My Tickets
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- ==== GAMIFIED SECTIONS (Quests, Achievements, Leaderboard) ==== -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">
                        
                        <!-- Daily Quests / Challenges -->
                        <div class="quest-card rounded-2xl p-5 animate-slide-up" style="animation-delay: 0.3s">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="text-2xl">🎯</span>
                                <h3 class="text-white font-bold">Daily Quests</h3>
                                <span class="ml-auto text-orange-400 text-xs">3/5 completed</span>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center gap-3 p-2 rounded-lg bg-white/5">
                                    <input type="checkbox" class="w-4 h-4 rounded border-purple-500 text-purple-600 focus:ring-purple-500" onchange="updateQuest(this)">
                                    <div class="flex-1">
                                        <p class="text-white text-sm">🎫 Book 1 event ticket</p>
                                        <p class="text-white/40 text-xs">+50 XP</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 p-2 rounded-lg bg-white/5">
                                    <input type="checkbox" class="w-4 h-4 rounded border-purple-500 text-purple-600 focus:ring-purple-500" onchange="updateQuest(this)">
                                    <div class="flex-1">
                                        <p class="text-white text-sm">👥 Share an event with a friend</p>
                                        <p class="text-white/40 text-xs">+30 XP</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 p-2 rounded-lg bg-white/5">
                                    <input type="checkbox" class="w-4 h-4 rounded border-purple-500 text-purple-600 focus:ring-purple-500" onchange="updateQuest(this)">
                                    <div class="flex-1">
                                        <p class="text-white text-sm">⭐ Rate 3 events you attended</p>
                                        <p class="text-white/40 text-xs">+40 XP</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 pt-3 border-t border-white/10">
                                <div class="flex justify-between text-xs text-white/60 mb-1">
                                    <span>Quest progress</span>
                                    <span>60%</span>
                                </div>
                                <div class="h-1.5 bg-white/10 rounded-full overflow-hidden">
                                    <div class="w-3/5 h-full bg-gradient-to-r from-purple-500 to-pink-500 rounded-full"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Achievements / Badges -->
                        <div class="quest-card rounded-2xl p-5 animate-slide-up" style="animation-delay: 0.4s">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="text-2xl">🏆</span>
                                <h3 class="text-white font-bold">Achievements</h3>
                                <span class="ml-auto text-purple-400 text-xs">6/12 unlocked</span>
                            </div>
                            <div class="grid grid-cols-3 gap-3">
                                <div class="achievement-badge text-center p-2 rounded-xl bg-white/5 hover:bg-purple-500/20" onclick="showAchievement('First Event')">
                                    <div class="text-3xl mb-1">🎟️</div>
                                    <p class="text-white/80 text-xs">First Event</p>
                                    <span class="text-green-400 text-[10px]">✓</span>
                                </div>
                                <div class="achievement-badge text-center p-2 rounded-xl bg-white/5 hover:bg-purple-500/20" onclick="showAchievement('Social Butterfly')">
                                    <div class="text-3xl mb-1">🦋</div>
                                    <p class="text-white/80 text-xs">Social Butterfly</p>
                                    <span class="text-green-400 text-[10px]">✓</span>
                                </div>
                                <div class="achievement-badge text-center p-2 rounded-xl bg-white/5 hover:bg-purple-500/20 opacity-50" onclick="showAchievement('VIP Member')">
                                    <div class="text-3xl mb-1">💎</div>
                                    <p class="text-white/80 text-xs">VIP Member</p>
                                    <span class="text-white/30 text-[10px]">🔒</span>
                                </div>
                                <div class="achievement-badge text-center p-2 rounded-xl bg-white/5 hover:bg-purple-500/20" onclick="showAchievement('Early Bird')">
                                    <div class="text-3xl mb-1">🐦</div>
                                    <p class="text-white/80 text-xs">Early Bird</p>
                                    <span class="text-green-400 text-[10px]">✓</span>
                                </div>
                                <div class="achievement-badge text-center p-2 rounded-xl bg-white/5 hover:bg-purple-500/20" onclick="showAchievement('Event Master')">
                                    <div class="text-3xl mb-1">👑</div>
                                    <p class="text-white/80 text-xs">Event Master</p>
                                    <span class="text-green-400 text-[10px]">✓</span>
                                </div>
                                <div class="achievement-badge text-center p-2 rounded-xl bg-white/5 hover:bg-purple-500/20 opacity-50" onclick="showAchievement('Global Explorer')">
                                    <div class="text-3xl mb-1">🌍</div>
                                    <p class="text-white/80 text-xs">Global Explorer</p>
                                    <span class="text-white/30 text-[10px]">🔒</span>
                                </div>
                            </div>
                        </div>

                        <!-- Live Leaderboard -->
                        <div class="quest-card rounded-2xl p-5 animate-slide-up" style="animation-delay: 0.5s">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="text-2xl">📊</span>
                                <h3 class="text-white font-bold">Event Leaderboard</h3>
                                <span class="ml-auto text-orange-400 text-xs animate-pulse">LIVE</span>
                            </div>
                            <div class="space-y-2">
                                <div class="flex items-center gap-3 p-2 rounded-lg bg-gradient-to-r from-yellow-500/20 to-transparent">
                                    <span class="text-yellow-400 font-bold w-6">1</span>
                                    <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center text-sm">👑</div>
                                    <div class="flex-1">
                                        <p class="text-white text-sm font-semibold">Sarah Parker</p>
                                        <p class="text-white/40 text-xs">1,284 pts</p>
                                    </div>
                                    <span class="text-yellow-400 text-xs">🏆</span>
                                </div>
                                <div class="flex items-center gap-3 p-2 rounded-lg bg-white/5">
                                    <span class="text-gray-400 font-bold w-6">2</span>
                                    <div class="w-8 h-8 bg-gray-500 rounded-full flex items-center justify-center text-sm">👤</div>
                                    <div class="flex-1">
                                        <p class="text-white text-sm">Mike Chen</p>
                                        <p class="text-white/40 text-xs">892 pts</p>
                                    </div>
                                    <span class="text-gray-400 text-xs">⬆️</span>
                                </div>
                                <div class="flex items-center gap-3 p-2 rounded-lg bg-white/5">
                                    <span class="text-gray-400 font-bold w-6">3</span>
                                    <div class="w-8 h-8 bg-gray-500 rounded-full flex items-center justify-center text-sm">👤</div>
                                    <div class="flex-1">
                                        <p class="text-white text-sm">Emma Watson</p>
                                        <p class="text-white/40 text-xs">756 pts</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 p-2 rounded-lg bg-purple-500/20 border border-purple-500/30">
                                    <span class="text-purple-400 font-bold w-6">7</span>
                                    <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center text-sm">{{ substr(Auth::user()->name, 0, 1) }}</div>
                                    <div class="flex-1">
                                        <p class="text-white text-sm font-semibold">{{ Auth::user()->name }}</p>
                                        <p class="text-purple-300 text-xs">421 pts</p>
                                    </div>
                                    <span class="text-purple-400 text-xs">🎯 +12</span>
                                </div>
                            </div>
                            <div class="mt-3 text-center">
                                <p class="text-white/40 text-xs">⬆️ 15 points to reach #6</p>
                            </div>
                        </div>
                    </div>

                    <!-- Upcoming Events Preview (Gamified) -->
                    <div class="quest-card rounded-2xl p-5 mt-6 animate-slide-up" style="animation-delay: 0.6s">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-2">
                                <span class="text-2xl">📅</span>
                                <h3 class="text-white font-bold">Your Upcoming Events</h3>
                            </div>
                            <a href="#" class="text-purple-300 text-sm hover:text-white transition">View all →</a>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5 hover:bg-white/10 transition group">
                                <img src="https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?w=50&h=50&fit=crop" class="w-12 h-12 rounded-lg object-cover">
                                <div>
                                    <p class="text-white font-semibold text-sm">Summer Beats Fest</p>
                                    <p class="text-white/40 text-xs">Aug 15 • 7:00 PM</p>
                                    <p class="text-green-400 text-xs">🎫 2 tickets</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5 hover:bg-white/10 transition group">
                                <img src="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=50&h=50&fit=crop" class="w-12 h-12 rounded-lg object-cover">
                                <div>
                                    <p class="text-white font-semibold text-sm">Neon Nights</p>
                                    <p class="text-white/40 text-xs">Aug 22 • 9:00 PM</p>
                                    <p class="text-green-400 text-xs">🎫 1 ticket</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5 hover:bg-white/10 transition group">
                                <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=50&h=50&fit=crop" class="w-12 h-12 rounded-lg object-cover">
                                <div>
                                    <p class="text-white font-semibold text-sm">EDM Universe</p>
                                    <p class="text-white/40 text-xs">Sep 5 • 8:00 PM</p>
                                    <p class="text-green-400 text-xs">🎫 3 tickets</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Motivation / Encouragement Message -->
                    <div class="mt-6 text-center">
                        <p class="text-purple-300 text-sm flex items-center justify-center gap-2">
                            <span>💪</span> You're on a 15-day streak! <span class="text-orange-400">5 more days to unlock "Dedicated Fan" badge</span> <span>🎯</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Gamified Interactions -->
    <script>
        // Confetti effect function
        function createConfetti() {
            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.top = '-10px';
                confetti.style.width = Math.random() * 8 + 4 + 'px';
                confetti.style.height = confetti.style.width;
                confetti.style.animationDuration = Math.random() * 2 + 2 + 's';
                confetti.style.animationDelay = Math.random() * 0.5 + 's';
                document.body.appendChild(confetti);
                setTimeout(() => confetti.remove(), 4000);
            }
        }
        
        // Show achievement notification
        function showAchievement(achievementName) {
            createConfetti();
            
            // Create floating XP notification
            const notification = document.createElement('div');
            notification.className = 'fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-gradient-to-r from-purple-900 to-pink-900 text-white px-6 py-4 rounded-2xl shadow-2xl z-50 border border-purple-500 animate-slide-up';
            notification.innerHTML = `
                <div class="text-center">
                    <div class="text-4xl mb-2">🏆</div>
                    <p class="text-lg font-bold">Achievement Unlocked!</p>
                    <p class="text-purple-200">${achievementName}</p>
                    <p class="text-yellow-400 text-sm mt-2">+50 XP</p>
                </div>
            `;
            document.body.appendChild(notification);
            
            // Add XP effect to XP bar
            const xpBar = document.querySelector('.level-progress');
            if (xpBar) {
                xpBar.style.width = Math.min(100, parseInt(xpBar.style.width) + 5) + '%';
            }
            
            setTimeout(() => notification.remove(), 3000);
        }
        
        // Add XP function
        function addXP(amount) {
            const xpNotification = document.createElement('div');
            xpNotification.className = 'xp-gain fixed bottom-20 right-5 bg-gradient-to-r from-purple-600 to-pink-600 px-4 py-2 rounded-full shadow-lg z-50';
            xpNotification.innerHTML = `✨ +${amount} XP ✨`;
            document.body.appendChild(xpNotification);
            
            // Update XP bar
            const xpBar = document.querySelector('.level-progress');
            if (xpBar) {
                let currentWidth = parseInt(xpBar.style.width);
                let newWidth = Math.min(100, currentWidth + (amount / 5));
                xpBar.style.width = newWidth + '%';
            }
            
            setTimeout(() => xpNotification.remove(), 2000);
        }
        
        // Update quest completion
        function updateQuest(checkbox) {
            if (checkbox.checked) {
                addXP(10);
                createConfetti();
                
                // Show quest completion
                const questDiv = checkbox.closest('.flex');
                if (questDiv) {
                    questDiv.style.background = 'rgba(34,197,94,0.1)';
                    setTimeout(() => {
                        questDiv.style.background = '';
                    }, 1000);
                }
            }
        }
        
        // Streak counter animation on load
        document.addEventListener('DOMContentLoaded', () => {
            console.log('🎮 Gamified Dashboard Loaded!');
            
            // Animate stats cards on load
            const stats = document.querySelectorAll('.stat-card');
            stats.forEach((stat, index) => {
                setTimeout(() => {
                    stat.style.opacity = '1';
                    stat.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</x-app-layout>