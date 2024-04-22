<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(){

        $mostcategories = Category::withCount('posts')
        ->orderByDesc('posts_count')
        ->limit(5) 
        ->get();
        $mosttags = Tag::withCount('posts')
        ->orderByDesc('posts_count')
        ->limit(5) 
        ->get();
        $posts = Post::paginate(5);
        $user = Auth::user();
        return view('posts',compact('mosttags','mostcategories','posts','user')); 
    }

    public function postbyuser(){
        $user = Auth::user();
        $userId = Auth::id();
        $posts = Post::where('user_id', $userId)->get();
        $categories = Category::all();
        $tags = Tag::all();
        return view('profile', compact('posts','categories','tags','user'));
    }

    public function create(){
        $categories = Category::all();
        $tags = Tag::all();
        return view('Posts.createpost',compact('categories','tags'));
    }
    public function add(PostRequests $request)
    {
            $validatedData = $request->validated();
            
            if ($request->hasFile('image')) {
                $profilePicPath = $request->file('image')->store('assets/images', 'public');
                $validatedData['image'] = $profilePicPath;
            }
        
            $validatedData['user_id'] = Auth::id();
        
            $post = Post::create($validatedData);
        
            if ($request->has('tag_ids')) {
                $post->tags()->attach($request->tag_ids);
            }
        
            return redirect()->back()->with('success', 'Post created successfully');
        }
        
    
    
    public function edit($id) {
        $post = Post::findOrFail($id); 
        $categories = Category::all();
        $tags = Tag::all();
        return view('Posts.updatepost', compact('post','categories','tags')); 
    }
    
    public function update(PostRequests $request, $id)
    {
        $validatedData = $request->validated();

        $post = Post::findOrFail($id);
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $profilePicPath = $request->file('image')->store('assets/images', 'public');
            $validatedData['image'] = $profilePicPath;
        }
        $post->update($validatedData);
        if ($request->has('tag_ids')) {
            $post->tags()->sync($request->tag_ids);
        } else {
            $post->tags()->detach();
        }
    
        return redirect()->back()->with('success', 'Post updated successfully');
    }
    
    public function destroy($id) {
        $post = Post::findOrFail($id); 
    
        $post->delete(); 
    
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
    
    
    
}
