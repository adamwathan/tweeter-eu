@extends('_layouts.logged-in')

@section('content')
<ul class="list-group">
    <li class="list-group-item list-group-item-lg">
        <h4 class="u-mt-0 u-mb-0">Your Tweets</h4>
    </li>
    @forelse ($tweets as $tweet)
        <li class="list-group-item list-group-item-lg">
            @include('tweets.partials.show', ['tweet' => $tweet])
        </li>
    @empty
        <li class="list-group-item text-center">
            Yikes, it looks like you don't have any tweets yet!
        </li>
    @endforelse
</ul>
{!! $tweets->render() !!}
@endsection
