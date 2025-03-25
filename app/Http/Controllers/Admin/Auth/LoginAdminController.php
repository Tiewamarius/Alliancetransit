<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\View\View;

class LoginAdminController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $nombre_aleatoire = (string)(random_int(10000, 99999));
        $code_unique = 'Al-'. $nombre_aleatoire;
        return view('admin.auth.adminLogin',compact('code_unique'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(AdminLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard', absolute: false));
    }


    // reGISTER

    public function storee(Request $request): RedirectResponse
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

    // eND REGISTER
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // return redirect('/admin.logout');
        return redirect('/');
    }
}
