@extends('layouts.app')

@section('content')
    <div class="ui grid">
        <div class="row">
            <div class="five wide column">
                <div class="ui card">
                    <div class="blurring dimmable image">
                        <div class="ui dimmer transition hidden">
                            <div class="content">
                                <div class="center">
                                    <div class="ui inverted button">Open link</div>
                                </div>
                            </div>
                        </div>
                        <img src="{{ URL::asset('uploads/avatar') . '/' . $profile->avatar_name }}">
                    </div>
                    <div class="content">
                        <a class="header">lorem</a>
                        <div class="meta">
                            <p>
                                {{ $profile->about }}
                            </p>
                            <span class="date">
                                <i class="fa fa-map-marker"></i>
                                 {{ $profile->location }}
                            </span>
                        </div>
                    </div>
                    <div class="extra content">
                        <a>
                            <i class="fa fa-calendar"></i>
                            Member since {{ $profile->created_at->format('Y M d') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="eleven wide column">
                <div class="ui secondary pointing menu">
                    <a class="active item">Posts</a>
                    <a class="item">Followers</a>
                    <a class="item">Likes</a>
                </div>
            </div>
        </div>
    </div>
@endsection()