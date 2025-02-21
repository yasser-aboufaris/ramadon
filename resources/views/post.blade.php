<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ramadan Connect</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-[#0a2e38] to-[#1a535c] min-h-screen">
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


    <!-- Post Content -->
    <section class="pt-32 pb-20 px-6">
        <div class="container mx-auto max-w-3xl">
            <a href="/" class="inline-flex items-center text-amber-400 hover:text-amber-300 mb-8">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Feed
            </a>

            <article class="bg-white/10 backdrop-blur-md rounded-xl p-8">
                <h1 class="text-3xl font-bold text-white">{{ $post->title }}</h1>
                <p class="text-sm text-gray-400 mt-2">Posted {{ $post->created_at->diffForHumans() }}</p>

                <div class="prose text-gray-300 mt-6">
                    <p>{{ $post->description }}</p>
                    <div class="mt-4">{!! nl2br(e($post->content)) !!}</div>
                </div>
                
                <!-- Added Comment Count -->
                <div class="mt-6 flex items-center text-gray-400">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                    </svg>
                    <span>{{ count($post->comments) }} Comments</span>
                </div>
            </article>

            <!-- Comments Section -->
            <div class="mt-8 bg-white/5 backdrop-blur-md rounded-xl p-6">
                <h3 class="text-xl font-semibold text-white mb-4">Comments</h3>
                <form action="\comment\add" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <textarea class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-400" rows="3" name="content" placeholder="Share your thoughts..."></textarea>
                    <button class="mt-3 bg-amber-400 hover:bg-amber-500 text-white px-6 py-2 rounded-lg">Post Comment</button>
                </form>
                
                <div class="mt-6 space-y-4">
                    @foreach($post->comments as $comment)
                        <div class="bg-white/5 p-4 rounded-lg flex justify-between items-center">
                            <div>
                                <p class="text-gray-300">{{ $comment->content }}</p>
                                <span class="text-sm text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-1 px-3 rounded-lg transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</body>
</html>