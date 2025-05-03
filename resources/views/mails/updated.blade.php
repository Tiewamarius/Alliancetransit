@component('mail::message')
# Mise à jour du statut de votre message

Le statut de votre message concernant "{{ $note->subject }}" a été mis à jour à: **{{ $note->status }}**.

Merci,
{{ config('app.name') }}
@endcomponent