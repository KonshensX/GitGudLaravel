@extends('layouts.app')

@section('content')
    <div class="ui bottom attached segment">
        <div class="ui form" style="overflow: hidden;">
            {!! Form::open(['url' => route('post.store')]) !!}
            <div class="field">
                {!! Form::textarea('content', null, ['rows' => 2]) !!}
            </div>

            <button class="ui right floated primary labeled icon button">
                <i class="fa-plus icon"></i>
                Post
            </button>

        </div>
    </div>
    @foreach($posts as $post)
        <div class="ui top attached header">
            <div class="row">
                <div class="ui grid">
                    <div class="one wide column">
                        <img width="40" src="{{ URL::asset('img/man.jpg') }}" alt="">
                    </div>
                    <div class="ten wide column" style="overflow: hidden;">
                        {{ $post->user->name }} <i class=""> </i>
                        <br>
                        {{ $post->content }}
                    </div>
                </div>
            </div>
        </div>
        <div class="ui bottom attached segment" style="overflow: hidden;">
            <div class="right floated" style="float: right;">
                <div class="red">
                    <i class="text red fa fa-heart" style="color: red;"></i> 220
                    <i class="fa fa-comment blue" style="color: grey"></i> 44
                </div>
            </div>
        </div>

    @endforeach
@endsection
