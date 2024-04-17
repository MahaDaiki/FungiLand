<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.dashboard',compact('categories','tags'));
    }
}
