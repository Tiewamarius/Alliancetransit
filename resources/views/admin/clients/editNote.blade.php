@extends('layouts.admin')

@section('content')
<div class="container">

    <form action="{{ route('updateNote', $note->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2em;">
            <div style="flex-grow: 1; margin-right: 20px;">
                <h2 style="color: #333; margin-bottom: 1em;">Informations de contact</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1em; margin-bottom: 1.5em; border-bottom: 1px solid #eee; padding-bottom: 1.5em;">
                    <div>
                        <strong style="display: block; color: #777; font-size: 0.8em; margin-bottom: 0.3em;">NOMS</strong>
                        <span>{{ $note->name }}</span>
                    </div>
                    <div>
                        <strong style="display: block; color: #777; font-size: 0.8em; margin-bottom: 0.3em;">E-MAIL</strong>
                        <span>{{ $note->email }}</span>
                    </div>
                    @if(isset($note->phone))
                    <div>
                        <strong style="display: block; color: #777; font-size: 0.8em; margin-bottom: 0.3em;">TÉLÉPHONE</strong>
                        <span>{{ $note->phone }}</span>
                    </div>
                    @endif
                    <div>
                        <strong style="display: block; color: #777; font-size: 0.8em; margin-bottom: 0.3em;">REÇU LE</strong>
                        <span>{{ $note->created_at }}</span>
                    </div>
                    <div>
                        <strong style="display: block; color: #777; font-size: 0.8em; margin-bottom: 0.3em;">ADRESSE</strong>
                        <span>{{ $note->address ?? ':' }}</span>
                    </div>
                    <div>
                        <strong style="display: block; color: #777; font-size: 0.8em; margin-bottom: 0.3em;">ENTREPRISE</strong>
                        <span>{{ $note->entreprise ?? ':' }}</span>
                    </div>
                    <div>
                        <strong style="display: block; color: #777; font-size: 0.8em; margin-bottom: 0.3em;">SUJET</strong>
                        <span>{{ $note->subject }}</span>
                    </div>
                </div>

                <div style="margin-bottom: 2em; border-bottom: 1px solid #eee; padding-bottom: 2em;">
                    <strong style="display: block; color: #777; font-size: 0.8em; margin-bottom: 0.5em;">CONTENU</strong>
                    <p style="color: #444; font-size: 0.9em;">
                        {{ $note->message }}
                    </p>
                </div>

                <div>
                    <h3 style="color: #333; margin-bottom: 1em;">Réponses</h3>
                    <div style="padding: 1em; border: 1px solid #ddd; border-radius: 4px; background-color: #f9f9f9; margin-bottom: 1em;">
                        <p style="color: #777; font-size: 0.9em; margin-bottom: 0.5em;">Pas encore de réponse !</p>
                        <button style="background-color: #f0f0f0; color: #333; border: 1px solid #ccc; padding: 0.5em 1em; border-radius: 4px; cursor: pointer; font-size: 0.9em;">Répondre</button>
                    </div>
                </div>
            </div>

            <div style="width: 250px; padding: 1em; border: 1px solid #ddd; border-radius: 4px; background-color: #f9f9f9;">
                <h3 style="color: #333; margin-bottom: 1em;">Publier</h3>
                <button type="submit" name="action" value="save_edit" style="background-color: #007bff; color: white; border: none; padding: 0.8em 1.2em; border-radius: 4px; cursor: pointer; width: 100%; margin-bottom: 0.5em; font-size: 0.9em;">Sauvegarder et éditer</button>
                <button type="submit" name="action" value="save" style="background-color: #f0f0f0; color: #333; border: 1px solid #ccc; padding: 0.8em 1.2em; border-radius: 4px; cursor: pointer; width: 100%; margin-bottom: 1em; font-size: 0.9em;">Sauvegarder</button>

                <div>
                    <label for="status" style="display: block; color: #333; font-size: 0.9em; margin-bottom: 0.3em;">Statut *</label>
                    <select name="status" id="status" style="width: 100%; padding: 0.6em; border: 1px solid #ccc; border-radius: 4px; font-size: 0.9em;">
                        <option value="unread" {{ $note->status === 'unread' ? 'selected' : '' }}>Non lu</option>
                        <option value="read" {{ $note->status === 'read' ? 'selected' : '' }}>Lu</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection