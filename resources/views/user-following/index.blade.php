@extends('_layouts.app')

@section('content')
<ul class="list-group" id="following">
    <li class="list-group-item list-group-item-lg">
        <h4 class="u-mt-0 u-mb-0">People {{ "@{$user->username}" }} follows</h4>
    </li>

    @forelse ($following as $follow)
    <li class="list-group-item list-group-item-lg-short flex-justified">
        <div>
            <a href="{{ route('users.show', ['username' => $follow->username]) }}" class="link-secondary">
                <strong>{{ '@' . $follow->username }}</strong>
            </a>
        </div>
        <form action="/following/{{ $follow->username }}" method="POST">
            {!! csrf_field() !!}
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" href="#" class="btn btn-sm btn-danger">Unfollow</button>
        </form>
    </li>
    @empty
    <li class="list-group-item list-group-item-lg text-center">
        It looks like {{ "@{$user->username}" }} isn't following anyone yet!
    </li>
    @endforelse
</ul>
@endsection

@section('sidebar')
    @include('partials.user-profile', ['user' => $user])
@endsection
