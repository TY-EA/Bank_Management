<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use App\Models\Virement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VirementController extends Controller
{
    /**
     * Display all virements
     */
    public function index()
    {
        $virements = Virement::with(['compteSource', 'compteDestination'])
            ->orderBy('date_virement', 'desc')
            ->get();

        return view('virements.index', compact('virements'));
    }

    /**
     * Show virement creation form
     */
    public function create()
    {
        $comptes = Compte::with('client')->get();
        return view('virements.create', compact('comptes'));
    }

    /**
     * Store a new virement
     */
    public function store(Request $request)
    {
        // 1. Validation des données
        $request->validate([
            'rib_source' => 'required|string|exists:comptes,rib',
            'rib_target' => 'required|string|exists:comptes,rib|different:rib_source',
            'montant' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
        ]);

        $montant = $request->montant;
        $ribSource = $request->rib_source;
        $ribTarget = $request->rib_target;

        // 2. Récupération du compte source par RIB
        $compteSource = Compte::where('rib', $ribSource)->firstOrFail();

        // 3. Vérification du solde émetteur
        if ($compteSource->solde < $montant) {
            return back()->withInput()->withErrors([
                'montant' => 'Solde insuffisant. Le compte source n\'a que ' . 
                    number_format($compteSource->solde, 2, ',', ' ') . ' DA.'
            ]);
        }

        // 4. Exécution de la transaction
        try {
            DB::beginTransaction();

            // Récupérer le compte destination
            $compteDestination = Compte::where('rib', $ribTarget)->firstOrFail();

            // Débiter le compte source
            $compteSource->decrement('solde', $montant);

            // Créditer le compte destination
            $compteDestination->increment('solde', $montant);

            // Enregistrer le virement avec date auto-définie
            Virement::create([
                'rib_source' => $ribSource,
                'rib_target' => $ribTarget,
                'montant' => $montant,
                'date_virement' => now(), // Auto-set to current date/time
                'description' => $request->description ?? null,
                'statut' => 'completed',
            ]);

            DB::commit();

            return redirect()->route('virements.index')
                ->with('success', 'Virement effectué avec succès !');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Échec du virement: " . $e->getMessage());

            return back()->withInput()->withErrors([
                'general' => 'Une erreur inattendue est survenue. Veuillez réessayer.'
            ]);
        }
    }

    /**
     * Show virement details
     */
    public function show(Virement $virement)
    {
        $virement->load(['compteSource', 'compteDestination']);
        return view('virements.show', compact('virement'));
    }
}
