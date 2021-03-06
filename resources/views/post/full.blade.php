@extends('layouts.app')

@section('content')
    <div class="ui top attached header transparent-card">
        <div class="ui comment">
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
    <div class="ui bottom attached segment transparent-panel" >
        {{ $post->content }}
        @if ($post->attachmentUrl) 
            <img class="ui rounded image" src="{{ $post->attachmentUrl }}" alt="{{ $post->user->name }}">
        @endif
        <hr>
        <span>
            <i class="fa fa-heart"></i>
             {{ $post->likesCount }}
        </span>
    </div>
    <h3>Comments: {{ $post->comments()->count() }}</h3>
    <hr>
        <div class="ui comments" ng-controller="PostController">
            <div class="ui active dimmer" ng-show="loading">
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
                    <a class="text red" ng-click="displayConfirmation(comment.id)">
                        <i class="fa fa-trash"></i>
                        Delete
                    </a>
                </div>
            </div>
        </div>
        @if (Auth::check()) 
        <div class="ui form">
            <h3>Comment:</h3>
            {!! Form::open(['ng-submit' => 'postComment(' . $post->id . ')', 'onsubmit' => 'return false']) !!}
                <div class="field">
                    {!! Form::textarea('comment', null, ['rows' => 3, 'placeholder' => 'Your comment here ...', 
                    'ng-model' => 'comment.content']) !!}
                </div>
                <button type="submit" class="ui primary right floated button small icon">
                    <i class="fa-reply icon"></i>
                     Comment
                </button>
            {!! Form::close() !!}
                <!-- modal -->
            <div class="ui basic modal">
              <div class="ui icon header">
                <i class="trash icon"></i>
                Delete comment
              </div>
              <div class="content center">
                <p>Please confirm, do you really want to delete this comment?</p>
              </div>
              <div class="actions">
                <div class="ui red basic cancel inverted button">
                  <i class="remove icon"></i>
                  No
                </div>
                <button class="ui green ok inverted button" ng-click="deleteComment()">
                  <i class="checkmark icon"></i>
                  Yes
                </button>
              </div>
            </div><!-- End of modal -->
        </div>
        @else 
        <div class="ui bottom segment transparent-panel">
            You need to login to comment in this post
        </div>
        @endif
    </div>
    
@endsection

@section('js')
    <script src="{{ URL::asset('client/controllers/PostController.js') }}"></script>
    <script type="text/javascript">
        
    </script>
@endsection