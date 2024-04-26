@include('layouts.nav')
@extends('layouts.app')
@section('title', 'Welcome')

@section('content')

<div class="container  text-center">
    <h1 class="h4 mb-3 font-weight-normal text-center fs-2 ">A link will be sent to your Email Address</h1>
    <div class="forma p-3  col-8 mx-auto mb-3">
    <form class="mt-5  p-4 " method="POST" action="{{ route('forgotpassword') }}">
        @csrf
        @include('layouts.errorhandle')
        
        <div class="form-group ">
            <label for="inputEmail" class="sr-only">Email </label>
            <input type="email" id="inputEmail" class="form-control " placeholder="Enter your email" required autofocus name="email">
        </div>
        <button class="  btn-primary  text-dark fs-3 change text-center" type="submit">Reset Password</button>
    </form>
</div>
</div>
    
@endsection