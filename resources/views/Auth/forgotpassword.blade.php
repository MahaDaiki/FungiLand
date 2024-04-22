@include('layouts.nav')
@extends('layouts.app')
@section('title', 'Welcome')

@section('content')

<div class="container">
    <form class="mt-5 forma p-4 ">
        @include('layouts.errorhandle')
        <h1 class="h4 mb-3 font-weight-normal text-center ">Forgot Password</h1>
        <div class="form-group ">
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control " placeholder="Enter your email" required autofocus name="email">
        </div>
        <button class="btn  btn-primary  text-center" type="submit">Reset Password</button>
    </form>
</div>
    
@endsection