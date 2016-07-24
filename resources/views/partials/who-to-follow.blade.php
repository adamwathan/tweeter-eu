<ul class="list-group">
    <li class="list-group-item">
        <h4>Who To Follow</h4>
    </li>
    @forelse ($users as $user)
    <li class="list-group-item flex-justified">
        <div>
            <strong>{{ '@' . $user->username }}</strong>
        </div>
        <form action="/following" method="POST">
            {!! csrf_field() !!}
            <input type="hidden" name="username" value="{{ $user->username }}">
            <button type="submit" href="#" class="btn btn-sm btn-default">Follow</button>
        </form>
    </li>
    @empty
        <li class="list-group-item text-center">
            Yikes, it looks like you're the only tweeter!
        </li>
    @endforelse
</ul>
