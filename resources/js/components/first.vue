<script setup>

</script>
<template>

    <header class="site-header">
      <div class="header-bar">
          <div class="container-fluid">
              <div class="row align-items-center">
                  <div class="col-10 col-lg-2 order-lg-1">
                      <div class="site-branding">
                          <div class="site-title">
                              <a href=""><img src="{{ asset('assets/images/logo.png')}}" alt="logo"></a>
                          </div>
                      </div>
                  </div>
  
                  <div class="col-2 col-lg-7 order-3 order-lg-2">
                      <nav class="site-navigation">
                          <div class="hamburger-menu d-lg-none">
                              <span></span>
                              <span></span>
                              <span></span>
                              <span></span>
                          </div><!-- .hamburger-menu -->
  
                          <ul>
                              <li><a href="">Home</a></li>
                              <!-- @if (Route::has('login'))
                              @auth
                              <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                              <li> <form method="POST" action="{{ route('logout') }}">
                                  @csrf
                               <button type="submit" class="btn gradient-bg ml-5">logout</button>
                              </form></li>
                              @else
                              <li><a href="{{ route('login') }}">Login</a></li>
                              @if (Route::has('register'))
                              <li><a href="{{ route('register') }}">register</a></li>
                              @endif
                            
                              @endauth
                          @endif -->
                          </ul>
                      </nav>
                  </div>
  
                  <div class="col-lg-3 d-none d-lg-block order-2 order-lg-3">
                      <div class="buy-tickets">
                          <a class="btn gradient-bg" href="">Events</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
 </header>
</template>