@extends('layouts.app')
@section('title', 'profile')
@include('layouts.nav')
@section('content')
<section class="section about-section " id="about">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-lg-6">
                <div class="about-text go-to">
                    <h3 class="dark-color">{{ $user->name }}</h3>
                    <h6 class="theme-color lead">{{ $user->description }}</h6>
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
                     
                        <div class="col-md-6">
                            <div class="media">
                                @auth 
                                @if(auth()->user()->role === 'admin')
                                <label><img src="{{ asset('assets/images/admindash.png') }}" width="50" alt="" class=""></label>
                                
                  
                        <a href="{{ route('admin.index') }}" class="p-2 shadow change btn-primary">Admin Panel</a>
                    @endif
                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-avatar ml-3" id="image-with-border">
                    <div class="profile-container">
                        <img src="{{ asset($user->profilepic) }}" class="profile-pic" alt="profile picture" />
                        <div class="profile-border"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="counter">
            <div class="row">
                <div class="col-6 col-lg-3">
                    <div class="count-data text-center actives">
                        <a href="{{ route('profile', ['userId' => $user->id]) }}"><img src="{{ asset('assets/images/files.png') }}" width="100" alt="posts"></a>
                        <p class="m-0px font-w-600">My Posts</p>
                    </div>
                </div>
             
                <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                        <a href="{{ route('collections.index', ['user' => $user->id]) }}"><img src="{{ asset('assets/images/collections.png') }}" width="100" alt="collections"></a>
                        <p class="m-0px font-w-600"> Collections</p>
                    </div>
                </div>
                @if(auth()->check() && auth()->user()->id === $user->id)
                <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
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
                @endif
            </div>
        </div>
        
    </div>
</section>
<div class="container ">
    @if(auth()->check() && auth()->user()->id === $user->id)
    <a class="float-right" href="{{ '/create' }}"><img src="{{ asset('assets/images/add2.png') }}" width="70" alt="+"></a>
    @endif
</div>
@include('layouts.errorhandle')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            @forelse ($posts as $post)
            @if(auth()->check() && auth()->user()->id === $post->user_id)
            <div class="text-right m-3">
                <a href="{{ route('posts.edit', $post->id) }}" class="change rounded-pill shadow"><img src="{{ asset('assets/images/edit.jpg') }}" width="60" class="rounded-pill shadow" alt="edit"></a>
                <button class="btn-danger change rounded-pill shadow" data-toggle="modal" data-target="#deleteModal{{ $post->id }}">Delete</button>
            </div>
            @endif
            <div class="panel blog-container">
                <div class="panel-body">
                    <div class="d-flex justify-content-center align-items-center">
                        <a class="" href="#">
                            <img src="{{ asset('storage/'.$post->image) }}" width='200' class="img-fluid" alt="Photo">
                            <div class="image-overlay"></div>
                        </a>
                    </div>
                    <div class="container mb-4 p-5">
                        <h4 class="text-center">{{ $post->title }}</h4>
                        <small class="text ml-4">By <a href="#"><strong> {{ $post->user->name }}</strong></a> | Post on {{ $post->created_at }}</small>
                        <p class="m-top-sm m-bottom-sm">
                            {{ $post->content }}
                        </p>
                        <div class="mb-5">
                        <a href="{{ route('postdetails', $post) }}"class="float-right"><img src="{{ asset('assets/images/comments.png') }}" width="70" alt="Continue Reading"></a></div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $post->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content forma">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel{{ $post->id }}">Confirm Deletion</h5>
                            <button type="button" class="close change" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">X</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            Are you sure you want to delete this post?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary change" data-dismiss="modal">Cancel</button>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <h1>No Posts</h1>
            @endforelse
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card  forma">
                        <div class="card-body">
                            <h5 class="card-title">Total Posts</h5>
                            <p class="card-text"> <img src="{{ asset('assets/images/stats.png') }}" alt="" width="70"> {{ $totalPosts }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-4 forma">
                        <div class="card-body">
                            <h5 class="card-title">Total likes on my posts</h5>
                            <p class="card-text"><img src="{{ asset('assets/images/stats.png') }}" alt="" width="70">{{ $totalLikes }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-4 forma">
                        <div class="card-body">
                            <h5 class="card-title">Total saved</h5>
                            <p class="card-text"><img src="{{ asset('assets/images/stats.png') }}" alt="" width="70">{{ $totalSaved }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-4 forma">
                        <div class="card-body">
                            <h5 class="card-title">Total Comments on my posts </h5>
                            <p class="card-text"><img src="{{ asset('assets/images/stats.png') }}" alt="" width="70">{{ $totalComments }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection
