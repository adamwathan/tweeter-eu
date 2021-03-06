<div class="panel panel-default">
    <div class="panel-heading text-center">
        <a href="{{ route('users.show', ['username' => $user->username]) }}" class="link-secondary"><h4>{{ '@' . $user->username }}</h4></a>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-4">
                <a href="{{ route('users.show', ['username' => $user->username]) }}" class="stat">
                    <div class="stat-value">
                        {{ $tweetCount }}
                    </div>
                    <div class="stat-label">
                        {{ str_plural('Tweet', $tweetCount) }}
                    </div>
                </a>
            </div>
            <div class="col-xs-4">
                <a href="{{ route('user-followers.index', ['username' => $user->username]) }}" class="stat">
                    <div class="stat-value">
                        {{ $followerCount }}
                    </div>
                    <div class="stat-label">
                        {{ str_plural('Follower', $followerCount) }}
                    </div>
                </a>
            </div>
            <div class="col-xs-4">
                <a href="{{ route('user-following.index', ['username' => $user->username]) }}" class="stat">
                    <div class="stat-value">
                        {{ $followingCount }}
                    </div>
                    <div class="stat-label">
                        Following
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
