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
                {{ __('Brand new Post!') }}
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
            {{ __('Updated') }}
        @endupdated

        @tags(['tags' => $post->tags])
        @endtags

        <p>{{ trans_choice('messages.people.reading', $counter) }}</p>

        <h4> {{ __('Comments') }} </h4>

        @commentForm(['route' => route('posts.comments.store', ['post' => $post->id])])
        @endcommentForm

        @commentList(['comments' => $post->comments])
        @endcommentList


    </div>

    <div class="col-4">
        @include('posts.partials.activity')
    </div>
    </div>
@endsection
