<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $categories = Category::paginate(10,['*'],'category');
        $tags = Tag::paginate(10,['*'],'tags');
        
        return view('admin.dashboard',compact('categories','tags'));
    }
}
