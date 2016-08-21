@extends('_layouts.app')

@section('sidebar')
    @include('partials.user-profile', ['user' => Auth::user()])
    @include('partials.who-to-follow')
@endsection
