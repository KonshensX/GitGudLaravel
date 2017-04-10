@extends('layouts.app')

@section('content')
    <div class="ui top attached header">
        <div class="ui comment transparent-panel">
            <div class="row">
                <div class="ten wide column">
                    <input type="hidden" id="id" data-id="{{ $post->id }}">
                    <img class="ui avatar image" src="{{ $post->user->avatarUrl }}" alt="">
                    <span>{{ $post->user->name }}</span>
                    <i class="fa fa-clock-o"></i>
                    {{ $post->created_at->diffForHumans() }}
                </div>
                <!--
                <div class="eleven wide column">
                    <div class="grey">
                        {{ $post->user->name }}
                         <em>
                             <i class="fa fa-clock-o"></i>
                             <span class="date">{{ $post->created_at->diffForHumans() }}</span>
                         </em>
                    </div>
                </div>
                -->
            </div>
        </div>
    </div>
    <div class="ui bottom attached segment" >
        {{ $post->content }}
        <hr>
    </div>
    <h3>Comments: {{ $post->comments()->count() }}</h3>
    <hr>
        <div class="ui comments" ng-controller="PostController">
            <div class="ui active inverted dimmer" ng-show="loading">
                <div class="ui large text loader">Loading comments...</div>
            </div>
        <div class="comment" ng-repeat="comment in comments">

            <div class="avatar">

                <img class="" src=" @{{ comment.user.avatarUrl }}" alt="">
            </div>
            <div class="content">
                <span class="author">
                    @{{ comment.user.fullname }}
                    {{--
                    {!! Form::open(['url' => route('comment.remove')]) !!}
                    {!! Form::hidden('id', $comment->id) !!}
                    <div class="right floated">
                        <button type="submit" class="ui button icon mini">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                    {!! Form::close() !!}
                    --}}
                </span>
                <div class="metadata">
                    <span class="date">
                        @{{ comment.humanDate }}
                    </span>
                </div>
                <div class="text">
                    @{{ comment.comment }}
                </div>
                <div class="actions">
                    Delete
                </div>
            </div>
        </div>
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

@section('js')
    <script src="{{ URL::asset('client/controllers/PostController.js') }}"></script>

@endsection