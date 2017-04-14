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
                <div class="ui three cards" ng-controller="FollowingController">
                    <div class="ui active inverted dimmer" ng-show="loading">
                        <div class="ui text loader">Loading....</div>
                    </div>
                    <div class="ui three cards">
                        <div class="ui card" ng-repeat="profile in profiles">
                            <div class="blurring dimmable image">
                              <div class="ui dimmer transition hidden">
                                <div class="content">
                                  <div class="center">
                                    <div class="ui inverted button">Followed</div>
                                  </div>
                                </div>
                              </div>
                              <img src="@{{ profile.avatarUrl }}">
                            </div>
                            <div class="content">
                              <a class="header">@{{ profile.user.fullname }}</a>
                              <div class="meta">
                                <span class="date">@{{ profile.user.name }}</span>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ URL::asset('client/controllers/FollowingController.js') }}"></script>
@endsection