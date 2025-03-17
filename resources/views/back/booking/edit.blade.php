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
            <h3 class="text-gray-700 hover:text-gray-900 dark:text-white dark:hover:text-white text-2xl font-medium">
                Modifier une Location #{{ $booking->code_contrat }}</h3>
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
    <div class="grid grid-cols-12 gap-x-6">
        <div class="col-span-12">
            <div class="box !bg-transparent border-0 shadow-none">
                <form method="post" action="{{ route('backend.booking.details.view', ['reference' => $reference]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body p-0">
                        <div class="grid grid-cols-12 gap-x-6">
                            <div class="col-span-12 xl:col-span-6">
                                <div class="box ">
                                    <div class="box-body">
                                        <h5 class="box-title leading-none flex my-5"><i class="ri ri-shield-user-line ltr:mr-2 rtl:ml-2"></i> Client Information</h5>
                                        <div class="space-y-3">
                                            <div class="space-y-2">
                                                <label class="ti-form-label mb-0">Client</label>
                                                <select class="my-auto ti-form-select" name="client_id" id="client_id">
                                                    <option value="">-- Choisissez un Client --</option>
                                                    <!-- Ajoutez dynamiquement les années si besoin -->
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}" @if($booking->client_associe->id == $user->id) selected @endif>{{ $user->first_name }} {{ $user->last_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="space-y-2">
                                                <label class="ti-form-label mb-0">Noms</label>
                                                <input type="text" name="name" class="my-auto ti-form-input"
                                                    placeholder="John" value="{{ old('name') ?? $booking->client_associe->first_name }}" required>
                                            </div>
                                            <div class="space-y-2">
                                                <label class="ti-form-label mb-0">Prenoms</label>
                                                <input type="text" name="surname" class="my-auto ti-form-input"
                                                    placeholder="Doe" value="{{ old('surname') ?? $booking->client_associe->last_name }}" required>
                                            </div>
                                            <div class="space-y-2">
                                                <label for="input-phone" class="ti-form-label">Téléphone</label>
                                                <input type="tel" name="phone" id="phone" class="ti-form-input" value="{{ old('phone') ?? $booking->client_associe->phone }}" required>
                                                <input id="phone_code" type="hidden" name="phone_code"  value="{{ old('phone_code') ?? $booking->client_associe->phone_code }}"/>
                                            </div>
                                            <div class="space-y-2">
                                                <label class="ti-form-label mb-0">Email</label>
                                                <input type="text" name="email" class="my-auto ti-form-input"
                                                       placeholder="johndoe@gmail.com" value="{{ old('email') ?? $booking->client_associe->email }}" required>
                                            </div>
                                            <div class="grid grid-cols-12 gap-4">
                                                <div class="col-span-12 lg:col-span-6">
                                                    <div class="space-y-2 product-1">
                                                        <label class="ti-form-label mb-0">Adresse</label>
                                                        <input type="text" name="adresse" class="my-auto ti-form-input"
                                                               placeholder="Centre Medico" value="{{ old('adresse') ?? $booking->client_associe->adresse }}" required>
{{--                                                        <select name="category_id" class="ti-form-select" required>--}}
{{--                                                               <option>Choisissez</option>--}}
{{--                                                            @foreach ($categories as $item)--}}
{{--                                                                <option value="{{ $item->id }}"--}}
{{--                                                                    {{ old('category_id') == $item->id ? 'selected' : '' }}>--}}
{{--                                                                    {{ $item->name }}--}}
{{--                                                                </option>--}}
{{--                                                            @endforeach--}}
{{--                                                        </select>--}}
                                                    </div>
                                                </div>
                                                <div class="col-span-12 lg:col-span-6">
                                                    <div class="space-y-2  product-1">
                                                        <label class="ti-form-label mb-0">Boite Postale</label>
                                                        <input type="text" name="bp" class="my-auto ti-form-input"
                                                               placeholder="2376 rue de Cointet" value="{{ old('bp') ?? $booking->client_associe->bp }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-12 gap-4">
                                                <div class="col-span-12 lg:col-span-6">
                                                    <div class="space-y-2 product-1">
                                                        <label class="ti-form-label mb-0">Piece Identite</label>
                                                        <select name="piece" class="ti-form-select" required>
                                                            <option value="permis">Permis de conduire</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-span-12 lg:col-span-6">
                                                    <div class="space-y-2  product-1">
                                                        <label class="ti-form-label mb-0">Numero Piece</label>
                                                        <input type="text" name="npiece" class="my-auto ti-form-input"
                                                               placeholder="23098IE" value="{{ old('npiece') ?? $booking->client_associe->numero_piece }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="space-y-2">
                                                <label class="ti-form-label">Image de La Piece</label>
                                                <input type="file" class="filepond basic-filepond" name="thumb" data-allow-reorder="true" data-max-file-size="2MB" data-max-files="1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-12 xl:col-span-6">
                                <div class="box">
                                    <div class="box-body space-y-3">
                                        <h5 class="box-title leading-none flex"><i class="ri ri-shield-user-line ltr:mr-2 rtl:ml-2"></i> Vehicule Informations</h5>
                                        <div class="grid grid-cols-12 gap-4 mb-5">

                                            <div class="col-span-12 lg:col-span-12">
                                               <div class="space-y-2  product-1">
                                                    <label class="ti-form-label mb-0">Voiture</label>
                                                    <select class="my-auto ti-form-select" name="vehicule" id="voiture_select" required>
                                                        <option value="" disabled>Choisissez une voiture </option>
                                                        <!-- Ajoutez dynamiquement les années si besoin -->
                                                        @foreach($cars as $car)
                                                            <option value="{{ $car->id }}" @if($booking->vehicule->id == $car->id) selected @endif data-value="{{ $car->prix_location }}">{{ $car->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="space-y-2  product-1">
                                                    <label class="ti-form-label mb-0">Date de Location</label>

                                                    <input type="text" value="{{ old('date_debut') ?? $booking->date_heure_debut }}"
                                                           class="ti-form-input ltr:rounded-l-none rtl:rounded-r-none focus:z-10 flatpickr-input"
                                                           id="limitdatetime" name="date_debut" placeholder="Choississez une date" readonly>
                                                </div>
                                            </div>

                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="space-y-2  product-1">
                                                    <label class="ti-form-label mb-0">Date de Retour</label>

                                                    <input type="text" value="{{ old('date_retour') ?? $booking->date_heure_fin }}"
                                                           class="ti-form-input ltr:rounded-l-none rtl:rounded-r-none focus:z-10 flatpickr-input"
                                                           id="limitdatetimes" name="date_retour" placeholder="Choississez une date" readonly>

                                                    <input type="hidden" name="jours" value="0" id="jours">
                                                </div>
                                            </div>

                                            <div class="col-span-12 lg:col-span-12">
                                                <div class="space-y-2  product-1">
                                                    <label class="ti-form-label mb-0">Type de Location</label>
                                                    <select name="type_loca" class="ti-form-select product-search"
                                                        required>
                                                        <option value="courte"
                                                            {{ old('type_loca') == 'courte' ? 'selected' : '' }}
                                                            @selected($booking->type_location == 'courte')
                                                        >
                                                            Courte</option>
                                                        <option value="longue"
                                                            {{ old('type_loca') == 'longue' ? 'selected' : '' }}
                                                            @selected($booking->type_location == 'longue')
                                                        >
                                                            Longue</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="space-y-2">
                                                    <label class="ti-form-label mb-0">Livraison ? </label>
                                                    <div class="grid sm:grid-cols-2 gap-2">
                                                        <label class="flex p-3 w-full bg-white border border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70">
                                                            <span class="text-sm text-gray-500 dark:text-white/70">Oui</span>
                                                            <input type="radio" value="true" name="livraison" class="ti-form-radio pointer-events-none ltr:ml-auto rtl:mr-auto" id="livraisonOn" @checked($booking->livraison == 1)>
                                                        </label>

                                                        <label class="flex p-3 w-full bg-white border border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70">
                                                            <span class="text-sm text-gray-500 dark:text-white/70">Non</span>
                                                            <input type="radio" value="false" name="livraison" class="ti-form-radio pointer-events-none ltr:ml-auto rtl:mr-auto" id="livraisonOff" @checked($booking->livraison == 0)>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="space-y-2">
                                                    <label class="ti-form-label mb-0">Commission ? </label>
                                                    <div class="grid sm:grid-cols-2 gap-2">
                                                        <label class="flex p-3 w-full bg-white border border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70">
                                                            <span class="text-sm text-gray-500 dark:text-white/70">Oui</span>
                                                            <input type="radio" value="true" name="comission" class="ti-form-radio pointer-events-none ltr:ml-auto rtl:mr-auto" id="comissionOn" @checked($booking->comission == 1)>
                                                        </label>

                                                        <label class="flex p-3 w-full bg-white border border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70">
                                                            <span class="text-sm text-gray-500 dark:text-white/70">Non</span>
                                                            <input type="radio" value="false" name="comission" class="ti-form-radio pointer-events-none ltr:ml-auto rtl:mr-auto" id="comissionOff" @checked($booking->comission == 0)>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="space-y-2">
                                                    <label class="ti-form-label">Etats Vehicule Avant Location</label>
                                                    <select name="etat_avant" class="ti-form-select" id="panne_select" required >
                                                        <option disabled selected>Choisissez</option>
                                                    </select>
                                                    <p class="text-sm text-gray-500 mt-2 dark:text-white/70 tett">Ajouter un etat si pas disponible</p>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="space-y-2">
                                                    <label class="ti-form-label">Etats Vehicule Apres Location</label>
                                                    <select name="etat_apres" class="ti-form-select" id="panne_selects" required >
                                                        <option disabled selected>Choisissez</option>
                                                    </select>
                                                </div>
                                                <p class="text-sm text-gray-500 mt-2 dark:text-white/70 tett" id="hs-input-helper-text">Ajouter un etat si pas disponible</p>
                                            </div>

                                        </div>
                                        <br>
                                        <h5 class="box-title leading-none flex my-7"><i class="ri ri-shield-user-line ltr:mr-2 rtl:ml-2"></i> Paiement Information</h5>
                                        <div class="grid grid-cols-12 gap-4">

                                            <div class="col-span-12 lg:col-span-12">
                                                <div class="space-y-2  product-1">
                                                    <label class="ti-form-label mb-0">Methode de paiement</label>
                                                    <select class="my-auto ti-form-select" name="method_paie" required>
                                                        <option value="" disabled selected>Choisissez une methode de paiement </option>
                                                        <option value="cash" @selected($booking->paiement_associe->methode_paiement == 'cash')>Cash</option>
                                                        <option value="mobile money" @selected($booking->paiement_associe->methode_paiement == 'mobile money')>Mobile Money</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="space-y-2  product-1">
                                                    <label class="ti-form-label mb-0">Montant à payer</label>
                                                    <div class="relative">
                                                        <input type="text" name="mntant_a_payer"
                                                               value="{{ old('mntant_a_payer') ?? $booking->paiement_associe->montant_total }}"
                                                               class="ti-form-input ltr:pl-9 ltr:pr-16 rtl:pr-9 rtl:pl-16 focus:z-10"
                                                               placeholder="10000" required>
                                                        <div
                                                            class="absolute inset-y-0 ltr:left-0 rtl:right-0 flex items-center pointer-events-none z-20 ltr:pl-4 rtl:pr-4">
                                                            <span class="text-gray-500 dark:text-white/70"></span>
                                                        </div>
                                                        <div
                                                            class="absolute inset-y-0 ltr:right-0 rtl:left-0 flex items-center pointer-events-none z-20 ltr:pr-4 rtl:pl-4">
                                                            <span class="text-gray-500 dark:text-white/70">F CFA</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="space-y-2  product-1">
                                                    <label class="ti-form-label mb-0">Montant payé</label>
                                                    <div class="relative">
                                                        <input type="text" name="mntant_paye"
                                                               value="{{ old('mntant_paye') ?? $booking->paiement_associe->montant_paye }}"
                                                               class="ti-form-input ltr:pl-9 ltr:pr-16 rtl:pr-9 rtl:pl-16 focus:z-10"
                                                               placeholder="10000" required>
                                                        <div
                                                            class="absolute inset-y-0 ltr:left-0 rtl:right-0 flex items-center pointer-events-none z-20 ltr:pl-4 rtl:pr-4">
                                                            <span class="text-gray-500 dark:text-white/70"></span>
                                                        </div>
                                                        <div
                                                            class="absolute inset-y-0 ltr:right-0 rtl:left-0 flex items-center pointer-events-none z-20 ltr:pr-4 rtl:pl-4">
                                                            <span class="text-gray-500 dark:text-white/70">F CFA</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="space-y-2  product-1">
                                                    <label class="ti-form-label mb-0">Reste à payer</label>
                                                    <div class="relative">
                                                        <input type="text" name="montant_restant"
                                                               value="{{ old('montant_restant') }}"
                                                               class="ti-form-input ltr:pl-9 ltr:pr-16 rtl:pr-9 rtl:pl-16 focus:z-10"
                                                               placeholder="10000" required readonly>
                                                        <div
                                                            class="absolute inset-y-0 ltr:left-0 rtl:right-0 flex items-center pointer-events-none z-20 ltr:pl-4 rtl:pr-4">
                                                            <span class="text-gray-500 dark:text-white/70"></span>
                                                        </div>
                                                        <div
                                                            class="absolute inset-y-0 ltr:right-0 rtl:left-0 flex items-center pointer-events-none z-20 ltr:pr-4 rtl:pl-4">
                                                            <span class="text-gray-500 dark:text-white/70">F CFA</span>
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
                    <div class="box-footer text-end border-t-0 px-0">

                        <button type="submit" class="ti-btn ti-btn-primary"><i
                                class="ri-add-line"></i>Enregistrer</button>

                        <button type="reset" class="ti-btn ti-btn-danger"><i
                                class="ri-delete-bin-line"></i>Annuler</button>

                    </div>
                </form>
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



            //     $('#voiture_select').on('change', function() {
            //         var voitureId = $(this).val();
            //         car_id = voitureId
            //         $('#panne_select').empty();
            //
            //         prixLocation = $('option:selected', this).data('value');
            //
            //         if(voitureId) {
            //             $.ajax({
            //                 url: '/public/backend/booking/car/pannes/' + voitureId + '/ajax',
            //                 type: 'GET',
            //                 dataType: 'json',
            //                 success: function(data) {
            //                     $('#panne_select').append('<option value="">Sélectionnez un etat</option>');
            //
            //                     $.each(data, function(key, panne) {
            //                         var dateObj = new Date(panne.date);
            //                         var formattedDate = formatDate(dateObj);
            //
            //                         $('#panne_select').append('<option value="' + panne.id + '"> Etat du ' + formattedDate + '</option>');
            //                     });
            //
            //                     $('.tett').each(function(index) {
            //                         // Créer un lien
            //                         var lien = $('<a>', {
            //                             href: '/public/backend/car/etat/' + voitureId,
            //                             text: 'ICI',
            //                             class: 'lien-ajouter-etat text-success',
            //                             'data-index': index
            //                         });
            //
            //                         $(this).empty().append(
            //                             'Ajouter un état si pas disponible ',
            //                             lien
            //                         );
            //                     });
            //
            //                     $('#panne_select').prop('disabled', false);
            //
            //                 },
            //                 error: function(xhr, status, error) {
            //                     console.error('Erreur lors du chargement des pannes:', error);
            //                 }
            //             });
            //         } else {
            //             $('#panne_select').prop('disabled', true);
            //             $('#panne_select').append('<option value="">Sélectionnez d\'abord une voiture</option>');
            //         }
            //     });
            // });

            function updateDependentSelect() {
                // Récupérer la valeur sélectionnée
                var voitureId = $("#voiture_select").val();
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
            }

            // Appeler la fonction au chargement de la page
            updateDependentSelect();

            // Appeler la fonction à chaque changement du select source
            $("#voiture_select").on("change", updateDependentSelect);

        });

        // Écouter le changement sur le select client_id
        $('#client_id').change(function() {
            // Récupérer l'ID du client sélectionné
            var clientId = $(this).val();

            // Vérifier si un client a été sélectionné
            if (clientId !== '') {
                // Envoi de la requête AJAX
                $.ajax({
                    url: '/public/backend/user/detail/' + clientId,
                    type: 'GET',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        data = data.user[0]
                        // Remplir les champs avec les données reçues
                        $('input[name="name"]').val(data.last_name || '');
                        $('input[name="surname"]').val(data.first_name || '');
                        $('input[name="phone"]').val(data.phone || '');
                        $('input[name="phone_code"]').val(data.phone_code || '');
                        $('input[name="email"]').val(data.email || '');
                        $('input[name="adresse"]').val(data.adresse || '');
                        $('input[name="bp"]').val(data.bp || '');
                        $('input[name="npiece"]').val(data.numero_piece || '');

                    },
                    error: function(xhr, status, error) {
                        console.error('Erreur lors de la récupération des données:', error);
                        alert('Impossible de récupérer les informations du client. Veuillez réessayer.');
                    }
                });
            } else {
                // Réinitialiser le formulaire si aucun client n'est sélectionné
                resetForm();
            }
        });

        // Fonction pour réinitialiser le formulaire
        function resetForm() {
            $('input[name="name"]').val('');
            $('input[name="surname"]').val('');
            $('input[name="phone"]').val('');
            $('input[name="phone_code"]').val('');
            $('input[name="email"]').val('');
            $('input[name="adresse"]').val('');
            $('input[name="bp"]').val('');
            $('input[name="npiece"]').val('');
        }



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
