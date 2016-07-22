<form action="/tweets" method="POST">
    {!! csrf_field() !!}
    <div class="form-group {{ $errors->first('tweet', 'has-error') }}">
        <textarea class="form-control" name="tweet" rows="3" placeholder="What's going on?">{{ old('tweet') }}</textarea>
        @if ($errors->has('tweet'))
            <p class="help-block">
                {{ $errors->first('tweet') }}
            </p>
        @endif
    </div>
    <div class="text-right">
        <button class="btn btn-primary btn-wide">Tweet</button>
    </div>
</form>
