<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('index', compact('posts'));
    }

    //////////////////////////////////////
    public function show($id)
    {
        $post = Post::with('comments')->findOrFail($id);
        return view('post', compact('post'));
    }

    //////////////////////////////////////
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Post::create([
            'description' => $request->description,
            'content' => $request->content,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post ajouté avec succès.');
    }

    //////////////////////////////////////
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post supprimé avec succès.');
    }
}
