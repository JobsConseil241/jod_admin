<?php

namespace App\Services;

use App\Models\Location;
use App\Models\Recouvrement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class RecouvrementService
{
    /**
     * Créer un nouveau recouvrement pour une location avec un paiement restant
     */
    public function creerRecouvrement(Location $location, $montant, $dateEcheance)
    {
        return Recouvrement::create([
            'location_id' => $location->id,
            'paiement_id' => $location->paiement_id,
            'montant_du' => $montant,
            'date_echeance' => $dateEcheance,
            'statut' => 'en_attente'
        ]);
    }

    /**
     * Identifier les locations ayant des paiements en retard
     */
    public function identifierRetards()
    {
        $locationsAvecRetard = Location::whereHas('paiementAssocie', function($query) {
            $query->where('montant_restant', '>', 0);
        })
            ->where(function($query) {
                // Locations avec date de fin dépassée
                $query->where('date_heure_fin', '<', now())
                    ->where('statut', '!=', 5); // Non terminées/annulées
            })
            ->get();

        return $locationsAvecRetard;
    }

    public function verifierEtMettreAJourMontant(Recouvrement $recouvrement)
    {
        $montantRestantActuel = $recouvrement->paiementAssocie->montant_restant;

        $montantTotalDu = $montantRestantActuel + $recouvrement->montant_recouvre;

        if ($montantTotalDu != $recouvrement->montant_du) {
            $ancienMontant = $recouvrement->montant_du;

            // Mettre à jour le montant dû
            $recouvrement->montant_du = $montantTotalDu;

            // Si le montant est devenu négatif ou nul, on peut marquer comme recouvré
            if ($montantTotalDu <= 0) {
                $recouvrement->statut = 'recouvre';
                $recouvrement->date_recouvrement = Carbon::now();
            }
            // Si le montant a diminué mais reste positif, on peut ajuster le statut
            else if ($montantTotalDu < $ancienMontant) {
                if ($recouvrement->montant_recouvre  > 0) {
                    $recouvrement->statut = 'partiellement_recouvre';
                }
            }
            // Si le montant a augmenté, on peut revenir à un statut antérieur
            else if ($montantTotalDu > $ancienMontant) {
                if ($recouvrement->statut == 'recouvre') {
                    $recouvrement->statut = $recouvrement->montant_recouvre > 0 ? 'partiellement_recouvre' : 'en_attente';
                    $recouvrement->date_recouvrement = null;
                }
            }

            $recouvrement->save();

            Log::info("Recouvrement #{$recouvrement->id} : montant mis à jour de {$ancienMontant} à {$montantTotalDu}");

            return true;
        }

        return false;
    }

    /**
     * Enregistrer un paiement de recouvrement
     */
    public function enregistrerPaiement(Recouvrement $recouvrement, $montant, $commentaire = null)
    {
        // Vérifier d'abord si le montant a changé
        $this->verifierEtMettreAJourMontant($recouvrement);

        // Ajouter le montant au recouvrement
        $recouvrement->montant_recouvre += $montant;

        // Mettre à jour le paiement principal si existant
        if ($recouvrement->paiementAssocie) {
            $paiement = $recouvrement->paiementAssocie;
            $paiement->montant_paye += $montant;
            $paiement->montant_restant -= $montant;

            if ($paiement->montant_restant <= 0) {
                $paiement->statut = 1; // Complètement payé
            }

            $paiement->save();
        }

        // Mise à jour du statut de recouvrement
        if ($recouvrement->montant_recouvre >= $recouvrement->montant_du) {
            $recouvrement->statut = 'recouvre';
            $recouvrement->date_recouvrement = Carbon::now();
        } else {
            $recouvrement->statut = 'partiellement_recouvre';
        }

        $recouvrement->commentaire = $commentaire;
        $recouvrement->user_id = auth()->id();
        $recouvrement->save();

        return $recouvrement;
    }
}
