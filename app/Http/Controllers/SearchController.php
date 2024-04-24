<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('search'); 
        $type = $request->input('post_type'); 
    
        $postsQuery = Post::query();
        if ($query) {
            $postsQuery->where('title', 'like', "%$query%")
                       ->orWhereHas('category', function ($categoryQuery) use ($query) {
                            $categoryQuery->where('name', 'like', "%$query%");
                        })
                       ->orWhereHas('tags', function ($tagQuery) use ($query) {
                            $tagQuery->where('name', 'like', "%$query%");
                        });
        }
        if ($type) {
            $postsQuery->where('type', $type);
        }
    
        $posts = $postsQuery->with('user', 'category', 'tags')->get();
    
        return response()->json($posts);
    }
    

    
}
