@extends('layouts.app')

@php
use \Illuminate\Support\Facades\Auth;
@endphp

@section('content')
    <div class="bg-white p-3">
        <div class="">
            <h3>Gallery</h3>
            <hr>
            <h3>Feature Images</h3>
{{--            {{ \App\Models\Post::where('user_id',\Illuminate\Support\Facades\Auth::id())->get() }}--}}
            @forelse(Auth::user()->posts as $post)
                @if($post->feature_image !== null)
                <div class="d-inline-block mb-2 me-1">
                    <img style="width: 100%;height: 150px;object-fit: contain;display: inline-block;" src="{{ asset('storage/'.Auth::user()->id.'/feature_image/'.$post->feature_image) }}" alt="{{$post->feature_image}}">
                </div>
                @endif
            @empty
                <div class="">
                    <h5>No data</h5>
                </div>
            @endforelse
            <hr>
            <h3>Post Photos</h3>
            @forelse(Auth::user()->photos as $photo)
                <div class="d-inline-block mb-2 me-1">
                    <img style="width: 100%;height: 150px;object-fit: contain;display: inline-block;" src="{{ asset('storage/'.Auth::user()->id.'/multiple_photos/'.$photo->name) }}" alt="{{$photo->name}}">
                </div>
            @empty
                <div class="">
                    <h5>No data</h5>
                </div>
            @endforelse
        </div>
    </div>
@endsection
