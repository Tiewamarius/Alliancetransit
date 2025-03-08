
<div class="table-data">
<div style="overflow-x: auto;">
    <table class="table table-striped" id="expeditionsTable">
        <thead>
            <tr>
                <th></th>
                <th style="color:black;text-align:center;">STATUS</th>
                <th style="color:black">CREDITS</th>
                <th>DATE-ENLEVEMENTS</th>
                <th>NUMERO-SUIVIS</th>
                <th>EXPEDITEURS</th>
                <th>DESIGNATIONS-Colis</th>
                <th>DESTINATAIRES</th>
                <th>DATE-LIVRAISON</th>
                <th>REMARQUE</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($expeditions as $expedition)
            <tr>
                <td>
                    <a href="editExpedition/{{$expedition->id}}" class="btn btn-outline-danger" style="color: orangered;width: 40px; padding:5px;"><i class="fas fa-edit"></i></a>
                </td>
                <td>
                    @if ($expedition->status === 'encour')
                    @if (Auth::user()->code_unique == $expedition->expediteur_id)
                    <div class="dropdown">
                        <a class="btn btn-warning" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $expedition->status}}
                        </a>
                    </div>
                    @else
                    <form method="POST" action="{{ route('update.status', $expedition->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="dropdown">
                            <a class="btn btn-warning dropdowntoggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $expedition->status }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('update.status', $expedition->id) }}" onclick="updateStatus('{{ $expedition->id }}', 'encour')">ENCOUR</a></li>
                                <li><a class="dropdown-item" href="{{ route('update.status', $expedition->id) }}" onclick="updateStatus('{{ $expedition->id }}', 'depot')">STOCK</a></li>
                                <li><a class="dropdown-item" href="{{ route('update.status', $expedition->id) }}" onclick="updateStatus('{{ $expedition->id }}', 'terminer')">TERMINER</a></li>
                            </ul>
                        </div>
                        <input type="hidden" name="status" id="statusInput">
                    </form>
                    @endif
                    @elseif ($expedition->status === 'Non Livré' )
                    @if (Auth::user()->code_unique == $expedition->expediteur_id)
                    <div class="dropdown">
                        <a class="btn btn-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $expedition->status}}
                        </a>
                    </div>
                    @else
                    <form method="POST" action="{{ route('update.status', $expedition->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdowntoggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $expedition->status }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" onclick="updateStatus('{{ $expedition->id }}', 'encour')">ENCOUR</a></li>
                                <li><a class="dropdown-item" href="#" onclick="updateStatus('{{ $expedition->id }}', 'depot')">STOCK</a></li>
                                <li><a class="dropdown-item" href="#" onclick="updateStatus('{{ $expedition->id }}', 'terminer')">Livré</a></li>
                            </ul>
                        </div>
                        <input type="hidden" name="status" id="statusInput">
                    </form>
                    @endif
                    @elseif ($expedition->status === 'Livré')
                    <a class="btn btn-success" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ $expedition->status}}
                    </a>
                    @endif

                </td>
                <td>{{ $expedition->montant_total - $expedition->montant_paye }}</td>
                <td>{{ $expedition->dateEnlev }}</td>
                <td>{{ $expedition->numeroSuivi}}</td>
                <td>{{ $expedition->nom_expediteur}}</td>
                <td>{{ $expedition->designation }}</td>
                <td>{{ $expedition->nom_destinataire}}</td>
                </td>
                <td>{{ $expedition->dateLivr}}</td>
                <td>{{ $expedition->typeService}}</td>
                <td>
                <a href="{{ route('expeditions.delete', $expedition->id) }}" class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette expédition ?')"><i class="fas fa-trash-alt"></i></a>
                
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $expeditions->links() !!}
</div>
</div>