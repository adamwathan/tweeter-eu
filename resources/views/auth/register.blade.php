@extends('_layouts.master')

@section('body')
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Create a new Tweeter account
                </div>
                <div class="panel-body">
                    <form action="/sign-up" method="POST">
                        {!! csrf_field() !!}
                        <div class="form-group {{ $errors->first('email', 'has-error') }}">
                            <label class="control-label">Email</label>
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                        </div>
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
                            <button type="submit" class="btn btn-primary btn-block">Sign up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
