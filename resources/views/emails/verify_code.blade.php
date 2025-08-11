@component('mail::message')
# Email Verification Code

Hi {{ $user->first_name }},

Your verification code is:

@component('mail::panel')
{{ $code }}
@endcomponent

This code will expire in 60 minutes.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
