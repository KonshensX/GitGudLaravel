@extends('layouts.app')

@section('content')
    <div class="ui grid">
        <div class="row">
            <div class="sixteen wide column" >
                <h2 class="ui center aligned icon header">
                    <i class="circular users icon"></i>
                    Following
                </h2>
                <input type="hidden" id="name" data-name="{{ $profile->name }}"> 
                <div class="ui four cards" ng-controller="FollowingController">
                    <div class="ui active inverted dimmer" ng-show="loading">
                        <div class="ui text loader">Loading....</div>
                    </div>
                    <div class="ui card" ng-repeat="profile in profiles">
                        <div class="blurring dimmable image">
                            <div class="ui dimmer transition hidden">
                                <div class="content">
                                    <div class="center">
                                        {!! Form::open(['url' => route('profile.follow')]) !!}
                                        {!! Form::hidden('user_id', $profile->id) !!}
                                        <button type="submit" class="ui blue button">Follow</button>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                            <img src="@{{ profile.avatarUrl }}">
                        </div>
                        <div class="content">
                            <div class="header">
                                <a href="{{ route('profile.full', ['id' => $profile->id]) }}">
                                    @{{ profile.fullname }}
                                </a>
                            </div>
                            <div class="description">@{{ profile.about }}</div>
                        </div>
                        <div class="extra content">
                            <a class="friends">
                                <i class="fa fa-clock-o"></i>
                                Joined @{{ profile.created_at }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ URL::asset('client/controllers/FollowingController.js') }}"></script>
    <script>
        $(document)
                .ready(function() {
                    $('.special.card .image').dimmer({
                        on: 'hover'
                    });
                    $('.star.rating')
                            .rating()
                    ;
                    $('.card .dimmer')
                            .dimmer({
                                on: 'hover'
                            })
                    ;
                })
        ;
    </script>
@endsection