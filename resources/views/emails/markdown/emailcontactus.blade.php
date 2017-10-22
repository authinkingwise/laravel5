@component('mail::message')

You have received a new message from your website contact form.Here are the details:

Name:   {{$name}}:

Email:  {{$email}}

Phone:  {{$phone}}

Message:{{$message}}

@component('mail::button', ['url' => route('/')])
    Browser More
@endcomponent

@component('mail::button', ['url' => route('/login')])
    Replay back
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
