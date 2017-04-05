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
                        <a class="header">
                            {{ $profile->fullname }}
                        </a>
                        <div class="meta">
                            <span class="date">
                                <i class="fa fa-map-marker"></i>
                                 {{ $profile->location }}
                            </span>
                            <br>
                            <i class="fa fa-audio-description"></i>
                            <p> {{ $profile->about }} </p>
                        </div>
                    </div>
                    <div class="extra content">
                        <a>
                            <i class="fa-calendar icon"></i>
                            Member since : {{ $profile->created_at->format('Y M d') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="eleven wide column">
                <h4 class="ui top attached blue header">
                    <i class="fa fa-user"></i>
                    Update informations
                </h4>
                <div class="ui bottom attached segment" style="overflow: hidden">
                    {{ Form::open(['url' => route('profile.update')]) }}
                    <div class="ui form">
                        <div class="field">
                            <label>
                                Full name
                            </label>
                            {!! Form::text('fullname', $profile->fullname) !!}
                        </div>
                        <div class="field">
                            <label>
                                Birth date
                            </label>
                            {!! Form::select('birthdate') !!}
                        </div>
                        <div class="field">
                            <label>
                                Location
                            </label>
                            {!! Form::text('location', $profile->location) !!}
                        </div>
                        <div class="field">
                            <label>
                                About
                            </label>
                            {!! Form::textarea('about', $profile->about, ['rows' => 3]) !!}
                        </div>
                        <button class="ui right floated primary labeled icon button">
                            <i class="fa-save icon"></i>
                            Send
                        </button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection