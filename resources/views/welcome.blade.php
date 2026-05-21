<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'EventHub') }} - Discover Amazing Events</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800|display=swap" rel="stylesheet" />
        
        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        
        <style>
            /* Custom Animations */
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-20px) rotate(3deg); }
            }
            
            @keyframes float-slow {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-15px); }
            }
            
            @keyframes shimmer {
                0% { background-position: -200% 0; }
                100% { background-position: 200% 0; }
            }
            
            @keyframes glow-pulse {
                0%, 100% { box-shadow: 0 0 5px rgba(168,85,247,0.3); }
                50% { box-shadow: 0 0 30px rgba(168,85,247,0.6); }
            }
            
            @keyframes slide-up {
                from { opacity: 0; transform: translateY(30px); }
                to { opacity: 1; transform: translateY(0); }
            }
            
            @keyframes scale-in {
                from { opacity: 0; transform: scale(0.9); }
                to { opacity: 1; transform: scale(1); }
            }
            
            @keyframes marquee {
                0% { transform: translateX(0); }
                100% { transform: translateX(-50%); }
            }
            
            .animate-float { animation: float 4s ease-in-out infinite; }
            .animate-float-slow { animation: float-slow 5s ease-in-out infinite; }
            .animate-slide-up { animation: slide-up 0.6s ease-out forwards; }
            .animate-scale-in { animation: scale-in 0.5s ease-out forwards; }
            .animate-marquee { animation: marquee 25s linear infinite; }
            
            .shimmer-text {
                background: linear-gradient(90deg, #a855f7, #ec4899, #f59e0b, #a855f7);
                background-size: 300% auto;
                animation: shimmer 3s linear infinite;
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
            }
            
            .glow-card {
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            .glow-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 25px 40px -12px rgba(168,85,247,0.3);
            }
            
            .glass-card {
                background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255,255,255,0.15);
            }
            
            .hero-gradient {
                background: radial-gradient(ellipse at top, rgba(168,85,247,0.3), transparent 50%),
                            radial-gradient(ellipse at bottom, rgba(236,72,153,0.2), transparent 50%);
            }
            
            .stats-card {
                background: rgba(255,255,255,0.03);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255,255,255,0.1);
                transition: all 0.3s ease;
            }
            
            .stats-card:hover {
                background: rgba(168,85,247,0.15);
                border-color: rgba(168,85,247,0.4);
                transform: translateY(-5px);
            }
            
            /* Custom cursor */
            .custom-cursor {
                cursor: none;
            }
            
            /* Smooth scroll */
            html {
                scroll-behavior: smooth;
            }
        </style>
    </head>
    
    <body class="bg-black text-white overflow-x-hidden">
        
        <!-- ==================== NAVIGATION ==================== -->
        <nav class="fixed top-0 left-0 right-0 z-50 backdrop-blur-xl bg-black/40 border-b border-white/10">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <div class="flex items-center justify-between">
                    <!-- Logo -->
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">EventHub</span>
                    </div>
                    
                    <div class="hidden md:flex items-center gap-8">
                        <a href="#" class="text-gray-300 hover:text-white transition">Home</a>
                        <a href="{{ route('user.dashboard') }}" class="text-gray-300 hover:text-white transition">Events</a>
                        <a href="#features" class="text-gray-300 hover:text-white transition">Features</a>
                    </div>
                    
                    <!-- Auth Buttons -->
                    <div class="flex items-center gap-3">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-5 py-2 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold hover:opacity-90 transition">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="px-5 py-2 text-white/80 hover:text-white transition">Log in</a>
                                <a href="{{ route('register') }}" class="px-5 py-2 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold hover:opacity-90 transition">
                                    Sign Up
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- ==================== HERO SECTION ==================== -->
        <section class="relative min-h-screen overflow-hidden">
            <!-- Animated Background -->
            <div class="absolute inset-0 hero-gradient">
                <div class="absolute top-20 left-10 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
                <div class="absolute bottom-20 right-10 w-96 h-96 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse delay-1000"></div>
                <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-orange-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-2000"></div>
            </div>
            
            <!-- Hero Content -->
            <div class="relative max-w-7xl mx-auto px-6 pt-32 pb-20">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    
                    <!-- Left Column -->
                    <div class="animate-slide-up">
                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-purple-500/10 border border-purple-500/30 mb-6">
                            <span class="relative flex w-2 h-2">
                                <span class="absolute inline-flex w-full h-full bg-green-400 rounded-full opacity-75 animate-ping"></span>
                                <span class="relative inline-flex w-2 h-2 bg-green-500 rounded-full"></span>
                            </span>
                            <span class="text-sm text-purple-300">✨ 500+ Live Events This Week</span>
                        </div>
                        
                        <h1 class="text-5xl md:text-7xl font-black leading-tight mb-6">
                            <span class="text-white">Discover</span>
                            <span class="shimmer-text block mt-2">Amazing Events</span>
                            <span class="text-white">Near You</span>
                        </h1>
                        
                        <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                            Experience the future of event booking. From concerts to conferences,
                            find and book unforgettable experiences in seconds.
                        </p>
                        
                        <!-- Search Bar -->
                        <div class="relative mb-8 group">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" 
                                   placeholder="Search events, artists, venues..." 
                                   class="w-full pl-12 pr-32 py-4 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 text-white placeholder-white/50 focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition">
                            <button class="absolute right-2 top-2 px-6 py-2 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold hover:scale-105 transition">
                                Search
                            </button>
                        </div>
                        
                        <!-- CTA Buttons -->
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('user.dashboard') }}" class="px-8 py-4 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold hover:scale-105 transition shadow-lg hover:shadow-purple-500/25">
                                Explore Events →
                            </a>
                            <a href="#features" class="px-8 py-4 rounded-xl border border-white/20 text-white font-semibold hover:bg-white/10 transition">
                                Learn More
                            </a>
                        </div>
                        
                        <!-- Stats -->
                        <div class="grid grid-cols-3 gap-4 mt-12 pt-8 border-t border-white/10">
                            <div class="stats-card rounded-xl p-4 text-center">
                                <div class="text-2xl font-bold text-white">500+</div>
                                <div class="text-xs text-purple-300">Live Events</div>
                            </div>
                            <div class="stats-card rounded-xl p-4 text-center">
                                <div class="text-2xl font-bold text-white">50K+</div>
                                <div class="text-xs text-purple-300">Happy Users</div>
                            </div>
                            <div class="stats-card rounded-xl p-4 text-center">
                                <div class="text-2xl font-bold text-white">50+</div>
                                <div class="text-xs text-purple-300">Cities</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column - Hero Visual -->
                    <div class="relative hidden lg:block">
                        <div class="relative h-[500px]">
                            <!-- Card 1 - Back -->
                            <div class="absolute top-0 right-10 w-72 bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-xl rounded-2xl overflow-hidden border border-white/20 rotate-12 opacity-60 hover:rotate-6 transition-all duration-500">
                                <img src="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=400&h=250&fit=crop" class="w-full h-40 object-cover">
                                <div class="p-4">
                                    <p class="text-white font-semibold">Neon Nights Festival</p>
                                    <p class="text-pink-300 text-sm">🔥 15k+ interested</p>
                                </div>
                            </div>
                            
                            <!-- Card 2 - Middle -->
                            <div class="absolute top-10 left-0 w-80 bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-xl rounded-2xl overflow-hidden border border-white/20 rotate-6 hover:rotate-3 transition-all duration-500">
                                <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=400&h=250&fit=crop" class="w-full h-40 object-cover">
                                <div class="p-4">
                                    <p class="text-white font-semibold">EDM Universe 2024</p>
                                    <p class="text-orange-300 text-sm">⭐ 4.9 • 8k+ attendees</p>
                                </div>
                            </div>
                            
                            <!-- Card 3 - Front Featured -->
                            <div class="absolute top-20 left-10 right-10 w-96 mx-auto bg-gradient-to-br from-white/20 to-white/10 backdrop-blur-xl rounded-2xl overflow-hidden border-2 border-purple-500/50 shadow-2xl glow-card">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?w=450&h=280&fit=crop" class="w-full h-52 object-cover">
                                    <div class="absolute top-4 right-4 px-3 py-1 rounded-full bg-gradient-to-r from-purple-600 to-pink-600 text-white text-xs font-bold">
                                        LIVE
                                    </div>
                                </div>
                                <div class="p-5">
                                    <h3 class="text-xl font-bold text-white mb-1">Summer Beats Festival</h3>
                                    <p class="text-yellow-300 text-sm mb-2">📍 Mumbai • 25 Aug 2024</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-2xl font-bold text-orange-400">₹1,299</span>
                                        <button class="px-4 py-2 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 text-white text-sm hover:scale-105 transition">
                                            Book Now →
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Floating Elements -->
                            <div class="absolute -bottom-10 right-20 text-5xl animate-float">🎵</div>
                            <div class="absolute top-1/2 -right-5 text-4xl animate-float-slow">🎧</div>
                            <div class="absolute bottom-20 left-0 text-3xl animate-float" style="animation-delay: 2s;">🎤</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Scroll Indicator -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce cursor-pointer" onclick="document.getElementById('features').scrollIntoView({behavior: 'smooth'})">
                <div class="w-6 h-10 border-2 border-white/30 rounded-full flex justify-center">
                    <div class="w-1 h-3 mt-2 bg-purple-400 rounded-full animate-pulse"></div>
                </div>
            </div>
        </section>
        
        <!-- ==================== FEATURES SECTION ==================== -->
        <section id="features" class="py-24 bg-gradient-to-b from-black to-purple-950/20">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-purple-500/10 border border-purple-500/30 mb-4">
                        <span class="text-purple-400">✦</span>
                        <span class="text-sm text-purple-300">Why Choose Us</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold mb-4">
                        Built for 
                        <span class="shimmer-text">Seamless Experiences</span>
                    </h2>
                    <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                        Everything you need to discover, book, and manage events in one place
                    </p>
                </div>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="glass-card rounded-2xl p-8 text-center glow-card">
                        <div class="w-16 h-16 mx-auto mb-6 rounded-xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-3xl">
                            🎟️
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Instant Booking</h3>
                        <p class="text-gray-400">Secure payments, digital QR tickets, and real-time confirmations delivered instantly to your inbox.</p>
                    </div>
                    
                    <!-- Feature 2 -->
                    <div class="glass-card rounded-2xl p-8 text-center glow-card">
                        <div class="w-16 h-16 mx-auto mb-6 rounded-xl bg-gradient-to-br from-pink-500 to-orange-500 flex items-center justify-center text-3xl">
                            📍
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Nearby Discovery</h3>
                        <p class="text-gray-400">Find events happening in your city with smart recommendations based on your interests.</p>
                    </div>
                    
                    <!-- Feature 3 -->
                    <div class="glass-card rounded-2xl p-8 text-center glow-card">
                        <div class="w-16 h-16 mx-auto mb-6 rounded-xl bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-3xl">
                            🚀
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Become Organizer</h3>
                        <p class="text-gray-400">Create and manage your own events, track attendees, and grow your audience.</p>
                        <a href="{{ route('user.become.organizer.page') }}" class="inline-block mt-4 px-6 py-3 text-sm font-semibold text-white bg-indigo-600 rounded-full hover:bg-indigo-500">
                            Request Organizer Access
                        </a>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- ==================== MARQUEE BANNER ==================== -->
        <div class="overflow-hidden py-4 bg-gradient-to-r from-purple-600/20 via-pink-600/20 to-orange-600/20 border-y border-white/10">
            <div class="flex animate-marquee whitespace-nowrap">
                <span class="mx-8 text-purple-300">🎉 Summer Music Festival</span>
                <span class="mx-8 text-pink-300">🔥 EDM Night</span>
                <span class="mx-8 text-orange-300">🎸 Rock Concert</span>
                <span class="mx-8 text-purple-300">💻 Tech Conference 2024</span>
                <span class="mx-8 text-pink-300">🎨 Art Exhibition</span>
                <span class="mx-8 text-orange-300">🍷 Wine Tasting</span>
                <span class="mx-8 text-purple-300">🎭 Theatre Show</span>
                <span class="mx-8 text-pink-300">🏃 Marathon 2024</span>
                <!-- Duplicate for seamless loop -->
                <span class="mx-8 text-purple-300">🎉 Summer Music Festival</span>
                <span class="mx-8 text-pink-300">🔥 EDM Night</span>
                <span class="mx-8 text-orange-300">🎸 Rock Concert</span>
                <span class="mx-8 text-purple-300">💻 Tech Conference 2024</span>
                <span class="mx-8 text-pink-300">🎨 Art Exhibition</span>
                <span class="mx-8 text-orange-300">🍷 Wine Tasting</span>
                <span class="mx-8 text-purple-300">🎭 Theatre Show</span>
                <span class="mx-8 text-pink-300">🏃 Marathon 2024</span>
            </div>
        </div>
        
        <!-- ==================== FEATURED EVENTS ==================== -->
        <section id="events" class="py-24 bg-black">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex justify-between items-center mb-12">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-white">🔥 Featured Events</h2>
                        <p class="text-gray-400 mt-2">Handpicked just for you</p>
                    </div>
                    <a href="{{ url('/dashboard') }}" class="text-purple-400 hover:text-white transition flex items-center gap-1">
                        View All
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Event 1 -->
                    <div class="glass-card rounded-2xl overflow-hidden glow-card">
                        <img src="https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?w=400&h=250&fit=crop" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-xl font-bold text-white">Summer Beats Fest</h3>
                                <span class="px-2 py-1 rounded-full bg-purple-500/20 text-purple-300 text-xs">🎵 Concert</span>
                            </div>
                            <p class="text-gray-400 text-sm mb-2">📍 Mumbai, India</p>
                            <p class="text-gray-400 text-sm mb-4">📅 August 25, 2024</p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-orange-400">₹1,299</span>
                                <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 text-white text-sm hover:scale-105 transition inline-block">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Event 2 -->
                    <div class="glass-card rounded-2xl overflow-hidden glow-card">
                        <img src="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=400&h=250&fit=crop" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-xl font-bold text-white">Neon Nights</h3>
                                <span class="px-2 py-1 rounded-full bg-pink-500/20 text-pink-300 text-xs">🎧 EDM</span>
                            </div>
                            <p class="text-gray-400 text-sm mb-2">📍 Los Angeles, CA</p>
                            <p class="text-gray-400 text-sm mb-4">📅 August 22, 2024</p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-orange-400">$45</span>
                                <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 text-white text-sm hover:scale-105 transition inline-block">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Event 3 -->
                    <div class="glass-card rounded-2xl overflow-hidden glow-card">
                        <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=400&h=250&fit=crop" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-xl font-bold text-white">Tech Conference 2024</h3>
                                <span class="px-2 py-1 rounded-full bg-orange-500/20 text-orange-300 text-xs">💻 Tech</span>
                            </div>
                            <p class="text-gray-400 text-sm mb-2">📍 New York, NY</p>
                            <p class="text-gray-400 text-sm mb-4">📅 September 5, 2024</p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-orange-400">$199</span>
                                <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 text-white text-sm hover:scale-105 transition inline-block">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- ==================== HOW IT WORKS ==================== -->
        <section class="py-24 bg-gradient-to-b from-black to-purple-950/20">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4">
                        How <span class="shimmer-text">EventHub Works</span>
                    </h2>
                    <p class="text-xl text-gray-400">Book your next experience in four simple steps</p>
                </div>
                
                <div class="grid md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-3xl shadow-lg">
                            1️⃣
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">Discover Events</h3>
                        <p class="text-gray-400 text-sm">Browse hundreds of events in your city</p>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-pink-500 to-orange-500 flex items-center justify-center text-3xl shadow-lg">
                            2️⃣
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">Choose Ticket</h3>
                        <p class="text-gray-400 text-sm">Select your preferred ticket type</p>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-3xl shadow-lg">
                            3️⃣
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">Secure Payment</h3>
                        <p class="text-gray-400 text-sm">Pay safely with your preferred method</p>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-red-500 to-purple-500 flex items-center justify-center text-3xl shadow-lg">
                            4️⃣
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">Enjoy Event</h3>
                        <p class="text-gray-400 text-sm">Receive QR ticket and have fun!</p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- ==================== NEWSLETTER SECTION ==================== -->
        <section class="py-24">
            <div class="max-w-4xl mx-auto px-6">
                <div class="glass-card rounded-3xl p-12 text-center">
                    <div class="text-6xl mb-4 animate-float">📧</div>
                    <h3 class="text-3xl font-bold text-white mb-2">Never Miss an Event</h3>
                    <p class="text-gray-400 mb-8">Get the best events delivered straight to your inbox</p>
                    <div class="flex flex-col md:flex-row gap-4 max-w-lg mx-auto">
                        <input type="email" placeholder="Enter your email" class="flex-1 px-5 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/50 focus:outline-none focus:border-purple-500">
                        <button class="px-6 py-3 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold hover:scale-105 transition">
                            Subscribe →
                        </button>
                    </div>
                    <p class="text-gray-500 text-xs mt-4">No spam, unsubscribe anytime.</p>
                </div>
            </div>
        </section>
        
        <!-- ==================== FOOTER ==================== -->
        <footer class="border-t border-white/10 py-12">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid md:grid-cols-4 gap-8">
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-white">EventHub</span>
                        </div>
                        <p class="text-gray-400 text-sm">Discover amazing events and create unforgettable memories.</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-white mb-4">Quick Links</h4>
                        <ul class="space-y-2 text-gray-400 text-sm">
                            <li><a href="#" class="hover:text-white transition">About Us</a></li>
                            <li><a href="#" class="hover:text-white transition">Contact</a></li>
                            <li><a href="#" class="hover:text-white transition">Blog</a></li>
                            <li><a href="#" class="hover:text-white transition">Careers</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold text-white mb-4">Support</h4>
                        <ul class="space-y-2 text-gray-400 text-sm">
                            <li><a href="#" class="hover:text-white transition">Help Center</a></li>
                            <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                            <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                            <li><a href="#" class="hover:text-white transition">Refund Policy</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold text-white mb-4">Follow Us</h4>
                        <div class="flex gap-4">
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-purple-600 transition">📘</a>
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-purple-600 transition">🐦</a>
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-purple-600 transition">📷</a>
                            <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-purple-600 transition">🎵</a>
                        </div>
                    </div>
                </div>
                <div class="text-center text-gray-500 text-sm pt-8 mt-8 border-t border-white/10">
                    © 2024 EventHub. All rights reserved.
                </div>
            </div>
        </footer>
        
        <style>
            /* Smooth scroll behavior */
            html {
                scroll-behavior: smooth;
            }
            
            /* Custom selection */
            ::selection {
                background: rgba(168,85,247,0.3);
                color: white;
            }
        </style>
    </body>
</html>