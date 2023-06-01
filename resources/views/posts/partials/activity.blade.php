<div class="container">
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
