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
                        <h1 class="text-anime-style-3" data-cursor="-opaque">Contactez nous</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
                                <li class="breadcrumb-item active" aria-current="page">contactez nous</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Page Contact Us Start -->
    <div class="page-contact-us">
        <div class="contact-info-form">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Contact Information Start -->
                        <div class="contact-information">
                            <!-- Contact Information Title Start -->
                            <div class="section-title">
                                <h2 class="text-anime-style-3" data-cursor="-opaque">Informations pour Contact</h2>
                                <p>Dites quelque chose pour commencer à discuter!</p>
                            </div>
                            <!-- Contact Information Title End -->

                            <!-- Contact Information List Start -->
                            <div class="contact-info-list">
                                <!-- Contact Info Item Start -->
                                <div class="contact-info-item wow fadeInUp" data-wow-delay="0.25s">
                                    <!-- Icon Box Start -->
                                    <div class="icon-box">
                                        <img src="{{ asset('images/icon-phone.svg') }}" alt="">
                                    </div>
                                    <!-- Icon Box End -->

                                    <!-- Contact Info Content Start -->
                                    <div class="contact-info-content">
                                        <p>(+241) 789 854 856</p>
                                    </div>
                                    <!-- Contact Info Content End -->
                                </div>
                                <!-- Contact Info Item End -->

                                <!-- Contact Info Item Start -->
                                <div class="contact-info-item wow fadeInUp" data-wow-delay="0.5s">
                                    <!-- Icon Box Start -->
                                    <div class="icon-box">
                                        <img src="{{ asset('images/icon-mail.svg') }}" alt="">
                                    </div>
                                    <!-- Icon Box End -->

                                    <!-- Contact Info Content Start -->
                                    <div class="contact-info-content">
                                        <p>jod@jobs-conseil.host</p>
                                    </div>
                                    <!-- Contact Info Content End -->
                                </div>
                                <!-- Contact Info Item End -->

                                <!-- Contact Info Item Start -->
                                <div class="contact-info-item wow fadeInUp" data-wow-delay="0.75s">
                                    <!-- Icon Box Start -->
                                    <div class="icon-box">
                                        <img src="{{ asset('images/icon-location.svg') }}" alt="">
                                    </div>
                                    <!-- Icon Box End -->

                                    <!-- Contact Info Content Start -->
                                    <div class="contact-info-content">
                                        <p>Avenue le Cointet, Libreville, Gabon</p>
                                    </div>
                                    <!-- Contact Info Content End -->
                                </div>
                                <!-- Contact Info Item End -->
                            </div>
                            <!-- Contact Information List End -->

                            <!-- Contact Information Social Start -->
                            <div class="contact-info-social wow fadeInUp" data-wow-delay="0.5s">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                </ul>
                            </div>
                            <!-- Contact Information Social End -->
                        </div>
                        <!-- Contact Information End -->
                    </div>

                    <div class="col-lg-6">
                        <!-- Contact Form Start -->
                        <div class="contact-us-form">
                            <form id="contactForm" action="#" method="POST" data-toggle="validator"
                                class="wow fadeInUp" data-wow-delay="0.5s">
                                <div class="row">
                                    <div class="form-group col-md-6 mb-4">
                                        <label>Prenoms</label>
                                        <input type="text" name="name" class="form-control" id="fname"
                                            placeholder="Entrez votre prenom" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label>Noms</label>
                                        <input type="text" name="name" class="form-control" id="lname"
                                            placeholder="Entrez votre nom" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label>email</label>
                                        <input type="email" name ="email" class="form-control" id="email"
                                            placeholder="Entrez votre email" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label>Telephone</label>
                                        <input type="text" name="phone" class="form-control" id="phone"
                                            placeholder="Entrez votre Numero de telephone" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-12 mb-4">
                                        <label>message</label>
                                        <textarea name="msg" class="form-control" id="msg" rows="4" placeholder="Laissez nous un message" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="contact-form-btn">
                                            <button type="submit" class="btn-default">Envoyer un Message!</button>
                                            <div id="msgSubmit" class="h3 hidden"></div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Contact Form End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Contact Us End -->

    <!-- Google Map Start -->
    <div class="google-map">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Localisation</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Comment nous rejoindre?</h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Google Map Iframe Start -->
                    <div class="google-map-iframe">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2227.086035068027!2d9.447285952391784!3d0.3898061504474474!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x107f3b906bc6b4c9%3A0x4d178487bf5e6771!2sJOBS%20CONSEIL!5e0!3m2!1sfr!2sga!4v1750779226714!5m2!1sfr!2sga" 
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    <!-- Google Map Iframe End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Google Map End -->
@endsection

@push('scripts')
@endpush
