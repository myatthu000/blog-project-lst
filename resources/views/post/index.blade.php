@extends('layouts.app')

@section('content')

    <div class="bg-white p-3">
        <div class="d-flex justify-content-between align-items-center">
            <h3>{{ request()->url() === route('post.index') ? 'Post List' : 'Deleted Post' }}</h3>
{{--            @if (\Illuminate\Support\Facades\Session::has('status'))--}}
{{--                <span>{{ session('status') }}</span>--}}
{{--            @endif--}}
            @isTrashRoute()
            <div class="">
                <form action="{{ route("post.search") }}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" value="{{ request('keyword') }}" name="keyword">
                        <button class="btn btn-outline-secondary">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="ms-2">
                <span class="rounded-0 btn-outline-dark btn btn-sm"><i class="bi bi-grid"></i></span>
                <span class="rounded-0 btn-outline-dark btn btn-sm"><i class="bi bi-list"></i></span>
            </div>
            @else
                <div class="ms-2">
                    <span class="rounded-0 btn-outline-dark btn btn-sm">Total Count: {{$deletedPostCount}}</span>
                </div>
            @endisTrashRoute

        </div>
        <hr class="opacity-10">
        @isTrashRoute()
        @if(request('keyword'))
        <div class="mb-3">
            <span class="d-inline me-3">Search by : <b>{{ request('keyword') }}</b></span>
            <span><a href="{{ route('post.index') }}"><i class="bi bi-repeat"></i></a></span>
        </div>
        @endif
        @endisTrashRoute
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                @isNotAuthor
                <th scope="col">Owner</th>
                @endisNotAuthor
                <th scope="col" class="text-nowrap">Control</th>
                <th scope="col" class="text-nowrap">Create</th>
            </tr>
            </thead>
            <tbody>
            @forelse($posts as $post)
            <tr>
{{--                {{ $post->user->name."----" }}--}}
                <th scope="row">{{ $post->id }}</th>
                <td>{{ $post->slug }} <br> <span class="badge bg-warning">{{ $post->category->title }}</span> </td>
                <td>{{ $post->excerpt }}</td>
                @isNotAuthor
                <td>{{ $post->user->name }}</td>
                @endisNotAuthor
                <td class="text-nowrap">
                    @if(request()->url() === route('post.index'))
                        <a class="btn btn-sm btn-outline-dark" href="{{ route('post.show',$post) }}">
                            <i class="bi bi-eye"></i>
                        </a>
                        @can('update',$post)
                            <a class="btn btn-sm btn-outline-dark" href="{{ route('post.edit',$post) }}">
                                <i class="bi bi-pen"></i>
                            </a>
                        @endcan
                        @can('delete',$post)
                            <form action="{{ route('post.destroy',$post) }}" class="d-inline" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-trash3 text-danger"></i>
                                </button>
                            </form>
                        @endcan
                    @elseif(request()->url() === route('post.trash'))
                        @can('restore',$post)
                            <form action="{{ route('post.restore',$post) }}" class="d-inline" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-upload text-info"></i>
                                </button>
                            </form>
                        @endcan
                        @can('forceDelete',$post)
                            <form action="{{ route('post.force',$post) }}" class="d-inline" method="post">
                                <input type="hidden" name="page" value="{{ $posts->currentPage() }}">
                                <input type="hidden" name="lastPage" value="{{ $posts->lastPage() }}">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-trash-fill text-danger"></i>
                                </button>
                            </form>
                        @endcan
                    @endif
                </td>
                <td class="text-nowrap">
                    <span class="d-inline-block"><i class="bi bi-calendar"></i> {{ $post->created_at->format("d M Y") }}</span>
                    <br>
                    <span class="d-inline-block"><i class="bi bi-clock"></i> {{ $post->created_at->format("A : h") }}</span>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="6">No Data</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="">
            {{ $posts->onEachSide(2)->links() }}
        </div>
    </div>
@endsection
