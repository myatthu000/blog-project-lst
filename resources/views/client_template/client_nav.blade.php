<nav class="navbar nav-pills navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('page.index') }}">{{ config('app.name','Blog') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->url() === route('page.index') ? 'active' : '' }}" href="{{ route('page.index') }}" aria-current="page" >Home</a>
                </li>
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="bi bi-bell text-primary"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @forelse($user->notifications as $notification)
                                <div class="d-flex justify-content-between flex-nowrap align-items-center bg-white my-2 p-2 ">
                                    <div class="">
                                        <span class="badge bg-danger {{ $notification->read_at === null ? '' : 'd-none' }}">New</span>
                                        <span>
                                            {{ $notification->data['message'] }}
                                        </span>
                                    </div>
                                    @if($notification->read_at === null)
                                        <a href="{{ route("notification.read",$notification->id) }}" class="d-inline btn btn-info">Read</a>
                                    @else
                                        <a href="{{ route("notification.unread",$notification->id) }}" class="d-inline btn btn-info">Unread</a>
                                    @endif
                                </div>
                            @empty
                                <div class="d-flex justify-content-between align-items-center bg-white my-2 p-2 ">
                                    <p>Empty</p>
                                </div>
                            @endforelse
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="{{ route('home') }}">{{ __('Dashboard') }}</a>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
