<form action="/following/{{ $follow->username }}" method="POST">
    {!! csrf_field() !!}
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" class="btn btn-sm btn-danger">Unfollow</button>
</form>
