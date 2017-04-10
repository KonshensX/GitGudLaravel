<div class="ui card transparent-panel">
    <div class="blurring dimmable image">
        <div class="ui dimmer transition hidden">
            <div class="content">
                <div class="center">
                    <div class="ui inverted button">Call to Action</div>
                </div>
            </div>
        </div>
        <img src="{{ $profile->avatarUrl }}">
    </div>
    <div class="content">
        <a class="header" href="{{ route('profile.display', ['name' => $profile->name]) }}">{{ $profile->fullname }}</a>
        <div class="meta">
            <span class="date">Joined {{ $profile->created_at->diffForHumans() }}</span>
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