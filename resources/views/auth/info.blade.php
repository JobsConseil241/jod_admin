@extends('layout.front')

@inject('Lang', 'App\Services\LanguageService')
@inject('Page', 'App\Services\PageService')

@push('styles')
    <style>
        .post-info:after {
            background-color: rgba(0, 0, 0, 0.1);
        }

        .lsvr-container {
            width: 85%;
        }

        .post__container {
            background: white;
            border-radius: 0px 0px 12px 12px !important;
        }

        .post__content {
            font-size: 1.5em;
        }

        .lsvr-wordbench-post-grid--layout-photogrid .lsvr-wordbench-post-grid__post-categories {
            margin-bottom: 10px;
        }

        .main-header__title {
            font-size: 4em;
        }

        .lsvr-wordbench-post-grid--layout-photogrid .lsvr-wordbench-post-grid__post-categories .post__term-link,
        .header-cta__link.lsvr-button {
            color: #FFF;
            background-color: #3a74c5;
        }

        .lsvr-wordbench-post-grid--layout-photogrid .lsvr-wordbench-post-grid__post-categories .post__term-link:hover,
        .header-cta__link.lsvr-button:hover {
            color: #FFF;
            background-color: #009e60;
        }

        .lsvr_event-post-archive--grid .post__container {
            height: 140px !important;
        }

        .lsvr-wordbench-contact__info {
            background: rgba(20, 160, 119, 0.13);
            border-radius: 14px;
            padding: 40px 20px 20px 40px;
            color: rgb(20, 160, 119)
        }

        .main-header__title {
            background-image: linear-gradient(to right, #3a74c5, #009e63);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-size: 75.59px;
            font-weight: 700;
            line-height: 89px;
            margin: 10px 0;
            margin-bottom: 30px;
        }

        .lsvr-wordbench-contact__info-inner h4 {
            color: #0E956D;
            font-size: 19.50px;
            font-weight: 800;
            line-height: 37.05px;
            word-wrap:
        }

        .lsvr-wordbench-contact__info-inner ul>li {
            color: #0E956D;
            font-size: 19.50px;
            font-weight: 500;
            line-height: 29.25px;
        }

        @media (max-width: 425px) {

            .lsvr-wordbench-post-grid__title {
                font-size: 25px !important;
            }

            .main-header__title {
                font-size: 38.59px !important;
                line-height: 49px !important;
            }
        }
    </style>
@endpush

@section('content')
    <div id="core" class="core--fullwidth core--fullwidth-without-title">
        <div class="core__inner">

            <!-- MAIN : begin -->
            <main id="main">
                <div class="main__inner">

                    <!-- MAIN CONTENT : begin -->
                    <div class="main__content">
                        <div class="main__content-wrapper">
                            <div class="main__content-inner">

                                <!-- POST CONTENT : begin -->
                                <div class="post__content">

                                    <!-- WORDBENCH HERO : begin -->
                                    <section
                                        class="lsvr-wordbench-hero lsvr-wordbench-hero--layout-text-left lsvr-wordbench-hero--has-bg-image lsvr-wordbench-hero--has-header lsvr-wordbench-hero--has-search lsvr-wordbench-hero--has-filter lsvr-wordbench-hero--has-search-panel lsvr-wordbench-post-grid--layout-style-light lsvr-wordbench-hero--has-parallax section-home-header"
                                        data-parallax-speed="2">
                                        <div class="lsvr-wordbench-hero__inner">

                                            <div class="lsvr-container">
                                                <div class="lsvr-wordbench-hero__content">

                                                    <header class="lsvr-wordbench-hero__header">
                                                        <div class="lsvr-wordbench-hero__header-inner">

                                                            <h2 class="lsvr-wordbench-post-grid__title"
                                                                style="text-align: center; color: white; font-size: 48px; font-weight: 700; line-height: 57.60px;">
                                                                Enrôlement</h2>


                                                        </div>
                                                    </header>
                                                </div>
                                            </div>

                                            <div class="lsvr-wordbench-hero__bg-wrapper" aria-hidden="true">
                                                <div class="lsvr-wordbench-hero__bg"
                                                    style="background-image: url( 'https://andev.billing-easy.net/front/img/hero_2.png' );">
                                                </div>

                                            </div>

                                            <div class="lsvr-wordbench-post-grid__bg header-bg lsvr-wordbench-post-grid__bg--opacity-55"
                                                aria-hidden="true"></div>

                                        </div>
                                    </section>
                                    <!-- WORDBENCH HERO : end -->
                                    <section class="lsvr-wordbench-contact lsvr-wordbench-contact--has-contact-form">
                                        <div class="lsvr-wordbench-contact__inner">
                                            <div class="lsvr-container">
                                                <!-- MAIN HEADER : begin -->
                                                <header class="main-header">
                                                    <div class="main-header__inner">
                                                        <h1 class="main-header__title">
                                                            {{ $Page->value('titre_page_info_enrollement') }} </h1>
                                                    </div>
                                                </header>
                                                <!-- MAIN HEADER : end -->
                                            </div>
                                        </div>
                                    </section>



                                    <!-- WORDBENCH CONTACT : begin -->
                                    <section class="lsvr-wordbench-contact lsvr-wordbench-contact--has-contact-form"
                                        style="margin-bottom: 30px;">
                                        <div class="lsvr-wordbench-contact__inner">
                                            <div class="lsvr-container">
                                                <div class="lsvr-grid lsvr-grid--md-reset">
                                                    <div class="lsvr-grid__col lsvr-grid__col--span-6">
                                                        @php
                                                            echo $Page->value('contenu_page_info_enrollement');
                                                        @endphp

                                                        <div class="text-center mb-20 mt-10">
                                                            <a href="{{ route('register') }}"
                                                                class="header-cta__link lsvr-button"
                                                                style="width: 100%; height: 10%; background-color:#1153AF">S'enrôler</a>
                                                        </div>

                                                    </div>
                                                    <div class="lsvr-grid__col lsvr-grid__col--span-4">
                                                        <!-- CONTACT INFO : begin -->
                                                        <div class="lsvr-wordbench-contact__info">
                                                            <div class="lsvr-wordbench-contact__info-inner">
                                                                <h4>Les documents à founir sont les suivant : </h4>
                                                                <ul>
                                                                    @foreach ($documents as $document)
                                                                        <li>{{ $document->name }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!-- CONTACT INFO : end -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- WORDBENCH CONTACT : end -->
                                </div>
                                <!-- POST CONTENT : end -->
                            </div>
                        </div>
                    </div>
                    <!-- MAIN CONTENT : begin -->

                </div>
            </main>
            <!-- MAIN : end -->

        </div>
    </div>
@endsection

@push('scripts')
@endpush
