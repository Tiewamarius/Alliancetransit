@extends('layouts.Client')
@section('content')
<br><br><br><br>
<style>
    body {
        background-image: url("clients/assets/img/Bckg.png");
        background-repeat: no-repeat;
        background-size: cover; /* Cover to fill the entire viewport */
        background-position: center; /* Center the background image */
    }

    
    th {
                white-space: nowrap;
            }
    .containerr {
        display: flex;
        flex-wrap: wrap; /* Allow items to wrap on smaller screens */
        margin: 20px auto; /* Center the container */
        width: 100%; /* Limit container width for larger screens */
    }

    .sidebar {
        flex: 0 0 250px; /* Fixed width for sidebar */
        background-color: #fff;
        border: 1px solid #ddd;
        padding: 20px;
        box-sizing: border-box; /* Include padding in width calculation */
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
        flex: 1 1 auto; /* Allow content to grow and shrink */
        width: 778px;
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ddd;
        box-sizing: border-box; /* Include padding in width calculation */
    }

    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap; /* Allow header items to wrap */
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
        overflow-x: auto; /* Enable horizontal scrolling for tables */
    }

    .order table {
        width: 100%;
        border-collapse: collapse;
    }

    .order th, .order td {
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

    .facture th, .facture td {
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
                    flex: 0 0 100%; /* Full width on small screens */
                    margin-bottom: 15px;
                }

                .contentt {
            flex: 1 1 auto; /* Permet au contenu de grandir et de rétrécir */
        }

        /* Media query pour les écrans de tablettes (par exemple, jusqu'à 768px) */
        @media (max-width: 800px) {
            .contentt {
                flex: 0 0 100%; /* Full width sur les tablettes */
            }
        }

        /* Media query pour les écrans de smartphones (par exemple, jusqu'à 480px) */
        @media (max-width: 200px) {
            .contentt {
                flex: 0 0 100%; /* Full width sur les smartphones */
            }
        }

        .content-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="containerr">
    <aside class="sidebar">
        <div class="sidebar-item active" data-content="compte">
            <i class="bi bi-person-check"></i> Votre compte
        </div>
        <div class="sidebar-item" data-content="colis">
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
        <div id="compte" class="content-section">
            <h2>Votre compte</h2>
            <p><strong>Nom :</strong> {{ Auth::user()->name }}</p>
            <p><strong>Adresse :</strong> {{ Auth::user()->adresse }}</p>
            <p><strong>Téléphone :</strong> {{ Auth::user()->numero }}</p>
            <p><strong>Email :</strong> {{ Auth::user()->email }}</p>
        </div>
        <div id="colis" class="content-section" style="display: none;">
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
                                <th>Remarque</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($expedNonTr as $expedNonT)
                            <tr>
                                <td>{{ $expedNonT->numeroSuivi }}</td>
                                <td>{{ $expedNonT->status }}</td>
                                <td>{{ $expedNonT->montant_total }}</td>
                                <td>{{ $expedNonT->dateEnlev }}</td>
                                <td>{{ $expedNonT->conteneur }}</td>
                                <td>{{ $expedNonT->designation }}</td>
                                <td>{{ $expedNonT->dateLivr }}</td>
                                <td>{{ $expedNonT->typeService }}</td>
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
                            <th>Remarque</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expedEncour as $expeditionEncourr)
                        <tr>
                            <td>{{ $expeditionEncourr->numeroSuivi }}</td>
                            <td>{{ $expeditionEncourr->status }}</td>
                            <td>{{ $expeditionEncourr->montant_total - $expeditionEncourr->montant_paye }}</td>
                            <td>{{ $expeditionEncourr->dateEnlev }}</td>
                            <td>{{ $expeditionEncourr->conteneurs }}</td>
                            <td>{{ $expeditionEncourr->designation }}</td>
                            <td>{{ $expeditionEncourr->dateLivr }}</td>
                            <td>{{ $expeditionEncourr->typeService }}</td>
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
                            <th>Date livraison</th>
                            <th>Remarque</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expedDepot_Arriv as $expedDepot_Arr)
                        <tr>
                            <td>{{ $expedDepot_Arr->numeroSuivi }}</td>
                            <td>{{ $expedDepot_Arr->status }}</td>
                            <td>{{ $expedDepot_Arr->montant_total - $expedDepot_Arr->montant_paye }}</td>
                            <td>{{ $expedDepot_Arr->dateEnlev }}</td>
                            <td>{{ $expedDepot_Arr->conteneurs }}</td>
                            <td>{{ $expedDepot_Arr->designation }}</td>
                            <td>{{ $expedDepot_Arr->dateLivr }}</td>
                            <td>{{ $expedDepot_Arr->typeService }}</td>
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
                            <th>Remarque</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expedLivre as $expedLivr)
                        <tr>
                            <td>{{ $expedLivr->numeroSuivi }}</td>
                            <td>{{ $expedLivr->status }}</td>
                            <td>{{ $expedLivr->montant_total }}</td>
                            <td>{{ $expedLivr->dateEnlev }}</td>
                            <td>{{ $expedLivr->conteneurs }}</td>
                            <td>{{ $expedLivr->designation }}</td>
                            <td>{{ $expedLivr->dateLivr }}</td>
                            <td>{{ $expedLivr->typeService }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div id="factures" class="content-section" style="display: none;">
            <h3>Factures</h3>
            <div class="facture">
                <!-- <header>
                    <div class="logo">Votre Logo</div>
                    <div class="infos-entreprise">
                        <p>Votre Entreprise</p>
                        <p>Adresse</p>
                        <p>Téléphone : 01 23 45 67 89</p>
                        <p>Email : contact@votreentreprise.com</p>
                    </div>
                </header> -->
                <!-- <section class="infos-client">
                    <h2>Facture N° 12345</h2>
                    <p>Date : 2023-10-27</p>
                    <p>Client : Nom du Client</p>
                    <p>Adresse : Adresse du Client</p>
                </section> -->
                <!-- <section class="details-facture">
                    <table>
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Quantité</th>
                                <th>Prix Unitaire</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Produit/Service 1</td>
                                <td>2</td>
                                <td>50.00 €</td>
                                <td>100.00 €</td>
                            </tr>
                            <tr>
                                <td>Produit/Service 2</td>
                                <td>1</td>
                                <td>75.00 €</td>
                                <td>75.00 €</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">Sous-total</td>
                                <td>175.00 €</td>
                            </tr>
                            <tr>
                                <td colspan="3">TVA (20%)</td>
                                <td>35.00 €</td>
                            </tr>
                            <tr>
                                <td colspan="3">Total</td>
                                <td>210.00 €</td>
                            </tr>
                        </tfoot>
                    </table>
                </section> -->
                <footer>
                    <p>Merci de votre confiance.</p>
                </footer>
            </div>
        </div>
        <div id="rendezvous" class="content-section" style="display: none;">
            <h2>Mes Rendez-Vous</h2>
            @if($Rdv->count()< 0)
            <a class="btn btn-primary" href="{{url('/envois')}}">
                Ajouter Rdv
            </a>
            @endif
            <div class="order">
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>N° Téléphone</th>
                            <th>Code Suivi</th>
                            <th>Date retrait</th>
                            <th>Heure retrait</th>
                            <th>Designation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Rdv as $rdv)
                        <tr>
                            <td>{{ $rdv->nom }}</td>
                            <td>{{ $rdv->telephone }}</td>
                            <td>{{ $rdv->numero_suivi }}</td>
                            <td>{{ $rdv->date_retrait }}</td>
                            <td>{{ $rdv->heure_retrait }}</td>
                            <td>{{ $rdv->designation }}</td>
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
</script>
@endsection