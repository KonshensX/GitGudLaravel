@extends('layouts.app')

@section('content')
    <div class="ui top attached header">
        <div class="ui grid">
            <div class="row">
                <div class="two wide column">
                    <img src="{{ URL::asset('img/man.jpg') }}" alt="">
                </div>
                <div class="eleven wide column">
                    <div class="grey">
                        {{ $post->user->name }}
                         <em>
                             <i class="fa fa-clock-o"></i>
                             <span>{{ $post->created_at->diffForHumans() }}</span>
                         </em>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ui bottom attached segment">
        {{ $post->content }}
        <hr>
    </div>
    <h3>Comments: {{ $post->comments()->count() }}</h3>
    <hr>
        <div class="ui comments">
        @foreach($post->comments() as $comment)
        <div class="comment">
            <div class="avatar">
                <img src=" {{ URL::asset('img/man.jpg') }}" alt="">
            </div>
            <div class="content">
                <span class="author">
                    {{ $comment->user->fullname }}

                    {!! Form::open(['url' => route('comment.remove')]) !!}
                    {!! Form::hidden('id', $comment->id) !!}
                    <div class="right floated">
                        <button type="submit" class="ui button icon mini">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                    {!! Form::close() !!}
                </span>
                <div class="metadata">
                    <span class="date">
                        {{ $comment->created_at->diffForHumans() }}
                    </span>
                </div>
                <div class="text">
                    {{ $comment->comment }}
                </div>
                <div class="actions">
                </div>
            </div>
        </div>
            @endforeach
    </div>
    <div class="ui form">
        <h3>Comment:</h3>
        {!! Form::open(['url' => route('comment.create')]) !!}
            {!! Form::hidden('id', $post->id) !!}
            <div class="field">
                {!! Form::textarea('comment', null, ['rows' => 3, 'placeholder' => 'Your comment here ...']) !!}
            </div>
            <button type="submit" class="ui primary right floated button small icon">
                <i class="fa-reply icon"></i>
                 Comment
            </button>
        {!! Form::close() !!}
    </div>
@endsection