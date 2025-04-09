@extends('layouts.admin')
@section('title', 'note d\'expéditions')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tous les messages</h1>
        <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Action</th>
                <th>Nom</th>
                <th>Numero</th>
                <th>Email</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notesClients as $note)
                <tr>
                    <td>
                        <a href="editNote/{{ $note->id }}" class="btn btn-outline-danger" style="color: orangered; width: 40px; padding:5px;">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                    <td>{{ $note->name}}</td>
                    <td>{{ $note->phone}}</td>
                    <td>{{ $note->email }}</td><td>
                        @if ($note->status === 'unread')
                            <div class="dropdown">
                                <a class="btn btn-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $note->status }}
                                </a>
                            </div>
                            </div>
                        @elseif ($note->status === 'read')
                            <div class="dropdown">
                                <a class="btn btn-success" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $note->status }}
                                </a>
                            </div>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('deleteNote.delete', $note->id) }}" class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette expédition ?')">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection