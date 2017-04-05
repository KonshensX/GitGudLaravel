@extends('layouts.app')

@section('content')
<div class="container">
    <h5 class="ui top attached inverted header">What's on your mind...</h5>
    <div class="ui bottom attached segment">
        <div class="ui form">
            {!! Form::open(['url' => route('post.store')]) !!}
            <div class="field">
                {!! Form::textarea('content', null, ['rows' => 2]) !!}
            </div>

            <button class="ui right primary labeled icon button">
                <i class="add icon"></i>
                Send
            </button>

        </div>
    </div>
</div>
@endsection
