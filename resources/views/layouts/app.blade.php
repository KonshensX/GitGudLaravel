<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ URL::asset('/css/semantic.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Scripts -->

</head>
<body>
    <div class="ui inverted menu">
        <div class="header item">Brand</div>
        <div class="active item">Link</div>
        <a class="item">Link</a>
        <div class="ui dropdown item" tabindex="0">
            Dropdown
            <i class="dropdown icon"></i>
            <div class="menu" tabindex="-1">
                <div class="item">Action</div>
                <div class="item">Another Action</div>
                <div class="item">Something else here</div>
                <div class="divider"></div>
                <div class="item">Separated Link</div>
                <div class="divider"></div>
                <div class="item">One more separated link</div>
            </div>
        </div>
        <div class="right menu">
            <div class="item">
                <div class="ui transparent inverted icon input">
                    <i class="search icon"></i>
                    <input type="text" placeholder="Search">
                </div>
            </div>
            <a class="item">Link</a>
        </div>
    </div>
    <div class="ui container">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ URL::asset('js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/semantic.min.js') }}" type="text/javascript"></script>
</body>
</html>
