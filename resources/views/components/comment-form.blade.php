<div class="mb-2 mt-2">
    @auth
        <form action="{{ $route }}" method="post">
            @csrf
            <div class="form-group">
                <label for="content">Post comment</label>
                <textarea name="content" id="content" class="form-control" cols="10" rows="5"></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Add comment!</button>
        </form>
        @errors
        @enderrors
    @else
        <a href="{{ route('login') }}">Sign-in</a> to post comments!
    @endauth
</div>
<hr>
