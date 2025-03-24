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
                                    <dd class="mt-1 text-base font-semibold text-gray-900">{{ Carbon::parse($booking->date_heure_debut)->locale('fr')->isoFormat('D MMMM YYYY [à] HH[h]mm')  }}</dd>
                                </div>
                                <div class="px-6 py-5">
                                    <dt class="text-sm font-medium text-gray-500">Date de fin</dt>
                                    <dd class="mt-1 text-base font-semibold text-gray-900">{{ Carbon::parse($booking->date_heure_fin)->locale('fr')->isoFormat('D MMMM YYYY [à] HH[h]mm')  }}</dd>
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
                                        <div class="flex-shrink-0 sm:w-48 mb-4 sm:mb-0 mr-5">
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
                                            @if($booking->vehicule->latest_etat)
                                                @foreach ((array)$booking->vehicule->latest_etat as $key => $value)
                                                    @if ($value === 1)
                                                        <div class="flex items-center text-sm text-gray-600">
                                                            <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                            </svg>
                                                            <span>{{ str_replace('_', ' ', $key) }}</span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
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
                                                        <p class="font-medium">{{ Carbon::parse($booking->date_heure_debut)->locale('fr')->isoFormat('D MMMM YYYY [à] HH[h]mm')  }}</p>
                                                        <p class="mt-1">Agence Centrale<br>Avenue de Cointet, Libreville</p>
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
                                                        <p class="font-medium">{{ Carbon::parse($booking->date_heure_fin)->locale('fr')->isoFormat('D MMMM YYYY [à] HH[h]mm')  }}</p>
                                                        <p class="mt-1">Agence Centrale<br>Avenue de Cointet, Libreville</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Special requests -->
                                    <div class="mt-6">
                                        <h4 class="text-sm font-medium text-gray-500 mb-2">Demandes spéciales</h4>
{{--                                        <div class="bg-yellow-50 border border-yellow-100 rounded-lg p-4">--}}
{{--                                            <p class="text-sm text-yellow-800">--}}
{{--                                                Le client a demandé un siège enfant pour un enfant de 3 ans.--}}
{{--                                            </p>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>

                            <!-- Rental status history -->
                            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-base font-semibold text-gray-900">Historique des pannes</h3>
                                        <button class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                            Voir tout
                                        </button>
                                    </div>

                                    <div class="overflow-hidden">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Panne</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">

                                                @php
                                                    $index = 0;
                                                @endphp

                                                @if(count($booking->pannes) > 0)
                                                    @foreach($booking->pannes as $pan)
                                                        @php
                                                            ++ $index;
                                                        @endphp
                                                        <tr>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                                {{ $pan->name }}</td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                @switch($pan->pivot->status)
                                                                    @case('TERMINE')
                                                                        <span class="px-2 inline-flex text-xs leading-5 font-medium rounded-full text-success">{{$pan->pivot->status}}</span>
                                                                        @break
                                                                    @case('ABANDONNE')
                                                                        <span class="px-2 inline-flex text-xs leading-5 font-medium rounded-full text-danger">{{$pan->pivot->status}}</span>
                                                                        @break
                                                                    @default
                                                                        <span class="px-2 inline-flex text-xs leading-5 font-medium rounded-full text-warning">{{$pan->pivot->status}}</span>
                                                                @endswitch
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pan->pivot->montant }} FCFA</td>
                                                            <td class="px-6 py-4 text-sm text-gray-500">{{ Carbon::parse($pan->pivot->created_at)->locale('fr')->isoFormat('D MMMM YYYY') }}</td>
                                                            <td>
                                                                <button type="button" class="ti-btn ti-btn-soft-primary"
                                                                        data-hs-overlay="#cardModalView{{ $pan->id }}">
                                                                    <i class="ri-pencil-fill align-bottom me-2"></i>
                                                                </button>

                                                                <button type="button" class="ti-btn ti-btn-soft-danger"
                                                                        data-hs-overlay="#cardModalDelete{{ $pan->id }}">
                                                                    <i class="ri-delete-bin-fill align-bottom me-2"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <div id="cardModalView{{ $pan->id }}" class="hs-overlay ti-modal hidden">
                                                            <div class="ti-modal-box">
                                                                <div class="ti-modal-content">
                                                                    <form action="{{ url('backend/booking/detail/' . $reference .'/assign_update') }}" method="POST">
                                                                        @csrf
                                                                        <div class="ti-modal-header">
                                                                            <h3 class="ti-modal-title">
                                                                                Modifier Le statut de la panne : {{ $pan->name }}
                                                                            </h3>
                                                                            <button type="button" class="hs-dropdown-toggle ti-modal-clode-btn"
                                                                                    data-hs-overlay="#cardModalView{{ $pan->id }}">
                                                                                <span class="sr-only">Close</span>
                                                                                <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                                                                        fill="currentColor"></path>
                                                                                </svg>
                                                                            </button>
                                                                        </div>
                                                                        <div class="ti-modal-body">

                                                                            <div class="mb-3">
                                                                                <label class="ti-form-label mb-0">Panne Associée</label>
                                                                                <select name="ids_pannes[]" class="ti-form-select" readonly>
                                                                                    <option>--- Choisissez la panne ---</option>
                                                                                    @foreach ($pannes as $item)
                                                                                        <option value="{{ (int)$item->id }}"
                                                                                            {{ $pan->id == $item->id  ? 'selected' : '' }}>
                                                                                            {{ $item->name  }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
{{--                                                                                <input type="hidden" name="id_location" value="{{$reference}}">--}}
                                                                                <input type="hidden" name="id_location" value="{{$index}}">
                                                                            </div>

                                                                            <div class="mb-3">
                                                                                <label class="ti-form-label">Statut</label>
                                                                                <select class="ti-form-select" name="status" autocomplete="off">
                                                                                    {{--                                <option value="initie">--}}
                                                                                    {{--                                    Initie--}}
                                                                                    {{--                                </option>--}}
                                                                                    <option value="EN COURS" {{ $pan->pivot->status == 'EN COURS' ? 'selected' : '' }}>
                                                                                        En cours
                                                                                    </option>
                                                                                    <option value="TERMINE" {{ $pan->pivot->status == 'TERMINE' ? 'selected' : '' }}>
                                                                                        Traité
                                                                                    </option>
                                                                                    <option value="ABANDONNE" {{ $pan->pivot->status == 'ABANDONNE' ? 'selected' : '' }}>
                                                                                        Abandonnée
                                                                                    </option>
                                                                                </select>
                                                                            </div>


                                                                            <div class="mb-3">
                                                                                <label class="ti-form-label">Montant</label>
                                                                                <input type="number" name="montant" class="ti-form-input" min="0" value="{{$pan->pivot->montant}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="ti-modal-footer">
                                                                            <button type="button"
                                                                                    class="hs-dropdown-toggle ti-btn ti-border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:ring-offset-white focus:ring-primary dark:bg-bgdark dark:hover:bg-black/20 dark:border-white/10 dark:text-white/70 dark:hover:text-white dark:focus:ring-offset-white/10"
                                                                                    data-hs-overlay="#cardModalView{{ $pan->id }}">
                                                                                Annuler
                                                                            </button>
                                                                            <button class="ti-btn ti-btn-primary" type="submit">
                                                                                Enregistrer
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div id="cardModalDelete{{ $pan->id }}" class="hs-overlay ti-modal hidden">
                                                            <div class="ti-modal-box">
                                                                <div class="ti-modal-content">
                                                                    <div class="ti-modal-header">
                                                                        <h3 class="ti-modal-title">
                                                                            Supprimer une Panne associé à {{ $reference }}
                                                                        </h3>
                                                                        <button type="button" class="hs-dropdown-toggle ti-modal-clode-btn"
                                                                                data-hs-overlay="#cardModalDelete{{ $pan->id }}">
                                                                            <span class="sr-only">Close</span>
                                                                            <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                                                                    fill="currentColor" />
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                    <div class="ti-modal-body">
                                                                        <p class="mt-1 text-gray-800 dark:text-white/70">
                                                                            Êtes-vous sûr de vouloir supprimer cette panne : {{ $pan->name }} ?
                                                                        </p>
                                                                    </div>
                                                                    <div class="ti-modal-footer">
                                                                        <form action="{{ url('backend/car/pannes/' . $reference .'/delete_update') }}" method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="delete" value="true" />
                                                                            <button type="button"
                                                                                    class="hs-dropdown-toggle ti-btn ti-border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:ring-offset-white focus:ring-primary dark:bg-bgdark dark:hover:bg-black/20 dark:border-white/10 dark:text-white/70 dark:hover:text-white dark:focus:ring-offset-white/10"
                                                                                    data-hs-overlay="cardModalDelete{{ $pan->id }}">
                                                                                Fermer
                                                                            </button>
                                                                            <button type="submit" class="ti-btn ti-btn-danger" data-hs-overlay="cardModalDelete{{ $pan->id }}">
                                                                                Supprimer
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach


                                                @endif
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
                                            <img class="h-12 w-12 rounded-full" src="{{ url('back/img/users/1.jpg') }}" alt="Photo du client">
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-sm font-medium text-gray-900">{{ $booking->client_associe->first_name }} {{ $booking->client_associe->last_name }}</h4>
                                            <p class="text-sm text-gray-500">Client depuis le {{ Carbon::parse($booking->client_associe->created_at)->locale('fr')->isoFormat('D MMMM YYYY [à] HH[h]mm')  }}</p>
                                        </div>
                                    </div>

                                    <div class="mt-5 border-t border-gray-200 pt-5">
                                        <dl class="space-y-3">
                                            <div class="flex justify-between">
                                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                                <dd class="text-sm text-gray-900">{{ $booking->client_associe->email }}</dd>
                                            </div>
                                            <div class="flex justify-between">
                                                <dt class="text-sm font-medium text-gray-500">Téléphone</dt>
                                                <dd class="text-sm text-gray-900">+ {{ $booking->client_associe->phone_code }} {{ $booking->client_associe->phone }}</dd>
                                            </div>
                                            <div class="flex justify-between">
                                                <dt class="text-sm font-medium text-gray-500">N° de permis</dt>
                                                <dd class="text-sm text-gray-900">{{ $booking->client_associe->numero_piece }}</dd>
                                            </div>
                                            <div class="flex justify-between">
                                                <dt class="text-sm font-medium text-gray-500">Adresse</dt>
                                                <dd class="text-sm text-gray-900">{{ $booking->client_associe->adresse }}</dd>
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
                                            <span class="text-lg font-bold text-indigo-600"> {{ $booking->paiement_associe->montant_total }} FCFA</span>
                                        </div>
                                    </div>

                                    <div class="space-y-3">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Prix journalier</span>
                                            <span class="text-gray-900">{{ $booking->vehicule->prix_location }} FCFA</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Nombre de jours</span>
                                            <span class="text-gray-900">{{ $booking->jours }}</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Assurance tous risques</span>
                                            <span class="text-gray-900">0 FCFA</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Équipements supplémentaires</span>
                                            <span class="text-gray-900">0 FCFA</span>
                                        </div>
                                        <div class="flex justify-between text-sm font-semibold pt-1">
                                            <span class="text-gray-900">Total</span>
                                            <span class="text-indigo-600">{{ $booking->paiement_associe->montant_total }} FCFA</span>
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
                                        <a href="{{ route('backend.booking.details.view', ['reference' => $reference]) }}" class="w-full flex items-center justify-between px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            <span class="flex items-center">
                                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                              </svg>
                                              Modifier la réservation
                                            </span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>


                                        <button class="hs-dropdown-toggle w-full flex items-center justify-between px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                type="button"
                                                data-hs-overlay="#hs-basic-modal">
                                            <span class="flex items-center">
                                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                                </svg>
                                              Ajouter une Panne
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
                <div id="hs-basic-modal" class="hs-overlay ti-modal hidden">
                    <div class="ti-modal-box">
                        <div class="ti-modal-content">
                            <form action="{{ route('backend.booking.assign.pannes', ['reference' => $reference]) }}" method="post">
                                @csrf
                                <div class="ti-modal-header">
                                    <h3 class="ti-modal-title">
                                        Ajouter une panne
                                    </h3>
                                    <button type="button" class="hs-dropdown-toggle ti-modal-clode-btn"
                                            data-hs-overlay="#hs-basic-modal">
                                        <span class="sr-only">Close</span>
                                        <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="ti-modal-body">

                                    <div class="mb-3">
                                        <label class="ti-form-label mb-0">Panne associe</label>
                                        <select name="ids_pannes" class="ti-form-select" required>
                                            <option selected disabled>--- Choisissez la panne ---</option>
                                            @foreach ($pannes as $item)
                                                <option value="{{ (int)$item->id }}"
                                                    {{ old('panne_id') == $item->id  ? 'selected' : '' }}>
                                                    {{ $item->name  }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="id_location" value="{{ $reference }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="ti-form-label">Statut</label>
                                        <select class="ti-form-select" name="status" autocomplete="off">
                                            {{--                                <option value="initie">--}}
                                            {{--                                    Initie--}}
                                            {{--                                </option>--}}
                                            <option value="EN COURS">
                                                En cours
                                            </option>
                                            <option value="TERMINE">
                                                Traité
                                            </option>
                                            <option value="ABANDONNE">
                                                Abandonnée
                                            </option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="ti-form-label">Montant</label>
                                        <input type="number" name="montant" class="ti-form-input" min="0" value="0">
                                    </div>
                                </div>
                                <div class="ti-modal-footer">
                                    <button type="button"
                                            class="hs-dropdown-toggle ti-btn ti-border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:ring-offset-white focus:ring-primary dark:bg-bgdark dark:hover:bg-black/20 dark:border-white/10 dark:text-white/70 dark:hover:text-white dark:focus:ring-offset-white/10"
                                            data-hs-overlay="#hs-basic-modal">
                                        Annuler
                                    </button>
                                    <button class="ti-btn ti-btn-primary" type="submit">
                                        Enregistrer
                                    </button>
                                </div>
                            </form>
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
