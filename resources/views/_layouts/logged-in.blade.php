@extends('_layouts.master')

@section('body')
<div class="container">
    <div class="row">
        <div class="col-sm-7">
            @yield('content')
        </div>
        <div class="col-sm-5">
            @if (Auth::check())
                @include('partials.user-profile')
                @include('partials.who-to-follow')
            @endif
        </div>
    </div>
</div>
@endsection
