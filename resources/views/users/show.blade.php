@extends('_layouts.app')

@section('content')
<ul class="list-group">
    <li class="list-group-item list-group-item-lg flex-justified">
        <div>
            <h4 class="u-mt-0 u-mb-0">Tweets by {{ "@{$user->username}" }}</h4>
        </div>
        @if (Auth::check() && Auth::user()->canFollow($user))
        <form action="/following" method="POST">
            {!! csrf_field() !!}
            <input type="hidden" name="username" value="{{ $user->username }}">
            <button type="submit" href="#" class="btn btn-default">Follow</button>
        </form>
        @endif
    </li>

    @forelse ($tweets as $tweet)
    <li class="list-group-item list-group-item-lg">
        @include('tweets.partials.show', ['tweet' => $tweet])
    </li>
    @empty
    <li class="list-group-item list-group-item-lg text-center">
        It looks like {{ "@{$user->username}" }} hasn't tweeted yet!
    </li>
    @endforelse
</ul>
@endsection
