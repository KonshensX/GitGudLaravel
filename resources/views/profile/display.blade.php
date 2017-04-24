@extends('layouts.app')

@section('content')
    <div class="ui grid">
        <div class="row">
            <div class="sixteen wide column">
                <div class="ui blue secondary pointing menu">
                    <a class="active item" href="#posts" data-tab="posts">
                        <i class="fa fa-map"></i>
                            &emsp;
                            Posts
                    </a>
                    <a class="item" href="#likes" data-tab="likes">
                        <i class="fa fa-heart"></i>
                            &emsp;
                            Likes
                    </a>
                </div>
                <div class="ui bottom active tab segment" data-tab="posts" ng-controller="ProfileController" ng-init="init({{ $profile->id }})">
                    <div class="ui active dimmer longloader" ng-show="loading">
                        <div class="ui text loader">
                            Loading ...
                        </div>
                    </div>
                            <h4>News feed</h4>
                            <div class="ui segment transparent-card" ng-show="errorLoading">
                                <div class="ui center">
                                    Sorry, Something went wrong
                                </div>
                            </div>
                            <div class="ui bottom segment transparent-card" ng-repeat="post in posts track by $index">
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
                <div class="ui bottom attached tab segment" data-tab="likes">
                    <p>Another Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis ea earum facilis fugit illo repudiandae tenetur? Accusantium aperiam asperiores consequatur cumque doloremque dolores ducimus enim, ex maxime sunt ullam vero!</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ URL::asset('client/controllers/ProfileController.js') }}"></script>
    <script>

        $(document)
                .ready(function() {
                    $('.menu .item').tab();

                    /* this should change both tab content and tab item */
                    $.tab('change tab', 'second');

                    $('.ui.menu .ui.dropdown').dropdown({
                        on: 'hover'
                    });
                    $('.ui.menu a.item')
                            .on('click', function() {
                                $(this)
                                        .addClass('active')
                                        .siblings()
                                        .removeClass('active')
                                ;
                            })
                    ;
                })
        ;
    </script>
@endsection