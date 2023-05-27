@extends('layouts.app')
@section('title', 'Blog Post')

@section('content')
    {{-- @each('post.partials.post', $post, 'post') --}}
    <div class="row">
        <div class="col-8">
            @forelse ($posts as $key => $post)
                @include('posts.partials.post', [])
            @empty
                <div class="container">
                    <h1>No posts found!</h1>
                </div>
            @endforelse
        </div>
        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Most Commented</h5>
                    <h6 class="card-subtitle mb-2 text-muted">What People are currently talking about.</h6>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($mostCommented as $bestPost)
                        <li class="list-group-item">
                            <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                {{ $bestPost->title }}
                            </a>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>

@endsection
