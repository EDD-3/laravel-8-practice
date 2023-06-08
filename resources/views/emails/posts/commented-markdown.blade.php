@component('mail::message')
# Introduction

Hello this a markdown email

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
