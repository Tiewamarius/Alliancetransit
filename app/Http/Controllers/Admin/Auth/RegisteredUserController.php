<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $nombre_aleatoire = (string)(random_int(10000, 99999));
        $code_unique = 'Al-'. $nombre_aleatoire;
        return view('admin.auth.register',compact('code_unique'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'code_unique' => ['string', 'max:255'], // Ajout de la validation pour code_unique
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Admin::class],
            'numero' => ['required', 'string', 'max:255'], // Ajout de la validation pour numero
            'adresse' => ['required', 'string', 'max:255'], // Ajout de la validation pour adresse
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

        $admin = Admin::create([
            'code_unique' => $request->code_unique, // Ajout de code_unique
            'name' => $request->name,
            'email' => $request->email,
            'numero' => $request->numero, // Ajout de numero
            'adresse' => $request->adresse, // Ajout de adresse
            'password' => Hash::make($request->password),
            ]);

        event(new Registered($admin));

        Auth::guard('admin')->login($admin);

        return redirect(route('admin.dashboard', absolute: false));
    }
}
