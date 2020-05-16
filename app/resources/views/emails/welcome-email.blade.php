@component('mail::message')
# Welcome

Thank your for registering.

@component('mail::button', ['url' => '/login'])
Go to login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
