@extends('layout.back')

@php
    $user = Auth::user();
    $user->load(['roles', 'order_budget_treshold', 'offer_amount_treshold']);
@endphp

@inject('Lang', 'App\Services\LanguageService')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <style>
        .iti {
            width: 100%;
        }
    </style>
@endpush

@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar py-5 py-lg-5" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column me-3">
                <!--begin::Title-->
                <h1 class="d-flex text-dark fw-bold my-1 fs-3">{{ $Lang->trans('profil') }}</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-600">
                        <a href="{{ route('home') }}"
                            class="text-gray-600 text-hover-primary">{{ $Lang->trans('dashboard') }}</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-gray-600">{{ $Lang->trans('profil') }}</li>
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

            <!--begin::Navbar-->
            <div class="card mb-5 mb-xl-10">
                <div class="card-body pt-9 pb-0">
                    <!--begin::Details-->
                    <div class="d-flex flex-wrap flex-sm-nowrap">
                        <!--begin: Pic-->
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                <img src="{{ asset('back/media/avatars/blank.png') }}" alt="image" />
                                <div
                                    class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                                </div>
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--begin::User-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="#"
                                            class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $user['first_name'] . ' ' . $user['last_name'] }}</a>
                                        <a href="#">
                                            <i class="ki-duotone ki-verify fs-1 text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </a>
                                    </div>
                                    <!--end::Name-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                            <i class="ki-duotone ki-profile-circle fs-4 me-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>{{ $user['roles']->first()['name'] }}</a>

                                        <a href="#"
                                            class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                            <i class="ki-duotone ki-sms fs-4">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>{{ $user->email }}</a>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                                <!--begin::Actions-->
                                <div class="d-flex my-4">

                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Title-->

                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Details-->
                    <!--begin::Navs-->
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                        <!--begin::Nav item-->
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 active"
                                href="#">{{ $Lang->trans('profil') }}</a>
                        </li>
                        <!--end::Nav item-->
                    </ul>
                    <!--begin::Navs-->
                </div>
            </div>
            <!--end::Navbar-->
            <!--begin::details View-->
            <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                <!--begin::Card header-->
                <div class="card-header cursor-pointer">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">{{ $Lang->trans('details_profil') }}</h3>
                    </div>
                    <!--end::Card title-->
                    <!--begin::Action-->
                    <a href="#" class="btn btn-sm btn-primary align-self-center" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_edit_user">{{ $Lang->trans('modifier_profil') }}</a>
                    <!--end::Action-->
                </div>
                <!--begin::Card header-->
                <!--begin::Card body-->
                <div class="card-body p-9">
                    <!--begin::Row-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-semibold text-muted">{{ $Lang->trans('nom_complet') }}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <span
                                class="fw-bold fs-6 text-gray-800">{{ $user['first_name'] . ' ' . $user['last_name'] }}</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->

                    <!--begin::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-semibold text-muted">{{ $Lang->trans('telephone') }}
                            <span class="ms-1" data-bs-toggle="tooltip" title="Phone number must be active">
                                <i class="ki-duotone ki-information fs-7">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span></label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 d-flex align-items-center">
                            <span class="fw-bold fs-6 text-gray-800 me-2">{{ $user['phone_code'] }}
                                {{ $user['phone'] }}</span>
                            <span class="badge badge-success">Vérifié</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-semibold text-muted">{{ $Lang->trans('email') }}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <a href="#" class="fw-bold fs-6 text-gray-800 text-hover-primary">{{ $user->email }}</a>
                            <span class="badge badge-success">Vérifié</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="row mb-10">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-semibold text-muted">{{ $Lang->trans('role') }}</label>
                        <!--begin::Label-->
                        <!--begin::Label-->
                        <div class="col-lg-8">
                            <span
                                class="fw-bold fs-6 text-gray-800">{{ $user['roles']->first()['name'] ?? 'Aucun' }}</span>
                        </div>
                        <!--begin::Label-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="row mb-10">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-semibold text-muted">{{ $Lang->trans('palier_commande') }}</label>
                        <!--begin::Label-->
                        <!--begin::Label-->
                        <div class="col-lg-8">
                            <span
                                class="fw-bold fs-6 text-gray-800">{{ $user->order_budget_treshold ? App\Http\Controllers\Controller::format_amount($user->order_budget_treshold['amount']) . ' FCFA' : 'Aucun' }}</span>
                        </div>
                        <!--begin::Label-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="row mb-10">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-semibold text-muted">{{ $Lang->trans('palier_offre') }}</label>
                        <!--begin::Label-->
                        <!--begin::Label-->
                        <div class="col-lg-8">
                            <span
                                class="fw-bold fs-6 text-gray-800">{{ $user->offer_amount_treshold ? App\Http\Controllers\Controller::format_amount($user->offer_amount_treshold['amount']) . ' FCFA' : 'Aucun' }}</span>
                        </div>
                        <!--begin::Label-->
                    </div>
                    <!--end::Input group-->

                </div>
                <!--end::Card body-->
            </div>
            <!--end::details View-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Container-->

    <!--begin::Modal - edit profil-->
    <div class="modal fade" id="kt_modal_edit_user" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_user_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">{{ $Lang->trans('modifier_profil') }}</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body px-5 my-7">
                    <!--begin::Form-->
                    <form id="kt_modal_edit_user_form" class="form" action="{{ url('backend/profil/update/') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll"
                            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#kt_modal_add_user_header"
                            data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fw-semibold fs-6 mb-2">{{ $Lang->trans('prenom') }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="firstname" value="{{ $user['first_name'] }}"
                                    class="form-control form-control-solid mb-3 mb-lg-0" disabled />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">{{ $Lang->trans('nom') }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="lastname" value="{{ $user['last_name'] }}"
                                    class="form-control form-control-solid mb-3 mb-lg-0" disabled />
                                <!--end::Input-->
                            </div>
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">{{ $Lang->trans('email') }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0"
                                    value="{{ $user->email }}" required />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">{{ $Lang->trans('telephone') }}</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="tel" id="phone" name="phone" value="{{ $user['phone'] }}"
                                    class="form-control form-control-solid mb-3 mb-lg-0" required />
                                <input id="phone_code" type="hidden" name="phone_code"
                                    value="{{ $user['phone_code'] }}" />
                                <!--end::Input-->
                            </div>



                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-10">
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">{{ $Lang->trans('soumettre') }}</span>
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
    <!--end::Modal - edit task-->
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
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
    </script>
@endpush
