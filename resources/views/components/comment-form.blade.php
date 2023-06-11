<div class="mb-2 mt-2">
    @auth
        <form action="{{ $route }}" method="post">
            @csrf
            <div class="form-group">
                <label for="content">{{ __('Add comment') }}</label>
                <textarea name="content" id="content" class="form-control" cols="10" rows="5"></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block">{{ __('Add comment') }}</button>
        </form>
        @errors
        @enderrors
    @else
        <a href="{{ route('login') }}">{{ __('Sign-in') }}</a> {{ __('to post comments!') }}
    @endauth
</div>
<hr>
