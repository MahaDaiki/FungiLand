@include('layouts.nav')
@extends('layouts.app')
@section('title', 'Collection Content')

@section('content')
<div class="col-6 col-lg-3">
    <div class="count-data text-center float-left">
        <a href="{{ route('collections.index', ['user' => $user->id]) }}"><img src="{{ asset('../assets/images/collections.png') }}" width="100" alt="posts"></a>
        <p class="m-0px font-w-600">Collections</p>
    </div>
</div>
<div class="col-md-4 mb-3 mx-auto mt-4">
    <div class="card shadow collection text-center">
        <div class="card-body">
            <h5 class="card-title">{{ $collection->name }}</h5>
            <p class="card-text">{{ $collection->description }}</p>
            <p>Visibility: {{ $collection->is_public ? 'Public' : 'Private' }}</p>
        </div>
    </div>
</div>
<div class="container">
    @include('layouts.errorhandle')
    <div class="row mt-3">
        @if(auth()->check() && auth()->user()->id === $collection->user_id)
        <div class="col-md-12">
            <button type="button" class="btn-primary float-right" data-toggle="modal" data-target="#addContentModal">
                <img src="{{ asset('../assets/images/add2.png') }}" width="70" alt="+">
            </button>
        </div>
        @endif
    </div>
    <div class="row mt-3">
        @forelse ($collection->collectionContent as $content)
            <div class="col-md-4">
                <div class="card shadow mb-3 text-center contentcard">
                    
                        <h5 class="card-header">{{ $content->title }}</h5> 
                         @if($content->image)
                         <div class="card-body text-center">
                         <img src="{{ asset('storage/assets/images/' . $content->image) }}" class="img-fluid" alt="{{ $content->title }}">

                        @endif
                        <p class="card-footer">Description: {{ $content->description }}</p>
                      <div class="text-center">
                        @if(auth()->check() && auth()->user()->id === $content->user_id)
                        <button type="button" class=" btn-primary change" data-toggle="modal" data-target="#editContentModal{{ $content->id }}">
                            <img src="{{ asset('assets/images/edit.jpg') }}" width="30" class="rounded shadow" alt="edit">
                        </button>
                        <button type="button" class=" btn-danger change" data-toggle="modal" data-target="#deleteContentModal{{ $content->id }}">
                         X
                        </button>
                        @endif
                    </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <h1>No Content yet!</h1>
            </div>
        @endforelse
    </div>
</div>

<!-- Add Content Modal -->
<div class="modal fade" id="addContentModal" tabindex="-1" role="dialog" aria-labelledby="addContentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content forma">
            <div class="modal-header">
                <h5 class="modal-title" id="addContentModalLabel">Add Content</h5>
                <button type="button" class="close change" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form action="{{ route('collection_contents.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body text-center">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <input type="hidden" name="collection_id" value="{{ $collection->id }}">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="change btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Content Modal -->
@foreach ($collection->collectionContent as $content)
    <div class="modal fade" id="editContentModal{{ $content->id }}" tabindex="-1" role="dialog" aria-labelledby="editContentModal{{ $content->id }}Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content forma">
                <div class="modal-header">
                    <h5 class="modal-title" id="editContentModal{{ $content->id }}Label">Edit Content</h5>
                    <button type="button" class="close change" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('collection_contents.update', $content->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body text-center">
                        <div class="form-group">
                            <input type="hidden" name="collection_id" value="{{ $content->collection_id }}">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $content->title }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ $content->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="change btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Content Modal -->
    <div class="modal fade" id="deleteContentModal{{ $content->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteContentModal{{ $content->id }}Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content forma">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteContentModal{{ $content->id }}Label">Delete Content</h5>
                    <button type="button" class="close change" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p>Are you sure you want to delete this content?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="change btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{ route('collection_contents.destroy', $content->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="change btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection
