<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        return view('posts'); 
    }

    public function create(){
        $categories = Category::all();
        $tags = Tag::all();
        return view('Posts.createpost',compact('categories','tags'));
    }
    public function add(){

    }
}
