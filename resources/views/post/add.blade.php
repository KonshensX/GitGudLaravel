@extends('layouts.app')

@section('content')
    {!! Form::open(['files' => true]) !!}
        <h4 class="ui top attached inverted header">New post</h4>
        <div class="ui bottom attached segment">
            <div class="ui input">
                {!! Form::input('content', null) !!}
            </div>
            <button class="ui button">
                Send
            </button>
        </div>
    {!! Form::close() !!}
@endsection