@extends('layouts.app')

@section('content')
    <div class="ui bottom blue segment transparent-panel">
        <div class="ui form" style="overflow: hidden;">
            {!! Form::open(['url' => route('post.store'), 'files' => true]) !!}
            <div class="field">
                {!! Form::textarea('content', null, ['rows' => 2, 'placeholder' => 'How is your day going...']) !!}
            </div>
            <div class="">
                <label for="file-upload" class="ui label">
                    <i class="fa fa-image"></i>
                    or
                    <i class="fa fa-video-camera"></i>
                </label>
                <input id="file-upload" name="file-upload" type="file" class="hidden-input">

                <button class="ui right floated primary labeled icon button tiny">
                    <i class="fa-plus icon"></i>
                    Post
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="ui segment transparent-panel" ng-controller="HomeController">
        <h4>News feed</h4>
        <div class="ui segment transparent-card" ng-show="errorLoading">
            <div class="ui center">
                Sorry, Something went wrong
            </div>
        </div>
        <div class="ui active dimmer longloader" ng-show="loading">
            <div class="ui large text loader">
                Loading...
            </div>
        </div>
        <div class="ui bottom segment transparent-card" ng-repeat="post in posts">
            <div class="ui items" >
                <div class="item">
                    <div class="ui mini circular image">
                        <img src="@{{ post.userInfo.avatarUrl }}">
                    </div>
                    <div class="content">
                        <a class="header">@{{ post.userInfo.name }}</a>
                        <div class="meta">
                            <a href="{{ route('post.full') }}/@{{ post.id }}">
                                <span>@{{ post.humanDate }}</span>
                            </a>
                        </div>
                        <div class="description">
                            <p>@{{ post.content }}</p>
                            <img class="ui rounded image" src="@{{ post.attachmentUrl }}">
                        </div>
                        <div class="extra">
                            <i class="fa fa-comment"></i>
                             @{{ post.commentsCount }}
                             &emsp;
                            <a ng-click="likePost(post.id)">
                                <i class="fa fa-heart" ng-class="{'hearted': post.liked, '': !post.liked}"></i>
                            </a>
                             @{{ post.likesCount }}
                        </div>
                    </div>
                </div>
                <div class="ui devider"></div>
            </div>  
        </div>  
        
    </div>
@endsection


@section('js')
    <script src="{{ URL::asset('client/controllers/HomeController.js') }}"></script>

@endsection