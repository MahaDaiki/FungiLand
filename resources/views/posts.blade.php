@include('layouts.nav')
@extends('layouts.app')
@section('title', 'Welcome')

@section('content')
<div class="container bootstrap snippets bootdey">
    <div class="row">
        <h2 class="text h1">Welcome to our blog</h2>
        <hr>
    </div>
    <div>
        <form id="searchForm" class="mb-4 ml-2 p-2">
            @csrf
            <input type="text" name="search" placeholder="Search by title, category, or tag">
            <button type="submit" class="change mr-2 btn-primary">Search</button>
        </form>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <div class="searched"></div>
            <div class="allposts">
            @forelse ($posts as $post)
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
                        <div class="container mb-4">
                            <h4 class="text-center">{{ $post->title }}</h4>
                            <small class="text ml-4">By <a href="#"><strong>{{ $post->user->name }}</strong></a> | Post on {{ $post->created_at }} | {{ $post->category->name }}</small>
                            <p class="m-top-sm m-bottom-sm">
                                {{ $post->content }}
                            </p>
                           @foreach ($post->tags as $tag)
                                <a href="" class="ml-2 ">#{{ $tag->name }}</a>
                            @endforeach
                            <a href="#" class="float-right"><i class="fa fa-angle-double-right"></i> Continue reading</a>

                            <span class="post-like text-muted tooltip-test" data-toggle="tooltip" data-original-title="I like this post!">
                                <span class="like-count">{{ $post->likes->count() }}</span>
                                <button class="like-btn change like" data-post-id="{{ $post->id }}" data-url="{{ route('posts.like', $post) }}"><i class="fa fa-heart"></i></button>
                                <button class="unlike-btn change like" data-post-id="{{ $post->id }}" data-url="{{ route('posts.unlike', $post) }}" style="display: none;"><i class="fa fa-heart text-danger"></i></button>
                            </span>
                        </div>
                    </div>  
                </div>
            </div>
            @empty
            <h1>No Posts Found</h1>
            @endforelse
        </div>
    </div>
        
        <div class="col-md-4">
            <h4 class="headline text h2">
                POPULAR POST
                <span class="line"></span>
            </h4>
            <div class="media popular-post mb-2">
                <a class="pull-left" href="#">
                    <img src="" alt="Popular Post">
                </a>
                <div class="media-body mt-3 ml-1">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                </div>
            </div>  
        </div>    
    </div>
</div>
@endsection
