<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://unpkg.com/bootstrap-icons@1.7.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- @vite(['resources/js/app.js']) --}}
</head>
<body>    
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="{{ '/' }}">
          <img src="assets/images/logo.png" width="100" height="100" class="d-inline-block align-top" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span ><img src="assets/images/button.png"  width="100" height="100" alt=""></span>
          
        </button>
        
        <div class="collapse navbar-collapse site-navigation" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active ">
              <a class="nav-link" href="{{ '/posts' }}">Posts</a>
            </li>
         
            <li class="nav-item">
              <a class="nav-link" href="{{ '/create' }}">+</a>
            </li> 
           @auth
            <li class="nav-item">
              <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="btn gradient ml-2">Logout</button>
              </form>
          </li> 
            <a href="{{ '/profile'}}">
            <button class="btn gradient ml-5 float-right my-2 my-sm-0" type="button">   <img width="40" class="mr-3 spin" src="assets/images/button.png" alt="">Profile</button></a>
          @else
          <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">Register</a>
          </li>
     
         
          </ul>
              @endauth
        </div>
        </nav>
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>