<?php

namespace App\Services;

use App\Models\Location;
use App\Models\Recouvrement;
use Carbon\Carbon;

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
        $locationsAvecRetard = Location::whereHas('paiement', function($query) {
            $query->where('montant_restant', '>', 0);
        })
            ->where(function($query) {
                // Locations avec date de fin dépassée
                $query->where('date_heure_fin', '<', now())
                    ->where('statut', '!=', 0); // Non terminées/annulées
            })
            ->get();

        return $locationsAvecRetard;
    }

    /**
     * Enregistrer un paiement de recouvrement
     */
    public function enregistrerPaiement(Recouvrement $recouvrement, $montant, $commentaire = null)
    {
        $recouvrement->montant_recouvre += $montant;

        // Mettre à jour le paiement principal si existant
        if ($recouvrement->paiement) {
            $paiement = $recouvrement->paiement;
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
