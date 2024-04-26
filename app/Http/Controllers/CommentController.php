<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function show(Post $post)
    {
        return view('postdetails', compact('post'));
    }
    public function store(CommentRequest $request, Post $post)
    {
        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

       return back()->with('success', 'Comment created successfully');
    }

    public function update(CommentRequest $request, Post $post, Comment $comment)
    {
        $comment->update([
            'content' => $request->input('content'),
        ]);

        return back()->with('success', 'Comment updated successfully');
    }
    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully');
    }
}
