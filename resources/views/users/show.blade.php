@extends('_layouts.app')

@section('content')
<ul class="list-group">
    <li class="list-group-item list-group-item-lg">
        <h4 class="u-mt-0 u-mb-0">Tweets by {{ "@{$user->username}" }}</h4>
    </li>

    @foreach ($tweets as $tweet)
    <li class="list-group-item list-group-item-lg">
        @include('tweets.partials.show', ['tweet' => $tweet])
    </li>
    @endforeach
</ul>
@endsection

@section('sidebar')
    @include('partials.user-profile', ['user' => $user])
@endsection
