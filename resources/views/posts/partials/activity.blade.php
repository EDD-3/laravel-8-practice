<div class="container">
    {{-- Card 1 --}}
    @card(['title' => __('Most Commented'), 'subtitle' => __('What people are currently talking about')])
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
    @card(['title' => __('Most Active'), 'subtitle' => __('Users with most posts written in the month')])
        @slot('items', collect($mostActiveLastMonth)->pluck('name'))
    @endcard


    {{-- Card 3 --}}
    @card(['title' => __('Most Active'), 'subtitle' => __('Writers with most posts written')])
        @slot('items', collect($mostActive)->pluck('name'))
    @endcard

</div>
