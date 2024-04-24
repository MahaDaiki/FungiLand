<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class StatistiquesController extends Controller
{

    public function index(){
        $totalCategories = Category::count();
        $totalTags = Tag::count();
        $totalUsers = User::count();
        $totalposts = Post::count();
        return view('admin.statistiques', compact('totalCategories','totalTags','totalUsers','totalposts'));
    }

    // public function monthlyStatistics()
    // {
    //     $monthlyPosts = Post::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
    //         ->groupBy('year', 'month')
    //         ->orderBy('year', 'asc')
    //         ->orderBy('month', 'asc')
    //         ->get();
    //     $monthlyUsers = User::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
    //         ->groupBy('year', 'month')
    //         ->orderBy('year', 'asc')
    //         ->orderBy('month', 'asc')
    //         ->get();

    //     return response()->json(compact('monthlyPosts', 'monthlyUsers'));
    // }
    public function dailyStatistics()
    {
    
        $dailyPosts = Post::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $dailyUsers = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
            $totalCategories = Category::count();
            $totalTags = Tag::count();
            $totalUsers = User::count();
            $totalposts = Post::count();
        return response()->json(compact('dailyPosts', 'dailyUsers','totalCategories','totalTags','totalUsers','totalposts'));
    }


    public function totalPostsByUser()
    {
        $totalPostsByUser = User::withCount('posts')->get();
    }

    public function userStatistics()
    {
        $users = User::withCount(['posts', 'likes', 'comments', 'saved'])->get();
      
    }

    public function postStatistics()
    {
        $posts = Post::withCount(['likes', 'comments', 'saved'])->get();
       
    // }
    //     public function categoryStatistics()
    // {
    //     $categories = Category::withCount('posts')->get();
    //   $tags = Tag::withCount('posts')->get();
    //   return view('admin.dashboard',compact('categories','tags'));
      
    }




}
