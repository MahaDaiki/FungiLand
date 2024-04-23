<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
{
    $query = $request->input('search'); 

    $posts = Post::where('title', 'like', "%$query%")
                ->orWhereHas('category', function ($categoryQuery) use ($query) {
                    $categoryQuery->where('name', 'like', "%$query%");
                })
                ->orWhereHas('tags', function ($tagQuery) use ($query) {
                    $tagQuery->where('name', 'like', "%$query%");
                })
                ->with('user', 'category', 'tags')
                ->get();

    return response()->json($posts);
}

    
}
