@component('mail::message')
# Comment was post you're watching

Hi {{ $user->name }}

Someone has commented on your blog post


@component('mail::button', ['url' => route ('posts.show', ['post' => $comment->commentable->id ]) ])
View the blog post
@endcomponent


@component('mail::button', ['url' =>  route ('users.show', ['user' => $comment->user->id ]) ])
Visit {{ $comment->user->name }} profile
@endcomponent

@component('mail::panel')
    {{ config ('app.name')}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent