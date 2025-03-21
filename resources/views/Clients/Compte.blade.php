@extends('layouts.Client')
@section('content')
<!-- <section id="hero" class="hero section dark-background">

<img src="clients/assets/img/Home.jpg" alt="" data-aos="fade-in"> -->


<style>
    body {
        /* font-family: sans-serif;
    margin: 0;
    padding: 0; */
        background-image: url("clients/assets/img/Bckg.png");
        background-repeat: no-repeat;
        background-size: contain;
    }

    .container {
        margin-top: 20px;
        /* Réduction de la marge pour les petits écrans */
        display: flex;
        flex-direction: column;
        /* Passage en colonne pour les petits écrans */
    }

    .sidebar {
        border: 1px solid #666;
        width: 100%;
        /* Pleine largeur sur les petits écrans */
        background-color: #fff;
        padding: 10px;
        /* Réduction du padding */
    }

    .sidebar-item {
        display: flex;
        align-items: center;
        padding: 8px;
        /* Réduction du padding */
        cursor: pointer;
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
        margin-top: 10px;
        /* Réduction de la marge */
        padding: 8px;
        /* Réduction du padding */
        border-top: 1px solid #eee;
        cursor: pointer;
    }

    .content {
        width: 100%;
        /* Pleine largeur sur les petits écrans */
        padding: 10px;
        /* Réduction du padding */
    }

    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        /* Réduction de la marge */
        flex-direction: column;
        /* Passage en colonne pour les petits écrans */
        align-items: flex-start;
        /* Alignement à gauche pour les petits écrans */
    }

    .content-header h2 {
        margin-bottom: 5px;
        /* Ajout d'une petite marge */
    }

    .tabs {
        display: flex;
        flex-wrap: wrap;
        /* Permet aux onglets de passer à la ligne */
    }

    .tab {
        padding: 8px 15px;
        /* Réduction du padding */
        border: 1px solid #ddd;
        border-radius: 5px 5px 0 0;
        margin-right: 5px;
        /* Réduction de la marge */
        margin-bottom: 5px;
        /* Ajout d'une petite marge */
        cursor: pointer;
    }

    .tab.active {
        color: #fff;
        background-color: #3995f1;
    }

    .order {
        display: flex;
        flex-direction: column;
        /* Passage en colonne pour les petits écrans */
        background-color: #fff;
        padding: 10px;
        /* Réduction du padding */
        margin-bottom: 10px;
        border-radius: 5px;
    }

    .order-image {
        width: 100%;
        /* Pleine largeur sur les petits écrans */
        margin-right: 0;
        /* Suppression de la marge */
        margin-bottom: 10px;
        /* Ajout d'une marge */
    }

    .order-image img {
        width: 100%;
    }

    .order-details {
        width: 100%;
        /* Pleine largeur sur les petits écrans */
    }

    .order-title {
        font-weight: bold;
        margin-bottom: 3px;
        /* Réduction de la marge */
    }

    .order-id,
    .order-size,
    .order-date {
        font-size: 12px;
        /* Réduction de la taille de police */
        color: #666;
        margin-bottom: 2px;
        /* Réduction de la marge */
    }

    .order-status {
        background-color: #d4edda;
        color: rgb(31, 228, 77);
        padding: 3px 8px;
        /* Réduction du padding */
        border-radius: 3px;
        font-size: 10px;
        /* Réduction de la taille de police */
        font-weight: bold;
        display: inline-block;
    }

    .order-status.delivered {
        background-color: #d4edda;
        color: #155724;
    }

    .order-actions {
        display: flex;
        justify-content: flex-end;
        /* Alignement à droite */
        margin-top: 10px;
        /* Ajout d'une marge */
    }

    .content-section {
        display: block;
    }

    /* Requêtes média pour les écrans plus larges */
    @media (min-width: 768px) {
        .container {
            flex-direction: row;
            /* Retour à la disposition en ligne */
            margin-top: 100px;
        }

        .sidebar {
            width: 260px;
            /* Retour à la largeur initiale */
            padding: 20px;
        }

        .content {
            padding: 20px;
        }

        .content-header {
            flex-direction: row;
            /* Retour à la disposition en ligne */
            align-items: center;
            margin-bottom: 20px;
        }

        .order {
            flex-direction: row;
            /* Retour à la disposition en ligne */
        }

        .order-image {
            width: 100px;
            /* Retour à la largeur initiale */
            margin-right: 20px;
            margin-bottom: 0;
        }

        .order-details {
            width: auto;
            /* Retour à la largeur automatique */
        }
    }

    /* Style Facture */
    body {
        /* font-family: sans-serif;
    margin: 0;
    padding: 20px; */
    }

    .facture {
        width: 100%;
        /* margin: 0 auto; */
        border: 1px solid #ddd;
        padding: 10px;
    }

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        /* margin-bottom: 20px; */
    }

    .logo {
        font-size: 24px;
        font-weight: bold;
    }

    .infos-entreprise p {
        margin: 5px 0;
    }

    .infos-client {
        margin-bottom: 5px;
    }

    .details-facture table {
        width: 100%;
        border-collapse: collapse;
    }

    .details-facture th,
    .details-facture td {
        border: 1px solid #ddd;
        padding: 3px;
        text-align: left;
    }

    .details-facture th {
        background-color: #f0f0f0;
    }

    .details-facture tfoot td {
        text-align: right;
    }

    footer {
        text-align: center;
        margin-top: 5px;
        border-top: 1px solid #ddd;
        padding-top: 5px;
    }

    /* End style Facture */
</style>
<div class="container">
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
            <i class="bi bi-calendar3"></i>Rendez-Vous
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
    <main class="content">
        <div id="compte" class="content-section">
            <h2>Votre compte</h2>
            <p>Informations du compte...</p>
        </div>
        <div id="colis" class="content-section" style="display: none;">
            <div class="content-header">
                <h2>Mes colis</h2>
                <div class="tabs">
                    <div class="tab active" data-tab="en-cours">En cour/Livrés</div>
                    <div class="tab" data-tab="annulees">En Stock</div>
                </div>
            </div>
            <div class="order" data-tab="en-cours">
                <div class="table-data">
                    <div style="overflow-x: auto;">
                        <table class="table table-striped" id="expeditionsTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>N° suivi</th>
                                    <th style="color:black;text-align:center;">status</th>
                                    <th style="color:black">prix</th>
                                    <th>date d'enlevements</th>
                                    <th>N° conteneurs</th>
                                    <th>design-Colis</th>
                                    <th>date-Livr</th>
                                    <th>remarque</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($expedNonTr as $expedition)
                                <tr>
                                    <td></td>
                                    <td>{{ $expedition->numeroSuivi}}</td>
                                    <td>{{ $expedition->status}}</td>
                                    <td>{{ $expedition->montant_total}}</td>
                                    <td>{{ $expedition->dateEnlev}}</td>
                                    <td>{{ $expedition->conteneurs}}</td>
                                    <td>{{ $expedition->designation}}</td>
                                    <td>{{ $expedition->dateLivr}}</td>
                                    <td>{{ $expedition->typeService}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="order" data-tab="annulees" style="display: none;">
                <div class="table-data">
                    <div style="overflow-x: auto;">
                        <table class="table table-striped" id="expeditionsTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>N° suivi</th>
                                    <th style="color:black;text-align:center;">status</th>
                                    <th style="color:black">prix</th>
                                    <th>date d'enlevements</th>
                                    <th>N° conteneurs</th>
                                    <th>design-Colis</th>
                                    <th>date-Livr</th>
                                    <th>remarque</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($expedEncour as $expedition)
                                <tr>
                                    <td></td>
                                    <td>{{ $expedition->numeroSuivi}}</td>
                                    <td>{{ $expedition->status}}</td>
                                    <td>{{ $expedition->montant_total}}</td>
                                    <td>{{ $expedition->dateEnlev}}</td>
                                    <td>{{ $expedition->conteneurs}}</td>
                                    <td>{{ $expedition->designation}}</td>
                                    <td>{{ $expedition->dateLivr}}</td>
                                    <td>{{ $expedition->typeService}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Facture -->
        <!-- <div id="factures" class="content-section" style="display: none;">
            <h2>Factures</h2>

            <div class="facture">
                <header>
                    <div class="logo">
                        Votre Logo
                    </div>
                    <div class="infos-entreprise">
                        <p>Votre Entreprise</p>
                        <p>Adresse</p>
                        <p>Téléphone : 01 23 45 67 89</p>
                        <p>Email : contact@votreentreprise.com</p>
                    </div>
                </header>

                <section class="infos-client">
                    <h2>Facture N° 12345</h2>
                    <p>Date : 2023-10-27</p>
                    <p>Client : Nom du Client</p>
                    <p>Adresse : Adresse du Client</p>
                </section>

                <section class="details-facture">
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
                </section>

                <footer>
                    <p>Merci de votre confiance.</p>
                </footer>
            </div>
        </div> -->
        <!-- End facture -->

        <div id="rendezvous" class="content-section" style="display: none;">
            <h2>Mes Rendez-Vous</h2>
                <div class="table-data">
                    <div style="overflow-x: auto;">
                        <table class="table table-striped" id="expeditionsTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>N° suivi</th>
                                    <th style="color:black;text-align:center;">status</th>
                                    <th style="color:black">prix</th>
                                    <th>date d'enlevements</th>
                                    <th>N° conteneurs</th>
                                    <th>design-Colis</th>
                                    <th>date-Livr</th>
                                    <th>remarque</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($expedEncour as $expedition)
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
        // Gestion du menu latéral
        const sidebarItems = document.querySelectorAll('.sidebar-item');
        const contentSections = document.querySelectorAll('.content-section');

        sidebarItems.forEach(item => {
            item.addEventListener('click', function() {
                // Retirer la classe 'active' de tous les éléments du menu
                sidebarItems.forEach(i => i.classList.remove('active'));
                // Ajouter la classe 'active' à l'élément cliqué
                this.classList.add('active');

                // Afficher/masquer les sections de contenu
                const contentId = this.getAttribute('data-content');
                contentSections.forEach(section => {
                    if (section.id === contentId) {
                        section.style.display = 'block';
                    } else {
                        section.style.display = 'none';
                    }
                });
            });
        });

        // Gestion des onglets
        const tabs = document.querySelectorAll('.tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Retirer la classe 'active' de tous les onglets
                tabs.forEach(t => t.classList.remove('active'));
                // Ajouter la classe 'active' à l'onglet cliqué
                this.classList.add('active');
                // Afficher/masquer les commandes en fonction de l'onglet
                const tabId = this.getAttribute('data-tab');
                const orders = document.querySelectorAll('.order');
                orders.forEach(order => {
                    if (order.getAttribute('data-tab') === tabId) {
                        order.style.display = 'flex';
                    } else {
                        order.style.display = 'none';
                    }
                });
            });
        });

        // Gestion des détails de la commande
        const detailsLinks = document.querySelectorAll('.details-link');
        detailsLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const orderId = this.getAttribute('data-order-id');
                const detailsDiv = document.getElementById(`details-${orderId}`);
                if (detailsDiv.style.display === 'none') {
                    // Simuler des détails de commande (vous pouvez remplacer cela par une requête AJAX)
                    detailsDiv.innerHTML = `<p>Détails de la commande ${orderId} : ...</p>`;
                    detailsDiv.style.display = 'block';
                } else {
                    detailsDiv.style.display = 'none';
                }
            });
        });
    });
</script>
<!-- </section> -->
@endsection