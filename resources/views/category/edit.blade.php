@extends('layouts.app')

@section('content')
    <div class="bg-white p-3">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Create New Category</h3>
        </div>
        <hr class="opacity-10">
        <form action="{{ route('category.update',$category) }}" method="post">
            @csrf
            @method("patch")
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title',$category->title) }}" name="title" id="title" placeholder="title">
                @error('title')
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
