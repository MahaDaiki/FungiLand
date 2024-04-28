@include('layouts.nav')
@extends('layouts.app')
@section('title', 'Welcome')

@section('content')
<div class="container bootstrap snippets bootdey">
    <div class="row">
        <h2 class="text h1">Welcome to FungiLand</h2>
        <hr>
    </div>
    <div class="container">
        <div class="row">
            <form id="searchForm" class="mb-4 ml-2 shadow ">
                @csrf
                <div class="form-row align-items-end m-5">
                    <div class="col">
                        <input type="text" class="form-control shadow" name="search" placeholder="Search by title, category, or tag">
                    </div>
                    <div class="col">
                        <select class="form-control shadow" name="post_type">
                            <option value="">All Types</option>
                            <option value="article">Article</option>
                            <option value="question">Question</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="change text-dark btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
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
                       @include("layouts.savebutton")
                    
                    
                    
                    
                        <div class="container mb-4 p-5">
                            <h1 class="text-center">{{ $post->title }}</h1>

                            <small class="text ml-4">By <a href="{{ route('profile', ['userId' => $post->user->id ]) }}"><strong>{{ $post->user->name }}</strong></a> | Post on {{ $post->created_at }} |{{ $post->type }}|
                                 {{ $post->category->name }}</small>
                            <p class="fs-4">
                                {{ $post->content }}
                            </p>
                           @foreach ($post->tags as $tag)
                                <a href="" class="ml-2 ">#{{ $tag->name }}</a>
                            @endforeach
                            <a href="{{ route('postdetails', $post) }}"class="float-right mb-5"><img src="{{ asset('assets/images/comments.png') }}" width="70" alt="Continue Reading"></a>

                            @if(auth()->check())
                            @if($post->likes->contains('user_id', auth()->user()->id))
                                <span class="post-like text-muted tooltip-test" data-toggle="tooltip" data-original-title="You liked this post!">
                                    <span class="like-count">{{ $post->likes->count() }}</span>
                                    <button class="unlike-btn change like" data-post-id="{{ $post->id }}" data-url="{{ route('posts.unlike', $post) }}"><i class="fa fa-heart text-danger"></i></button>
                                    <button class="like-btn change like" data-post-id="{{$post->id }}" data-url="{{ route('posts.like', $post) }}" style="display: none;"><i class="fa fa-heart"></i></button>
                                </span>
                            @else
                                <span class="post-like text-muted tooltip-test" data-toggle="tooltip" data-original-title="Like this post!">
                                    <span class="like-count">{{ $post->likes->count() }}</span>
                                    <button class="like-btn change like" data-post-id="{{ $post->id }}" data-url="{{ route('posts.like', $post) }}"><i class="fa fa-heart"></i></button>
                                    <button class="unlike-btn change like" data-post-id="{{ $post->id }}" data-url="{{ route('posts.unlike', $post) }}" style="display: none;"><i class="fa fa-heart text-danger"></i></button>
                                </span>
                            @endif
                       
                               
                           
                        @endif
                        
                        
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
           Popular Tags
                <span class="line"></span>
            </h4>
            <div class="media popular-post mb-2">
                <div class="media-body mt-3 ml-1">
                    <ul class="custom-list">
                        @foreach ($mosttags as $tags)
                            <li class="fs-5"> <img src="/assets/images/pops.png" width="40" alt="->"> #{{ $tags->name }}</li>
                        @endforeach
                    </ul>
                        <h4 class="headline text h2">
                       Popular categories
                            <span class="line"></span>
                        </h4>
                        <div class="media popular-post mb-2">
                            <div class="media-body mt-3 ml-1">
                                <ul class="custom-list">
                                 @foreach ($mostcategories as $cats)
                                    <li class="fs-5"> <img src="/assets/images/pops.png" width="40" alt="->"> {{ $cats->name }}</li>
                                 @endforeach
                                 </ul>
                            </div>
                        </div>  
                    </div> 
                    
                </div>
            </div>  
        </div>    

    </div>
</div>
@include('layouts.footer')
@endsection
