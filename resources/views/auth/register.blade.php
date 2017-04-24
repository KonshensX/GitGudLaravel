@extends('layouts.app')

@section('content')
<div class="ui green segment">
    <h2>Register</h2>
    <div class="ui form">
        {!! Form::open(['url' => url('/register'), 'class' => 'form-horizontal']) !!}
            {{ csrf_field() }}
            <div class="ui field {{ $errors->has('name') ? ' error' : 'success' }}">
                <label>Username</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name'))
                    <span class="ui error">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="ui field {{ $errors->has('email') ? ' error' : 'success' }}">
                <label>Email</label>
                <input id="email" type="text" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="ui error">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="ui field {{ $errors->has('password') ? ' error' : 'success' }}">
                <label>Password</label>
                <input id="password" type="password" name="password" value="{{ old('password') }}" required autofocus>
                 @if ($errors->has('password'))
                    <span class="ui error">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="ui field">
                <label>Password Confirmation</label>
                <input id="password-confirm" type="password" name="password-confirm"
                       value="{{ old('password-confirm') }}" required autofocus>
            </div>
            <div class="ui right">
                <button type="submit" class="ui primary button">Register</button>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
