<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FACTURE N°</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .facture-container {
            width: 700px;
            /* Ajustez la largeur selon vos besoins */
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .vendor-info,
        .facture-no {
            flex: 1;
        }

        .vendor-info img {
            max-width: 200px;
            margin-bottom: 10px;
        }

        .facture-no {
            text-align: left;
            font-size: 1.5em;
            border: 1px solid #007bff;
            /* Couleur bleue de l'exemple */
            padding: 10px;
            width: 200px;
        }

        .addresses {
            /* display: flex; */
            margin-bottom: 20px;
        }

        .expediteur,
        .destinataire {
            flex: 1;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .expediteur {
            margin-right: 10px;
        }

        .table-container {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        .total-section {
            text-align: right;
            margin-bottom: 10px;
        }

        .total-line {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 5px;
        }

        .total-label {
            width: 150px;
            font-weight: bold;
        }

        .total-value {
            width: 100px;
            text-align: right;
        }

        .reglement-info,
        .livraison-info {
            margin-bottom: 15px;
        }

        .note {
            font-size: 0.9em;
            color: #555;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="facture-container">
        <div class="header">
            <div class="vendor-info">
                <img src="{{ asset('Clients/assets/img/LOGOFACTUR.jpg')}}" alt="Logo Société de Transport de Marchandises Internationales">
                <p>SOCIÉTÉ DE TRANSPORT DE</p>
                <p>MARCHANDISES INTERNATIONALES</p>
                <p>Transport des colis Paris-Abidjan avec livraison</p>
                <p>offerte exclusivement pour la ville d'Abidjan.</p>
                <p>43 AVENUE DU GROS CHÊNE</p>
                <p>16220 HIRSON AY</p>
                <p>+33 6 98 45 76 14 | +33 6 62 07 51 95</p>
                <p class="italic">Chaque 10 jours un départ pour Abidjan</p>
                <p class="italic">Nb. offres soumises à des conditions</p>
                <br>
                <p>N° TVA FR53 833 053 375</p>
                <p>LE</p>
            </div>
            <div class="facture-no">
                <p>FACTURE N°:</p>
                <div class="addresses">
                    <div class="expediteur">
                        <p>Nom et adresse de l'expéditeur</p>
                        <p>:</p>
                    </div>
                    <div class="destinataire">
                        <p>Nom et adresse du Destinataire</p>
                        <p>:</p>
                    </div>
                </div>
            </div>
        </div>



        <div class="commande-info" style="margin-bottom: 10px;">
            <label for="bon_commande">N° du bon de commande :</label>
            <input type="text" id="bon_commande" style="border: 1px solid #ccc; padding: 5px;">
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Désignation</th>
                        <th>Quantité</th>
                        <th>Prix unitaire H.T.</th>
                        <th>Total H.T.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 30px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="height: 30px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="total-section">
            <div class="total-line">
                <div class="total-label">Date de règlement :</div>
                <div class="total-value">
                    <input type="text" style="border: 1px solid #ccc; padding: 5px; width: 100px; text-align: right;">
                </div>
            </div>
            <div class="total-line">
                <div class="total-label">Date de la livraison ou de la prestation :</div>
                <div class="total-value">
                    <input type="text" style="border: 1px solid #ccc; padding: 5px; width: 100px; text-align: right;">
                </div>
            </div>
            <div class="total-line">
                <div class="total-label">Total H.T.</div>
                <div class="total-value" style="border-bottom: 1px solid #000;"></div>
            </div>
            <div class="total-line">
                <div class="total-label">T.V.A</div>
                <div class="total-value" style="border-bottom: 1px solid #000;"></div>
            </div>
            <div class="total-line">
                <div class="total-label">TOTAL T.T.C</div>
                <div class="total-value" style="font-weight: bold; border-bottom: 2px solid #000;"></div>
            </div>
            <div class="total-line">
                <div class="total-label">Mode de règlement :</div>
                <div class="total-value">
                    <input type="text" style="border: 1px solid #ccc; padding: 5px; width: 100px; text-align: right;">
                </div>
            </div>
        </div>

        <div class="note">
            <p>Attention : Les paiements devront s'effectuer obligatoirement avant la livraison du colis. Tout colis non payé ne sera pas livré et le destinataire devra récupérer son colis au dépôt.</p>
            <p>Délai : Les marchandises sont à récupérer dans les 3 jours à compter de l'arrivée du colis au dépôt pour récupérer son colis après quoi nous ne sommes plus responsable des dommages qui peuvent survenir.</p>
            <br>
            <p class="smaller">Livraison dans toutes les communes sauf : Anyama, N'Dotré, Bingerville, Gonzague, Bassam Yopougon (Gesco, Micao km17).</p>
            <p class="smaller">Pour les expéditions à l'intérieur du pays les clients sont priés de donner des adresses de gare avec des numéros pour faciliter les expéditions.</p>
        </div>
    </div>

    <style>
        .italic {
            font-style: italic;
        }

        .smaller {
            font-size: 0.8em;
        }
    </style>

    <script>
        // Vous pouvez ajouter du JavaScript ici si nécessaire pour la fonctionnalité.
        // Par exemple, pour gérer l'impression.
        // window.onload = function() {
        //     window.print();
        // }
    </script>
</body>

</html>
<!-- <button onclick="window.print()">Imprimer la facture</button> -->
<!-- End template Facture -->