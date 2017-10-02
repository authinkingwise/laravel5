@component('mail::message')
# Introduction

Hi Dear,

You have successfully registered our website. Thank you very much for your registration!

Click below button to login!

@component('mail::button', ['url' => 'http://13.55.209.187:8080/login', 'color' => 'green'])
Click here to Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
