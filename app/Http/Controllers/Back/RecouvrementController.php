<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;

use App\Models\Location;
use App\Models\Recouvrement;
use App\Services\RecouvrementService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RecouvrementController extends Controller
{
    protected $recouvrementService;

    public function __construct(RecouvrementService $recouvrementService)
    {
        $this->recouvrementService = $recouvrementService;
    }

    public function index()
    {
        $recouvrements = Recouvrement::with(['location', 'paiement', 'agent'])
            ->orderBy('date_echeance')->get();

        dd($recouvrements);

        return view('recouvrements.index', compact('recouvrements'));
    }

    public function create()
    {
        $locations = Location::whereHas('paiementAssocie', function($query) {
            $query->where('montant_restant', '>', 0);
        })->get();

        dd($locations);
        return view('recouvrements.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'montant_du' => 'required|numeric|min:1',
            'date_echeance' => 'required|date|after:today',
        ]);

        $location = Location::findOrFail($request->location_id);
        $recouvrement = $this->recouvrementService->creerRecouvrement(
            $location,
            $request->montant_du,
            $request->date_echeance
        );

        return redirect()->route('recouvrements.index')
            ->with('success', 'Recouvrement créé avec succès');
    }

    public function edit(Recouvrement $recouvrement)
    {
//        return view('recouvrements.edit', compact('recouvrement'));
    }

    public function enregistrerPaiement(Request $request, Recouvrement $recouvrement)
    {
        $validated = $request->validate([
            'montant' => 'required|numeric|min:1',
            'commentaire' => 'nullable|string',
        ]);

        $this->recouvrementService->enregistrerPaiement(
            $recouvrement,
            $request->montant,
            $request->commentaire
        );

        return redirect()->route('recouvrements.index')
            ->with('success', 'Paiement enregistré avec succès');
    }

    public function dashboard()
    {
        $aujourdhui = Carbon::today();

        $stats = [
            'total_a_recouvrer' => Recouvrement::where('statut', '!=', 'recouvre')->sum('montant_du'),
            'total_recouvre' => Recouvrement::sum('montant_recouvre'),
            'echeances_depassees' => Recouvrement::where('date_echeance', '<', $aujourdhui)
                ->where('statut', '!=', 'recouvre')
                ->count(),
            'echeances_cette_semaine' => Recouvrement::whereBetween('date_echeance', [
                $aujourdhui,
                $aujourdhui->copy()->addDays(7)
            ])
                ->where('statut', '!=', 'recouvre')
                ->count(),
        ];

//        return view('recouvrements.dashboard', compact('stats'));
    }
}
