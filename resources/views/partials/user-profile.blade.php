<div class="panel panel-default">
    <div class="panel-heading text-center">
        <h4>{{ '@' . Auth::user()->username }}</h4>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-4">
                <a href="/tweets" class="stat">
                    <div class="stat-value">
                        {{ $tweetCount }}
                    </div>
                    <div class="stat-label">
                        {{ str_plural('Tweet', $tweetCount) }}
                    </div>
                </a>
            </div>
            <div class="col-xs-4">
                <a href="/followers" class="stat">
                    <div class="stat-value">
                        {{ $followerCount }}
                    </div>
                    <div class="stat-label">
                        {{ str_plural('Follower', $followerCount) }}
                    </div>
                </a>
            </div>
            <div class="col-xs-4">
                <a href="/following" class="stat">
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
