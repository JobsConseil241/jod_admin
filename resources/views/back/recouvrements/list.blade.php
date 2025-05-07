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
                Recouvrements</h3>
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
                Recouvrements
            </li>
        </ol>
    </div>
    <!-- Page Header Close -->

    @include('layouts.alert')

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="box-header">
                    <h5 class="box-title">Liste des Recouvrements</h5>
                    <div class="flex justify-end">
                        <a href="{{ route('backend.booking.add') }}">
                            <button type="button" class="ti-btn ti-btn-primary">
                                Ajouter un Recouvrement
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
                                <th>Montant Du</th>
                                <th>Montant Recouvre</th>
                                <th>date echeance</th>
                                <th>date recouvrement</th>
                                <th>statut</th>
                                <th>Location</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div id="cardModalEdit" class="hs-overlay ti-modal hidden" aria-overlay="true" tabindex="-1">
                <div class="ti-modal-box">
                    <div class="ti-modal-content">
                        <form action="{{ route('recouvrement.update') }}" method="POST">
                            @csrf
                            <div class="ti-modal-header">
                                <h3 class="ti-modal-title">
                                    Mise à Jour du recouvrement <span class="id_value"></span>
                                </h3>
                                <button type="button" class="hs-dropdown-toggle ti-modal-clode-btn"
                                        data-hs-overlay="#cardModalEdit">
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
                                    <label class="ti-form-label mb-0" id="montant_re">Montant Recouvré</label>
                                    <input type="text" name="montant_re" id="montant_re" class="ti-form-input" readonly inputmode="numeric" >
                                    <input type="text" name="id_paiement" id="id_paiement" class="ti-form-input" readonly>
                                </div>
                            </div>
                            <div class="ti-modal-footer">
                                <button type="button"
                                        class="hs-dropdown-toggle ti-btn ti-border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:ring-offset-white focus:ring-primary dark:bg-bgdark dark:hover:bg-black/20 dark:border-white/10 dark:text-white/70 dark:hover:text-white dark:focus:ring-offset-white/10"
                                        data-hs-overlay="#cardModalEdit">
                                    Annuler
                                </button>
                                <button class="ti-btn ti-btn-primary" type="submit">
                                    Mettre a jour
                                </button>
                            </div>
                        </form>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        "use strict";

        function formatAmount(amount) {
            return amount.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        }

        $(document).ready(function() {
            const iconSvg = `<svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"></path>
                              </svg>`;


            const table = document.getElementById('data');

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
                ajax: "{{ route('backend.recouvrement.ajax') }}",
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'montant_du',
                        name: 'montant_du',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            // Customize this function to generate content for your custom column
                            return `<span class="font-bold text-warning">`+ data +` FCFA</span>`;
                        },
                    },
                    {
                        data: 'montant_recouvre',
                        name: 'montant_recouvre',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            // Customize this function to generate content for your custom column
                            return `<span class="font-bold">`+ data +` FCFA</span>`;
                        },
                    },
                    {
                        data: 'date_echeance',
                        name: 'date_echeance',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            // Customize this function to generate content for your custom column
                            return `<span class="font-bold text-danger">`+ data +`</span>`;
                        },
                    },
                    {
                        data: 'date_recouvrement',
                        name: 'date_recouvrement',
                        render: function(data, type, row) {
                            // Customize this function to generate content for your custom column
                            return `<span class="font-bold text-info">`+ data +`</span>`;
                        },
                    },
                    {
                        data: 'statut',
                        name: 'statut',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            // Customize this function to generate content for your custom column
                            if (data == 'en_attente') {
                                return `<span class="font-bold text-danger">En Attente</span>`;
                            }else if(data == 'partiellement_recouvre') {
                                return `<span class="font-bold text-warning"> Partiellement</span>`;
                            }else if(data == 'recouvre') {
                                return `<span class="font-bold text-success"> Recouvré </span>`;
                            }
                        },
                    },
                    {
                        data: 'location',
                        name: 'location',
                        render: function(data, type, row) {
                            // Customize this function to generate content for your custom column
                            return `<a href="{{ url('backend/booking/detail/') }}/` + row.location.code_contrat + `" >
                                       <button type="button" class="ti-btn ti-btn-soft-primary btn-sm">
                                            <i class="ti ti-eye align-bottom me-2"></i> Consulter
                                        </button>
                                    </a>`;
                        },
                    },
                    {
                        targets: -1,
                        data: 'null',
                        name: 'customColumn',
                        render: function(data, type, row) {
                            return `<button type="button" class="ti-btn ti-btn-soft-primary  w-8 h-8 ti-btn rounded-full p-0 transition-none focus:outline-none ti-btn-soft-secondary edit-btn">
                                        <i class="ti ti-pencil"></i>
                                    </button>
                                    <button type="button" class="ti-btn ti-btn-soft-danger  w-8 h-8 rounded-full p-0 transition-none focus:outline-none ti-btn-soft-danger delete-record">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                    `;

                        },
                        orderable: false,
                        searchable: false
                    }

                ]
            })


            $('#data').on('click', '.edit-btn', function() {
                var row = $(this).closest('tr');
                var rowData = $('#data').DataTable().row(row).data();

                // Now, you can use the rowData for editing

                // Example: Open a modal to edit the row's data
                $("#montant_re").val(rowData.montant_du);
                $("#id_paiement").val(rowData.paiement_id);

                $("#montant_re").on('input', function() {
                    // Récupérer la valeur et supprimer tout ce qui n'est pas un chiffre
                    let valeur = $(this).val().replace(/\D/g, '');

                    // Convertir en nombre entier
                    let montant = parseInt(valeur, 10);

                    // Vérifier si c'est un nombre valide
                    if (!isNaN(montant)) {
                        // Limiter au montant maximum
                        if (montant > rowData.montant_du) {
                            montant = rowData.montant_du;
                            // Optionnel: afficher un message
                            alert("Le montant ne peut pas dépasser " + rowData.montant_du);
                        }

                        // Mettre à jour la valeur dans l'input
                        $(this).val(montant);
                    } else if (valeur === '') {
                        // Si l'input est vide, laisser le champ vide
                        $(this).val('');
                    } else {
                        // Si ce n'est pas un nombre valide, mettre 0 ou laisser vide
                        $(this).val('0');
                    }
                });
                    // if (typeof HSOverlay !== 'undefined') {
                    //     HSOverlay.open('#cardModalEdit');
                    // } else {
                    //     $('#cardModalEdit').addClass('show');
                    //     $('#cardModalEdit').removeClass('hidden');
                    // }

                    const modal = document.getElementById('cardModalEdit');
                    if (window.HSOverlay) {
                        window.HSOverlay.open(modal);
                        console.log(rowData);
                    } else {
                        console.log(modal);
                        modal.classList.add('open');
                        modal.setAttribute('aria-overlay', 'true');
                        document.body.classList.add('overflow-hidden');
                    }

                    // $('#cardModalEdit').removeClass('hidden').addClass('flex');

                    // Populate the modal with rowData for editing
                });


            $('#data').on('click', '.delete-record', function() {
                var row = $(this).closest('tr');
                var rowData = $('#data').DataTable().row(row).data();

                // Now, you can use the rowData for editing
                // console.log("Edit data:", rowData);
                // console.log($(this).closest('tr'));

                Swal.fire({
                    showCancelButton: true,
                    buttonsStyling: false,
                    icon: 'warning',
                    iconHtml: iconSvg,
                    customClass: {
                        popup: "!relative !transform !overflow-hidden !rounded-lg !bg-white !text-left !shadow-xl !transition-all sm:!my-8 sm:!w-full sm:!max-w-lg !p-0 !grid-cols-none",
                        icon: '!m-0 !mx-auto !flex !h-12 !w-12 !flex-shrink-0 !items-center !justify-center !rounded-full !border-0 !bg-red-100 sm:!h-10 sm:!w-10 !mt-5 sm!mt-6 sm:!ml-6 !col-start-1 !col-end-3 sm:!col-end-2',
                        title: "!p-0 !pt-3 !text-center sm:!text-left !text-base !font-semibold !leading-6 !text-gray-900 !pl-4 !pr-4 sm:!pr-6 sm:!pl-0 sm:!pt-6 sm:!ml-4 !col-start-1 sm:!col-start-2 !col-end-3",
                        htmlContainer: "!mt-2 sm:!mt-0 !m-0 !text-center sm:!text-left !text-sm !text-gray-500 !pl-4 sm:!pl-0 !pr-4 !pb-4 sm:!pr-6 sm:!pb-4 sm:!ml-4 !col-start-1 sm:!col-start-2 !col-end-3",
                        actions: "!bg-gray-50 !px-4 !py-3 sm:!flex sm:!flex-row-reverse sm:!px-6 !w-full !justify-start !mt-0 !col-start-1 !col-end-3",
                        confirmButton: "inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto",
                        cancelButton: "mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto",
                    },
                    title: "Deactivate account",
                    text: "Are you sure you want to deactivate your account? All of your data will be permanently removed. This action cannot be undone.",
                    confirmButtonText: "Deactivate",
                    cancelButtonText: "Cancel",
                });
                // window.location.replace("/dashboard/faq-manage/"+rowData.id+"/reponses" );
                // Populate the modal with rowData for editing
            });

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
