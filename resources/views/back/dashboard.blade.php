@extends('layouts.back')

@push('styles')
@endpush

@inject('Lang', 'App\Services\LanguageService')

@section('content')
    <!-- Page Header -->
    <div class="block justify-between page-header md:flex">
        <div>
        </div>
        <ol class="flex items-center whitespace-nowrap min-w-0">
            <li class="text-sm">
                <a class="flex items-center font-semibold text-primary hover:text-primary dark:text-primary truncate"
                    href="{{route('dashboard')}}">
                    Accueil
                    <i
                        class="ti ti-chevrons-right flex-shrink-0 mx-3 overflow-visible text-gray-300 dark:text-gray-300 rtl:rotate-180"></i>
                </a>
            </li>
            <li class="text-sm text-gray-500 hover:text-primary dark:text-white/70 " aria-current="page">
                Tableau de Bord
            </li>
        </ol>
    </div>
    <!-- Page Header Close -->

    <!-- Start::row-2 -->
    <div class="px-0">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Tableau de bord</h2>
                <p class="mt-1 text-sm text-gray-500">Statistiques et performances</p>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-3">
                <div class="relative">
                    <select id="dateFilter" class="appearance-none block w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="current">{{ Carbon\Carbon::now()->locale('fr')->format('F Y') }}</option>
                        <option value="previous">{{ Carbon\Carbon::now()->subMonth()->locale('fr')->format('F Y') }}</option>
                        <option value="year">Année {{ Carbon\Carbon::now()->year }}</option>
                    </select>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute right-3 top-2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                    </svg>
                </div>
                <button id="exportStats" class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow-sm text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span>Exporter</span>
                </button>
            </div>
        </div>

        <!-- Stats Overview Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-5 mb-6">
            <!-- Total Revenue Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total des revenus</p>
                            <p class="mt-1 text-2xl font-semibold text-gray-900">{{ number_format($stats['total_revenue']['value'], 0, ',', ' ') }} FCFA</p>
                        </div>
                        <div class="h-12 w-12 bg-indigo-50 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center mt-4">
                        @if($stats['total_revenue']['evolution'] > 0)
                            <span class="text-green-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        <span class="ml-1">{{ $stats['total_revenue']['evolution'] }}%</span>
                    </span>
                        @elseif($stats['total_revenue']['evolution'] < 0)
                            <span class="text-red-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        <span class="ml-1">{{ abs($stats['total_revenue']['evolution']) }}%</span>
                    </span>
                        @else
                            <span class="text-gray-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                        </svg>
                        <span class="ml-1">0%</span>
                    </span>
                        @endif
                        <span class="ml-2 text-xs text-gray-500">{{ $stats['total_revenue']['period'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Active Rentals Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Locations actives</p>
                            <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $stats['active_rentals']['value'] }}</p>
                        </div>
                        <div class="h-12 w-12 bg-blue-50 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center mt-4">
                        @if($stats['active_rentals']['evolution'] > 0)
                            <span class="text-green-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        <span class="ml-1">{{ $stats['active_rentals']['evolution'] }}%</span>
                    </span>
                        @elseif($stats['active_rentals']['evolution'] < 0)
                            <span class="text-red-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        <span class="ml-1">{{ abs($stats['active_rentals']['evolution']) }}%</span>
                    </span>
                        @else
                            <span class="text-gray-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                        </svg>
                        <span class="ml-1">0%</span>
                    </span>
                        @endif
                        <span class="ml-2 text-xs text-gray-500">{{ $stats['active_rentals']['period'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Fleet Utilization Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Taux d'occupation</p>
                            <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $stats['occupation_rate']['value'] }}%</p>
                        </div>
                        <div class="h-12 w-12 bg-green-50 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a2 2 0 01-2 2H9m11-3a2 2 0 01-2 2h-1" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center mt-4">
                        @if($stats['occupation_rate']['evolution'] > 0)
                            <span class="text-green-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        <span class="ml-1">{{ $stats['occupation_rate']['evolution'] }}%</span>
                    </span>
                        @elseif($stats['occupation_rate']['evolution'] < 0)
                            <span class="text-red-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        <span class="ml-1">{{ abs($stats['occupation_rate']['evolution']) }}%</span>
                    </span>
                        @else
                            <span class="text-gray-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                        </svg>
                        <span class="ml-1">0%</span>
                    </span>
                        @endif
                        <span class="ml-2 text-xs text-gray-500">{{ $stats['occupation_rate']['period'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Vehicles Needing Maintenance Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Véhicules en maintenance</p>
                            <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $stats['maintenance_vehicles']['value'] }}</p>
                        </div>
                        <div class="h-12 w-12 bg-amber-50 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center mt-4">
                        @if($stats['maintenance_vehicles']['evolution'] > 0)
                            <span class="text-red-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        <span class="ml-1">{{ $stats['maintenance_vehicles']['evolution'] }}%</span>
                    </span>
                        @elseif($stats['maintenance_vehicles']['evolution'] < 0)
                            <span class="text-green-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        <span class="ml-1">{{ abs($stats['maintenance_vehicles']['evolution']) }}%</span>
                    </span>
                        @else
                            <span class="text-gray-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                        </svg>
                        <span class="ml-1">0%</span>
                    </span>
                        @endif
                        <span class="ml-2 text-xs text-gray-500">{{ $stats['maintenance_vehicles']['period'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Revenue Chart (2/3 width) -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Revenus mensuels</h3>
                </div>
                <div class="p-6">
                    <div id="revenueChart" class="h-80"></div>
                </div>
            </div>


            <!-- Analyse de la saisonnalité -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden mt-6">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Analyse de la saisonnalité</h3>
                    <p class="mt-1 text-sm text-gray-500">Tendances mensuelles des revenus sur plusieurs années</p>
                </div>
                <div class="p-6">
                    <div class="mb-4 flex items-center space-x-4">
                        @foreach($seasonality['years'] as $year)
                            <div class="flex items-center">
                                <div class="h-3 w-3 rounded-full mr-1" style="background-color: {{ $seasonality['datasets'][$loop->index]['color'] }}"></div>
                                <span class="text-sm text-gray-600">{{ $year }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div id="seasonalityChart" class="h-80"></div>

{{--                    <div class="mt-6">--}}
{{--                        <h4 class="text-sm font-medium text-gray-700 mb-2">Insights</h4>--}}
{{--                        <div class="bg-indigo-50 rounded-lg p-4 text-sm text-indigo-700">--}}
{{--                            <p>Cette analyse vous permet d'identifier les périodes de haute et basse saison pour mieux planifier votre stratégie commerciale, les opérations de maintenance et l'ajustement des tarifs.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>

            <!-- Fleet Info Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Informations sur la flotte</h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm font-medium text-gray-500">Total des véhicules</span>
                        <span class="text-lg font-semibold text-gray-900">{{ $fleetInfo['total'] }}</span>
                    </div>
                    <div class="space-y-4">
                        <!-- Par catégorie -->
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Par catégorie</h4>
                            <div class="space-y-2">
                                @foreach($fleetInfo['by_category'] as $category)
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">{{ $category->name }}</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $category->count }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Par marque -->
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Par marque</h4>
                            <div class="space-y-2">
                                @foreach($fleetInfo['by_brand'] as $brand)
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">{{ $brand->name }}</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $brand->count }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Par type de carburant -->
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Par carburant</h4>
                            <div class="space-y-2">
                                @foreach($fleetInfo['by_fuel'] as $fuel)
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">{{ ucfirst($fuel->type_carburant) }}</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $fuel->count }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rentabilité par véhicule -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden mt-6">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Rentabilité par véhicule</h3>
                    <p class="mt-1 text-sm text-gray-500">Rapport entre revenus générés et coûts de maintenance</p>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Véhicule</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Revenus</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Coûts maintenance</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rentabilité</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Taux</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($vehicleProfitability as $vehicle)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($vehicle['image'])
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-md object-cover" src="{{ asset($vehicle['image']) }}" alt="{{ $vehicle['name'] }}">
                                                </div>
                                            @else
                                                <div class="flex-shrink-0 h-10 w-10 bg-gray-100 rounded-md flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a2 2 0 01-2 2H9m11-3a2 2 0 01-2 2h-1" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $vehicle['name'] }}</div>
                                                <div class="text-sm text-gray-500">{{ $vehicle['brand'] }} | {{ $vehicle['model'] }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ number_format($vehicle['revenue'], 0, ',', ' ') }} FCFA
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ number_format($vehicle['maintenance_cost'], 0, ',', ' ') }} FCFA
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="{{ $vehicle['profitability'] >= 0 ? 'text-green-600 font-medium' : 'text-red-600 font-medium' }}">
                                {{ number_format($vehicle['profitability'], 0, ',', ' ') }} FCFA
                            </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($vehicle['profitability_rate'] >= 50)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $vehicle['profitability_rate'] }}%
                                </span>
                                            @elseif($vehicle['profitability_rate'] >= 20)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    {{ $vehicle['profitability_rate'] }}%
                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    {{ $vehicle['profitability_rate'] }}%
                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- Amount to Recover Card (1/3 width) -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Montants à recouvrer</h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-5">
                        <div>
                            <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['amount_to_recover']['value'], 0, ',', ' ') }} FCFA</p>
                            <p class="mt-1 text-sm text-gray-500">Montant total à recouvrer</p>
                        </div>
                        <div class="h-16 w-16 bg-red-50 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Récupération progress -->
                    <div class="mt-8">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-medium text-gray-700">En attente</span>
                            <span class="text-sm font-medium text-gray-700">100%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-red-600 h-2 rounded-full" style="width: 100%"></div>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Aucun recouvrement effectué</p>
                    </div>

                    <div class="mt-8">
                        <a href="{{  route('recouvrements.index') }}" class="block w-full text-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Gérer les recouvrements
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grid Layout for Bottom Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-5">
            <!-- Recent Rentals (2/3 width) -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Locations récentes</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Véhicule</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Période</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($recentRentals as $rental)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $rental['id'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $rental['client'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $rental['vehicle'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $rental['start_date'] }} - {{ $rental['end_date'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($rental['amount'], 0, ',', ' ') }} FCFA</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($rental['status'] == 'En cours')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $rental['status'] }}
                                </span>
                                    @elseif($rental['status'] == 'Terminée')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $rental['status'] }}
                                </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    {{ $rental['status'] }}
                                </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-200">
                    <a href="{{ route('backend.booking.list') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Voir toutes les locations &rarr;</a>
                </div>
            </div>

            <!-- Customer Distribution + Fleet Info (1/3 width) -->
            <div class="space-y-6">
                <!-- Customer Distribution Card -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Répartition des clients</h3>
                    </div>
                    <div class="p-6">
                        <div id="customerDistribution" class="h-64"></div>
                        <div class="mt-4 space-y-2">
                            @foreach($customerTypes as $type)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="h-3 w-3 rounded-full {{ $loop->first ? 'bg-indigo-500' : 'bg-blue-400' }} mr-2"></div>
                                        <span class="text-sm text-gray-600">{{ $type['type'] }}</span>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">{{ $type['count'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End::row-2 -->
@endsection

@push('scripts')
    <script src="../assets/js/custom.js"></script>
    <script src="{{ asset('back/js/apexcharts.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Revenue Chart
            const revenueChartOptions = {
                series: [{
                    name: 'Revenus',
                    data: [
                        @foreach($monthlyRevenue as $item)
                            {{ $item['amount'] }},
                        @endforeach
                    ]
                }],
                chart: {
                    type: 'bar',
                    height: 320,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        columnWidth: '60%',
                    }
                },
                dataLabels: {
                    enabled: false
                },
                colors: ['#4F46E5'],
                xaxis: {
                    categories: [
                        @foreach($monthlyRevenue as $item)
                            '{{ $item['month'] }}',
                        @endforeach
                    ],
                    labels: {
                        style: {
                            colors: '#6B7280',
                            fontSize: '12px',
                            fontFamily: 'Inter, sans-serif',
                        }
                    },
                    axisBorder: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            return value.toLocaleString() + ' FCFA';
                        },
                        style: {
                            colors: '#6B7280',
                            fontSize: '12px',
                            fontFamily: 'Inter, sans-serif',
                        }
                    }
                },
                grid: {
                    borderColor: '#E5E7EB',
                    strokeDashArray: 4,
                    xaxis: {
                        lines: {
                            show: false
                        }
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(value) {
                            return value.toLocaleString() + ' FCFA';
                        }
                    }
                }
            };

            const revenueChart = new ApexCharts(document.querySelector("#revenueChart"), revenueChartOptions);
            revenueChart.render();

            // Customer Distribution Chart
            const customerDistributionOptions = {
                series: [
                    @foreach($customerTypes as $type)
                        {{ $type['percentage'] }},
                    @endforeach
                ],
                chart: {
                    type: 'donut',
                    height: 250,
                },
                labels: [
                    @foreach($customerTypes as $type)
                        '{{ $type['type'] }}',
                    @endforeach
                ],
                colors: ['#4F46E5', '#60A5FA'],
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    fontSize: '16px',
                                    fontFamily: 'Inter, sans-serif',
                                    color: '#1F2937',
                                    offsetY: -10
                                },
                                value: {
                                    show: true,
                                    fontSize: '24px',
                                    fontFamily: 'Inter, sans-serif',
                                    color: '#1F2937',
                                    formatter: function (val) {
                                        return val + '%';
                                    }
                                },
                                total: {
                                    show: true,
                                    label: 'Total',
                                    fontSize: '16px',
                                    fontFamily: 'Inter, sans-serif',
                                    color: '#6B7280',
                                    formatter: function (w) {
                                        return '{{ array_sum(array_column($customerTypes, 'count')) }}';
                                    }
                                }
                            }
                        }
                    }
                }
            };

            const customerDistributionChart = new ApexCharts(document.querySelector("#customerDistribution"), customerDistributionOptions);
            customerDistributionChart.render();

            // Export functionality
            document.getElementById('exportStats').addEventListener('click', function() {
                // In a real application, this would trigger an AJAX request to download a report
                alert('Exportation des statistiques en cours...');
            });

            // Date filter functionality
            document.getElementById('dateFilter').addEventListener('change', function() {
                // In a real application, this would trigger an AJAX request to update the stats
                alert('Changement de période : ' + this.options[this.selectedIndex].text);
            });

            // Configuration du graphique de saisonnalité
            const seasonalityChartOptions = {
                series: [
                        @foreach($seasonality['datasets'] as $dataset)
                    {
                        name: '{{ $dataset['year'] }}',
                        data: [{{ implode(',', $dataset['data']) }}],
                        color: '{{ $dataset['color'] }}'
                    },
                    @endforeach
                ],
                chart: {
                    height: 320,
                    type: 'line',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.1
                    },
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                grid: {
                    borderColor: '#E5E7EB',
                    strokeDashArray: 4,
                    xaxis: {
                        lines: {
                            show: true
                        }
                    },
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                markers: {
                    size: 5,
                    hover: {
                        size: 7
                    }
                },
                xaxis: {
                    categories: [
                        @foreach($seasonality['labels'] as $label)
                            '{{ $label }}',
                        @endforeach
                    ],
                    labels: {
                        style: {
                            colors: '#6B7280',
                            fontSize: '12px',
                            fontFamily: 'Inter, sans-serif',
                        }
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            return value.toLocaleString() + ' FCFA';
                        },
                        style: {
                            colors: '#6B7280',
                            fontSize: '12px',
                            fontFamily: 'Inter, sans-serif',
                        }
                    }
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    floating: true,
                    offsetY: -25,
                    offsetX: -5,
                    showForSingleSeries: true,
                    markers: {
                        width: 10,
                        height: 10,
                        strokeWidth: 0,
                        strokeColor: '#fff',
                        radius: 12,
                    }
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    y: {
                        formatter: function(value) {
                            return value.toLocaleString() + ' FCFA';
                        }
                    }
                }
            };

            const seasonalityChart = new ApexCharts(document.querySelector("#seasonalityChart"), seasonalityChartOptions);
            seasonalityChart.render();

            // Créer une interaction entre les deux graphiques
            document.querySelector("#seasonalityChart").addEventListener('mouseenter', function() {
                // Animation à l'entrée de la souris
                seasonalityChart.updateOptions({
                    chart: {
                        animations: {
                            enabled: true,
                            easing: 'easeinout',
                            speed: 800,
                            dynamicAnimation: {
                                enabled: true,
                                speed: 350
                            }
                        }
                    }
                });
            });
        });

    </script>
@endpush
