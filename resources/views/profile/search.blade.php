@extends('layouts.app')

@section('content')
    <h2 class="center">Search results</h2>
    <div class="ui four cards">
        @foreach($profiles as $profile)
            <div class="ui card">
                <div class="blurring dimmable image">
                    <div class="ui dimmer transition hidden">
                        <div class="content">
                            <div class="center">
                                <div class="ui blue button">Follow</div>
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
@endsection

@section('js')
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