@extends('layouts.back')

@push('styles')
    <!--datatable css-->
    <!-- Quil Css -->
    <link id="style" href="{{ asset('back/libs/quill/quill.snow.css') }}" rel="stylesheet">

    <!-- Choices Css -->
    <link rel="stylesheet" href="{{ asset('back/libs/choices.js/public/assets/styles/choices.min.css') }}">

    <!-- Filepond CSS -->
    <link rel="stylesheet" href="{{ asset('back/libs/filepond/filepond.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('back/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.css') }}">

    <!-- Flatpickr Css -->
    <link rel="stylesheet" href="{{ asset('back/libs/flatpickr/flatpickr.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <style>
        .iti {
            width: 100%;
        }

        .col-start-2 {
            grid-column-start: 3 !important;
        }
    </style>
@endpush

@inject('Lang', 'App\Services\LanguageService')

@section('content')
    <!-- Page Header -->
    <div class="block justify-between page-header md:flex">
        <div>
{{--            <h3 class="text-gray-700 hover:text-gray-900 dark:text-white dark:hover:text-white text-2xl font-medium">--}}
{{--                Detail Location ()</h3>--}}
        </div>
        <ol class="flex items-center whitespace-nowrap min-w-0">
            <li class="text-sm">
                <a class="flex items-center font-semibold text-primary hover:text-primary dark:text-primary truncate"
                    href="{{ route('dashboard') }}">
                    Tableau de Bord
                    <i
                        class="ti ti-chevrons-right flex-shrink-0 mx-3 overflow-visible text-gray-300 dark:text-gray-300 rtl:rotate-180"></i>
                </a>
            </li>
            <li class="text-sm text-gray-500 hover:text-primary dark:text-white/70 " aria-current="page">
                Locations
            </li>
        </ol>
    </div>
    <!-- Page Header Close -->

    @include('layouts.alert')

    <!-- Start::row-1 -->
    @php
        use Carbon\Carbon;
    @endphp

    <div class="grid grid-cols-12 gap-x-6">
        <div class="col-span-12">
            <div class="box !bg-transparent border-0 shadow-none">
                <div class="p-4 lg:p-6">
                    <!-- Page header -->
                    <div class="mb-6">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <h1 class="text-2xl font-semibold text-gray-900">Détails de Location</h1>
                                <p class="mt-1 text-sm text-gray-500">Informations détaillées sur la location de véhicule</p>
                            </div>
                            <div class="mt-4 md:mt-0 flex space-x-3">
                                <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <span>Exporter</span>
                                </button>
                                <button class="px-4 py-2 bg-indigo-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <span>Modifier</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Rental status card -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
                        <div class="p-6">
                            <div class="sm:flex sm:items-center sm:justify-between">
                                <div>
                                    <div class="flex items-center">
                                        <h3 class="text-lg font-semibold text-gray-900">Réservation {{ $booking->code_contrat }}</h3>
                                        <span class="ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            En cours
                                        </span>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-500">Créée le {{ Carbon::parse($booking->created_at)->locale('fr')->isoFormat('D MMMM YYYY')  }}</p>
                                </div>
                                <div class="mt-4 sm:mt-0 flex space-x-3">
                                    <button class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                        </svg>
                                        Télécharger
                                    </button>
                                    <button class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                        </svg>
                                        Imprimer
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="border-t border-gray-200">
                            <div class="bg-gray-50 grid grid-cols-2 sm:grid-cols-4 divide-y sm:divide-y-0 sm:divide-x divide-gray-200">
                                <div class="px-6 py-5">
                                    <dt class="text-sm font-medium text-gray-500">Date de début</dt>
                                    <dd class="mt-1 text-base font-semibold text-gray-900">{{ Carbon::parse($booking->date_heure_debut)->locale('fr')->isoFormat('D MMMM YYYY H:i:s')  }}</dd>
                                </div>
                                <div class="px-6 py-5">
                                    <dt class="text-sm font-medium text-gray-500">Date de fin</dt>
                                    <dd class="mt-1 text-base font-semibold text-gray-900">{{ Carbon::parse($booking->date_heure_fin)->locale('fr')->isoFormat('D MMMM YYYY H:i:s')  }}</dd>
                                </div>
                                <div class="px-6 py-5">
                                    <dt class="text-sm font-medium text-gray-500">Durée</dt>
                                    <dd class="mt-1 text-base font-semibold text-indigo-600">{{ $booking->jours }} jours</dd>
                                </div>
                                <div class="px-6 py-5">
                                    <dt class="text-sm font-medium text-gray-500">Montant total</dt>
                                    <dd class="mt-1 text-base font-semibold text-gray-900">{{ $booking->paiement_associe->montant_total }} FCFA</dd>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Main content column -->
                        <div class="lg:col-span-2 space-y-6">
                            <!-- Vehicle card -->
                            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                                <div class="p-6">
                                    <h3 class="text-base font-semibold text-gray-900 mb-4">Détails du véhicule</h3>

                                    <div class="flex flex-col sm:flex-row">
                                        <div class="flex-shrink-0 sm:w-48 mb-4 sm:mb-0">
                                            <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden bg-gray-200">
                                                <img class="w-full h-auto object-cover" src="{{ url($booking->vehicule->vehicule_medias[0]->photo_avant) }}" alt="Volkswagen Golf">
                                            </div>
                                        </div>
                                        <div class="sm:ml-6 flex-1">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <h4 class="text-lg font-semibold text-gray-900">{{ $booking->vehicule->marque->name }} {{ $booking->vehicule->modele }} {{ $booking->vehicule->couleur }}</h4>
                                                    <p class="mt-1 text-sm text-gray-500">Immatriculation: {{ $booking->vehicule->immatriculation }}</p>
                                                </div>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    Disponible
                  </span>
                                            </div>

                                            <div class="mt-4 grid grid-cols-2 gap-4">
                                                <div>
                                                    <dt class="text-sm font-medium text-gray-500">Catégorie</dt>
                                                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->vehicule->categorie->name }}</dd>
                                                </div>
                                                <div>
                                                    <dt class="text-sm font-medium text-gray-500">Année</dt>
                                                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->vehicule->annee }}</dd>
                                                </div>
                                                <div>
                                                    <dt class="text-sm font-medium text-gray-500">Carburant</dt>
                                                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->vehicule->type_carburant }}</dd>
                                                </div>
                                                <div>
                                                    <dt class="text-sm font-medium text-gray-500">Boîte de vitesse</dt>
                                                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->vehicule->transmission }}</dd>
                                                </div>
                                                <div>
                                                    <dt class="text-sm font-medium text-gray-500">Kilométrage</dt>
                                                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->vehicule->latest_etat->kilometrage }} km</dd>
                                                </div>
                                                <div>
                                                    <dt class="text-sm font-medium text-gray-500">Couleur</dt>
                                                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->vehicule->couleur }}</dd>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Features section -->
                                    <div class="mt-6">
                                        <h4 class="text-sm font-medium text-gray-500 mb-3">Équipements</h4>
                                        <div class="grid grid-cols-2 md:grid-cols-3 gap-y-2 gap-x-4">
                                            <div class="flex items-center text-sm text-gray-600">
                                                <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>GPS</span>
                                            </div>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>Bluetooth</span>
                                            </div>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>Climatisation</span>
                                            </div>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>Caméra de recul</span>
                                            </div>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>Sièges chauffants</span>
                                            </div>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>Apple CarPlay</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pickup & Return -->
                            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                                <div class="p-6">
                                    <h3 class="text-base font-semibold text-gray-900 mb-4">Prise en charge et retour</h3>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Pickup -->
                                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0">
                                                    <div class="inline-flex items-center justify-center h-10 w-10 rounded-lg bg-indigo-100 text-indigo-600">
                                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <h4 class="text-sm font-medium text-gray-900">Prise en charge</h4>
                                                    <div class="mt-2 text-sm text-gray-600">
                                                        <p class="font-medium">17 Mars 2025, 10:00</p>
                                                        <p class="mt-1">Agence Centrale<br>123 Avenue des Champs-Élysées, Paris</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Return -->
                                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0">
                                                    <div class="inline-flex items-center justify-center h-10 w-10 rounded-lg bg-indigo-100 text-indigo-600">
                                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <h4 class="text-sm font-medium text-gray-900">Retour</h4>
                                                    <div class="mt-2 text-sm text-gray-600">
                                                        <p class="font-medium">24 Mars 2025, 10:00</p>
                                                        <p class="mt-1">Agence Centrale<br>123 Avenue des Champs-Élysées, Paris</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Special requests -->
                                    <div class="mt-6">
                                        <h4 class="text-sm font-medium text-gray-500 mb-2">Demandes spéciales</h4>
                                        <div class="bg-yellow-50 border border-yellow-100 rounded-lg p-4">
                                            <p class="text-sm text-yellow-800">
                                                Le client a demandé un siège enfant pour un enfant de 3 ans.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Rental status history -->
                            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-base font-semibold text-gray-900">Historique des statuts</h3>
                                        <button class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                            Voir tout
                                        </button>
                                    </div>

                                    <div class="overflow-hidden">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Commentaire</th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">16/03/2025 14:32</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-medium rounded-full bg-blue-100 text-blue-800">Paiement reçu</span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Système</td>
                                                <td class="px-6 py-4 text-sm text-gray-500">Paiement en ligne confirmé</td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">15/03/2025 18:05</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-medium rounded-full bg-yellow-100 text-yellow-800">En attente</span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Système</td>
                                                <td class="px-6 py-4 text-sm text-gray-500">Réservation créée, en attente de paiement</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Side column -->
                        <div class="space-y-6">
                            <!-- Customer info -->
                            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                                <div class="p-6">
                                    <h3 class="text-base font-semibold text-gray-900 mb-4">Informations client</h3>

                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <img class="h-12 w-12 rounded-full" src="/api/placeholder/48/48" alt="Photo du client">
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-sm font-medium text-gray-900">Jean Dupont</h4>
                                            <p class="text-sm text-gray-500">Client depuis le 01/01/2024</p>
                                        </div>
                                    </div>

                                    <div class="mt-5 border-t border-gray-200 pt-5">
                                        <dl class="space-y-3">
                                            <div class="flex justify-between">
                                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                                <dd class="text-sm text-gray-900">jean.dupont@exemple.fr</dd>
                                            </div>
                                            <div class="flex justify-between">
                                                <dt class="text-sm font-medium text-gray-500">Téléphone</dt>
                                                <dd class="text-sm text-gray-900">+33 6 12 34 56 78</dd>
                                            </div>
                                            <div class="flex justify-between">
                                                <dt class="text-sm font-medium text-gray-500">N° de permis</dt>
                                                <dd class="text-sm text-gray-900">123456789AB</dd>
                                            </div>
                                            <div class="flex justify-between">
                                                <dt class="text-sm font-medium text-gray-500">Date de naissance</dt>
                                                <dd class="text-sm text-gray-900">15/07/1985</dd>
                                            </div>
                                        </dl>
                                    </div>

                                    <div class="mt-5">
                                        <button class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                            </svg>
                                            Voir toutes les locations
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment details -->
                            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                                <div class="p-6">
                                    <h3 class="text-base font-semibold text-gray-900 mb-4">Détails du paiement</h3>

                                    <div class="bg-gray-50 rounded-lg p-4 mb-5">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">Montant total</p>
                                                <p class="text-xs text-gray-500">TVA incluse</p>
                                            </div>
                                            <span class="text-lg font-bold text-indigo-600">385,00 €</span>
                                        </div>

                                        <div class="mt-4 pt-4 border-t border-gray-200">
                                            <div class="text-sm font-medium text-gray-500 mb-2">Payé avec</div>
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                                    <line x1="1" y1="10" x2="23" y2="10"></line>
                                                </svg>
                                                <span class="ml-2 text-sm text-gray-700">Carte Visa •••• 4242</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-y-3">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Prix journalier</span>
                                            <span class="text-gray-900">55,00 €</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Nombre de jours</span>
                                            <span class="text-gray-900">7</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Sous-total location</span>
                                            <span class="text-gray-900">385,00 €</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Assurance tous risques</span>
                                            <span class="text-gray-900">70,00 €</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Équipements supplémentaires</span>
                                            <span class="text-gray-900">0,00 €</span>
                                        </div>
                                        <div class="flex justify-between text-sm pb-3 border-b border-gray-200">
                                            <span class="text-gray-500">Réduction (15%)</span>
                                            <span class="text-red-600">-70,00 €</span>
                                        </div>
                                        <div class="flex justify-between text-sm font-semibold pt-1">
                                            <span class="text-gray-900">Total</span>
                                            <span class="text-indigo-600">385,00 €</span>
                                        </div>
                                    </div>

                                    <div class="mt-5">
                                        <button class="w-full flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                            </svg>
                                            Générer la facture
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions card -->
                            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                                <div class="p-6">
                                    <h3 class="text-base font-semibold text-gray-900 mb-4">Actions</h3>

                                    <div class="space-y-3">
                                        <button class="w-full flex items-center justify-between px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <span class="flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                  </svg>
                  Modifier la réservation
                </span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>

                                        <button class="w-full flex items-center justify-between px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <span class="flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                  Changer les dates
                </span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>

                                        <button class="w-full flex items-center justify-between px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <span class="flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                  </svg>
                  Ajouter un paiement
                </span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>

                                        <button class="w-full flex items-center justify-between px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-red-600 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                <span class="flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg>
                  Annuler la réservation
                </span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Notes -->
                            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-base font-semibold text-gray-900">Notes</h3>
                                        <button class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                            Ajouter
                                        </button>
                                    </div>

                                    <div class="space-y-4">
                                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                            <div class="flex justify-between">
                                                <p class="text-sm font-medium text-gray-900">Sarah Martin</p>
                                                <p class="text-xs text-gray-500">16/03/2025 15:45</p>
                                            </div>
                                            <p class="mt-2 text-sm text-gray-600">
                                                Le client a appelé pour confirmer la disponibilité du siège enfant. J'ai confirmé que ce sera mis à disposition.
                                            </p>
                                        </div>

                                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                            <div class="flex justify-between">
                                                <p class="text-sm font-medium text-gray-900">Thomas Richard</p>
                                                <p class="text-xs text-gray-500">15/03/2025 18:30</p>
                                            </div>
                                            <p class="mt-2 text-sm text-gray-600">
                                                Client fidèle, propose-lui une mise à niveau gratuite si disponible à l'agence.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <div class="relative">
                                            <textarea rows="3" class="block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" placeholder="Ajouter une note..."></textarea>
                                            <button class="absolute bottom-2 right-2 inline-flex items-center justify-center h-8 w-8 rounded-full bg-indigo-600 text-white hover:bg-indigo-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End::row-1 -->
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Quill Editor JS -->
    <script src="{{ asset('back/libs/quill/quill.min.js') }}"></script>

    <!-- Choices JS -->
    <script src="{{ asset('back/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    <!-- Filepond JS -->
    <script src="{{ asset('back/libs/filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('back/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
    <script src="{{ asset('back/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}">
    </script>
    <script src="{{ asset('back/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}">
    </script>
    <script src="{{ asset('back/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js') }}"></script>
    <script src="{{ asset('back/libs/filepond-plugin-image-edit/filepond-plugin-image-edit.min.js') }}"></script>
    <script src="{{ asset('back/libs/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js') }}">
    </script>
    <script src="{{ asset('back/libs/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js') }}">
    </script>
    <script src="{{ asset('back/libs/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js') }}"></script>
    <script src="{{ asset('back/libs/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js') }}"></script>
    <script src="{{ asset('back/libs/filepond-plugin-image-transform/filepond-plugin-image-transform.min.js') }}"></script>

    <!-- Flatpickr JS -->
    <script src="{{ asset('back/libs/flatpickr/flatpickr.min.js') }}"></script>

    <!-- ADD Product JS -->
    <script src="{{ asset('back/js/addproduct.js') }}"></script>

    <script>
        "use strict";

        let car_id = 0
        let jours = 0
        let prixLocation = 0
        let netPaie = 0

        $(document).ready(function() {



            $('#voiture_select').on('change', function() {
                var voitureId = $(this).val();
                car_id = voitureId
                $('#panne_select').empty();

                prixLocation = $('option:selected', this).data('value');

                if(voitureId) {
                    $.ajax({
                        url: '/public/backend/booking/car/pannes/' + voitureId + '/ajax',
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#panne_select').append('<option value="">Sélectionnez un etat</option>');

                            $.each(data, function(key, panne) {
                                var dateObj = new Date(panne.date);
                                var formattedDate = formatDate(dateObj);

                                $('#panne_select').append('<option value="' + panne.id + '"> Etat du ' + formattedDate + '</option>');
                            });

                            $('.tett').each(function(index) {
                                // Créer un lien
                                var lien = $('<a>', {
                                    href: '/public/backend/car/etat/' + voitureId,
                                    text: 'ICI',
                                    class: 'lien-ajouter-etat text-success',
                                    'data-index': index
                                });

                                $(this).empty().append(
                                    'Ajouter un état si pas disponible ',
                                    lien
                                );
                            });

                            $('#panne_select').prop('disabled', false);

                        },
                        error: function(xhr, status, error) {
                            console.error('Erreur lors du chargement des pannes:', error);
                        }
                    });
                } else {
                    $('#panne_select').prop('disabled', true);
                    $('#panne_select').append('<option value="">Sélectionnez d\'abord une voiture</option>');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Récupérer les champs d'entrée
            const montantAPayer = document.querySelector('input[name="mntant_a_payer"]');
            const montantPaye = document.querySelector('input[name="mntant_paye"]');
            const resteAPayer = document.querySelector('input[name="montant_restant"]');

            const dateDebut = document.querySelector('input[name="date_debut"]');
            const dateRetour = document.querySelector('input[name="date_retour"]');

            // Fonction pour calculer la différence en jours entre deux dates
            function calculerNombreJours() {
                // Vérifier que les deux dates sont remplies
                if (!dateDebut.value || !dateRetour.value) return;

                // Convertir les chaînes en objets Date
                const dateDebutObj = new Date(dateDebut.value);
                const dateRetourObj = new Date(dateRetour.value);

                // Calculer la différence en millisecondes
                const differenceMs = dateRetourObj - dateDebutObj;

                // Convertir en jours (1 jour = 24 * 60 * 60 * 1000 ms)
                const differenceJours = Math.ceil(differenceMs / (1000 * 60 * 60 * 24));

                jours = differenceJours

                $('#jours').val(jours)

                netPaie  = parseInt(prixLocation) * parseInt(jours)

                const montantAPayer = document.querySelector('input[name="mntant_a_payer"]');
                montantAPayer.value = netPaie

            }

            function calculerResteAPayer() {
                // Récupérer les valeurs et convertir en nombres
                const montantAPayerValue = parseInt(montantAPayer.value.replace(/[^\d.-]/g, '')) || 0;
                const montantPayeValue = parseInt(montantPaye.value.replace(/[^\d.-]/g, '')) || 0;

                // Calculer le reste à payer
                // Mettre à jour le champ du reste à payer
                resteAPayer.value = Math.max(0, montantAPayerValue - montantPayeValue);
            }

            // Ajouter des écouteurs d'événements pour les deux premiers champs
            montantAPayer.addEventListener('input', calculerResteAPayer);
            montantPaye.addEventListener('input', calculerResteAPayer);

            flatpickr("#limitdatetime", {
                enableTime: true,
                minTime: "08:00",
                maxTime: "20:00"
            });

            flatpickr("#limitdatetimes", {
                enableTime: true,
                minTime: "08:00",
                maxTime: "20:00",
                onChange: function(selectedDates, dateStr, instance) {
                    calculerNombreJours();
                }
            });


            // Calculer initialement au chargement de la page
            calculerResteAPayer();
        });

        function formatDate(date) {
            var day = ('0' + date.getDate()).slice(-2);
            var month = ('0' + (date.getMonth() + 1)).slice(-2);
            var year = date.getFullYear();
            return day + '/' + month + '/' + year;
        }

        const phoneInputField = document.querySelector("#phone");
        const phonecodeInputField = document.querySelector("#phone_code");

        function getIp(callback) {
            fetch('https://ipinfo.io/json?token=4ccc52719ff8dc', {
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then((resp) => resp.json())
                .catch(() => {
                    return {
                        country: 'ga',
                    };
                })
                .then((resp) => callback(resp.country));
        }
        const phoneInput = window.intlTelInput(phoneInputField, {
            preferredCountries: ["ga", "cm", "ci", "fr"],
            initialCountry: "auto",
            geoIpLookup: getIp,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });

        phoneInputField.addEventListener("input", function() {
            var numeroTelephone = phoneInput.getNumber();
            var nationalNumber = intlTelInputUtils.formatNumber(numeroTelephone, phoneInput.getSelectedCountryData()
                .dialCode, intlTelInputUtils.numberFormat.NATIONAL);
            nationalNumber = nationalNumber.replace(/\s/g, '');
            var codePays = phoneInput.getSelectedCountryData().dialCode;
            var numeroComplet = codePays + "-" + nationalNumber;
            console.log("Numéro de téléphone complet : " + numeroComplet);
            phoneInputField.value = nationalNumber;
            phonecodeInputField.value = codePays;
        });

        $(document).on("click", ".edit_action", function() {
            var id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('backend.user.edit') }}",
                dataType: 'json',
                data: {
                    "id": id,
                    "action": "edit",
                },
                success: function(data) {
                    //get data value params
                    var body = data.body;
                    //dynamic title
                    $('#cardModalView .ti-modal-content').html(body); //url to delete item
                    $('#cardModalView').removeClass('hidden').addClass('open');
                }
            });
        });


        $(document).on("click", ".2fa_action", function() {
            var id = $(this).data('id');
            $('#input_reset_2fa_user_id').val(id);
        });

        $(document).on("click", ".delete_action", function() {
            var id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('backend.user.edit') }}",
                dataType: 'json',
                data: {
                    "id": id,
                    "action": "delete",
                },
                success: function(data) {
                    //get data value params
                    var body = data.body;
                    //dynamic title
                    $('#cardModalView .ti-modal-content').html(body); //url to delete item
                    $('#cardModalView').removeClass('hidden').addClass('open');
                }
            });
        });
    </script>
@endpush
