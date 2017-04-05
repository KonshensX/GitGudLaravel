@extends('layouts.app')

@section('content')
    <h2 class="blue">Search results</h2>
    <div class="ui four cards">
        @foreach($profiles as $profile)
            <div class="ui card">
                <div class="image dimmable">
                    <div class="ui blurring inverted dimmer transition hidden">
                        <div class="content">
                            <div class="center">
                                <div class="ui teal button">Follow</div>
                            </div>
                        </div>
                    </div>
                    <img src="{{ URL::asset('uploads/avatar') . '/' . $profile->avatar_name }}">
                </div>
                <div class="content">
                    <div class="header">
                        <a href="{{ route('profile.full', ['id' => $profile->id]) }}">
                            <i class="fa fa-user-circle"></i>
                            {{ $profile->fullname }}
                        </a>
                    </div>
                    <div class="description">{{ $profile->about }}</div>
                </div>
                <div class="extra content">
                    <a class="friends">
                        <i class="fa fa-clock-o"></i>
                         Joined {{ $profile->created_at->diffForHumans() }}</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection