@extends('layouts.app')

@section('content')

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
    
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .hero-float {
        animation: float 4s ease-in-out infinite;
    }
    
    .event-card {
        animation: slideIn 0.5s ease-out forwards;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .event-card:hover {
        transform: translateY(-8px) scale(1.02);
    }
    
    .shimmer-text {
        background: linear-gradient(90deg, #a855f7, #eab308, #a855f7);
        background-size: 200% auto;
        animation: shimmer 3s linear infinite;
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    
    .glass-card {
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
    }
</style>

<!-- Enhanced Hero Section -->
<div class="relative overflow-hidden rounded-3xl mb-12">
    
    <!-- Animated Background -->
    <div class="absolute inset-0 bg-gradient-to-r from-purple-700 via-purple-600 to-yellow-500"></div>
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-0 left-0 w-96 h-96 bg-white/10 rounded-full filter blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-yellow-400/20 rounded-full filter blur-3xl animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-purple-400/20 rounded-full filter blur-3xl animate-pulse delay-2000"></div>
    </div>
    
    <!-- Hero Content -->
    <div class="relative p-12 md:p-16 text-white">
        <div class="max-w-3xl">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full mb-6">
                <span class="relative flex w-2 h-2">
                    <span class="absolute inline-flex w-full h-full bg-green-400 rounded-full opacity-75 animate-ping"></span>
                    <span class="relative inline-flex w-2 h-2 bg-green-500 rounded-full"></span>
                </span>
                <span class="text-sm font-medium">Live Events • 500+ Events This Month</span>
            </div>
            
            <h1 class="text-4xl md:text-6xl font-bold mb-4 leading-tight">
                Discover 
                <span class="shimmer-text">Amazing Events</span>
            </h1>
            
            <p class="text-lg md:text-xl mb-8 text-yellow-100">
                Concerts, Tech Events, Workshops and More — Find your next unforgettable experience
            </p>
            
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('user.dashboard') }}"
                   class="bg-white text-purple-600 px-8 py-3 rounded-xl font-semibold hover:bg-yellow-400 hover:text-purple-900 transition-all duration-300 shadow-lg hover:scale-105 transform inline-flex items-center gap-2 group">
                    Explore Events
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                
                <a href="#featured"
                   class="bg-white/20 backdrop-blur-sm px-8 py-3 rounded-xl font-semibold hover:bg-white/30 transition-all duration-300 inline-flex items-center gap-2">
                    <span>🎉</span> View Trending
                </a>
            </div>
            
            <!-- Stats -->
            <div class="grid grid-cols-3 gap-8 mt-12 pt-8 border-t border-white/20">
                <div>
                    <div class="text-2xl font-bold">500+</div>
                    <div class="text-sm text-yellow-200">Live Events</div>
                </div>
                <div>
                    <div class="text-2xl font-bold">10K+</div>
                    <div class="text-sm text-yellow-200">Happy Attendees</div>
                </div>
                <div>
                    <div class="text-2xl font-bold">50+</div>
                    <div class="text-sm text-yellow-200">Cities</div>
                </div>
            </div>
        </div>
        
        <!-- Floating Decorative Elements -->
        <div class="absolute right-10 top-10 hero-float hidden lg:block">
            <div class="w-24 h-24 bg-yellow-400/20 rounded-2xl backdrop-blur-sm border border-white/30 flex items-center justify-center">
                <span class="text-4xl">🎵</span>
            </div>
        </div>
        <div class="absolute right-32 bottom-20 hero-float hidden lg:block" style="animation-delay: 2s;">
            <div class="w-16 h-16 bg-purple-400/20 rounded-xl backdrop-blur-sm border border-white/30 flex items-center justify-center">
                <span class="text-2xl">🎤</span>
            </div>
        </div>
    </div>
</div>

<!-- Filter/Search Bar -->
<div class="mb-12">
    <div class="glass-card rounded-2xl p-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <input type="text" 
                   placeholder="🔍 Search events..." 
                   id="searchInput"
                   class="bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/40 focus:outline-none focus:border-yellow-400 transition">
            
            <select id="categoryFilter"
                    class="bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-yellow-400 transition">
                <option value="all" class="bg-gray-900">All Categories</option>
                <option value="concert" class="bg-gray-900">🎵 Concerts</option>
                <option value="tech" class="bg-gray-900">💻 Tech Events</option>
                <option value="workshop" class="bg-gray-900">📚 Workshops</option>
                <option value="festival" class="bg-gray-900">🎉 Festivals</option>
            </select>
            
            <select id="priceFilter"
                    class="bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-yellow-400 transition">
                <option value="all" class="bg-gray-900">All Prices</option>
                <option value="free" class="bg-gray-900">Free Events</option>
                <option value="paid" class="bg-gray-900">Paid Events</option>
            </select>
            
            <button onclick="filterEvents()"
                    class="bg-gradient-to-r from-purple-600 to-yellow-500 text-white px-6 py-3 rounded-xl font-semibold hover:scale-105 transition-all duration-300">
                Apply Filters →
            </button>
        </div>
    </div>
</div>

<!-- Featured Events Section -->
<div class="mt-16" id="featured">
    
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl md:text-4xl font-bold text-white">
                🔥 Featured Events
            </h2>
            <p class="text-yellow-200 mt-2">Handpicked just for you</p>
        </div>
        <a href="{{ route('user.dashboard') }}" 
           class="text-yellow-400 hover:text-white transition inline-flex items-center gap-1 group">
            View All
            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" id="eventsGrid">
        
        @forelse($events as $index => $event)
        <!-- Event Card -->
        <div class="event-card bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-sm rounded-2xl overflow-hidden border border-white/10 hover:border-yellow-400/50 transition-all duration-300 group"
             style="animation-delay: {{ $index * 0.1 }}s"
             data-category="{{ $event->category ?? 'concert' }}"
             data-price="{{ $event->price > 0 ? 'paid' : 'free' }}"
             data-title="{{ strtolower($event->title) }}">
            
            <!-- Image Container with Overlay -->
            <div class="relative overflow-hidden">
                @if($event->image)
                    <img src="/events/{{$event->image}}"
                         class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110">
                @else
                    <img src="https://picsum.photos/400/300?random={{ $index }}"
                         class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110">
                @endif
                
                <!-- Price Badge -->
                <div class="absolute top-4 right-4 bg-gradient-to-r from-purple-600 to-yellow-500 rounded-full px-3 py-1 text-white text-sm font-bold shadow-lg">
                    @if($event->price == 0)
                        FREE
                    @else
                        ₹{{ number_format($event->price) }}
                    @endif
                </div>
                
                <!-- Category Badge -->
                <div class="absolute bottom-4 left-4 bg-black/50 backdrop-blur-sm rounded-full px-3 py-1 text-white text-xs">
                    🎵 {{ ucfirst($event->category ?? 'Concert') }}
                </div>
            </div>
            
            <!-- Content -->
            <div class="p-6">
                <h3 class="text-xl font-bold text-white mb-2 line-clamp-1">
                    {{$event->title}}
                </h3>
                
                <div class="space-y-2 mb-4">
                    <p class="text-yellow-300 text-sm flex items-center gap-2">
                        <span>📍</span> {{$event->venue}}
                    </p>
                    <p class="text-gray-400 text-sm flex items-center gap-2">
                        <span>📅</span> {{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}
                    </p>
                    <p class="text-gray-400 text-sm flex items-center gap-2">
                        <span>⏰</span> {{ \Carbon\Carbon::parse($event->time ?? '19:00')->format('g:i A') }}
                    </p>
                </div>
                
                <div class="flex justify-between items-center mt-4 pt-4 border-t border-white/10">
                    <div class="flex items-center gap-1">
                        <div class="flex -space-x-2">
                            <div class="w-6 h-6 rounded-full bg-purple-500 border border-white flex items-center justify-center text-[10px]">👤</div>
                            <div class="w-6 h-6 rounded-full bg-yellow-500 border border-white flex items-center justify-center text-[10px]">👤</div>
                            <div class="w-6 h-6 rounded-full bg-pink-500 border border-white flex items-center justify-center text-[10px]">+</div>
                        </div>
                        <span class="text-white/60 text-xs">1.2k attending</span>
                    </div>
                    
                    <a href="/events/{{$event->id}}"
                       class="bg-gradient-to-r from-purple-600 to-yellow-500 text-white px-5 py-2 rounded-xl font-semibold text-sm hover:scale-105 transition-all duration-300 inline-flex items-center gap-1 group">
                        Book Now
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        
        @empty
        <!-- No Events Message -->
        <div class="col-span-full text-center py-16">
            <div class="text-6xl mb-4">🎫</div>
            <h3 class="text-2xl font-bold text-white mb-2">No Events Found</h3>
            <p class="text-gray-400">Check back soon for amazing events!</p>
        </div>
        @endforelse
        
    </div>
</div>

<!-- Newsletter Section -->
<div class="mt-20 mb-12">
    <div class="glass-card rounded-2xl p-8 md:p-12 text-center">
        <div class="max-w-2xl mx-auto">
            <div class="text-4xl mb-4">📧</div>
            <h3 class="text-2xl font-bold text-white mb-2">Never Miss an Event</h3>
            <p class="text-yellow-200 mb-6">Get the best events delivered straight to your inbox</p>
            
            <form class="flex flex-col md:flex-row gap-4">
                <input type="email" 
                       placeholder="Enter your email" 
                       class="flex-1 bg-white/10 border border-white/20 rounded-xl px-6 py-3 text-white placeholder-white/40 focus:outline-none focus:border-yellow-400 transition">
                <button type="submit"
                        class="bg-gradient-to-r from-purple-600 to-yellow-500 text-white px-8 py-3 rounded-xl font-semibold hover:scale-105 transition-all duration-300">
                    Subscribe Now →
                </button>
            </form>
            <p class="text-white/40 text-xs mt-4">No spam, unsubscribe anytime.</p>
        </div>
    </div>
</div>

<script>
    function filterEvents() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const category = document.getElementById('categoryFilter').value;
        const price = document.getElementById('priceFilter').value;
        
        const cards = document.querySelectorAll('#eventsGrid .event-card');
        
        cards.forEach(card => {
            let show = true;
            
            // Search filter
            if (searchTerm) {
                const title = card.getAttribute('data-title') || '';
                if (!title.includes(searchTerm)) {
                    show = false;
                }
            }
            
            // Category filter
            if (show && category !== 'all') {
                const cardCategory = card.getAttribute('data-category');
                if (cardCategory !== category) {
                    show = false;
                }
            }
            
            // Price filter
            if (show && price !== 'all') {
                const cardPrice = card.getAttribute('data-price');
                if (cardPrice !== price) {
                    show = false;
                }
            }
            
            card.style.display = show ? 'block' : 'none';
        });
    }
    
    // Real-time search
    document.getElementById('searchInput').addEventListener('keyup', filterEvents);
    document.getElementById('categoryFilter').addEventListener('change', filterEvents);
    document.getElementById('priceFilter').addEventListener('change', filterEvents);
</script>

@endsection