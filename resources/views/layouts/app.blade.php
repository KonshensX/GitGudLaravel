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
    <link rel="stylesheet" href="{{ URL::asset('/css/clone.css') }}" type="text/css">

    <!-- Scripts -->
    <script src="{{ URL::asset('js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/semantic.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/angular.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('client/AngularApp.js') }}" type="text/javascript"></script>
</head>
<body ng-app="clone">
    <div class="ui menu">
        <div class="header item">
            <a href="{{ route('post.index') }}">
                <i class="fa fa-twitter fa-2x"></i>
            </a>
        </div>
        <div class="right menu">
            @if (Auth::user())
            <div class="item">
                <div class="ui transparent icon input">
                    <i class="search icon"></i>
                    {!! Form::open(['url' => route('profile.search')]) !!}
                        {!! Form::text('search_value', old('search_value'), ['placeholder' => 'Search ....']) !!}
                    {!! Form::close() !!}
                </div>
            </div>

                <div class="ui dropdown item" tabindex="0">
                    <img class="ui avatar image" src="{{ Auth::user()->avatarUrl }}">
                     <span>{{ Auth::user()->fullname }}</span>
                    <i class="dropdown icon"></i>
                    <div class="menu" tabindex="-1">
                        <a href="{{ route('profile.display', ['name' => Auth::user()->name ]) }}" class="item">
                            <i class="user icon"></i>
                            Profile

                        </a>
                        <a href="{{ route('profile.settings') }}" class="item">
                            <i class="cogs icon"></i>
                            Settings
                        </a>
                        <a href="{{ route('profile.avatar') }}" class="item">
                            <i class="image icon"></i>
                             Change Avatar
                        </a>
                    </div>
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
                <div class="item">
                    <div class="ui icon">
                        <a href="{{ route('login') }}">
                            <i class="fa fa-sign-in"></i>
                            Login
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="ui icon">
                        <a href="{{ route('register') }}">
                            <i class="fa fa-sign-out"></i>
                            Register
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="ui container">
        <div class="ui grid">
            <div class="row">
                @if (\Illuminate\Support\Facades\Auth::check())
                    <div class="three wide column">
                        @include('profile.usercard')
                    </div>
                @endif
                <div class="center nine wide column">
                    @yield('content')
                </div>
                 @if (Auth::check())
                <div class="four wide column">
                    @include('partials.sidebar')
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        $(document)
            .ready(function() {
                
                $('.ui.dropdown')
                        .dropdown({
                            on: 'click'
                        })
                ;

                $('.ui.checkbox')
                  .checkbox()
                ;
            })
        ;

    </script>
    @yield('js')

</body>
</html>
