@extends('layouts.app')

@section('content')
<style>
    /* Custom animations for form */
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
    
    .form-animate {
        animation: fadeInUp 0.5s ease-out forwards;
    }
    
    input:focus, textarea:focus, select:focus {
        animation: pulse-glow 1s ease-in-out infinite;
    }
    
    /* Glass morphism effect */
    .glass-card {
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
    }
    
    .input-dark {
        background: rgba(0, 0, 0, 0.4);
        border: 1px solid rgba(255,255,255,0.15);
        color: white;
        transition: all 0.3s ease;
    }
    
    .input-dark:focus {
        background: rgba(0, 0, 0, 0.6);
        border-color: #eab308;
        outline: none;
        box-shadow: 0 0 15px rgba(234,179,8,0.3);
    }
    
    .input-dark::placeholder {
        color: rgba(255,255,255,0.4);
    }
    
    label {
        color: rgba(255,255,255,0.9);
        font-weight: 600;
    }
    
    option {
        background: #1a1a2e;
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-yellow-900 py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    
    <!-- Animated Background Orbs - Register Theme (Purple/Yellow) -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-20 left-10 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-yellow-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-orange-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-2000"></div>
    </div>

    <div class="max-w-4xl mx-auto form-animate relative z-10">
        
        <!-- Glass Card Container -->
        <div class="glass-card rounded-3xl shadow-2xl overflow-hidden">
            
            <!-- Header with Gradient - Purple to Yellow -->
            <div class="bg-gradient-to-r from-purple-600/30 to-yellow-600/30 px-8 py-6 border-b border-white/20">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-yellow-500 rounded-xl flex items-center justify-center shadow-lg animate-pulse-slow">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white">
                            Create New Event
                        </h1>
                        <p class="text-yellow-200 text-sm mt-1">
                            Share your amazing event with the world
                        </p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('events.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="p-8 space-y-6">

                @csrf

                <!-- 2 Column Layout for basic info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-semibold">
                            <span class="flex items-center gap-2">
                                <span>📝</span> Event Title
                            </span>
                        </label>
                        <input type="text"
                               name="title"
                               required
                               placeholder="e.g., Summer Music Festival 2024"
                               class="input-dark w-full p-3 rounded-xl">
                    </div>

                    <!-- Venue -->
                    <div>
                        <label class="block mb-2 text-sm font-semibold">
                            <span class="flex items-center gap-2">
                                <span>📍</span> Venue
                            </span>
                        </label>
                        <input type="text"
                               name="venue"
                               required
                               placeholder="e.g., Madison Square Garden"
                               class="input-dark w-full p-3 rounded-xl">
                    </div>

                    <!-- Date -->
                    <div>
                        <label class="block mb-2 text-sm font-semibold">
                            <span class="flex items-center gap-2">
                                <span>📅</span> Event Date
                            </span>
                        </label>
                        <input type="date"
                               name="date"
                               required
                               class="input-dark w-full p-3 rounded-xl">
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block mb-2 text-sm font-semibold">
                        <span class="flex items-center gap-2">
                            <span>📖</span> Description
                        </span>
                    </label>
                    <textarea name="description"
                              rows="5"
                              required
                              placeholder="Describe your event... What makes it special? What can attendees expect?"
                              class="input-dark w-full p-3 rounded-xl resize-none"></textarea>
                </div>

                <!-- Price & Event Type Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Price -->
                    <div>
                        <label class="block mb-2 text-sm font-semibold">
                            <span class="flex items-center gap-2">
                                <span>💰</span> Ticket Price
                            </span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-white/50">$</span>
                            <input type="number"
                                   name="price"
                                   required
                                   min="0"
                                   step="0.01"
                                   placeholder="0.00"
                                   class="input-dark w-full p-3 rounded-xl pl-8">
                        </div>
                    </div>

                    <!-- Event Type -->
                    <div>
                        <label class="block mb-2 text-sm font-semibold">
                            <span class="flex items-center gap-2">
                                <span>🎟️</span> Event Type
                            </span>
                        </label>
                        <select name="event_type"
                                id="eventType"
                                onchange="toggleSeatField()"
                                class="input-dark w-full p-3 rounded-xl cursor-pointer">
                            <option value="standing" class="bg-gray-800">Standing Event (GA)</option>
                            <option value="seated" class="bg-gray-800">Seated Event (Reserved)</option>
                        </select>
                    </div>
                </div>

                <!-- Total Seats (Conditional) -->
                <div id="seatField" class="hidden">
                    <label class="block mb-2 text-sm font-semibold">
                        <span class="flex items-center gap-2">
                            <span>💺</span> Total Seats Available
                        </span>
                    </label>
                    <input type="number"
                           name="total_seats"
                           min="1"
                           placeholder="e.g., 500"
                           class="input-dark w-full p-3 rounded-xl">
                    <p class="text-yellow-300/50 text-xs mt-1">
                        Number of seats available for this seated event
                    </p>
                </div>

                <!-- Event Image Upload -->
                <div>
                    <label class="block mb-2 text-sm font-semibold">
                        <span class="flex items-center gap-2">
                            <span>🖼️</span> Event Image
                        </span>
                    </label>
                    <div class="border-2 border-dashed border-purple-500/30 rounded-xl p-6 text-center hover:border-yellow-500/60 transition cursor-pointer group"
                         onclick="document.getElementById('imageInput').click()">
                        <input type="file"
                               id="imageInput"
                               name="image"
                               accept="image/*"
                               class="hidden"
                               onchange="previewImage(this)">
                        <div id="uploadPlaceholder">
                            <svg class="w-12 h-12 mx-auto text-purple-400/50 group-hover:text-yellow-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-white/60 text-sm mt-2 group-hover:text-white/80 transition">
                                Click or drag to upload event image
                            </p>
                            <p class="text-white/40 text-xs mt-1">
                                PNG, JPG, GIF up to 5MB
                            </p>
                        </div>
                        <div id="imagePreview" class="hidden mt-3">
                            <img id="previewImg" class="max-h-48 mx-auto rounded-lg shadow-lg">
                            <p class="text-yellow-400 text-sm mt-2">✓ Image selected</p>
                        </div>
                    </div>
                </div>

                <!-- Submit Button - Purple to Yellow gradient -->
                <div class="pt-4">
                    <button type="submit"
                            class="w-full md:w-auto px-8 py-4 text-lg font-bold text-white bg-gradient-to-r from-purple-600 to-yellow-500 hover:from-purple-700 hover:to-yellow-600 rounded-xl transition duration-300 shadow-lg hover:shadow-xl hover:scale-105 transform flex items-center justify-center gap-2 group">
                        <span>🚀</span>
                        Create Event
                        <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </button>
                    
                    <p class="text-white/40 text-xs text-center mt-4">
                        By creating an event, you agree to our <a href="#" class="text-yellow-300 hover:text-white transition">Event Guidelines</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    function toggleSeatField() {
        const eventType = document.getElementById('eventType').value;
        const seatField = document.getElementById('seatField');

        if (eventType === 'seated') {
            seatField.classList.remove('hidden');
            seatField.style.animation = 'fadeInUp 0.3s ease-out forwards';
        } else {
            seatField.classList.add('hidden');
        }
    }

    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        const placeholder = document.getElementById('uploadPlaceholder');
        const previewImg = document.getElementById('previewImg');
        
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

<style>
    @keyframes pulse-slow {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.95; transform: scale(1.02); }
    }
    .animate-pulse-slow {
        animation: pulse-slow 3s ease-in-out infinite;
    }
</style>

@endsection