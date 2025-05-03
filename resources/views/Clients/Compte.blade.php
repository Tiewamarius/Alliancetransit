@extends('layouts.Client')
@section('content')
<br><br><br><br>
<style>
    body {
        background-image: url("clients/assets/img/Bckg.png");
        background-repeat: no-repeat;
        background-size: cover;
        /* Cover to fill the entire viewport */
        background-position: center;
        /* Center the background image */
    }


    th {
        text-align: justify;
        white-space: nowrap;
    }

    .containerr {
        display: flex;
        flex-wrap: wrap;
        /* Allow items to wrap on smaller screens */
        margin: 20px auto;
        /* Center the container */
        width: 100%;
        /* Limit container width for larger screens */
    }

    .sidebar {
        flex: 0 0 250px;
        /* Fixed width for sidebar */
        background-color: #fff;
        border: 1px solid #ddd;
        padding: 20px;
        box-sizing: border-box;
        /* Include padding in width calculation */
    }

    .sidebar-item {
        display: flex;
        align-items: center;
        padding: 10px;
        cursor: pointer;
        border-radius: 5px;
        margin-bottom: 5px;
    }

    .sidebar-item i {
        width: 25px;
        margin-right: 10px;
    }

    .sidebar-item.active {
        color: #fff;
        background-color: #3995f1;
    }

    .sidebar-item.manage {
        margin-top: 15px;
        padding: 10px;
        border-top: 1px solid #eee;
        cursor: pointer;
    }

    .contentt {
        flex: 1 1 auto;
        /* Allow content to grow and shrink */
        width: 778px;
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ddd;
        box-sizing: border-box;
        /* Include padding in width calculation */
    }

    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        /* Allow header items to wrap */
    }

    .content-header h2 {
        margin-bottom: 10px;
    }

    .tabs {
        display: flex;
        flex-wrap: wrap;
    }

    .tab {
        padding: 10px 20px;
        border: 1px solid #ddd;
        border-radius: 5px 5px 0 0;
        margin-right: 5px;
        margin-bottom: 5px;
        cursor: pointer;
    }

    .tab.active {
        color: #fff;
        background-color: #3995f1;
    }

    .order {
        background-color: #f9f9f9;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 5px;
        overflow-x: auto;
        /* Enable horizontal scrolling for tables */
    }

    .order table {
        width: 100%;
        border-collapse: collapse;
    }

    .order th,
    .order td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .order th {
        background-color: #f0f0f0;
    }

    .order-status {
        background-color: #d4edda;
        color: #155724;
        padding: 5px 10px;
        border-radius: 3px;
        font-size: 12px;
        font-weight: bold;
        display: inline-block;
    }

    /* Facture Styles */
    .facture {
        border: 1px solid #ddd;
        padding: 20px;
        margin-bottom: 20px;
    }

    .facture header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .facture .infos-client {
        margin-bottom: 15px;
    }

    .facture table {
        width: 100%;
        border-collapse: collapse;
    }

    .facture th,
    .facture td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .facture th {
        background-color: #f0f0f0;
    }

    .facture tfoot td {
        text-align: right;
    }

    /* Responsive Adjustments */
    @media (max-width: 800px) {
        .sidebar {
            flex: 0 0 100%;
            /* Full width on small screens */
            margin-bottom: 15px;
        }

        .contentt {
            flex: 1 1 auto;
            /* Permet au contenu de grandir et de rétrécir */
        }

        /* Media query pour les écrans de tablettes (par exemple, jusqu'à 768px) */
        @media (max-width: 800px) {
            .contentt {
                flex: 0 0 100%;
                /* Full width sur les tablettes */
            }
        }

        /* Media query pour les écrans de smartphones (par exemple, jusqu'à 480px) */
        @media (max-width: 200px) {
            .contentt {
                flex: 0 0 100%;
                /* Full width sur les smartphones */
            }
        }

        .content-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }



    /* Ajoutez d'autres styles CSS pour la mise en page de votre facture */
</style>

<div class="containerr">
    <aside class="sidebar">
        <div class="sidebar-item" data-content="compte">
            <i class="bi bi-person-check"></i> Votre compte
        </div>
        <div class="sidebar-item active" data-content="colis">
            <i class="bi bi-truck"></i> Vos colis
        </div>
        <div class="sidebar-item" data-content="factures">
            <i class="bi bi-cash-coin"></i> Factures
        </div>
        <div class="sidebar-item" data-content="rendezvous">
            <i class="bi bi-calendar3"></i> Rendez-Vous
        </div>
        <div class="sidebar-item" data-content="aide">
            <i class="bi bi-info-circle"></i> Aide / Support
        </div>
        <div class="sidebar-item" data-content="bons">
            <i class="bi bi-ticket-perforated"></i> Bons d'achat
        </div>
        <div class="sidebar-item manage">
            Gérez votre Compte
        </div>
    </aside>
    <main class="contentt">
        <div id="compte" class="content-section" style="display: none;">
            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img src="{{asset('Clients/assets/img/users.jpeg') }}" alt="avatar"
                                    class="rounded-circle img-fluid" style="width: 150px;">
                                <h5 class="my-3">{{ Auth::user()->name }}</h5>
                                <div class="d-flex justify-content-center mb-2">
                                    <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary">MON COMPTE</button>
                                    <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary ms-1">Message</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Full Name</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ Auth::user()->name}}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Email</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ Auth::user()->email}}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Mobile</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ Auth::user()->numero }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Phone</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">:</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Address</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ Auth::user()->adresse }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="colis" class="content-section">
            <div class="content-header">
                <h2>Mes colis</h2>
                <div class="tabs">
                    <div class="tab active" data-tab="Non-traite">Non Traité</div>
                    <div class="tab" data-tab="En-cours">En cours</div>
                    <div class="tab" data-tab="Arr-Depot">Arrivés/Depots</div>
                    <div class="tab" data-tab="Livre">Livrés</div>
                </div>
            </div>
            <div class="order " data-tab="Non-traite">
                <div class="table-data">
                    <div style="overflow-x: auto;">

                        <table>
                            <thead>
                                <tr>
                                    <th>N° suivi</th>
                                    <th>Status</th>
                                    <th>à Payer</th>
                                    <th>Date d'enlèvement</th>
                                    <th>N° conteneurs</th>
                                    <th>Designation</th>
                                    <th>Date livraison</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($expedNonTr as $expedNonT)
                                <tr>
                                    <td>{{ $expedNonT->numeroSuivi }}</td>
                                    <td>{{ $expedNonT->status }}</td>
                                    <td>{{ $expedNonT->montant_total }}</td>
                                    <td>{{ $expedNonT->dateEnlev }}</td>
                                    <td>{{ $expedNonT->numeroConteneur}}</td>
                                    <td>{{ $expedNonT->designation }}</td>
                                    <td>{{ $expedNonT->dateLivr }}</td>
                                    <td>
                                        @if ($expedNonT->image_colis)
                                            <img src="{{ asset('storage/'. $expedNonT->image_colis) }}" alt="Image du colis" style="max-width: 100px; height:100px;">
                                        @else
                                        <img src="{{ asset('Clients/assets/img/placeholder.png')}}" alt="Image du colis" style="max-width: 100px; height:100px;">
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="order" data-tab="En-cours" style="display: none;">
                <table>
                    <thead>
                        <tr>
                            <th>N° suivi</th>
                            <th>Status</th>
                            <th>à Payer</th>
                            <th>Date d'enlèvement</th>
                            <th>N° conteneurs</th>
                            <th>Designation</th>
                            <th>Date livraison</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expedEncour as $expeditionEncourr)
                        <tr>
                            <td>{{ $expeditionEncourr->numeroSuivi }}</td>
                            <td>{{ $expeditionEncourr->status }}</td>
                            <td>{{ $expeditionEncourr->montant_total - $expeditionEncourr->montant_paye }}</td>
                            <td>{{ $expeditionEncourr->dateEnlev }}</td>
                            <td>{{ $expeditionEncourr->numeroConteneur}}</td>
                            <td>{{ $expeditionEncourr->designation }}</td>
                            <td>{{ $expeditionEncourr->dateLivr }}</td>
                            <td>
                                @if ($expeditionEncourr->image_colis)
                                    <img src="{{ asset('storage/'. $expeditionEncourr->image_colis) }}" alt="Image du colis" style="max-width: 100px; height:100px;">
                                @else
                                    <img src="{{ asset('Clients/assets/img/placeholder.png')}}" alt="Image du colis" style="max-width: 100px; height:100px;">
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="order" data-tab="Arr-Depot" style="display: none;">
                <table>
                    <thead>
                        <tr>
                            <th>N° suivi</th>
                            <th>Status</th>
                            <th>à Payer</th>
                            <th>Date d'enlèvement</th>
                            <th>N° conteneurs</th>
                            <th>Designation</th>
                            <th></th>
                            <th>Date livraison</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expedDepot_Arriv as $expedDepot_Arr)
                        <tr>
                            <td>{{ $expedDepot_Arr->numeroSuivi }}</td>
                            <td>{{ $expedDepot_Arr->status }}</td>
                            <td>{{ $expedDepot_Arr->montant_total - $expedDepot_Arr->montant_paye }}</td>
                            <td>{{ $expedDepot_Arr->dateEnlev }}</td>
                            <td>{{ $expedDepot_Arr->numeroConteneur}}</td>
                            <td>{{ $expedDepot_Arr->designation }}</td>
                            <td>{{ $expedDepot_Arr->dateLivr }}</td>
                            <td>
                                @if ($expedDepot_Arr->image_colis)
                                    <img src="{{ asset('storage/'. $expedDepot_Arr->image_colis) }}" alt="Image du colis" style="max-width: 100px; height:100px;">
                                @else
                                    <img src="{{ asset('Clients/assets/img/placeholder.png')}}" alt="Image du colis" style="max-width: 100px; height:100px;">
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="order" data-tab="Livre" style="display: none;">
                <table>
                    <thead>
                        <tr>
                            <th>N° suivi</th>
                            <th>Status</th>
                            <th>à Payer</th>
                            <th>Date d'enlèvement</th>
                            <th>N° conteneurs</th>
                            <th>Designation</th>
                            <th>Date livraison</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expedLivre as $expedLivr)
                        <tr>
                            <td>{{ $expedLivr->numeroSuivi }}</td>
                            <td>{{ $expedLivr->status }}</td>
                            <td>{{ $expedLivr->montant_total }}</td>
                            <td>{{ $expedLivr->dateEnlev }}</td>
                            <td>{{ $expedLivr->numeroConteneur}}</td>
                            <td>{{ $expedLivr->designation }}</td>
                            <td>{{ $expedLivr->dateLivr }}</td>
                            <td>
                                @if ($expedLivr->image_colis)
                                    <img src="{{ asset('storage/'. $expedLivr->image_colis) }}" alt="Image du colis" style="max-width: 100px; height:100px;">
                                @else
                                    <img src="{{ asset('Clients/assets/img/placeholder.png')}}" alt="Image du colis" style="max-width: 100px; height:100px;">
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div id="factures" class="content-section" style="display: none;">
            <div class="facture">
                <div class="container">
                    <h1 class="mb-4">Facture d'expéditions demandées</h1>
                    @if($devis_colis->count()<= 0)
                <a class="btn btn-primary" href="{{url('/Envois')}}">
                Demander un devis
                </a>
                @endif
                <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>De:</th>
                                    <th>Vers:</th>
                                    <th>Designation</th>
                                    <th>Montant</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($devis_colis as $devis)
                                <tr>
                                    <td>@if($devis->status=='traite')
                                        <a href="editExpByFac/{{ $devis->id }}" class="btn btn-primary" style="padding:5px; background-color:green;">
                                            Procceder à une Expedition
                                        </a>
                                        @elseif($devis->status=='encour')
                                        <a href="#" class="btn btn-secondary" style="padding:5px;">
                                            encour
                                        </a>
                                        @else
                                        <a href="#" class="btn btn-secondary" style="padding:5px;">
                                            Non traité
                                        </a>
                                        @endif
                                    </td>
                                    <td>{{ $devis->paysDepart }}</td>
                                    <td>{{ $devis->paysArrivee }}</td>
                                    <td>{{ $devis->designation }}</td>
                                    <td>{{ $devis->montant_total }}</td>
                                    <td>
                                        @if($devis->status=='traite')
                                        <a href="viewExpByFact/{{ $devis->id }}" class="btn btn-info" style="padding:5px; color:white;" target="_blank" rel="noopener noreferrer">
                                            Details <i class="fas fa-print fa-fw"></i>
                                        </a>
                                        @endif
                                        <form id="delete-form-{{ $devis->id }}" action="{{ route('deleteFacture.delete', $devis->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a href="#" class="btn btn-outline-danger" onclick="if (confirm('Êtes-vous sûr de vouloir supprimer cette expédition ?')) { document.getElementById('delete-form-{{ $devis->id }}').submit(); }">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div id="rendezvous" class="content-section" style="display: none;">
            <h2>Mes Rendez-Vous</h2>
                @if($AllRdv->count()<=0)
                <a class="btn btn-primary" href="{{url('/Envois')}}">
                Planifier Rdv
                </a>
                @endif
                <div class="order">
                    <table>
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Nom</th>
                                <th>N° Téléphone</th>
                                <th>Date retrait</th>
                                <th>Heure retrait</th>
                                <th>Designation</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($AllRdv as $rdv)
                            <tr>
                                
                                <td>{{ $rdv->type }}</td>
                                <td> @if($rdv->status=='traite')
                                    <a href="#" class="btn btn-success" style="padding:5px;">
                                        Validé
                                    </a>
                                    @else
                                    <a href="#" class="btn btn-secondary" style="padding:5px;">
                                        encour
                                    </a>
                                    @endif
                                </td>
                                <td>{{ $rdv->nom }}</td>
                                <td>{{ $rdv->telephone }}</td>
                                <td>{{ $rdv->date_retrait }}</td>
                                <td>{{ $rdv->heure_retrait }}</td>
                                <td>{{ $rdv->designation }}</td>
                                <td>
                                    <form action="{{ route('deleteRdv.delete', $rdv->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                                    </form>
                                </td>
                                @if($rdv->status=='traite')
                                <td>
                                <form action="{{ route('rdv.statut.encour', ['rdv' => $rdv->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-info" style="padding:5px; color:white;">
                                    <i class="fas fa-eye fa-fw"></i>
                                </button>
                                </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
        <div id="aide" class="content-section" style="display: none;">
            <h2>Aide / Support</h2>
            <p>FAQ et support...</p>
        </div>
        <div id="bons" class="content-section" style="display: none;">
            <h2>Bons d'achat</h2>
            <p>Liste des bons d'achat...</p>
        </div>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarItems = document.querySelectorAll('.sidebar-item');
        const contentSections = document.querySelectorAll('.content-section');
        const tabs = document.querySelectorAll('.tab');

        sidebarItems.forEach(item => {
            item.addEventListener('click', function() {
                sidebarItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');

                contentSections.forEach(section => section.style.display = 'none');
                document.getElementById(this.dataset.content).style.display = 'block';
            });
        });

        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                tabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                const tabContent = this.dataset.tab;
                document.querySelectorAll('.order').forEach(order => {
                    order.style.display = order.dataset.tab === tabContent ? 'block' : 'none';
                });
            });
        });
    });

// Clique redirection precise au tabs rdv
document.addEventListener('DOMContentLoaded', function() {
    const sidebarItems = document.querySelectorAll('.sidebar-item');
    const contentSections = document.querySelectorAll('.content-section');
    const rdvNotificationLink = document.getElementById('rdv-notification-link');
    const factNotificationLink = document.getElementById('fact-notification-link');

    // Fonction pour activer un tab spécifique
    function activateTab(tabId) {
        const targetSidebarItem = document.querySelector(`.sidebar-item[data-content="${tabId}"]`);
        const targetSection = document.getElementById(tabId);

        if (targetSidebarItem && targetSection) {
            sidebarItems.forEach(item => item.classList.remove('active'));
            targetSidebarItem.classList.add('active');
            contentSections.forEach(section => section.style.display = 'none');
            targetSection.style.display = 'block';
        }
    }

    // Gestion du clic sur le lien de notification Rendez-Vous
    if (rdvNotificationLink) {
        rdvNotificationLink.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche la navigation par défaut avec le fragment
            activateTab('rendezvous');
            window.history.pushState(null, null, '#rendezvous'); // Met à jour l'URL
        });
    }

    // Gestion du clic sur le lien de notification Factures
    if (factNotificationLink) {
        factNotificationLink.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche la navigation par défaut avec le fragment
            activateTab('factures');
            window.history.pushState(null, null, '#factures'); // Met à jour l'URL
        });
    }

    // Gestion de l'activation des tabs via la barre latérale (inchangé)
    sidebarItems.forEach(item => {
        item.addEventListener('click', function() {
            sidebarItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');

            contentSections.forEach(section => section.style.display = 'none');
            const targetId = this.dataset.content;
            document.getElementById(targetId).style.display = 'block';
            window.history.pushState(null, null, `#${targetId}`);
        });
    });

    // Gestion du fragment au chargement initial de la page
    const fragment = window.location.hash.substring(1);
    if (fragment) {
        activateTab(fragment);
    }
});

// notification de ja vu
document.addEventListener('DOMContentLoaded', function() {
    const vuLinks = document.querySelectorAll('a[href^="unread/"]');

    vuLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche la navigation par défaut

            const rdvId = this.getAttribute('href').split('/')[1]; // Extrait l'ID du RDV de l'URL

            // Envoi d'une requête AJAX pour changer le statut en "encour"
            fetch(`/rdv/${rdvId}/statut/encour`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Important pour la sécurité Laravel
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    // Vous pouvez envoyer d'autres données si nécessaire
                }),
            })
            .then(response => {
                if (response.ok) {
                    // Le statut a été changé avec succès côté serveur
                    console.log(`RDV ${rdvId} marqué comme "encour"`);

                    // Optionnel: Mettre à jour l'affichage côté client
                    // Par exemple, changer le texte du bouton ou désactiver le lien
                    this.textContent = 'En cours';
                    this.classList.remove('btn-info');
                    this.classList.add('btn-warning');
                    this.style.color = 'black';
                    this.style.pointerEvents = 'none'; // Empêcher de cliquer à nouveau

                    // Optionnel: Afficher un message de confirmation à l'utilisateur
                } else {
                    console.error(`Erreur lors du changement de statut du RDV ${rdvId}`);
                    // Optionnel: Afficher un message d'erreur à l'utilisateur
                }
            })
            .catch(error => {
                console.error('Erreur réseau:', error);
                // Optionnel: Afficher un message d'erreur réseau à l'utilisateur
            });
        });
    });
});
</script>

@endsection