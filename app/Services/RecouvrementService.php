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
                    ->where('statut', '!=', 6); // Non terminées/annulées
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

            // Log::info("Recouvrement #{$recouvrement->id} : montant mis à jour de {$ancienMontant} à {$montantTotalDu}");

            return true;
        }

        return false;
    }

    public function verifierEtMettreAJourMontantRestant(Location $location)
    {
        // Récupérer le paiement associé
        $paiement = $location->paiementAssocie;

        if (!$paiement) {
            return false;
        }

        // Récupérer le dernier recouvrement actif pour cette location
        $recouvrement = $location->recouvrements()
            ->whereIn('statut', ['en_attente', 'partiellement_recouvre'])
            ->latest()
            ->first();

        // Si pas de recouvrement actif et qu'il y a un montant restant, on pourrait en créer un nouveau
        // mais c'est géré par la commande DetecterRetardsPaiement, donc on ne fait rien ici
        if (!$recouvrement) {
            return false;
        }

        // Log::info($recouvrement);
        // Log::info($paiement);

        // Calculer la différence entre le montant dû dans le recouvrement et le montant restant actuel
        $montantRestantActuel = $paiement->montant_restant;
        $montantDuRecouvrement = $recouvrement->montant_du - $recouvrement->montant_recouvre;


        // Si le montant restant a changé
        if ($montantRestantActuel != $montantDuRecouvrement) {
            // Mettre à jour le montant dû
            $recouvrement->montant_du = $montantRestantActuel;


            // Mise à jour du statut
            if ($montantRestantActuel <= 0) {
                $recouvrement->statut = 'recouvre';
                $recouvrement->date_recouvrement = Carbon::now();
                $recouvrement->commentaire = ($recouvrement->commentaire ? $recouvrement->commentaire . "\n" : "") .
                    "Recouvrement finalisé automatiquement suite à mise à jour du paiement.";
            } else {
                // Vérifier si le montant est partiellement ou pas du tout recouvré
                if ($recouvrement->montant_recouvre > 0) {
                    $recouvrement->statut = 'partiellement_recouvre';
                } else {
                    $recouvrement->statut = 'en_attente';
                }

                $recouvrement->commentaire = ($recouvrement->commentaire ? $recouvrement->commentaire . "\n" : "") .
                    "Montant ajusté suite à mise à jour du paiement.";
            }

            $recouvrement->save();

            return $recouvrement;
        } elseif ($montantRestantActuel == $montantDuRecouvrement) {

            $recouvrement->montant_du = $montantRestantActuel;


            // Mise à jour du statut
            if ($montantRestantActuel <= 0) {
                $recouvrement->statut = 'recouvre';
                $recouvrement->date_recouvrement = Carbon::now();
                $recouvrement->commentaire = ($recouvrement->commentaire ? $recouvrement->commentaire . "\n" : "") .
                    "Recouvrement finalisé automatiquement suite à mise à jour du paiement.";
            } else {
                // Vérifier si le montant est partiellement ou pas du tout recouvré
                if ($recouvrement->montant_recouvre > 0) {
                    $recouvrement->statut = 'partiellement_recouvre';
                } else {
                    $recouvrement->statut = 'en_attente';
                }

                $recouvrement->commentaire = ($recouvrement->commentaire ? $recouvrement->commentaire . "\n" : "") .
                    "Montant ajusté suite à mise à jour du paiement.";
            }

            $recouvrement->save();

            return $recouvrement;
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
