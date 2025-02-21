<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RamadanConnect - Recipe Sharing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(5deg); }
        }
        .floating-spice {
            animation: float 3s ease-in-out infinite;
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
                    Share Your Family's
                    <span class="gradient-text inline-block">
                        Iftar Traditions
                    </span>
                </h1>
                <p class="text-2xl text-gray-300 mb-12 leading-relaxed">
                    Connect through flavors, share cherished recipes, and discover diverse culinary traditions from around the world.
                </p>
                <div class="flex justify-center space-x-4">
                    <a href="#recipes" class="bg-white/10 backdrop-blur-md hover:bg-white/20 text-white px-8 py-4 rounded-full text-lg font-semibold transition-all duration-300 flex items-center space-x-2">
                        <span>Browse Recipes</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Recipe Grid -->
    <section id="recipes" class="py-16 px-6">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold gradient-text inline-block mb-12">Latest Recipes</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($recipes as $recipe)
                <div class="group bg-white/5 backdrop-blur-xl rounded-2xl p-6 border border-white/10 hover:border-amber-400/30 transition-all duration-500">
                    <div class="w-full h-48 rounded-xl bg-gradient-to-br from-amber-400/20 to-amber-400/10 mb-4 overflow-hidden">
                        <img src="{{ $recipe->image_url ?? '/api/placeholder/400/320' }}" 
                             alt="{{ $recipe->name }}" 
                             class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                    </div>
                    <h3 class="text-xl font-semibold text-white group-hover:text-amber-400 transition-colors">{{ $recipe->name }}</h3>
                    <p class="text-gray-400 text-sm mt-2">{{ $recipe->description }}</p>
                    <div class="mt-4">
                        <span class="inline-block px-3 py-1 text-xs font-medium text-amber-400 bg-amber-400/10 rounded-full">
                            {{ $recipe->category->name }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center text-gray-400 py-12">
                    <p>No recipes found. Be the first to share a recipe!</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Recipe Form Modal -->
    <div id="recipeForm" class="hidden fixed inset-0 flex items-center justify-center bg-black/80 backdrop-blur-sm z-50">
        <div class="bg-white/10 backdrop-blur-xl rounded-xl p-6 max-w-2xl w-full mx-4 border border-white/20">
            <form action="recipes/add" method="POST" class="space-y-4">
                @csrf
                <div class="space-y-1">
                    <label class="block text-white text-sm font-medium">Name</label>
                    <input 
                        type="text" 
                        name="name" 
                        class="w-full px-3 py-2 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-400 transition-all"
                        placeholder="Recipe name"
                        required
                    >
                </div>

                <div class="space-y-1">
                    <label class="block text-white text-sm font-medium">Description</label>
                    <textarea 
                        name="description" 
                        rows="2" 
                        class="w-full px-3 py-2 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-400 transition-all"
                        placeholder="Brief description"
                        required
                    ></textarea>
                </div>

                <div class="space-y-1">
                    <label class="block text-white text-sm font-medium">Content</label>
                    <textarea 
                        name="content" 
                        rows="6" 
                        class="w-full px-3 py-2 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-400 transition-all"
                        placeholder="Detailed content (ingredients, steps, etc.)"
                        required
                    ></textarea>
                </div>

                <div class="space-y-1">
                    <label class="block text-white text-sm font-medium">Category</label>
                    <select 
                        name="category_id" 
                        class="w-full px-3 py-2 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-400 transition-all"
                        required
                    >
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-amber-400 to-emerald-400 hover:from-amber-500 hover:to-emerald-500 
                           text-white px-4 py-3 rounded-lg font-semibold 
                           shadow-lg shadow-amber-400/20 transition-all duration-300 transform hover:scale-105"
                >
                    Save Recipe 🥘
                </button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="border-t border-white/10 mt-20 py-16 px-6">
        <div class="container mx-auto">
            <div class="flex flex-wrap justify-center space-x-8 mb-12">
                <a href="#" class="text-gray-300 hover:text-amber-400 transition-all duration-300">About</a>
                <a href="#" class="text-gray-300 hover:text-amber-400 transition-all duration-300">Privacy</a>
                <a href="#" class="text-gray-300 hover:text-amber-400 transition-all duration-300">Guidelines</a>
                <a href="#" class="text-gray-300 hover:text-amber-400 transition-all duration-300">Support</a>
            </div>
            <p class="text-center text-gray-400 text-sm">
                © {{ date('Y') }} RamadanConnect. Share the blessings through food.
            </p>
        </div>
    </footer>

    <script>
    // Close modal when clicking outside
    document.getElementById('recipeForm').addEventListener('click', (e) => {
        if (e.target === document.getElementById('recipeForm')) {
            document.getElementById('recipeForm').classList.add('hidden');
        }
    });

    // Image loading animation
    document.addEventListener('DOMContentLoaded', () => {
        const images = document.querySelectorAll('img');
        images.forEach(img => {
            img.addEventListener('load', () => {
                img.classList.add('opacity-100');
            });
        });
    });

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    </script>
</body>
</html>