php
@component('mail::message')
# Réponse à votre message

Vous avez reçu une réponse à votre message concernant "{{ $note->subject }}":

@component('mail::panel')
{{ $replyContent }}
@endcomponent

Merci,
{{ config('app.name') }}
@endcomponent