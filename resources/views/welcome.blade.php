<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Awaiken">
    <!-- Page Title -->
    <title>JOD Trade & Co</title>

    <!-- Favicon Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/images/jod_ico.png') }}">
    <!-- Google Fonts Css-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&amp;family=Epilogue:ital,wght@0,100..900;1,100..900&amp;display=swap"
        rel="stylesheet">

    <!-- Bootstrap Css -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet" media="screen">
    <!-- SlickNav Css -->
    <link href="{{ asset('front/css/slicknav.min.css') }}" rel="stylesheet">
    <!-- Swiper Css -->
    <link rel="stylesheet" href="{{ asset('front/css/swiper-bundle.min.css') }}">
    <!-- Font Awesome Icon Css-->
    <link href="{{ asset('front/css/all.css') }}" rel="stylesheet" media="screen">
    <!-- Animated Css -->
    <link href="{{ asset('front/css/animate.css') }}" rel="stylesheet">
    <!-- Magnific Popup Core Css File -->
    <link rel="stylesheet" href="{{ asset('front/css/magnific-popup.css') }}">
    <!-- Mouse Cursor Css File -->
    <link rel="stylesheet" href="{{ asset('front/css/mousecursor.css') }}">
    <!-- Main Custom Css -->
    <link href="{{ asset('front/css/custom.css') }}" rel="stylesheet" media="screen">

    @php
        $user = Auth::user();
    @endphp

    @inject('Lang', 'App\Services\LanguageService')
</head>

<body>

    <!-- Preloader Start -->
    <div class="preloader">
        <div class="loading-container">
            <div class="loading"></div>
            <div id="loading-icon"><img src="{{ asset('front/images/jod_white.png') }}" alt=""></div>
        </div>
    </div>
    <!-- Preloader End -->

    <!-- Header Start -->
    <header class="main-header">
        <div class="header-sticky">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <!-- Logo Start -->
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('front/images/jod.png') }}" alt="Logo">
                    </a>
                    <!-- Logo End -->

                    <!-- Main Menu Start -->
                    <div class="collapse navbar-collapse main-menu">
                        <div class="nav-menu-wrapper">
                            <ul class="navbar-nav mr-auto" id="menu">
                                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Accueil</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">A Propos</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('cars') }}">Véhicule</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                            </ul>
                        </div>
                        <!-- Let’s Start Button Start -->
                        <div class="header-btn d-inline-flex">
                            @if ($user)
                                <a href="{{ $user['user_type_id'] == 1000002 ? route('profil') : route('dashboard') }}"
                                    class="btn-default">{{ $user['last_name'] }}</a>
                            @else
                                <a href="{{ route('login') }}" class="btn-default">Connexion</a>
                            @endif
                        </div>
                        <!-- Let’s Start Button End -->
                    </div>
                    <!-- Main Menu End -->
                    <div class="navbar-toggle"></div>
                </div>
            </nav>
            <div class="responsive-menu"></div>
        </div>
    </header>
    <!-- Header End -->

    <!-- Hero Section Start -->
    <div class="hero">
        <div class="hero-section bg-section parallaxie">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <!-- Hero Content Start -->
                        <div class="hero-content">
                            <div class="section-title">
                                <h3 class="wow fadeInUp">Bienvenu chez JOD Trade & Co</h3>
                                <h1 class="text-anime-style-3" data-cursor="-opaque">Vous souhaitez avec le meilleur en
                                    location de véhicule ?</h1>
                                <p class="wow fadeInUp" data-wow-delay="0.25s">Une escapade en fin de
                                    semaine, un voyage d'affaires ou que vous ayez simplement besoin d'un véhicule
                                    fiable pour la journée, nous offrons une vaste gamme de véhicules pour répondre à
                                    vos besoins.</p>
                            </div>

                            <div class="hero-content-body wow fadeInUp" data-wow-delay="0.5s">
                                <a href="#" class="btn-default">Réserver</a>
                                <a href="#" class="btn-default btn-highlighted">En savoir plus</a>
                            </div>
                        </div>
                        <!-- Hero Content End -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Rent Details Section Start -->
        <div class="rent-details wow fadeInUp" data-wow-delay="0.75s">
            <div class="container">
                <!-- Filter Form Start -->
                <form action="#" method="get">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-12">
                            <div class="rent-details-box">
                                <div class="rent-details-form">
                                    <!-- Rent Details Item Start -->
                                    <div class="rent-details-item">
                                        <div class="icon-box">
                                            <img src="images/icon-rent-details-1.svg" alt="">
                                        </div>
                                        <div class="rent-details-content">
                                            <h3>Type de Véhicule</h3>
                                            <select class="rent-details-form form-select">
                                                <option value="" disabled selected>Choose Car Type</option>
                                                <option value="sport_car">sport car</option>
                                                <option value="convertible_car">convertible car</option>
                                                <option value="sedan_car">sedan car</option>
                                                <option value="luxury_car">luxury car</option>
                                                <option value="electric_car">electric car</option>
                                                <option value="coupe_car">coupe car</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Rent Details Item End -->

                                    <!-- Rent Details Item Start -->
                                    <div class="rent-details-item">
                                        <div class="icon-box">
                                            <img src="images/icon-rent-details-2.svg" alt="">
                                        </div>
                                        <div class="rent-details-content">
                                            <h3>Lieu de récupération</h3>
                                            <select class="rent-details-form form-select">
                                                <option value="" disabled selected>Pick Up Location</option>
                                                <option value="abu_dhabi">abu dhabi</option>
                                                <option value="alain">alain</option>
                                                <option value="dubai">dubai</option>
                                                <option value="sharjah">sharjah</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Rent Details Item End -->

                                    <!-- Rent Details Item Start -->
                                    <div class="rent-details-item">
                                        <div class="icon-box">
                                            <img src="images/icon-rent-details-3.svg" alt="">
                                        </div>
                                        <div class="rent-details-content">
                                            <h3>Date de début</h3>
                                            <p><input type="text" name="date" placeholder="mm/dd/yyyy"
                                                    class="rent-details-form datepicker" required></p>
                                        </div>
                                    </div>
                                    <!-- Rent Details Item End -->

                                    <!-- Rent Details Item Start -->
                                    <div class="rent-details-item">
                                        <div class="icon-box">
                                            <img src="images/icon-rent-details-4.svg" alt="">
                                        </div>
                                        <div class="rent-details-content">
                                            <h3>Lieu de remise</h3>
                                            <select class="rent-details-form form-select">
                                                <option value="" disabled selected>Drop Off Location</option>
                                                <option value="abu_dhabi">abu dhabi</option>
                                                <option value="alain">alain</option>
                                                <option value="sharjah">sharjah</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Rent Details Item End -->

                                    <!-- Rent Details Item Start -->
                                    <div class="rent-details-item">
                                        <div class="icon-box">
                                            <img src="images/icon-rent-details-5.svg" alt="">
                                        </div>
                                        <div class="rent-details-content">
                                            <h3>Date de fin</h3>
                                            <p><input type="text" name="date" placeholder="mm/dd/yyyy"
                                                    class="rent-details-form datepicker" required></p>
                                        </div>
                                    </div>
                                    <!-- Rent Details Item End -->

                                    <div class="rent-details-item rent-details-search">
                                        <a href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
                <!-- Filter Form End -->
            </div>
        </div>
        <!-- Rent Details Section End -->
    </div>
    <!-- Hero Section End -->

    <!-- About Us Section Start -->
    <div class="about-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- About Us Image Start -->
                    <div class="about-image">
                        <!-- About Image Start -->
                        <div class="about-img-1">
                            <figure class="reveal">
                                <img src="images/about-img-1.jpg" alt="">
                            </figure>
                        </div>
                        <!-- About Image End -->

                        <!-- About Image Start -->
                        <div class="about-img-2">
                            <figure class="reveal">
                                <img src="images/about-img-2.jpg" alt="">
                            </figure>
                        </div>
                        <!-- About Image End -->
                    </div>
                    <!-- About Us Image End -->
                </div>

                <div class="col-lg-6">
                    <!-- About Us Content Start -->
                    <div class="about-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">about us</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">Your trusted partner in reliable car
                                rental</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.25s">Aqestic Optio Amet A Ququam Saepe Aliquid
                                Voluate Dicta Fuga Dolor Saerror Sed Earum A Magni Soluta Quam Minus Dolor Dolor</p>
                        </div>
                        <!-- Section Title End -->

                        <!-- About Content Body Start -->
                        <div class="about-content-body">
                            <!-- About Trusted Booking Start -->
                            <div class="about-trusted-booking wow fadeInUp" data-wow-delay="0.5s">
                                <div class="icon-box">
                                    <img src="images/icon-about-trusted-1.svg" alt="">
                                </div>
                                <div class="trusted-booking-content">
                                    <h3>easy booking process</h3>
                                    <p>We Have Optimized The Booking Process So That Our Clients Can Experience The
                                        Easiest And The Safest Service</p>
                                </div>
                            </div>
                            <!-- About Trusted Booking End -->

                            <!-- About Trusted Booking Start -->
                            <div class="about-trusted-booking wow fadeInUp" data-wow-delay="0.75s">
                                <div class="icon-box">
                                    <img src="images/icon-about-trusted-2.svg" alt="">
                                </div>
                                <div class="trusted-booking-content">
                                    <h3>convenient pick-up & return process</h3>
                                    <p>We Have Optimized The Booking Process So That Our Clients Can Experience The
                                        Easiest And The Safest Service</p>
                                </div>
                            </div>
                            <!-- About Trusted Booking End -->
                        </div>
                        <!-- About Content Body End -->

                        <!-- About Content Footer Start -->
                        <div class="about-content-footer wow fadeInUp" data-wow-delay="1s">
                            <a href="#" class="btn-default">contact us</a>
                        </div>
                        <!-- About Content Footer End -->
                    </div>
                    <!-- About Us Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- About Us Section End -->

    <!-- Our Services Section Start -->
    <div class="our-services bg-section">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">our services</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Explore our wide range of rental services
                        </h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item wow fadeInUp">
                        <div class="icon-box">
                            <img src="images/icon-service-1.svg" alt="">
                        </div>
                        <div class="service-content">
                            <h3>car rental with driver</h3>
                            <p>Enhance your rental experience with additional options.</p>
                        </div>
                        <div class="service-footer">
                            <a href="#" class="section-icon-btn"><img src="images/arrow-white.svg"
                                    alt=""></a>
                        </div>
                    </div>
                    <!-- Service Item End -->
                </div>

                <div class="col-lg-3 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="0.25s">
                        <div class="icon-box">
                            <img src="images/icon-service-2.svg" alt="">
                        </div>
                        <div class="service-content">
                            <h3>business car rental</h3>
                            <p>Enhance your rental experience with additional options.</p>
                        </div>
                        <div class="service-footer">
                            <a href="#" class="section-icon-btn"><img src="images/arrow-white.svg"
                                    alt=""></a>
                        </div>
                    </div>
                    <!-- Service Item End -->
                </div>

                <div class="col-lg-3 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="0.5s">
                        <div class="icon-box">
                            <img src="images/icon-service-3.svg" alt="">
                        </div>
                        <div class="service-content">
                            <h3>airport transfer</h3>
                            <p>Enhance your rental experience with additional options.</p>
                        </div>
                        <div class="service-footer">
                            <a href="#" class="section-icon-btn"><img src="images/arrow-white.svg"
                                    alt=""></a>
                        </div>
                    </div>
                    <!-- Service Item End -->
                </div>

                <div class="col-lg-3 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="0.75s">
                        <div class="icon-box">
                            <img src="images/icon-service-4.svg" alt="">
                        </div>
                        <div class="service-content">
                            <h3>chauffeur services</h3>
                            <p>Enhance your rental experience with additional options.</p>
                        </div>
                        <div class="service-footer">
                            <a href="#" class="section-icon-btn"><img src="images/arrow-white.svg"
                                    alt=""></a>
                        </div>
                    </div>
                    <!-- Service Item End -->
                </div>

                <div class="col-lg-12">
                    <!-- Service Box Footer Start -->
                    <div class="services-box-footer wow fadeInUp" data-wow-delay="1s">
                        <p>Discover our range of car rental services designed to meet all your travel needs. From a
                            diverse fleet of vehicles to flexible rental plans.</p>
                        <a href="#" class="btn-default">view all service</a>
                    </div>
                    <!-- Service Box Footer End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our Services Section End -->

    <!-- Perfect Fleets Section Start -->
    <div class="perfect-fleet bg-section">
        <div class="container-fluid">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">our fleets</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Explore our perfect and extensive fleet
                        </h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Testimonial Slider Start -->
                    <div class="car-details-slider">
                        <div class="swiper">
                            <div class="swiper-wrapper" data-cursor-text="Drag">
                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <!-- Perfect Fleets Item Start -->
                                    <div class="perfect-fleet-item">
                                        <!-- Image Box Start -->
                                        <div class="image-box">
                                            <img src="images/perfect-fleet-img-1.png" alt="">
                                        </div>
                                        <!-- Image Box End -->

                                        <!-- Perfect Fleets Content Start -->
                                        <div class="perfect-fleet-content">
                                            <!-- Perfect Fleets Title Start -->
                                            <div class="perfect-fleet-title">
                                                <h3>luxury car</h3>
                                                <h2>BMW M2 Car 2017</h2>
                                            </div>
                                            <!-- Perfect Fleets Content End -->

                                            <!-- Perfect Fleets Body Start -->
                                            <div class="perfect-fleet-body">
                                                <ul>
                                                    <li><img src="images/icon-fleet-list-1.svg" alt="">4
                                                        passenger</li>
                                                    <li><img src="images/icon-fleet-list-2.svg" alt="">4 door
                                                    </li>
                                                    <li><img src="images/icon-fleet-list-3.svg" alt="">bags
                                                    </li>
                                                    <li><img src="images/icon-fleet-list-4.svg" alt="">auto
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- Perfect Fleets Body End -->

                                            <!-- Perfect Fleets Footer Start -->
                                            <div class="perfect-fleet-footer">
                                                <!-- Perfect Fleets Pricing Start -->
                                                <div class="perfect-fleet-pricing">
                                                    <h2>$280<span>/day</span></h2>
                                                </div>
                                                <!-- Perfect Fleets Pricing End -->

                                                <!-- Perfect Fleets Btn Start -->
                                                <div class="perfect-fleet-btn">
                                                    <a href="#" class="section-icon-btn"><img
                                                            src="images/arrow-white.svg" alt=""></a>
                                                </div>
                                                <!-- Perfect Fleets Btn End -->
                                            </div>
                                            <!-- Perfect Fleets Footer End -->
                                        </div>
                                        <!-- Perfect Fleets Content End -->
                                    </div>
                                    <!-- Perfect Fleets Item End -->
                                </div>
                                <!-- Testimonial Slide End -->

                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <!-- Perfect Fleets Item Start -->
                                    <div class="perfect-fleet-item">
                                        <!-- Image Box Start -->
                                        <div class="image-box">
                                            <img src="images/perfect-fleet-img-2.png" alt="">
                                        </div>
                                        <!-- Image Box End -->

                                        <!-- Perfect Fleets Content Start -->
                                        <div class="perfect-fleet-content">
                                            <!-- Perfect Fleets Title Start -->
                                            <div class="perfect-fleet-title">
                                                <h3>luxury car</h3>
                                                <h2>Audi RS7 Car 2016</h2>
                                            </div>
                                            <!-- Perfect Fleets Content End -->

                                            <!-- Perfect Fleets Body Start -->
                                            <div class="perfect-fleet-body">
                                                <ul>
                                                    <li><img src="images/icon-fleet-list-1.svg" alt="">4
                                                        passenger</li>
                                                    <li><img src="images/icon-fleet-list-2.svg" alt="">4 door
                                                    </li>
                                                    <li><img src="images/icon-fleet-list-3.svg" alt="">bags
                                                    </li>
                                                    <li><img src="images/icon-fleet-list-4.svg" alt="">auto
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- Perfect Fleets Body End -->

                                            <!-- Perfect Fleets Footer Start -->
                                            <div class="perfect-fleet-footer">
                                                <!-- Perfect Fleets Pricing Start -->
                                                <div class="perfect-fleet-pricing">
                                                    <h2>$320<span>/day</span></h2>
                                                </div>
                                                <!-- Perfect Fleets Pricing End -->

                                                <!-- Perfect Fleets Btn Start -->
                                                <div class="perfect-fleet-btn">
                                                    <a href="#" class="section-icon-btn"><img
                                                            src="images/arrow-white.svg" alt=""></a>
                                                </div>
                                                <!-- Perfect Fleets Btn End -->
                                            </div>
                                            <!-- Perfect Fleets Footer End -->
                                        </div>
                                        <!-- Perfect Fleets Content End -->
                                    </div>
                                    <!-- Perfect Fleets Item End -->
                                </div>
                                <!-- Testimonial Slide End -->

                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <!-- Perfect Fleets Item Start -->
                                    <div class="perfect-fleet-item">
                                        <!-- Image Box Start -->
                                        <div class="image-box">
                                            <img src="images/perfect-fleet-img-3.png" alt="">
                                        </div>
                                        <!-- Image Box End -->

                                        <!-- Perfect Fleets Content Start -->
                                        <div class="perfect-fleet-content">
                                            <!-- Perfect Fleets Title Start -->
                                            <div class="perfect-fleet-title">
                                                <h3>luxury car</h3>
                                                <h2>Ferrari F12 Car 2022</h2>
                                            </div>
                                            <!-- Perfect Fleets Content End -->

                                            <!-- Perfect Fleets Body Start -->
                                            <div class="perfect-fleet-body">
                                                <ul>
                                                    <li><img src="images/icon-fleet-list-1.svg" alt="">4
                                                        passenger</li>
                                                    <li><img src="images/icon-fleet-list-2.svg" alt="">4 door
                                                    </li>
                                                    <li><img src="images/icon-fleet-list-3.svg" alt="">bags
                                                    </li>
                                                    <li><img src="images/icon-fleet-list-4.svg" alt="">auto
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- Perfect Fleets Body End -->

                                            <!-- Perfect Fleets Footer Start -->
                                            <div class="perfect-fleet-footer">
                                                <!-- Perfect Fleets Pricing Start -->
                                                <div class="perfect-fleet-pricing">
                                                    <h2>$450<span>/day</span></h2>
                                                </div>
                                                <!-- Perfect Fleets Pricing End -->

                                                <!-- Perfect Fleets Btn Start -->
                                                <div class="perfect-fleet-btn">
                                                    <a href="#" class="section-icon-btn"><img
                                                            src="images/arrow-white.svg" alt=""></a>
                                                </div>
                                                <!-- Perfect Fleets Btn End -->
                                            </div>
                                            <!-- Perfect Fleets Footer End -->
                                        </div>
                                        <!-- Perfect Fleets Content End -->
                                    </div>
                                    <!-- Perfect Fleets Item End -->
                                </div>
                                <!-- Testimonial Slide End -->

                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <!-- Perfect Fleets Item Start -->
                                    <div class="perfect-fleet-item">
                                        <!-- Image Box Start -->
                                        <div class="image-box">
                                            <img src="images/perfect-fleet-img-4.png" alt="">
                                        </div>
                                        <!-- Image Box End -->

                                        <!-- Perfect Fleets Content Start -->
                                        <div class="perfect-fleet-content">
                                            <!-- Perfect Fleets Title Start -->
                                            <div class="perfect-fleet-title">
                                                <h3>luxury car</h3>
                                                <h2>Toyota Yaris 2017</h2>
                                            </div>
                                            <!-- Perfect Fleets Content End -->

                                            <!-- Perfect Fleets Body Start -->
                                            <div class="perfect-fleet-body">
                                                <ul>
                                                    <li><img src="images/icon-fleet-list-1.svg" alt="">4
                                                        passenger</li>
                                                    <li><img src="images/icon-fleet-list-2.svg" alt="">4 door
                                                    </li>
                                                    <li><img src="images/icon-fleet-list-3.svg" alt="">bags
                                                    </li>
                                                    <li><img src="images/icon-fleet-list-4.svg" alt="">auto
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- Perfect Fleets Body End -->

                                            <!-- Perfect Fleets Footer Start -->
                                            <div class="perfect-fleet-footer">
                                                <!-- Perfect Fleets Pricing Start -->
                                                <div class="perfect-fleet-pricing">
                                                    <h2>$220<span>/day</span></h2>
                                                </div>
                                                <!-- Perfect Fleets Pricing End -->

                                                <!-- Perfect Fleets Btn Start -->
                                                <div class="perfect-fleet-btn">
                                                    <a href="#" class="section-icon-btn"><img
                                                            src="images/arrow-white.svg" alt=""></a>
                                                </div>
                                                <!-- Perfect Fleets Btn End -->
                                            </div>
                                            <!-- Perfect Fleets Footer End -->
                                        </div>
                                        <!-- Perfect Fleets Content End -->
                                    </div>
                                    <!-- Perfect Fleets Item End -->
                                </div>
                                <!-- Testimonial Slide End -->

                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <!-- Perfect Fleets Item Start -->
                                    <div class="perfect-fleet-item">
                                        <!-- Image Box Start -->
                                        <div class="image-box">
                                            <img src="images/perfect-fleet-img-2.png" alt="">
                                        </div>
                                        <!-- Image Box End -->

                                        <!-- Perfect Fleets Content Start -->
                                        <div class="perfect-fleet-content">
                                            <!-- Perfect Fleets Title Start -->
                                            <div class="perfect-fleet-title">
                                                <h3>luxury car</h3>
                                                <h2>Audi RS7 Car 2016</h2>
                                            </div>
                                            <!-- Perfect Fleets Content End -->

                                            <!-- Perfect Fleets Body Start -->
                                            <div class="perfect-fleet-body">
                                                <ul>
                                                    <li><img src="images/icon-fleet-list-1.svg" alt="">4
                                                        passenger</li>
                                                    <li><img src="images/icon-fleet-list-2.svg" alt="">4 door
                                                    </li>
                                                    <li><img src="images/icon-fleet-list-3.svg" alt="">bags
                                                    </li>
                                                    <li><img src="images/icon-fleet-list-4.svg" alt="">auto
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- Perfect Fleets Body End -->

                                            <!-- Perfect Fleets Footer Start -->
                                            <div class="perfect-fleet-footer">
                                                <!-- Perfect Fleets Pricing Start -->
                                                <div class="perfect-fleet-pricing">
                                                    <h2>$320<span>/day</span></h2>
                                                </div>
                                                <!-- Perfect Fleets Pricing End -->

                                                <!-- Perfect Fleets Btn Start -->
                                                <div class="perfect-fleet-btn">
                                                    <a href="#" class="section-icon-btn"><img
                                                            src="images/arrow-white.svg" alt=""></a>
                                                </div>
                                                <!-- Perfect Fleets Btn End -->
                                            </div>
                                            <!-- Perfect Fleets Footer End -->
                                        </div>
                                        <!-- Perfect Fleets Content End -->
                                    </div>
                                    <!-- Perfect Fleets Item End -->
                                </div>
                                <!-- Testimonial Slide End -->

                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <!-- Perfect Fleets Item Start -->
                                    <div class="perfect-fleet-item">
                                        <!-- Image Box Start -->
                                        <div class="image-box">
                                            <img src="images/perfect-fleet-img-3.png" alt="">
                                        </div>
                                        <!-- Image Box End -->

                                        <!-- Perfect Fleets Content Start -->
                                        <div class="perfect-fleet-content">
                                            <!-- Perfect Fleets Title Start -->
                                            <div class="perfect-fleet-title">
                                                <h3>luxury car</h3>
                                                <h2>Ferrari F12 Car 2022</h2>
                                            </div>
                                            <!-- Perfect Fleets Content End -->

                                            <!-- Perfect Fleets Body Start -->
                                            <div class="perfect-fleet-body">
                                                <ul>
                                                    <li><img src="images/icon-fleet-list-1.svg" alt="">4
                                                        passenger</li>
                                                    <li><img src="images/icon-fleet-list-2.svg" alt="">4 door
                                                    </li>
                                                    <li><img src="images/icon-fleet-list-3.svg" alt="">bags
                                                    </li>
                                                    <li><img src="images/icon-fleet-list-4.svg" alt="">auto
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- Perfect Fleets Body End -->

                                            <!-- Perfect Fleets Footer Start -->
                                            <div class="perfect-fleet-footer">
                                                <!-- Perfect Fleets Pricing Start -->
                                                <div class="perfect-fleet-pricing">
                                                    <h2>$450<span>/day</span></h2>
                                                </div>
                                                <!-- Perfect Fleets Pricing End -->

                                                <!-- Perfect Fleets Btn Start -->
                                                <div class="perfect-fleet-btn">
                                                    <a href="#" class="section-icon-btn"><img
                                                            src="images/arrow-white.svg" alt=""></a>
                                                </div>
                                                <!-- Perfect Fleets Btn End -->
                                            </div>
                                            <!-- Perfect Fleets Footer End -->
                                        </div>
                                        <!-- Perfect Fleets Content End -->
                                    </div>
                                    <!-- Perfect Fleets Item End -->
                                </div>
                                <!-- Testimonial Slide End -->

                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <!-- Perfect Fleets Item Start -->
                                    <div class="perfect-fleet-item">
                                        <!-- Image Box Start -->
                                        <div class="image-box">
                                            <img src="images/perfect-fleet-img-4.png" alt="">
                                        </div>
                                        <!-- Image Box End -->

                                        <!-- Perfect Fleets Content Start -->
                                        <div class="perfect-fleet-content">
                                            <!-- Perfect Fleets Title Start -->
                                            <div class="perfect-fleet-title">
                                                <h3>luxury car</h3>
                                                <h2>Toyota Yaris 2017</h2>
                                            </div>
                                            <!-- Perfect Fleets Content End -->

                                            <!-- Perfect Fleets Body Start -->
                                            <div class="perfect-fleet-body">
                                                <ul>
                                                    <li><img src="images/icon-fleet-list-1.svg" alt="">4
                                                        passenger</li>
                                                    <li><img src="images/icon-fleet-list-2.svg" alt="">4 door
                                                    </li>
                                                    <li><img src="images/icon-fleet-list-3.svg" alt="">bags
                                                    </li>
                                                    <li><img src="images/icon-fleet-list-4.svg" alt="">auto
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- Perfect Fleets Body End -->

                                            <!-- Perfect Fleets Footer Start -->
                                            <div class="perfect-fleet-footer">
                                                <!-- Perfect Fleets Pricing Start -->
                                                <div class="perfect-fleet-pricing">
                                                    <h2>$220<span>/day</span></h2>
                                                </div>
                                                <!-- Perfect Fleets Pricing End -->

                                                <!-- Perfect Fleets Btn Start -->
                                                <div class="perfect-fleet-btn">
                                                    <a href="#" class="section-icon-btn"><img
                                                            src="images/arrow-white.svg" alt=""></a>
                                                </div>
                                                <!-- Perfect Fleets Btn End -->
                                            </div>
                                            <!-- Perfect Fleets Footer End -->
                                        </div>
                                        <!-- Perfect Fleets Content End -->
                                    </div>
                                    <!-- Perfect Fleets Item End -->
                                </div>
                                <!-- Testimonial Slide End -->
                            </div>
                            <div class="car-details-btn">
                                <div class="car-button-prev"></div>
                                <div class="car-button-next"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial Slider End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Perfect Fleets Section End -->


    <!-- Our FAQs Section Start -->
    <div class="our-faqs bg-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-1 order-md-2 order-2">
                    <!-- Our Faqs Image Start -->
                    <div class="our-faqs-image">
                        <div class="faqs-img-1">
                            <figure class="image-anime">
                                <img src="images/our-faqs-img-1.jpg" alt="">
                            </figure>
                        </div>

                        <div class="faqs-img-2">
                            <figure class="image-anime">
                                <img src="images/our-faqs-img-2.jpg" alt="">
                            </figure>
                        </div>
                    </div>
                    <!-- Our Faqs Image End -->
                </div>

                <div class="col-lg-6 order-lg-2 order-md-1 order-1">
                    <!-- Our Faqs Content Start -->
                    <div class="our-faqs-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">frequently asked questions</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">Everything you need to know about our
                                services</h2>
                        </div>
                        <!-- Section Title End -->

                        <!-- Our Faqs Accordion Start -->
                        <div class="our-faqs-accordion" id="faqsaccordion">
                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.25s">
                                <h2 class="accordion-header" id="faqheading1">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faqcollapse1" aria-expanded="true"
                                        aria-controls="faqcollapse1">
                                        What do I need to rent a car?
                                    </button>
                                </h2>
                                <div id="faqcollapse1" class="accordion-collapse collapse show"
                                    aria-labelledby="faqheading1" data-bs-parent="#faqsaccordion">
                                    <div class="accordion-body">
                                        <p>Explore our diverse selection of high-end vehicles, choose your preferred
                                            pickup and return dates, and select a location that best fits your needs.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->

                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.5s">
                                <h2 class="accordion-header" id="faqheading2">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#faqcollapse2"
                                        aria-expanded="false" aria-controls="faqcollapse2">
                                        How old do I need to be to rent a car?
                                    </button>
                                </h2>
                                <div id="faqcollapse2" class="accordion-collapse collapse"
                                    aria-labelledby="faqheading2" data-bs-parent="#faqsaccordion">
                                    <div class="accordion-body">
                                        <p>Explore our diverse selection of high-end vehicles, choose your preferred
                                            pickup and return dates, and select a location that best fits your needs.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->

                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.75s">
                                <h2 class="accordion-header" id="faqheading3">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#faqcollapse3"
                                        aria-expanded="false" aria-controls="faqcollapse3">
                                        Can I rent a car with a debit card?
                                    </button>
                                </h2>
                                <div id="faqcollapse3" class="accordion-collapse collapse"
                                    aria-labelledby="faqheading3" data-bs-parent="#faqsaccordion">
                                    <div class="accordion-body">
                                        <p>Explore our diverse selection of high-end vehicles, choose your preferred
                                            pickup and return dates, and select a location that best fits your needs.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->
                        </div>
                        <!-- Our Faqs Accordion End -->
                    </div>
                    <!-- Our Faqs Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our FAQs Section End -->

    <!-- Our Testiminial Start -->
    <div class="our-testimonial">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">testimonials</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">What our customers are saying about us
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
                                                <p>Renting a car from nova ride was a great decision. Not only did I get
                                                    a reliable and comfortable vehicle, but the prices were also very
                                                    competitive.</p>
                                            </div>
                                        </div>
                                        <div class="testimonial-body">
                                            <div class="author-image">
                                                <figure class="image-anime">
                                                    <img src="images/author-1.jpg" alt="">
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
                                                <p>Renting a car from nova ride was a great decision. Not only did I get
                                                    a reliable and comfortable vehicle, but the prices were also very
                                                    competitive.</p>
                                            </div>
                                        </div>
                                        <div class="testimonial-body">
                                            <div class="author-image">
                                                <figure class="image-anime">
                                                    <img src="images/author-2.jpg" alt="">
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
                                                <p>Renting a car from nova ride was a great decision. Not only did I get
                                                    a reliable and comfortable vehicle, but the prices were also very
                                                    competitive.</p>
                                            </div>
                                        </div>
                                        <div class="testimonial-body">
                                            <div class="author-image">
                                                <figure class="image-anime">
                                                    <img src="images/author-3.jpg" alt="">
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
                                                <p>Renting a car from nova ride was a great decision. Not only did I get
                                                    a reliable and comfortable vehicle, but the prices were also very
                                                    competitive.</p>
                                            </div>
                                        </div>
                                        <div class="testimonial-body">
                                            <div class="author-image">
                                                <figure class="image-anime">
                                                    <img src="images/author-4.jpg" alt="">
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


    <!-- Footer Start -->
    <footer class="main-footer bg-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <!-- About Footer Start -->
                    <div class="about-footer">
                        <!-- Footer Logo Start -->
                        <div class="footer-logo">
                            <img src="{{ asset('front/images/jod_white.png') }}" alt="">
                        </div>
                        <!-- Footer Logo End -->

                        <!-- About Footer Content Start -->
                        <div class="about-footer-content">
                            <p>Experience the ease and convenience of renting a car with Novaride. </p>
                        </div>
                        <!-- About Footer Content End -->
                    </div>
                    <!-- About Footer End -->
                </div>

                <div class="col-lg-3 col-md-4">
                    <!-- Footer Quick Links Start -->
                    <div class="footer-links footer-quick-links">
                        <h3>Politique</h3>
                        <ul>
                            <li><a href="#">Termes et Conditions d'utilisation</a></li>
                            <li><a href="#">Politique de confidentialité</a></li>
                            <li><a href="#">Contrat</a></li>
                        </ul>
                    </div>
                    <!-- Footer Quick Links End -->
                </div>

                <div class="col-lg-3 col-md-4">

                </div>

                <div class="col-lg-3 col-md-4">
                    <!-- Footer Newsletter Start -->
                    <div class="footer-newsletter">
                        <h3>S'enregistrer à la Newsletter</h3>
                        <!-- Footer Newsletter Form Start -->
                        <div class="footer-newsletter-form">
                            <form id="newslettersForm" action="#" method="POST">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" id="mail"
                                        placeholder="Email ..." required>
                                    <button type="submit" class="section-icon-btn"><img
                                            src="{{ asset('front/images/arrow-white.svg') }}"
                                            alt=""></button>
                                </div>
                            </form>
                        </div>
                        <!-- Footer Newsletter Form End -->
                    </div>
                    <!-- Footer Newsletter End -->
                </div>
            </div>

            <!-- Footer Copyright Section Start -->
            <div class="footer-copyright">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-7">
                        <!-- Footer Copyright Start -->
                        <div class="footer-copyright-text">
                            <p>© {{ date('Y') }} JOD Trade & Co. Tous Droits Réservés.</p>
                        </div>
                        <!-- Footer Copyright End -->
                    </div>

                    <div class="col-lg-6 col-md-5">
                        <!-- Footer Social Link Start -->
                        <div class="footer-social-links">
                            <ul>
                                <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                        <!-- Footer Social Link End -->
                    </div>
                </div>
            </div>
            <!-- Footer Copyright Section End -->
        </div>
    </footer>
    <!-- Footer End -->

    <!-- Jquery Library File -->
    <script src="{{ asset('front/js/jquery-3.7.1.min.js') }}"></script>
    <!-- Jquery Ui Js File -->
    <script src="{{ asset('front/js/jquery-ui.js') }}"></script>
    <!-- Bootstrap js file -->
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <!-- Validator js file -->
    <script src="{{ asset('front/js/validator.min.js') }}"></script>
    <!-- SlickNav js file -->
    <script src="{{ asset('front/js/jquery.slicknav.js') }}"></script>
    <!-- Swiper js file -->
    <script src="{{ asset('front/js/swiper-bundle.min.js') }}"></script>
    <!-- Counter js file -->
    <script src="{{ asset('front/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.counterup.min.js') }}"></script>
    <!-- Magnific js file -->
    <script src="{{ asset('front/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- SmoothScroll -->
    <script src="{{ asset('front/js/SmoothScroll.js') }}"></script>
    <!-- Parallax js -->
    <script src="{{ asset('front/js/parallaxie.js') }}"></script>
    <!-- MagicCursor js file -->
    <script src="{{ asset('front/js/gsap.min.js') }}"></script>
    <script src="{{ asset('front/js/magiccursor.js') }}"></script>
    <!-- Text Effect js file -->
    <script src="{{ asset('front/js/SplitText.js') }}"></script>
    <script src="{{ asset('front/js/ScrollTrigger.min.js') }}"></script>
    <!-- YTPlayer js File -->
    <script src="{{ asset('front/js/jquery.mb.YTPlayer.min.js') }}"></script>
    <!-- Wow js file -->
    <script src="{{ asset('front/js/wow.js') }}"></script>
    <!-- Main Custom js file -->
    <script src="{{ asset('front/js/function.js') }}"></script>
    <script src="{{ asset('front/js/theme-panel.js') }}"></script>
</body>

</html>
