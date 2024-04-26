@include('layouts.nav')

@extends('layouts.app')

@section('title', 'Post Details')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="row mb-3">
                <div class="col-md-12 m-2">
                    <img src="{{ asset('assets/images/left1.png') }}" class="img-fluid post-image" alt="Left Image 1">
                </div>
                <div class="col-md-12 m-2">
                    <img src="{{ asset('assets/images/left2.png') }}" class="img-fluid post-image" alt="Left Image 2">
                </div>
                <div class="col-md-12 m-2">
                    <img src="{{ asset('assets/images/left3.png') }}" class="img-fluid post-image" alt="Left Image 3">
                </div>
                <div class="col-md-12 m-2">
                    <img src="{{ asset('assets/images/left4.png') }}" class="img-fluid post-image" alt="Left Image 4">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-img-top d-flex justify-content-center align-items-center pt-2">
                    <img src="/storage/{{ $post->image }}" width="400" alt="Photo of Blog">
                </div>
                <div class="card-header text-center">
                    <h2 class="card-title">{{ $post->title }}</h2>
                </div>
                <div class="card-body">
                    <p class="card-text" id="postContent">{{ $post->content }}</p>
                </div>
                <div class="card-footer">
                    <small class="text ml-4">By <a href="{{ route('profile', ['userId' => $post->user->id ]) }}"><strong>{{ $post->user->name }}</strong></a> | Post on {{ $post->created_at }} | {{ $post->type }}</small>
                    <h5 class="float-right">{{ $post->category->name }}</h5>
                    <div>
                        @foreach ($post->tags as $tag)
                        <a href="#" class="ml-2">#{{ $tag->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <hr>
            <div class="mt-4 shadow p-2">
                <h3>Comments</h3>
                @include('layouts.errorhandle')
               
                @foreach($post->comments as $comment)
                 <div class="card commentcard">
                    <div class="card-body shadow ">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle overflow-hidden mr-2 shadow" style="width: 24px; height: 24px;">
                                <img src="{{ $comment->user->profilepic }}" alt="User Profile Picture" class="w-100 h-100">
                            </div>
                            <h3> {{ $comment->user->name }}: </h3>
                            <p class="card-text fs-5"> &nbsp; {{ $comment->content }}</p>
                        </div>
                        @if(auth()->check() && auth()->user()->id === $comment->user_id)
                        <form action="{{ route('comments.update', ['post' => $post, 'comment' => $comment]) }}" method="POST" style="display: none;" class="edit-comment-form">
                            @csrf
                            @method('PUT')
                            <textarea class="form-control" name="content" rows="3"> {{ $comment->content }}</textarea>
                            
                            <button type="submit" class="text-dark  change btn-sm btn-primary">Save</button>
                        </form>
                        <button class=" btn-secondary float-right change edit-comment-btn">Edit</button>
                        <form action="{{ route('comments.destroy', ['post' => $post, 'comment' => $comment]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="change btn-danger float-right">Delete</button>
                        </form>
                        @endif
                    </div>
                </div>
                <hr>
            @endforeach
            
            </div>

            <form action="{{ route('comments.store', ['post' => $post]) }}" method="POST">
                @csrf
                <div class="mb-3 row">
                    <label for="commentContent" class="form-label">Add your comment:</label>
                <div class="col-md-10">
                    <textarea class="form-control shadow" id="commentContent" name="content" rows="3"></textarea>
                </div>
                    <div class="col-md-2">
                        <button type="submit" class="text-dark change btn-primary">Submit</button>
                    </div>
            </div>
            </form>
        </div>

        <div class="col-md-3">
            <div class="row mb-3">
                <div class="col-md-12 m-2">
                    <img src="{{ asset('assets/images/right1.png') }}" class="img-fluid post-image" alt="Right Image 1">
                </div>
                <div class="col-md-12 m-2">
                    <img src="{{ asset('assets/images/right2.png') }}" class="img-fluid post-image" alt="Right Image 2">
                </div>
                <div class="col-md-12 m-2">
                    <img src="{{ asset('assets/images/right3.png') }}" class="img-fluid post-image" alt="Right Image 3">
                </div>
                <div class="col-md-12 m-2">
                    <img src="{{ asset('assets/images/right4.png') }}" class="img-fluid post-image" alt="Right Image 4">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
