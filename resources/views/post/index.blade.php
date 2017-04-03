@extends('layouts.app')


@section('content')
    <h2 class="text-info">Awedi fuck o safi </h2>

<div class="ui three cards">
    @foreach($posts as $post)
    <div class="ui card">
        <div class="blurring dimmable image">
            <div class="ui dimmer transition hidden">
                <div class="content">
                    <div class="center">
                        <div class="ui inverted button">Open link</div>
                    </div>
                </div>
            </div>
            <img src="{{ URL::asset('img/man.jpg') }}">
        </div>
        <div class="content">
            <a class="header">{{ $post->title }}</a>
            <div class="meta">
                <span class="date">{{ $post->content }}</span>
            </div>
        </div>
        <div class="extra content">
            <a>
                <i class="users icon"></i>
                {{ $post->created_at->diffForHumans() }}
            </a>
        </div>
    </div>
    @endforeach
</div>


@endsection