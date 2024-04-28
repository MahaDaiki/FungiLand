<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        $categories = Category::withCount('posts')->orderBy('name')->paginate(10,['*'],'category');
      
        $tags = Tag::withCount('posts')->orderBy('name')->paginate(10,['*'],'tags');        
        
        return view('admin.dashboard',compact('categories','tags'));
    }
    public function manage(){
        $posts = Post::paginate(10,['*'],'posts');
        $deletedPosts = Post::onlyTrashed()->get();
        $deletedUsers = User::onlyTrashed()->get();
        $authenticatedUserId = Auth::id();
        $users = User::where('id', '!=', $authenticatedUserId)->paginate(10,['*'],'users');
        return view('admin.manage',compact('users','posts','deletedPosts','deletedUsers'));
    }
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

         return back()->with('success', 'User deleted successfully');
    }

    public function restoreUser($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return back()->with('success', 'User restored successfully');
    }
    public function deletePost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

         return back()->with('success', 'Post deleted successfully');
    }

    public function restorePost($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

       return back()->with('success', 'Post restored successfully');
    }
}
