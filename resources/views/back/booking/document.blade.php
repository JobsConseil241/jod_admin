@extends('layouts.back')

@push('styles')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.tailwindcss.css" />
    <!-- DataTables Responsive CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.8/css/responsive.dataTables.min.css">

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
            <h3 class="text-gray-700 hover:text-gray-900 dark:text-white dark:hover:text-white text-2xl font-medium">
                Locations</h3>
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

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <!-- Prévisualisation du contrat de location -->
            <div class="box">
                <div class="box-header">
                    <h5 class="box-title">Contrat de Location</h5>
                    <div class="box-tools">
                        <button class="ti-btn ti-btn-primary ti-btn-sm">
                            <i class="ri-printer-line me-1"></i> Imprimer
                        </button>
                        <button class="ti-btn ti-btn-danger ti-btn-sm ms-2">
                            <i class="ri-file-pdf-line me-1"></i> PDF
                        </button>
                    </div>
                </div>
                <div class="box-body p-0">
                    <div class="p-6 bg-white dark:bg-bgdark">
                        <!-- En-tête du contrat -->
                        <div class="flex flex-col md:flex-row justify-between mb-6">
                            <div>
                                <h2 class="text-2xl font-bold text-primary mb-1">CONTRAT DE LOCATION</h2>
                                <p class="text-gray-600 dark:text-white/70">#LOC-2025-0036</p>
                                <p class="text-gray-600 dark:text-white/70">Date: 08/05/2025</p>
                            </div>
                            <div class="mt-4 md:mt-0 md:text-right">
                                <div class="h-12 w-32 bg-gray-100 dark:bg-black/20 rounded mb-2 inline-flex items-center justify-center">
                                    <span class="text-xs text-gray-500 dark:text-white/50">VOTRE LOGO</span>
                                </div>
                                <h3 class="font-bold dark:text-white">LUX CARS LOCATION</h3>
                                <p class="text-gray-600 dark:text-white/70">123 Avenue Principale</p>
                                <p class="text-gray-600 dark:text-white/70">Libreville, Gabon</p>
                                <p class="text-gray-600 dark:text-white/70">Tel: +241 XX XX XX XX</p>
                            </div>
                        </div>

                        <!-- Informations des parties -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="border rounded-md p-4 dark:border-white/10">
                                <h4 class="font-semibold mb-2 dark:text-white">Loueur:</h4>
                                <p class="font-medium dark:text-white">LUX CARS LOCATION</p>
                                <p class="text-gray-600 dark:text-white/70">RCCM: GA-LBV-01-2020-B12-00123</p>
                                <p class="text-gray-600 dark:text-white/70">Représenté par: Jean Dupont</p>
                                <p class="text-gray-600 dark:text-white/70">Fonction: Directeur Commercial</p>
                            </div>
                            <div class="border rounded-md p-4 dark:border-white/10">
                                <h4 class="font-semibold mb-2 dark:text-white">Locataire:</h4>
                                <p class="font-medium dark:text-white">Amadou Diallo</p>
                                <p class="text-gray-600 dark:text-white/70">ID/Passeport: GA0123456789</p>
                                <p class="text-gray-600 dark:text-white/70">Adresse: 456 Rue des Palmiers, Libreville</p>
                                <p class="text-gray-600 dark:text-white/70">Tel: +241 XX XX XX XX</p>
                            </div>
                        </div>

                        <!-- Informations du véhicule -->
                        <div class="mb-6 border rounded-md p-4 dark:border-white/10">
                            <h4 class="font-semibold mb-3 dark:text-white">Véhicule</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <p class="text-gray-600 dark:text-white/70 mb-1">Marque/Modèle:</p>
                                    <p class="font-medium dark:text-white">Toyota Land Cruiser</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-white/70 mb-1">Immatriculation:</p>
                                    <p class="font-medium dark:text-white">GA-123-AB</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-white/70 mb-1">Année:</p>
                                    <p class="font-medium dark:text-white">2023</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-white/70 mb-1">Couleur:</p>
                                    <p class="font-medium dark:text-white">Noir Métallisé</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-white/70 mb-1">Carburant:</p>
                                    <p class="font-medium dark:text-white">Diesel</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 dark:text-white/70 mb-1">N° de châssis:</p>
                                    <p class="font-medium dark:text-white">JTMHV05J604XXXXX</p>
                                </div>
                            </div>
                        </div>

                        <!-- Durée et tarif -->
                        <div class="mb-6 border rounded-md p-4 dark:border-white/10">
                            <h4 class="font-semibold mb-3 dark:text-white">Durée et tarif</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <div class="flex justify-between mb-2">
                                        <span class="text-gray-600 dark:text-white/70">Date de début:</span>
                                        <span class="font-medium dark:text-white">10/05/2025 à 10:00</span>
                                    </div>
                                    <div class="flex justify-between mb-2">
                                        <span class="text-gray-600 dark:text-white/70">Date de fin:</span>
                                        <span class="font-medium dark:text-white">15/05/2025 à 10:00</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 dark:text-white/70">Durée totale:</span>
                                        <span class="font-medium dark:text-white">6 jours</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between mb-2">
                                        <span class="text-gray-600 dark:text-white/70">Tarif journalier:</span>
                                        <span class="font-medium dark:text-white">65 000 FCFA</span>
                                    </div>
                                    <div class="flex justify-between mb-2">
                                        <span class="text-gray-600 dark:text-white/70">Services additionnels:</span>
                                        <span class="font-medium dark:text-white">120 000 FCFA</span>
                                    </div>
                                    <div class="flex justify-between font-bold">
                                        <span class="text-gray-800 dark:text-white">Montant total:</span>
                                        <span class="text-primary">510 000 FCFA</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- État du véhicule -->
                        <div class="mb-6 border rounded-md p-4 dark:border-white/10">
                            <h4 class="font-semibold mb-3 dark:text-white">État du véhicule</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h5 class="font-medium mb-2 dark:text-white">Kilométrage</h5>
                                    <div class="flex justify-between mb-2">
                                        <span class="text-gray-600 dark:text-white/70">Début:</span>
                                        <span class="font-medium dark:text-white">45 320 km</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 dark:text-white/70">Limite journalière:</span>
                                        <span class="font-medium dark:text-white">200 km/jour</span>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="font-medium mb-2 dark:text-white">Niveau de carburant</h5>
                                    <div class="flex justify-between mb-2">
                                        <span class="text-gray-600 dark:text-white/70">Au départ:</span>
                                        <span class="font-medium dark:text-white">Plein (100%)</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 dark:text-white/70">À retourner:</span>
                                        <span class="font-medium dark:text-white">Plein (100%)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <h5 class="font-medium mb-2 dark:text-white">Observations</h5>
                                <p class="text-gray-600 dark:text-white/70">Légère rayure sur l'aile avant droite. Intérieur en excellent état. Tous les équipements fonctionnels. Véhicule livré propre.</p>
                            </div>
                        </div>

                        <!-- Caution et garantie -->
                        <div class="mb-6 border rounded-md p-4 dark:border-white/10">
                            <h4 class="font-semibold mb-3 dark:text-white">Caution et garantie</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <div class="flex justify-between mb-2">
                                        <span class="text-gray-600 dark:text-white/70">Montant de la caution:</span>
                                        <span class="font-medium dark:text-white">500 000 FCFA</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 dark:text-white/70">Mode de paiement:</span>
                                        <span class="font-medium dark:text-white">Carte bancaire (pré-autorisation)</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between mb-2">
                                        <span class="text-gray-600 dark:text-white/70">Franchise d'assurance:</span>
                                        <span class="font-medium dark:text-white">200 000 FCFA</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 dark:text-white/70">Type d'assurance:</span>
                                        <span class="font-medium dark:text-white">Tous risques premium</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Conditions générales -->
                        <div class="mb-6">
                            <h4 class="font-semibold mb-3 dark:text-white">Conditions générales</h4>
                            <div class="text-sm text-gray-600 dark:text-white/70 border p-3 rounded-md dark:border-white/10 max-h-40 overflow-y-auto">
                                <p class="mb-2">Le locataire reconnaît avoir reçu le véhicule en bon état de fonctionnement et s'engage à le restituer dans le même état.</p>
                                <p class="mb-2">Le locataire s'engage à ne pas conduire sous l'influence d'alcool ou de stupéfiants, à respecter le code de la route et à ne pas utiliser le véhicule à des fins illicites.</p>
                                <p class="mb-2">Le locataire est responsable de tous dommages causés au véhicule pendant la durée de la location, dans la limite de la franchise d'assurance.</p>
                                <p class="mb-2">Tout retard dans la restitution du véhicule entraînera la facturation de jours supplémentaires au tarif contractuel majoré de 25%.</p>
                                <p>Le locataire déclare avoir pris connaissance des conditions générales de location et les accepter sans réserve.</p>
                            </div>
                        </div>

                        <!-- Signatures -->
                        <div class="mt-8 pt-4 border-t dark:border-white/10">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="text-center">
                                    <div class="h-20 border-b dark:border-white/10 mb-2"></div>
                                    <p class="text-gray-600 dark:text-white/70">Signature du loueur</p>
                                    <p class="text-xs text-gray-500 dark:text-white/50">LUX CARS LOCATION</p>
                                </div>
                                <div class="text-center">
                                    <div class="h-20 border-b dark:border-white/10 mb-2"></div>
                                    <p class="text-gray-600 dark:text-white/70">Signature du locataire</p>
                                    <p class="text-xs text-gray-500 dark:text-white/50">Amadou Diallo</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.tailwindcss.js"></script>

    <script>
        "use strict";

        function formatAmount(amount) {
            return amount.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        }

        $(document).ready(function() {
            $("#data").DataTable({
                language: {
                    'url': "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
                },
                processing: true,
                responsive: true,
                order: [
                    [0, 'desc']
                ],
                serverSide: true,
                searching: true,
                ajax: "{{ route('backend.booking.ajax') }}",
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'code_contrat',
                        name: 'code_contrat',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            // Customize this function to generate content for your custom column
                            return `<span class="font-bold">`+ data +`</span>`;
                        },
                    },
                    {
                        data: 'date_heure_debut',
                        name: 'date_heure_debut',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            // Customize this function to generate content for your custom column
                            return `<span class="font-bold text-success">`+ data +`</span>`;
                        },
                    },
                    {
                        data: 'date_heure_fin',
                        name: 'date_heure_fin',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            // Customize this function to generate content for your custom column
                            return `<span class="font-bold text-danger">`+ data +`</span>`;
                        },
                    },
                    {
                        data: 'vehicule',
                        name: 'vehicule',
                        render: function(data, type, row) {
                            // Customize this function to generate content for your custom column
                            return `<div class="flex space-x-3 rtl:space-x-reverse text-start min-w-[220px] truncate">
                                        <img class="avatar avatar-sm rounded-sm" src="/public/`+ row.vehicule.vehicule_medias[0].photo_avant +`" alt="Image Description">
                                        <div class="block">
                                            <p class="block text-sm font-semibold text-gray-800 dark:text-white my-auto">` + row.vehicule.name +` </p>
                                            <p class="block text-xs text-gray-500 dark:text-white/70 my-auto">` + row.vehicule.modele + `</p>
                                        </div>
                                    </div>`;
                        },
                    },
                    {
                        data: 'statut',
                        name: 'statut',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            // Customize this function to generate content for your custom column
                            if(data === 5){
                                return `<span class="badge bg-success/10 leading-none text-success rounded-sm">Terminée</span>`;
                            }else if(data === 4) {
                                return `<span class="badge bg-danger/10 leading-none text-danger rounded-sm">Refusée</span>`;
                            }else if(data === 3) {
                                return `<span class="badge bg-primary/10 leading-none text-primary rounded-sm">Acceptée</span>`;
                            }else if(data === 2) {
                                return `<span class="badge bg-danger/10 leading-none text-danger rounded-sm">Annulée</span>`;
                            }else if(data === 1) {
                                return `<span class="badge bg-secondary/10 leading-none text-secondary rounded-sm">En attente</span>`;
                            }else if(data === 7) {
                                return `<span class="badge bg-warning/10 leading-none text-warning rounded-sm">En cours</span>`;
                            }
                        },
                    },
                    {
                        targets: -1,
                        data: 'null',
                        name: 'customColumn',
                        render: function(data, type, row) {
                            return `<a href="{{ url('backend/booking/detail/') }}/` + row.code_contrat + `" >
                                       <button type="button" class="ti-btn ti-btn-soft-primary">
                                            <i class="ti ti-eye align-bottom me-2"></i> Voir
                                        </button>
                                    </a>`;
                        },
                        orderable: false,
                        searchable: false
                    }

                ]
            })
        });


    </script>
@endpush
