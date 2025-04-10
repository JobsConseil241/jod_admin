<?php

namespace App\Console\Commands;

use App\Services\RecouvrementService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DetecterRetardsPaiement extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recouvrements:detecter-retards';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Détecte les locations avec paiements en retard';

    protected $recouvrementService;

    public function __construct(RecouvrementService $recouvrementService)
    {
        parent::__construct();
        $this->recouvrementService = $recouvrementService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $locationsAvecRetard = $this->recouvrementService->identifierRetards();

        $count = 0;
        foreach ($locationsAvecRetard as $location) {
            // Vérifier si un recouvrement existe déjà pour cette location
            $existingRecouvrement = $location->recouvrements()
                ->where('statut', '!=', 'recouvre')
                ->first();

            if (!$existingRecouvrement) {
                // Créer un nouveau recouvrement avec échéance dans 7 jours
                $montantDu = $location->paiementAssocie->montant_restant;
                $dateEcheance = Carbon::now()->addDays(7);

                $this->recouvrementService->creerRecouvrement(
                    $location,
                    $montantDu,
                    $dateEcheance
                );

                $count++;
            } else {
                $montantDu = $location->paiementAssocie->montant_restant;
                $existingRecouvrement->montant_du = $montantDu;
                $existingRecouvrement->save();
            }
        }

        Log::info("{$count} nouveaux recouvrements ont été créés.");
        $this->info("{$count} nouveaux recouvrements ont été créés.");

        return Command::SUCCESS;
    }
}
