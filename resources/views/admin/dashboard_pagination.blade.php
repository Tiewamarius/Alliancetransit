<div class="table-data">
    <div style="overflow-x: auto;">
        <table class="table table-striped" id="expeditionsTable">
        <thead>
                <tr>
                    <th>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="selectAll" style="width: 15px; height: 15px;">
                            <label class="form-check-label" for="selectAll"></label>
                        </div>
                    </th>
                    <th>Tous</th>
                    <th style="color:black;text-align:center;">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="bulkUpdateStatusDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="width: 120px">
                                STATUS
                            </button>
                            <ul class="dropdown-menu" id="bulkUpdateStatusDropdown">
                                <li><a class="dropdown-item" href="#" data-status="Encour">En Cour</a></li>
                                <li><a class="dropdown-item" href="#" data-status="Arrivé"> Arrivé</a></li>
                                <li><a class="dropdown-item" href="#" data-status="Depot"> En Depot</a></li>
                                <li><a class="dropdown-item" href="#" data-status="Non Livré"> Non Livré</a></li>
                                <li><a class="dropdown-item" href="#" data-status="Livré"> Livré</a></li>
                            </ul>
                        </div>
                    </th>
                    <th style="color:black">TOTAL</th>
                    <th style="color:black">PAYE</th>
                    <th style="color:black">CREDITS</th>
                    <th>DATE-Enlevements</th>
                    <th>CONTENEURS</th>
                    <th>EXPEDITEURS</th>
                    <th>ADRESSE-Expedit.</th>
                    <th>DESIGNATIONS-Colis</th>
                    <th>Num° SUIVIS</th>
                    <th>DESTINATAIRES</th>
                    <th>ADRESSE-Destinat.</th>
                    <th>DATE-LIVRAISON</th>
                    <th>REMARQUE</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($expeditions as $expedition)
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input row-checkbox" type="checkbox" value="{{ $expedition->id }}" style="width: 15px; height: 15px;">
                            <label class="form-check-label" for="rowCheckbox_{{ $expedition->id }}"></label>
                        </div>
                    </td>
                    <td>
                        <a href="editExpedition/{{$expedition->id}}" class="btn btn-outline-danger" style="color: orangered;width: 40px; padding:5px;">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        @if ($expedition->status === 'Non Traité')
                        <div class="dropdown">
                            <a class="btn btn-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $expedition->status}}
                            </a>
                        </div>
                        @elseif ($expedition->status === 'Encour' )
                        <div class="dropdown">
                            <a class="btn btn-warning" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $expedition->status}}
                            </a>
                        </div>
                        @elseif ($expedition->status === 'Arrivé' )
                        <div class="dropdown">
                            <a class="btn btn-success" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $expedition->status}}
                            </a>
                        </div>
                        @elseif ($expedition->status === 'Depot' )
                        <div class="dropdown">
                            <a class="btn btn-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $expedition->status}}
                            </a>
                        </div>
                        @elseif ($expedition->status === 'Non Livré' )
                        <div class="dropdown">
                            <a class="btn btn-secondary" style="background-color: #c9f20f;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $expedition->status}}
                            </a>
                        </div>
                        @elseif ($expedition->status === 'Livré')
                        <a class="btn btn-success" style="background-color:#0ee92b;" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $expedition->status}}
                        </a>
                        @endif
                    </td>
                    <td>{{$expedition->montant_total}}</td>
                    <td>{{$expedition->montant_paye}}</td>
                    <td>{{ $expedition->montant_total - $expedition->montant_paye }}</td>
                    <td>{{ $expedition->dateEnlev }}</td>
                    <td>{{ $expedition->conteneur_id}}</td>
                    <td>{{ $expedition->nom_expediteur}}</td>
                    <td>{{ $expedition->adresse_expediteur}}</td>
                    <td>{{ $expedition->designation }}</td>
                    <td>{{ $expedition->numeroSuivi}}</td>
                    <td>{{ $expedition->nom_destinataire}}</td>
                    <td>{{ $expedition->adresse_expediteur}}</td>
                    <td>{{ \Carbon\Carbon::parse(substr($expedition->dateLivr, 0, 10))->format('d-m-Y') }}</td>
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