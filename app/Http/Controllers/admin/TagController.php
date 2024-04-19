<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function create()
    {
        return view('tags.create');
    }

    public function store(TagRequest $request)
    {
        Tag::create($request->validated());
        return back()->with('success', 'Tag created successfully');
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    public function update(TagRequest $request, Tag $tag)
    {
        $tag->update($request->validated());
        return back()->with('success', 'Tag updated successfully');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return back()->with('success', 'Tag deleted successfully');
    }
}
