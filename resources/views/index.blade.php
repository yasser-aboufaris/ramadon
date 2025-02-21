<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ramadan Connect - Spiritual Social Network</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes crescent-glow {
            0%, 100% { opacity: 0.8; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.05); }
        }
        .crescent-float {
            animation: crescent-glow 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        .gradient-text {
            background: linear-gradient(135deg, #F6D365 0%, #38A3A5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-[#051B2C] via-[#0A2E38] to-[#1A535C] min-h-screen">
    <!-- Navigation -->
    <nav class="fixed w-full bg-white/5 backdrop-blur-lg border-b border-white/10 z-50">
    <div class="container mx-auto px-6 py-4 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <svg class="w-8 h-8 text-amber-400 floating-spice" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 3c-4.4 0-8 3.6-8 8 0 3.5 2.3 6.5 5.5 7.5.5.1 1 .2 1.5.2V21l3-3-3-3v2.5c-.5 0-1-.1-1.5-.2-2.2-.7-3.8-2.8-3.8-5.3 0-3 2.5-5.5 5.5-5.5S17 9 17 12c0 .3 0 .6-.1.9.7.3 1.5.5 2.3.6.2-.5.3-1 .3-1.5 0-4.4-3.6-8-8-8z"/>
            </svg>
            <span class="text-2xl font-bold gradient-text">
                Ramadan Recipes
            </span>
        </div>

        <div class="flex items-center space-x-8">
            <a href="{{ url('/') }}" class="text-white/80 hover:text-amber-400 transition-all duration-300 text-sm font-medium">Posts</a>
            <a href="{{ url('/recipes/1/category') }}" class="text-white/80 hover:text-amber-400 transition-all duration-300 text-sm font-medium">Categories</a>
            <a href="{{ url('/recipes') }}" class="text-white/80 hover:text-amber-400 transition-all duration-300 text-sm font-medium">Recipes</a>

            <button 
                onclick="document.getElementById('recipeForm').classList.toggle('hidden')"
                class="bg-gradient-to-r from-amber-400 to-emerald-400 hover:from-amber-500 hover:to-emerald-500 
                       text-white px-8 py-3 rounded-full text-sm font-semibold 
                       shadow-lg shadow-amber-400/20 transition-all duration-300 transform hover:scale-105 active:scale-95">
                🥘 Share Recipe
            </button>
        </div>
    </div>
</nav>


    <!-- Hero Section -->
    <section class="pt-40 pb-24 px-6 relative overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[800px] bg-amber-400/10 rounded-full blur-3xl"></div>
        <div class="container mx-auto text-center relative">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-6xl font-bold text-white mb-8 leading-tight">
                    Share Blessings This
                    <span class="gradient-text inline-block">
                        Ramadan
                    </span>
                </h1>
                <p class="text-2xl text-gray-300 mb-12 leading-relaxed">
                    Connect with millions worldwide in spiritual unity. Share Iftar moments, track prayers, and spread kindness.
                </p>
                <button class="bg-gradient-to-r from-amber-400 to-emerald-400 hover:from-amber-500 hover:to-emerald-500 
                             text-white px-12 py-4 rounded-full text-lg font-semibold 
                             shadow-lg shadow-amber-400/20 transition-all duration-300 transform hover:scale-105">
                    Start Sharing Now 🌙
                </button>
            </div>
        </div>
    </section>

    <!-- Posts Section -->
    <section class="py-24 px-6 relative">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold gradient-text inline-block mb-4">
                    Latest Reflections
                </h2>
            </div>

            <!-- Posts Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts as $poste)
                    <div class="group bg-white/5 backdrop-blur-xl rounded-2xl p-8 border border-white/10 hover:border-amber-400/30 transition-all duration-500 hover:transform hover:scale-105">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-semibold text-white group-hover:text-amber-400 transition-colors">{{ $poste->title }}</h3>
                            <span class="text-amber-400/80 text-sm font-medium">#{{ $poste->id }}</span>
                        </div>

                        <p class="text-gray-300 mb-6 line-clamp-3">{{ $poste->description }}</p>

                        <div class="flex items-center justify-between pt-6 border-t border-white/10">
                            <a href="/post/{{ $poste->id }}" class="text-amber-400 hover:text-amber-300 transition-colors flex items-center space-x-2 group">
                                <span>Read More</span>
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>

                            <a href="/posts/{{ $poste->id }}/delete" class="text-gray-400 hover:text-red-400 transition-colors p-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Features Grid -->
    <section class="py-24 px-6 relative">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Feature Cards with enhanced styling -->
            <div class="group bg-white/5 backdrop-blur-xl rounded-2xl p-8 border border-white/10 hover:border-amber-400/30 transition-all duration-500 hover:transform hover:scale-105">
                <div class="w-16 h-16 bg-gradient-to-br from-amber-400/20 to-amber-400/10 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-white mb-4 group-hover:text-amber-400 transition-colors">Iftar Timing</h3>
                <p class="text-gray-300">Sync with local masjids and never miss Iftar time</p>
            </div>

            <!-- Daily Duas Feature Card -->
<div class="group bg-white/5 backdrop-blur-xl rounded-2xl p-8 border border-white/10 hover:border-amber-400/30 transition-all duration-500 hover:transform hover:scale-105">
    <div class="w-16 h-16 bg-gradient-to-br from-emerald-400/20 to-emerald-400/10 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
        <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
    </div>
    <h3 class="text-xl font-semibold text-white mb-4 group-hover:text-emerald-400 transition-colors">Daily Duas</h3>
    <p class="text-gray-300">Share and discover meaningful supplications</p>
</div>

<!-- Charity Corner Feature Card -->
<div class="group bg-white/5 backdrop-blur-xl rounded-2xl p-8 border border-white/10 hover:border-amber-400/30 transition-all duration-500 hover:transform hover:scale-105">
    <div class="w-16 h-16 bg-gradient-to-br from-rose-400/20 to-rose-400/10 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
        <svg class="w-8 h-8 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
    </div>
    <h3 class="text-xl font-semibold text-white mb-4 group-hover:text-rose-400 transition-colors">Charity Corner</h3>
    <p class="text-gray-300">Connect with verified charitable causes</p>
</div>

<!-- Live Prayers Feature Card -->
<div class="group bg-white/5 backdrop-blur-xl rounded-2xl p-8 border border-white/10 hover:border-amber-400/30 transition-all duration-500 hover:transform hover:scale-105">
    <div class="w-16 h-16 bg-gradient-to-br from-blue-400/20 to-blue-400/10 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
        </svg>
    </div>
    <h3 class="text-xl font-semibold text-white mb-4 group-hover:text-blue-400 transition-colors">Live Prayers</h3>
    <p class="text-gray-300">Join virtual congregational prayers</p>
</div>


            <!-- Repeat similar enhanced styling for other feature cards -->
        </div>
    </section>
<!-- Post Form Modal -->
<div id="postForm" class="hidden fixed inset-0 flex items-center justify-center bg-black/80 backdrop-blur-sm z-50">
    <div class="bg-indigo-900/30 backdrop-blur-xl rounded-2xl p-8 max-w-2xl w-full mx-4 border border-indigo-300/20">
        <form action="/posts/add" method="POST" class="space-y-6">
            @csrf
            <div class="space-y-2">
                <label for="title" class="block text-indigo-100 text-sm font-medium">Post Title</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    class="w-full px-4 py-3 bg-indigo-800/20 border border-indigo-300/20 rounded-xl text-white placeholder-indigo-300 
                           focus:outline-none focus:ring-2 focus:ring-purple-400 transition-all"
                    placeholder="Enter your post title"
                >
            </div>

            <div class="space-y-2">
                <label for="description" class="block text-indigo-100 text-sm font-medium">Description</label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="3" 
                    class="w-full px-4 py-3 bg-indigo-800/20 border border-indigo-300/20 rounded-xl text-white placeholder-indigo-300 
                           focus:outline-none focus:ring-2 focus:ring-purple-400 transition-all"
                    placeholder="Share your Ramadan reflection..."
                ></textarea>
            </div>

            <div class="space-y-2">
                <label for="content" class="block text-indigo-100 text-sm font-medium">Content</label>
                <textarea 
                    id="content" 
                    name="content" 
                    rows="6" 
                    class="w-full px-4 py-3 bg-indigo-800/20 border border-indigo-300/20 rounded-xl text-white placeholder-indigo-300 
                           focus:outline-none focus:ring-2 focus:ring-purple-400 transition-all"
                    placeholder="Write your detailed content here..."
                ></textarea>
            </div>

            <button 
                type="submit" 
                class="w-full bg-gradient-to-r from-purple-500 to-indigo-500 hover:from-purple-600 hover:to-indigo-600 
                       text-white px-6 py-4 rounded-xl font-semibold 
                       shadow-lg shadow-purple-400/20 transition-all duration-300 transform hover:scale-105"
            >
                Share Blessing 🌙
            </button>
        </form>
    </div>
</div>

<script>
  // Hide the modal when clicking outside the inner container
  const postForm = document.getElementById('postForm');
  postForm.addEventListener('click', (e) => {
    if (e.target === postForm) {
      postForm.classList.add('hidden');
    }
  });
</script>

<!-- Footer -->
<footer class="border-t border-white/10 mt-20 py-12 px-6">
    <div class="container mx-auto text-center">
        <div class="flex justify-center space-x-6 mb-8">
            <a href="#" class="text-gray-300 hover:text-amber-400 transition-colors">About</a>
            <a href="#" class="text-gray-300 hover:text-amber-400 transition-colors">Privacy</a>
            <a href="#" class="text-gray-300 hover:text-amber-400 transition-colors">Qibla Finder</a>
            <a href="#" class="text-gray-300 hover:text-amber-400 transition-colors">Support</a>
        </div>
        <div class="flex justify-center space-x-6 mb-8">
            <svg class="w-6 h-6 text-gray-300 hover:text-amber-400 cursor-pointer" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
            <svg class="w-6 h-6 text-gray-300 hover:text-amber-400 cursor-pointer" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
            <svg class="w-6 h-6 text-gray-300 hover:text-amber-400 cursor-pointer" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
        </div>
        <p class="text-gray-400 text-sm">
            © 2024 RamadanConnect. All rights reserved. Blessed Coding!
        </p>
    </div>
</footer>
</body>
</html>
