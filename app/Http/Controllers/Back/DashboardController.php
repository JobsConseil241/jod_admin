<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Vehicule;
use App\Models\Paiement;
use App\Models\User;
use App\Models\VehiculePanne;
use App\Models\Category;
use App\Models\Recouvrement;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtenir le mois et l'année actuels
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Statistiques générales
        $stats = [
            'total_revenue' => $this->calculateTotalRevenue(),
            'active_rentals' => $this->getActiveRentals(),
            'occupation_rate' => $this->calculateOccupationRate(),
            'maintenance_vehicles' => $this->getVehiclesInMaintenance(),
            'amount_to_recover' => $this->getAmountToRecover(),
            'active_customers' => $this->getActiveCustomers()
        ];

        // Revenus mensuels pour le graphique
        $monthlyRevenue = $this->getMonthlyRevenue();

        // Locations récentes
        $recentRentals = $this->getRecentRentals();

        // Statistiques par catégorie
        $categoryStats = $this->getCategoryStats();

        // Types de clients
        $customerTypes = $this->getCustomerTypes();

        // Informations sur la flotte
        $fleetInfo = $this->getFleetInfo();

        return view('back.dashboard', compact(
            'stats',
            'monthlyRevenue',
            'recentRentals',
            'categoryStats',
            'customerTypes',
            'fleetInfo'
        ));
    }

    /**
     * Calcule le revenu total
     */
    private function calculateTotalRevenue()
    {
        $totalRevenue = Paiement::sum('montant_paye');
        $evolution = 0;

        // Calcul de l'évolution par rapport au mois précédent
        $currentMonthRevenue = Paiement::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('montant_paye');

        $previousMonthRevenue = Paiement::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->sum('montant_paye');

        if ($previousMonthRevenue > 0) {
            $evolution = (($currentMonthRevenue - $previousMonthRevenue) / $previousMonthRevenue) * 100;
        }

        return [
            'value' => $totalRevenue,
            'evolution' => round($evolution, 1),
            'period' => 'ce mois'
        ];
    }

    /**
     * Obtient le nombre de locations actives
     */
    private function getActiveRentals()
    {
        $activeRentals = Location::where('statut', 2)
            ->whereDate('date_heure_fin', '>=', Carbon::now())
            ->count();

        // On pourrait calculer l'évolution par rapport à hier
        $yesterday = Carbon::yesterday();
        $yesterdayRentals = Location::where('statut', 2)
            ->whereDate('date_heure_debut', '<=', $yesterday)
            ->whereDate('date_heure_fin', '>=', $yesterday)
            ->count();

        $evolution = 0;
        if ($yesterdayRentals > 0) {
            $evolution = (($activeRentals - $yesterdayRentals) / $yesterdayRentals) * 100;
        }

        return [
            'value' => $activeRentals,
            'evolution' => round($evolution, 1),
            'period' => 'aujourd\'hui'
        ];
    }

    /**
     * Calcule le taux d'occupation de la flotte
     */
    private function calculateOccupationRate()
    {
        $totalVehicles = Vehicule::count();

        if ($totalVehicles == 0) {
            return [
                'value' => 0,
                'evolution' => 0,
                'period' => 'cette semaine'
            ];
        }

        $occupiedVehicles = Location::where('statut', 2)
            ->whereDate('date_heure_fin', '>=', Carbon::now())
            ->distinct('vehicule_id')
            ->count('vehicule_id');

        $rate = ($occupiedVehicles / $totalVehicles) * 100;

        // Calcul de l'évolution par rapport à la semaine dernière
        $lastWeekStart = Carbon::now()->subWeek()->startOfWeek();
        $lastWeekEnd = Carbon::now()->subWeek()->endOfWeek();

        $lastWeekOccupiedVehicles = Location::where('statut', 2)
            ->whereBetween('date_heure_debut', [$lastWeekStart, $lastWeekEnd])
            ->distinct('vehicule_id')
            ->count('vehicule_id');

        $lastWeekRate = 0;
        if ($totalVehicles > 0) {
            $lastWeekRate = ($lastWeekOccupiedVehicles / $totalVehicles) * 100;
        }

        $evolution = 0;
        if ($lastWeekRate > 0) {
            $evolution = $rate - $lastWeekRate;
        }

        return [
            'value' => round($rate),
            'evolution' => round($evolution, 1),
            'period' => 'cette semaine'
        ];
    }

    /**
     * Obtient le nombre de véhicules en maintenance
     */
    private function getVehiclesInMaintenance()
    {
        $vehiclesInMaintenance = VehiculePanne::where('status', 'EN COURS')
            ->distinct('vehicule_id')
            ->count('vehicule_id');

        // Calcul de l'évolution par rapport au mois dernier
        $lastMonthVehiclesInMaintenance = VehiculePanne::where('status', 'EN COURS')
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->distinct('vehicule_id')
            ->count('vehicule_id');

        $evolution = 0;
        if ($lastMonthVehiclesInMaintenance > 0) {
            $evolution = (($vehiclesInMaintenance - $lastMonthVehiclesInMaintenance) / $lastMonthVehiclesInMaintenance) * 100;
        }

        return [
            'value' => $vehiclesInMaintenance,
            'evolution' => round($evolution, 1),
            'period' => 'ce mois'
        ];
    }

    /**
     * Obtient le montant à recouvrer
     */
    private function getAmountToRecover()
    {
        $amountToRecover = Recouvrement::where('statut', 'en_attente')
            ->sum('montant_du');

        return [
            'value' => $amountToRecover,
            'evolution' => 0,
            'period' => 'total'
        ];
    }

    /**
     * Obtient le nombre de clients actifs
     */
    private function getActiveCustomers()
    {
        $activeCustomers = User::where('user_type_id', 1000002)
            ->where('is_active', 1)
            ->count();

        // Calcul de l'évolution par rapport au mois dernier
        $lastMonthActiveCustomers = User::where('user_type_id', 1000002)
            ->where('is_active', 1)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();

        $evolution = 0;
        if ($lastMonthActiveCustomers > 0) {
            $evolution = (($activeCustomers - $lastMonthActiveCustomers) / $lastMonthActiveCustomers) * 100;
        }

        return [
            'value' => $activeCustomers,
            'evolution' => round($evolution, 1),
            'period' => 'ce mois'
        ];
    }

    /**
     * Obtient les revenus mensuels pour le graphique
     */
    private function getMonthlyRevenue()
    {
        $year = Carbon::now()->year;
        $monthlyRevenue = [];

        // Noms des mois en français
        $monthNames = [
            1 => 'Jan', 2 => 'Fév', 3 => 'Mar', 4 => 'Avr', 5 => 'Mai', 6 => 'Juin',
            7 => 'Juil', 8 => 'Août', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Déc'
        ];

        // Récupérer les revenus pour chaque mois de l'année en cours
        for ($month = 1; $month <= 12; $month++) {
            $revenue = Paiement::whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->sum('montant_paye');

            $monthlyRevenue[] = [
                'month' => $monthNames[$month],
                'amount' => $revenue
            ];
        }

        return $monthlyRevenue;
    }

    /**
     * Obtient les locations récentes
     */
    private function getRecentRentals()
    {
        $recentRentals = Location::with(['clientAssocie', 'vehicule', 'paiementAssocie'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($location) {
                dd($location);
                $status = '';
                switch ($location->statut) {
                    case 1:
                        $status = 'En attente';
                        break;
                    case 2:
                        if (Carbon::parse($location->date_heure_fin)->isPast()) {
                            $status = 'Terminée';
                        } else {
                            $status = 'En cours';
                        }
                        break;
                    case 3:
                        $status = 'Annulée';
                        break;
                    default:
                        $status = 'Inconnu';
                };

                return [
                    'id' => $location->code_contrat,
                    'client' => $location->client_associe->first_name . ' ' . $location->client_associe->last_name,
                    'vehicle' => $location->vehicule->name ?? $location->vehicule->modele,
                    'start_date' => Carbon::parse($location->date_heure_debut)->format('d/m/Y'),
                    'end_date' => Carbon::parse($location->date_heure_fin)->format('d/m/Y'),
                    'amount' => $location->paiement_associe ? $location->paiement_associe->montant_total : 0,
                    'status' => $status
                ];
            });

        return $recentRentals;
    }

    /**
     * Obtient les statistiques par catégorie
     */
    private function getCategoryStats()
    {
        $categories = Category::all();

        $categoryStats = $categories->map(function ($category) {
            $vehicles = Vehicule::where('category_id', $category->id)->get();
            $vehicleIds = $vehicles->pluck('id')->toArray();

            $rentals = Location::whereIn('vehicule_id', $vehicleIds)->count();
            $revenue = Location::whereIn('vehicule_id', $vehicleIds)
                ->join('paiements', 'locations.paiement_id', '=', 'paiements.id')
                ->sum('paiements.montant_paye');

            $occupationRate = 0;
            if (count($vehicles) > 0) {
                $occupiedVehicles = Location::whereIn('vehicule_id', $vehicleIds)
                    ->where('statut', 2)
                    ->whereDate('date_heure_fin', '>=', Carbon::now())
                    ->distinct('vehicule_id')
                    ->count('vehicule_id');

                $occupationRate = ($occupiedVehicles / count($vehicles)) * 100;
            }

            $maintenances = VehiculePanne::whereIn('vehicule_id', $vehicleIds)
                ->where('status', 'EN COURS')
                ->count();

            return [
                'name' => $category->name,
                'rentals' => $rentals,
                'revenue' => $revenue,
                'occupation_rate' => round($occupationRate),
                'maintenances' => $maintenances
            ];
        });

        return $categoryStats;
    }

    /**
     * Obtient les types de clients
     */
    private function getCustomerTypes()
    {
        $totalCustomers = User::where('user_type_id', 1000002)->count();

        // Dans cet exemple, nous n'avons que des particuliers
        // Mais on pourrait avoir d'autres types dans une application réelle
        $individualCustomers = $totalCustomers;
        $businessCustomers = 0;

        $customerTypes = [
            [
                'type' => 'Particuliers',
                'percentage' => $totalCustomers > 0 ? 100 : 0,
                'count' => $individualCustomers
            ],
            [
                'type' => 'Entreprises',
                'percentage' => 0,
                'count' => $businessCustomers
            ]
        ];

        return $customerTypes;
    }

    /**
     * Obtient des informations sur la flotte
     */
    private function getFleetInfo()
    {
        $totalVehicles = Vehicule::count();

        $fleetInfo = [
            'total' => $totalVehicles,
            'by_category' => Vehicule::select('categories.name', DB::raw('count(*) as count'))
                ->join('categories', 'vehicules.category_id', '=', 'categories.id')
                ->groupBy('categories.name')
                ->get(),
            'by_brand' => Vehicule::select('marques.name', DB::raw('count(*) as count'))
                ->join('marques', 'vehicules.marque_id', '=', 'marques.id')
                ->groupBy('marques.name')
                ->get(),
            'by_transmission' => Vehicule::select('transmission', DB::raw('count(*) as count'))
                ->groupBy('transmission')
                ->get(),
            'by_fuel' => Vehicule::select('type_carburant', DB::raw('count(*) as count'))
                ->groupBy('type_carburant')
                ->get()
        ];

        return $fleetInfo;
    }
}
