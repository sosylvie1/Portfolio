<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Affiche la vue d'inscription.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Traite la soumission du formulaire d'inscription.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            // ⚠️ Utilise des noms de champs DISTINCTS dans la vue:
            // company_name pour la société, name pour le nom de la personne.
            'company_name' => ['nullable', 'string', 'max:255'],
            'name'         => ['required', 'string', 'max:255'],
            'email'        => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique('users', 'email'),
            ],
            'phone'        => [
                'nullable',
                'string',
                'max:20',
                'regex:/^\+?[0-9\s\-\(\).]{6,20}$/',
            ],
            'password'     => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Optionnel : normaliser quelques champs
        $validated['name']  = trim($validated['name']);
        if (!empty($validated['company_name'])) {
            $validated['company_name'] = trim($validated['company_name']);
        }
        if (!empty($validated['phone'])) {
            $validated['phone'] = trim($validated['phone']);
        }

        $user = User::create([
            'company_name' => $validated['company_name'] ?? null,
            'name'         => $validated['name'],
            'email'        => $validated['email'],
            'phone'        => $validated['phone'] ?? null,
            'password'     => Hash::make($validated['password']),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirige vers l'accueil défini (ex: '/accueil')
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
