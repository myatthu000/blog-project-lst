@extends('layouts.app')

@section('content')
    <div class="bg-white p-3">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Category List</h3>
            @if (\Illuminate\Support\Facades\Session::has('status'))
                <span>{{ session('status') }}</span>
            @endif
            <div class="">
                <form action="{{ route("category.search") }}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" value="{{ request('keyword') }}" name="keyword">
                        <button class="btn btn-outline-secondary">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>

            </div>
            <div class="ms-2">
                <span>
                    <a href="{{ route('category.create') }}" class="btn btn-outline-primary rounded-0 border-0 btn-sm">Create</a>
                </span>
{{--                <span class="rounded-0 btn-outline-dark btn btn-sm"><i class="bi bi-grid"></i> Grid</span>--}}
{{--                <span class="rounded-0 btn-outline-dark btn btn-sm"><i class="bi bi-list"></i> List</span>--}}
            </div>
        </div>
        <hr class="opacity-10">
        @if(request('keyword'))
        <div class="mb-3">
            <span class="d-inline me-3">Search by : <b>{{ request('keyword') }}</b></span>
            <span><a href="{{ route('category.index') }}"><i class="bi bi-repeat"></i></a></span>
        </div>
        @endif
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Owner</th>
                <th scope="col" class="text-nowrap">Control</th>
                <th scope="col" class="text-nowrap">Create</th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
            <tr>
                <th scope="row">{{ $category->id }}</th>
                <td>{{ $category->title }}</td>
                <td>{{ $category->user->name }}</td>
                <td class="text-nowrap">
                    <a class="btn btn-sm btn-outline-dark" href="{{ route('category.show',$category) }}">
                        <i class="bi bi-eye"></i>
                    </a>
                    @can('update',$category)
                    <a class="btn btn-sm btn-outline-dark" href="{{ route('category.edit',$category) }}">
                        <i class="bi bi-pen"></i>
                    </a>
                    @endcan
                    @can('delete',$category)
                    <form action="{{ route('category.destroy',$category) }}" class="d-inline" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-outline-dark">
                            <i class="bi bi-trash3 text-danger"></i>
                        </button>
                    </form>
                    @endcan
                </td>
                <td class="text-nowrap">
                    <span class="d-inline-block"><i class="bi bi-calendar"></i> {{ $category->created_at->format("d M Y") }}</span>
                    <br>
                    <span class="d-inline-block"><i class="bi bi-clock"></i> {{ $category->created_at->format("A : h") }}</span>
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
            {{ $categories->onEachSide(2)->links() }}
        </div>
    </div>
@endsection
