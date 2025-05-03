@extends('layouts.admin')
@section('title','List-Clients')
@section('content')

<h3>liste des Abonnés/Clients</h3>
<input type="text" id="searchUsers" name="searchUsers" class="form-control" style="min-width:200px; width:350px;float:right;" placeholder="Chercher..."><br><br>
        <div class="tableUsers-data">
        <div style="overflow-x: auto;">
            <table class="table table-striped" id="AllclientsTable">
                <thead>
                    <tr>
                        <th></th>
                        <th>Identifiant</th>
                        <th>Nom</th>
                        <th>Numero</th>
                        <th>Email</th>
                        <th>Adresse</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Allclients as $user)
                    <tr>
                        <td>
                            <!-- editAllclients/{{$user->id}} -->
                            <a href="" class="btn btn-outline-danger" style="color: orangered;width: 40px; padding:5px;">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>{{ $user->code_unique }}</td>
                        <td>{{ $user->name}}</td>
                        <td>{{ $user->numero}}</td>
                        <td>{{ $user->email}}</td>
                        <td>{{ $user->adresse}}</td>
                        
                        <td>
                            @if (in_array($user->id, $onlineUserIds))
                            <a class="btn btn-success" style="background-color:#0ee92b;" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                en ligne
                            </a>
                            @else
                                <a class="btn btn-secondary" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    deconnecté
                                </a>
                            @endif
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $Allclients->links()}}
        </div>
        </div>

@endsection