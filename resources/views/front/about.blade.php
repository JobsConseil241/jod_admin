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
                        <h1 class="text-anime-style-3" data-cursor="-opaque">About Us</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">about us</li>
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
                            <h2 class="text-anime-style-3" data-cursor="-opaque">Your trusted partner in reliable car rental
                            </h2>
                            <p class="wow fadeInUp" data-wow-delay="0.25s">Aqestic Optio Amet A Ququam Saepe Aliquid Voluate
                                Dicta Fuga Dolor Saerror Sed Earum A Magni Soluta Quam Minus Dolor Dolor</p>
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
                                    <p>We Have Optimized The Booking Process So That Our Clients Can Experience The Easiest
                                        And The Safest Service</p>
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
                                    <p>We Have Optimized The Booking Process So That Our Clients Can Experience The Easiest
                                        And The Safest Service</p>
                                </div>
                            </div>
                            <!-- About Trusted Booking End -->
                        </div>
                        <!-- About Content Body End -->
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
                        <h3 class="wow fadeInUp">vision mission</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Driving excellence and innovation in car
                            rental services</h2>
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
                                    data-bs-target="#vision" type="button" role="tab" aria-selected="true">our
                                    vision</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#mission"
                                    type="button" role="tab" aria-selected="false">our mission</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#approach" type="button" role="tab" aria-selected="false">our
                                    approach</button>
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
                                            <h3 class="wow fadeInUp">our vision</h3>
                                            <h2 class="text-anime-style-3" data-cursor="-opaque">Pioneering excellence in
                                                car rental services</h2>
                                            <p class="wow fadeInUp" data-wow-delay="0.25s">We aim to continually innovate
                                                and integrate the latest technology into our services. From easy online
                                                bookings to advanced vehicle tracking systems, our goal is to make the car
                                                rental process seamless and efficient for our customers. Quality is at the
                                                heart of everything we do. We maintain a diverse fleet of well-maintained
                                                vehicles that meet the highest standards of safety and comfort.</p>
                                        </div>
                                        <!-- Section Title End -->

                                        <!-- Vision Mission List Start -->
                                        <div class="vision-mission-list wow fadeInUp" data-wow-delay="0.5s">
                                            <ul>
                                                <li>Our customers are our top priority</li>
                                                <li>Quality is at the heart of everything we do</li>
                                                <li>every vehicle leaves care looking its absolute best</li>
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
                                            <img src="images/our-vision-img.jpg" alt="">
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
                                            <h3>our mission</h3>
                                            <h2 data-cursor="-opaque">Pioneering excellence in car rental services</h2>
                                            <p>We aim to continually innovate and integrate the latest technology into our
                                                services. From easy online bookings to advanced vehicle tracking systems,
                                                our goal is to make the car rental process seamless and efficient for our
                                                customers. Quality is at the heart of everything we do. We maintain a
                                                diverse fleet of well-maintained vehicles that meet the highest standards of
                                                safety and comfort.</p>
                                        </div>
                                        <!-- Section Title End -->

                                        <!-- Vision Mission List Start -->
                                        <div class="vision-mission-list">
                                            <ul>
                                                <li>Our customers are our top priority</li>
                                                <li>Quality is at the heart of everything we do</li>
                                                <li>every vehicle leaves care looking its absolute best</li>
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
                                            <img src="images/our-mission-img.jpg" alt="">
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
                                            <h3>our approach</h3>
                                            <h2 data-cursor="-opaque">Pioneering excellence in car rental services</h2>
                                            <p>We aim to continually innovate and integrate the latest technology into our
                                                services. From easy online bookings to advanced vehicle tracking systems,
                                                our goal is to make the car rental process seamless and efficient for our
                                                customers. Quality is at the heart of everything we do. We maintain a
                                                diverse fleet of well-maintained vehicles that meet the highest standards of
                                                safety and comfort.</p>
                                        </div>
                                        <!-- Section Title End -->

                                        <!-- Vision Mission List Start -->
                                        <div class="vision-mission-list">
                                            <ul>
                                                <li>Our customers are our top priority</li>
                                                <li>Quality is at the heart of everything we do</li>
                                                <li>every vehicle leaves care looking its absolute best</li>
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
                                            <img src="images/our-approach-img.jpg" alt="">
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
    <div class="our-video bg-section">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">watch our video</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Discover what sets us apart in the car rental
                            industry</h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <!-- Customer Counter Item Start -->
                    <div class="customer-counter-item">
                        <!-- Customer Counter Image Start -->
                        <div class="customer-counter-image">
                            <img src="images/video-counter-img-1.jpg" alt="">
                        </div>
                        <!-- Customer Counter Image End -->

                        <!-- Satisfied Customer Counter Start -->
                        <div class="satisfied-customer-counter">
                            <h3><span class="counter">3100</span>+</h3>
                            <p>satisfied customer</p>
                        </div>
                        <!-- Satisfied Customer Counter End -->

                        <!-- Satisfied Customer Image Start -->
                        <div class="satisfied-customer-image">
                            <img src="images/satisfied-customer-img.png" alt="">
                        </div>
                        <!-- Satisfied Customer Image End -->
                    </div>
                    <!-- Customer Counter Item End -->
                </div>

                <div class="col-lg-8 col-md-7">
                    <!-- Video Image Box Start -->
                    <div class="video-image-box">
                        <!-- Video Image Start -->
                        <div class="video-image" data-cursor-text="Play">
                            <figure>
                                <a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="popup-video">
                                    <img src="images/video-counter-img-2.jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <!-- Video Image End -->

                        <!-- Video Image Play Button Start -->
                        <div class="video-image-play-button" data-cursor-text="Play">
                            <a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="popup-video">
                                <i class="fa-solid fa-play"></i>
                            </a>
                        </div>
                        <!-- Video Image Play Button End -->
                    </div>
                    <!-- Video Image Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our Video Section End -->

    <!-- Why Choose Us Section Start -->
    <div class="why-choose-us">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">why choose us</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Unmatched quality and service for your needs
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
                            <img src="images/icon-why-choose-1.svg" alt="">
                        </div>
                        <div class="why-choose-content">
                            <h3>extensive fleet options</h3>
                            <p>Quisque Sollicitudin Feugiat Risus, Eu Posuere Ex Euismod Eu. Phasellus Hendrerit, Massa</p>
                        </div>
                    </div>
                    <!-- Why Choose Item End -->

                    <!-- Why Choose Item Start -->
                    <div class="why-choose-item wow fadeInUp" data-wow-delay="0.25s">
                        <div class="icon-box">
                            <img src="images/icon-why-choose-2.svg" alt="">
                        </div>
                        <div class="why-choose-content">
                            <h3>exceptional customer service</h3>
                            <p>Quisque Sollicitudin Feugiat Risus, Eu Posuere Ex Euismod Eu. Phasellus Hendrerit, Massa</p>
                        </div>
                    </div>
                    <!-- Why Choose Item End -->
                </div>

                <div class="col-lg-4 col-md-12 order-lg-2 order-md-3 order-2">
                    <div class="why-choose-image">
                        <figure class="reveal">
                            <img src="images/why-choose-img.jpg" alt="">
                        </figure>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 order-lg-3 order-md-2 order-3">
                    <!-- Why Choose Item Start -->
                    <div class="why-choose-item wow fadeInUp">
                        <div class="icon-box">
                            <img src="images/icon-why-choose-3.svg" alt="">
                        </div>
                        <div class="why-choose-content">
                            <h3>convenient locations</h3>
                            <p>Quisque Sollicitudin Feugiat Risus, Eu Posuere Ex Euismod Eu. Phasellus Hendrerit, Massa</p>
                        </div>
                    </div>
                    <!-- Why Choose Item End -->

                    <!-- Why Choose Item Start -->
                    <div class="why-choose-item wow fadeInUp" data-wow-delay="0.25s">
                        <div class="icon-box">
                            <img src="images/icon-why-choose-4.svg" alt="">
                        </div>
                        <div class="why-choose-content">
                            <h3>reliability and safety</h3>
                            <p>Quisque Sollicitudin Feugiat Risus, Eu Posuere Ex Euismod Eu. Phasellus Hendrerit, Massa</p>
                        </div>
                    </div>
                    <!-- Why Choose Item End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Why Choose Us Section End -->

    <!-- Our Team Start -->
    <div class="our-team bg-section">
        <div class="container">
            <div class="row align-items-center section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">our experienced drivers</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Ensuring your safety and comfort on every
                            journey</h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <!-- Team Member Item Start -->
                    <div class="team-member-item wow fadeInUp">
                        <!-- Team Image Start -->
                        <div class="team-image">
                            <figure class="image-anime">
                                <img src="images/team-1.jpg" alt="">
                            </figure>

                            <!-- Team Social Icon Start -->
                            <div class="team-social-icon">
                                <ul>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a>
                                    </li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-youtube"></i></a>
                                    </li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
                                    </li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-x-twitter"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Team Social Icon End -->
                        </div>
                        <!-- Team Image End -->

                        <!-- Team Content Start -->
                        <div class="team-content">
                            <h3>john smith</h3>
                            <p>senior chauffeur</p>
                        </div>
                        <!-- Team Content End -->
                    </div>
                    <!-- Team Member Item End -->
                </div>

                <div class="col-lg-3 col-md-6">
                    <!-- Team Member Item Start -->
                    <div class="team-member-item wow fadeInUp" data-wow-delay="0.25s">
                        <!-- Team Image Start -->
                        <div class="team-image">
                            <figure class="image-anime">
                                <img src="images/team-2.jpg" alt="">
                            </figure>

                            <!-- Team Social Icon Start -->
                            <div class="team-social-icon">
                                <ul>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a>
                                    </li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-youtube"></i></a>
                                    </li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
                                    </li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-x-twitter"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Team Social Icon End -->
                        </div>
                        <!-- Team Image End -->

                        <!-- Team Content Start -->
                        <div class="team-content">
                            <h3>taylor smith</h3>
                            <p>city tour guide</p>
                        </div>
                        <!-- Team Content End -->
                    </div>
                    <!-- Team Member Item End -->
                </div>

                <div class="col-lg-3 col-md-6">
                    <!-- Team Member Item Start -->
                    <div class="team-member-item wow fadeInUp" data-wow-delay="0.5s">
                        <!-- Team Image Start -->
                        <div class="team-image">
                            <figure class="image-anime">
                                <img src="images/team-3.jpg" alt="">
                            </figure>

                            <!-- Team Social Icon Start -->
                            <div class="team-social-icon">
                                <ul>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a>
                                    </li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-youtube"></i></a>
                                    </li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
                                    </li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-x-twitter"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Team Social Icon End -->
                        </div>
                        <!-- Team Image End -->

                        <!-- Team Content Start -->
                        <div class="team-content">
                            <h3>jordan brown</h3>
                            <p>distance driver</p>
                        </div>
                        <!-- Team Content End -->
                    </div>
                    <!-- Team Member Item End -->
                </div>

                <div class="col-lg-3 col-md-6">
                    <!-- Team Member Item Start -->
                    <div class="team-member-item wow fadeInUp" data-wow-delay="0.75s">
                        <!-- Team Image Start -->
                        <div class="team-image">
                            <figure class="image-anime">
                                <img src="images/team-4.jpg" alt="">
                            </figure>

                            <!-- Team Social Icon Start -->
                            <div class="team-social-icon">
                                <ul>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a>
                                    </li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-youtube"></i></a>
                                    </li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
                                    </li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-x-twitter"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Team Social Icon End -->
                        </div>
                        <!-- Team Image End -->

                        <!-- Team Content Start -->
                        <div class="team-content">
                            <h3>davis casey</h3>
                            <p>travel specialist</p>
                        </div>
                        <!-- Team Content End -->
                    </div>
                    <!-- Team Member Item End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our Team End -->

    <!-- Our Testiminial Start -->
    <div class="our-testimonial">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">testimonials</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">What our customers are saying about us</h2>
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
                                                <p>Renting a car from nova ride was a great decision. Not only did I get a
                                                    reliable and comfortable vehicle, but the prices were also very
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
                                                <p>Renting a car from nova ride was a great decision. Not only did I get a
                                                    reliable and comfortable vehicle, but the prices were also very
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
                                                <p>Renting a car from nova ride was a great decision. Not only did I get a
                                                    reliable and comfortable vehicle, but the prices were also very
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
                                                <p>Renting a car from nova ride was a great decision. Not only did I get a
                                                    reliable and comfortable vehicle, but the prices were also very
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
@endsection

@push('scripts')
@endpush
