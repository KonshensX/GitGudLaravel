@extends('layouts.app')

@section('content')
    <div class="ui bottom inverted segment">
        <div class="ui form" style="overflow: hidden;">
            {!! Form::open(['url' => route('post.store')]) !!}
            <div class="field">
                {!! Form::textarea('content', null, ['rows' => 2, 'placeholder' => 'How is your day going...']) !!}
            </div>
            <div class="">
                <i class="fa fa-image"></i>
                or
                <i class="fa fa-video-camera"></i>
                <button class="ui right floated primary labeled icon button tiny">
                    <i class="fa-plus icon"></i>
                    Post
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="ui segment" ng-controller="HomeController">
        <div class="ui active inverted dimmer" ng-show="loading">
            <div class="ui text loader">
                Loading...
            </div>
        </div>
        <div class="ui column" ng-repeat="post in posts">
            <div class="ui top attached header">
                <div class="row">
                    <div class="ui grid">
                        <div class="one wide column">
                            <img class="ui rounded image" src="@{{ post.userInfo.avatarUrl }}" alt="">
                        </div>
                        <div class="ten wide column" style="overflow: hidden;">
                            <a href="{{ route('profile.display') }}/@{{ post.userInfo.name }}">
                                @{{ post.userInfo.name }}
                            </a>
                            <br>
                            @{{  post.content }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui bottom attached segment" style="overflow: hidden;">
                <a href="{{ route('post.full') }}/@{{ post.id }}" class="">
                    <i class="fa fa-clock-o"></i>
                    @{{ post.humanDate }}
                </a>
                <div class="right floated" style="float: right;">

                    <a class="ui red mini">
                        <i class="fa fa-heart liked" ng-class="'liked' "></i> @{{ post.likesCount }}
                    </a>
                    <a class="ui grey mini">
                        <i class="fa fa-comment comments"></i> @{{ post.commentsCount }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="{{ URL::asset('client/controllers/HomeController.js') }}"></script>

@endsection