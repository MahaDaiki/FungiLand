@extends('layouts.app')

@section('title', 'Add Post')

@include('layouts.nav')

@section('content')
<body>
    <div class="container-fluid">
        <!-- Sidebar -->
        @include('layouts.sidebar')
        

            <!-- Page Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div>
                        @include('layouts.errorhandle')
                </div>
            </div>
                <div class="row">   
                    <div class="col-lg-6">
                        <h3>Categories</h3>
                        <div class="table-responsive shadow-lg p-3 mb-5  rounded">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th><button type="button" class=" change btn-primary" data-toggle="modal" data-target="#addCategoryModal">
                                           <img src="assets/images/add.jpg" width="50" alt="add">
                                        </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $categorie)
                                    <tr>
                                        <td>{{ $categorie->id }}</td>
                                        <td class="fs-4">{{ $categorie->name }}</td>
                                        <td>
                                            <button class=" change btn-primary" data-toggle="modal" data-target="#editCategoryModal{{ $categorie->id }}"><img src="assets/images/edit.jpg" alt="edit" width="40"></button>
                                            <button class=" btn-danger change btn-sm" data-toggle="modal" data-target="#deleteCategoryModal{{ $categorie->id }}">X</button>
                                        </td>
                                    </tr>
                                    {{-- category modals --}}
                                    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content forma">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                                                    <button type="button" class="close change" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">X</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <form action="{{ route('categories.store') }}" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="category_name">Category Name</label>
                                                            <input type="text" class="form-control" id="category_name" name="name" required>
                                                        </div>
                                                        <button type="submit" class="text-dark btn-primary change">Add</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Edit Category Modal -->
                                    <div class="modal fade" id="editCategoryModal{{ $categorie->id }}" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel{{ $categorie->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content forma">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editCategoryModalLabel{{ $categorie->id }}">Edit Category</h5>
                                                    <button type="button" class="close change" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">X</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <form action="{{ route('categories.update', $categorie->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="category_name{{ $categorie->id }}">Category Name</label>
                                                            <input type="text" class="form-control" id="category_name{{ $categorie->id }}" name="name" value="{{ $categorie->name }}" required>
                                                        </div>
                                                        <button type="submit" class="change text-dark btn-primary">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Delete Category Modal -->
                                    <div class="modal fade" id="deleteCategoryModal{{ $categorie->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel{{ $categorie->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content forma">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteCategoryModalLabel{{ $categorie->id }}">Delete Category</h5>
                                                    <button type="button" class="close change" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">X</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <p>Are you sure you want to delete this category?</p>
                                                    <form id="deleteCategoryForm{{ $categorie->id }}" action="{{ route('categories.destroy', $categorie->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class=" btn-danger text-dark change">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    </div>
                                    @empty
                                    <tr>
                                        <td colspan="3">No categories found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            {{ $categories->links() }}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h3>Tags</h3>
                        <div class="table-responsive shadow-lg p-3 mb-5  rounded">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th><button type="button" class=" btn-primary change" data-toggle="modal" data-target="#addTagModal">
                                            <img src="assets/images/add.jpg" width="50" alt="add">
                                        </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tags as $tag)
                                    <tr>
                                        <td>{{ $tag->id }}</td>
                                        <td class="fs-4">{{ $tag->name }}</td>
                                        <td>
                                            <button class="btn-primary change" data-toggle="modal" data-target="#editTagModal{{ $tag->id }}"><img src="assets/images/edit.jpg" width="40" alt="edit"></button>
                                            <button class=" btn-danger change" data-toggle="modal" data-target="#deleteTagModal{{ $tag->id }}">x</button>
                                        </td>
                                    </tr>
                              <!-- Add Tag Modal -->
<div class="modal fade" id="addTagModal" tabindex="-1" role="dialog" aria-labelledby="addTagModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content forma">
            <div class="modal-header">
                <h5 class="modal-title" id="addTagModalLabel">Add Tag</h5>
                <button type="button change" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <form action="{{ route('tags.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="tag_name">Tag Name</label>
                        <input type="text" class="form-control" id="tag_name" name="name" required>
                    </div>
                    <button type="submit" class="btn-primary text-dark change">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Tag Modal -->
<div class="modal fade" id="editTagModal{{ $tag->id }}" tabindex="-1" role="dialog" aria-labelledby="editTagModalLabel{{ $tag->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content forma">
            <div class="modal-header">
                <h5 class="modal-title" id="editTagModalLabel{{ $tag->id }}">Edit Tag</h5>
                <button type="button change" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <form action="{{ route('tags.update', $tag->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="tag_name{{ $tag->id }}">Tag Name</label>
                        <input type="text" class="form-control" id="tag_name{{ $tag->id }}" name="name" value="{{ $tag->name }}" required>
                    </div>
                    <button type="submit" class="change text-dark btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Tag Modal -->
<div class="modal fade" id="deleteTagModal{{ $tag->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteTagModalLabel{{ $tag->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content forma">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTagModalLabel{{ $tag->id }}">Delete Tag</h5>
                <button type="button change" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>Are you sure you want to delete this tag?</p>
                <form id="deleteTagForm{{ $tag->id }}" action="{{ route('tags.destroy', $tag->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-dark btn-danger change">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
                                    @empty
                                    <tr>
                                        <td colspan="3">No tags found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            {{ $tags->links() }}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
  
@endsection


