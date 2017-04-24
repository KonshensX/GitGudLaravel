@extends('layouts.app')

@section('content')
<div class="sixteen wide column center">
        <div class="ui blue segment transparent-panel">
        <h2>Login</h2>
            <form class="ui form" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="field{{ $errors->has('email') ? ' error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="field{{ $errors->has('password') ? ' error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="error">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="field">
                    <div class="ui checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me
                        </label>
                    </div>
                </div>

                <button type="submit" class="ui button primary icon">
                    <i class="signup icon"></i>
                    Login
                </button>

                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                    Forgot Your Password?
                </a>

            </form>
        </div>
    </div>
</div>
@endsection
