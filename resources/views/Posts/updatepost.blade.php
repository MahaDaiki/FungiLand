@include('layouts.nav')
@extends('layouts.app')
@section('title', 'Edit Post')

@section('content')

<div class="container mt-5">
    <div class="row">
        @include('layouts.errorhandle') 
        <div class="col-md-8">
            <div class="forma p-3">
                <h2 class="mb-4 text-center">Edit Post</h2>
                <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 
                    <div class="form-group">
                        <label for="postType">Type</label>
                        <select class="form-control" style="width: 50%" id="postType" name="type">
                            <option value="article" {{ $post->type === 'article' ? 'selected' : '' }}>Article</option>
                            <option value="question" {{ $post->type === 'question' ? 'selected' : '' }}>Question</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="postImage">Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="postImage" name="image">
                            <label class="custom-file-label" for="postImage">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="postCategory">Category</label>
                        <select class="form-control" id="postCategory" name="category_id">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $post->category_id === $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="postTags">Tags</label>
                        <div id="selectedTagsContainer">
                            @foreach($post->tags as $tag)
                                <div>{{ $tag->name }}</div>
                            @endforeach
                        </div>
                        <select class="form-control" id="postTags" name="tag_ids[]" multiple>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" {{ $post->tags->contains($tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="postTitle">Title</label>
                        <input type="text" class="form-control" id="postTitle" name="title" value="{{ $post->title }}">
                    </div>
                    <div class="form-group">
                        <label for="postContent">Content</label>
                        <textarea class="form-control" id="postContent" name="content" rows="6">{{ $post->content }}</textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="rules-container">
                <h3 class="text-center mb-4">Community Rules</h3>
                <ul>
                    <li>No spamming or self-promotion</li>
                    <li>No hate speech or harassment</li>
                    <li>Respect others' opinions</li>
                    <li>Stay on topic</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectElement = document.getElementById('postTags');
    const selectedTagsContainer = document.getElementById('selectedTagsContainer');

    function addSelectedTag(option) {
        const tagDiv = document.createElement('div');
        tagDiv.classList.add('selected-tag');
        tagDiv.textContent = option.text;
        tagDiv.setAttribute('data-value', option.value); 
        const removeButton = document.createElement('button');
        removeButton.textContent = 'X';
        removeButton.onclick = function() {
            option.selected = false; 
            tagDiv.remove(); 
        };
        tagDiv.appendChild(removeButton);
        selectedTagsContainer.appendChild(tagDiv);
    }

    Array.from(selectElement.selectedOptions).forEach(option => {
        addSelectedTag(option);
    });

    selectElement.addEventListener('change', function() {
        Array.from(this.selectedOptions).forEach(option => {
        
            if (!selectedTagsContainer.querySelector(`div[data-value="${option.value}"]`)) {
                addSelectedTag(option);
            }
        });
    });
});

  </script>

@endsection
