@extends('layouts.app')

@section('content')
    <div class="ui bottom segment">
        <div class="ui form" style="overflow: hidden;">
            {!! Form::open(['url' => route('post.store')]) !!}
            <div class="field">
                {!! Form::textarea('content', null, ['rows' => 2]) !!}
            </div>
            <div class="">
                <i class="fa fa-image"></i>
                or
                <i class="fa fa-video-camera"></i>
                <button class="ui right floated primary labeled icon button mini">
                    <i class="fa-plus icon"></i>
                    Post
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="ui segment" ng-controller="HomeController">
        <div class="ui active inverted dimmer" ng-show="loading">
            <div class="ui large text loader">
                Loading...
            </div>
        </div>
        <div class="ui column" ng-repeat="post in posts">
            <div class="ui top attached header">
                <div class="row">
                    <div class="ui grid">
                        <div class="one wide column">
                            <img width="40" src="@{{ post.userInfo.avatarUrl }}" alt="">
                        </div>
                        <div class="ten wide column" style="overflow: hidden;">
                            @{{ post.userInfo.name }} <i class=""> </i>
                            <br>
                            @{{  post.content }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui bottom attached segment" style="overflow: hidden;">
                <a href="{{ route('post.full', ['id']) }}" class="">
                    <i class="fa fa-clock-o"></i>
                    @{{ post.humanDate }}
                </a>
                <div class="right floated" style="float: right;">

                    {!! Form::open(['url' => route('like.like')]) !!}
                    {!! Form::hidden('id') !!}
                    <button type="submit" class="ui red button mini">
                        <i class="fa fa-heart"></i> @{{ post.likesCount }}
                    </button>
                    {!! Form::close() !!}
                    <button type="submit" class="ui grey button mini">
                        <i class="fa fa-comment"></i> @{{ post.commentsCount }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="{{ URL::asset('client/controllers/HomeController.js') }}"></script>

@endsection