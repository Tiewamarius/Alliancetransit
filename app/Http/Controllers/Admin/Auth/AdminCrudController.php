<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\rendevous;
use App\Models\Conteneur;
use App\Exports\ExportExpedition;
use App\Exports\ExportExpeditionLivraison;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NouvelleExpedition;

use App\Mail\NoteUpdated;
use App\Mail\NoteReplied;
use App\Models\DevisColis;
use App\Models\Note;
use App\Models\expeditions;
use App\Http\Controllers\SmsController;
use App\Models\clients;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Mail\ContactFormMail; // Importez le Mail class que nous allons créer
use Illuminate\Support\Facades\Mail;
use App\Models\Admin;
use App\Models\User;

class AdminCrudController extends Controller
{

    // WELCOME - DASHBOARD
    public function dashboard(Request $request, $year = null)
    {
        $conteneur = Conteneur::all();
        $query = expeditions::query();

        if ($year) {
            $query->whereYear('dateEnlev', $year);
        }

        $expeditions = $query->latest()->paginate(5);
        $All = $query->count(); // Compter après le filtrage

        $Encour = expeditions::where('status', 'Encour')->count();
        $colisArrives = expeditions::where('status', 'Arrivé')->count();
        // $Depot = $query->where('status', 'Depot')->count();
        $stock = expeditions::where('status', 'Depot')->count();
        $coliLivre = expeditions::where('status', 'Livré')->count();

        $NoteNonTraites = Note::where('status', 'unread')->count();
        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();

        $totalExpeditions = expeditions::count(); // Total général, pas filtré par année
        $nombre_aleatoire = (string)(random_int(10000, 99999));
        $code_client = 'Cl-' . $nombre_aleatoire;
        $nombre_aleatoire = (string)(random_int(10000, 99999));
        $code_suivi = 'Al-' . $nombre_aleatoire;

        return view('admin.dashboard', compact('devisNonTraites', 'NoteNonTraites', 'stock', 'Encour', 'All', 'colisArrives', 'coliLivre', 'expeditions', 'conteneur'));
    }
    // END FUNCTION DASHBOARD


    // EXPORTATIONS
    public function exportExpeditions(int $annee)
    {
        return Excel::download(new ExportExpedition($annee), 'expeditions' . $annee . '.xlsx');
    }

    public function exportExpeditionsSpecificB(int $annee)
    {
        return Excel::download(new ExportExpeditionLivraison($annee), 'expeditionLivraison' . $annee . '.xlsx');
    }
    // end-------------------------------


    // PAGINATION
    public function pagination()
    {
        $expeditions = expeditions::latest()->paginate(5);
        $All = expeditions::count();

        $colisArrives = expeditions::where('status', 'Non Livré')->count();
        $coliLivre = expeditions::where('status', 'Livré')->count();
        $Encour = expeditions::where('status', 'encour')->count();
        $stock = expeditions::where('status', 'Non Livré')->count();

        $totalExpeditions = expeditions::count();
        $nombre_aleatoire = (string)(random_int(10000, 99999));
        $code_client = 'Cl-' . $nombre_aleatoire;
        // $totalClients = expeditions::distinct('code_client')->count('code_client');
        $nombre_aleatoire = (string)(random_int(10000, 99999));
        $code_suivi = 'Al-' . $nombre_aleatoire;



        return view('admin.dashboard_pagination', compact('stock', 'Encour', 'All', 'colisArrives', 'coliLivre', 'expeditions'))->render();
    }



    // Fonction AllRdv
    public function allRdv()
    {
        $NoteNonTraites = Note::where('status', 'unread')->count();
        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();
        $aujourdhui = Carbon::today();


        $rendevouses = Rendevous::all(); // Récupérer tous les rendez-vous
        $aujourdhui = Carbon::today();

        // return view('votre_vue', compact('rendevouses', 'aujourdhui'));

        return view('admin.clients.allRdv', compact('NoteNonTraites', 'devisNonTraites', 'rendevouses', 'aujourdhui'));
    }

    // FONCTION DESTROY RDV
    public function destroyRdv($id)
    {
        try {
            $rendevous = Rendevous::findOrFail($id);
            $rendevous->delete();

            // Optionnel: Ajouter une notification de succès (avec Toastr par exemple)
            Toastr::success('<h6 style="color:green">Le rendez-vous a été supprimé avec succès.<h6>', 'Succès');

            return redirect()->back()->with('success', 'Le rendez-vous a été supprimé avec succès.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Optionnel: Gérer le cas où le rendez-vous n'existe pas
            Toastr::success('<h6 style="color:green">Le rendez-vous a été supprimé avec succès.<h6>', 'Succès');
            return redirect()->back()->with('error', 'Le rendez-vous que vous essayez de supprimer n\'existe pas.');
        } catch (\Exception $e) {
            // Optionnel: Gérer d'autres erreurs potentielles
            Toastr::error('Une erreur s\'est produite lors de la suppression du rendez-vous.', 'Erreur');
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la suppression du rendez-vous.');
        }
    }

    // End allRdvs

    // Fonction AllDevis
    public function allDevis()
    {
        $NoteNonTraites = Note::where('status', 'unread')->count();
        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();

        $devisClients = DevisColis::all(); // Récupère tous les devis
        return view('admin.clients.allDevis', compact('NoteNonTraites', 'devisClients', 'devisNonTraites'));
    }

    public function editDevis($id)
    {

        $NoteNonTraites = Note::where('status', 'unread')->count();
        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();
        // Récupérer le devis en utilisant l'ID
        $devis = DevisColis::findOrFail($id);

        // Passer le devis à la vue
        return view('admin.clients.editDevis', compact('devis', 'NoteNonTraites', 'devisNonTraites'));
    }

    public function updateDevis(Request $request, $id)
    {
        // 1. Validation des données de la requête
        $validatedData = $request->validate([
            'particulier' => 'nullable|string',
            'numero' => 'nullable|string',
            'paysDepart' => 'nullable|string',
            'paysArrivee' => 'nullable|string',
            'villeDepart' => 'nullable|string',
            'villeArrivee' => 'nullable|string',
            'designation' => 'nullable|string',
            'montant_total' => 'nullable|numeric',
            'status' => 'nullable|in:nontraite,encour,traite', // Ajoutez les statuts pertinents
        ]);

        // 2. Recherche du devis à mettre à jour
        $devis = DevisColis::findOrFail($id);

        // 3. Mise à jour des données du devis
        $devis->update($validatedData);

        // 4. Redirection avec un message de succès
        return redirect()->route('allDevis')->with('success', 'Devis mis à jour avec succès.');
    }

    public function deleteDevis($id)
    {
        $NoteNonTraites = Note::where('status', 'unread')->count();

        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();
        // Récupérer le devis en utilisant l'ID
        $devis = DevisColis::findOrFail($id);
        // Supprimer le devis
        $devis->delete();
        return  redirect()->back();
    }
    // End allDevis


    // Fonction AllNote
    public function allNote()
    {
        $NoteNonTraites = Note::where('status', 'unread')->count();
        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();

        $notesClients = Note::all(); // Récupère tous les Note
        return view('admin.clients.allNote', compact('notesClients', 'devisNonTraites', 'NoteNonTraites'));
    }

    public function editNote($id)
    {
        $NoteNonTraites = Note::where('status', 'unread')->count();
        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();
        // Récupérer le Note en utilisant l'ID
        $note = Note::findOrFail($id);

        // Passer le Note à la vue
        return view('admin.clients.editNote', compact('note', 'devisNonTraites', 'NoteNonTraites'));
    }

    public function updateNote(Request $request, $id)
    {
        // 1. Validation des données de la requête
        $validatedData = $request->validate([
            'status' => 'nullable|in:unread,read', // Ajoutez les statuts pertinents
            // Vous pouvez ajouter ici des champs pour la réponse si nécessaire
            'reply_content' => 'nullable|string',
        ]);
    
        // 2. Recherche du Note à mettre à jour
        $note = Note::findOrFail($id);
    
        // 3. Stocker l'ancien statut
        $oldStatus = $note->status;
    
        // 4. Mise à jour des données du Note
        $note->update($validatedData);
    
        // 5. Envoyer une réponse par email si le statut a été modifié ou si une réponse a été ajoutée
        if ($request->has('status') && $oldStatus !== $note->status) {
            $this->sendNoteUpdateEmail($note);
        }
    
        // Si une réponse a été fournie, vous pouvez également envoyer un email de notification
        if ($request->filled('reply_content')) {
            $this->sendNoteReplyEmail($note, $request->input('reply_content'));
            // Vous pourriez également enregistrer la réponse dans une table de réponses associées à la note
        }
    
        // 6. Redirection avec un message de succès
        return redirect()->route('allNote')->with('success', 'Note mis à jour avec succès.');
    }
    
    private function sendNoteUpdateEmail(Note $note)
    {
        if ($note->email) { // Vérifiez si l'email existe
            Mail::to($note->email)->send(new NoteUpdated($note));
        }
    }
    
    private function sendNoteReplyEmail(Note $note, string $replyContent)
    {
        if ($note->email) { // Vérifiez si l'email existe
            Mail::to($note->email)->send(new NoteReplied($note, $replyContent));
        }
    }


    public function deleteNote($id)
    {
        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();
        // Récupérer le Note en utilisant l'ID
        $note = Note::findOrFail($id);
        // Supprimer le Note
        $note->delete();
        return  redirect()->back();
    }
    // End allNote


    //SEARCH FONCTION----------------------------------------------------
    public function search(Request $request)
    {
        $query = expeditions::query();

        if ($request->has('search_string') && $request->search_string) {
            $search = '%' . $request->search_string . '%';
            $query->where(function ($q) use ($search) {
                $q->where('expediteur_id', 'like', $search)
                    ->orWhere('nom_expediteur', 'like', $search)
                    ->orWhere('numero_expediteur', 'like', $search)
                    ->orWhere('email_expediteur', 'like', $search)
                    ->orWhere('adresse_expediteur', 'like', $search)
                    ->orWhere('nom_destinataire', 'like', $search)
                    ->orWhere('numero_destinataire', 'like', $search)
                    ->orWhere('email_destinataire', 'like', $search)
                    ->orWhere('adresse_destinataire', 'like', $search)
                    ->orWhere('numeroSuivi', 'like', $search)
                    ->orWhere('designation', 'like', $search)
                    ->orWhere('conteneur_id', 'like', $search)
                    ->orWhere('typeService', 'like', $search)
                    ->orWhere('status', 'like', $search);
            });
        }

        if ($request->has('conteneurs') && $request->conteneurs) {
            $query->where('conteneur_id', $request->conteneurs);
        }

        if ($request->has('localite') && $request->localite) {
            $query->where('adresse_expediteur', 'like', '%' . $request->localite . '%'); // Ou ->where('adresse_expediteur', $request->localite); pour une correspondance exacte
        }

        if ($request->has('year') && $request->year) {
            $query->whereYear('created_at', $request->year);
        }

        $expeditions = $query->paginate(5);

        if ($expeditions->count() >= 1) {
            return view('admin.dashboard_pagination', compact('expeditions'))->render();
        } else {
            return response()->json(
                ['status' => 'Inexistant'],
            );
        }
    }

    // UPDATE GROUPER
    public function bulkUpdateStatus(Request $request)
{
    $validator = Validator::make($request->all(), [
        'status' => 'required|in:Non Traité,Encour,Arrivé,Depot,Non Livré,Livré', // Validez les statuts possibles
        'expedition_ids' => 'required|array|min:1',
        'expedition_ids.*' => 'integer|exists:expeditions,id', // Validez que les IDs existent
    ]);

    if ($validator->fails()) {
        return response()->json(['success' => false, 'message' => 'Erreur de validation.'], 400);
    }

    $status = $request->input('status');
    $expeditionIds = $request->input('expedition_ids');

    try {
        // Récupérer les expéditions AVANT la mise à jour pour comparer l'ancien statut
        $expeditionsToUpdate = Expeditions::whereIn('id', $expeditionIds)->get();

        // Mise à jour des statuts
        Expeditions::whereIn('id', $expeditionIds)
            ->update(['status' => $status]);

        // Envoi des notifications pour chaque expédition mise à jour
        foreach ($expeditionsToUpdate as $expedition) {
            $oldStatus = $expedition->getOriginal('status');

            // Envoyer les notifications (email et SMS) si le statut a changé
            if ($oldStatus !== $status) {
                $this->sendNotificationsOnBulkUpdate($expedition, $status);
            }
        }

        return response()->json(['success' => true, 'message' => 'Statut des expéditions mis à jour avec succès et les notifications ont été envoyées si le statut a changé.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Erreur lors de la mise à jour des statuts.'], 500);
    }
}

private function sendNotificationsOnBulkUpdate(Expeditions $expedition, string $newStatus)
{
    // Notification par email au destinataire si l'email existe
    if ($expedition->email_destinataire) {
        Notification::route('mail', $expedition->email_destinataire)
            ->notify(new NouvelleExpedition($expedition, 'destinataire'));
    }

    // Notification par email à l'expediteur si l'email existe
    if ($expedition->email_expediteur) {
        Notification::route('mail', $expedition->email_expediteur)
            ->notify(new NouvelleExpedition($expedition, 'expediteur'));
    }

    // Envoi de SMS en fonction du nouveau statut
    $this->sendSmsNotificationsOnBulkUpdate($expedition, $newStatus);
}

private function sendSmsNotificationsOnBulkUpdate(Expeditions $expedition, string $newStatus)
{
    $numeroDestinataire = $expedition->numero_destinataire;
    $nomDestinataire = $expedition->nom_destinataire;
    $numeroExpediteur = $expedition->numero_expediteur;
    $nomExpediteur = $expedition->nom_expediteur;
    $numeroSuivi = $expedition->numeroSuivi;
    $dateLivr = $expedition->dateLivr ? $expedition->dateLivr->format('d/m/Y') : 'non spécifiée';

    // Messages SMS par statut pour le destinataire
    $smsMessagesDestinataire = [
        'Encour' => "Bonjour Mme/Mr {$nomDestinataire}, Alliance Transit vous informe que la livraison de votre colis N° {$numeroSuivi} est en cours d'expédition. Nous vous rappelons que toutes personnes injoignables passeront au dépôt récupérer leur colis. Merci de prendre vos dispositions pour la bonne réception du colis. Votre N° de suivi: {$numeroSuivi}",
        'Arrivé' => "Bonjour Mme/Mr {$nomDestinataire}, Alliance Transit vous informe que votre colis N° {$numeroSuivi} vient d'arriver à Abidjan. Merci de nous envoyer votre adresse précise de livraison et d'informer votre correspondant à Abidjan. Toutefois, tous les clients indisponibles lors de la livraison passeront récupérer leur colis au dépôt. Merci pour votre compréhension. Votre N° de suivi: {$numeroSuivi}",
        'Depot' => "Bonjour Mme/Mr {$nomDestinataire}, Alliance Transit vous informe que votre colis N° {$numeroSuivi} est désormais disponible au dépôt. Vous pouvez venir le récupérer muni de votre numéro de suivi. Votre N° de suivi: {$numeroSuivi}",
        'Livré' => "Bonjour Mme/Mr {$nomDestinataire}, Alliance Transit vous informe que la livraison de votre colis N° {$numeroSuivi} a été effectuée avec succès le {$dateLivr}. Merci pour votre confiance. Votre N° de suivi: {$numeroSuivi}",
        'Non Livré' => "Bonjour Mme/Mr {$nomDestinataire}, Alliance Transit vous informe que la livraison de votre colis N° {$numeroSuivi} n'a pas pu être effectuée. Veuillez nous contacter pour plus d'informations. Votre N° de suivi: {$numeroSuivi}",
        'Non Traité' => "Bonjour Mme/Mr {$nomDestinataire}, Alliance Transit vous informe que votre colis N° {$numeroSuivi} est en cours de préparation pour l'expédition. Nous vous informerons de la date de chargement prochainement. Votre N° de suivi: {$numeroSuivi}",
    ];

    // Messages SMS par statut pour l'expéditeur
    $smsMessagesExpediteur = [
        'Encour' => "Bonjour Mr/Mme {$nomExpediteur}, Alliance Transit vous informe que votre colis N° {$numeroSuivi} est en cours de traitement pour la livraison.",
        'Arrivé' => "Bonjour Mr/Mme {$nomExpediteur}, Alliance Transit vous informe que votre colis N° {$numeroSuivi} est arrivé à destination à Abidjan.",
        'Depot' => "Bonjour Mr/Mme {$nomExpediteur}, Alliance Transit vous informe que le colis N° {$numeroSuivi} est disponible au dépôt pour le destinataire.",
        'Livré' => "Bonjour Mr/Mme {$nomExpediteur}, Alliance Transit vous informe que le colis N° {$numeroSuivi} a été livré avec succès le {$dateLivr}.",
        'Non Livré' => "Bonjour Mr/Mme {$nomExpediteur}, Alliance Transit vous informe que la livraison du colis N° {$numeroSuivi} a rencontré un problème.",
        'Non Traité' => "Bonjour Mr/Mme {$nomExpediteur}, Alliance Transit vous informe que votre colis N° {$numeroSuivi} a été enregistré et est en attente de traitement pour l'expédition.",
    ];

    // Envoi de SMS au destinataire si le numéro existe et le statut a un message défini
    if ($numeroDestinataire && isset($smsMessagesDestinataire[$newStatus])) {
        try {
            $this->smsService->sendSms($numeroDestinataire, $smsMessagesDestinataire[$newStatus]);
        } catch (\Exception $e) {
            Log::error("Erreur lors de l'envoi du SMS au destinataire pour l'expédition {$expedition->id}: " . $e->getMessage());
        }
    }

    // Envoi de SMS à l'expéditeur si le numéro existe et le statut a un message défini
    if ($numeroExpediteur && isset($smsMessagesExpediteur[$newStatus])) {
        try {
            $this->smsService->sendSms($numeroExpediteur, $smsMessagesExpediteur[$newStatus]);
        } catch (\Exception $e) {
            Log::error("Erreur lors de l'envoi du SMS à l'expéditeur pour l'expédition {$expedition->id}: " . $e->getMessage());
        }
    }
}


    // EXPEDITIONS CRUD
    public function ExpeditionForm()
    {
        $conteneur = Conteneur::all();

        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();
        $NoteNonTraites = Note::where('status', 'unread')->count();


        $totalExpeditions = expeditions::count();
        $nombre_aleatoire = (string)(random_int(10000, 99999));

        $nombre_aleatoire = (string)(random_int(10000, 99999));
        $code_unique = 'Al-' . $nombre_aleatoire;

        $code_suivi = 'SU-' . $nombre_aleatoire;

        $nomsClients = clients::pluck('nom_client', 'id');

        $expeditions = expeditions::all();
        return view('admin.mission.Ajouterexpeditions', compact(
            'nomsClients',
            'expeditions',
            'code_unique',
            'code_suivi',
            'devisNonTraites',
            'NoteNonTraites',
            'conteneur'
        ));
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
            'conteneur_id' => 'nullable|exists:conteneurs,nom',
            'typeService' => 'nullable|string|max:255',
            'dateEnlev' => 'nullable|date',
            'dateLivr' => 'nullable|date',
            'dateCharg' => 'nullable|date',
            'montant_total' => 'required|numeric|min:0',
            'montant_paye' => 'required|numeric|min:0',
            'status' => 'required|in:Encour,Depot,Arrivé,Non Livré,Livré',
            'image_colis' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Gestion de l'image du colis
        if ($request->hasFile('image_colis')) {
            $imagePath = $request->file('image_colis')->store('expeditions', 'public');
            $validatedData['image_colis'] = $imagePath;
        } else {
            $validatedData['image_colis'] = null; // Assurez-vous qu'une valeur nulle est enregistrée si aucune image n'est fournie
        }

        // Création de l'expédition
        $expedition = Expeditions::create($validatedData);

        // Envoi des notifications (Email et SMS)
        $this->sendNotifications($expedition);

        return redirect()->route('admin.dashboard')->with('success', 'L\'expédition a été enregistrée avec succès et les notifications ont été envoyées.');
    }

    private function sendNotifications(ExpeditionS $expedition)
    {
        // Notification par email au destinataire
        if ($expedition->email_destinataire) {
            Notification::route('mail', $expedition->email_destinataire)
                ->notify(new NouvelleExpedition($expedition, 'destinataire'));
        }

        // Notification par email à l'expediteur
        if ($expedition->email_expediteur) {
            Notification::route('mail', $expedition->email_expediteur)
                ->notify(new NouvelleExpedition($expedition, 'expediteur'));
        }

        // Envoi de SMS en fonction du statut
        $this->sendSmsNotifications($expedition);
    }

    private function sendSmsNotifications(ExpeditionS $expedition)
    {
        $numeroDestinataire = $expedition->numero_destinataire;
        $nomDestinataire = $expedition->nom_destinataire;
        $numeroExpediteur = $expedition->numero_expediteur;
        $nomExpediteur = $expedition->nom_expediteur;
        $numeroSuivi = $expedition->numeroSuivi;
        $dateEnlev = $expedition->dateEnlev ? $expedition->dateEnlev->format('d/m/Y') : 'non spécifiée';
        $dateLivr = $expedition->dateLivr ? $expedition->dateLivr->format('d/m/Y') : 'non spécifiée';

        // SMS pour le destinataire
        switch ($expedition->status) {
            case 'Encour':
                $this->smsService->sendSms(
                    $numeroDestinataire,
                    "Bonjour Mr/Mme {$nomDestinataire}, votre colis N° {$numeroSuivi} est en cours de traitement et sera expédié prochainement. www.alliancetransit.com"
                );
                break;
            case 'Arrivé':
                $this->smsService->sendSms(
                    $numeroDestinataire,
                    "Bonjour Mr/Mme {$nomDestinataire}, la livraison de votre colis N° {$numeroSuivi} est prévue pour le {$dateLivr}. Merci de prendre vos dispositions. www.alliancetransit.com"
                );
                break;
            case 'Depot':
                $this->smsService->sendSms(
                    $numeroDestinataire,
                    "Bonjour Mr/Mme {$nomDestinataire}, votre colis N° {$numeroSuivi} est arrivé au dépôt. Vous pouvez venir le récupérer. www.alliancetransit.com"
                );
                break;
            case 'Livré':
                $this->smsService->sendSms(
                    $numeroDestinataire,
                    "Bonjour Mr/Mme {$nomDestinataire}, votre colis N° {$numeroSuivi} a été livré avec succès le {$dateLivr}. Merci pour votre confiance. www.alliancetransit.com"
                );
                break;
            case 'Non Livré':
                $this->smsService->sendSms(
                    $numeroDestinataire,
                    "Bonjour Mr/Mme {$nomDestinataire}, la livraison de votre colis N° {$numeroSuivi} a rencontré un problème. Nous vous contacterons. www.alliancetransit.com"
                );
                break;
            case 'Non Traité':
                $this->smsService->sendSms(
                    $numeroDestinataire,
                    "Bonjour Mr/Mme {$nomDestinataire}, votre colis N° {$numeroSuivi} est en cours de préparation pour l'expédition. Nous vous informerons de la date de chargement. www.alliancetransit.com"
                );
                break;
            default:
                // Gérer d'autres statuts si nécessaire
                break;
        }

        // SMS pour l'expéditeur
        switch ($expedition->status) {
            case 'Encour':
                $this->smsService->sendSms(
                    $numeroExpediteur,
                    "Bonjour Mr/Mme {$nomExpediteur}, votre colis N° {$numeroSuivi} est en cours de traitement. Nous vous informerons de la prochaine étape. www.alliancetransit.com"
                );
                break;
            case 'Arrivé':
                $this->smsService->sendSms(
                    $numeroExpediteur,
                    "Bonjour Mr/Mme {$nomExpediteur}, le colis N° {$numeroSuivi} est arrivé à destination et la livraison est prévue pour le {$dateLivr}. www.alliancetransit.com"
                );
                break;
            case 'Depot':
                $this->smsService->sendSms(
                    $numeroExpediteur,
                    "Bonjour Mr/Mme {$nomExpediteur}, le colis N° {$numeroSuivi} a été mis à disposition au dépôt pour le destinataire. www.alliancetransit.com"
                );
                break;
            case 'Livré':
                $this->smsService->sendSms(
                    $numeroExpediteur,
                    "Bonjour Mr/Mme {$nomExpediteur}, le colis N° {$numeroSuivi} a été livré avec succès le {$dateLivr}. www.alliancetransit.com"
                );
                break;
            case 'Non Livré':
                $this->smsService->sendSms(
                    $numeroExpediteur,
                    "Bonjour Mr/Mme {$nomExpediteur}, la livraison du colis N° {$numeroSuivi} a rencontré un problème. Nous vous contacterons. www.alliancetransit.com"
                );
                break;
            case 'Non Traité':
                $this->smsService->sendSms(
                    $numeroExpediteur,
                    "Bonjour Mr/Mme {$nomExpediteur}, votre colis N° {$numeroSuivi} prévu pour le chargement du {$dateEnlev} est en cours de traitement. www.alliancetransit.com"
                );
                break;
            default:
                // Gérer d'autres statuts si nécessaire
                break;
        }
    }


    // EDIT EXPEDITION
    public function editExpedition($id)
    {
        $conteneur = Conteneur::all();
        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();

        $NoteNonTraites = Note::where('status', 'unread')->count();

        $expeditions = expeditions::find($id);
        return view('admin.mission.editExpedition', compact('conteneur', 'NoteNonTraites', 'devisNonTraites', 'expeditions'));
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
        return redirect()->route('admin.dashboard')->with('devisNonTraites', 'success', 'Expédition supprimée avec succès.');
    }
    // UPDATE EXPEDITION

    public function updateExpedition(Request $request, $id)
{
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
        'conteneur_id' => 'nullable',
        'typeService' => 'nullable',
        'dateEnlev' => 'nullable|date',
        'dateLivr' => 'nullable|date',
        'montant_total' => 'nullable|numeric',
        'montant_paye' => 'nullable|numeric',
        'montant_versement' => 'nullable|numeric|min:0', // Rendre nullable si la mise à jour ne concerne pas forcément un versement
        'status' => 'nullable|in:Non Traité,Encour,Depot,Arrivé,Non Livré,Livré',
    ]);

    // Trouver l'expédition à mettre à jour
    $expedition = Expeditions::findOrFail($id);

    // Calcul du nouveau montant payé et du crédit restant si un versement est effectué
    if ($request->filled('montant_versement')) {
        $montantVerse = $request->input('montant_versement', 0);
        $expedition->montant_paye += $montantVerse;
        $expedition->credit_restant = $expedition->montant_total - $expedition->montant_paye;
        $expedition->montant_verse = $request->input('montant_verse', $expedition->montant_verse) + $montantVerse;
    }

    // Stocker l'ancien statut
    $oldStatus = $expedition->status;
    $newStatus = $request->input('status', $oldStatus);

    // Mise à jour de l'expédition avec les nouvelles valeurs
    $expedition->update($validatedData);

    // Envoi des notifications (Email et SMS) si le statut a changé
    if ($oldStatus !== $newStatus) {
        $this->sendNotificationsOnUpdate($expedition, $newStatus);
    }

    return redirect()->route('admin.dashboard')->with('success', 'L\'expédition a été mise à jour avec succès et les notifications ont été envoyées si le statut a changé.');
}

private function sendNotificationsOnUpdate(Expeditions $expedition, string $newStatus)
{
    // Notification par email au destinataire si l'email existe
    if ($expedition->email_destinataire) {
        Notification::route('mail', $expedition->email_destinataire)
            ->notify(new NouvelleExpedition($expedition, 'destinataire'));
    }

    // Notification par email à l'expediteur si l'email existe
    if ($expedition->email_expediteur) {
        Notification::route('mail', $expedition->email_expediteur)
            ->notify(new NouvelleExpedition($expedition, 'expediteur'));
    }

    // Envoi de SMS en fonction du nouveau statut
    $this->sendSmsNotificationsOnUpdate($expedition, $newStatus);
}

private function sendSmsNotificationsOnUpdate(Expeditions $expedition, string $newStatus)
{
    $numeroDestinataire = $expedition->numero_destinataire;
    $nomDestinataire = $expedition->nom_destinataire;
    $numeroExpediteur = $expedition->numero_expediteur;
    $nomExpediteur = $expedition->nom_expediteur;
    $numeroSuivi = $expedition->numeroSuivi;
    $dateLivr = $expedition->dateLivr ? $expedition->dateLivr->format('d/m/Y') : 'non spécifiée';

    // Messages SMS par statut
    $smsMessagesDestinataire = [
        'Encour' => "Bonjour Mme/Mr {$nomDestinataire}, Alliance Transit vous informe que la livraison de votre colis N° {$numeroSuivi} est en cours d'expédition. Nous vous rappelons que toutes personnes injoignables passeront au dépôt récupérer leur colis. Merci de prendre vos dispositions pour la bonne réception du colis. Votre N° de suivi: {$numeroSuivi}",
        'Arrivé' => "Bonjour Mme/Mr {$nomDestinataire}, Alliance Transit vous informe que votre colis N° {$numeroSuivi} vient d'arriver à Abidjan. Merci de nous envoyer votre adresse précise de livraison et d'informer votre correspondant à Abidjan. Toutefois, tous les clients indisponibles lors de la livraison passeront récupérer leur colis au dépôt. Merci pour votre compréhension. Votre N° de suivi: {$numeroSuivi}",
        'Depot' => "Bonjour Mme/Mr {$nomDestinataire}, Alliance Transit vous informe que votre colis N° {$numeroSuivi} est désormais disponible au dépôt. Vous pouvez venir le récupérer muni de votre numéro de suivi. Votre N° de suivi: {$numeroSuivi}",
        'Livré' => "Bonjour Mme/Mr {$nomDestinataire}, Alliance Transit vous informe que la livraison de votre colis N° {$numeroSuivi} a été effectuée avec succès le {$dateLivr}. Merci pour votre confiance. Votre N° de suivi: {$numeroSuivi}",
        'Non Livré' => "Bonjour Mme/Mr {$nomDestinataire}, Alliance Transit vous informe que la livraison de votre colis N° {$numeroSuivi} n'a pas pu être effectuée. Veuillez nous contacter pour plus d'informations. Votre N° de suivi: {$numeroSuivi}",
        'Non Traité' => "Bonjour Mme/Mr {$nomDestinataire}, Alliance Transit vous informe que votre colis N° {$numeroSuivi} est en cours de préparation pour l'expédition. Nous vous informerons de la date de chargement prochainement. Votre N° de suivi: {$numeroSuivi}",
    ];

    $smsMessagesExpediteur = [
        'Encour' => "Bonjour Mr/Mme {$nomExpediteur}, Alliance Transit vous informe que votre colis N° {$numeroSuivi} est en cours de traitement pour la livraison.",
        'Arrivé' => "Bonjour Mr/Mme {$nomExpediteur}, Alliance Transit vous informe que votre colis N° {$numeroSuivi} est arrivé à destination à Abidjan.",
        'Depot' => "Bonjour Mr/Mme {$nomExpediteur}, Alliance Transit vous informe que le colis N° {$numeroSuivi} est disponible au dépôt pour le destinataire.",
        'Livré' => "Bonjour Mr/Mme {$nomExpediteur}, Alliance Transit vous informe que le colis N° {$numeroSuivi} a été livré avec succès le {$dateLivr}.",
        'Non Livré' => "Bonjour Mr/Mme {$nomExpediteur}, Alliance Transit vous informe que la livraison du colis N° {$numeroSuivi} a rencontré un problème.",
        'Non Traité' => "Bonjour Mr/Mme {$nomExpediteur}, Alliance Transit vous informe que votre colis N° {$numeroSuivi} a été enregistré et est en attente de traitement pour l'expédition.",
    ];

    // Envoi de SMS au destinataire si le numéro existe et le statut a un message défini
    if ($numeroDestinataire && isset($smsMessagesDestinataire[$newStatus])) {
        try {
            $this->smsService->sendSms($numeroDestinataire, $smsMessagesDestinataire[$newStatus]);
        } catch (\Exception $e) {
            // Gérer l'erreur d'envoi de SMS au destinataire
            Log::error("Erreur lors de l'envoi du SMS au destinataire pour l'expédition {$expedition->id}: " . $e->getMessage());
        }
    }

    // Envoi de SMS à l'expéditeur si le numéro existe et le statut a un message défini
    if ($numeroExpediteur && isset($smsMessagesExpediteur[$newStatus])) {
        try {
            $this->smsService->sendSms($numeroExpediteur, $smsMessagesExpediteur[$newStatus]);
        } catch (\Exception $e) {
            // Gérer l'erreur d'envoi de SMS à l'expéditeur
            Log::error("Erreur lors de l'envoi du SMS à l'expéditeur pour l'expédition {$expedition->id}: " . $e->getMessage());
        }
    }
}




    public function destroyExpedition(expeditions $expedition)
    {
        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();

        $expedition->delete();

        return redirect()->route('expeditions')->with('success', 'Expédition supprimée avec succès.');
    }
    // END EXPEDITION CRUD

    // CRUD CONTENEUR

    public function allConteneur()
    {
        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();

        $NoteNonTraites = Note::where('status', 'unread')->count();

        $conteneur = Conteneur::all();
        return view('admin.mission.allConteneur', compact('NoteNonTraites', 'devisNonTraites', 'conteneur'));
    }

    public function createConteneur()
    {
        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();

        $NoteNonTraites = Note::where('status', 'unread')->count();

        return view('admin.mission.CreerConteneur', compact('devisNonTraites', 'NoteNonTraites'));
    }


    public function storeConteneur(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255|unique:conteneurs',
            'description' => 'nullable|string',
            'capacite' => 'nullable|integer|min:0',
            'emplacement' => 'nullable|string|max:255',
        ]);

        $conteneur = Conteneur::create($validatedData);

        return back()->with('success', 'Conteneur ajouté avec succès.');
    }



    public function editeConteneur($id)
    {
        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();

        $NoteNonTraites = Note::where('status', 'unread')->count();

        $conteneur = Conteneur::find($id);
        return view('admin.mission.editConteneur', compact('NoteNonTraites', 'devisNonTraites', 'conteneur'));
    }
    // Delete
    public function deleteConteneur($id)
    {
        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();

        $NoteNonTraites = Note::where('status', 'unread')->count();

        // 1. Trouver l'expédition à supprimer
        $conteneur = Conteneur::find($id);

        // 2. Vérifier si l'expédition existe
        if (!$conteneur) {
            // Gérer le cas où l'expédition n'existe pas (par exemple, afficher un message d'erreur)
            return back()->with('error', 'Expédition non trouvée.');
        }

        // 3. Supprimer l'expédition
        $conteneur->delete();

        // 4. Rediriger avec un message de succès
        return back()->with('success', 'Expédition supprimée avec succès.');
    }


    public function updateConteneur(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255|unique:conteneurs,nom,' . $id,
            'description' => 'nullable|string',
            'capacite' => 'nullable|integer|min:0',
            'emplacement' => 'nullable|string|max:255',
        ]);
        // Trouver l'expédition à mettre à jour
        $conteneur = Conteneur::findOrFail($id);
        $conteneur->update($validatedData);


        return back()->with('success', 'Conteneur mis à jour avec succès.');
    }

    // End------------

    // Valider Rdv
    public function valideRdv(Request $request, rendevous $rdv)
    {
        $rdv->status = 'traite';
        $rdv->save();

        return back();
    }

    // End------------------------

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





    // PROFIL ADMIN
    public function indexAdmin()
    {

        $NoteNonTraites = Note::where('status', 'unread')->count();

        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();


        $expeditions = expeditions::latest()->paginate(5);
        $All = expeditions::count();

        // Votre logique pour afficher le profil de l'administrateur
        $admin = Auth::guard('admin')->user(); // Si vous utilisez un guard admin
        if (!$admin) {
            // Gérer le cas où l'administrateur n'est pas connecté
            return redirect()->route('admin.login'); // Exemple de redirection
        }
        return view('admin.profile.index', compact('admin', 'devisNonTraites', 'NoteNonTraites'));
    }

    public function updateAdmin(Request $request)
    {
        $NoteNonTraites = Note::where('status', 'unread')->count();
        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();


        $expeditions = expeditions::latest()->paginate(5);
        $All = expeditions::count();

        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();
        if (!$admin) {
            return redirect()->route('admin.login');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id, // Règle unique en ignorant l'email actuel
            'numero' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed', // 'nullable' permet de ne pas changer le mot de passe
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->numero = $request->numero;
        $admin->adresse = $request->adresse;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        try {
            $admin->save();
            return redirect()->route('admin.profile.index')->with('success', 'Votre profil a été mis à jour avec succès.');
        } catch (\Exception $e) {
            dd($e->getMessage()); // Afficher le message d'erreur
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la mise à jour du profil.');
        }
    }


    // All ADMIN
    public function indexAdminList()
    {
        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();



        $NoteNonTraites = Note::where('status', 'unread')->count();
        $expeditions = expeditions::latest()->paginate(5);
        $All = expeditions::count();

        $admin = Admin::all();
        return view('admin.profile.allAdmin', compact('admin', 'devisNonTraites', 'NoteNonTraites'));
    }
    public function editAdminUser($id)
    {
        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();


        $NoteNonTraites = Note::where('status', 'unread')->count();
        $expeditions = expeditions::latest()->paginate(5);
        $All = expeditions::count();

        $admin = Admin::findOrFail($id); // Récupère l'administrateur par son ID ou affiche une erreur 404
        return view('admin.admins.edit', compact('admin'));
    }
    public function updateAdminRole(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'role' => 'required|in:superadmin,admin,agent', // Validez que le rôle sélectionné est valide
        ]);

        $admin->role = $request->role;
        $admin->save();

        return redirect()->route('admin.dashboard')->with('success', 'Le rôle de l\'administrateur a été mis à jour avec succès.');
    }

    // All ABONNES
    public function AbonneList()
    {
        $lastActivityThreshold = Carbon::now()->subMinutes(config('session.lifetime'));

        $activeSessions = DB::table('sessions')
            ->where('last_activity', '>=', $lastActivityThreshold)
            ->whereNotNull('user_id')
            ->pluck('user_id')
            ->toArray();

        $onlineUserIds = array_unique($activeSessions); // Tableau des IDs des utilisateurs en ligne

        $NoteNonTraites = Note::where('status', 'unread')->count();
        $devisNonTraites = DevisColis::where('status', 'nontraite')->count();
        $Allclients = User::latest()->paginate(5); // Récupérer les utilisateurs (clients) paginés
        $All = Expeditions::count(); // Correction de la casse du modèle

        return view('admin.clients.allUsers', compact('Allclients', 'devisNonTraites', 'NoteNonTraites', 'onlineUserIds'));
    }
}
