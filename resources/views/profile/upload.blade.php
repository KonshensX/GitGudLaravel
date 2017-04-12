@extends('layouts.app')

@section('content')
    <h3 class="ui top attached blue header transparent-card">
        <i class="fa fa-image"></i>
        Upload avatar
    </h3>
    <div class="ui attached bottom segment transparent-panel">
        {!! Form::open(['files' => true, 'url' => route('profile.upload')]) !!}
            {!! Form::file('avatar') !!}
        <button class="ui primary button">
            <i class="fa fa-save"></i>
             Upload
        </button>
        {!! Form::close() !!}
    </div>
@endsection