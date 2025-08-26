@component('mail::message')
# Hello {{ $firstName }},

Are you ready to kickstart your wellness journey and unlock amazing benefits with Woliba?
Just click the button below to get started:

@component('mail::button', ['url' => $link])
Register Now
@endcomponent

This link will expire in 30 minutes.After you register, download the Woliba app then login using your email and password created during registration.  

In Health & Wellness,
The Woliba team
@endcomponent
