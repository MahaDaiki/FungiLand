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
                            <div class="media">
                                <label>Birthday</label>
                                <p>4th april 1998</p>
                            </div>
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
                <div class="about-avatar" id="image-with-border">
                    <img src="{{ $user->profilepic }}" class="" title="" alt="profile pic">
                </div>
            </div>
            
        </div>
        <div class="counter">
            <div class="row">
                <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                        <h6 class="count h2" data-to="500" data-speed="500">500</h6>
                        <p class="m-0px font-w-600">Happy Clients</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                        <h6 class="count h2" data-to="150" data-speed="150">150</h6>
                        <p class="m-0px font-w-600">Project Completed</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                        <h6 class="count h2" data-to="850" data-speed="850">850</h6>
                        <p class="m-0px font-w-600">Photo Capture</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                        <h6 class="count h2" data-to="190" data-speed="190">190</h6>
                        <p class="m-0px font-w-600">Telephonic Talk</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>
@forelse ($posts as $post)
<div class="">
    <div class="row">
        <!-- Left side pictures -->
        <div class="col-md-2">
            <!-- Picture 1 -->
            <div class="image-wrapper mb-4">
                <img src="{{ asset('assets/images/left2.png') }}" style="height: 300px; width: 100%;" alt="Photo 1">
                <div class="image-overlay"></div>
            </div>
            <!-- Picture 2 -->
            {{-- <div class="image-wrapper">
                <a class="image-wrapper image-zoom cboxElement" href="#">
                    <img src="{{ asset('assets/images/left4.png') }}" style="height: 300px; width: 100%;" alt="Photo 2">
                    <div class="image-overlay"></div>
                </a>
            </div>
            <!-- Picture 3 -->
            <div class="image-wrapper">
                <a class="image-wrapper image-zoom cboxElement" href="#">
                    <img src="{{ asset('assets/images/left3.png') }}" style="height: 300px; width: 100%;" alt="Photo 3">
                    <div class="image-overlay"></div>
                </a>
            </div> --}}
            <!-- Picture 4 -->
            <div class="image-wrapper">
                <a class="image-wrapper image-zoom cboxElement" href="#">
                    <img src="{{ asset('assets/images/left1.png') }}" style="height: 300px; width: 100%;" alt="Photo 4">
                    <div class="image-overlay"></div>
                </a>
            </div>
        </div>

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

    

        <!-- Right side pictures -->
        <div class="col-md-2">
            <!-- Picture 1 -->
            <div class="image-wrapper mb-4">
                <a class="image-wrapper image-zoom cboxElement" href="#">
                    <img src="{{ asset('assets/images/right2.png') }}" style="height: 300px; width: 100%;" alt="Photo 5">
                    <div class="image-overlay"></div>
                </a>
            </div>
            <!-- Picture 2 -->
            {{-- <div class="image-wrapper">
                <a class="image-wrapper image-zoom cboxElement" href="#">
                    <img src="{{ asset('assets/images/right4.png') }}" style="height: 300px; width: 100%;" alt="Photo 6">
                    <div class="image-overlay"></div>
                </a>
            </div>
            <!-- Picture 3 -->
            <div class="image-wrapper">
                <a class="image-wrapper image-zoom cboxElement" href="#">
                    <img src="{{ asset('assets/images/right3.png') }}" style="height: 300px; width: 100%;" alt="Photo 7">
                    <div class="image-overlay"></div>
                </a>
            </div> --}}
            <!-- Picture 4 -->
            <div class="image-wrapper">
                <a class="image-wrapper image-zoom cboxElement" href="#">
                    <img src="{{ asset('assets/images/right1.png') }}" style="height: 300px; width: 100%;" alt="Photo 8">
                    <div class="image-overlay"></div>
                </a>
            </div>
        </div>
    </div>
</div>
@empty
    
@endforelse


@endsection