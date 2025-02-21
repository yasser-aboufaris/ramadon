<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;


class CommentController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all()); 
    
        $request->validate([
            'post_id' => 'required|exists:posts,id', 
            'content' => 'required|string',
        ]);
    
        Comment::create([
            'post_id' => $request->post_id,
            'content' => $request->content,
        ]);
    
        return back()->with('success', 'Comment added successfully!');
    }


    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back();
    }
    
}
