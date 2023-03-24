<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack("styles")
</head>
<body>
    <div id="app">
        @include('layouts.navbar')
        <main class="py-3">
            <div class="container">
                <div class="row">
                    <div class="col-3 p-1 gap-0">
                        @auth()
                            @include('layouts.__left_sidebar')
                        @endauth
                    </div>
                    <div class="col-9 p-1 gap-0">
                        @yield('content')
                    </div>
{{--                    <div class="col-3 p-1 gap-0">--}}
{{--                        @auth()--}}

{{--                        @endauth--}}
{{--                    </div>--}}
                </div>
            </div>
        </main>
    </div>
    @stack("scripts")
    @if(session("status"))
        <script>
            ToastWork('success',`{{ session('status') }}`)
        </script>
    @endif
</body>
</html>
