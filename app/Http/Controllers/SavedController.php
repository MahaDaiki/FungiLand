<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Saved;
use App\Models\Tag;
use App\Models\User;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedController extends Controller
{
    public function index()
    {

        $userId = Auth::id();

        $savedPosts = Saved::where('user_id', $userId)->get();
        $posts = [];
        foreach ($savedPosts as $savedPost) {
            $postId = $savedPost->post_id;
            $post = Post::find($postId);
            if ($post) {
                $posts[] = $post;
            }
        }
        $category = Category::all();
        $tags = Tag::all();
        $user = Auth::user(); 
        return view('savedposts', compact('savedPosts', 'category', 'tags', 'user','posts'));
    }
    public function save(Request $request, Post $post)
    {
        $saved = new Saved();
        $saved->user_id = auth()->id();
        $saved->post_id = $post->id;
        $saved->save();
    
        return response()->json(['success' => true, 'saved' => true]);
    }
    
    public function unsave(Request $request, Post $post)
    {
        $saved = Saved::where('user_id', auth()->id())->where('post_id', $post->id)->first();
        if ($saved) {
            $saved->delete();
        }
    
        return response()->json(['success' => true, 'saved' => false]);
    }
    public function removeSavedPost($id)
    {
        
                $savedPost = Saved::where('post_id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();

        if ($savedPost->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to remove this saved post.');
        }
        
        $savedPost->delete();

        return redirect()->back()->with('success', 'Saved post removed successfully');
    }
    
}
