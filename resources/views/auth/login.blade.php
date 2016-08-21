@extends('_layouts.master')

@section('body')
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Sign in to your Tweeter account
                </div>
                <div class="panel-body">
                    @if ($errors->has('auth'))
                        <div class="alert alert-info">
                            {{ $errors->first('auth') }}
                        </div>
                    @endif

                    <form action="/sign-in" method="POST">
                        {!! csrf_field() !!}
                        <div class="form-group {{ $errors->first('username', 'has-error') }}">
                            <label class="control-label">Username</label>
                            <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                            {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
                        </div>
                        <div class="form-group {{ $errors->first('password', 'has-error') }}">
                            <label class="control-label">Password</label>
                            <input type="password" class="form-control" name="password">
                            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
