@extends('layouts.back')

@push('styles')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.tailwindcss.css" />

    <!-- Swiper Css -->
    <link rel="stylesheet" href="{{ asset('back/libs/swiper/swiper-bundle.min.css') }}">

    <!-- Choices Css -->
    <link rel="stylesheet" href="{{ asset('back/libs/choices.js/public/assets/styles/choices.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js" async></script>
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
                {{ $car->name . ', ' . $car->marque->name . ' ' . $car->modele }}</h3>
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
                {{ $car->name }}
            </li>
        </ol>
    </div>
    <!-- Page Header Close -->

    @include('layouts.alert')

    <!-- Start::row-1 -->
    <div class="box">
        <div class="grid grid-cols-12">
            <div class="col-span-12 xxl:col-span-5">
                <div class="box mb-0 border-0 shadow-none bg-transparent">
                    <div class="box-body">
                        <div class="swiper mySwiper2">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img alt="photo_avant" src="{{ asset($car->vehicule_medias[0]->photo_avant) }}">
                                </div>
                                <div class="swiper-slide">
                                    <img alt="photo_arriere" src="{{ asset($car->vehicule_medias[0]->photo_arriere) }}">
                                </div>
                                <div class="swiper-slide">
                                    <img alt="photo_gauche" src="{{ asset($car->vehicule_medias[0]->photo_gauche) }}">
                                </div>
                                <div class="swiper-slide">
                                    <img alt="photo_droite" src="{{ asset($car->vehicule_medias[0]->photo_droite) }}">
                                </div>
                                <div class="swiper-slide">
                                    <img alt="photo_dashboard" src="{{ asset($car->vehicule_medias[0]->photo_dashboard) }}">
                                </div>
                                <div class="swiper-slide">
                                    <img alt="photo_interieur"
                                        src="{{ asset($car->vehicule_medias[0]->photo_interieur) }}">
                                </div>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img alt="photo_avant" src="{{ asset($car->vehicule_medias[0]->photo_avant) }}">
                                </div>
                                <div class="swiper-slide">
                                    <img alt="photo_arriere" src="{{ asset($car->vehicule_medias[0]->photo_arriere) }}">
                                </div>
                                <div class="swiper-slide">
                                    <img alt="photo_gauche" src="{{ asset($car->vehicule_medias[0]->photo_gauche) }}">
                                </div>
                                <div class="swiper-slide">
                                    <img alt="photo_droite" src="{{ asset($car->vehicule_medias[0]->photo_droite) }}">
                                </div>
                                <div class="swiper-slide">
                                    <img alt="photo_dashboard"
                                        src="{{ asset($car->vehicule_medias[0]->photo_dashboard) }}">
                                </div>
                                <div class="swiper-slide">
                                    <img alt="photo_interieur"
                                        src="{{ asset($car->vehicule_medias[0]->photo_interieur) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 xxl:col-span-4">
                <div class="box mb-0 border-0 shadow-none bg-transparent">
                    <div class="box-body xxl:px-0">
                        <div class="space-y-5">
                            <h5 class="font-bold text-xl text-gray-800 dark:text-white">
                                {{ $car->name . ', ' . $car->marque->name . ' ' . $car->modele }}</h5>
                            <div class="sm:flex sm:space-x-6 rtl:space-x-reverse sm:space-y-0 space-y-2">
                                <div class="flex space-x-2 rtl:space-x-reverse">
                                    <i class="ri ri-star-fill text-yellow-500 text-sm"></i>
                                    <p class="text-gray-500 dark:text-white/70 text-sm space-x-2 rtl:space-x-reverse">4.2
                                        Notes</p>
                                </div>
                                <div class="flex space-x-2 rtl:space-x-reverse">
                                    <span class="my-auto w-1.5 h-1.5 inline-block bg-gray-400 rounded-full"></span>
                                    <p class="text-gray-500 dark:text-white/70 text-sm space-x-2 rtl:space-x-reverse">
                                        {{ $car->immatriculation }}
                                    </p>
                                </div>
                            </div>

                            <div class="sm:flex sm:space-x-5">
                                <h5 class="font-bold text-sm my-auto w-28 text-gray-800 dark:text-white">Status :</h5>
                                <span class="my-auto font-medium text-sm text-success">Disponible</span>
                            </div>

                            <div class="sm:flex sm:space-x-3 product-des">
                                <h5 class="font-bold text-sm my-auto w-28 text-gray-800 dark:text-white">Catégorie :</h5>
                                <p class="font-medium text-sm">{{ $car->categorie->name ?? '-' }}</p>

                            </div>

                            <div class="sm:flex sm:space-x-3 product-des">
                                <h5 class="font-bold text-sm my-auto w-28 text-gray-800 dark:text-white">Marque :</h5>
                                <p class="font-medium text-sm">{{ $car->marque->name }}</p>

                            </div>

                            <div class="sm:flex sm:space-x-3 product-des">
                                <h5 class="font-bold text-sm my-auto w-28 text-gray-800 dark:text-white">Modèle :</h5>
                                <p class="font-medium text-sm">{{ $car->modele }}</p>

                            </div>

                            <div class="sm:flex sm:space-x-3 product-des">
                                <h5 class="font-bold text-sm my-auto w-28 text-gray-800 dark:text-white">Couleur :</h5>
                                <p class="font-medium text-sm">{{ Str::upper($car->couleur) }}</p>
                            </div>

                            <div class="sm:flex sm:space-x-3 product-des">
                                <h5 class="font-bold text-sm my-auto w-28 text-gray-800 dark:text-white">Matricule :
                                </h5>
                                <p class="font-medium text-sm">{{ $car->immatriculation }}</p>
                            </div>

                            <div class="sm:flex sm:space-x-3 product-des">
                                <h5 class="font-bold text-sm my-auto w-28 text-gray-800 dark:text-white">Assurance :</h5>
                                <p class="font-medium text-sm">{{ $car->assurance_nom }}</h5>
                            </div>

                            <div class="sm:flex sm:space-x-3 product-des">
                                <h5 class="font-bold text-sm my-auto w-28 text-gray-800 dark:text-white">Date d'expiration
                                    :
                                </h5>
                                <p class="font-medium text-sm">{{ $car->assurance_date_expi }} </h5>
                            </div>

                            <div class="sm:flex sm:space-x-2">
                                <h5 class="font-bold text-sm my-auto w-28 text-gray-800 dark:text-white">Tarif :</h5>
                                <h5 class="text-xl font-semibold text-primary">{{ $car->prix_location }} FCFA</h5>
                            </div>

                            <div class="space-y-4">
                                <h5 class="font-bold text-sm my-auto w-28 text-gray-800 dark:text-white">Note Additionnelle
                                    :</h5>
                                <p class="my-auto font-medium text-sm text-gray-500 dark:text-white/70">
                                    {{ $car->note ?? '-' }}</p>
                            </div>

                            <div class="sm:flex sm:space-x-3 product-des">
                                <h5 class="font-bold text-sm my-auto w-28 text-gray-800 dark:text-white">Partager :</h5>
                                <div class="flex space-x-1 rtl:space-x-reverse">
                                    <button aria-label="button" type="button"
                                        class="m-0 rounded-sm p-2 ti-btn ti-btn-outline ring-white/10 text-gray-500 dark:text-white/70 bg-white/10  border-gray-200 dark:border-white/10">
                                        <i class="ri ri-github-line text-lg leading-none"></i>
                                    </button>
                                    <button aria-label="button" type="button"
                                        class="m-0 rounded-sm p-2 ti-btn ti-btn-outline ring-white/10 text-gray-500 dark:text-white/70 bg-white/10  border-gray-200 dark:border-white/10">
                                        <i class="ri ri-instagram-line text-lg leading-none"></i>
                                    </button>
                                    <button aria-label="button" type="button"
                                        class="m-0 rounded-sm p-2 ti-btn ti-btn-outline ring-white/10 text-gray-500 dark:text-white/70 bg-white/10  border-gray-200 dark:border-white/10">
                                        <i class="ri ri-twitter-line text-lg leading-none"></i>
                                    </button>
                                    <button aria-label="button" type="button"
                                        class="m-0 rounded-sm p-2 ti-btn ti-btn-outline ring-white/10 text-gray-500 dark:text-white/70 bg-white/10  border-gray-200 dark:border-white/10">
                                        <i class="ri ri-linkedin-line text-lg leading-none"></i>
                                    </button>
                                    <button aria-label="button" type="button"
                                        class="m-0 rounded-sm p-2 ti-btn ti-btn-outline ring-white/10 text-gray-500 dark:text-white/70 bg-white/10  border-gray-200 dark:border-white/10">
                                        <i class="ri ri-facebook-circle-line text-lg leading-none"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 xxl:col-span-3">
                <div class="box shadow-none border-0 mb-0">
                    <div class="box-body">
                        {{-- <div class="box !bg-success !border-success text-white">
                            <div class="box-body p-4">
                                <div class="flex">
                                    <div class="space-y-2">
                                        <h5 class="text-xl">30% Off</h5>
                                        <p class="text-xs text-white/80">Grab it fast has limited Stock</p>
                                    </div>
                                    <div class="ltr:ml-auto rtl:mr-auto my-auto">
                                        <span class="px-2 py-1 badge bg-black/20 text-white rounded-sm text-xs">Untill Mar
                                            9th
                                            2023</span>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="box shadow-none">
                            <div class="box-header">
                                <h5 class="box-title">Caractéristiques</h5>
                            </div>
                            <div class="box-body space-y-4">

                                <div class="flex space-x-3 rtl:space-x-reverse">
                                    <h5 class="font-normal text-gray-500 dark:text-white/70 text-sm my-auto w-28">
                                        Transmission :
                                    </h5>
                                    <p class="font-medium text-sm">{{ Str::upper($car->transmission) }}</p>
                                </div>
                                <div class="flex space-x-3 rtl:space-x-reverse">
                                    <h5 class="font-normal text-gray-500 dark:text-white/70 text-sm my-auto w-28">Type de
                                        carburant
                                        :</h5>
                                    <p class="font-medium text-sm">{{ Str::upper($car->type_carburant) }}</p>
                                </div>
                                <div class="sm:flex sm:space-x-3">
                                    <h5 class="font-normal text-gray-500 dark:text-white/70 text-sm my-auto w-28">
                                        Kilométrage
                                        :</h5>
                                    <p class="font-medium text-sm">{{ $car->kilometrage }} KM</p>
                                </div>

                                <div class="sm:flex sm:space-x-3 product-des">
                                    <h5 class="font-bold text-sm my-auto w-28 text-gray-800 dark:text-white">Capacité :
                                    </h5>
                                    <p class="font-medium text-sm">{{ $car->nombre_places }} places</p>
                                </div>

                                <div class="sm:flex sm:space-x-3 product-des">
                                    <h5 class="font-bold text-sm my-auto w-28 text-gray-800 dark:text-white">Nombre de
                                        Portes :
                                    </h5>
                                    <p class="font-medium text-sm">{{ $car->nombre_portes }} </p>
                                </div>

                                <p class="font-medium text-sm">Ajouté le
                                    {{ \Carbon\Carbon::parse($car->created_at)->locale('fr')->translatedFormat('d F Y H:i:s') }}
                                </p>
                                <div>
                                    <a href="{{ url('/backend/car/edit/' . $car->id) }}"
                                        class="w-full ti-btn ti-btn-primary">Modifier</a>
                                    <a href="{{ url('/backend/car/etat/' . $car->id) }}"
                                        class="w-full ti-btn ti-btn-outline ti-btn-outline-primary">Etat</a>
                                    <a href="{{ url('/backend/car/picture/' . $car->id) }}"
                                        class="w-full ti-btn ti-btn-outline ti-btn-outline-primary">Images</a>

                                    <button data-hs-overlay="#hs-basic-modal"
                                        class="w-full ti-btn ti-btn-outline ti-btn-outline-danger">Panne</button>

                                    <button data-hs-overlay="#cardModalDelete"
                                        class="w-full ti-btn ti-btn-outline ti-btn-danger">Supprimer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End::row-1 -->

    <div id="cardModalDelete" class="hs-overlay ti-modal hidden">
        <div class="ti-modal-box">
            <div class="ti-modal-content">
                <div class="ti-modal-header">
                    <h3 class="ti-modal-title">
                        Supprimer un véhicule
                    </h3>
                    <button type="button" class="hs-dropdown-toggle ti-modal-clode-btn"
                        data-hs-overlay="#cardModalDelete">
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
                        Êtes-vous sûr de vouloir supprimer ce véhicule : {{ $car->name }} ?
                    </p>
                </div>
                <div class="ti-modal-footer">
                    <form action="{{ url('backend/car/update/' . $car->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="delete" value="true" />
                        <button type="button"
                            class="hs-dropdown-toggle ti-btn ti-border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:ring-offset-white focus:ring-primary dark:bg-bgdark dark:hover:bg-black/20 dark:border-white/10 dark:text-white/70 dark:hover:text-white dark:focus:ring-offset-white/10"
                            data-hs-overlay="#cardModalView">
                            Fermer
                        </button>
                        <button type="submit" class="ti-btn ti-btn-danger">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="hs-basic-modal" class="hs-overlay ti-modal hidden">
        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out lg:!max-w-4xl lg:w-full m-3 lg:!mx-auto">
                    <div class="ti-modal-content">
                <form id="panne-form" action="{{ url('backend/panne/assign/' . $car->id) }}" method="POST">
                    @csrf
                    <div class="ti-modal-header">
                        <h3 class="ti-modal-title">
                            Ajouter une panne
                        </h3>
                        <button type="button" class="hs-dropdown-toggle ti-modal-close-btn"
                            data-hs-overlay="#hs-basic-modal">
                            <span class="sr-only">Fermer</span>
                            <i class="ri-close-line"></i>
                        </button>
                    </div>
                    <div class="ti-modal-body">
                        <div id="panne-container">
                            @foreach ($car->pannes as $pn)
                                <div class="flex items-center space-x-4 mb-3 panne-row" data-id="{{ $pn->id }}">
                                    <div class="flex-1">
                                        <label class="ti-form-select-label">Pannes</label>
                                        <select class="ti-form-select" name="pannes[]" autocomplete="off">
                                            @foreach ($pannes as $panne)
                                                <option value="{{ $panne->id }}"
                                                    {{ $pn->panne_id == $panne->id ? 'selected' : '' }}>
                                                    {{ $panne->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex-1">
                                        <label class="ti-form-label">Statut</label>
                                        <input type="text" name="status[]" value="{{ $pn->status }}"
                                            class="ti-form-input">
                                        <select class="ti-form-select" name="pannes[]" autocomplete="off">
                                                <option value="initie"
                                                    {{ $pn->status = 'initie' ? 'selected' : '' }}>
                                                    Initie
                                                </option>
                                                <option value="en cours"
                                                    {{ $pn->status = 'en cours' ? 'selected' : '' }}>
                                                    En cours
                                                </option>
                                                <option value="traite"
                                                    {{ $pn->status = 'traite' ? 'selected' : '' }}>
                                                    Traité
                                                </option>
                                                <option value="abandonne"
                                                    {{ $pn->status = 'abandonne' ? 'selected' : '' }}>
                                                    Abandonnée
                                                </option>
                                        </select>
                                    </div>
                                    <div class="flex-1">
                                        <label class="ti-form-label">Montant</label>
                                        <input type="number" name="montant[]" value="{{ $pn->montant }}"
                                            class="ti-form-input">
                                    </div>
                                    <div class="flex-shrink-0">
                                        <br><br>
                                        <button type="button" class="ti-btn ti-btn-outline ti-btn-danger delete-row"
                                            data-id="{{ $pn->id }}">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <div class="flex items-end space-x-4 mb-3 panne-row">
                            <div class="flex-1">
                                <label class="ti-form-select-label">Pannes</label>
                                <select class="ti-form-select" name="pannes[]" autocomplete="off">
                                    @foreach ($pannes as $panne)
                                        <option value="{{ $panne->id }}">{{ $panne->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex-1">
                                <label class="ti-form-label">Statut</label>
                                <select class="ti-form-select" name="pannes[]" autocomplete="off">
                                    <option value="initie">
                                        Initie
                                    </option>
                                    <option value="en cours">
                                        En cours
                                    </option>
                                    <option value="traite">
                                        Traité
                                    </option>
                                    <option value="abandonnee">
                                        Abandonnée
                                    </option>
                                </select>
                            </div>
                            <div class="flex-1">
                                <label class="ti-form-label">Montant</label>
                                <input type="number" name="montant[]" class="ti-form-input">
                            </div>
                            <div class="flex-shrink-0 pt-3">
                                <button type="button" class="ti-btn ti-btn-outline ti-btn-danger delete-row">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex justify-end mt-3">
                            <button type="button" id="add-row" class="ti-btn ti-btn-success">
                                +
                            </button>
                        </div>
                    </div>
                    <div class="ti-modal-footer">
                        <button type="button"
                            class="ti-btn ti-border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:ring-offset-white focus:ring-primary"
                            data-hs-overlay="#hs-basic-modal">
                            Annuler
                        </button>
                        <button class="ti-btn ti-btn-primary" type="submit">
                            Valider
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.tailwindcss.js"></script>

    <!-- Swiper JS -->
    <script src="{{ asset('back/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Choices JS -->
    <script src="{{ asset('back/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    <!-- Rating JS -->
    <script src="{{ asset('back/libs/rater-js/index.js') }}"></script>

    <!-- Products JS -->
    <script src="{{ asset('back/js/product.js') }}"></script>

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
                order: [
                    [0, 'desc']
                ],
                serverSide: true,
                searching: true,
                ajax: "{{ route('backend.ajax.cars') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'category_id',
                        name: 'category_id',
                        render: function(data, type, row) {
                            // Customize this function to generate content for your custom column
                            return row.categorie ? row.categorie.name : '';
                        },
                    },
                    {
                        data: 'name',
                        name: 'name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'marque_id',
                        name: 'marque_id',
                        render: function(data, type, row) {
                            // Customize this function to generate content for your custom column
                            return row.marque.name;
                            return formatAmount(row.price_estimate_low) + ' FCFA';
                        },
                    },
                    {
                        data: 'modele',
                        name: 'modele',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'annee',
                        name: 'annee',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'immatriculation',
                        name: 'immatriculation',
                        orderable: false,
                        searchable: true,

                    },
                    {
                        data: 'prix_location',
                        name: 'prix_location',
                        render: function(data, type, row) {
                            // Customize this function to generate content for your custom column
                            return formatAmount(row.prix_location) + ' FCFA';
                        },
                    },
                    {
                        targets: -1,
                        data: 'null',
                        name: 'customColumn',
                        render: function(data, type, row) {
                            return `<a href="{{ url('backend/car/view/') }}/` + row.id + `" >
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

            $('#hs-basic-modal').click( function() {
                console.log('Button clicked');
                // Votre code ici
            })

        });

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

        $(document).on('click', '#hs-basic-modal #add-row', function() {
            console.log('Button clicked');
            // Votre code ici
        });

        $('#hs-basic-modal').click( function() {
            console.log('Button clicked');
            // Votre code ici
        });

        {{--$(document).ready(function() {--}}
        {{--    const panneContainer = document.getElementById('panne-container');--}}

        {{--    $('#add-row').click(() => {--}}
        {{--        console.log('dedans')--}}
        {{--        const row = `--}}
        {{--                        <div class="flex items-center space-x-4 mb-3 panne-row">--}}
        {{--                            <div class="flex-1">--}}
        {{--                                <label class="ti-form-select-label">Pannes</label>--}}
        {{--                                <select class="ti-form-select" name="pannes[]" autocomplete="off">--}}
        {{--                                    @foreach ($pannes as $panne)--}}
        {{--                                    <option value="{{ $panne->id }}">{{ $panne->name }}</option>--}}
        {{--                                                                @endforeach--}}
        {{--                                    </select>--}}
        {{--                                </div>--}}
        {{--                                <div class="flex-1">--}}
        {{--                                    <label class="ti-form-label">Statut</label>--}}
        {{--                                    <input type="text" name="status[]" class="ti-form-input">--}}
        {{--                                </div>--}}
        {{--                                <div class="flex-1">--}}
        {{--                                    <label class="ti-form-label">Montant</label>--}}
        {{--                                    <input type="number" name="montant[]" class="ti-form-input">--}}
        {{--                                </div>--}}
        {{--                                <div class="flex-shrink-0">--}}
        {{--                                    <button type="button" class="ti-btn ti-btn-outline ti-btn-danger delete-row">--}}
        {{--                                        <i class="ri-delete-bin-line"></i>--}}
        {{--                                    </button>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                    `;--}}
        {{--        panneContainer.insertAdjacentHTML('beforeend', row);--}}
        {{--    });--}}

        {{--});--}}
        document.addEventListener('DOMContentLoaded', () => {
            {{--const panneContainer = document.getElementById('panne-container');--}}

            {{--// Ajouter une nouvelle ligne dynamiquement--}}
            {{--document.getElementById('add-row').addEventListener('click', () => {--}}
            {{--    const row = `--}}
            {{--                    <div class="flex items-center space-x-4 mb-3 panne-row">--}}
            {{--                        <div class="flex-1">--}}
            {{--                            <label class="ti-form-select-label">Pannes</label>--}}
            {{--                            <select class="ti-form-select" name="pannes[]" autocomplete="off">--}}
            {{--                                @foreach ($pannes as $panne)--}}
            {{--                                    <option value="{{ $panne->id }}">{{ $panne->name }}</option>--}}
            {{--                                @endforeach--}}
            {{--                            </select>--}}
            {{--                        </div>--}}
            {{--                        <div class="flex-1">--}}
            {{--                            <label class="ti-form-label">Statut</label>--}}
            {{--                            <input type="text" name="status[]" class="ti-form-input">--}}
            {{--                        </div>--}}
            {{--                        <div class="flex-1">--}}
            {{--                            <label class="ti-form-label">Montant</label>--}}
            {{--                            <input type="number" name="montant[]" class="ti-form-input">--}}
            {{--                        </div>--}}
            {{--                        <div class="flex-shrink-0">--}}
            {{--                            <button type="button" class="ti-btn ti-btn-outline ti-btn-danger delete-row">--}}
            {{--                                <i class="ri-delete-bin-line"></i>--}}
            {{--                            </button>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                `;--}}
            {{--    panneContainer.insertAdjacentHTML('beforeend', row);--}}
            {{--});--}}

            {{--// Supprimer une ligne dynamiquement--}}
            {{--panneContainer.addEventListener('click', (e) => {--}}
            {{--    if (e.target.closest('.delete-row')) {--}}
            {{--        const row = e.target.closest('.panne-row');--}}
            {{--        const panneId = row.dataset.id;--}}

            {{--        if (panneId) {--}}
            {{--            // Requête Ajax pour supprimer--}}
            {{--            fetch(`{{ url('backend/panne/delete') }}/${panneId}`, {--}}
            {{--                    method: 'DELETE',--}}
            {{--                    headers: {--}}
            {{--                        'X-CSRF-TOKEN': '{{ csrf_token() }}',--}}
            {{--                    },--}}
            {{--                })--}}
            {{--                .then((response) => response.json())--}}
            {{--                .then((data) => {--}}
            {{--                    if (data.success) {--}}
            {{--                        row.remove();--}}
            {{--                    } else {--}}
            {{--                        alert('Erreur lors de la suppression');--}}
            {{--                    }--}}
            {{--                });--}}
            {{--        } else {--}}
            {{--            row.remove();--}}
            {{--        }--}}
            {{--    }--}}
            {{--});--}}
        });
    </script>
@endpush
