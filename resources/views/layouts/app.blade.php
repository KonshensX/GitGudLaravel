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
    <div class="ui menu">
        <div class="header item">Brand</div>
        <div class="active item">Link</div>
        <a class="item">Link</a>
        <div class="ui dropdown item" tabindex="0">
            Dropdown
            <i class="dropdown icon"></i>
            <div class="menu" tabindex="-1">
                <div class="item">Action</div>
                <div class="item">Another Action</div>
            </div>
        </div>
        <div class="right menu">
            @if (Auth::user())
            <div class="item">
                <div class="ui transparent icon input">
                    <i class="search icon"></i>
                    <input type="text" placeholder="Search">
                </div>
            </div>
            <div class="ui icon">
                <a class="item">
                    {!! Form::open(['url' => route('logout')]) !!}
                    <i class="out icon"></i>
                    <button type="submit">Logout</button>
                    {!! Form::close() !!}
                </a>
            </div>
            @else
                <div class="ui icon">
                    <a class="item">
                        <i class="clock icon"></i>
                        Login
                    </a>
                </div>
                <div class="ui icon">
                    <a class="item">
                        <i class="registered icon"></i>
                        Register
                    </a>
                </div>
            @endif
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
