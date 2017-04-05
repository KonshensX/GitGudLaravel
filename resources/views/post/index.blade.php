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
            {!! Form::close() !!}
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
            <a href="{{ route('post.full', ['id' => $post->id]) }}" class="">
                <i class="fa fa-clock-o"></i>
                 {{ $post->created_at->diffForHumans() }}
            </a>
            <div class="right floated" style="float: right;">

                {!! Form::open(['url' => route('like.like')]) !!}
                    {!! Form::hidden('id', $post->id) !!}
                    <button type="submit" class="ui red button mini">
                        <i class="fa fa-heart"></i> {{ $post->likes()->count() }}
                    </button>
                {!! Form::close() !!}
                <button type="submit" class="ui grey button mini">
                    <i class="fa fa-comment"></i> 44
                </button>
            </div>
        </div>

    @endforeach
@endsection
