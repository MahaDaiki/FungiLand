<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollectionsRequest;
use App\Models\Collection;
use App\Models\User;
use Illuminate\Http\Request;

class CollectionController extends Controller
{

    public function index($user)
    {
        $users = User::findOrFail($user); 
        if ($user == auth()->id()) {

            $collections = Collection::where('user_id', $user)->get();
        } else {
            $collections = Collection::where('user_id', $user)->where('is_public', true)->get();
        }
        
        return view('collections.collection', compact('collections','users'));
    }
    

    public function store(CollectionsRequest $request){

    $collection = new Collection();
    $collection->name = $request->name;
    $collection->is_public = $request->is_public;
    $collection->description = $request->description;
    $collection->user_id = auth()->id(); 
    $collection->save();

    return back()->with('success', 'Collection created successfully');
}
public function show($id, $userId)
{
    $user = User::findOrFail($userId);
    $collection = Collection::with('collectionContent')->findOrFail($id);
    if ($collection->user_id != auth()->id() && !$collection->is_public) {
        return back()->with('error', 'Unauthorized');
    }

    return view('collections.collectioncontent', compact('collection', 'user'));
}



public function update(CollectionsRequest $request, $id)
{
    $collection = Collection::findOrFail($id);

    if ($collection->user_id != auth()->id()) {
        return back()->with('error', 'Unauthorized');
    }

    $collection->name = $request->name;
    $collection->is_public = $request->is_public;
    $collection->description = $request->description;
    $collection->save();

    return back()->with('success', 'Collection updated successfully');
}
public function destroy($id)
{
    $collection = Collection::findOrFail($id);

    if ($collection->user_id != auth()->id()) {
        return back()->with('error', 'Unauthorized');
    }

    $collection->delete();

    return back()->with('success', 'Collection deleted successfully');
}
}
