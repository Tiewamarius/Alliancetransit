<?php

namespace App\Http\Controllers;

use Twilio\Rest\Client;
// use Illuminate\Support\Facades\Notification;
use Exception;
use App\Http\Requests\ProfileUpdateRequest;
use App\Mail\postMail;
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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function search(Request $request)
    {
        $request->validate([
            'tracking_code' => 'required|string',
        ]);

        $trackingCode = $request->input('tracking_code');

        $expeditions = expeditions::where('numeroSuivi', $trackingCode)->get();

        if ($expeditions->isEmpty()) {
            // return view('Clients.ResultPageSearch', ['message' => 'Aucun résultat trouvé.']);
        
            return view('Clients.SuiviPage', ['message' => 'Aucun résultat trouvé.']);
        }

        return view('Clients.ResultPageSearch', ['expeditions' => $expeditions]);
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
    public function destroy(Request $request): RedirectResponse
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
        $user = Auth::user();


        $Rdv = rendevous::all();

        $expedNonTr = expeditions::where('expediteur_id', $user->code_unique)
        ->where('status','Non traité')
        ->get();

        $expedEncour = expeditions::where('expediteur_id', $user->code_unique)
        ->where('status','Encour')
        ->get();

        $expedDepot_Arriv = expeditions::where('expediteur_id', $user->code_unique)
        ->where('status','Depot')
        ->orWhere('status','Arrivé')
        ->get();

        $expedLivre = expeditions::where('expediteur_id', $user->code_unique)
        ->where('status','Livré')
        ->get();

        $nombre_aleatoire = (string)(random_int(10000, 99999));

        $devis_colis = devisColis::latest()->get();
        $code_suivi = 'SU-' . $nombre_aleatoire;


        $today = Carbon::today();
        $dailyCount = DailyRendezVousCount::firstOrCreate(['date' => $today]);
        $remaining = 30 - $dailyCount->count;
        return view('Clients.Compte', compact('expedNonTr','expedEncour', 'expedDepot_Arriv','expedLivre', 'code_suivi', 'devis_colis', 'Rdv', 'remaining', 'dailyCount'));
    }

    public function SuiviPage()
    {
        return view('Clients.SuiviPage');
    }


    public function Envois()
    {
        $nombre_aleatoire = (string)(random_int(10000, 99999));

        $devis_colis = devisColis::latest()->get();
        $code_suivi = 'SU-' . $nombre_aleatoire;


        $today = Carbon::today();
        $dailyCount = DailyRendezVousCount::firstOrCreate(['date' => $today]);
        $remaining = 30 - $dailyCount->count;
        return view('Clients.Envois', compact('code_suivi', 'devis_colis', 'remaining', 'dailyCount'));
    }



    public function DemandDevis(Request $request)
    {

        // Validation commune à tous les formulaires
        $validatedData = $request->validate([
            'particulier' => 'required',
            'paysDepart' => 'required',
            'paysArrivee' => 'required|different:paysDepart',
            'villeDepart' => 'required',
            'villeArrivee' => 'required',
            'designation' => 'required',
            'montant_total' => 'required',
            'status' => 'nontraite',
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



        return redirect()->back()->with('success', 'Votre demande a été soumise avec succès.');
    }


    private function traiterFormulaireParticulier(Request $request)
    {
        // Logique spécifique pour le formulaire Particulier
        $devis = new DevisColis();
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

    private function traiterFormulaireEntreprise(Request $request)
    {
        // Logique spécifique pour le formulaire Entreprise
        $devis = new DevisColis();
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
            'status' => 'required|in:Non Traité,Encour,Arrivé,Non Livré,Livré',
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

        // Message de succès avec Toastr
        // Alert::success('Les données ont été enregistrées avec succès !', 'Succès');

        // Redirection avec message de succès
        return  redirect()->back()->with('success', 'Expédition enregistrée avec succès.');
    }

    // fonction Rendevous

    public function storeRdv(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'telephone' => 'required',
            'numero_suivi' => 'required',
            'date_retrait' => 'required|date',
            'heure_retrait' => 'required',
            'designation' => 'required',
        ]);

        // Vérifier si le code de suivi existe
        $expedition = expeditions::where('numeroSuivi', $request->numero_suivi)->first();

        if (!$expedition) {
            return redirect()->back()->with('error', 'Le code de suivi saisi est invalide.');
        }

        
        $dateRendezVous = Carbon::parse($request->date_retrait)->toDateString();
        $dailyCount = DailyRendezVousCount::whereDate('date', $dateRendezVous)->count();

        if ($dailyCount >= 30) {
            return redirect()->back()->with('error', 'Le nombre maximal de rendez-vous pour aujourd\'hui a été atteint.');
        }

        $rendezVous = new rendevous();
        $rendezVous->nom = $request->nom;
        $rendezVous->telephone = $request->telephone;
        $rendezVous->numero_suivi = $request->numero_suivi;
        $rendezVous->date_retrait = $request->date_retrait;
        $rendezVous->heure_retrait = $request->heure_retrait;
        $rendezVous->designation = $request->designation;
        $rendezVous->save();

        // Logique pour mettre à jour DailyRendezVousCount (si nécessaire)
        $dailyRendezVousCount = DailyRendezVousCount::firstOrCreate(['date' => $dateRendezVous]);
        $dailyRendezVousCount->count++;
        $dailyCount = $dailyRendezVousCount->count++; // Incrémente le compteur
        $dailyRendezVousCount->save();

        // if ($request->fails()) {
        //     return response()->json(['success' => false, 'errors' => $request->errors()]);
        // }
        // return response()->json(['success' => true]);
        return redirect()->back()->with('success', 'Rendez-vous pris avec succès.');
    }

    public function showForm()
    {
        $today = Carbon::today();
        $dailyCount = DailyRendezVousCount::firstOrCreate(['date' => $today]);
        $remaining = 30 - $dailyCount->count;

        return view('votre_vue', ['remaining' => $remaining, 'dailyCount' => $dailyCount]);
    }
};
