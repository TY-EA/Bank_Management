<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use App\Models\Client;
use Illuminate\Http\Request;

class CompteController extends Controller
{
    /**
     * Display all comptes
     */
    public function index()
    {
        $comptes = Compte::with('client')->orderBy('created_at', 'desc')->get();
        return view('comptes.index', compact('comptes'));
    }

    /**
     * Show compte creation form
     */
    public function create()
    {
        $clients = Client::all();
        return view('comptes.create', compact('clients'));
    }

    /**
     * Store a new compte
     */
    public function store(Request $request)
    {
        $request->validate([
            'rib' => 'required|string|unique:comptes,rib',
            'solde' => 'required|numeric|min:0',
            'client_id' => 'required|exists:clients,id',
        ]);

        Compte::create($request->only(['rib', 'solde', 'client_id']));

        return redirect()->route('comptes.index')->with('success', 'Compte créé avec succès !');
    }

    /**
     * Show compte details
     */
    public function show(Compte $compte)
    {
        // Eager load client and related virements for efficient rendering in the view
        $compte->load(['client', 'virementsEnvoyes', 'virementsRecus']);
        return view('comptes.show', compact('compte'));
    }

    /**
     * Show compte edit form
     */
    public function edit(Compte $compte)
    {
        $clients = Client::all();
        return view('comptes.edit', compact('compte', 'clients'));
    }

    /**
     * Update compte
     */
    public function update(Request $request, Compte $compte)
    {
        // The 'numero_compte' field is not present in the database/migrations, so we don't validate it here.
        $request->validate([
            'rib' => 'required|string|unique:comptes,rib,' . $compte->id,
            'solde' => 'required|numeric|min:0',
            'client_id' => 'required|exists:clients,id',
        ]);

        $compte->update($request->only(['rib', 'solde', 'client_id']));

        return redirect()->route('comptes.index')->with('success', 'Compte mis à jour avec succès !');
    }

    /**
     * Delete compte
     */
    public function destroy(Compte $compte)
    {
        $compte->delete();
        return redirect()->route('comptes.index')->with('success', 'Compte supprimé avec succès !');
    }
}
