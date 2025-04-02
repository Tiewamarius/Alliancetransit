<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification; // Importez la façade Notification
use App\Notifications\NouvelleExpedition;
use App\Models\rendevous;
use App\Models\DevisColis;
use App\Models\expeditions;
use App\Models\expediteur;
use Twilio\Rest\Client;
use App\Http\Controllers\SmsController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\clients;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
// use App\Models\Admin;
// use App\Models\User; Importez le modèle Admin
// use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Infobip\Configuration;
use Infobip\ApiException;
use Infobip\Model\SmsAdvancedTextualRequest;
use Infobip\Model\SmsDestination;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsTextualMessage;
use Informagenie\OrangeSDK;//Orange sdk
use function Termwind\render;

class AdminCrudController extends Controller
{

// WELCOME - DASHBOARD
public function dashboard()
    {
            $devisNonTraites = DevisColis::where('status', 'nontraite')->count();

        
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

           

            return view('admin.dashboard',compact('devisNonTraites','stock','Encour','All','colisArrives','coliLivre','expeditions'));
    

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

    protected $smsService;

    public function __construct(SmsController $smsService)
    {
        $this->smsService = $smsService;
    }

    /**
     * Enregistre une nouvelle expédition et envoie des notifications par SMS.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeExpedition(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'particulier' => 'nullable|boolean',
            'expediteur_id' => 'nullable', // exists:expediteurs,id
            'nom_expediteur' => 'required|string|max:255',
            'numero_expediteur' => 'required|string|max:20',
            'email_expediteur' => 'nullable|email|max:255',
            'adresse_expediteur' => 'nullable|string|max:255',
            'destinataire_id' => 'nullable|exists:destinataires,id',
            'nom_destinataire' => 'required|string|max:255',
            'numero_destinataire' => 'required|string|max:20',
            'email_destinataire' => 'nullable|email|max:255',
            'adresse_destinataire' => 'nullable|string|max:255',
            'numeroSuivi' => 'required|string|unique:expeditions|max:255',
            'designation' => 'required|string|max:255',
            'numeroConteneur' => 'nullable|string|max:255',
            'typeService' => 'nullable|string|max:255',
            'dateEnlev' => 'nullable|date',
            'dateLivr' => 'nullable|date',
            'montant_total' => 'required|numeric|min:0',
            'montant_paye' => 'required|numeric|min:0',
            'status' => 'required|in:encour,Non Livré,Livré',
            'image_colis' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Gestion de l'image du colis
        if ($request->hasFile('image_colis')) {
            $imagePath = $request->file('image_colis')->store('expeditions', 'public');
            $validatedData['image_colis'] = $imagePath;
        }

        // Création de l'expédition
        $expedition = ExpeditionS::create($validatedData);

        // Récupération des informations nécessaires pour les SMS
        $numeroExpediteur = $validatedData['numero_expediteur'];
        $numeroDestinataire = $validatedData['numero_destinataire'];
        $nomDestinataire = $validatedData['nom_destinataire'];
        $numeroSuivi = $validatedData['numeroSuivi'];

        
        // Envoi de SMS via Orange SMS
        $this->smsService->sendSms($numeroExpediteur,
            "Votre expédition N° {$numeroSuivi}
            a été enregistrée.");
        $this->smsService->sendSms($numeroDestinataire,
            "Bonjour Mme/Mr {$nomDestinataire}, Alliance Transit vous informe que la livraison de votre colis s'effectuera demain. 
            Nous vous rappelons que toutes personnes injoignables passera au dépôt récupérer son coli.
            Merci de prendre vos dispositions pour la bonne réception du colis.
            Votre N° de suivi: {$numeroSuivi}");

        return redirect()->route('admin.dashboard')->with('success', 'L\'expédition a été enregistrée avec succès et les notifications SMS ont été envoyées.');
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


