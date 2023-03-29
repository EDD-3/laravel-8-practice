{{-- @break($key == 2) --}}
{{-- @continue($key == 1) --}}
@if($loop->even)
<div><h1>{{$key}} . {{ $post->title}} </h1></div>
@else
<div style="background-color: silver"><h1>{{$key}} . {{ $post->title}} </h1></div>
@endif

<div>
    <form action="{{route('posts.destroy', ['post' => $post->id] )}}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete">
    </form>
</div>