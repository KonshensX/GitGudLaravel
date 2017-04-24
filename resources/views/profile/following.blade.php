@extends('layouts.app')

@section('content')
    <div class="ui grid">
        <div class="row">
            <div class="sixteen wide column" >
                <input type="hidden" id="name" data-name="{{ $profile->name }}"> 
                <div class="ui three cards" ng-controller="FollowingController">
                    <div class="ui active inverted dimmer" ng-show="loading">
                        <div class="ui text loader">Loading....</div>
                    </div>
                    <div class="ui card" ng-repeat="profile in profiles">
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
                          <a href="{{ route('profile.display') }}/@{{ profile.name }}" class="header">@{{ profile.fullname }}</a>
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
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ URL::asset('client/controllers/FollowingController.js') }}"></script>
@endsection