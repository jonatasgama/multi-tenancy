<x-mail::message>
# {{ $emailData['title'] }}

{{ $emailData['body'] }}

Até breve,<br>
{{ config('app.name') }}
</x-mail::message>
