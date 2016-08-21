@extends('_layouts.app')

@section('content')
<ul class="list-group" id="followers">
    <li class="list-group-item list-group-item-lg">
        <h4 class="u-mt-0 u-mb-0">People following {{ "@{$user->username}" }}</h4>
    </li>

    @forelse ($followers as $follower)
    <li class="list-group-item list-group-item-lg">
        <a href="{{ route('users.show', ['username' => $follower->username]) }}" class="link-secondary">
            <strong>{{ '@' . $follower->username }}</strong>
        </a>
    </li>
    @empty
    <li class="list-group-item list-group-item-lg text-center">
        It looks like {{ "@{$user->username}" }} doesn't have any followers yet!
    </li>
    @endforelse
</ul>
@endsection

@section('sidebar')
    @include('partials.user-profile', ['user' => $user])
@endsection
