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
    </style>
@endpush

@inject('Lang', 'App\Services\LanguageService')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ $Lang->trans('users') }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $Lang->trans('management_user') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $Lang->trans('users') }}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    @include('layouts.alert')

    <div class="row pb-4 gy-3">
        <div class="col-sm-4">
        </div>

        <div class="col-sm-auto ms-auto">
            <div class="d-flex gap-3">
                <a href="#" data-bs-toggle="modal" data-bs-target="#cardModalAdd"
                    class="btn btn-primary addtax-modal"><i class="las la-plus me-1"></i>{{ $Lang->trans('add_user') }}</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ $Lang->trans('list_users') }}</h5>
                </div>
                <div class="card-body">
                    <table id="data" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">{{ $Lang->trans('id') }}</th>
                                <th>{{ $Lang->trans('name') }}</th>
                                <th>{{ $Lang->trans('email') }}</th>
                                <th>{{ $Lang->trans('phone') }}</th>
                                <th>{{ $Lang->trans('role') }}</th>
                                <th>{{ $Lang->trans('actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        <img src="assets/images/users/avatar-1.jpg" alt=""
                                            class="avatar-xs rounded-circle me-2">
                                        {{ $user->first_name . ' ' . $user->last_name }}
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone_code . ' ' . $user->phone }}</td>
                                    <td>{{ $user->roles[0]->name ?? 'Aucun' }}</td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item edit-item-btn edit_action"
                                                        data-id="{{ $user->id }}"><i
                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        {{ $Lang->trans('edit') }}</a></li>
                                                <li><a class="dropdown-item edit-item-btn 2fa_action"
                                                        data-id="{{ $user->id }}"><i
                                                            class="ri-reload align-bottom me-2 text-muted"></i>
                                                        {{ $Lang->trans('reset_2fa') }}</a></li>
                                                <li>
                                                    <a class="dropdown-item remove-item-btn delete_action"
                                                        data-id="{{ $user->id }}">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                        {{ $Lang->trans('delete') }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->

    <div class="modal fade" id="cardModalAdd" tabindex="-1" role="dialog" aria-labelledby="cardModalAdd"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelOne">{{ $Lang->trans('add_user') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('backend/user/create') }}" method="POST">
                        @csrf


                        <div class="mb-3">
                            <label for="name" class="col-form-label">{{ $Lang->trans('first_name') }}</label>
                            <input type="text" class="form-control" name="first_name">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="col-form-label">{{ $Lang->trans('last_name') }}</label>
                            <input type="text" class="form-control" name="last_name">
                        </div>

                        <div>
                            <label for="name" class="col-form-label">{{ $Lang->trans('phone') }}</label>
                            <input type="tel" id="phone" name="phone"
                                class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="{{ $Lang->trans('phone') }}" />
                            <input id="phone_code" type="hidden" name="phone_code" />
                        </div>

                        <div class="mb-3">
                            <label for="user_type_id" class="col-form-label">{{ $Lang->trans('role') }}</label>
                            <select id="selectOne" class="form-control" name="role_id">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark"
                        data-bs-dismiss="modal">{{ $Lang->trans('close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ $Lang->trans('save') }}</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="cardModalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelOne"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
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

        $(document).ready(function() {
            $("#data").DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
                },
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
                    $('#kt_modal_edit_user .modal-content').html(body); //url to delete item
                    $('#kt_modal_edit_user').modal('show');
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
                    $('#kt_modal_edit_user .modal-content').html(body); //url to delete item
                    $('#kt_modal_edit_user').modal('show');
                }
            });
        });
    </script>
@endpush
