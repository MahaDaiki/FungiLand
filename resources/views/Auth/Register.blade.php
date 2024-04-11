@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="logo-container mt-5">
                <img src="assets/images/logo.png" alt="Logo" class="logo">
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong> Validation Error!</strong>
                    <ul>
                        @foreach ($errors->all() as $error )
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session()->has('success'))
                <div class="alert alert-success mt-4">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger mt-4">
                    {{ session()->get('error') }}
                </div>
            @endif
            <!-- Registration Form -->
            <div class="card forma mb-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control input @error('name') is-invalid @enderror" id="username" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control input @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control input @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" class="form-control input" id="confirmPassword" name="password_confirmation" required>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn gradient"><span>Register</span></button>
                        </div>
                        <div class="form-group text-center">
                            <p>Already have an account? <a href="{{ route('login') }}">Login Now!</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
