@extends('_layouts.logged-in')

@section('content')
<ul class="list-group">
    @foreach ($tweets as $tweet)
        <li class="list-group-item list-group-item-lg">
            @include('tweets.partials.show', ['tweet' => $tweet])
        </li>
    @endforeach
</ul>
{!! $tweets->links('partials.pagination') !!}
@endsection
