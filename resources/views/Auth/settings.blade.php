@include('layouts.nav')
@extends('layouts.app')
@section('title', 'My Settings')

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
            <div class="count-data text-center">
                <a href="{{ route('saved-posts.index', ['userid' => $user->id]) }}"><img src="{{ asset('assets/images/saved.png') }}" width="100" alt="saved"></a>
                <p class="m-0px font-w-600">Saved Posts</p>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="count-data text-center actives">
                <a href="{{ route('settings', ['user' => Auth::user()]) }}"><img src="{{ asset('assets/images/settings.png') }}" width="100" alt="settings"></a>
                <p class="m-0px font-w-600">Settings</p>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="text-center">
                <img src="/storage/{{ $user->profilepic}}" class="rounded-circle img-fluid" alt="Profile Picture" style="width: 200px; height: 200px;">
                <h3 class="red h2">{{ $user->name }}</h3>
                <p class="fs-4">My Email: {{ $user->email }}</p>
                <p class="fs-5">Description: {{ $user->description }}</p>
            </div>
        </div>
        <div class="col-md-7 offset-md-1">
            <h2 class="text-center red">Edit Profile Settings</h2>
            <form action="{{ route('usersupdate', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data" class="shadow p-2">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="bi bi-person"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                </div>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="profile_picture" class="d-block text-center">
                            <div class="profile-picture change">
                                <img src="{{ asset('assets/images/icon.jpg') }}" alt="Profile Picture Icon">
                            </div>
                            <input type="file" class="d-none change" id="profile_picture" name="image">
                        </label>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Description</label>
                        <textarea class="form-control pb-5" id="description" name="description">{{ $user->description }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="change text-dark mb-2 mt-2 btn-primary">Save Changes</button>
                    </div>
                </div>
            </form>
            <hr>
            <h2 class="mt-5 text-center red">Change Password</h2>
            <form action="{{ route('updatePassword', ['user' => $user->id]) }}" method="POST" class="shadow mb-4 p-2">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="bi bi-lock"></i>
                            </span>
                        </div>
                        <input type="password" class="form-control password-input" id="current_password" name="current_password" required>
                        <div class="input-group-append">
                            <span class="input-group-text toggle-password">
                                <i class="bi bi-eye"></i>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="new_password">New Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="bi bi-lock"></i>
                                </span>
                            </div>
                            <input type="password" class="form-control password-input" id="new_password" name="new_password" required>
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password">
                                    <i class="bi bi-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="confirm_password">Confirm Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="bi bi-lock"></i>
                                </span>
                            </div>
                            <input type="password" class="form-control password-input" id="confirm_password" name="confirm_password" required>
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password">
                                    <i class="bi bi-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="change mb-2 mt-2 text-dark btn-primary">Change Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
