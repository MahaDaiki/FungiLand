<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikesController extends Controller
{public function like(Post $post)
    {
        $like = new Like();
        $like->user_id = auth()->id();
        $post->likes()->save($like);
        
        $likeCount = $post->likes->count(); 
    
        return response()->json(['message' => 'Liked', 'likes_count' => $likeCount]);
    }
    
    public function unlike(Post $post)
    {
        $post->likes()->where('user_id', auth()->id())->delete();
        
        $likeCount = $post->likes->count(); 
    
        return response()->json(['message' => 'Unliked', 'likes_count' => $likeCount]);
    }
}
