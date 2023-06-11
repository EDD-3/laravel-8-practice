{{-- @break($key == 2) --}}
{{-- @continue($key == 1) --}}

<div class='col-8'></div>
<h3>
    @auth
        @if ($post->trashed())
            <del>
        @endif
    @endauth

    <a class="{{ $post->trashed() ? 'text-muted' : '' }}"
        href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
</h3>

{{-- <p>
    Added {{ $post->created_at->diffForHumans() }}
    by {{ $post->user->name }}
</p> --}}

@updated(['date' => $post->created_at, 'name' => $post->user->name, 'userId' => $post->user->id])
@endupdated

@auth
    @if ($post->trashed())
        </del>
    @endif
@endauth

@tags(['tags' => $post->tags])
@endtags

{{ trans_choice('messages.comments', $post->comments_count) }}



<div class="mb-3">
    @auth
        @can('update', $post)
            <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">{{ __('Edit') }}</a>
        @endcan
    @endauth

    {{-- @cannot('delete', $post)
        <p>You can't delete this post</p>
    @endcannot --}}
    @auth
        @if (!$post->trashed())
            @can('delete', $post)
                <form class="d-inline" action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="{{ __('Delete!') }}" class="btn btn-danger">
                </form>
            @endcan
        @endif
    @endauth

</div>
