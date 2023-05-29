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
            <div class="container">

                {{-- Card 1 --}}
                {{-- <div class="row">
                    <div class="card" style="width: 100%;">
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
                </div> --}}

                {{-- Card 2 --}}
                {{-- <div class="row mt-4">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Most Active</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Users with most posts written.</h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($mostActive as $activeUser)
                                <li class="list-group-item">
                                    <p>{{ $activeUser->name}}</p>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div> --}}

                {{-- Card 3 --}}
                {{-- <div class="row mt-4">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Most Active</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Users with most posts written last month.</h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($mostActiveLastMonth as $activeUserLastMonth)
                                <li class="list-group-item">
                                    <p>{{ $activeUserLastMonth->name }}</p>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div> --}}

                {{-- Card 1 --}}
                @card(['title' => 'Most Commented', 'subtitle' => 'What People are currently talking about.'])
                    @slot('items')
                        @foreach ($mostCommented as $bestPost)
                            <li class="list-group-item">
                                <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                    {{ $bestPost->title }}
                                </a>
                            </li>
                        @endforeach
                    @endslot
                @endcard

                {{-- Card 2 --}}
                @card(['title' => 'Most Active', 'subtitle' => 'Users with most posts written last month.'])
                    @slot('items', collect($mostActiveLastMonth)->pluck('name'))
                @endcard


                {{-- Card 3 --}}
                @card(['title' => 'Most Active', 'subtitle' => 'Users with most posts written'])
                    @slot('items', collect($mostActive)->pluck('name'))
                @endcard

            </div>
        </div>
    </div>


@endsection
