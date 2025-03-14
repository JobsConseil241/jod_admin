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
                Paiements</h3>
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
                Paiements
            </li>
        </ol>
    </div>
    <!-- Page Header Close -->

    @include('layouts.alert')

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="box-header">
                    <h5 class="box-title">Liste des Paiements</h5>
                    <div class="flex justify-end">
                        <a href="{{ route('backend.booking.add') }}">
                            <button type="button" class="ti-btn ti-btn-primary">
                                Ajouter un Paiement
                            </button>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <table id="data" class="table table-bordered dt-responsive nowrap table-striped align-middle w-full divide-y divide-gray-200 shadow-sm border-gray-200 border rounded"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">ID</th>
                                <th>Reference</th>
                                <th>Methode Paiement</th>
                                <th>Total</th>
                                <th>Paye</th>
                                <th>Restant</th>
                                <th>Statut</th>
                                <th>Location</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
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
                ajax: "{{ route('backend.paiements.ajax') }}",
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'reference',
                        name: 'reference',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            // Customize this function to generate content for your custom column
                            return `<span class="font-bold">`+ data +`</span>`;
                        },
                    },
                    {
                        data: 'methode_paiement',
                        name: 'methode_paiement',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'montant_total',
                        name: 'montant_total',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            // Customize this function to generate content for your custom column
                            return `<span class="font-bold text-primary">`+ data +` FCFA</span>`;
                        },
                    },
                    {
                        data: 'montant_paye',
                        name: 'montant_paye',
                        render: function(data, type, row) {
                            // Customize this function to generate content for your custom column
                            return `<span class="font-bold text-info">`+ data +` FCFA</span>`;
                        },
                    },
                    {
                        data: 'montant_restant',
                        name: 'montant_restant',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            // Customize this function to generate content for your custom column
                            return `<span class="font-bold text-danger">`+ data +` FCFA</span>`;
                        },
                    },
                    {
                        data: 'statut',
                        name: 'statut',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            // Customize this function to generate content for your custom column
                            if (data == 0) {
                                return `<span class="font-bold text-warning">En Cours</span>`;
                            }else {
                                return `<span class="font-bold text-success"> Solde</span>`;
                            }

                        },
                    },
                    {
                        data: 'location',
                        name: 'location',
                        render: function(data, type, row) {
                            // Customize this function to generate content for your custom column
                            return `<a href="{{ url('backend/booking/detail/') }}/` + row.location + `" >
                                       <button type="button" class="ti-btn ti-btn-soft-primary btn-sm">
                                            <i class="ti ti-eye align-bottom me-2"></i> Consuler
                                        </button>
                                    </a>`;
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
    </script>
@endpush
