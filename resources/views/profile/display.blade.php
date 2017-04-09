@extends('layouts.app')

@section('content')
    <div class="ui grid">
        <div class="row">
            <div class="six wide column">
                @include('profile.usercard')
            </div>
            <div class="ten wide column">
                <div class="ui blue secondary pointing menu">
                    <a class="active item" href="#posts" data-tab="posts">
                        <i class="fa fa-square"></i>
                         Posts
                    </a>
                    <a class="item" href="#likes" data-tab="likes">
                        <i class="fa fa-heart"></i>
                        Likes
                    </a>
                </div>
                <div class="ui bottom attached active tab segment" data-tab="posts" ng-controller="ProfileController" ng-init="init({{ $profile->id }})">
                    <div class="ui active inverted dimmer" ng-show="loading">
                        <div class="ui text loader">
                            Loading ...
                        </div>
                    </div>
                    <article ng-reapeat="post in posts">
                        @{{ post.content }}
                    </article>
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