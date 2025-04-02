@extends('layouts.admin')
@section('title', 'Devis d\'expéditions')

@section('content')
    <div class="container">
        <h1 class="mb-4">Devis d'expéditions demandés</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>Status</th>
                    <th>Type</th>
                    <th>Designation</th>
                    <th>Montant à Definir</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($devisClients as $devis)
                    <tr>
                        <td>
                            <a href="allDevis/{{ $devis->id }}" class="btn btn-outline-danger"
                                style="color: orangered; width: 40px; padding:5px;">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            @if ($devis->status === 'nontraite')
                                <div class="dropdown">
                                    <a class="btn btn-secondary" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        {{ $devis->status }}
                                    </a>
                                </div>
                            @elseif ($devis->status === 'encour')
                                <div class="dropdown">
                                    <a class="btn btn-warning" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        {{ $devis->status }}
                                    </a>
                                </div>
                            @elseif ($devis->status === 'traite')
                                <div class="dropdown">
                                    <a class="btn btn-success" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        {{ $devis->status }}
                                    </a>
                                </div>
                            @endif
                        </td>
                        <td>{{ $devis->particulier }}</td>
                        <td>{{ $devis->designation }}</td>
                        <td>{{ $devis->montant_total }}</td>
                        <td>
                            <a href="{{ route('allDevis.delete', $devis->id) }}" class="btn btn-outline-danger"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette expédition ?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection