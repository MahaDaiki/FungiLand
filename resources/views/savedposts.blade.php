@include('layouts.nav')
@extends('layouts.app')
@section('title', 'My Saved Posts')

@section('content')
<div class="counter">
    <div class="row">
        <div class="col-6 col-lg-3">
            <div class="count-data text-center">
                <a href="{{ route('profile', ['userId' => $user->id]) }}"><img src="{{ asset('assets/images/files.png') }}" width="100" alt="posts"></a>
                <p class="m-0px font-w-600">My Posts</p>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="count-data text-center">
                <a href="{{ route('collections.index', ['user' => $user->id]) }}"><img src="{{ asset('assets/images/collections.png') }}" width="100" alt="collections"></a>
                <p class="m-0px font-w-600">My Collections</p>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="count-data text-center actives">
                <a href="{{ route('saved-posts.index', ['userid' => $user->id]) }}"><img src="{{ asset('assets/images/saved.png') }}" width="100" alt="saved"></a>
                <p class="m-0px font-w-600">Saved Posts</p>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="count-data text-center">
                <a href="{{ route('settings', ['user' => Auth::user()]) }}"><img src="{{ asset('assets/images/settings.png') }}" width="100" alt="settings"></a>
                <p class="m-0px font-w-600">Settings</p>
            </div>
        </div>
    </div>
</div>


@forelse ($savedposts as $post)
@include('layouts.errorhandle')
<div class="col-md-12 mb-4">
    <div class="panel blog-container">
        <div class="panel-body">
            <div class="image-wrapper">
                <a class="d-flex justify-content-center align-items-center pt-2" href="#">
                 
                    <img src="asset('{{ $post->image }}')" width="400" alt="Photo of Blog">
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