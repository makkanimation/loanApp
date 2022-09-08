@component('mail::message')
{{ $maildata['title'] }}

@component('mail::button', ['url' => $maildata['url']])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
