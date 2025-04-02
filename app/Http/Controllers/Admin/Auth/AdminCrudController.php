<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\rendevous;
use App\Models\DevisColis;
use App\Models\expeditions;
use App\Http\Controllers\SmsController;
use App\Models\clients;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Mail\ContactFormMail; // Importez le Mail class que nous allons créer
use Illuminate\Support\Facades\Mail;

class AdminCrudController extends Controller
{

// WELCOME - DASHBOARD
public function dashboard()
    {
            $devisNonTraites = DevisColis::where('status', 'nontraite')->count();

        
            $expeditions = expeditions::latest()->paginate(5);
            $All = expeditions::count();

            
            $Encour= expeditions::where('status', 'Encour')->count();
            $colisArrives = expeditions::where('status', 'Arrivé')->count();
            $Depot= expeditions::where('status', 'Depot')->count();
            $stock= expeditions::where('status', 'Non Livré')->count();
            $coliLivre= expeditions::where('status', 'Livré')->count();
            
            $totalExpeditions = expeditions::count();
            $nombre_aleatoire = (string)(random_int(10000, 99999));
            $code_client = 'Cl-'. $nombre_aleatoire;
            // $totalClients = expeditions::distinct('code_client')->count('code_client');
            $nombre_aleatoire = (string)(random_int(10000, 99999));
            $code_suivi = 'Al-'. $nombre_aleatoire;

           

            return view('admin.dashboard',compact('devisNonTraites','stock','Encour','All','colisArrives','coliLivre','expeditions'));
    

    }
// END FUNCTION DASHBOARD

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



// Fonction AllRdv
    public function allRdv()
    {
        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();

        $rendevouses = rendevous::all();
        return view('admin.clients.allRdv',compact('devisNonTraites','rendevouses'));

    }
// End allRdvs

// Fonction AllDevis
public function allDevis()
    {
        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();

        $devisClients = DevisColis::all(); // Récupère tous les devis
        return view('admin.clients.allDevis', compact('devisClients','devisNonTraites'));
    }

    public function editDevis($id)
    {
         // Récupérer le devis en utilisant l'ID
        $devis = DevisColis::findOrFail($id);

        // Passer le devis à la vue
        return view('admin.devis.edit', compact('devis'));
    }
    
    public function updateDevis(Request $request, $id)
    {
        // Logique pour valider et mettre à jour un devis
    }
    
    public function deleteDevis($id)
    {
        // Logique pour supprimer un devis
    }
    // End allDevis

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
                    'status' => 'required|in:Encour,Depot,Arrivé,Non Livré,Livré',
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
                    $nomExpediteur = $validatedData['nom_destinataire'];
                    $numeroSuivi = $validatedData['numeroSuivi'];
                
                    // Envoi de SMS via Orange SMS
                    $this->smsService->sendSms($numeroExpediteur,
                    "Bonjour Mme/Mr {$nomExpediteur}, Alliance Transit vous informe que la livraison de votre colis s'effectuera demain.Nous vous rappelons que toutes personnes injoignables passera au dépôt récupérer son coli.Merci de prendre vos dispositions pour la bonne réception du colis.Votre N° de suivi: {$numeroSuivi}");

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
    // UPDATE EXPEDITION
        
        public function updateExpedition(Request $request, $id)
            {
                // Validation des données
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
                    'montant_versement' => 'required|numeric|min:0',
                    'status' => 'nullable|in:Non Traité,Encour,Depot,Arrivé,Non Livré,Livré',
                ]);
            
                // Trouver l'expédition à mettre à jour
                $expedition = Expeditions::find($id);
            
                if (!$expedition) {
                    return redirect()->route('admin.dashboard')->with('error', 'Expédition non trouvée.');
                }
            
                // Calcul du nouveau montant payé et du crédit restant
                $montantVerse = $request->input('montant_versement', 0);
                $expedition->montant_paye += $montantVerse;
                $creditRestant = $expedition->montant_total - $expedition->montant_paye;
            
                // Stocker l'ancien statut
                $oldStatus = $expedition->status;
            
                // Mise à jour de l'expédition avec les nouvelles valeurs
                $expedition->update(array_merge($validatedData, [
                    'montant_paye' => $expedition->montant_paye,
                    'credit_restant' => $creditRestant,
                    'montant_verse' => $request->input('montant_verse', $expedition->montant_verse),
                ]));
            
                // Récupération des informations nécessaires pour les SMS
                $numeroDestinataire = optional($expedition)->numero_destinataire;
                $nomDestinataire = optional($expedition)->nom_destinataire;
                $numeroSuivi = optional($expedition)->numeroSuivi;
            
                // Messages SMS par statut
                $smsMessages = [
                    // 'Encour' => "Bonjour Mme/Mr {$nomDestinataire}, Alliance Transit vous informe que la livraison de votre colis est en cours d'expédition. Nous vous rappelons que toutes personnes injoignables passeront au dépôt récupérer leur colis. Merci de prendre vos dispositions pour la bonne réception du colis. Votre N° de suivi: {$numeroSuivi}",
                    'Arrivé' => "Bonjour Mme/Mr {$nomDestinataire}, Alliance Transit vous informe que votre colis vient d'Arriver à Abidjan. Merci de nous envoyer votre adresse précise de livraison et d'informer votre correspondant à Abidjan. Toutefois, tous les clients indisponibles lors de la livraison passeront récupérer leur colis au dépôt. Merci pour votre compréhension. Votre N° de suivi: {$numeroSuivi}",
                    'Depot' => "Bonjour Mme/Mr {$nomDestinataire}, Alliance Transit vous informe que votre colis est désormais disponible au dépôt. Vous pouvez venir le récupérer muni de votre numéro de suivi. Votre N° de suivi: {$numeroSuivi}",
                    'Non Livré' => "Bonjour Mme/Mr {$nomDestinataire}, Alliance Transit vous informe que la livraison de votre colis n'a pas pu être effectuée. Veuillez nous contacter pour plus d'informations. Votre N° de suivi: {$numeroSuivi}",
                    'Livré' => "Bonjour Mme/Mr {$nomDestinataire}, Alliance Transit vous informe que la livraison de votre colis a été effectuée avec succès. Merci pour votre confiance. Votre N° de suivi: {$numeroSuivi}",
                    // 'Non Traité' => "Bonjour Mme/Mr {$nomDestinataire}, Alliance Transit vous informe que votre colis n'a pas encore été traité. Nous vous contacterons dès que possible. Votre N° de suivi: {$numeroSuivi}",
                ];
            
                // Envoi de SMS de notification
                if ($oldStatus !== $validatedData['status'] && $numeroDestinataire) {
                    try {
                        if (isset($smsMessages[$validatedData['status']])) {
                            $this->smsService->sendSms($numeroDestinataire, $smsMessages[$validatedData['status']]);
                        } else {
                            // Gestion du cas où le statut n'est pas défini dans le tableau
                            $this->smsService->sendSms($numeroDestinataire, "Bonjour Mme/Mr {$nomDestinataire}, Alliance Transit vous informe que le statut de votre colis a été mis à jour. Votre N° de suivi: {$numeroSuivi}");
                        }
                    } catch (\Exception $e) {
                        // Gestion de l'erreur d'envoi de SMS
                        return redirect()->route('admin.dashboard')->with('error', 'L\'expédition a été enregistrée avec succès, mais l\'envoi du SMS a échoué.');
                    }
                }
            
                return redirect()->route('admin.dashboard')->with('success', 'L\'expédition a été enregistrée avec succès et les notifications SMS ont été envoyées.');
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



    
}