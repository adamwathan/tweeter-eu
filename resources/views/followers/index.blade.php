@extends('_layouts.logged-in')

@section('content')
<ul class="list-group">
    <li class="list-group-item list-group-item-lg">
        <h4 class="u-mt-0 u-mb-0">Followers</h4>
    </li>
    @forelse ($users as $user)
        <li class="list-group-item list-group-item-lg">
            <strong>{{ '@' . $user->username }}</strong>
        </li>
    @empty
        <li class="list-group-item text-center">
            Yikes, it looks like you don't have any followers yet!
        </li>
    @endforelse
</ul>
@endsection
