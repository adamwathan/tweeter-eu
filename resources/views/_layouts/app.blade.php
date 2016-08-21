@extends('_layouts.master')

@section('body')
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            @yield('content')
        </div>
    </div>
</div>
@endsection
