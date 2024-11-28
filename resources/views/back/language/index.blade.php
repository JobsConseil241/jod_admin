@extends('layout.back')

@inject('Lang', 'App\Services\LanguageService')

@push('styles')
    <link href="{{ asset('back/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar py-5 py-lg-5" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column me-3">
                <!--begin::Title-->
                <h1 class="d-flex text-dark fw-bold my-1 fs-3">{{ $Lang->trans('langue') }}</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-600">
                        <a href="{{ route('dashboard') }}"
                            class="text-gray-600 text-hover-primary">{{ $Lang->trans('dashboard') }}</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-600">{{ $Lang->trans('parametres') }}</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-500">{{ $Lang->trans('langue') }}</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center py-2 py-md-1">

            </div>
            <!--end::Actions-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Container-->
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->
        <div class="content flex-row-fluid" id="kt_content">

            @include('layout.alert')

            <!--begin::Card-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header mt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1 me-5">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-filter="search"
                                class="form-control form-control-solid w-250px ps-14"
                                placeholder="{{ $Lang->trans('recherche') }}" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        @hasPrivilige('CREATE_SETTING')
                            <!--begin::Button-->
                            <button type="button" class="btn btn-light-primary" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_add_permission">
                                <i class="ki-duotone ki-plus-square fs-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>{{ $Lang->trans('ajouter') }}</button>
                            <!--end::Button-->
                        @endHasPrivilige
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-50px">{{ $Lang->trans('app') }}</th>
                                <th class="min-w-125px">{{ $Lang->trans('key') }}</th>
                                <th class="min-w-200px">{{ $Lang->trans('fr') }}</th>
                                <th class="min-w-200px">{{ $Lang->trans('en') }}</th>
                                @hasPrivilige('UPDATE_SETTING')
                                    <th class="text-end min-w-100px">Actions</th>
                                @endHasPrivilige
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @foreach ($languages as $lang)
                                <tr>

                                    <td>{{ $lang->app }}</td>
                                    <td>{{ $lang->key }}</td>
                                    <td>{{ $lang->fr }}</td>
                                    <td>{{ $lang->en }}</td>
                                    @hasPrivilige('UPDATE_SETTING')
                                        <td class="text-end">
                                            <button type="button"
                                                class="btn btn-icon btn-active-light-info w-30px h-30px me-3 btn-edit"
                                                data-bs-toggle="modal" data-key="{{ $lang->key }}"
                                                data-bs-target="#kt_modal_update_permission" data-bs-placement="top"
                                                title="Modifier">
                                                <i class="ki-duotone ki-setting-3 fs-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                </i>
                                            </button>
                                            <button type="button"
                                                class="btn btn-icon btn-active-light-danger w-30px h-30px btn-delete"
                                                data-bs-toggle="modal" data-key="{{ $lang->key }}"
                                                data-bs-target="#kt_modal_update_permission" data-bs-placement="top"
                                                title="Supprimer">
                                                <i class="ki-duotone ki-trash fs-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                </i>
                                            </button>
                                        </td>
                                    @endHasPrivilige
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
            <!--begin::Modals-->

            @hasPrivilige('CREATE_SETTING')
                <!--begin::Modal - Add permissions-->
                <div class="modal fade" id="kt_modal_add_permission" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">{{ $Lang->trans('ajouter_traduction') }}</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                            class="path2"></span></i>
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--end::Modal header-->

                            <!--begin::Modal body-->
                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                <!--begin::Form-->
                                <form id="kt_modal_add_permission_form" class="form"
                                    action="{{ route('backend.store.language') }}" method="POST">
                                    @csrf

                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ $Lang->trans('app') }}</span>
                                            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover"
                                                data-bs-html="true" data-bs-content="Plateforme de la langue">
                                                <i class="ki-duotone ki-information fs-7">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select class="form-control form-control-solid" name="app">
                                            <option value="WEB">WEB</option>
                                            <option value="MOB">MOBILE</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ $Lang->trans('key') }}</span>
                                            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover"
                                                data-bs-html="true" data-bs-content="la clé est unique">
                                                <i class="ki-duotone ki-information fs-7">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid" placeholder="Entrer la clé"
                                            name="key" required />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->



                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ $Lang->trans('fr') }}</span>
                                            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover"
                                                data-bs-html="true" data-bs-content="la valeur de la clé">
                                                <i class="ki-duotone ki-information fs-7">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <textarea class="form-control form-control-solid" name="fr" required></textarea>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">{{ $Lang->trans('en') }}</span>
                                            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover"
                                                data-bs-html="true" data-bs-content="la valeur de la clé">
                                                <i class="ki-duotone ki-information fs-7">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <textarea class="form-control form-control-solid" name="en" required></textarea>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Actions-->
                                    <div class="text-center pt-15">
                                        <button type="submit" class="btn btn-primary">
                                            <span class="indicator-label">{{ $Lang->trans('soumettre') }}</span>
                                            <span class="indicator-progress">{{ $Lang->trans('patienter') }}...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Modal body-->
                        </div>
                        <!--end::Modal content-->
                    </div>
                    <!--end::Modal dialog-->
                </div>
                <!--end::Modal - Add permissions-->
            @endHasPrivilige

            @hasPrivilige('UPDATE_SETTING')
                <!--begin::Modal - Update permissions-->
                <div class="modal fade" id="kt_modal_update_permission" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">{{ $Lang->trans('modifier') }}</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                            class="path2"></span></i>
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--end::Modal header-->

                            <!--begin::Modal body-->
                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7"></div>
                            <!--end::Modal body-->

                        </div>
                        <!--end::Modal content-->
                    </div>
                    <!--end::Modal dialog-->
                </div>
                <!--end::Modal - Update permissions-->
            @endHasPrivilige

            <!--end::Modals-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Container-->
@endsection

@push('scripts')
    <script src="{{ asset('js/custom/apps/user-management/permissions/list.js') }}"></script>
    <script src="{{ asset('js/custom/apps/user-management/permissions/update-permission.js') }}"></script>

    <script src="{{ asset('back/plugins/custom/datatables/datatables.bundle.js') }}"></script>

    <script>
        "use strict";

        var KTDatatablesExample = function() {
            // Shared variables
            var table;
            var datatable;

            // Private functions
            var initDatatable = function() {
                // Set date data order

                // Init datatable --- more info on datatables: https://datatables.net/manual/
                datatable = $(table).DataTable({
                    language: {
                        'url': "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
                    },
                    processing: true,
                    order: [
                        [0, 'desc']
                    ],
                    searching: true,
                });
            }

            // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
            var handleSearchDatatable = () => {
                const filterSearch = document.querySelector('[data-kt-filter="search"]');
                filterSearch.addEventListener('keyup', function(e) {
                    datatable.search(e.target.value).draw();
                });
            }


            // Public methods
            return {
                init: function() {
                    table = document.querySelector('#kt_permissions_table');

                    if (!table) {
                        return;
                    }

                    initDatatable();
                    handleSearchDatatable();
                }
            };
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            KTDatatablesExample.init();
        });

        $(document).on("click", ".btn-edit", function() {
            var key = $(this).data('key');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('backend.edit.language') }}",
                dataType: 'json',
                data: {
                    "key": key,
                    "action": "edit",
                },
                success: function(data) {
                    //get data value params
                    var body = data.body;
                    //dynamic title
                    $('#kt_modal_update_permission .modal-body').html(body); //url to delete item
                    $('#kt_modal_update_permission').modal('show');
                }
            });

        });

        $(document).on("click", ".btn-delete", function() {
            var key = $(this).data('key');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('backend.edit.language') }}",
                dataType: 'json',
                data: {
                    "key": key,
                    "action": "delete",
                },
                success: function(data) {
                    //get data value params
                    var body = data.body;
                    //dynamic title
                    $('#kt_modal_update_permission .modal-body').html(body); //url to delete item
                    $('#kt_modal_update_permission').modal('show');
                }
            });

        });
    </script>
@endpush
