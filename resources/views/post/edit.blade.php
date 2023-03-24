@extends('layouts.app')

@section('content')
    <div class="bg-white p-3">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Edit Post</h3>
        </div>
        <hr class="opacity-10">
        <form action="{{ route('post.update',$post) }}" id="{{ $post->id."_edit_post" }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("patch")
        </form>

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" form="{{ $post->id."_edit_post" }}" class="form-control" value="{{ old('title',$post->title) }}" name="title" id="title" placeholder="title">
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" name="category" id="category" form="{{ $post->id."_edit_post" }}">
                @foreach($categories as $category)
                    <option class="form-select" value="{{ $category->id }}" {{$category->id == old('category') ? 'selected' : '' }}>{{$category->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea form="{{ $post->id."_edit_post" }}" class="form-control" name="description" id="description" rows="3">{{old('description',$post->description)}}</textarea>
        </div>
        <div class="mb-3">
            <label for="feature_image" class="form-label">Feature Image</label>
            <input form="{{ $post->id."_edit_post" }}" type="file" class="form-control" name="feature_image" id="feature_image">
        </div>
        @isset($post->feature_image)
        <div class="mb-3">
            <div class="position-relative overflow-hidden" style="width: 100px;">
                <img src="{{ asset("storage/".$post->user_id."/feature_image/".$post->feature_image) }}"
                     class="" style="width: 100%;height: 100px;object-fit: contain" alt="">
            </div>
        </div>
        @endisset
        <div class="mb-3">
            <label for="multiple_photos" class="form-label @error('multiple_photos') text-danger @enderror">Post Images</label>
            <input type="file"
                   form="{{ $post->id."_edit_post" }}"
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
            @isset($post->photos)
                <div class="d-inline my-2">
                    @foreach($post->photos as $photo)
                        <div class="position-relative overflow-hidden d-inline-block border" style="width: 100px;">
                            <form action="{{ route('photo.destroy',$photo) }}" method="post" id="{{ $photo->id }}._post_delete">
                                @csrf
                                @method('delete')
                                <img src="{{ asset("storage/".$post->user_id."/multiple_photos/".$photo->name) }}"
                                     id="{{ $photo->id }}"
                                     class="" style="width: 100%;height: 100px;object-fit: contain" alt="{{ $photo->name }}">
                                <button form="{{ $photo->id }}._post_delete" class="position-absolute btn-close text-danger end-0 top-0"></button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endisset
        </div>
        <div>
            <button class="btn-primary btn rounded-2 border border-0 px-3" form="{{ $post->id."_edit_post" }}">Update</button>
        </div>
    </div>
@endsection
