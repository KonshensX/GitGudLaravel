@extends('layouts.app')

@section('content')
    <h2 class="center" data-name="{{ $query }}">Search results for {{ $query }}</h2>
    <input type="hidden" id="query" data-name="{{ $query }}" value="{{ $query }}">
    <div class="ui four cards" ng-controller="SearchController">
        <div class="ui active dimmer" ng-show="loading">
            <div class="ui large text loader">
                Loading...
            </div>
        </div>
        <div class="ui card" ng-repeat="profile in results">
            <div class="blurring dimmable image">
              <div class="ui dimmer transition hidden">
                <div class="content">
                  <div class="center">
                    <div class="ui green button"
                     ng-click="toggleFollow(profile.id)"
                     ng-class="{'green': !profile.isFollowed, 'red': profile.isFollowed}">
                    <span ng-if="!profile.isFollowed">Follow</span>
                    <span ng-if="profile.isFollowed">Unfollow</span>
                    </div>
                  </div>
                </div>
              </div>
              <img src="@{{ profile.avatarUrl }}">
            </div>
            <div class="content">
              <a class="header">@{{ profile.fullname }}</a>
              <div class="meta">
                <span class="date">@{{ profile.name }}</span>
              </div>
            </div>
            <div class="extra content">
              <a>
                <i class="clock icon"></i>
                Joined @{{ profile.humanDate }}
              </a>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ URL::asset('client/controllers/SearchController.js') }}"></script>
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