@extends('layouts.front')

@push('styles')
@endpush

@inject('Lang', 'App\Services\LanguageService')

@section('content')
    <!-- Page Header Start -->
    <div class="page-header bg-section parallaxie">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-3" data-cursor="-opaque">A-Propos de nous</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
                                <li class="breadcrumb-item active" aria-current="page">A-Propos/li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Page About Us Section Start -->
    <div class="about-us page-about-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- About Us Image Start -->
                    <div class="about-image">
                        <!-- About Image Start -->
                        <div class="about-img-1">
                            <figure class="reveal">
                                <img src="{{ asset('front/images/handsome-elegant-man.jpg') }}" alt="">
                            </figure>
                        </div>
                        <!-- About Image End -->

                        <!-- About Image Start -->
                        {{--                        <div class="about-img-2">--}}
                        {{--                            <figure class="reveal">--}}
                        {{--                                <img src="{{ asset('front/images/handsome-elegant-man.jpg') }}" alt="">--}}
                        {{--                            </figure>--}}
                        {{--                        </div>--}}
                        <!-- About Image End -->
                    </div>
                    <!-- About Us Image End -->
                </div>

                <div class="col-lg-6">
                    <!-- About Us Content Start -->
                    <div class="about-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">A Propos de Nous</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">Votre partenaire de confiance en voiture fiable
                                de location</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.25s">Notre engagement est simple : vous offrir une expérience de location sans souci avec des véhicules fiables
                                et un service client irréprochable</p>
                        </div>
                        <!-- Section Title End -->

                        <!-- About Content Body Start -->
                        <div class="about-content-body">
                            <!-- About Trusted Booking Start -->
                            <div class="about-trusted-booking wow fadeInUp" data-wow-delay="0.5s">
                                <div class="icon-box">
                                    <img src="{{asset('front/images/icon-about-trusted-1.svg')}}" alt="">
                                </div>
                                <div class="trusted-booking-content">
                                    <h3>processus de réservation facile</h3>
                                    <p>Nous avons optimisé le processus de réservation afin que nos clients puissent profiter du
                                        Le service le plus simple et le plus sûr</p>
                                </div>
                            </div>
                            <!-- About Trusted Booking End -->

                            <!-- About Trusted Booking Start -->
                            <div class="about-trusted-booking wow fadeInUp" data-wow-delay="0.75s">
                                <div class="icon-box">
                                    <img src="{{asset('front/images/icon-about-trusted-2.svg')}}" alt="">
                                </div>
                                <div class="trusted-booking-content">
                                    <h3>processus de ramassage et de retour pratique</h3>
                                    <p>Présents à Libreville et dans les principales villes du Gabon, nous accompagnons aussi bien les touristes que les professionnels dans leurs déplacements.
                                        Notre équipe expérimentée assure un service personnalisé 24h/24 et 7j/7.</p>
                                </div>
                            </div>
                            <!-- About Trusted Booking End -->
                        </div>
                        <!-- About Content Body End -->

                        <!-- About Content Footer Start -->
                        <div class="about-content-footer wow fadeInUp" data-wow-delay="1s">
                            <a href="#" class="btn-default">Nous Contacter </a>
                        </div>
                        <!-- About Content Footer End -->
                    </div>
                    <!-- About Us Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page About Us Section End -->

    <!-- Exclusive Partners Section Start -->
    <div class="exclusive-partners bg-section">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">executive partners</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Trusted by leading brands</h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- Partners Logo Start -->
                    <div class="partners-logo wow fadeInUp" data-wow-delay="0.2s">
                        <img src="images/icon-partners-1.svg" alt="">
                    </div>
                    <!-- Partners Logo End -->
                </div>

                <div class="col-lg-3 col-6">
                    <!-- Partners Logo Start -->
                    <div class="partners-logo wow fadeInUp" data-wow-delay="0.4s">
                        <img src="images/icon-partners-2.svg" alt="">
                    </div>
                    <!-- Partners Logo End -->
                </div>

                <div class="col-lg-3 col-6">
                    <!-- Partners Logo Start -->
                    <div class="partners-logo wow fadeInUp" data-wow-delay="0.6s">
                        <img src="images/icon-partners-3.svg" alt="">
                    </div>
                    <!-- Partners Logo End -->
                </div>

                <div class="col-lg-3 col-6">
                    <!-- Partners Logo Start -->
                    <div class="partners-logo wow fadeInUp" data-wow-delay="0.8s">
                        <img src="images/icon-partners-4.svg" alt="">
                    </div>
                    <!-- Partners Logo End -->
                </div>

                <div class="col-lg-3 col-6">
                    <!-- Partners Logo Start -->
                    <div class="partners-logo wow fadeInUp" data-wow-delay="1s">
                        <img src="images/icon-partners-3.svg" alt="">
                    </div>
                    <!-- Partners Logo End -->
                </div>

                <div class="col-lg-3 col-6">
                    <!-- Partners Logo Start -->
                    <div class="partners-logo wow fadeInUp" data-wow-delay="1.2s">
                        <img src="images/icon-partners-4.svg" alt="">
                    </div>
                    <!-- Partners Logo End -->
                </div>

                <div class="col-lg-3 col-6">
                    <!-- Partners Logo Start -->
                    <div class="partners-logo wow fadeInUp" data-wow-delay="1.4s">
                        <img src="images/icon-partners-1.svg" alt="">
                    </div>
                    <!-- Partners Logo End -->
                </div>

                <div class="col-lg-3 col-6">
                    <!-- Partners Logo Start -->
                    <div class="partners-logo wow fadeInUp" data-wow-delay="1.6s">
                        <img src="images/icon-partners-2.svg" alt="">
                    </div>
                    <!-- Partners Logo End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Exclusive Partners Section End -->

    <!-- Vision Mission Section Start -->
    <div class="vision-mission">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Notre Vision</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Favoriser l'excellence et l'innovation dans les services de location de voitures</h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Sidebar Our Vision Mission Nav start -->
                    <div class="our-projects-nav wow fadeInUp" data-wow-delay="0.25s">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#vision" type="button" role="tab" aria-selected="true">Note Vision
                                    </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#mission"
                                    type="button" role="tab" aria-selected="false">Notre Mission</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#approach" type="button" role="tab" aria-selected="false">Notre Approche</button>
                            </li>
                        </ul>
                    </div>
                    <!-- Sidebar Our Vision Mission Nav End -->

                    <!-- Vision Mission Box Start -->
                    <div class="vision-mission-box tab-content" id="myTabContent">
                        <!-- Our Vision Item Start -->
                        <div class="our-vision-item tab-pane fade show active" id="vision" role="tabpanel">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <!-- Vision Mission Content Start -->
                                    <div class="vision-mission-content">
                                        <!-- Section Title Start -->
                                        <div class="section-title">
                                            <h3 class="wow fadeInUp">Notre vision</h3>
                                            <h2 class="text-anime-style-3" data-cursor="-opaque">Pionnier de l'excellence dans les services de location de voitures</h2>
                                            <p class="wow fadeInUp" data-wow-delay="0.25s">Nous visons à innover en permanence et à intégrer les dernières technologies à nos services.
                                                Des réservations en ligne simplifiées aux systèmes avancés de localisation des véhicules,
                                                notre objectif est de rendre le processus de location de voiture
                                                fluide et efficace pour nos clients.
                                                La qualité est au cœur de toutes nos activités. Nous disposons d'une flotte diversifiée de véhicules bien entretenus,
                                                répondant aux normes de sécurité et de confort les plus strictes.</p>
                                        </div>
                                        <!-- Section Title End -->

                                        <!-- Vision Mission List Start -->
                                        <div class="vision-mission-list wow fadeInUp" data-wow-delay="0.5s">
                                            <ul>
                                                <li>Nos clients sont notre priorité absolue</li>
                                                <li>La qualité est au cœur de tout ce que nous faisons</li>
                                                <li>Chaque véhicule quitte les soins dans son plus bel état</li>
                                            </ul>
                                        </div>
                                        <!-- Vision Mission List End -->
                                    </div>
                                    <!-- Vision Mission Content End -->
                                </div>

                                <div class="col-lg-6">
                                    <!-- Vision Image Start -->
                                    <div class="vision-image">
                                        <figure class="image-anime reveal">
                                            <img src="{{ asset('front/images/7I2A0359.jpg') }}" alt="">
                                        </figure>
                                    </div>
                                    <!-- Vision Image End -->
                                </div>
                            </div>
                        </div>
                        <!-- Our Vision Item End -->

                        <!-- Our Vision Item Start -->
                        <div class="our-vision-item tab-pane fade" id="mission" role="tabpanel">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <!-- Vision Mission Content Start -->
                                    <div class="vision-mission-content">
                                        <!-- Section Title Start -->
                                        <div class="section-title">
                                            <h3>Notre mission</h3>
                                            <h2 data-cursor="-opaque">Pionnier de l'excellence dans les services de location de voitures</h2>
                                            <p>Notre mission est de transformer l'expérience de location de véhicules au Gabon en offrant un service d'excellence qui allie innovation,
                                                qualité et satisfaction client.
                                                Nous nous engageons à être plus qu'un simple fournisseur de véhicules - nous sommes votre partenaire de mobilité de confiance.</p>
                                        </div>
                                        <!-- Section Title End -->

                                        <!-- Vision Mission List Start -->
                                        <div class="vision-mission-list">
                                            <ul>
                                                <li>Innovation technologique - Nous intégrons les dernières technologies pour simplifier votre expérience, des réservations en ligne aux systèmes avancés de localisation des véhicules.</li>
                                                <li>Excellence de service - Notre équipe dévouée est disponible 24/7 pour répondre à vos besoins avec professionnalisme et attention.</li>
                                                <li>Qualité supérieure - Notre flotte diversifiée est rigoureusement entretenue selon les normes de sécurité et de confort les plus strictes.</li>
                                                <li>Transparence totale - Nous pratiquons une politique de tarification claire, sans frais cachés ni surprises.</li>
                                                <li>Responsabilité environnementale - Nous investissons dans des véhicules à faible émission et adoptons des pratiques durables.</li>
                                            </ul>
                                        </div>
                                        <!-- Vision Mission List End -->
                                    </div>
                                    <!-- Vision Mission Content End -->
                                </div>

                                <div class="col-lg-6">
                                    <!-- Vision Image Start -->
                                    <div class="vision-image">
                                        <figure class="image-anime reveal">
                                            <img src="{{asset('front/images/7I2A0322.jpg')}}" alt="">
                                        </figure>
                                    </div>
                                    <!-- Vision Image End -->
                                </div>
                            </div>
                        </div>
                        <!-- Our Vision Item End -->

                        <!-- Our Mission Item Start -->
                        <div class="our-mission-item tab-pane fade" id="approach" role="tabpanel">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <!-- Vision Mission Content Start -->
                                    <div class="vision-mission-content">
                                        <!-- Section Title Start -->
                                        <div class="section-title">
                                            <h3>Notre Approche</h3>
                                            <h2 data-cursor="-opaque">Pionnier de l'excellence dans les services de location de voitures</h2>
                                            <p>Notre philosophie repose sur une conviction simple mais forte : chaque client mérite bien plus qu’un simple service de location.
                                                C’est pourquoi nous avons repensé chaque aspect de notre activité pour qu’il serve un seul objectif : vous offrir une expérience exceptionnelle,
                                                fluide et sans stress, à chaque étape de votre parcours.

                                                Notre approche va au-delà de la simple mise à disposition de véhicules. Elle incarne une vision centrée sur le client,
                                                où écoute, réactivité, personnalisation et excellence opérationnelle sont au cœur de nos priorités.notre philosophie repose sur une conviction simple mais forte :
                                                chaque client mérite bien plus qu’un simple service de location. C’est pourquoi nous avons repensé chaque aspect de notre activité pour qu’il serve un seul objectif : vous offrir une expérience exceptionnelle, fluide et sans stress, à chaque étape de votre parcours.

                                                Notre approche va au-delà de la simple mise à disposition de véhicules. Elle incarne une vision centrée sur le client, où écoute, réactivité, personnalisation et excellence opérationnelle sont au cœur de nos priorités.</p>
                                        </div>
                                        <!-- Section Title End -->

                                        <!-- Vision Mission List Start -->
                                        <div class="vision-mission-list">
                                            <ul>
                                                <li>Satisfaction totale du client : Offrir un service personnalisé, réactif et à l’écoute de vos besoins.</li>
                                                <li>Qualité et fiabilité : Proposer une flotte moderne, entretenue et diversifiée, pour répondre à toutes les situations.</li>
                                                <li>Confiance et sérénité : Assurer votre tranquillité d’esprit grâce à des assurances claires, un service client disponible et des engagements respectés.</li>
                                            </ul>
                                        </div>
                                        <!-- Vision Mission List End -->
                                    </div>
                                    <!-- Vision Mission Content End -->
                                </div>

                                <div class="col-lg-6">
                                    <!-- Vision Image Start -->
                                    <div class="vision-image">
                                        <figure class="image-anime reveal">
                                            <img src="{{ asset('front/images/7I2A0345.jpg') }}" alt="">
                                        </figure>
                                    </div>
                                    <!-- Vision Image End -->
                                </div>
                            </div>
                        </div>
                        <!-- Our Mission Item End -->
                    </div>
                    <!-- Vision Mission Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Vision Mission Section End -->

    <!-- Our Video Section Start -->
{{--    <div class="our-video bg-section">--}}
{{--        <div class="container">--}}
{{--            <div class="row section-row">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <!-- Section Title Start -->--}}
{{--                    <div class="section-title">--}}
{{--                        <h3 class="wow fadeInUp">Regardez notre video</h3>--}}
{{--                        <h2 class="text-anime-style-3" data-cursor="-opaque">Découvrez ce qui nous distingue dans le secteur de la location de voitures</h2>--}}
{{--                    </div>--}}
{{--                    <!-- Section Title End -->--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="row">--}}
{{--                <div class="col-lg-4 col-md-5">--}}
{{--                    <!-- Customer Counter Item Start -->--}}
{{--                    <div class="customer-counter-item">--}}
{{--                        <!-- Customer Counter Image Start -->--}}
{{--                        <div class="customer-counter-image">--}}
{{--                            <img src="{{ asset("images/video-counter-img-1.jpg")}}" alt="">--}}
{{--                        </div>--}}
{{--                        <!-- Customer Counter Image End -->--}}

{{--                        <!-- Satisfied Customer Counter Start -->--}}
{{--                        <div class="satisfied-customer-counter">--}}
{{--                            <h3><span class="counter">400</span>+</h3>--}}
{{--                            <p>Clients satisfaits</p>--}}
{{--                        </div>--}}
{{--                        <!-- Satisfied Customer Counter End -->--}}

{{--                        <!-- Satisfied Customer Image Start -->--}}
{{--                        <div class="satisfied-customer-image">--}}
{{--                            <img src="{{ asset("front/images/satisfied-customer-img.png")}}" alt="">--}}
{{--                        </div>--}}
{{--                        <!-- Satisfied Customer Image End -->--}}
{{--                    </div>--}}
{{--                    <!-- Customer Counter Item End -->--}}
{{--                </div>--}}

{{--                <div class="col-lg-8 col-md-7">--}}
{{--                    <!-- Video Image Box Start -->--}}
{{--                    <div class="video-image-box">--}}
{{--                        <!-- Video Image Start -->--}}
{{--                        <div class="video-image" data-cursor-text="Play">--}}
{{--                            <figure>--}}
{{--                                <a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="popup-video">--}}
{{--                                    <img src="images/video-counter-img-2.jpg" alt="">--}}
{{--                                </a>--}}
{{--                            </figure>--}}
{{--                        </div>--}}
{{--                        <!-- Video Image End -->--}}

{{--                        <!-- Video Image Play Button Start -->--}}
{{--                        <div class="video-image-play-button" data-cursor-text="Play">--}}
{{--                            <a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="popup-video">--}}
{{--                                <i class="fa-solid fa-play"></i>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <!-- Video Image Play Button End -->--}}
{{--                    </div>--}}
{{--                    <!-- Video Image Box End -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- Our Video Section End -->

    <!-- Why Choose Us Section Start -->
    <div class="why-choose-us">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Pourquoi nous choisir ? </h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Une qualité et un service inégalés pour vos besoins
                        </h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-4 col-md-6 order-lg-1 order-md-1 order-1">
                    <!-- Why Choose Item Start -->
                    <div class="why-choose-item wow fadeInUp">
                        <div class="icon-box">
                            <img src="{{ asset('front/images/icon-why-choose-1.svg') }}" alt="Flotte étendue">
                        </div>
                        <div class="why-choose-content">
                            <h3>Flotte étendue et diversifiée</h3>
                            <p>Des citadines économiques aux SUV haut de gamme, nous vous proposons une large gamme de véhicules récents pour répondre à tous vos besoins.</p>
                        </div>
                    </div>
                    <!-- Why Choose Item End -->

                    <!-- Why Choose Item Start -->
                    <div class="why-choose-item wow fadeInUp" data-wow-delay="0.25s">
                        <div class="icon-box">
                            <img src="{{ asset('front/images/icon-why-choose-2.svg') }}" alt="Service client">
                        </div>
                        <div class="why-choose-content">
                            <h3>Service client réactif et à l'écoute</h3>
                            <p>Notre équipe est disponible 7j/7 pour vous accompagner, répondre à vos questions et vous garantir une expérience sans stress.</p>
                        </div>
                    </div>
                    <!-- Why Choose Item End -->
                </div>

                <div class="col-lg-4 col-md-12 order-lg-2 order-md-3 order-2">
                    <div class="why-choose-image">
                        <figure class="reveal">
                            <img src="{{ asset('front/images/why-choose-img.jpg') }}" alt="Pourquoi nous choisir">
                        </figure>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 order-lg-3 order-md-2 order-3">
                    <!-- Why Choose Item Start -->
                    <div class="why-choose-item wow fadeInUp">
                        <div class="icon-box">
                            <img src="{{ asset('front/images/icon-why-choose-3.svg') }}" alt="Agences accessibles">
                        </div>
                        <div class="why-choose-content">
                            <h3>Agences accessibles facilement</h3>
                            <p>Nos points de retrait sont idéalement situés pour vous permettre de récupérer votre véhicule rapidement, en centre-ville ou à proximité des aéroports.</p>
                        </div>
                    </div>
                    <!-- Why Choose Item End -->

                    <!-- Why Choose Item Start -->
                    <div class="why-choose-item wow fadeInUp" data-wow-delay="0.25s">
                        <div class="icon-box">
                            <img src="{{ asset('front/images/icon-why-choose-4.svg') }}" alt="Fiabilité et sécurité">
                        </div>
                        <div class="why-choose-content">
                            <h3>Fiabilité et sécurité garanties</h3>
                            <p>Tous nos véhicules sont entretenus régulièrement et inspectés avant chaque location pour garantir votre sécurité et votre tranquillité d'esprit.</p>
                        </div>
                    </div>
                </div>
                <!-- Why Choose Item End -->
            </div>
        </div>
    </div>
    <!-- Why Choose Us Section End -->


    <!-- Our Testiminial Start -->
    <div class="our-testimonial">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Temoignages</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Ce que nos clients disent de nous
                        </h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Testimonial Slider Start -->
                    <div class="testimonial-slider">
                        <div class="swiper">
                            <div class="swiper-wrapper" data-cursor-text="Drag">
                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="testimonial-header">
                                            <div class="testimonial-rating">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            </div>
                                            <div class="testimonial-content">
                                                <p>Louer une voiture chez JOD Trade&Co était une excellente décision. Non seulement j'ai eu
                                                    un véhicule fiable et confortable, mais les prix étaient également très
                                                    compétitif.</p>
                                            </div>
                                        </div>
                                        <div class="testimonial-body">
                                            <div class="author-image">
                                                <figure class="image-anime">
                                                    <img src="{{asset('front/images/author-1.jpg')}}" alt="">
                                                </figure>
                                            </div>
                                            <div class="author-content">
                                                <h3>floyd miles</h3>
                                                <p>project manager</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Testimonial Slide End -->

                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="testimonial-header">
                                            <div class="testimonial-rating">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-regular fa-star"></i>
                                            </div>
                                            <div class="testimonial-content">
                                                <p>Louer une voiture chez JOD Trade&Co était une excellente décision. Non seulement j'ai eu
                                                    un véhicule fiable et confortable, mais les prix étaient également très
                                                    compétitif.</p>
                                            </div>
                                        </div>
                                        <div class="testimonial-body">
                                            <div class="author-image">
                                                <figure class="image-anime">
                                                    <img src="{{asset('front/images/author-2.jpg')}}" alt="">
                                                </figure>
                                            </div>
                                            <div class="author-content">
                                                <h3>annette black</h3>
                                                <p>project manager</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Testimonial Slide End -->

                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="testimonial-header">
                                            <div class="testimonial-rating">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-regular fa-star"></i>
                                                <i class="fa-regular fa-star"></i>
                                            </div>
                                            <div class="testimonial-content">
                                                <p>Louer une voiture chez JOD Trade&Co était une excellente décision. Non seulement j'ai eu
                                                    un véhicule fiable et confortable, mais les prix étaient également très
                                                    compétitif.</p>
                                            </div>
                                        </div>
                                        <div class="testimonial-body">
                                            <div class="author-image">
                                                <figure class="image-anime">
                                                    <img src="{{asset('front/images/author-3.jpg')}}" alt="">
                                                </figure>
                                            </div>
                                            <div class="author-content">
                                                <h3>leslie alexander</h3>
                                                <p>project manager</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Testimonial Slide End -->

                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="testimonial-header">
                                            <div class="testimonial-rating">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            </div>
                                            <div class="testimonial-content">
                                                <p>Louer une voiture chez JOD Trade&Co était une excellente décision. Non seulement j'ai eu
                                                    un véhicule fiable et confortable, mais les prix étaient également très
                                                    compétitif.</p>
                                            </div>
                                        </div>
                                        <div class="testimonial-body">
                                            <div class="author-image">
                                                <figure class="image-anime">
                                                    <img src="{{asset('front/images/author-4.jpg')}}" alt="">
                                                </figure>
                                            </div>
                                            <div class="author-content">
                                                <h3>alis white</h3>
                                                <p>project manager</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Testimonial Slide End -->
                            </div>
                            <div class="testimonial-btn">
                                <div class="testimonial-button-prev"></div>
                                <div class="testimonial-button-next"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial Slider End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our Testiminial End -->
@endsection

@push('scripts')
@endpush
