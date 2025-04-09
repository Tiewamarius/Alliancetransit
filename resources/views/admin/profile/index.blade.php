@extends('layouts.admin')
@section('title','EnvoiColis')
@section('content')
<style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

/* Styles spécifiques pour le profil */
.profile-container {
    background-color: #f7f8f9;
    padding: 20px;
    border-radius: 8px;
    font-family: 'Poppins', sans-serif;
}

.profile-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.profile-title {
    display: flex;
    align-items: center;
    color: #555;
    margin-right: 20px;
}

.profile-title svg {
    margin-right: 5px;
}

.profile-title span {
    font-size: 16px;
    font-weight: 500;
    color: #333;
}

.profile-tabs {
    display: flex;
    align-items: center;
}

.profile-tabs button {
    background: none;
    border: none;
    color: #555;
    cursor: pointer;
    margin-right: 15px;
    display: flex;
    align-items: center;
}

.profile-tabs button svg {
    margin-right: 3px;
}

.profile-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
    color: #333;
}

.form-group input[type="text"],
.form-group input[type="email"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

.profile-actions {
    display: flex;
    justify-content: flex-end;
}

.profile-actions button {
    background-color: #007bff;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    display: flex;
    align-items: center;
}

.profile-actions button svg {
    margin-right: 5px;
}

</style>
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
    <h3>Edit Profile</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div style="background-color: #f7f8f9; padding: 20px; border-radius: 8px; font-family: 'Poppins', sans-serif;">
    <div style="background-color: #f7f8f9; padding: 20px; border-radius: 8px; font-family: 'Poppins', sans-serif;">
    <div style="display: flex; align-items: center; margin-bottom: 20px;">
        <div class="profile-tabs" style="display: flex; align-items: center;">
            <button class="tab-button active" data-tab="profile-info" style="background: none; border: none; color: #007bff; cursor: pointer; margin-right: 15px; display: flex; align-items: center; font-weight: bold;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16" style="margin-right: 3px;">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                </svg>
                Profil
            </button>
            <button class="tab-button" data-tab="avatar" style="background: none; border: none; color: #555; cursor: pointer; margin-right: 15px; display: flex; align-items: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16" style="margin-right: 3px;">
                    <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                    <path d="M2 4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H2zm12-2a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h12z"/>
                </svg>
                Avatar
            </button>
            <button class="tab-button" data-tab="password" style="background: none; border: none; color: #555; cursor: pointer; margin-right: 15px; display: flex; align-items: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16" style="margin-right: 3px;">
                    <path d="M3.5 11.5a3.5 3.5 0 1 1 .5-1.5l3-3L15 13l-3 3-3-3l-.5 1.5z"/>
                    <path d="M15 16s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10z"/>
                    <path d="M2.765 6.43a1.29 1.29 0 0 1 .71-.03l5.4 2.95a1.29 1.29 0 0 1 .05.7l-5.4 2.95a1.3 1.3 0 0 1-.7.03L1.2 11.27a.5.5 0 0 1-.318-.682c.08-.08.162-.167.248-.259l5.136-2.81c.432-.237.572-.635.482-.967l-5.137-2.81c-.086-.092-.167-.179-.248-.259a.5.5 0 0 1 .318-.682l1.562-1.28a.5.5 0 0 1 .664.083l5.182 2.83a.5.5 0 0 1 .129.3l-5.182 2.83a.5.5 0 0 1-.664.083l-1.562-1.28z"/>
                </svg>
                Modifier le mot de passe
            </button>
            <button class="tab-button" data-tab="preferences" style="background: none; border: none; color: #555; cursor: pointer; display: flex; align-items: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1 3.4a1.47 1.47 0 0 1-.233.7c-.212.51-.5.959-.947 1.287l-3.413.1c-1.4.413-1.4 2.397 0 2.81l3.4.1a1.47 1.47 0 0 1 .7.233c.51.212.959.5 1.287.947l.1 3.413c.413 1.4 2.397 1.4 2.81 0l.1-3.4a1.47 1.47 0 0 1 .233-.7c.212-.51.5-.959.947-.1.287l3.413-.1c1.4-.413 1.4-2.397 0-2.81l-3.4-.1a1.47 1.47 0 0 1-.7-.233c-.51-.212-.959-.5-1.287-.947l-.1-3.413zM8 10.96a2.96 2.96 0 1 0 0-5.92 2.96 2.96 0 0 0 0 5.92z"/>
                </svg>
                Préférences
            </button>
        </div>
    </div>

    <div id="profile-info" class="tab-content active">
        <form method="POST" action="{{ route('admin.profile.update') }}" class="user">
            @csrf
            @method('PUT')

            <div class="profile-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 20px;">
                <div class="form-group">
                    <label for="nom" style="display: block; margin-bottom: 5px; font-weight: 500; color: #333;">Nom*</label>
                    <input type="text" id="nom" name="name" value="{{ $admin->name ?? '' }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 16px;">
                </div>
                <div class="form-group">
                    <label for="nom_utilisateur" style="display: block; margin-bottom: 5px; font-weight: 500; color: #333;">Numero*</label>
                    <input type="text" id="nom_utilisateur" name="numero" value="{{ $admin->numero?? '' }}"  style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 16px;">
                </div>
                <div class="form-group">
                    <label for="nom_utilisateur" style="display: block; margin-bottom: 5px; font-weight: 500; color: #333;">Adresse</label>
                    <input type="text" id="nom_utilisateur" name="adresse" value="{{ $admin->adresse?? '' }}"  style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 16px;">
                </div>
                <div class="form-group">
                    <label for="email" style="display: block; margin-bottom: 5px; font-weight: 500; color: #333;">Email *</label>
                    <input type="email" id="email" name="email" value="{{ $admin->email ?? '' }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 16px;">
                </div>
            </div>

            <div class="profile-actions" style="display: flex; justify-content: flex-end;">
                <button type="submit" style="background-color: #007bff; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; display: flex; align-items: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16" style="margin-right: 5px;">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                    Mise à jour
                </button>
            </div>
        </form>
    </div>

    <div id="avatar" class="tab-content" style="display: none; padding: 20px; background-color: white; border-radius: 4px; margin-top: 20px;">
        <h2>Avatar</h2>
        <div style="width: 100px; height: 100px; border-radius: 50%; background-color: #007bff; margin-bottom: 10px;">
            </div>
        <button style="background-color: #6c757d; color: white; padding: 8px 12px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px;">Choisir l'image</button>
        </div>

    <div id="password" class="tab-content" style="display: none; padding: 20px; background-color: white; border-radius: 4px; margin-top: 20px;">
        <h2>Modifier le mot de passe</h2>
        </div>

    <div id="preferences" class="tab-content" style="display: none; padding: 20px; background-color: white; border-radius: 4px; margin-top: 20px;">
        <h2>Préférences</h2>
        </div>
</div>

<script>
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Désactiver tous les boutons actifs
            tabButtons.forEach(btn => btn.classList.remove('active'));
            // Cacher tous les contenus d'onglet
            tabContents.forEach(content => content.classList.remove('active'));

            // Activer le bouton cliqué
            button.classList.add('active');
            // Afficher le contenu d'onglet correspondant
            const targetTab = button.getAttribute('data-tab');
            document.getElementById(targetTab).classList.add('active');

            // Mettre en évidence le bouton actif (changer la couleur)
            tabButtons.forEach(btn => {
                if (btn.classList.contains('active')) {
                    btn.style.color = '#007bff';
                    btn.style.fontWeight = 'bold';
                } else {
                    btn.style.color = '#555';
                    btn.style.fontWeight = 'normal';
                }
            });
        });
    });

    // Activer le premier onglet par défaut (Profil)
    document.addEventListener('DOMContentLoaded', () => {
        tabButtons[0].classList.add('active');
        tabContents[0].classList.add('active');
        tabButtons[0].style.color = '#007bff';
        tabButtons[0].style.fontWeight = 'bold';
    });
</script>

<style>
    /* Styles CSS pour les onglets */
    .tab-content {
        display: none; /* Caché par défaut */
    }

    .tab-content.active {
        display: block; /* Affiché lorsque l'onglet est actif */
    }
</style>
</div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @else
        <div class="alert alert-danger" role="alert">
        Vous n'avez pas les autorisations nécessaires pour accéder à cette page.
        </div>
    @endif  

@endsection