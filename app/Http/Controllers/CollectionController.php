<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollectionsRequest;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{

    public function index()
    {
        $collections = Collection::where('user_id', auth()->id())->get();
        return view('collections.collection', compact('collections'));
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
public function show($id)
{
    $collection = Collection::findOrFail($id);

    if ($collection->user_id != auth()->id()) {
        return back()->with('error', 'Unauthorized');
    }

    return view('', compact('collection'));
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
