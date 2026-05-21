@extends('layouts.app')

@section('content')

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes pulse-glow {
        0%, 100% {
            box-shadow: 0 0 5px rgba(168,85,247,0.3);
        }
        50% {
            box-shadow: 0 0 20px rgba(234,179,8,0.4);
        }
    }
    
    .form-card {
        animation: fadeInUp 0.6s ease-out;
    }
    
    input:focus, textarea:focus, select:focus {
        animation: pulse-glow 1s ease-in-out infinite;
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }
    ::-webkit-scrollbar-track {
        background: rgba(255,255,255,0.05);
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb {
        background: rgba(234,179,8,0.3);
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: rgba(234,179,8,0.5);
    }
</style>

<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden"
     style="background: linear-gradient(135deg, #0B0B1A 0%, #1a0a2e 50%, #2a0a3e 100%);">
    
    <!-- Animated Background Orbs - Register Theme (Purple/Yellow) -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-20 left-10 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-yellow-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-orange-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-2000"></div>
        <div class="absolute top-40 right-1/4 w-64 h-64 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-pulse delay-1500"></div>
    </div>

    <div class="max-w-4xl mx-auto form-card relative z-10">
        
        <!-- CARD -->
        <div class="overflow-hidden backdrop-blur-xl bg-white/5 border border-white/10 rounded-3xl shadow-2xl">
            
            <!-- HEADER - Register Theme (Purple to Yellow) -->
            <div class="p-10 text-white bg-gradient-to-r from-purple-700 via-purple-600 to-yellow-500">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <h1 class="text-4xl font-black">
                        Create New Event 🎉
                    </h1>
                </div>
                <p class="mt-3 text-yellow-100 ml-16">
                    Organize premium experiences for your audience.
                </p>
            </div>

            <!-- FORM -->
            <form action="/events/store"
                  method="POST"
                  enctype="multipart/form-data"
                  class="p-10">

                @csrf

                <!-- EVENT TITLE -->
                <div class="mb-6">
                    <label class="block mb-3 text-sm font-bold text-yellow-300">
                        📝 Event Title
                    </label>
                    <input type="text"
                           name="title"
                           placeholder="Enter event title"
                           class="w-full p-4 transition border rounded-2xl focus:ring-2 focus:ring-yellow-400 bg-white/10 border-white/20 text-white placeholder-white/40 focus:border-yellow-400"
                           required>
                </div>

                <!-- DESCRIPTION -->
                <div class="mb-6">
                    <label class="block mb-3 text-sm font-bold text-yellow-300">
                        📖 Description
                    </label>
                    <textarea name="description"
                              rows="5"
                              placeholder="Describe your event..."
                              class="w-full p-4 transition border rounded-2xl focus:ring-2 focus:ring-yellow-400 bg-white/10 border-white/20 text-white placeholder-white/40 focus:border-yellow-400"
                              required></textarea>
                </div>

                <!-- GRID -->
                <div class="grid gap-6 md:grid-cols-2">
                    <!-- VENUE -->
                    <div>
                        <label class="block mb-3 text-sm font-bold text-yellow-300">
                            📍 Venue
                        </label>
                        <input type="text"
                               name="venue"
                               placeholder="Event venue"
                               class="w-full p-4 transition border rounded-2xl focus:ring-2 focus:ring-yellow-400 bg-white/10 border-white/20 text-white placeholder-white/40 focus:border-yellow-400"
                               required>
                    </div>

                    <!-- EVENT TYPE -->
                    <div>
                        <label class="block mb-3 text-sm font-bold text-yellow-300">
                            🎟️ Event Type
                        </label>
                        <select name="event_type"
                                id="eventType"
                                onchange="toggleSeatField()"
                                class="w-full p-4 transition border rounded-2xl focus:ring-2 focus:ring-yellow-400 bg-white/10 border-white/20 text-white focus:border-yellow-400"
                                required>
                            <option value="standing" class="bg-gray-900">🎵 Standing Event</option>
                            <option value="seated" class="bg-gray-900">🪑 Seated Event</option>
                        </select>
                    </div>
                </div>

                <!-- DATE & TIME -->
                <div class="grid gap-6 mt-6 md:grid-cols-2">
                    <!-- DATE -->
                    <div>
                        <label class="block mb-3 text-sm font-bold text-yellow-300">
                            📅 Event Date
                        </label>
                        <input type="date"
                               name="date"
                               class="w-full p-4 transition border rounded-2xl focus:ring-2 focus:ring-yellow-400 bg-white/10 border-white/20 text-white focus:border-yellow-400"
                               required>
                    </div>

                    <!-- TIME -->
                    <div>
                        <label class="block mb-3 text-sm font-bold text-yellow-300">
                            ⏰ Event Time
                        </label>
                        <input type="time"
                               name="time"
                               class="w-full p-4 transition border rounded-2xl focus:ring-2 focus:ring-yellow-400 bg-white/10 border-white/20 text-white focus:border-yellow-400"
                               required>
                    </div>
                </div>

                <!-- PRICE + SEATS / CAPACITY LIMIT -->
                <div class="grid gap-6 mt-6 md:grid-cols-2">
                    <!-- PRICE -->
                    <div>
                        <label class="block mb-3 text-sm font-bold text-yellow-300">
                            💰 Ticket Price
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-yellow-400">₹</span>
                            <input type="number"
                                   name="price"
                                   placeholder="Enter price"
                                   class="w-full p-4 pl-8 transition border rounded-2xl focus:ring-2 focus:ring-yellow-400 bg-white/10 border-white/20 text-white placeholder-white/40 focus:border-yellow-400"
                                   required>
                        </div>
                    </div>

                    <!-- SEATS (For seated events) -->
                    <div id="seatField" class="hidden">
                        <label class="block mb-3 text-sm font-bold text-yellow-300">
                            💺 Total Seats
                        </label>
                        <input type="number"
                               name="total_seats"
                               placeholder="Enter total seats"
                               class="w-full p-4 transition border rounded-2xl focus:ring-2 focus:ring-yellow-400 bg-white/10 border-white/20 text-white placeholder-white/40 focus:border-yellow-400">
                    </div>

                    <!-- STANDING LIMIT (For standing events) -->
                    <div id="standingLimitField" class="">
                        <label class="block mb-3 text-sm font-bold text-yellow-300">
                            👥 Number of Limit People
                        </label>
                        <input type="number"
                               name="standing_limit"
                               placeholder="Enter limit of people (optional)"
                               class="w-full p-4 transition border rounded-2xl focus:ring-2 focus:ring-yellow-400 bg-white/10 border-white/20 text-white placeholder-white/40 focus:border-yellow-400"
                               min="1">
                        <p class="text-yellow-300/50 text-xs mt-1">Leave blank for unlimited capacity</p>
                    </div>
                </div>

                <!-- EVENT IMAGE -->
                <div class="mt-6">
                    <label class="block mb-3 text-sm font-bold text-yellow-300">
                        🖼️ Event Banner Image
                    </label>
                    <div class="border-2 border-dashed border-purple-500/30 rounded-2xl p-6 text-center hover:border-yellow-500/60 transition cursor-pointer group"
                         onclick="document.getElementById('eventImageInput').click()">
                        <input type="file"
                               id="eventImageInput"
                               name="image"
                               accept="image/*"
                               class="hidden"
                               onchange="previewImage(this, 'eventPreview', 'eventPlaceholder')">
                        <div id="eventPlaceholder">
                            <svg class="w-12 h-12 mx-auto text-purple-400/50 group-hover:text-yellow-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-white/60 text-sm mt-2 group-hover:text-white/80 transition">
                                Click to upload event banner
                            </p>
                            <p class="text-white/40 text-xs mt-1">
                                PNG, JPG, GIF up to 5MB
                            </p>
                        </div>
                        <div id="eventPreview" class="hidden mt-3">
                            <img id="eventPreviewImg" class="max-h-48 mx-auto rounded-lg shadow-lg">
                            <p class="text-yellow-400 text-sm mt-2">✓ Image selected</p>
                        </div>
                    </div>
                </div>

                <!-- PAYMENT QR -->
                <div class="mt-6">
                    <label class="block mb-3 text-sm font-bold text-yellow-300">
                        💳 Payment QR Image
                    </label>
                    <div class="border-2 border-dashed border-purple-500/30 rounded-2xl p-6 text-center hover:border-yellow-500/60 transition cursor-pointer group"
                         onclick="document.getElementById('paymentQrInput').click()">
                        <input type="file"
                               id="paymentQrInput"
                               name="payment_qr"
                               accept="image/*"
                               class="hidden"
                               onchange="previewImage(this, 'paymentPreview', 'paymentPlaceholder')">
                        <div id="paymentPlaceholder">
                            <svg class="w-12 h-12 mx-auto text-purple-400/50 group-hover:text-yellow-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <p class="text-white/60 text-sm mt-2 group-hover:text-white/80 transition">
                                Click to upload payment QR
                            </p>
                            <p class="text-white/40 text-xs mt-1">
                                PNG, JPG, GIF up to 5MB
                            </p>
                        </div>
                        <div id="paymentPreview" class="hidden mt-3">
                            <img id="paymentPreviewImg" class="max-h-48 mx-auto rounded-lg shadow-lg">
                            <p class="text-yellow-400 text-sm mt-2">✓ QR uploaded</p>
                        </div>
                    </div>
                </div>


                <!-- SUBMIT BUTTON - Register Theme -->
                <button type="submit"
                        class="w-full py-5 mt-10 text-lg font-bold text-white transition-all duration-300 shadow-xl bg-gradient-to-r from-purple-600 to-yellow-500 rounded-2xl hover:scale-[1.02] hover:shadow-yellow-500/30 flex items-center justify-center gap-2 group">
                    <span>🚀</span>
                    Create Event
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </button>

                <!-- Footer Note -->
                <p class="text-center text-white/40 text-xs mt-6">
                    By creating an event, you agree to our 
                    <a href="#" class="text-yellow-300 hover:text-white transition">Event Guidelines</a>
                </p>
            </form>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
    function toggleSeatField() {
        const type = document.getElementById('eventType').value;
        const seatField = document.getElementById('seatField');
        const standingLimitField = document.getElementById('standingLimitField');

        if (type === 'seated') {
            seatField.classList.remove('hidden');
            seatField.style.animation = 'fadeInUp 0.3s ease-out';
            standingLimitField.classList.add('hidden');
        } else {
            seatField.classList.add('hidden');
            standingLimitField.classList.remove('hidden');
            standingLimitField.style.animation = 'fadeInUp 0.3s ease-out';
        }
    }

    function previewImage(input, previewId, placeholderId) {
        const preview = document.getElementById(previewId);
        const placeholder = document.getElementById(placeholderId);
        const previewImg = document.getElementById(previewId + 'Img');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }
    }

    // Run on page load
    toggleSeatField();
</script>

@endsection