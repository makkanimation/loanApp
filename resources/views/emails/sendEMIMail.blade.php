@component('mail::message')
{{ $maildata['data']['body'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
