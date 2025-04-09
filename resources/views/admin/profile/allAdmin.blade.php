@extends('layouts.admin')
@section('title','EnvoiColis')
@section('content')

@if (Auth::guard('admin')->user()->role === 'admin')
<div class="container">
    
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h3>GESTION DES ROLES</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Numéro</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admin as $admin)
                <tr>
                    <td>{{ $admin->code_unique }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->numero ?? '-' }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.admins.updateRole', $admin->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <select class="form-control form-control-sm" name="role">
                                    <option value="admin" {{ $admin->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="agent" {{ $admin->role === 'agent' ? 'selected' : '' }}>agent</option>
                                </select>
                            </div>
                    </td>
                    <td>
                            <button type="submit" class="btn btn-success btn-sm">Valider</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @else
        <div class="alert alert-danger" role="alert">
        Vous n'avez pas les autorisations nécessaires pour accéder à cette page.
        </div>
    @endif  

@endsection