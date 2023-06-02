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

@updated(['date' => $post->created_at, 'name' => $post->user->name])
@endupdated

@tags(['tags' => $post->tags])
@endtags

@auth
    @if ($post->trashed())
        </del>
    @endif
@endauth




<div class="mb-3">
    @if ($post->comments_count)
        <p>{{ $post->comments_count }} comments</p>
    @else
        <p>No comments yet!!</p>
    @endif
</div>



<div class="mb-3">
    @auth
        @can('update', $post)
            <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit</a>
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
                    <input type="submit" value="Delete" class="btn btn-danger">
                </form>
            @endcan
        @endif
    @endauth

</div>
