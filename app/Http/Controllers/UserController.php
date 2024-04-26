<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\settingsRequests;
use App\Mail\ForgotPasswordMail;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\Saved;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function index()
    {
            $user = Auth::user();
            $userPosts = Post::withCount('likes', 'comments', 'saves')
                             ->where('user_id', $user->id)
                             ->get();
            $totalLikes = $userPosts->sum('likes_count');
            $totalComments = $userPosts->sum('comments_count');
            $totalSaved = $userPosts->sum('saves_count');
            $totalPosts = $userPosts->count();
            
            return view('profile', compact('user', 'totalLikes', 'totalComments', 'totalSaved', 'totalPosts'));
        }
        
    
        public function settings(){
            $user = Auth::user();
            return view('Auth.settings',compact('user'));
        }
    //     public function updateProfile(settingsRequests $request)
    // {
    //     $user = Auth::user();

    //     $user->name = $request->input('name');
    //     $user->email = $request->input('email');
    //     $user->description = $request->input('description');
    //     if ($request->hasFile('image')) {
    //         if ($user->profilepic) {
    //             Storage::delete($user->profilepic);
    //         }
    //         $path = $request->file('image')->store('profile_pictures', 'public');
    //         $user->profilepic = $path;
    //     }

    //     $user->save();

    //     return redirect()->back()->with('success', 'Profile updated successfully.');
    // }
    // public function changePassword(ChangePasswordRequest $request)
    // {
    //     $user = Auth::user();

    //     if (!Hash::check($request->current_password, $user->password)) {
    //         return redirect()->back()->with('error', 'Current password is incorrect.');
    //     }
    //     $user->password = Hash::make($request->new_password);
    //     $user->save();

    //     return redirect()->back()->with('success', 'Password changed successfully.');
    // }
    }


