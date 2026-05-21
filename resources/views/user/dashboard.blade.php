@extends('layouts.app')

@section('content')

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(3deg); }
    }
    
    @keyframes float-slow {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
    
    @keyframes slide-up {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes zoom-in {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }
    
    @keyframes gradient-border {
        0%, 100% { border-color: rgba(168,85,247,0.3); }
        50% { border-color: rgba(236,72,153,0.6); }
    }
    
    .animate-float { animation: float 4s ease-in-out infinite; }
    .animate-float-slow { animation: float-slow 5s ease-in-out infinite; }
    .animate-slide-up { animation: slide-up 0.6s ease-out forwards; }
    .animate-zoom { animation: zoom-in 0.4s ease-out forwards; }
    
    .hero-card {
        background: linear-gradient(135deg, rgba(168,85,247,0.2) 0%, rgba(236,72,153,0.2) 100%);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.2);
    }
    
    .event-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        transform-origin: center;
    }
    
    .event-card:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 30px 50px rgba(168,85,247,0.3);
    }
    
    .glass-input {
        background: rgba(255,255,255,0.08);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        transition: all 0.3s ease;
    }
    
    .glass-input:focus {
        background: rgba(255,255,255,0.15);
        border-color: #a855f7;
        box-shadow: 0 0 20px rgba(168,85,247,0.4);
        outline: none;
    }
    
    .category-pill {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .category-pill:hover, .category-pill.active {
        background: linear-gradient(135deg, #a855f7, #ec4899);
        color: white;
        transform: scale(1.05);
    }
    
    .shimmer-text {
        background: linear-gradient(90deg, #a855f7, #ec4899, #f59e0b, #a855f7);
        background-size: 300% auto;
        animation: shimmer 3s linear infinite;
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    
    .gradient-badge {
        background: linear-gradient(135deg, #a855f7, #ec4899);
        animation: gradient-border 2s ease-in-out infinite;
    }
    
    .hero-stats {
        background: rgba(255,255,255,0.05);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.1);
        transition: all 0.3s ease;
    }
    
    .hero-stats:hover {
        transform: translateY(-5px);
        background: rgba(255,255,255,0.1);
        border-color: rgba(168,85,247,0.5);
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: rgba(255,255,255,0.05); border-radius: 10px; }
    ::-webkit-scrollbar-thumb { background: linear-gradient(135deg, #a855f7, #ec4899); border-radius: 10px; }
</style>

<div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-pink-900">
    
    <!-- Animated Background Particles -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-orange-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-2000"></div>
        <div class="absolute top-40 left-1/3 w-1 h-1 bg-purple-400 rounded-full animate-ping"></div>
        <div class="absolute bottom-40 right-1/4 w-1.5 h-1.5 bg-pink-400 rounded-full animate-ping delay-300"></div>
        <div class="absolute top-1/3 right-1/3 w-1 h-1 bg-orange-400 rounded-full animate-ping delay-700"></div>
    </div>

    <div class="relative z-10">
        
        <!-- ==================== HERO SECTION ==================== -->
        <div class="relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    
                    <!-- Left Side - Hero Content -->
                    <div class="animate-slide-up">
                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gradient-to-r from-purple-600/30 to-pink-600/30 border border-purple-500/30 mb-6">
                            <span class="relative flex w-2 h-2">
                                <span class="absolute inline-flex w-full h-full bg-green-400 rounded-full opacity-75 animate-ping"></span>
                                <span class="relative inline-flex w-2 h-2 bg-green-500 rounded-full"></span>
                            </span>
                            <span class="text-sm text-purple-200">500+ Live Events This Week</span>
                        </div>
                        
                        <h1 class="text-5xl md:text-7xl font-black mb-6">
                            <span class="text-white">Discover</span>
                            <span class="shimmer-text block mt-2">Amazing Events</span>
                        </h1>
                        
                        <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                            From electrifying concerts to inspiring conferences — find your next unforgettable experience.
                        </p>
                        
                        <!-- Search Bar -->
                        <div class="relative mb-8">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text"
                                   id="searchInput"
                                   placeholder="Search events, artists, venues..."
                                   class="w-full pl-12 pr-4 py-4 rounded-2xl glass-input text-white placeholder-white/50 focus:outline-none text-lg">
                        </div>
                        
                        <!-- Category Pills -->
                        <div class="flex flex-wrap gap-3 mb-8">
                            <button class="category-pill px-5 py-2 rounded-full bg-white/10 text-white/80 text-sm hover:bg-purple-600 transition" data-category="all">All Events</button>
                            <button class="category-pill px-5 py-2 rounded-full bg-white/10 text-white/80 text-sm hover:bg-purple-600 transition" data-category="concert">🎵 Concerts</button>
                            <button class="category-pill px-5 py-2 rounded-full bg-white/10 text-white/80 text-sm hover:bg-purple-600 transition" data-category="tech">💻 Tech</button>
                            <button class="category-pill px-5 py-2 rounded-full bg-white/10 text-white/80 text-sm hover:bg-purple-600 transition" data-category="workshop">📚 Workshops</button>
                            <button class="category-pill px-5 py-2 rounded-full bg-white/10 text-white/80 text-sm hover:bg-purple-600 transition" data-category="festival">🎉 Festivals</button>
                        </div>
                        
                        <!-- Stats -->
                        <div class="grid grid-cols-3 gap-4">
                            <div class="hero-stats rounded-xl p-4 text-center">
                                <div class="text-2xl font-bold text-white">500+</div>
                                <div class="text-xs text-purple-300">Live Events</div>
                            </div>
                            <div class="hero-stats rounded-xl p-4 text-center">
                                <div class="text-2xl font-bold text-white">50K+</div>
                                <div class="text-xs text-purple-300">Attendees</div>
                            </div>
                            <div class="hero-stats rounded-xl p-4 text-center">
                                <div class="text-2xl font-bold text-white">50+</div>
                                <div class="text-xs text-purple-300">Cities</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Side - Hero Visual -->
                    <div class="relative hidden lg:block animate-zoom">
                        <div class="relative h-[500px]">
                            <!-- Floating Cards Stack -->
                            <div class="absolute top-0 right-0 w-80 bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-xl rounded-2xl overflow-hidden border border-white/20 rotate-12 opacity-60 hover:rotate-6 transition-all duration-500">
                                <img src="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=400&h=250&fit=crop" class="w-full h-40 object-cover">
                                <div class="p-4">
                                    <p class="text-white font-semibold">Neon Nights Festival</p>
                                    <p class="text-pink-300 text-sm">🔥 15k+ interested</p>
                                </div>
                            </div>
                            <div class="absolute top-10 left-0 w-80 bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-xl rounded-2xl overflow-hidden border border-white/20 rotate-6 hover:rotate-3 transition-all duration-500">
                                <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=400&h=250&fit=crop" class="w-full h-40 object-cover">
                                <div class="p-4">
                                    <p class="text-white font-semibold">EDM Universe 2024</p>
                                    <p class="text-orange-300 text-sm">⭐ 4.9 • 8k+ attendees</p>
                                </div>
                            </div>
                            <div class="absolute top-20 left-10 right-10 w-96 mx-auto bg-gradient-to-br from-white/20 to-white/10 backdrop-blur-xl rounded-2xl overflow-hidden border-2 border-purple-500/50 shadow-2xl">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?w=450&h=280&fit=crop" class="w-full h-48 object-cover">
                                    <div class="absolute top-4 right-4 gradient-badge rounded-full px-3 py-1 text-white text-xs font-bold">
                                        LIVE
                                    </div>
                                </div>
                                <div class="p-5">
                                    <h3 class="text-xl font-bold text-white mb-1">Summer Beats Festival</h3>
                                    <p class="text-yellow-300 text-sm mb-2">📍 Mumbai • 25 Aug 2024</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-2xl font-bold text-orange-400">₹1,299</span>
                                        <button class="px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 rounded-xl text-white text-sm hover:scale-105 transition">
                                            Book Now →
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute -bottom-10 right-20 text-4xl animate-float">🎵</div>
                            <div class="absolute top-1/2 -right-5 text-3xl animate-float-slow">🎧</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== FEATURED EVENTS SECTION ==================== -->
        @if(isset($recommendedEvents) && $recommendedEvents->count() > 0)
        <div class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-10">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-3xl">🤖</span>
                            <h2 class="text-3xl md:text-4xl font-bold text-white">Recommended For You</h2>
                        </div>
                        <p class="text-purple-200">AI-powered picks based on your taste</p>
                    </div>
                    <span class="px-4 py-2 rounded-full bg-gradient-to-r from-purple-600 to-pink-600 text-white text-sm font-semibold">
                        AI Curated
                    </span>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($recommendedEvents as $event)
                    <div class="event-card rounded-2xl overflow-hidden bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-sm border border-white/10 hover:border-purple-500/50">
                        <div class="relative overflow-hidden h-56">
                            @if($event->image)
                                <img src="/events/{{$event->image}}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            @else
                                <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=1400&auto=format&fit=crop" class="w-full h-full object-cover">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                            <div class="absolute bottom-4 left-4">
                                @if($event->event_type == 'seated')
                                    <span class="px-3 py-1 rounded-full bg-purple-600 text-white text-xs font-semibold">🎟️ Seated</span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-orange-600 text-white text-xs font-semibold">🎵 Standing</span>
                                @endif
                            </div>
                            <div class="absolute top-4 right-4">
                                <div class="w-10 h-10 rounded-full bg-black/50 backdrop-blur-sm flex items-center justify-center cursor-pointer hover:bg-purple-600 transition">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white mb-2">{{$event->title}}</h3>
                            <div class="space-y-1 mb-4">
                                <p class="text-gray-300 text-sm flex items-center gap-2">📍 {{$event->venue}}</p>
                                <p class="text-gray-300 text-sm flex items-center gap-2">📅 {{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</p>
                            </div>
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-2xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">₹{{ number_format($event->price) }}</span>
                                <div class="flex items-center gap-1">
                                    <span class="text-yellow-400">★</span>
                                    <span class="text-white text-sm">4.8</span>
                                </div>
                            </div>
                            <a href="{{ route('events.show', $event->id) }}" class="block w-full py-3 text-center text-white font-semibold rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 transition-all duration-300 hover:scale-105">
                                Book Now →
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- ==================== ALL EVENTS SECTION ==================== -->
        <div class="py-16 bg-black/30">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6 mb-10">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-white">🎉 Upcoming Events</h2>
                        <p class="text-purple-200 mt-1">Discover the best events happening near you</p>
                    </div>
                    <div class="flex gap-3">
                        <select id="sortSelect" class="px-4 py-2 rounded-xl glass-input text-white">
                            <option value="date">Sort by Date</option>
                            <option value="price_low">Price: Low to High</option>
                            <option value="price_high">Price: High to Low</option>
                        </select>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" id="eventsGrid">
                    @forelse($events as $event)
                    <div class="event-card rounded-2xl overflow-hidden bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-sm border border-white/10 hover:border-purple-500/50 transition-all duration-300" data-price="{{ $event->price }}" data-date="{{ $event->date }}">
                        <div class="relative overflow-hidden h-48">
                            @if($event->image)
                                <img src="/events/{{$event->image}}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                            @else
                                <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=1400&auto=format&fit=crop" class="w-full h-full object-cover">
                            @endif
                            <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 to-transparent">
                                @if($event->event_type == 'seated')
                                    <span class="px-2 py-1 rounded-full bg-purple-600/80 text-white text-xs">🎟️ Seated Event</span>
                                @else
                                    <span class="px-2 py-1 rounded-full bg-orange-600/80 text-white text-xs">🎵 Standing Event</span>
                                @endif
                            </div>
                        </div>
                        <div class="p-5">
                            <h3 class="text-xl font-bold text-white mb-2 line-clamp-1">{{$event->title}}</h3>
                            <div class="space-y-1 mb-3">
                                <p class="text-gray-300 text-sm">📍 {{$event->venue}}</p>
                                <p class="text-gray-300 text-sm">📅 {{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</p>
                            </div>
                            
                            @if($event->event_type == 'seated' && isset($event->remaining_seats))
                                <div class="mb-3">
                                    <div class="flex justify-between text-xs mb-1">
                                        <span class="text-orange-400">{{ $event->remaining_seats }} seats left</span>
                                        <span class="text-gray-400">{{ $event->total_seats - $event->remaining_seats }} sold</span>
                                    </div>
                                    <div class="w-full h-1.5 bg-white/10 rounded-full overflow-hidden">
                                        <div class="h-full rounded-full bg-gradient-to-r from-purple-500 to-pink-500" style="width: {{ (($event->total_seats - $event->remaining_seats) / $event->total_seats) * 100 }}%"></div>
                                    </div>
                                </div>
                            @elseif($event->event_type == 'standing' && $event->standing_limit !== null)
                                <div class="mb-3">
                                    <div class="flex justify-between text-xs mb-1">
                                        <span class="text-orange-400">{{ $event->remaining_seats }} tickets left</span>
                                        <span class="text-gray-400">{{ $event->standing_limit - $event->remaining_seats }} sold</span>
                                    </div>
                                    <div class="w-full h-1.5 bg-white/10 rounded-full overflow-hidden">
                                        <div class="h-full rounded-full bg-gradient-to-r from-orange-500 to-yellow-500" style="width: {{ (($event->standing_limit - $event->remaining_seats) / $event->standing_limit) * 100 }}%"></div>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="flex items-center justify-between mt-4 pt-3 border-t border-white/10">
                                <span class="text-2xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">₹{{ number_format($event->price) }}</span>
                                <a href="{{ route('events.show', $event->id) }}" class="px-5 py-2 text-white font-semibold rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 transition-all duration-300 hover:scale-105">
                                    Book →
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-20 bg-white/5 rounded-2xl border border-white/10">
                        <div class="text-6xl mb-4">🎪</div>
                        <h3 class="text-2xl font-bold text-white mb-2">No Events Found</h3>
                        <p class="text-gray-400">Check back later for amazing events!</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- ==================== NEWSLETTER SECTION ==================== -->
        <div class="py-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="hero-card rounded-3xl p-8 md:p-12 text-center">
                    <div class="text-5xl mb-4 animate-float">📧</div>
                    <h3 class="text-2xl md:text-3xl font-bold text-white mb-2">Never Miss an Event</h3>
                    <p class="text-purple-200 mb-6">Get the best events delivered straight to your inbox</p>
                    <div class="flex flex-col md:flex-row gap-4 max-w-lg mx-auto">
                        <input type="email" placeholder="Enter your email" class="flex-1 px-5 py-3 rounded-xl glass-input text-white placeholder-white/50 focus:outline-none">
                        <button class="px-6 py-3 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold hover:scale-105 transition-all duration-300">
                            Subscribe →
                        </button>
                    </div>
                    <p class="text-gray-400 text-xs mt-4">No spam, unsubscribe anytime.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Search Filter
    const searchInput = document.getElementById('searchInput');
    const cards = document.querySelectorAll('#eventsGrid .event-card');
    
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const value = this.value.toLowerCase();
            cards.forEach(card => {
                const text = card.innerText.toLowerCase();
                card.style.display = text.includes(value) ? 'block' : 'none';
            });
        });
    }
    
    // Category Filters
    const categoryBtns = document.querySelectorAll('.category-pill');
    categoryBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            categoryBtns.forEach(b => b.classList.remove('active', 'bg-purple-600'));
            this.classList.add('active', 'bg-purple-600');
            // Add your category filtering logic here
        });
    });
    
    // Sort Functionality
    const sortSelect = document.getElementById('sortSelect');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const cardsArray = Array.from(cards);
            const sortBy = this.value;
            
            cardsArray.sort((a, b) => {
                if (sortBy === 'price_low') {
                    return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                } else if (sortBy === 'price_high') {
                    return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                } else {
                    return new Date(a.dataset.date) - new Date(b.dataset.date);
                }
            });
            
            const grid = document.getElementById('eventsGrid');
            cardsArray.forEach(card => grid.appendChild(card));
        });
    }
</script>

@endsection