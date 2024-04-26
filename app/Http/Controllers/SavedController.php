<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Saved;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedController extends Controller
{
    public function index($userId)
    {
        $user = User::findOrFail($userId);
        $savedposts = Saved::where('user_id', $userId)->with('post')->get();
        $category = Category::all();
        $tags = Tag::all();
          return view('savedposts', compact('savedposts','category','tags','user')); 
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
    
}
