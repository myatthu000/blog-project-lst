@extends('layouts.app')

@section('content')
    <div class="bg-white p-3">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Create New Post</h3>
        </div>
        <hr class="opacity-10">
        <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("post")

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" name="title" id="title" placeholder="title">
                @error('title')
                <div class="invalid-feedback">
                    <span>{{ $message }}</span>
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select @error('category') is-invalid @enderror" name="category" id="category">
                    @foreach($categories as $category)
                    <option class="form-select" value="{{ $category->id }}" {{$category->id == old('category') ? 'selected' : '' }}>{{$category->title}}</option>
                    @endforeach
                </select>
                @error('category')
                <div class="invalid-feedback">
                    <span>{{ $message }}</span>
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{old('description')}}</textarea>
                @error('description')
                <div class="invalid-feedback">
                    <span>{{ $message }}</span>
                </div>
                @enderror
            </div>
            {{ \Illuminate\Support\Facades\Auth::id() }}
            <div class="mb-3">
                <label for="feature_image" class="form-label">Feature Image</label>
                <input type="file" class="form-control  @error('feature_image') is-invalid @enderror" name="feature_image" id="feature_image">
                @error('feature_image')
                <div class="invalid-feedback">
                    <span>{{ $message }}</span>
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="multiple_photos" class="form-label @error('multiple_photos') text-danger @enderror">Post Images</label>
                <input type="file"
                       class="form-control  @error('multiple_photos') is-invalid @enderror  @error('multiple_photos.*') is-invalid @enderror"
                       name="multiple_photos[]"
                       id="multiple_photos" multiple>
                @error('multiple_photos')
                <div class="invalid-feedback">
                    <span>{{ $message }}</span>
                </div>
                @enderror
                @error('multiple_photos.*')
                <div class="invalid-feedback">
                    <span>{{ $message }}</span>
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <button class="btn-primary btn rounded-2 border border-0 px-3">Save</button>
            </div>
        </form>
    </div>
@endsection
