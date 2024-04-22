@include('layouts.nav')
@extends('layouts.app')
@section('title', 'Welcome')

@section('content')

<div class="container">
    <form class="mt-5">
        <h1 class="h3 mb-3 font-weight-normal">Forgot Password</h1>
        <div class="form-group forma">
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Enter your email" required autofocus name="email">
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Reset Password</button>
    </form>
</div>
    
@endsection