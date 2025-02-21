<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $currentCategory->name }} Recipes - RamadanConnect</title>
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
                <a href="{{ url('/') }}" class="text-2xl font-bold gradient-text">Ramadan Recipes</a>
            </div>
        </div>
    </nav>

    <!-- Category Heading -->
    <section class="pt-32 px-6">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold text-white mb-4">{{ $currentCategory->name }} Recipes</h2>
            <p class="text-gray-400 mb-8">Showing all recipes in this category</p>
            
            <!-- Category Navigation -->
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                @foreach($categories as $category)
                    <a 
                    href='/recipes/{{ $category->id }}/category'

                        class="px-6 py-3 rounded-full text-white transition-all duration-300 
                        {{ $category->id == $currentCategory->id 
                            ? 'bg-gradient-to-r from-amber-400 to-emerald-400' 
                            : 'bg-white/10 hover:bg-white/20' }}"
                    >
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Recipe Grid -->
    <section class="py-12 px-6">
        <div class="container mx-auto">
            @if($recipes->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($recipes as $recipe)
                    <div class="group bg-white/5 backdrop-blur-xl rounded-2xl p-6 border border-white/10 hover:border-amber-400/30 transition-all duration-500">
                        <div class="w-full h-48 rounded-xl bg-gradient-to-br from-amber-400/20 to-amber-400/10 mb-4 overflow-hidden">
                            
                        </div>
                        <h3 class="text-xl font-semibold text-white group-hover:text-amber-400 transition-colors">
                            {{ $recipe->name }}
                        </h3>
                        <p class="text-gray-400 text-sm mt-2">{{ $recipe->description }}</p>
                        <div class="mt-4">
                            <span class="inline-block px-3 py-1 text-xs font-medium text-amber-400 bg-amber-400/10 rounded-full">
                                {{ $recipe->category->name }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-400 text-lg">No recipes found in this category.</p>
                    <a href="{{ url('/recipes') }}" class="inline-block mt-4 px-6 py-3 bg-amber-400 text-white rounded-full hover:bg-amber-500 transition-colors">
                        View All Recipes
                    </a>
                </div>
            @endif
        </div>
    </section>
</body>
</html>