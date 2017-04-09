@extends('layouts.app')

@section('content')
    <div class="ui grid">
        <div class="row">
            <div class="six wide column">
                <div class="ui card">
                    <div class="blurring dimmable image">
                        <div class="ui dimmer transition hidden">
                            <div class="content">
                                <div class="center">
                                    <div class="ui inverted button">Call to Action</div>
                                </div>
                            </div>
                        </div>
                        <img src="{{ $profile->avatarUrl }}">
                    </div>
                    <div class="content">
                        <a class="header">{{ $profile->fullname }}</a>
                        <div class="meta">
                            <span class="date">Joined {{ $profile->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="extra content">
                        <p>{{ $profile->about }}</p>
                    </div>
                    <div class="extra content">
                        <a href="{{ route('profile.following', ['name' => $profile->name]) }}">
                            <span>Following :{{ $profile->following()->count() }}</span>
                        </a>
                    </div>
                </div>
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
                <div class="ui bottom attached active tab segment" data-tab="posts">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquid aperiam at autem blanditiis consectetur consequuntur dicta dolorem enim expedita laborum maiores numquam odio quis rerum, vel voluptatum! Numquam, sapiente?</p>
                </div>
                <div class="ui bottom attached tab segment" data-tab="likes">
                    <p>Another Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis ea earum facilis fugit illo repudiandae tenetur? Accusantium aperiam asperiores consequatur cumque doloremque dolores ducimus enim, ex maxime sunt ullam vero!</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
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