@extends('layouts.app')

@section('content')
    <div class="bg-white p-3">
        <div class="">
            <h3>{{ $post->title }}</h3>
            <div class="mt-2">
                <span class="fw-bolder">
                    <i class="bi bi-pencil"></i>
                    <a class="text-black text-decoration-none text-decoration-underline" href="">{{ $post->user->name }}</a>
                </span>
                <span class="ms-2 fw-bolder">
                    <i class="bi bi-layers"></i>
                    <a class="text-black text-decoration-none text-decoration-underline" href="">{{ $post->category->title }}</a>
                </span>
                <span class="ms-2 fw-bolder">
                    <a class="text-black text-decoration-none text-decoration-underline" href="">{{ $post->created_at->diffForHumans() }}</a>
                </span>
            </div>
            <hr class="opacity-10">
        </div>

        @isset($post->photos)
            @foreach($post->photos as $photo)
                <div class="d-inline my-2">
                    <img src="{{ asset("storage/".$post->user_id."/multiple_photos/".$photo->name) }}" class="" style="height: 150px;" alt="">
                </div>
            @endforeach
        @endisset
        <div class="">
            <p>{{$post->description}}</p>
        </div>
        @isset($post->feature_image)
            <div class="">
                <img style="width: 100%;height: 150px;object-fit: contain;" src="{{  asset("storage/".$post->user_id."/feature_image/".$post->feature_image) }}" alt="">
            </div>
        @endisset
        <hr class="opacity-10">
        <div>
            <div class="">
                @can('delete',$post)
                <form action="{{ route('post.destroy',$post) }}" class="d-inline" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger">
                        <i class="bi bi-trash3"></i> Delete
                    </button>
                </form>
                @endcan
                @can('update',$post)
                <a href="{{ route("post.edit",$post) }}" class="btn btn-outline-info">
                    <i class="bi bi-pencil-square"></i>
                    Edit
                </a>
                @endcan
                <a href="{{ route("post.index") }}" class="btn btn-outline-secondary">
                    <i class="bi bi-house"></i>
                    Home
                </a>
            </div>
            <div class="">

            </div>
        </div>
    </div>
@endsection
