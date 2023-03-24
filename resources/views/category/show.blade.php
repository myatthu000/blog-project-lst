@extends('layouts.app')

@section('content')
    <div class="bg-white p-3">
        <div class="">
            <div class="d-flex justify-content-between align-items-center">
                <div class="mt-2">
                    <h3>{{ $category->title }}</h3>
                    <div >
                        <span class="fw-bolder">
                            <i class="bi bi-pencil"></i>
                            <a class="text-black text-decoration-none text-decoration-underline" href="">{{ $category->user->name }}</a>
                        </span>
                        <span class="ms-2 fw-bolder">
                            <a class="text-black text-decoration-none text-decoration-underline" href="">{{ $category->created_at->diffForHumans() }}</a>
                        </span>
                    </div>
                </div>
                <div>
                    <div class="">
                        @can('delete',$category)
                        <form action="{{ route('category.destroy',$category) }}" class="d-inline" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">
                                <i class="bi bi-trash3"></i> Delete
                            </button>
                        </form>
                        @endcan
                        @can('update',$category)
                         <a href="{{ route("category.edit",$category) }}" class="btn btn-outline-info">
                             <i class="bi bi-pencil-square"></i>
                             Edit
                         </a>
                         @endcan
                        <a href="{{ route("category.index") }}" class="btn btn-outline-secondary">
                            <i class="bi bi-house"></i>
                            Home
                        </a>
                    </div>
                    <div class="">

                    </div>
                </div>
            </div>
            <hr class="opacity-10">
        </div>
        <div class="">
            <h5>Total category used by Post : {{ $postCount }}</h5>
            <div class="" style="height: 58vh;overflow-y: scroll;scroll-behavior: smooth;">
                @forelse($posts as $post)
                    <div class="border-0 border-bottom p-2 my-2 rounded-2 bg-light">
                        <h5 class="">
                            <a href="{{ route('post.show',$post) }}">
                                {{ $post->title }}
                            </a>
                        </h5>
                        <div class="">
{{--                            <span>Owner : {{ $post->user->name }}</span> <br>--}}
                            <span>Created : {{ $post->created_at->format('d M Y') }}</span> <br>
    {{--                        <span>Updated : {{ $post->updated_at->format('d M Y') }}</span>--}}
                        </div>
                    </div>
                @empty
                    <h4> Empty </h4>
                @endforelse
            </div>
        </div>
        <hr class="opacity-10">
    </div>
@endsection
