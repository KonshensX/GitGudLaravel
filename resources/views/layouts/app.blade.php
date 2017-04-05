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
    <link href="{{ URL::asset('/css/semantic.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('/css/font-awesome.css') }}" type="text/css">

    <!-- Scripts -->
    <script src="{{ URL::asset('js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/semantic.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/dimmer.js') }}" type="text/javascript"></script>
</head>
<body>
    <div class="ui menu">
        <div class="header item">
            <i class="fa fa-twitter fa-2x"></i>
        </div>
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
                    {!! Form::open(['url' => route('profile.search')]) !!}
                        {!! Form::text('search_value', null, ['placeholder' => 'Search ....']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="item">
                <a href="{{ route('profile.display') }}">
                    <i class="fa fa-user-circle"></i>
                     {{ Auth::user()->email }}
                </a>
            </div>
            <div class="ui icon">
                <a class="item">
                    {!! Form::open(['url' => route('logout')]) !!}

                    <button type="submit" class="ui button blue small icon">
                        <i class="fa-sign-out icon"></i>
                        Logout
                    </button>
                    {!! Form::close() !!}
                </a>
            </div>
            @else
                <div class="ui icon">
                    <a class="item" href="{{ route('login') }}">
                        <i class="fa fa-sign-in"></i>
                        Login
                    </a>
                </div>

                <div class="ui icon">
                    <a class="item" href="{{ route('register') }}">
                        <i class="fa fa-sign-out"></i>
                        Register
                    </a>
                </div>
            @endif
        </div>
    </div>
    <div class="ui container">
        <div class="ui grid">
            <div class="row">
                <div class="three wide column">
                    <h5 class="ui top attached red header">
                        Trending #
                    </h5>
                    <div class="ui bottom attached segment">
                        <ul>
                            <li>#fucl</li>
                        </ul>
                    </div>
                </div>
                <div class="eleven wide column">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->

</body>
</html>
