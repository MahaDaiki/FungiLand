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

        if ($request->hasFile('media')) {
            $media = $request->file('media');
            $mediaName = time() . '.' . $media->getClientOriginalExtension();
            $media->storeAs('assets/images', $mediaName); 
            $collectionContent->media = $mediaName;
        }

        $collectionContent->save();

        return back()->with('success', 'Collection content created successfully');
    }

    public function update(CollectionsContentRequest $request, $id)
    {
        $collectionContent = CollectionContent::findOrFail($id);

        $oldMedia = $collectionContent->media;

        $collectionContent->title = $request->title;
        $collectionContent->description = $request->description;
      if ($request->hasFile('media')) {
            $media = $request->file('media');
            $mediaName = time() . '.' . $media->getClientOriginalExtension();
            $media->storeAs('assets/images', $mediaName); 
            $collectionContent->media = $mediaName;
        }

        $collectionContent->save();

        if (isset($oldMedia) && $oldMedia !== $collectionContent->media) {
            Storage::delete('public/media/' . $oldMedia);
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

