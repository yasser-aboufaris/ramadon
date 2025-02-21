<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Ramadan Connect</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-[#0a2e38] to-[#1a535c] min-h-screen">
    <!-- Navigation -->
    <nav class="fixed w-full bg-white/10 backdrop-blur-md z-50 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-amber-400 text-lg font-semibold">Ramadan Connect</a>
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
            </article>

            <!-- Comments Section -->
            <div class="mt-8 bg-white/5 backdrop-blur-md rounded-xl p-6">
                <h3 class="text-xl font-semibold text-white mb-4">Comments</h3>
                <!-- <form method="POST" action="/comment/add">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <textarea class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-400" rows="3" name="comment" placeholder="Share your thoughts..."></textarea>
                    <button class="mt-3 bg-amber-400 hover:bg-amber-500 text-white px-6 py-2 rounded-lg">Post Comment</button>
                </form> -->

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

        <!-- Delete Comment Button -->
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
