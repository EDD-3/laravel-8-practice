{{-- Component for displaying if the post/comment was edited or recently added --}}
{{ empty(trim($slot)) ? __('Added') : $slot }} {{ $date->diffForHumans() }}
@if (isset($name))
    @if (isset($userId))
        {{ __('by') }} <a href="{{ route('users.show', ['user' => $userId]) }}"> {{ $name }}</a>
    @else
        {{ __('by') }} {{ $name }}
    @endif
@endif
