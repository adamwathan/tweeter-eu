<div>
    <h5 class="u-mt-0">
        <strong>{{ '@' . $tweet->user->username }}</strong>
        <small>
            {{ $tweet->created_at->diffForHumans() }}
        </small>
    </h5>
    <div>
        {{ $tweet->body }}
    </div>
</div>
