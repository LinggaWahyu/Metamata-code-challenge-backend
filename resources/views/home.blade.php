@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header d-flex">
                    <h3>List of Stories</h3>
                    <button type="button" class="ml-auto btn btn-primary btn-sm" data-toggle="modal" data-target="#add-story-modal"><i class="fa fa-plus"></i> Add Story</button>

                    {{-- Modal --}}
                    <div class="modal fade" id="add-story-modal" tabindex="-1" aria-labelledby="add-story-modal-label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="add-story-modal-label">Add Your Story</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('story.create') }}" method="POST">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="form-group">
                                            <label for="title" class="col-form-label">Title</label>
                                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" id="title" placeholder="Title (max. 50 characters)" required>
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="description" class="col-form-label">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3" placeholder="Description" required>{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Post Story</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" href="{{ route('home') }}">All Stories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('my-stories')) ? 'active' : '' }}" href="{{ route('story.my-stories') }}">My Stories</a>
                        </li>
                    </ul>
                    <table class="table table-striped mt-2">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Story</th>
                                <th scope="col">Total Like</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($stories) == 0)
                                <tr>
                                    <td class="text-center" colspan="4">
                                        No one user posted the story here
                                    <td/>
                                </tr>
                            @endif
                            @foreach ($stories as $story)
                                <tr>
                                    <td scope="row">{{ $story->user->name }}</td>
                                    <td>{{ $story->title }}</td>
                                    <td>
                                        <i class="fa fa-thumbs-up"> {{ number_format($story->total_like) }}
                                    </td>
                                    <td>
                                        <button class="btn text-primary" data-toggle="modal" data-target="#detail-story-modal-{{ $story->id }}" data-placement="top" title="Detail">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <a href="{{ route('story.like', $story->id) }}" class="ml-3 text-primary" data-toggle="tooltip" data-placement="top" title="Like">
                                            <i class="far fa-thumbs-up"> Like</i>
                                        </a>
                                    </td>

                                    {{-- Modal --}}
                                    <div class="modal fade" id="detail-story-modal-{{ $story->id }}" tabindex="-1" aria-labelledby="detail-story-label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detail-story-label">{{ $story->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ $story->description }}
                                                </div>
                                                <div class="modal-footer">
                                                    <h6 class="text-primary"><b>{{ number_format($story->total_like) }} Likes</b></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')

    @if (count($errors) > 0)
        <script>
            $(function(){
                $('#add-story-modal').modal('show');
            });
        </script>
    @endif

@endpush
