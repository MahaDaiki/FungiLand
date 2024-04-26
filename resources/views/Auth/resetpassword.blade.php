@include('layouts.nav')
@extends('layouts.app')
@section('title', 'Welcome')

@section('content')
<div class="container text-center">
    @include('layouts.errorhandle')
    <h1 class="h3 mb-3 font-weight-normal">Reset Password</h1>
    <div class="forma p-3  col-8 mx-auto mb-3">
    <form class="mt-5" action="{{ route('post_reset', ['token' => $token])  }}" method="POST" class=" text-center">
        @csrf
        
        <input class="hidden" type="text" hidden value="{{ $token }}" name="token">
        <div class="form-group col-10 mx-auto">
            <label for="email" class="sr-only">Your Email</label>
            <input type="email" id="inputEmail" class="form-control " placeholder="..."  autofocus name="email">
        </div>
        <div class="form-group col-10 mx-auto">
            <label for="inputPassword" class="text-dark">New Password</label>
            <input type="password" id="inputPassword" class="form-control " placeholder="Enter new password"  autofocus name="password">
        </div>
        <div class="form-group col-10 mx-auto">
            <input type="password" id="inputConfirmPassword" class="form-control text-dark" placeholder="Confirm new password" name="confirmpassword">
        </div>
        <button class=" change btn-primary text-dark fs-3" type="submit">Reset Password</button>
    </form>
</div>
</div>
</body>
@endsection