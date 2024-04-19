@extends('layouts.app')

@section('title', 'Add Post')

@include('layouts.nav')

@section('content')
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                @include('layouts.sidebar')
            </div>
            
            <div class="col-md-9 mt-5 ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Posts per Month</h5>
                                    <canvas id="postsChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Users per Month</h5>
                                    <canvas id="usersChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

<script>
    fetch('/daily-statistics')
        .then(response => response.json())
        .then(data => {
            const dailyPosts = data.dailyPosts;
            const dailyUsers = data.dailyUsers;
  
            const dates = [];
            const postsData = [];
            const usersData = [];

            dailyPosts.forEach(item => {
                dates.push(item.date);
                postsData.push(item.count);
            });
  
            dailyUsers.forEach(item => {
                usersData.push(item.count);
            });

            const postsCtx = document.getElementById('postsChart').getContext('2d');
            const postsChart = new Chart(postsCtx, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Posts',
                        data: postsData,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
  
            const usersCtx = document.getElementById('usersChart').getContext('2d');
            const usersChart = new Chart(usersCtx, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Users',
                        data: usersData,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        });
  </script>
  

@endsection
