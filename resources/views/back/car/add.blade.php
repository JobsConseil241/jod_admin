@extends('layouts.back')

@push('styles')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.tailwindcss.css" />

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
                Ajouter un véhicule</h3>
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
                Véhicules
            </li>
        </ol>
    </div>
    <!-- Page Header Close -->

    @include('layouts.alert')

    <!-- Start::row-1 -->
    <div class="grid grid-cols-12 gap-x-6">
        <div class="col-span-12">
            <div class="box !bg-transparent border-0 shadow-none">
                <div class="box-body p-0">
                    <div class="grid grid-cols-12 gap-x-6">
                        <div class="col-span-12 xl:col-span-6">
                            <div class="box ">
                                <div class="box-body">
                                    <div class="space-y-3">
                                        <div class="space-y-2">
                                            <label class="ti-form-label mb-0">Product Title</label>
                                            <input type="text" class="my-auto ti-form-input"
                                                placeholder="Dolar Leather Handbag For Women">
                                        </div>
                                        <div class="space-y-2">
                                            <label class="ti-form-label mb-0">Product Id</label>
                                            <input type="text" class="my-auto ti-form-input" placeholder="#2515445145">
                                        </div>
                                        <div class="">
                                            <label class="ti-form-label">Product Description</label>
                                            <div id="product-editor"></div>
                                        </div>
                                        <div class="space-y-2">
                                            <label class="ti-form-label">Product Features</label>
                                            <textarea class="ti-form-input" rows="2"></textarea>
                                            <label
                                                class="ti-form-label mt-1 text-sm font-normal opacity-70 text-gray-500 dark:text-white/70 mb-0">*Description
                                                should not exceed 500 letters</label>
                                        </div>
                                        <div class="grid grid-cols-12 gap-4">
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="space-y-2 product-1">
                                                    <label class="ti-form-label mb-0">Product Status</label>
                                                    <select class="ti-form-select product-search">
                                                        <option value="">Status</option>
                                                        <option value="Clothing">Publish</option>
                                                        <option value="Footwear">Unpublish</option>
                                                        <option value="Accesories">Schedule</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="space-y-2  product-1">
                                                    <label class="ti-form-label mb-0">Product Visibility</label>
                                                    <select class="ti-form-select product-search">
                                                        <option value="">Visibility</option>
                                                        <option value="1">Private</option>
                                                        <option value="2">Public</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-6">
                            <div class="box">
                                <div class="box-body space-y-3">
                                    <div class="grid grid-cols-12 gap-4">
                                        <div class="col-span-12 lg:col-span-4">
                                            <div class="space-y-2 product-1">
                                                <label class="ti-form-label mb-0">Product Category</label>
                                                <select class="ti-form-select product-search">
                                                    <option value="">Category</option>
                                                    <option value="Clothing">Clothing</option>
                                                    <option value="Footwear">Footwear</option>
                                                    <option value="Accesories">Accesories</option>
                                                    <option value="Grooming">Grooming</option>
                                                    <option value="Ethnic &amp; Festive">Ethnic &amp; Festive</option>
                                                    <option value="Jewellery">Jewellery</option>
                                                    <option value="Toys &amp; Babycare">Toys &amp; Babycare</option>
                                                    <option value="Festive Gifts">Festive Gifts</option>
                                                    <option value="Kitchen">Kitchen</option>
                                                    <option value="Dining">Dining</option>
                                                    <option value="Home Decors">Home Decors</option>
                                                    <option value="Stationery">Stationery</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-span-12 lg:col-span-4">
                                            <div class="space-y-2  product-1">
                                                <label class="ti-form-label mb-0">Gender</label>
                                                <select class="ti-form-select product-search">
                                                    <option value="">Gender</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                    <option value="3">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-span-12 lg:col-span-4">
                                            <div class="space-y-2  product-1">
                                                <label class="ti-form-label mb-0">Brand</label>
                                                <select class="ti-form-select product-search">
                                                    <option value="">Select</option>
                                                    <option value="Armani">Armani</option>
                                                    <option value="Lacoste">Lacoste</option>
                                                    <option value="Puma">Puma</option>
                                                    <option value="Spykar">Spykar</option>
                                                    <option value="Mufti">Mufti</option>
                                                    <option value="Home Town">Home Town</option>
                                                    <option value="Arrabi">Arrabi</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-span-12 lg:col-span-6">
                                            <div class="space-y-2  product-1">
                                                <label class="ti-form-label mb-0">Published Date and Time</label>
                                                <input type="text" class="ti-form-input focus:z-10 flatpickr-input"
                                                    id="product-datetime" placeholder="Choose date" readonly>
                                            </div>
                                        </div>
                                        <div class="col-span-12 lg:col-span-6">
                                            <div class="space-y-2  product-1">
                                                <label class="ti-form-label mb-0">Product Size</label>
                                                <select class="ti-form-select product-search">
                                                    <option value="Extra Small">Extra Small</option>
                                                    <option value="Small">Small</option>
                                                    <option value="Medium">Medium</option>
                                                    <option value="Large">Large</option>
                                                    <option value="XL">XL</option>
                                                    <option value="xxl">xxl</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-span-12 lg:col-span-4">
                                            <div class="space-y-2">
                                                <label class="ti-form-label mb-0">Actual Price </label>
                                                <input type="text" class="my-auto ti-form-input" placeholder="$550">
                                            </div>
                                        </div>
                                        <div class="col-span-12 lg:col-span-4">
                                            <div class="space-y-2">
                                                <label class="ti-form-label mb-0">Dealer Price </label>
                                                <input type="text" class="my-auto ti-form-input" placeholder="$400">
                                            </div>
                                        </div>
                                        <div class="col-span-12 lg:col-span-4">
                                            <div class="space-y-2">
                                                <label class="ti-form-label mb-0">Discount</label>
                                                <input type="text" class="my-auto ti-form-input" placeholder="10%">
                                            </div>
                                        </div>
                                        <div class="col-span-12 lg:col-span-6">
                                            <div class="space-y-2">
                                                <label class="ti-form-label">Available Colors</label>
                                                <select class="ti-form-select product-search">
                                                    <option value="">Colors</option>
                                                    <option value="1">blue</option>
                                                    <option value="2">pink</option>
                                                    <option value="3">yellow</option>
                                                    <option value="4">orange</option>
                                                    <option value="5">lemon-green</option>
                                                    <option value="6">green</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-span-12 lg:col-span-6">
                                            <div class="space-y-2  product-1">
                                                <label class="ti-form-label mb-0">Availabilty</label>
                                                <select class="ti-form-select product-search">
                                                    <option value="">Availabilty</option>
                                                    <option value="1">Instock</option>
                                                    <option value="2">Out Of Stock</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-span-12 lg:col-span-6">
                                            <div class="space-y-2  product-1">
                                                <label class="ti-form-label mb-0">Type</label>
                                                <input type="text" class="my-auto ti-form-input"
                                                    placeholder="Hand Bag">
                                            </div>
                                        </div>
                                        <div class="col-span-12 lg:col-span-6">
                                            <div class="space-y-2  product-1">
                                                <label class="ti-form-label mb-0">Item Weight</label>
                                                <input type="text" class="my-auto ti-form-input"
                                                    placeholder="250grams">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="flex justify-between ti-form-label">
                                            <span class="my-auto">Product Images</span></label>
                                        <input type="file" class="filepond multiple-filepond" name="filepond" multiple
                                            data-allow-reorder="true" data-max-file-size="3MB" data-max-files="5">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="ti-form-label">Product Tags</label>
                                        <input class="ti-form-input product-tags custom class" id="product-tags"
                                            type="text" value="water-resistant, spacious ,5 pockets ,office bag"
                                            placeholder="This is a placeholder">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer text-end border-t-0 px-0">
                    <a class="ti-btn ti-btn-primary"><i class="ri-add-line"></i>Add Product</a>
                    <a class="ti-btn ti-btn-secondary"><i class="ri-file-download-line"></i>Save Product</a>
                    <a class="ti-btn ti-btn-danger"><i class="ri-delete-bin-line"></i>Discard Product</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End::row-1 -->
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.tailwindcss.js"></script>

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
