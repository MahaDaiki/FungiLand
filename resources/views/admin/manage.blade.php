@extends('layouts.app')

@section('title', 'Manage')

@include('layouts.nav')

@section('content')
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('layouts.sidebar')
            </div>
            <div class="col-md-9">
                @include('layouts.errorhandle')
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center mt-5">
                            <div class="btn-group " role="group" aria-label="Switch tables">
                                <button type="button" class=" text-dark text-center btn-primary switch-table" data-target="users-table">Users</button>
                                <button type="button" class=" text-dark text-center btn-primary switch-table" data-target="posts-table">Posts</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <div id="users-table" class="table-container">
                                <h2 class="text-center">Manage Users</h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered shadow">
                                        <thead>
                                            <tr>
                                                <th>User ID</th>
                                                <th>User Name</th>
                                                <th>Email</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="change btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $users->links() }}

                                <h2 class="text-center">Restore Deleted Users</h2>
                                <div class="table-responsive ">
                                    <table class="table table-bordered shadow">
                                        <thead>
                                            <tr>
                                                <th>User ID</th>
                                                <th>User Name</th>
                                                <th>Email</th>
                                                <th>Deleted At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($deletedUsers as $deletedUser)
                                            <tr>
                                                <td>{{ $deletedUser->id }}</td>
                                                <td>{{ $deletedUser->name }}</td>
                                                <td>{{ $deletedUser->email }}</td>
                                                <td>{{ $deletedUser->deleted_at }}</td>
                                                <td>
                                                    <form action="{{ route('users.restore', $deletedUser->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="change btn-success">Restore</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
            
                            <div id="posts-table" class="table-container" style="display: none;">
                                <h2 class="text-center ">Manage Posts</h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered shadow">
                                        <thead>
                                            <tr>
                                                <th>Post ID</th>
                                                <th>Title</th>
                                                <th>Content</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($posts as $post)
                                            <tr>
                                                <td>{{ $post->id }}</td>
                                                <td>{{ $post->title }}</td>
                                                <td>{{ $post->content }}</td>
                                                <td>
                                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class=" change btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $posts->links() }}

                                <h2>Restore Deleted Posts</h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered shadow">
                                        <thead>
                                            <tr>
                                                <th>Post ID</th>
                                                <th>Title</th>
                                                <th>Content</th>
                                                <th>Deleted At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($deletedPosts as $deletedPost)
                                            <tr>
                                                <td>{{ $deletedPost->id }}</td>
                                                <td>{{ $deletedPost->title }}</td>
                                                <td>{{ $deletedPost->content }}</td>
                                                <td>{{ $deletedPost->deleted_at }}</td>
                                                <td>
                                                    <form action="{{ route('posts.restore', $deletedPost->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class=" change btn-success">Restore</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const switchButtons = document.querySelectorAll('.switch-table');
        const tableContainers = document.querySelectorAll('.table-container');

        switchButtons.forEach(button => {
            button.addEventListener('click', () => {
                const targetId = button.dataset.target;
                tableContainers.forEach(container => {
                    if (container.id === targetId) {
                        container.style.display = 'block';
                    } else {
                        container.style.display = 'none';
                    }
                });
            });
        });
    });
</script>

@endsection
