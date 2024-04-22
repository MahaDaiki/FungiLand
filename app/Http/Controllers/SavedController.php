<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Saved;
use Illuminate\Http\Request;

class SavedController extends Controller
{
    public function save(Request $request, Post $post)
    {
        $saved = new Saved();
        $saved->user_id = auth()->id();
        $saved->post_id = $post->id;
        $saved->save();

        return response()->json(['success' => true]);
    }

    public function unsave(Request $request, Post $post)
    {
        $saved = Saved::where('user_id', auth()->id())->where('post_id', $post->id)->first();
        if ($saved) {
            $saved->delete();
        }

        return response()->json(['success' => true]);
    }
}
