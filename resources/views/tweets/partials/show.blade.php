<div>
    <h5 class="u-mt-0">
        <a href="{{ route('users.show', ['username' => $tweet->user->username]) }}" class="link-secondary">
            <strong>{{ '@' . $tweet->user->username }}</strong>
        </a>
        <small>
            {{ $tweet->created_at->diffForHumans() }}
        </small>
    </h5>
    <div>
        {{ $tweet->body }}
    </div>
</div>
