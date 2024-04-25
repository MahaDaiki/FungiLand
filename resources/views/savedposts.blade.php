@include('layouts.nav')
@extends('layouts.app')
@section('title', 'My Saved Posts')

@section('content')
@include('layouts.profilebar')

@include('layouts.errorhandle')
@forelse ($savedposts as $post)
@include('layouts.errorhandle')
<div class="col-md-12 mb-4">
    <div class="panel blog-container">
        <div class="panel-body">
            <div class="image-wrapper">
                <a class="d-flex justify-content-center align-items-center pt-2" href="#">
                 
                    <img src="/storage/{{ $post->image }}" width="400" alt="Photo of Blog">
                    <div class="image-overlay"></div> 
                </a>  
            
            </div>
            @if(auth()->check())
            <span class="post-save text-muted tooltip-test float-right fs-4 mr-2 mb-3" data-toggle="tooltip" data-original-title="Save this post!">
                <button class="remove-save-btn change save" data-post-id="{{ $post->id }}" data-save-url="{{ route('posts.save', $post) }}" data-unsave-url="{{ route('posts.unsave', $post) }}" style="background: none; border: none; padding: 0; "><i class="fa fa-bookmark text-warning"></i></button>
            </span>
        @endif
            <div class="container mb-4">
                <h4 class="text-center">{{ $post->title }}</h4>

                <small class="text ml-4">By <a href="#"><strong>{{ $post->user->name }}</strong></a> | Post on {{ $post->created_at }} |{{ $post->type }}|
              </small>
                <p class="m-top-sm m-bottom-sm">
                    {{ $post->content }}
                </p>
              
                <a href="#" class="float-right"><i class="fa fa-angle-double-right"></i> Continue reading</a>

              
            
            
            </div>
        </div>  
    </div>
</div>
@empty
<h1>No Posts Found</h1>
@endforelse
</div>
</div>
@endsection