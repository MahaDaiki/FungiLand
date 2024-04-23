<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollectionsContentRequest;
use App\Models\CollectionContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CollectionContentController extends Controller
{
    public function store(CollectionsContentRequest $request)
    {
        $collectionContent = new CollectionContent();
        $collectionContent->collection_id = $request->collection_id;
        $collectionContent->title = $request->title;
        $collectionContent->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/assets/images', $imageName); 
            $collectionContent->image = $imageName;
        }

        $collectionContent->save();

        return back()->with('success', 'Collection content created successfully');
    }

    public function update(CollectionsContentRequest $request, $id)
    {
        $collectionContent = CollectionContent::findOrFail($id);

        $oldMedia = $collectionContent->image;

        $collectionContent->collection_id = $request->collection_id; // Include collection ID in update
        $collectionContent->title = $request->title;
        $collectionContent->description = $request->description;
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/assets/images', $imageName); 
            $collectionContent->image = $imageName;
        }

        $collectionContent->save();

        if (isset($oldMedia) && $oldMedia !== $collectionContent->image) {
            Storage::delete('public/assets/images/' . $oldMedia);
        }

        return back()->with('success', 'Collection content updated successfully');
    }

    public function destroy($id)
    {
        $collectionContent = CollectionContent::findOrFail($id);
        $collectionContent->delete();

        return back()->with('success', 'Collection content deleted successfully');
    }
}
