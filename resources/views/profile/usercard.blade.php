<div class="ui card transparent-panel">
    <div class="blurring dimmable image">
        <img src="{{ $profile->avatarUrl }}">
    </div>
    <div class="content">
        <a class="header" href="{{ route('profile.display', ['name' => $profile->name]) }}">{{ $profile->fullname }}</a>
        <div class="meta">
            <span class="date">Joined {{ $profile->humanDate }}</span>
        </div>
    </div>
    <div class="extra content">
        @if ($profile->about)
            <p>{{ $profile->about }}</p>
        @else
            <p>"This user likes to keep private"</p>
        @endif
    </div>
    <div class="extra content">
        <a href="{{ route('profile.following', ['name' => $profile->name]) }}">
            <span>Following :<strong>{{ $profile->following()->count() }}</strong></span>
        </a>
    </div>
</div>