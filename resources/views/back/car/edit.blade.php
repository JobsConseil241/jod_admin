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
                Modifier un véhicule : {{ $car->name }}</h3>
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
    <div class="grid grid-cols-12 gap-x-6">
        <div class="col-span-12">
            <div class="box !bg-transparent border-0 shadow-none">
                <form method="post" action="{{ url('backend/car/update/' . $car->id) }}">
                    @csrf
                    <div class="box-body p-0">
                        <div class="grid grid-cols-12 gap-x-6">
                            <div class="col-span-12 xl:col-span-6">
                                <div class="box ">
                                    <div class="box-body">
                                        <div class="space-y-3">
                                            <div class="space-y-2">
                                                <label class="ti-form-label mb-0">Nom</label>
                                                <input type="text" name="name" class="my-auto ti-form-input"
                                                    placeholder="Toyota" value="{{ $car->name }}" required>
                                            </div>
                                            <div class="space-y-2">
                                                <label class="ti-form-label mb-0">Modèle</label>
                                                <input type="text" name="modele" class="my-auto ti-form-input"
                                                    placeholder="Yaris" value="{{ $car->modele }}" required>
                                            </div>

                                            <div class="grid grid-cols-12 gap-4">
                                                <div class="col-span-12 lg:col-span-6">
                                                    <div class="space-y-2 product-1">
                                                        <label class="ti-form-label mb-0">Catégorie</label>
                                                        <select name="category_id" class="ti-form-select" required>
                                                            <option>Choisissez</option>
                                                            @foreach ($categories as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $car->category_id == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-span-12 lg:col-span-6">
                                                    <div class="space-y-2  product-1">
                                                        <label class="ti-form-label mb-0">Marque</label>
                                                        <select name="marque_id" class="ti-form-select" required>
                                                            <option>Choisissez</option>
                                                            @foreach ($marques as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $car->marque_id == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-span-12 lg:col-span-12">
                                                    <div class="space-y-2  product-1">
                                                        <label class="ti-form-label mb-0">Fournisseurs</label>
                                                        <select name="supplier_id" class="ti-form-select" required>
                                                            <option selected readonly>Choisissez</option>
                                                            @foreach ($suppliers as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $car->fournisseur_id == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->first_name }} {{ $item->last_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="space-y-2">
                                                <label class="ti-form-label">Note Additionnelle</label>
                                                <textarea name="note" class="ti-form-input" rows="2">{{ $car->note }}</textarea>
                                                <label
                                                    class="ti-form-label mt-1 text-sm font-normal opacity-70 text-gray-500 dark:text-white/70 mb-0">*500
                                                    caractères maximum.</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-6">
                                <div class="box">
                                    <div class="box-body space-y-3">
                                        <div class="grid grid-cols-12 gap-4">

                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="space-y-2  product-1">
                                                    <label class="ti-form-label mb-0">Année</label>
                                                    <select class="my-auto ti-form-select" name="annee" required>
                                                        <option value="" disabled selected>Choisissez une année
                                                        </option>
                                                        <!-- Ajoutez dynamiquement les années si besoin -->
                                                        @for ($year = date('Y'); $year >= 1990; $year--)
                                                            <option value="{{ $year }}"
                                                                {{ $car->annee == $year ? 'selected' : '' }}>
                                                                {{ $year }}</option>
                                                        @endfor
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="space-y-2  product-1">
                                                    <label class="ti-form-label mb-0">Immatriculation</label>
                                                    <input name="immatriculation" type="text"
                                                        class="my-auto ti-form-input" placeholder="AA111BB"
                                                        value="{{ $car->immatriculation }}" required>
                                                </div>
                                            </div>

                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="space-y-2  product-1">
                                                    <label class="ti-form-label mb-0">Type de carburant</label>
                                                    <select name="type_carburant" class="ti-form-select product-search"
                                                        required>
                                                        <option value="essence"
                                                            {{ $car->type_carburant == 'essence' ? 'selected' : '' }}>
                                                            Essence
                                                        </option>
                                                        <option value="diesel"
                                                            {{ $car->type_carburant == 'diesel' ? 'selected' : '' }}>
                                                            Diesel</option>
                                                        <option value="hybride"
                                                            {{ $car->type_carburant == 'hybride' ? 'selected' : '' }}>
                                                            Hybride</option>
                                                        <option value="électrique"
                                                            {{ $car->type_carburant == 'électrique' ? 'selected' : '' }}>
                                                            Électrique</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="space-y-2  product-1">
                                                    <label class="ti-form-label mb-0">Transmission</label>
                                                    <select name="transmission" class="ti-form-select product-search"
                                                        required>
                                                        <option value="automatique"
                                                            {{ $car->transmission == 'automatique' ? 'selected' : '' }}>
                                                            Automatique</option>
                                                        <option value="manuelle"
                                                            {{ $car->transmission == 'manuelle' ? 'selected' : '' }}>
                                                            Manuelle</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="space-y-2">
                                                    <label class="ti-form-label mb-0">Kilométrage </label>
                                                    <div class="relative">
                                                        <input type="text" id="hs-input-with-leading-and-trailing-icon"
                                                            name="kilometrage" value="{{ $car->kilometrage }}"
                                                            class="ti-form-input ltr:pl-9 ltr:pr-16 rtl:pr-9 rtl:pl-16 focus:z-10"
                                                            placeholder="1000" required>
                                                        <div
                                                            class="absolute inset-y-0 ltr:left-0 rtl:right-0 flex items-center pointer-events-none z-20 ltr:pl-4 rtl:pr-4">
                                                            <span class="text-gray-500 dark:text-white/70"></span>
                                                        </div>
                                                        <div
                                                            class="absolute inset-y-0 ltr:right-0 rtl:left-0 flex items-center pointer-events-none z-20 ltr:pr-4 rtl:pl-4">
                                                            <span class="text-gray-500 dark:text-white/70">KM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="space-y-2">
                                                    <label class="ti-form-label mb-0">Nombre de place </label>
                                                    <input type="number" name="nombre_places"
                                                        class="my-auto ti-form-input" value="{{ $car->nombre_places }}"
                                                        placeholder="4" required>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="space-y-2">
                                                    <label class="ti-form-label mb-0">Nombre de porte</label>
                                                    <input type="number" name="nombre_portes"
                                                        class="my-auto ti-form-input" value="{{ $car->nombre_portes }}"
                                                        placeholder="4" required>
                                                </div>
                                            </div>

                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="space-y-2">
                                                    <label class="ti-form-label">Prix</label>
                                                    <div class="relative">
                                                        <input type="text" name="prix_location"
                                                            value="{{ $car->prix_location }}"
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

                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="space-y-2">
                                                    <label class="ti-form-label">Couleur</label>
                                                    <select name="couleur" class="ti-form-select product-search" required>
                                                        <option>Choisissez</option>
                                                        <option value="bleu"
                                                            {{ $car->couleur == 'bleu' ? 'selected' : '' }}>Bleu</option>
                                                        <option value="noir"
                                                            {{ $car->couleur == 'noir' ? 'selected' : '' }}>Noir</option>
                                                        <option value="rouge"
                                                            {{ $car->couleur == 'rouge' ? 'selected' : '' }}>Rouge
                                                        </option>
                                                        <option value="vert"
                                                            {{ $car->couleur == 'vert' ? 'selected' : '' }}>Vert</option>
                                                        <option value="blanc"
                                                            {{ $car->couleur == 'blanc' ? 'selected' : '' }}>Blanc
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="space-y-2  product-1">
                                                    <label class="ti-form-label mb-0">Nom de l'Assurance</label>
                                                    <input type="text" name="assurance_nom"
                                                        class="my-auto ti-form-input" value="{{ $car->assurance_nom }}"
                                                        placeholder="SUNU" required>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="space-y-2  product-1">
                                                    <label class="ti-form-label mb-0">date d'expiration de
                                                        l'assurance</label>
                                                    <input type="date" name="assurance_date_expi"
                                                        class="my-auto ti-form-input" min="<?= date('Y-m-d') ?>"
                                                        value="{{ $car->assurance_date_expi }}" required>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer text-end border-t-0 px-0">

                        <button type="submit" class="ti-btn ti-btn-primary"><i class="ri-edit-line"></i>Valider</button>

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
    <!-- Quill Editor JS -->
    <script src="{{ asset('back/libs/quill/quill.min.js') }}"></script>

    <!-- Choices JS -->
    <script src="{{ asset('back/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    <!-- Filepond JS -->
    <script src="{{ asset('back/libs/filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('back/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
    <script
        src="{{ asset('back/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}">
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

        $(document).ready(function() {
            $("#data").DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
                },
                order: [
                    [0, 'desc']
                ],
                searching: true
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
