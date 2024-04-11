
@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="logo-container mt-5">
                        <img src="assets/images/logo.png" alt="Logo" class="logo">
                    </div>
                    <!-- Login Form -->
                    <div class="card forma mb-3">
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control input" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control input" id="password" name="password" required>
                                </div>
                                <div class="ml-4">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                                    <label class="form-check-label" for="rememberMe">Remember Me</label>
                                </div>
                                <div class="form-group">
                                    <a href="">Forgot Password?</a>
                                </div>
                            </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn gradient"><span>Login</span> </button>
                                </div>
                                <div class="form-group text-center">
                                    <p>Don't have an account? <a href="{{ route('register') }}">Register NOW !</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
