@forelse($comments as $comment)
    <p class="font-italic">{{ $comment->content }}</p>

    {{-- <p class="text-muted">
    added {{ $comment->created_at->diffForHumans() }}
</p> --}}

    @tags(['tags' => $comment->tags])
    @endtags

    @updated(['date' => $comment->created_at, 'name' => $comment->user->name, 'userId' => $comment->user->id])
    @endupdated
@empty
    <p>{{ trans_choice('messages.comments', count($comments)) }}</p>
@endforelse
