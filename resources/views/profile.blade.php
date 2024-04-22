@include('layouts.nav')
@extends('layouts.app')
@section('title', 'profile')


@section('content')
<section class="section about-section gray-bg" id="about">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-lg-6">
                <div class="about-text go-to">
                    <h3 class="dark-color">{{ $user->name }}</h3>
                    <h6 class="theme-color lead">{{ $user->description }}</p>
                    <div class="row about-list">
                        <div class="col-md-6">
                            {{-- <div class="media">
                                <label>Birthday</label>
                                <p>4th april 1998</p>
                            </div> --}}
                        </div>
                        <div class="col-md-6">
                            <div class="media">
                                <label>E-mail</label>
                                <p>{{ $user->email }}</p>
                            </div>
                          

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-avatar ml-3" id="image-with-border">
                    <div class="profile-container">
                        <img src="{{ $user->profilepic }}" class="profile-pic" alt="profile picture" />
                        <div class="profile-border"></div>
                      </div>
                </div>
            </div>
            
        </div>
        <div class="counter">
            <div class="row ">
                <div class="col-6 col-lg-3">
                    <div class="count-data text-center  ">
                        <a href="{{ '/profile' }}"><img src="assets/images/files.png" width="100" alt="posts"></a>
                        <p class="m-0px font-w-600">My Posts</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                        <a href=""><img src="assets/images/collections.png" width="100" alt="posts"></a>
                        <p class="m-0px font-w-600">My collections</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                        <a href=""><img src="assets/images/saved.png" width="100" alt="posts"></a>
                        <p class="m-0px font-w-600">Saved Posts</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                        <a href=""><img src="assets/images/settings.png" width="100" alt="posts"></a>
                        <p class="m-0px font-w-600">Settings</p>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</section>
@include('layouts.errorhandle')
<div class="container">
@forelse ($posts as $post)

<div class="row">
    <!-- Middle main post -->
    <div class="col-md-8">
        <div class="panel blog-container">
            <div class="panel-body">
                <div class="image-wrapper">
                    <a class="" href="#">
                        <img src="{{ $post->image }}" alt="Photo of Blog">
                        <div class="image-overlay"></div>
                    </a>
                </div>
                <div class="container mb-4">
                    <h4 class="text-center">{{ $post->title }}</h4>
                    <small class="text ml-4">By <a href="#"><strong> {{ $post->user->name }}</strong></a> | Post on {{ $post->created_at }}| 58 comments</small>

                    <p class="m-top-sm m-bottom-sm">
                      {{ $post->content }}
                    </p>
                    <a href="#"><i class="fa fa-angle-double-right"></i> Continue reading</a>

                    <span class="post-like text-muted tooltip-test" data-toggle="tooltip" data-original-title="I like this post!">
                        <i class="fa fa-heart"></i> <span class="like-count">25</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
       
        <div class="card mb-4 forma">
            <div class="card-body">
                <h5 class="card-title">Total Posts</h5>
                <p class="card-text">123</p>
            </div>
        </div>
        <div class="card mb-4 forma">
            <div class="card-body">
                <h5 class="card-title">Total likes on posts</h5>
                <p class="card-text">7272</p>
            </div>
        </div>
        <div class="card mb-4 forma">
            <div class="card-body">
                <h5 class="card-title">Post saved</h5>
                <p class="card-text">33</p>
            </div>
        </div>
        <div class="card mb-4 forma">
            <div class="card-body">
                <h5 class="card-title">Total Comments on posts </h5>
                <p class="card-text">??</p>
            </div>
        </div>
      
    </div>
</div>
@empty
    
@endforelse


</div>
@endsection
