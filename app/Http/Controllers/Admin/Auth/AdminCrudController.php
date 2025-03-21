<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification; // Importez la façade Notification
use App\Notifications\NouvelleExpedition;
use App\Models\rendevous;
use App\Models\DevisColis;
use App\Models\expeditionsClients;
use App\Models\expeditions;
use App\Models\expediteur;
// use GuzzleHttp\Client;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Auth;
use App\Models\clients;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\Admin;
// use App\Models\User; Importez le modèle Admin
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

use function Termwind\render;

class AdminCrudController extends Controller
{

// WELCOME - DASHBOARD
public function dashboard()
    {
            $devisNonTraites = DevisColis::where('status', 'nontraite')->count();

        

            $expeditionsClient = expeditions::latest()->paginate(5);
            $expeditions = expeditions::latest()->paginate(5);
            $All = expeditions::count();

            $colisArrives = expeditions::where('status', 'Non Livré')->count();
            $coliLivre= expeditions::where('status', 'Livré')->count();
            $Encour= expeditions::where('status', 'encour')->count();
            $stock= expeditions::where('status', 'Non Livré')->count();
            
            $totalExpeditions = expeditions::count();
            $nombre_aleatoire = (string)(random_int(10000, 99999));
            $code_client = 'Cl-'. $nombre_aleatoire;
            // $totalClients = expeditions::distinct('code_client')->count('code_client');
            $nombre_aleatoire = (string)(random_int(10000, 99999));
            $code_suivi = 'Al-'. $nombre_aleatoire;

           

            return view('admin.dashboard',compact('devisNonTraites','stock','Encour','All','colisArrives','coliLivre','expeditions','expeditionsClient'));
    

    }
// END FUNCTION DASHBOARD

// TablClien
// public function tablClients()
//     {
//         $devisNonTraites = DevisColis::where('status', 'nontraite')->count();

        
        
//         $expeditions = expeditions::latest()->paginate(5);
//             $expeditionClient = expeditionsClients::latest()->paginate(5);
//             $All = expeditions::count();

//             $colisArrives = expeditions::where('status', 'Non Livré')->count();
//             $coliLivre= expeditions::where('status', 'Livré')->count();
//             $Encour= expeditions::where('status', 'encour')->count();
//             $stock= expeditions::where('status', 'Non Livré')->count();
            
//             $totalExpeditions = expeditions::count();
//             $nombre_aleatoire = (string)(random_int(10000, 99999));
//             $code_client = 'Cl-'. $nombre_aleatoire;
//             // $totalClients = expeditions::distinct('code_client')->count('code_client');
//             $nombre_aleatoire = (string)(random_int(10000, 99999));
//             $code_suivi = 'Al-'. $nombre_aleatoire;

           

//             return view('admin.mission.tablClients',compact('expeditionClient','stock','Encour','All','colisArrives','coliLivre','expeditions','devisNonTraites'));
    

//     }
// End tablClients


// PAGINATION
public function pagination()
    {
            $expeditions = expeditions::latest()->paginate(5);
            $All = expeditions::count();

            $colisArrives = expeditions::where('status', 'Non Livré')->count();
            $coliLivre= expeditions::where('status', 'Livré')->count();
            $Encour= expeditions::where('status', 'encour')->count();
            $stock= expeditions::where('status', 'Non Livré')->count();
            
            $totalExpeditions = expeditions::count();
            $nombre_aleatoire = (string)(random_int(10000, 99999));
            $code_client = 'Cl-'. $nombre_aleatoire;
            // $totalClients = expeditions::distinct('code_client')->count('code_client');
            $nombre_aleatoire = (string)(random_int(10000, 99999));
            $code_suivi = 'Al-'. $nombre_aleatoire;

           

            return view('admin.dashboard_pagination',compact('stock','Encour','All','colisArrives','coliLivre','expeditions'))->render();
    

    }

    public function allRdv()
    {
        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();

        
        
        // $expeditions = expeditions::latest()->paginate(5);
        //     $expeditionClient = expeditionsClients::latest()->paginate(5);
            $rendevouses = rendevous::all();

            // $colisArrives = expeditions::where('status', 'Non Livré')->count();
            // $coliLivre= expeditions::where('status', 'Livré')->count();
            // $Encour= expeditions::where('status', 'encour')->count();
            // $stock= expeditions::where('status', 'Non Livré')->count();
            
            // $totalExpeditions = expeditions::count();
            // $nombre_aleatoire = (string)(random_int(10000, 99999));
            // $code_client = 'Cl-'. $nombre_aleatoire;
            // // $totalClients = expeditions::distinct('code_client')->count('code_client');
            // $nombre_aleatoire = (string)(random_int(10000, 99999));
            // $code_suivi = 'Al-'. $nombre_aleatoire;

           

            return view('admin.clients.allRdv',compact('devisNonTraites','rendevouses'));
    

    }
// End allRdvs

//SEARCH FONCTION----------------------------------------------------
public function search(Request $request)
        {
            $expeditions = expeditions::where('expediteur_id', 'like', '%'.$request->search_string.'%')
                    ->orWhere('nom_expediteur', 'like', '%'.$request->search_string .'%')
                    ->orWhere('numero_expediteur', 'like', '%' . $request->search_string . '%')
                    ->orWhere('email_expediteur', 'like', '%' . $request->search_string . '%')
                    ->orWhere('adresse_expediteur', 'like', '%' . $request->search_string . '%')
                    ->orWhere('nom_destinataire', 'like', '%' . $request->search_string . '%')
                    ->orWhere('numero_destinataire', 'like', '%' . $request->search_string . '%')
                    ->orWhere('email_destinataire', 'like', '%' . $request->search_string . '%')
                    ->orWhere('adresse_destinataire', 'like', '%' . $request->search_string . '%')
                    ->orWhere('numeroSuivi', 'like', '%' .$request->search_string .'%')
                    ->orWhere('designation', 'like', '%' . $request->search_string . '%')
                    ->orWhere('numeroConteneur', 'like', '%' . $request->search_string . '%')
                    ->orWhere('typeService', 'like', '%' . $request->search_string . '%')
                    ->orWhere('status', 'like', '%' . $request->search_string . '%')
                    ->paginate(5);
            
                    if($expeditions->count()>=1){
                        return view('admin.dashboard_pagination',compact('expeditions'))->render();   
                    }else{
                        return response()->json(
                            [ 'status'=>'Inexistant'],
                        );
                    }
                    }




        // EXPEDITIONS CRUD
        public function ExpeditionForm()
        {
        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();

    
        $totalExpeditions = expeditions::count();
        $nombre_aleatoire = (string)(random_int(10000, 99999));
            
        $nombre_aleatoire = (string)(random_int(10000, 99999));
        $code_unique = 'Al-'. $nombre_aleatoire;

        $code_suivi = 'SU-'. $nombre_aleatoire;
        
        $nomsClients = clients::pluck('nom_client', 'id');
        
        $expeditions = expeditions::all();
        return view('admin.mission.Ajouterexpeditions',compact(
            'nomsClients','expeditions','code_unique','code_suivi','devisNonTraites'));
    }


    public function storeExpedition(Request $request)
        {
            // Validation des données
            $validatedData = $request->validate([
                'particulier' => 'nullable',
                'expediteur_id' => 'nullable',
                'nom_expediteur' => 'required',
                'numero_expediteur' => 'required',
                'email_expediteur' => 'nullable|email',
                'adresse_expediteur' => 'nullable',
                'destinataire_id' => 'nullable|exists:destinataires,id',
                'nom_destinataire' => 'required',
                'numero_destinataire' => 'required',
                'email_destinataire' => 'nullable|email',
                'adresse_destinataire' => 'nullable',
                'numeroSuivi' => 'required',
                'designation' => 'required',
                'numeroConteneur' => 'nullable',
                'typeService' => 'nullable',
                'dateEnlev' => 'nullable|date',
                'dateLivr' => 'nullable|date',
                'montant_total' => 'required|numeric',
                'montant_paye' => 'required|numeric',
                'status' => 'required|in:encour,Non Livré,Livré',
                'image_colis' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            // Gestion de l'image du colis
            if ($request->hasFile('image_colis')) {
                $imagePath = $request->file('image_colis')->store('expeditions', 'public');
                $validatedData['image_colis'] = $imagePath;
            }
    
            // Création de l'expédition
            $expedition = expeditions::create($validatedData);
    
            // Notification par email (si l'email du destinataire est fourni)
            if ($expedition->email_destinataire) {
                Notification::route('mail', $expedition->email_destinataire)
                    ->notify(new NouvelleExpedition($expedition));
            }
    
            $numeroExpediteur = $request->input('numero_expediteur');
            $numeroDestinataire = $request->input('numero_destinataire');
        
            $messageExpediteur = "Bonjour Mr/Mme, Alliance Transit vous informe que votre colis vient d’arriver à Abidjan, merci de nous envoyer votre adresse précise de livraison et d’informer votre correspondant à Abidjan. Toutefois, tous les clients indisponibles lors de la livraison passeront récupérer leur colis au dépôt. Merci pour votre compréhension.";
            $messageDestinataire = "Bonjour Mme/Mr, Alliance Transit vous informe que la livraison de votre colis s’effectuera demain. Nous vous rappelons que toutes personnes injoignables passera au dépôt récupérer son coli. Merci de prendre vos dispositions pour la bonne réception du colis.";
        
            try {
                $client = new Client();
                $accessToken = "eyJ0eXAiOiJKV1QiLCJ2ZXIiOiIxLjAiLCJhbGciOiJFUzM4NCIsImtpZCI6Ikg1RkdUNXhDUlJWU0NseG5vTXZCWEtUM1AyckhTRVZUNV9VdE16UFdCYTQifQ.eyJpc3MiOiJodHRwczovL2FwaS5vcmFuZ2UuY29tL29hdXRoL3YzIiwiYXVkIjpbIm9wZSJdLCJleHAiOjE3NDI1NzYxMzksImlhdCI6MTc0MjU3MjUzOSwianRpIjoiN3ZRTnAxWUk5TXF1R2x6SUJqRkpYNlFMWEN0U2JJSDZWemxwZXlxUHJjWDVtc3BRc2JOczlBczNwNDhtTTRHRTdOWE1IRFZrT3QwMERmVDd3ZnFUWk9RSU1sbDlrUTFhZ3lmWSIsImNsaWVudF9pZCI6Im53MGtmWGRibHgzSjBrcUVCeGhFQVBWMHZJaDhYZWo0Iiwic3ViIjoibncwa2ZYZGJseDNKMGtxRUJ4aEVBUFYwdkloOFhlajQiLCJjbGllbnRfbmFtZSI6eyJkZWZhdWx0IjoiYWxsaWFuY2V0cmFuc2l0In0sImNsaWVudF90YWciOiI1UGtRZlJGMjlIbkFZS3d0Iiwic2NvcGUiOlsib3BlOnNtc19hZG1pbjp2MTphY2Nlc3MiLCJvcGU6c21zbWVzc2FnaW5nOnYxOmFjY2VzcyJdLCJtY28iOiJTRUtBUEkifQ.zkX-m1dysMy-CaqOoe-KCbPnMsAG7aHKo2V7UDzLxkgx29HLrQI8RT7t05-RikeNFnaaFI10rQcBKn3ddhvPC3l8eIf6IL2wyIZX8NZXMVzGDznjvsIoATi-lq0SAcbZ"; // Remplacez par votre jeton d'accès
        
                $this->sendOrangeSms($client, $accessToken, $numeroExpediteur, $messageExpediteur);
                $this->sendOrangeSms($client, $accessToken, $numeroDestinataire, $messageDestinataire);
        
                // ... logique de succès ...
            } catch (\Exception $e) {
                echo('Erreur lors de l\'envoi de SMS Orange : ');
                // ... logique de gestion des erreurs ...
            }
    
            // Redirection avec message de succès
            return redirect()->route('admin.dashboard')->with('success', 'Expédition enregistrée avec succès.');
        }
    
        private function getOrangeAccessToken(Client $client)
        {
            $response = $client->post('https://api.orange.com/oauth/v3/token', [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode(env('ORANGE_CLIENT_ID') . ':' . env('ORANGE_CLIENT_SECRET')),
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                ],
            ]);
    
            $data = json_decode($response->getBody(), true);
            return $data['access_token'];
        }
    
        private function sendOrangeSms(Client $client, $accessToken, $phoneNumber, $message)
{
    $response = $client->post('https://api.orange.com/smsmessaging/v1/outbound/tel%3A+' . urlencode('+' . env('ORANGE_SENDER_NUMBER')) . '/requests', [
        'headers' => [
            'Authorization' => 'Bearer ' . $accessToken, // Utilisation du jeton d'accès
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'outboundSMSMessageRequest' => [
                'address' => 'tel:' . $phoneNumber,
                'senderAddress' => 'tel:' . '+' . env('ORANGE_SENDER_NUMBER'),
                'outboundSMSTextMessage' => [
                    'message' => $message,
                ],
            ],
        ],
    ]);

    if ($response->getStatusCode() !== 201) {
        throw new \Exception('Erreur lors de l\'envoi du SMS : ' . $response->getBody());
    }

    return $response;
}
    
        // EDIT EXPEDITION
        public function editExpedition($id)
            {
                $devisNonTraites = DevisColis::where('status', 'nontraite')->count();

                $expeditions = expeditions::find($id);
                return view('admin.mission.editExpedition', compact('devisNonTraites','expeditions'));
        }
        // Delete
        public function deleteExpedition($id)
        {
            
            $devisNonTraites = DevisColis::where('status', 'nontraite')->count();

            // 1. Trouver l'expédition à supprimer
            $expedition = expeditions::find($id);

            // 2. Vérifier si l'expédition existe
            if (!$expedition) {
                // Gérer le cas où l'expédition n'existe pas (par exemple, afficher un message d'erreur)
                return redirect()->route('admin.dashboard')->with('error', 'Expédition non trouvée.');
            }

            // 3. Supprimer l'expédition
            $expedition->delete();

            // 4. Rediriger avec un message de succès
            return redirect()->route('admin.dashboard')->with('devisNonTraites','success', 'Expédition supprimée avec succès.');
        }

        public function updateExpedition(Request $request, $id)
            {
                // Validat
                    $devisNonTraites = DevisColis::where('status', 'nontraite')->count();
                    
                $validatedData = $request->validate([
                    'expediteur_id' => 'nullable',
                    'nom_expediteur' => 'nullable',
                    'numero_expediteur' => 'nullable',
                    'email_expediteur' => 'nullable|email',
                    'adresse_expediteur' => 'nullable',
                    'destinataire_id' => 'nullable|exists:destinataires,id',
                    'nom_destinataire' => 'nullable',
                    'numero_destinataire' => 'nullable',
                    'email_destinataire' => 'nullable|email',
                    'adresse_destinataire' => 'nullable',
                    'numeroSuivi' => 'nullable',
                    'designation' => 'nullable',
                    'numeroConteneur' => 'nullable',
                    'typeService' => 'nullable',
                    'dateEnlev' => 'nullable|date',
                    'dateLivr' => 'nullable|date',
                    'montant_total' => 'nullable|numeric',
                    'montant_paye' => 'nullable|numeric',
                    'status' => 'nullable|in:encour,Non Livré,Livré',
                ]);
                // dd($validatedData);
                // Trouver l'expédition à mettre à jour
                    $expedition = expeditions::find($id);
                    if (!$expedition) {
                        return redirect()->route('admin.dashboard')->with('error', 'Expédition non trouvée.');
                                    }
            
                        // Mettre à jour l'expédition avec les données validées
                        $expedition->update($validatedData);
                        // Toastr::success("<h4 style='color:white; background:green;'>enregistrées avec succès !</h>");

                // Envoi du SMS
            try {
                $client = new Client();
                $response = $client->post(env('ORANGE_SMS_API_URL'), [
                    'headers' => [
                        'Authorization' => 'Basic ' . base64_encode(env('ORANGE_SMS_CLIENT_ID') . ':' . env('ORANGE_SMS_CLIENT_SECRET')),
                        'Content-Type' => 'application/json',
                    ],
                    'json' => [
                        'outboundSMSMessageRequest' => [
                            'address' => 'tel:' . env('ORANGE_SMS_RECIPIENT_PREFIX') . $request->numero_destinataire, // Assurez-vous que le champ existe
                            'senderAddress' => 'tel:' . env('ORANGE_SMS_SENDER_ADDRESS'),
                            'outboundSMSTextMessage' => [
                                'message' => 'Salut, Votre colis est .',
                            ],
                        ],
                    ],
                ]);

                // Gestion de la réponse de l'API (par exemple, journalisation)
                // Log::info('Réponse de l\'API SMS Orange : ' . $response->getBody());

                $successMessage = 'Votre demande a été soumise avec succès et un SMS a été envoyé.';
            } catch (\Exception $e) {
                // \Log::error('Erreur lors de l\'envoi du SMS : ' . $e->getMessage());
                $successMessage = 'Votre demande a été soumise avec succès, mais une erreur est survenue lors de l\'envoi du SMS.';
            }

            
                return redirect()->route('admin.dashboard')->with('success', $successMessage);
    

            }

        public function voirExpedition(expeditions $expedition)
    {
        
        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();

        return view('mission.showExpedition{$id}', compact('devisNonTraites','expedition')); 
    }

        public function destroyExpedition(expeditions $expedition)
            {
                $devisNonTraites = DevisColis::where('status', 'nontraite')->count();

                $expedition->delete();

                return redirect()->route('expeditions')->with('success', 'Expédition supprimée avec succès.');
            }
// END EXPEDITION CRUD




// FONCTION SUIVI
public function rechercherSuivi(Request $request)
{
    $devisNonTraites = DevisColis::where('status', 'nontraite')->count();

    $numeroSuivi = $request->input('numeroSuivi');

    if ($numeroSuivi) {
        $expedition = expeditions::where('numeroSuivi', $numeroSuivi)->first();

        if ($expedition) {
            return view('/SuiviPage', ['expedition' => $expedition]);
        } else {
            return redirect()->back()->with('error', 'Aucune expédition trouvée avec ce numéro de suivi.');
            }
        }

        return view('SuiviPage'); 
        // Retourne une vue vide si aucun numéro de suivi n'est fourni
    }
// END SUIVI FONCTION

// COMMANDE CRUD
public function CommanForm()
    {
        $totalExpeditions = expeditions::count();
        $nombre_aleatoire = (string)(random_int(10000, 99999));
            
        $nombre_aleatoire = (string)(random_int(10000, 99999));
        $code_unique = 'Al-'. $nombre_aleatoire;

        $code_suivi = 'SU-'. $nombre_aleatoire;
        
        $nomsClients = clients::pluck('nom_client', 'id');
        
        $expeditions = expeditions::all();
        return view('admin.mission.Ajouterexpeditions',compact(
            'nomsClients','expeditions','code_unique','code_suivi'));
    }

public function storeCommand(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'expediteur_id' => 'nullable',
            'nom_expediteur' => 'required',
            'numero_expediteur' => 'required',
            'email_expediteur' => 'nullable|email',
            'adresse_expediteur' => 'nullable',
            'destinataire_id' => 'nullable|exists:destinataires,id',
            'nom_destinataire' => 'required',
            'numero_destinataire' => 'required',
            'email_destinataire' => 'nullable|email',
            'adresse_destinataire' => 'nullable',
            'numeroSuivi' => 'required',
            'designation' => 'required',
            'numeroConteneur' => 'nullable',
            'typeService' => 'nullable',
            'dateEnlev' => 'nullable|date',
            'dateLivr' => 'nullable|date',
            'montant_total' => 'required|numeric',
            'montant_paye' => 'required|numeric',
            'status' => 'required|in:encour,Non Livré,Livré',
        ]);
        // dd($validatedData);
        $expedition = expeditions::create($validatedData);
        return redirect()->route('admin.dashboard')->with('success', 'Expédition supprimée avec succès.');

    }

// END COMMANDE CRUD


//CLIENT CRUD----------------------------------------------------------
    // public function storeClient(Request $request)
    // {
    //     // Validation des données du formulaire
    //     $request->validate([
    //     'code_client' => 'required|unique:clients,code_client', // Validation de l'unicité
    //     'nom_client' => 'required|string|max:255',
    //     'prenom_client' => 'nullable|string|max:255',
    //     'numero_client' => 'required|string|max:20', // Ajuster la longueur max si nécessaire
    //     'email_client' => 'required|email|max:255',
    //     'adresse_client' => 'required|string|max:255',]);

    //     $client = new clients();
    //     $client->code_client = $request->input('code_client'); // Utilisation du code unique
    //     $client->nom_client = $request->input('nom_client');
    //     $client->prenom_client = $request->input('prenom_client');
    //     $client->numero_client = $request->input('numero_client');
    //     $client->email_client = $request->input('email_client');
    //     $client->adresse_client = $request->input('adresse_client');
    //     $client->save();


    //     // Redirection avec un message de succès
    //     return redirect()->route('admin.dashboard')->with('success', 'Client ajouté avec succès.'); // Ajuster la route de redirection
    //     }

    //     // Edit client
    //     public function editCliens($id)
    //         {
    //         // Récupérer le client par son ID
    //         $client = clients::findOrFail($id);

    //         // Passer le client à la vue de modification
    //         return view('admin.clients.editClients', ['client' => $client]);
    //     }

    //         // Updateclient
    //         public function updateClient(Request $request, $id)
    //         {
    //         // Validation des données du formulaire
    //         $request->validate([
    //             'code_client' => 'required|string|max:255',
    //             'nom_client' => 'required|string|max:255',
    //             'prenom_client' => 'nullable|string|max:255',
    //             'numero_client' => 'required|string|max:20',
    //             'email_client' => 'required|email|max:255',
    //             'adresse_client' => 'required|string|max:255',
    //         ]);

    //         // Récupérer le client par son ID
    //         $client = clients::findOrFail($id);

    //         // Mettre à jour les données du client
    //         $client->nom_client = $request->input('nom_client');
    //         $client->prenom_client = $request->input('prenom_client');
    //         $client->numero_client = $request->input('numero_client');
    //         $client->email_client = $request->input('email_client');
    //         $client->adresse_client = $request->input('adresse_client');
    //         $client->save();

    //         // Rediriger avec un message de succès
    //         return redirect()->route('admin.clients')->with('success', 'Client mis à jour avec succès.');
    
    // }
//END CLIENT CRUD----------------------------------------------------


//CRUD DESTINATAIRE--------------------------------------------------
    // public function storeDestinataire(Request $request)
    // {
    //     // Validation des données du formulaire
    //     $request->validate([
    //     'code_unique' => 'required|unique:destinataire,code_unique', // Validation de l'unicité
    //     'nom_destinataire' => 'required|string|max:255',
    //     'prenom_destinataire' => 'nullable|string|max:255',
    //     'numero_destinataire' => 'required|string|max:20', // Ajuster la longueur max si nécessaire
    //     'email_destinataire' => 'required|email|max:255',
    //     'adresse_destinataire' => 'required|string|max:255',]);

    //     $destinataire = new destinataire();
    //     $destinataire->code_unique = $request->input('code_unique'); // Utilisation du code unique
    //     $destinataire->nom_destinataire = $request->input('nom_destinataire');
    //     $destinataire->prenom_destinataire = $request->input('prenom_destinataire');
    //     $destinataire->numero_destinataire = $request->input('numero_destinataire');
    //     $destinataire->email_destinataire = $request->input('email_destinataire');
    //     $destinataire->adresse_destinataire = $request->input('adresse_destinataire');
    //     $destinataire->save();


    //     // Redirection avec un message de succès
    //     return redirect()->route('admin.dashboard')->with('success', 'Client ajouté avec succès.'); // Ajuster la route de redirection
    //     }

    //     // Edit client
    //     public function editDestinataire($id)
    //     {
    //         // Récupérer le client par son ID
    //         $destinataire = destinataire::findOrFail($id);

    //         // Passer le destinataire à la vue de modification
    //         return view('admin.destinataires.editdestinataire', ['destinataire' => $destinataire]);
    //     }

    //         // Updatedestinataire
    //         public function updatedestinataire(Request $request, $id)
    //         {
    //         // Validation des données du formulaire
    //         $request->validate([
    //             'nom_destinataire' => 'required|string|max:255',
    //             'prenom_destinataire' => 'nullable|string|max:255',
    //             'numero_destinataire' => 'required|string|max:20',
    //             'email_destinataire' => 'required|email|max:255',
    //             'adresse_destinataire' => 'required|string|max:255',
    //         ]);

    //     // Récupérer le destinataire par son ID
    //     $destinataire = destinataire::findOrFail($id);

    //     // Mettre à jour les données du destinataire
    //     $destinataire->nom_destinataire = $request->input('nom_destinataire');
    //     $destinataire->prenom_destinataire = $request->input('prenom_destinataire');
    //     $destinataire->numero_destinataire = $request->input('numero_destinataire');
    //     $destinataire->email_destinataire = $request->input('email_destinataire');
    //     $destinataire->adresse_destinataire = $request->input('adresse_destinataire');
    //     $destinataire->save();

    //     // Rediriger avec un message de succès
    //     return redirect()->route('admin.destinataire')->with('success', 'Destinatair mis à jour avec succès.');
            
    // }
//END CRUD DESTINATAIRE--------------------------------------------------
            
  
//CRUD CONTENEUR---------------------------------------------------------
    // public function storeConteneur(Request $request)
    // {
    //     // Validation des données
    //     $request->validate([
    //         'container_number' => 'required|unique:conteneurs',
    //         'type' => 'required',
    //         'location' => 'required',
    //     ]);

    //     // Création et enregistrement du conteneur
    //     $conteneur = new conteneurs();
    //     $conteneur->container_number = $request->input('container_number');
    //     $conteneur->type = $request->input('type');
    //     $conteneur->location = $request->input('location');
    //     $conteneur->save();

    //     // Redirection avec un message de succès
    //     return redirect()->route('admin.dashboard')->with('success', 'Conteneur créé avec succès.');
    //     }
    //     public function editConteneur($id)
    //     {
    //         // Récupérer le conteneur par son ID
    //         $conteneur = conteneurs::findOrFail($id);

    //         // Passer le conteneur à la vue de modification
    //         return view('admin.conteneur.', ['conteneur' => $conteneur]);
    //     }

        // // Updatedestinataire
        // public function updateconteneur(Request $request, $id)
        // {
        // // Validation des données du formulaire
        // $request->validate([
        //     'conteneur_number' => 'required|string|max:255',
        //     'type' => 'nullable|string|max:255',
        //     'location' => 'required|string|max:255',
        // ]);

        // // Récupérer le destinataire par son ID
        // $conteneur = conteneurs::findOrFail($id);

        // // Mettre à jour les données du destinataire
        // $conteneur->conteneur_number = $request->input('conteneur_number');
        // $conteneur->type = $request->input('type');
        // $conteneur->location = $request->input('location');
        // $conteneur->save();

        // // Rediriger avec un message de succès
        // return redirect()->route('admin.destinataire')->with('success', 'Client mis à jour avec succès.');
        

        // }
        //END CRUD CONTENEUR--------------------------------------------------
            
                
//CRUD-EXPEDITEUR
    public function storeExpediteur(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
        'code_unique' => 'required|unique:clients,code_unique', // Validation de l'unicité
        'nom_expediteur' => 'required|string|max:255',
        'prenom_expediteur' => 'nullable|string|max:255',
        'numero_expediteur' => 'required|string|max:20', // Ajuster la longueur max si nécessaire
        'email_expediteur' => 'required|email|max:255',
        'adresse_expediteur' => 'required|string|max:255',]);

        $expediteur = new expediteur();
        $expediteur->code_unique = $request->input('code_unique'); // Utilisation du code unique
        $expediteur->nom = $request->input('nom_expediteur');
        $expediteur->prenom = $request->input('prenom_expediteur');
        $expediteur->numero = $request->input('numero_expediteur');
        $expediteur->email = $request->input('email_expediteur');
        $expediteur->adresse = $request->input('adresse_expediteur');
        $expediteur->save();


        // Redirection avec un message de succès
        return redirect()->route('admin.dashboard')->with('success', 'expediteur ajouté avec succès.'); // Ajuster la route de redirection
        }

        // Edit expediteur
        public function editExpediteur($id)
        {
            // Récupérer le expediteur par son ID
            $expediteur = expediteur::findOrFail($id);

            // Passer le expediteur à la vue de modification
            return view('admin.expediteurs.editExpediteur', ['expediteur' => $expediteur]);
        }

            // Update expediteur
    //         public function updateExpediteur(Request $request, $id)
    //         {
    //         // Validation des données du formulaire
    //         $request->validate([
    //             'nom_expediteur' => 'required|string|max:255',
    //             'prenom_expediteur' => 'nullable|string|max:255',
    //             'numero_expediteur' => 'required|string|max:20',
    //             'email_expediteur' => 'required|email|max:255',
    //             'adresse_expediteur' => 'required|string|max:255',
    //         ]);

    //         // Récupérer le expediteur par son ID
    //         $expediteur = expediteur::findOrFail($id);

    //         // Mettre à jour les données du expedieteur
    //         $expediteur->nom_expediteur = $request->input('nom_expediteur');
    //         $expediteur->prenom_expediteur = $request->input('prenom_expediteur');
    //         $expediteur->numero_expediteur = $request->input('numero_expediteur');
    //         $expediteur->email_expediteur = $request->input('email_expediteur');
    //         $expediteur->adresse_expediteur = $request->input('adresse_expediteur');
    //         $expediteur->save();

    //         // Rediriger avec un message de succès
    //         return redirect()->route('admin.expediteur')->with('success', '_expediteur mis à jour avec succès.');
        
    // }



}
