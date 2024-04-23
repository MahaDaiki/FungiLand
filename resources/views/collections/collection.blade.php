@include('layouts.nav')
@extends('layouts.app')
@section('title', 'Collections')

@section('content')
@include('layouts.profilebar')
<div class="container">
    <button class=" btn-primary float-right" data-toggle="modal" data-target="#addCollectionModal">
        <img src="assets/images/add2.png" width="70" alt="+">
    </button>
</div>
@include('layouts.errorhandle')

<div class="container">
    <div class="row">
        @forelse ($collections as $collection)
            <div class="col-md-4 mb-3">
                <div class="card shadow collection text-center">
                    <div class="card-body">
                        <h5 class="card-title">{{ $collection->name }}</h5>
                        <p class="card-text">{{ $collection->description }}</p>
                        <p>Visibility: {{ $collection->is_public ? 'Public' : 'Private' }}</p>
                        <div class="d-flex justify-content-between">
                            <button class="change shadow btn-primary" data-toggle="modal" data-target="#editCollectionModal{{ $collection->id }}">
                                <img src="assets/images/edit.jpg" width="30" class="rounded shadow" alt="edit">
                            </button>
                            <a href="{{ route('collections.show', $collection->id) }}">View Collection</a>
                            <button class="change btn-danger shadow" data-toggle="modal" data-target="#confirmDeleteModal{{ $collection->id }}">
                                Delete
                            </button>
                            
                        </div>
                    </div>
           

        <!-- Edit Modal -->
    <div class="modal fade" id="editCollectionModal{{ $collection->id }}" tabindex="-1"         role="dialog" aria-labelledby="editCollectionModalLabel{{ $collection->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content forma">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCollectionModalLabel{{ $collection->id }}">Edit Collection</h5>
                        <button type="button" class="close change" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">X</span>
                        </button>
                    </div>
                    <form action="{{ route('collections.update', $collection->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body text-center">
                            <div class="form-group">
                                <label for="edit_name">Name</label>
                                <input type="text" class="form-control" id="edit_name" name="name" value="{{ $collection->name }}">
                            </div>
                            <div class="form-group">
                                <label for="edit_description">Description</label>
                                <textarea class="form-control" id="edit_description" name="description">{{ $collection->description }}</textarea>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="edit_is_public" name="is_public" {{ $collection->is_public ? 'checked' : '' }}>
                                <label class="form-check-label" for="edit_is_public">
                                    Public
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class=" change btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="change btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- delete modal --}}
    <div class="modal fade" id="confirmDeleteModal{{ $collection->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel{{ $collection->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content forma">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel{{ $collection->id }}">Confirm Delete</h5>
                    <button type="button" class="close change" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p>Are you sure you want to delete this collection?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class=" btn-secondary change" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('collections.destroy', $collection->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class=" btn-danger change">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@empty
    <h1 class="text-center">No Collection yet</h1>
@endforelse

<!-- Add Modal -->
<div class="modal fade" id="addCollectionModal" tabindex="-1" role="dialog" aria-labelledby="addCollectionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content forma">
            <div class="modal-header">
                <h5 class="modal-title" id="addCollectionModalLabel">Add Collection</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('collections.store') }}" method="POST">
                @csrf
                <div class="modal-body text-center">
                    <div class="form-group">
                        <label for="add_name">Name</label>
                        <input type="text" class="form-control" id="add_name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="add_description">Description</label>
                        <textarea class="form-control" id="add_description" name="description"></textarea>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="add_is_public" name="is_public" checked>
                        <label class="form-check-label" for="add_is_public">
                            Public
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="change btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="change btn-primary">Add Collection</button>
                </div>
            </form>
        </div>

    </div>
</div>
 
@endsection
