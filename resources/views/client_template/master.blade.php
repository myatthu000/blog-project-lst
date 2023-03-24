<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Blog') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')

</head>
<body>
<div class="bg-light">
    <div class="container-fluid">
        @include('client_template.client_nav')
    </div>

    <section class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    @yield('content')
                </div>
                <div class="col-3">@include('client_template.right_sidebar')</div>
            </div>
        </div>
    </section>
</div>
</body>
</html>
