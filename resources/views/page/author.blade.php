@extends('client_template.master')
@section('content')

<div class="">
    <div class="">
        <div class=""><h4 class="d-inline-block">Author : {{ $user->name }}</h4></div>
    </div>
    <div class="my-3">
        <form action="{{ route("page.author",$user->name) }}" method="get">
            <div class="input-group">
                <input type="text" class="form-control" value="{{ request('keyword') }}" name="keyword">
                <button class="btn btn-outline-secondary">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
        @if(request('keyword'))
            <div class="mb-3">
                <span class="d-inline me-3">Search by : <b>{{ request('keyword') }}</b></span>
                <span><a href="{{ route("page.author",$user->name) }}"><i class="bi bi-repeat"></i></a></span>
            </div>
        @endif
        @isset($user)
            <div class="d-flex justify-content-between align-items-center mb-3">
                <p>Filter By : {{ $user->name }}</p>
                <a href="{{ route('page.index') }}" class="btn  btn-outline-primary">See All</a>
            </div>
        @endisset
    </div>
    @forelse($posts as $post)
        <div class=" p-2 mb-2 py-3 rounded-3 bg-white">
            <h4><a href="{{ route('page.detail',$post->slug) }}" class="text-decoration-none text-primary">{{ $post->title }}</a></h4>
            <div class="">
                <span class="d-inline-block me-2">{{ $post->category->title }}</span>
                <span class="d-inline-block">{{ $post->user->name }}</span>
            </div>
            <hr>
            <p>{{ $post->excerpt }}</p>
            <div class="d-flex justify-content-between align-items-center">
                <span class="d-inline-block">{{ $post->created_at->diffForHumans() }}</span>
                <a href="{{ route('page.detail',$post->slug) }}" class="text-decoration-none text-primary">See More >>></a>
            </div>
        </div>
    @empty
        <div class=" p-2 mb-2 py-3 rounded-3 bg-white">
            <h4>
                No Post Yet!
            </h4>
        </div>
    @endforelse
    <div class="d-flex justify-content-between align-items-center">
{{--                    <div class="">--}}
{{--                        <a href="{{ url()->previous() }}">Back</a>--}}
{{--                    </div>--}}
        <div class="">
            {{ $posts->onEachSide(2)->links() }}
        </div>
    </div>
</div>

@endsection
