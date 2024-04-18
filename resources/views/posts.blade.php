@include('layouts.nav')
@extends('layouts.app')
@section('title', 'Welcome')

@section('content')
<div class="container bootstrap snippets bootdey">
    <div class="row">
        <h2 class="text h1">Welcome to our blog</h2>
        <hr>
    </div>
    <div class="row">
        @include('layouts.errorhandle')
        <div class="col-md-8 mb-4">
            <div class="panel blog-container">
                <div class="panel-body">
                    <div class="image-wrapper">
                        <a class="image-wrapper image-zoom cboxElement" href="#">
                            <img src="https://www.bootdey.com/image/700x250/00CED1/000000" alt="Photo of Blog">
                            <div class="image-overlay"></div> 
                        </a>
                    </div>
                    <div class="container mb-4">
                        <h4 class="text-center">Bootstrap 3.0</h4>
                        <small class="text ml-4">By <a href="#"><strong> John Doe</strong></a> |  Post on Jan 8, 2013  | 58 comments</small>
                        
                        <p class="m-top-sm m-bottom-sm">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eros nibh, viverra a dui a, gravida varius velit. Nunc vel tempor nisi. Aenean id pellentesque mi, non placerat mi. Integer luctus accumsan tellus. Vivamus quis elit sit amet nibh lacinia suscipit eu quis purus. Vivamus tristique est non ipsum dapibus lacinia sed nec metus.
                        </p>
                        <a href="#"><i class="fa fa-angle-double-right"></i> Continue reading</a>
                        
                        <span class="post-like text-muted tooltip-test" data-toggle="tooltip" data-original-title="I like this post!">
                            <i class="fa fa-heart"></i> <span class="like-count">25</span>
                        </span>
                    </div>
                </div>  
            </div>
        </div>
        
{{-- categories here --}}
        <div class="col-md-4">
            <h4 class="headline text h2">
                POPULAR POST
                <span class="line"></span>
            </h4>
            <div class="media popular-post mb-2">
                <a class="pull-left" href="#">
                    <img src="https://www.bootdey.com/image/60x60/9400D3/000000" alt="Popular Post">
                </a>
                <div class="media-body mt-3 ml-1">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                </div>
            </div>  
        </div>    
    </div>
</div>
@endsection
