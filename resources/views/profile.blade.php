@include('layouts.nav')
@extends('layouts.app')
@section('title', 'profile')


@section('content')
<section class="section about-section " id="about">
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
        @include('layouts.profilebar')
    </div> 
</section>
<div class="container ">
    <a class="float-right" href="{{ '/create' }}"><img src="assets/images/add2.png" width="70" alt="+"></a>
</div>
@include('layouts.errorhandle')

    @forelse ($posts as $post)
<div class="container">
<div class="row">
    <div class="col-md-8">
        <div class=" text-right m-3">
                <a href="{{ route('posts.edit', $post->id) }}" class=" change rounded-pill shadow"><img src="assets/images/edit.jpg" width="60" class="rounded-pill shadow" alt="edit"></a>
                <button class="btn-danger change rounded-pill shadow" data-toggle="modal" data-target="#deleteModal{{ $post->id }}">Delete</button>
            </div> 
        <div class="panel blog-container">
            
            <div class="panel-body">
                <div class="d-flex justify-content-center align-items-center">
                    <a class="" href="#">
                        <img src="/storage/{{ $post->image }}" width='200' class="img-fluid" alt="Photo">
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


</div>
@endsection
