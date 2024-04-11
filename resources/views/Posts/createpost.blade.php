@include('layouts.nav')
@extends('layouts.app')
@section('title', 'Add Post')

@section('content')

</head>
<body>

  <div class="container mt-5 ">
    <div class="row">
      <div class="col-md-8 ">
        <div class="forma p-3">
        <h2 class="mb-4 text-center">Create Post</h2>
        <form action="" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="postType">Type</label>
            <select class="form-control " style="width: 50%" id="postType" name="type">
              <option value="article">Article</option>
              <option value="question">Question</option>
            </select>
             <div class="form-group">
            <label for="postImage">Image</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="postImage" name="image">
              <label class="custom-file-label" for="postImage">Choose file</label>
            </div>
          </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="postCategory">Category</label>
              <select class="form-control" id="postCategory" name="category_id">
                @foreach($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="postTags">Tags</label>
              <select class="form-control" id="postTags" name="tag_ids[]" multiple>
                @foreach($tags as $tag)
                  <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="postTitle">Title</label>
            <input type="text" class="form-control" id="postTitle" name="title" placeholder="Enter title">
          </div>
          <div class="form-group">
            <label for="postContent">Content</label>
            <textarea class="form-control" id="postContent" name="content" rows="6" placeholder="Enter content"></textarea>
          </div>
         
          <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
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
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectElement = document.getElementById('postTags');
        const selectedTagsContainer = document.getElementById('selectedTagsContainer');
  
        selectElement.addEventListener('change', function() {
            selectedTagsContainer.innerHTML = '';
  
            Array.from(this.selectedOptions).forEach(option => {
                const tagDiv = document.createElement('div');
                tagDiv.textContent = option.text;
                const removeButton = document.createElement('button');
                removeButton.textContent = 'Remove';
                removeButton.onclick = function() {
                    option.selected = false;
                    tagDiv.remove();
                };
                tagDiv.appendChild(removeButton);
                selectedTagsContainer.appendChild(tagDiv);
            });
        });
    });
  </script>
@endsection