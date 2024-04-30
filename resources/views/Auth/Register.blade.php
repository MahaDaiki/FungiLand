@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="logo-container mt-5 text-center">
                <a class=" " href="{{ '/' }}"><img class="logo2 logo " src="assets/images/logo.png" alt="Logo" >
                </a>
                
            </div>
          
            <!-- Registration Form -->
            <div class="card forma mb-5">
                
                <div class="card-body col-10 mx-auto mt-4">
                    @include('layouts.errorhandle')
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="profile_picture" class="d-block text-center">
                                    <div class="profile-picture">
                                        <img src="assets/images/icon.jpg" alt="Profile Picture Icon">
                                    </div>
                                    <input type="file" class="d-none" id="profile_picture" name="profilepic">
                                </label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mt-4">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control input @error('name') is-invalid @enderror" id="username" name="name" placeholder="Name" value="{{ old('name') }}" >
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control input @error('email') is-invalid @enderror" id="email" placeholder="example@email.com" name="email" value="{{ old('email') }}" >
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            
                            <label for="password">Password</label>
                            <div class="row">
                                <div class="col">
                                  <div class="input-group">
                                    <input type="password" class="form-control password-input input @error('password') is-invalid @enderror" id="password" name="password">
                                    <div class="input-group-append">
                                      <span class="input-group-text toggle-password">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                              </div>                              
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <div class="row">
                                <div class="col">
                                  <div class="input-group">
                            <input type="password" class="form-control password-input input" id="confirmPassword" name="password_confirmation" >
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password">
                                  <i class="fa fa-eye" aria-hidden="true"></i>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>                
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn gradient">   <img width="50" class="mr-3 spin" src="assets/images/button.png" alt=""><span>Register</span></button>
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
