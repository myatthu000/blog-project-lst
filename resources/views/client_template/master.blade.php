<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Blog') }}</title>


    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

    <!-- Styles -->
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{ asset('css/client_themes.css') }}">
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
                <div class="col-3">
                    <div class=" {{ route('login') !== request()->url() && route('register') !== request()->url() && redirect('/password/reset/{?id}') !== request()->url() ? '' : 'd-none' }}">
                        @include('client_template.right_sidebar')
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('js/client_themes.js') }}"></script>
</body>
</html>
