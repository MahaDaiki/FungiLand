<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css')}}">    
    <title>Document</title>
</head>
<body>
    <div id="wrapper">

        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
     
          </div>
          <ul class="sidebar-nav">
            <li class="">
              <a href="{{ '/admin' }}"><i class="fa fa-home"></i>Manage</a>
            </li>
            <li>
              <a href="{{ '/stats' }}"><i class="fa fa-plug"></i>statistics</a>
            </li>
            <li>
              <a href="#"><i class="fa fa-user"></i>Users</a>
            </li>
          </ul>
        </aside>
      
        <div id="navbar-wrapper">
          <nav class="navbar navbar-inverse">
            <div class="container-fluid">
              <div class="navbar-header">
                <a href="#" class="navbar-brand" id="sidebar-toggle"><img src="{{ asset('assets/images/rabbbit.png') }}" class="rabbit " width="70" alt="="></a>
              </div>
            </div>
          </nav>
        </div>

      
      </div>
      
<script>
        const $button  = document.querySelector('#sidebar-toggle');
const $wrapper = document.querySelector('#wrapper');

$button.addEventListener('click', (e) => {
  e.preventDefault();
  $wrapper.classList.toggle('toggled');
});
      </script>

   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>