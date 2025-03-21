@extends('layouts.Client')
@section('content')
<style>
    body {
    font-family: sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.container {
    display: flex;
}

.sidebar {
    width: 250px;
    background-color: #fff;
    padding: 20px;
}

.sidebar-item {
    display: flex;
    align-items: center;
    padding: 10px;
    cursor: pointer;
}

.sidebar-item img {
    width: 20px;
    margin-right: 10px;
}

.sidebar-item.active {
    background-color: #f0f0f0;
}

.sidebar-item.manage {
    margin-top: 20px;
    padding: 10px;
    border-top: 1px solid #eee;
    cursor: pointer;
}

.content {
    flex: 1;
    padding: 20px;
}

.content-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.tabs {
    display: flex;
}

.tab {
    padding: 10px 20px;
    border: 1px solid #ddd;
    border-radius: 5px 5px 0 0;
    margin-right: 10px;
    cursor: pointer;
}

.tab.active {
    background-color: #f0f0f0;
}

.order {
    display: flex;
    background-color: #fff;
    padding: 20px;
    margin-bottom: 10px;
    border-radius: 5px;
}

.order-image {
    width: 100px;
    margin-right: 20px;
}

.order-image img {
    width: 100%;
}

.order-details {
    flex: 1;
}

.order-title {
    font-weight: bold;
    margin-bottom: 5px;
}

.order-id,
.order-size,
.order-date {
    font-size: 14px;
    color: #666;
    margin-bottom: 3px;
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

.order-status.delivered {
    background-color: #d4edda;
    color: #155724;
}

.order-actions {
    display: flex;
    align-items: center;
}


</style>
<div class="container">
        <aside class="sidebar">
            <div class="sidebar-item active">
                <img src="images/account.png" >
                Votre compte
            </div>
            <div class="sidebar-item">
                <img src="images/orders.png" >
                Vos commandes
            </div>
            <div class="sidebar-item">
                <img src="images/inbox.png" >
                Boîte de réception
            </div>
            <div class="sidebar-item">
                <img src="images/reviews.png" >
                Vos avis en attente
            </div>
            <div class="sidebar-item">
                <img src="images/coupons.png" >
                Bons d'achat
            </div>
            <div class="sidebar-item">
                <img src="images/recent.png" >
                Vus récemment
            </div>
            <div class="sidebar-item manage">
                Gérez votre Compte
            </div>
        </aside>
        <main class="content">
            <div class="content-header">
                <h1>Vos commandes</h1>
                <div class="tabs">
                    <div class="tab active" data-tab="en-cours">EN COURS/LIVRÉES</div>
                    <div class="tab" data-tab="annulees">ANNULÉES/RETOURNÉES</div>
                </div>
            </div>
            <div class="order" data-tab="en-cours">
                <div class="order-image">
                    <img src="images/ps4_controller.png">
                </div>
                <div class="order-details">
                    <div class="order-title">Manette PS4</div>
                    <div class="order-id">Commande 352651838</div>
                    <div class="order-status delivered">COLIS LIVRÉ</div>
                    <div class="order-date">Le 25-11</div>
                </div>
                <div class="order-actions">
                    <a href="#" class="details-link" data-order-id="352651838">Détails</a>
                </div>
                <div class="order-details-expanded" id="details-352651838" style="display: none;">
                    </div>
            </div>
            <div class="order" data-tab="en-cours">
                <div class="order-image">
                    <img src="images/shirt.png" >
                </div>
                <div class="order-details">
                    <div class="order-title">Chemise Homme Manches Courtes Tee Shirt Fleurs</div>
                    <div class="order-id">Commande 317792938</div>
                    <div class="order-size">Size: XXL</div>
                    <div class="order-status delivered">COLIS LIVRÉ</div>
                    <div class="order-date">Le 18-11</div>
                </div>
                <div class="order-actions">
                    <a href="#" class="details-link" data-order-id="317792938">Détails</a>
                </div>
                <div class="order-details-expanded" id="details-317792938" style="display: none;">
                    </div>
            </div>
            <div class="order" data-tab="annulees" style="display: none;">
                <div class="order-image">
                    <img src="images/shirt.png">
                </div>
                <div class="order-details">
                    <div class="order-title">Chemise Homme Manches Courtes Tee Shirt Fleurs</div>
                    <div class="order-id">Commande 317792938</div>
                    <div class="order-size">Size: XXL</div>
                    <div class="order-status delivered">COLIS LIVRÉ</div>
                    <div class="order-date">Le 18-11</div>
                </div>
                <div class="order-actions">
                    <a href="#" class="details-link" data-order-id="317792938">Détails</a>
                </div>
                <div class="order-details-expanded" id="details-317792938" style="display: none;">
                    </div>
            </div>
        </main>
    </div>
    <script>

    </script>
@endsection