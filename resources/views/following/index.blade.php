@extends('_layouts.user-sidebar')

@section('content')
<ul class="list-group">
    <li class="list-group-item list-group-item-lg">
        <h4 class="u-mt-0 u-mb-0">Following</h4>
    </li>

    @forelse ($users as $user)
    <li class="list-group-item list-group-item-lg-short flex-justified">
        <div>
            <a href="{{ route('users.show', ['username' => $user->username]) }}" class="link-secondary">
                <strong>{{ '@' . $user->username }}</strong>
            </a>
        </div>
        <form action="/following/{{ $user->username }}" method="POST">
            {!! csrf_field() !!}
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" href="#" class="btn btn-sm btn-danger">Unfollow</button>
        </form>
    </li>
    @empty
    <li class="list-group-item list-group-item-lg text-center">
        Yikes, it looks like you aren't following anyone yet!
    </li>
    @endforelse
</ul>
@endsection
