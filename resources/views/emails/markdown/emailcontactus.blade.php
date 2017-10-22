@component('mail::message')

You have received a new message from your website contact form.Here are the details:

Name:   {{$name}}:

Email:  {{$email}}

Phone:  {{$phone}}

Message:{{$message}}

@component('mail::button', ['url' => 'http://13.55.209.187:8080/' ])
    Browser More
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
