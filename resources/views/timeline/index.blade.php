@extends('_layouts.app')

@section('content')
<ul class="list-group">
    <li class="list-group-item list-group-item-lg">
        @include('tweets.partials.create')
    </li>
    @foreach ($tweets as $tweet)
        <li class="list-group-item list-group-item-lg">
            @include('tweets.partials.show', ['tweet' => $tweet])
        </li>
    @endforeach
</ul>
<div class="text-center">
    {!! $tweets->links('partials.pagination') !!}
</div>
@endsection

@section('sidebar')
    @include('partials.user-profile', ['user' => Auth::user()])
@endsection
