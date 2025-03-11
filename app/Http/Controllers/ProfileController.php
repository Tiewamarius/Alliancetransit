<?php

namespace App\Http\Controllers;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\DevisColis;
use App\Models\DailyRendezVousCount;
use App\Models\rendevous;
use Carbon\Carbon;
use App\Models\expeditions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
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


    public function SuiviPage(){
        return view('Clients.SuiviPage');
    }


    public function Envois(){
        $nombre_aleatoire = (string)(random_int(10000, 99999));

        $devis_colis = devisColis::latest()->get();
        $code_suivi = 'SU-'. $nombre_aleatoire;

        
        $today = Carbon::today();
        $dailyCount = DailyRendezVousCount::firstOrCreate(['date' => $today]);
        $remaining = 30 - $dailyCount->count;
        return view('Clients.Envois',compact('code_suivi','devis_colis','remaining','dailyCount'));
    }



    public function DemandDevis(Request $request)
        {
                // $sid = getenv("TWILIO_SID");
                // $token = getenv("TWILIO_TOKEN");
                // $numEnvoi = getenv("TWILIO_PHONE");
                // $twilio = new Client($sid, $token);

                // $message = $twilio->messages->create(
                //     "+22501649504", // To
                //     [
                //         "body" =>
                //             "Bonjour Merci de me donnez suite a ma demande de Devis
                //             combien je paierai pour cette Expedition
                //             Merci...",
                //         "from" => $numEnvoi,
                //     ]
                // );


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

            // Envoyer la notification à l'administrateur (ou à l'utilisateur)
                // Notification::route('mail', 'votre_email@example.com')->notify(new DevisSubmitted($devis));

                // dd('sucess');
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

        // $admin = expeditions::where('email', 'yobouetiewamaruis@gmail.com')->first();

        // if ($admin) {
        //     $admin->notify(new AdminCrudController($expedition));
        // }
        // Toastr::success('Les données ont été enregistrées avec succès !', 'Succès');

        
            return redirect()->back()->with('success', 'Expédition supprimée avec succès.');

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

                $today = Carbon::today();
                $dailyCount = DailyRendezVousCount::firstOrCreate(['date' => $today]);

                if ($dailyCount->count >= 30) {
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

                $dailyCount->count++;
                $dailyCount->save();

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
