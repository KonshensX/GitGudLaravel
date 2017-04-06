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
                </div>
            </div>
            <div class="ten wide column">
                <div class="ui blue secondary pointing menu">
                    <a class="active item" href="#posts">
                        <i class="fa fa-square"></i>
                         Posts
                    </a>
                    <a class="item" href="#likes">
                        <i class="fa fa-heart"></i>
                        Likes
                    </a>
                </div>
                <div id="posts">
                    qdfgvhjk,l
                </div>
                <div id="likes">
                    likes hahah
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document)
                .ready(function() {
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