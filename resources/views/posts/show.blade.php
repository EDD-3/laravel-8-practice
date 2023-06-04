{{-- Shows the blog post with comments --}}

@extends('layouts.app')
@section('title', $post->title)

@section('content')
    <div class="row">
        <div class="col-8">
            @if ($post->image)
                <div
                    style="background-image: url('{{ $post->image->url() }}'); 
                    min-height: 500px; color: white; 
                    text-align: center; 
                    background-attachment:fixed;">
                    <h1 style="padding-top: 100px; text-shadow: 1px 3px #000;">
                    @else
                        <h1>
            @endif
            {{ $post->title }}
            @badge(['show' => now()->diffInMinutes($post->created_at) <= 30])
                Brand new Post!
            @endbadge
            @if ($post->image)
        </div>
    @else
        </h1>
        @endif
        {{-- Without using the aliasing in AppServiceProvider --}}
        {{-- <x-badge type="primary"> Brand new Post! </x-badge> --}}
        </h1>
        <p>{{ $post->content }}</p>

        {{-- When using this option you only have to worry changing the .env FILESYSTEM_DRIVER constant --}}

        @updated(['date' => $post->created_at, 'name' => $post->user->name])
        @endupdated

        @updated(['date' => $post->updated_at])
            Updated
        @endupdated

        @tags(['tags' => $post->tags])
        @endtags

        <p>Currently read by {{ $counter }} people </p>

        <h4>Comments</h4>

        @include('comments.form')

        @forelse($post->comments as $comment)
            <p class="font-italic">{{ $comment->content }}</p>

            {{-- <p class="text-muted">
                added {{ $comment->created_at->diffForHumans() }}
            </p> --}}
            @updated(['date' => $comment->created_at, 'name' => $comment->user->name])
            @endupdated
        @empty
            <p>No comments yet!</p>
        @endforelse
    </div>

    <div class="col-4">
        @include('posts.partials.activity')
    </div>
    </div>
@endsection
