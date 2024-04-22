@include('layouts.nav')
@extends('layouts.app')
@section('title', 'Welcome')

@section('content')
<div class="container">
    <form class="mt-5" action="{{ route('post_reset', $token) }}" method="POST">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal">Reset Password</h1>
        <div class="form-group">
            <label for="inputPassword" class="sr-only">New Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Enter new password" required autofocus name="password">
        </div>
        <div class="form-group">
            <label for="inputConfirmPassword" class="sr-only">Confirm Password</label>
            <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Confirm new password" required name="confirm_password">
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Reset Password</button>
    </form>
</div>
</body>
@endsection