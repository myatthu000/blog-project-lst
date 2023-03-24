@extends('layouts.app')

@section('content')
    <div class="bg-white p-3">
        <div class="d-flex justify-content-between align-items-center">
            <h3>User List</h3>
            @if (\Illuminate\Support\Facades\Session::has('status'))
                <span>{{ session('status') }}</span>
            @endif
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
        </div>
        <hr class="opacity-10">
        @if(request('keyword'))
            <div class="mb-3">
                <span class="d-inline me-3">Search by : <b>{{ request('keyword') }}</b></span>
                <span><a href="{{ route('post.index') }}"><i class="bi bi-repeat"></i></a></span>
            </div>
        @endif
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Roles</th>
                <th scope="col">Control</th>
                <th scope="col" class="text-nowrap">Status</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
{{--                    @foreach($user->posts as $post)--}}
{{--                        {{ print $post->slug}}--}}
{{--                    @endforeach--}}
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }} <br> Total Posts :  <b>{{ $user->posts()->count() }}</b> </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <div>
                            @if($user->role !== 'admin')
                            <div class="dropdown-center">
                                <button class="btn rounded-0 border dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $user->role }}
                                </button>
                                <ul class="dropdown-menu">
                                    @if($user->role !== 'admin')
                                    <li class="">
                                        <form class="d-none" id="{{ $user->id }}_admin_user" action="{{ route('user.roleAdmin') }}" method="post">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                        </form>
                                        <button form="{{ $user->id }}_admin_user" class="btn btn-danger dropdown-item">Make Admin</button>
                                    </li>
                                    @endif

                                    @if($user->role !== 'editor')
                                    <li class="">
                                        <form class="d-none" id="{{ $user->id }}_editor_user" action="{{ route('user.roleEditor') }}" method="post">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                        </form>
                                        <button form="{{ $user->id }}_editor_user" class="btn btn-danger dropdown-item">Make Editor</button>
                                    </li>
                                    @endif

                                    @if($user->role !== 'author')
                                    <li class="">
                                        <form class="d-none" id="{{ $user->id }}_author_user" action="{{ route('user.roleAuthor') }}" method="post">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                        </form>
                                        <button form="{{ $user->id }}_author_user" class="btn btn-danger dropdown-item">Make Author</button>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            @else
                                <div class="">
                                    <p>Admin</p>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="text-nowrap">
                        {{--                                    {{ $user->isBanded }}--}}
                        @if($user->isBanded === '1' && $user->role !== 'admin' )
                            <div class="">
                                <form class="d-none" id="{{ $user->id }}_band_user" action="{{ route('user.band',['band'=>'band']) }}" method="post">
                                    @csrf
                                    @method('post')
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                </form>
                                <button form="{{ $user->id }}_band_user" class="btn text-danger dropdown-item">Band User</button>
                            </div>
                        @elseif($user->isBanded === '-1' && $user->role !== 'admin')
                            <div class="">
                                <form class="d-none" id="{{ $user->id }}_band_user" action="{{ route('user.band',['band'=>'unBanded']) }}" method="post">
                                    @csrf
                                    @method('post')
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                </form>
                                <button form="{{ $user->id }}_band_user" class="btn text-success dropdown-item">Restore User</button>
                            </div>
                        @else
                            <div class="">
                                <button  class="btn text-primary">Admin</button>
                            </div>
                        @endif
                    </td>
                    <td class="text-nowrap">
                        <span class="d-inline-block"><i class="bi bi-calendar"></i> {{ $user->created_at->format("d M Y") }}</span>
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
            {{ $users->onEachSide(2)->links() }}
        </div>
    </div>
@endsection
