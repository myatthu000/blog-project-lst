@extends('client_template.master')
@section('content')
    <div class="">
        <div class="bg-white p-3">
            <h3 class="">{{ $post->title }}</h3>
            <div class="mt-2 d-flex justify-content-between align-items-center">
                <div class="">
                    <span class="fw-bolder">
                        <a class="text-black text-decoration-none text-decoration-underline" href="{{ route('page.author',$post->user->name) }}">{{ $post->user->name }}</a>
                    </span>
                    <span class="fw-bolder">
                        <a class="text-black text-decoration-none text-decoration-underline" href="{{ route('page.category',$post->category->slug) }}">{{ $post->category->title}}</a>
                    </span>
                    <span class="ms-2 fw-bolder">
                        <a class="text-black text-decoration-none text-decoration-underline" href="">{{ $post->created_at->diffForHumans() }}</a>
                    </span>
                </div>
            </div>
            <hr>
            @isset($post->photos)
                @foreach($post->photos as $photo)
                    <div class="d-inline my-2">
                        <img src="{{ asset("storage/".$post->user_id."/multiple_photos/".$photo->name) }}" class="" style="height: 150px;" alt="">
                    </div>
                @endforeach
            @endisset
            <div class="">
                {{ $post->description }}
            </div>
            @isset($post->feature_image)
                <div class="">
                    <img style="width: 100%;height: 150px;object-fit: contain;" src="{{  asset("storage/".$post->user_id."/feature_image/".$post->feature_image) }}" alt="">
                </div>
            @endisset
        </div>
        <div class="">
            <a href="{{ url()->previous() }}">Back</a>
        </div>
    </div>
@endsection
