<?php

namespace App\Http\Controllers;

use Twilio\Rest\Client;
// use Illuminate\Support\Facades\Notification;
use Exception;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NouvelleExpedition;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\DevisColis;
use Illuminate\Support\Facades\Storage;
use App\Models\DailyRendezVousCount;
use App\Models\rendevous;
use Carbon\Carbon;
use App\Models\expeditions;
use Illuminate\Support\Facades\Auth;
use App\Mail\ContactFormMail; // Importez le Mail class que nous allons créer
use App\Models\Note;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function welcome(Request $request)
    {
        $DevisTraites = DevisColis::latest()->where('status', 'traite')->count();
        $EnlevTraites = rendevous::latest()->where('status', 'traite')->count();

        return view('welcome', compact('EnlevTraites', 'DevisTraites'));
    }


    public function dashboard(Request $request)
    {
        $DevisTraites = DevisColis::latest()->where('status', 'traite')->count();
        $EnlevTraites = rendevous::latest()->where('status', 'traite')->count();

        return view('dashboard', compact('EnlevTraites', 'DevisTraites'));
    }

    public function sendContactForm(Request $request)
    {
        // Validation des données du formulaire (fortement recommandé)
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'email' => 'nullable|email|max:255',
            'subject' => 'nullable|string',
            'message' => 'required|string',
            // Ajoutez ici les règles de validation pour les autres champs
        ]);

        // Méthode 1 : Utilisation du modèle pour enregistrer les données
        Note::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
            'status' => 'unread',
            // Ajoutez ici les autres champs et leurs valeurs depuis la requête
        ]);


        // Redirection ou réponse après l'enregistrement
        return redirect()->back()->with('success', 'Votre message a été envoyé avec succès !');
        // Ou return response()->json(['message' => 'Données enregistrées avec succès'], 201); pour une API
    }

    public function search(Request $request)
    {

        $DevisTraites = DevisColis::latest()->where('status', 'traite')->count();
        $EnlevTraites = rendevous::latest()->where('status', 'traite')->count();

        $request->validate([
            'tracking_code' => 'required|string',
        ]);

        $trackingCode = $request->input('tracking_code');

        $expeditions = expeditions::where('numeroSuivi', $trackingCode)->get();

        if ($expeditions->isEmpty()) {
            // return view('Clients.ResultPageSearch', ['message' => 'Aucun résultat trouvé.']);

            return view('Clients.SuiviPage', ['message' => 'Aucun résultat trouvé.'], compact('DevisTraites', 'EnlevTraites'));
        }

        return view('Clients.ResultPageSearch', ['expeditions' => $expeditions], compact('DevisTraites', 'EnlevTraites'));
    }


    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $DevisTraites = DevisColis::latest()->where('status', 'traité')->get();
        $EnlevTraites = rendevous::latest()->where('status', 'traité')->get();

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroyUser(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    // Fonction compte
    public function compte()
    {
        $DevisTraites = DevisColis::latest()->where('status', 'traite')->count();
        $EnlevTraites = rendevous::latest()->where('status', 'traite')->count();
        $user = Auth::user();

        $aujourdhui = Carbon::today();

        $AllRdv = Rendevous::all();

        $Rdv = Rendevous::whereDate('date_retrait', '>=', $aujourdhui)
            ->where('rdv_id', $user->code_unique)
            ->get();


        $expedNonTr = expeditions::where('expediteur_id', $user->code_unique)
            ->where('status', 'Non traité')
            ->get();

        $expedEncour = expeditions::where('expediteur_id', $user->code_unique)
            ->where('status', 'Encour')
            ->get();

        $expedDepot_Arriv = expeditions::where('expediteur_id', $user->code_unique)
            ->where('status', 'Arrivé')
            ->orWhere('status', 'Depot')
            ->get();

        $expedLivre = expeditions::where('expediteur_id', $user->code_unique)
            ->where('status', 'Livré')
            ->get();

        $nombre_aleatoire = (string)(random_int(10000, 99999));

        $devis_colis = devisColis::latest()->get();
        $code_suivi = 'SU-' . $nombre_aleatoire;


        $today = Carbon::today();
        $dailyCount = DailyRendezVousCount::firstOrCreate(['date' => $today]);
        $remaining = 30 - $dailyCount->count;
        return view('Clients.Compte', compact('EnlevTraites', 'DevisTraites', 'expedNonTr', 'expedEncour', 'expedDepot_Arriv', 'expedLivre', 'code_suivi', 'devis_colis', 'AllRdv', 'Rdv', 'remaining', 'dailyCount'));
    }

    public function SuiviPage()
    {

        $DevisTraites = DevisColis::latest()->where('status', 'traite')->count();
        $EnlevTraites = rendevous::latest()->where('status', 'traite')->count();

        return view('Clients.SuiviPage', compact('DevisTraites', 'EnlevTraites'));
    }


    public function Envois()
    {

        $DevisTraites = DevisColis::latest()->where('status', 'traite')->count();
        $EnlevTraites = rendevous::latest()->where('status', 'traite')->count();


        $nombre_aleatoire = (string)(random_int(10000, 99999));

        $devis_colis = devisColis::latest()->get();
        $code_suivi = 'SU-' . $nombre_aleatoire;


        $today = Carbon::today();
        $dailyCount = DailyRendezVousCount::firstOrCreate(['date' => $today]);
        $remaining = 30 - $dailyCount->count;
        return view('Clients.Envois', compact('EnlevTraites', 'DevisTraites', 'code_suivi', 'devis_colis', 'remaining', 'dailyCount'));
    }



    public function DemandDevis(Request $request)
    {
        $DevisTraites = DevisColis::latest()->where('status', 'traite')->count();
        $EnlevTraites = rendevous::latest()->where('status', 'traite')->count();


        // Validation commune à tous les formulaires
        $validatedData = $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'numero' => 'required',
            'particulier' => 'required',
            'paysDepart' => 'required',
            'paysArrivee' => 'required|different:paysDepart',
            'villeDepart' => 'required',
            'villeArrivee' => 'required',
            'designation' => 'required',
            'montant_total' => 'required',
            'status' => 'required|in:nontraite,traité',
        ]);

        // La validation a réussi, les données sont dans $validatedData
        // Identifier le formulaire
        if ($request->particulier === 'particulier') {
            // Traitement du formulaire Particulier
            $this->traiterFormulaireParticulier($request);
        } elseif ($request->particulier === 'entreprise') {
            // Traitement du formulaire Entreprise
            $this->traiterFormulaireEntreprise($request);
        }


        return back();
        // return Redirect::route('/compte',compact('DevisTraites','EnlevTraites')); 
    }


    private function traiterFormulaireParticulier(Request $request)
    {
        // Logique spécifique pour le formulaire Particulier
        $devis = new DevisColis();
        $devis->user_id = $request->user_id;
        $devis->name = $request->name;
        $devis->numero = $request->numero;
        $devis->particulier = $request->particulier;
        $devis->paysDepart = $request->paysDepart;
        $devis->villeDepart = $request->villeDepart;
        $devis->paysArrivee = $request->paysArrivee;
        $devis->villeArrivee = $request->villeArrivee;
        $devis->designation = $request->designation;
        $devis->status = 'nontraite'; // Définit le statut initial
        // ... autres champs spécifiques au particulier ...
        $devis->save();

        // Autres actions spécifiques au particulier (envoi d'email, notifications, etc.)
    }

    // delete facture
    public function deleteFacture($id)
    {
        // Logique pour trouver et supprimer le devis avec l'ID $id
        $devis = DevisColis::findOrFail($id);
        $devis->delete();

        // Redirection avec un message de succès (facultatif)
        return redirect()->back()->with('success', 'L\'expédition a été supprimée avec succès.');
    }

    // delete Rdv
    public function deleteRdv($id)
    {
        $DevisTraites = DevisColis::where('status', 'nontraite')->count();
        // Récupérer le devis en utilisant l'ID
        $rdv = rendevous::findOrFail($id);
        // Supprimer le devis
        $rdv->delete();
        return redirect()->back()->with('success', 'L\'expédition a été supprimée avec succès.');
    }


    private function traiterFormulaireEntreprise(Request $request)
    {
        // Logique spécifique pour le formulaire Entreprise
        $devis = new DevisColis();
        $devis->user_id = $request->user_id;
        $devis->name = $request->name;
        $devis->numero = $request->numero;
        $devis->particulier = $request->particulier;
        $devis->paysDepart = $request->paysDepart;
        $devis->villeDepart = $request->villeDepart;
        $devis->paysArrivee = $request->paysArrivee;
        $devis->villeArrivee = $request->villeArrivee;
        $devis->designation = $request->designation;
        $devis->status = 'nontraite';
        // ... autres champs spécifiques à l'entreprise ...
        $devis->save();

        // Autres actions spécifiques à l'entreprise (envoi d'email, notifications, etc.)
    }


    public function EnvoisColis(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'particulier' => 'nullable',
            'expediteur_id' => 'nullable',
            'nom_expediteur' => 'required',
            'numero_expediteur' => 'required',
            'email_expediteur' => 'nullable|email',
            'adresse_expediteur' => 'nullable',
            'code_postal_exp' => 'nullable',
            'destinataire_id' => 'nullable|exists:destinataires,id',
            'nom_destinataire' => 'required',
            'numero_destinataire' => 'required',
            'email_destinataire' => 'nullable|email',
            'adresse_destinataire' => 'nullable',
            'code_postal_dest' => 'nullable',
            'commune' => 'nullable',
            'numeroSuivi' => 'required',
            'designation' => 'required',
            'numeroConteneur' => 'nullable',
            'typeService' => 'nullable',
            'dateEnlev' => 'nullable|date',
            'dateLivr' => 'nullable|date',
            'montant_total' => 'required|numeric',
            'montant_paye' => 'required|numeric',
            'mode_paiement' => 'required|in:chèque,espece',
            'status' => 'required|in:Non Traité,Encour,Arrivé,Non Livré,Livré',
            'image_colis' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image_colis')) {
            $imagePath = $request->file('image_colis')->store('expeditions', 'public');
            $validatedData['image_colis'] = $imagePath;
        } else {
            $validatedData['image_colis'] = null; // Assurez-vous qu'une valeur nulle est enregistrée si aucune image n'est fournie
        }

        // Création de l'expédition
        $expedition = expeditions::create($validatedData);

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

        // Message de succès avec Toastr
        // Alert::success('Les données ont été enregistrées avec succès !', 'Succès');

        // Redirection avec message de succès
        return Redirect('compte')->with('success', 'Devis mis à jour avec succès.');
    }

    // fonction Rendevous

    public function storeRdv(Request $request)
    {
        $request->validate([

            'rdv_id' => 'required',
            'type' => 'required',
            'nom' => 'required',
            'telephone' => 'required',
            'code_postal' => 'nullable',
            'date_retrait' => 'required|date|after_or_equal:today',
            'heure_retrait' => 'required',
            'designation' => 'required',
            'status' => 'required|in:non traité,traité',

        ]);


        $dateRendezVous = Carbon::parse($request->date_retrait)->toDateString();
        $dailyCount = DailyRendezVousCount::whereDate('date', $dateRendezVous)->count();

        if ($dailyCount >= 30) {
            return redirect()->back()->with('error', 'Le nombre maximal de rendez-vous pour aujourd\'hui a été atteint.');
        }

        $rendezVous = new rendevous();
        $rendezVous->rdv_id = $request->rdv_id;
        $rendezVous->type = $request->type;
        $rendezVous->nom = $request->nom;
        $rendezVous->telephone = $request->telephone;
        $rendezVous->code_postal = $request->code_postal;
        $rendezVous->date_retrait = $request->date_retrait;
        $rendezVous->heure_retrait = $request->heure_retrait;
        $rendezVous->designation = $request->designation;
        $rendezVous->status = $request->status;
        $rendezVous->save();

        // Logique pour mettre à jour DailyRendezVousCount (si nécessaire)
        $dailyRendezVousCount = DailyRendezVousCount::firstOrCreate(['date' => $dateRendezVous]);
        $dailyRendezVousCount->count++; // Incrémente le compteur une seule fois
        $dailyRendezVousCount->save();

        $dailyCount = $dailyRendezVousCount->count; // Récupère la valeur du compteur APRÈS l'incrémentation

        if ($dailyCount >= 30) {
            return redirect()->back()->with('error', 'Le nombre maximal de rendez-vous pour aujourd\'hui a été atteint.');
        }

        $rendezVous = new Rendevous();
        $rendezVous->rdv_id = $request->rdv_id;
        $rendezVous->type = $request->type;
        $rendezVous->nom = $request->nom;
        $rendezVous->telephone = $request->telephone;
        $rendezVous->code_postal = $request->code_postal;
        $rendezVous->date_retrait = $request->date_retrait;
        $rendezVous->heure_retrait = $request->heure_retrait;
        $rendezVous->designation = $request->designation;
        $rendezVous->save();

        return redirect()->back()->with('success', 'Rendez-vous pris avec succès.');
    }

    public function showForm()
    {
        $today = Carbon::today();
        $dailyCount = DailyRendezVousCount::firstOrCreate(['date' => $today]);
        $remaining = 30 - $dailyCount->count;

        return view('Clients.Compte', ['remaining' => $remaining, 'dailyCount' => $dailyCount]);
    }


    // ExpeditByFactur
    public function editExpByFac($id)
    {
        $DevisTraites = DevisColis::latest()->where('status', 'traite')->count();
        $EnlevTraites = rendevous::latest()->where('status', 'traite')->count();

        $nombre_aleatoire = (string)(random_int(10000, 99999));

        $devis_colis = devisColis::latest()->get();
        $code_suivi = 'SU-' . $nombre_aleatoire;

        $DevisTraites = DevisColis::where('status', 'non traite')->count();
        // Récupérer le devis en utilisant l'ID
        $devis = DevisColis::findOrFail($id);

        // Passer le devis à la vue
        return view('Clients.envoiByFactur', compact('DevisTraites', 'EnlevTraites', 'code_suivi', 'devis', 'DevisTraites'));
    }

    // public function updateExpByFac(Request $request, $id)
    // {
    //     // Validation des données
    //     $validatedData = $request->validate([
    //         'particulier' => 'nullable|boolean',
    //         'expediteur_id' => 'nullable', // exists:expediteurs,id
    //         'nom_expediteur' => 'required|string|max:255',
    //         'numero_expediteur' => 'required|string|max:20',
    //         'email_expediteur' => 'nullable|email|max:255',
    //         'adresse_expediteur' => 'nullable|string|max:255',
    //         'destinataire_id' => 'nullable|exists:destinataires,id',
    //         'nom_destinataire' => 'required|string|max:255',
    //         'numero_destinataire' => 'required|string|max:20',
    //         'email_destinataire' => 'nullable|email|max:255',
    //         'adresse_destinataire' => 'nullable|string|max:255',
    //         'numeroSuivi' => 'required|string|unique:expeditions|max:255',
    //         'designation' => 'required|string|max:255',
    //         'numeroConteneur' => 'nullable|string|max:255',
    //         'typeService' => 'nullable|string|max:255',
    //         'dateEnlev' => 'nullable|date',
    //         'dateLivr' => 'nullable|date',
    //         'montant_total' => 'required|numeric|min:0',
    //         'montant_paye' => 'required|numeric|min:0',
    //         'status' => 'required|in:Encour,Depot,Arrivé,Non Livré,Livré',
    //         'image_colis' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     $devis = DevisColis::findOrFail($id);
    //     $devis->status = 'encour';
    //     $devis->save();
    //     // 4. Redirection avec un message de succès
    //     return Redirect::route('/compte'); 
    // }

    // print facture
    public function viewExpensesByFacture($id)
    {

        $nombre_aleatoire = (string)(random_int(10000, 99999));

        $devis_colis = devisColis::latest()->get();
        $code_suivi = 'SU-' . $nombre_aleatoire;

        $DevisTraites = DevisColis::where('status', 'non traite')->count();
        // Récupérer le devis en utilisant l'ID
        $devis = DevisColis::findOrFail($id);
        $devis->status = 'encour';
        $devis->save();

        // Passer le devis à la vue
        return view('Clients.facture', compact('code_suivi', 'devis', 'DevisTraites'));
    }
    // end----------------------------


    public function deleteDevis($id)
    {

        $DevisTraites = DevisColis::where('status', 'nontraite')->count();
        // Récupérer le devis en utilisant l'ID
        $devis = DevisColis::findOrFail($id);
        // Supprimer le devis
        $devis->delete();
        return Redirect::route('/compte#factures');
        // view('Clients.compte', compact('devis','DevisTraites'));


    }
    // End ExpeditByFactur


    public function changerStatutEnEncour(Request $request, rendevous $rdv)
    {
        $rdv->status = 'encour';
        $rdv->save();

        return back();
    }
};
