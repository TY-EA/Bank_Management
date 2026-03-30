<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Affiche le formulaire de connexion
    public function showLogin()
    {
        // Vérifier si l'utilisateur est déjà connecté
        if (Auth::check() && session('connected') === true) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    // Vérifier l'email et le mot de passe et connecter l'utilisateur
    public function login(Request $request)
    {
        // 1. Validation de la saisie
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Tenter l'authentification
        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Email ou mot de passe incorrect.',
            ])->onlyInput('email');
        }

        // 3. Authentification réussie - créer la session
        $user = Auth::user();
        
        $request->session()->regenerate();
        
        // Créer les données de session personnalisées
        session([
            'connected' => true,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
        ]);

        // Rediriger vers le tableau de bord
        return redirect()->route('dashboard')->with('success', 'Connexion réussie !');
    }

    // Déconnecter l'utilisateur
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Effacer les données de session personnalisées
        session()->forget(['connected', 'user_id', 'user_name', 'user_email']);

        return redirect('/login')->with('success', 'Vous êtes déconnecté.');
    }
}