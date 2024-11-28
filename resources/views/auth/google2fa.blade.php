@extends('layouts.auth')

@inject('Lang', 'App\Services\LanguageService')

@section('content')
    <div class="p-lg-5 p-4">
        <div class="text-center">
            <h5 class="mb-0">{{ $Lang->trans('Welcom') }}</h5>
            <p class="text-muted mt-2">{{ $Lang->trans('google_2fa') }}</p>
        </div>

        <div class="mt-4">
            <div class="timeline">
                <!--begin::Timeline item-->
                <div class="timeline-item">
                    <!--begin::Timeline line-->
                    <div class="timeline-line w-40px"></div>
                    <!--end::Timeline line-->
                    <!--begin::Timeline icon-->
                    <div class="timeline-icon symbol symbol-circle symbol-40px me-4">
                        <div class="symbol-label bg-light">
                            1
                        </div>
                    </div>
                    <!--end::Timeline icon-->
                    <!--begin::Timeline content-->
                    <div class="timeline-content mb-10 mt-n1">
                        <!--begin::Timeline heading-->
                        <div class="pe-3 mb-5">
                            <!--begin::Title-->
                            <div class="fs-5 fw-semibold mb-2">Téléchargez l'application Google
                                authenticator sur les stores : </div>
                            <!--end::Title-->

                        </div>
                        <!--end::Timeline heading-->
                        <!--begin::Timeline details-->
                        <div class="overflow-auto pb-5">
                            <!--begin::Record-->
                            <div
                                class="d-flex align-items-center border border-dashed border-gray-300 rounded px-7 py-3 mb-5">
                                <!--begin::Title-->
                                <a href="https://apps.apple.com/au/app/google-authenticator/id388497605"
                                    class="fs-5 text-dark text-hover-primary fw-semibold m-5" target="_blank">
                                    <img style="margin-right: 10px;" src="{{ asset('front/img/appstore.png') }}"
                                        class="h-50px" alt="App Store">
                                </a>
                                <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en&pli=1"
                                    class="fs-5 text-dark text-hover-primary fw-semibold m-5" target="_blank">
                                    <img style="margin-right: 10px;" src="{{ asset('front/img/googleplay.png') }}"
                                        class="h-50px" alt="Play Store">
                                </a>
                                <!--end::Title-->
                            </div>
                            <!--end::Record-->

                        </div>
                        <!--end::Timeline details-->
                    </div>
                    <!--end::Timeline content-->
                </div>
                <!--end::Timeline item-->
                <!--begin::Timeline item-->
                <div class="timeline-item">
                    <!--begin::Timeline line-->
                    <div class="timeline-line w-40px"></div>
                    <!--end::Timeline line-->
                    <!--begin::Timeline icon-->
                    <div class="timeline-icon symbol symbol-circle symbol-40px">
                        <div class="symbol-label bg-light">
                            2
                        </div>
                    </div>
                    <!--end::Timeline icon-->
                    <!--begin::Timeline content-->
                    <div class="timeline-content mb-10 mt-n2">
                        <!--begin::Timeline heading-->
                        <div class="overflow-auto pe-3">
                            <!--begin::Title-->
                            <div class="fs-5 fw-semibold mb-2">Ouvrez l'application et scannez
                                le QR Code ou saisissez la clé secrète : </div>
                            <!--end::Title-->

                        </div>
                        <!--end::Timeline heading-->
                        <!--begin::Timeline details-->
                        <div class="overflow-auto pb-5">
                            <!--begin::Record-->
                            <div
                                class="d-flex align-items-center border border-dashed border-gray-300 rounded px-7 py-3 mb-5">
                                <!--begin::Title-->
                                <div class="fs-5 text-dark text-hover-primary fw-semibold">
                                    <img style="margin-right: 10px;" src="{{ asset('front/img/authenticator-qr.jpg') }}"
                                        class="h-400px" alt="Google Authenticator">
                                </div>

                                <!--end::Title-->
                            </div>
                            <!--end::Record-->

                            <!--begin::Record-->
                            <div
                                class="d-flex align-items-center border border-dashed border-gray-300 rounded px-7 py-3 mb-5">
                                <!--begin::Title-->
                                <div class="fs-5 text-dark text-hover-primary fw-semibold m-5">
                                    {!! $QR_Image !!}
                                </div>

                                <!--end::Title-->
                            </div>
                            <!--end::Record-->

                            <!--begin::Record-->
                            <div
                                class="d-flex align-items-center border border-dashed border-gray-300 rounded px-7 py-3 mb-5">
                                <!--begin::Title-->
                                <div class="fs-5 text-dark text-hover-primary fw-semibold m-5">
                                    Clé Secrète : <strong>{{ $secret }}</strong>
                                </div>

                                <!--end::Title-->
                            </div>
                            <!--end::Record-->

                        </div>
                        <!--end::Timeline details-->
                    </div>
                    <!--end::Timeline content-->
                </div>
                <!--end::Timeline item-->

                <!--begin::Timeline item-->
                <div class="timeline-item">
                    <!--begin::Timeline line-->
                    <div class="timeline-line w-40px"></div>
                    <!--end::Timeline line-->
                    <!--begin::Timeline icon-->
                    <div class="timeline-icon symbol symbol-circle symbol-40px">
                        <div class="symbol-label bg-light">
                            3
                        </div>
                    </div>
                    <!--end::Timeline icon-->
                    <!--begin::Timeline content-->
                    <div class="timeline-content mb-10 mt-n2">
                        <!--begin::Timeline heading-->
                        <div class="overflow-auto pe-3">
                            <!--begin::Title-->
                            <div class="fs-5 fw-semibold mb-2">Cliquez sur le bouton
                                <strong>Finaliser
                                    l'inscription</strong> :
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Timeline heading-->
                        <!--begin::Timeline details-->
                        <div class="overflow-auto pb-5">
                            <a href="{{ route('complete.registration') }}" class="btn btn-lg btn-primary m-5">Finaliser
                                l'inscription <i class="ki-outline ki-arrow-right fs-4 ms-2"></i></a>
                        </div>
                        <!--end::Timeline details-->
                    </div>
                    <!--end::Timeline content-->
                </div>
                <!--end::Timeline item-->
            </div>
        </div>

    </div>
@endsection
