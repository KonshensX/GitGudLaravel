@extends('layouts.app')

@section('content')
    <div class="ui grid">
        <div class="row">
            <div class="ten wide column">
                <div class="ui four cards">
                    @foreach($profiles as $profile)
                        <div class="ui card">
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
                                <img src="{{ $profile->avatarUrl }}">
                            </div>
                            <div class="content">
                                <div class="header">
                                    <a href="{{ route('profile.full', ['id' => $profile->id]) }}">
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