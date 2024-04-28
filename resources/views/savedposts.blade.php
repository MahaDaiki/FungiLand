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
        @if(auth()->check() && auth()->user()->id === $user->id)
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
        @endif
    </div>
</div>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @forelse ($posts as $post)
            @include('layouts.errorhandle')
            <div class="col-md-12 mb-4">
                <div class="panel blog-container">
                    <div class="panel-body">
                        <div class="image-wrapper">
                            <a class="d-flex justify-content-center align-items-center pt-2" href="#">
                                <img src="/storage/{{ $post->image  }}" width="400" alt="Photo of Blog">
                                <div class="image-overlay"></div> 
                            </a>
                        </div>
                        <div class="p-5">
                            <h4 class="text-center">{{ $post->title }}</h4>
                            <small class="text ml-4">By <a href="#"><strong>{{ $post->user->name }}</strong></a> | Post on {{ $post->created_at }} | {{ $post->type }}</small>
                            <p class="m-top-sm m-bottom-sm">
                                {{ $post->content }}
                            </p>
                            <form action="{{ route('savedposts.remove', $post->id) }}" method="POST" class="float-right">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="change btn-danger">X</button>
                            </form>
                            <a href="{{ route('postdetails', $post) }}" class="float-right "><img src="{{ asset('assets/images/comments.png') }}" width="70" alt="Continue Reading"></a>
                        </div>
                    </div>  
                </div>
            </div>
            @empty
                <h1>No Posts Found</h1>
            @endforelse

@endsection