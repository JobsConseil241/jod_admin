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
                        <h1 class="text-anime-style-3" data-cursor="-opaque">{{$car->name}} ({{$car->marque->name}})</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('cars-list') }}">car</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $car->name }}</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Page Feets Single Start -->
    <div class="page-fleets-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <!-- Feets Single Sidebar Start -->
                    <div class="fleets-single-sidebar">
                        <div class="fleets-single-sidebar-box wow fadeInUp">
                            <!-- Feets Single Sidebar Pricing Start -->
                            <div class="fleets-single-sidebar-pricing">
                                <h2><span>XAF</span> {{ $car->prix_location }}<span>/par jour</span></h2>
                            </div>
                            <!-- Feets Single Sidebar Pricing End -->

                            <!-- Feets Single Sidebar List Start -->
                            <div class="fleets-single-sidebar-list">
                                <ul>
                                    <li><img src="{{asset('front/images/icon-fleets-single-sidebar-list-1.svg')}}" alt="">Places
                                        <span>{{$car->nombre_places}}</span></li>
                                    <li><img src="{{asset('front/images/icon-fleets-single-sidebar-list-2.svg')}}" alt="">Bagages
                                        <span>Oui</span></li>
                                    <li><img src="{{asset('front/images/icon-fleets-single-sidebar-list-3.svg')}}" alt="">Portes
                                        <span>{{$car->nombre_portes}}</span></li>
                                    <li><img src="{{asset('front/images/icon-fleets-single-sidebar-list-4.svg')}}" alt="">Transmission
                                        <span>{{$car->transmission}}</span></li>
                                    <li><img src="{{asset('front/images/icon-fleets-single-sidebar-list-5.svg')}}" alt="">Climatisation
                                        <span>Oui</span></li>
{{--                                    <li><img src="{{asset('front/images/icon-fleets-single-sidebar-list-6.svg')}}" alt="">Age (years)--}}
{{--                                        <span>5</span></li>--}}
                                </ul>
                            </div>
                            <!-- Feets Single Sidebar List End -->

                            <!-- Feets Single Sidebar Btn Start -->
                            <div class="fleets-single-sidebar-btn">
                                <a href="#bookingform" class="btn-default popup-with-form">Reservez !</a>
                                <span>Ou</span>
                                <a href="https://wa.link/vu4iro" class="wp-btn"><i class="fa-brands fa-whatsapp"></i></a>
                            </div>
                            <!-- Feets Single Sidebar Btn End -->
                        </div>

                        <!-- Booking Form Box Start -->
                        <div class="booking-form-box">
                            <!-- Booking PopUp Form Start -->
                            <form id="bookingform" class="white-popup-block mfp-hide booking-form">
                                <div class="section-title">
                                    <h2>Réservez votre véhicule dès aujourd'hui!</h2>
                                    <p>Remplissez le formulaire ci-dessous pour réserver votre véhicule. Remplissez les détails nécessaires pour
                                        garantir une expérience de location fluide.</p>
                                </div>
                                <fieldset>
                                    <div class="row">
{{--                                        <div class="booking-form-group col-md-6 mb-4">--}}
{{--                                            <input type="text" name="name" class="booking-form-control" id="name"--}}
{{--                                                placeholder="Full Name" required>--}}
{{--                                            <div class="help-block with-errors"></div>--}}
{{--                                        </div>--}}

{{--                                        <div class="booking-form-group col-md-6 mb-4">--}}
{{--                                            <input type="email" name ="email" class="booking-form-control" id="email"--}}
{{--                                                placeholder="Enter Your Email" required>--}}
{{--                                            <div class="help-block with-errors"></div>--}}
{{--                                        </div>--}}

{{--                                        <div class="booking-form-group col-md-6 mb-4">--}}
{{--                                            <input type="text" name="phone" class="booking-form-control" id="phone"--}}
{{--                                                placeholder="Enter Your Number" required>--}}
{{--                                            <div class="help-block with-errors"></div>--}}
{{--                                        </div>--}}

                                        <div class="booking-form-group col-md-12 mb-4">
                                            <select name="cartype" class="booking-form-control form-select" id="cartype"
                                                required>
                                                <option value="" disabled selected>Choisissez votre vehicule</option>
                                                <option value="sport_car">sport car</option>
                                                <option value="convertible_car">convertible car</option>
                                                <option value="sedan_car">sedan car</option>
                                                <option value="luxury_car">luxury car</option>
                                                <option value="electric_car">electric car</option>
                                                <option value="coupe_car">coupe car</option>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <select name="location" class="booking-form-control form-select"
                                                id="pickuplocation" required>
                                                <option value="" disabled selected>Zone de Recuperation du Vehicule</option>
                                                <option value="livraison">Livraison</option>
                                                <option value="Agence">A L'agence</option>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="text" name="date" placeholder="Date de Recuperation"
                                                class="booking-form-control datepicker" id="pickupdate" required>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <select name="droplocation" class="booking-form-control form-select"
                                                id="droplocation" required>
                                                <option value="" disabled selected>Drop Off Location</option>
                                                <option value="abu_dhabi">abu dhabi</option>
                                                <option value="alain">alain</option>
                                                <option value="sharjah">sharjah</option>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="text" name="date" class="booking-form-control datepicker"
                                                id="returndate" placeholder="Date de retour" required>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-12 mb-4">
                                            <textarea name="msg" class="booking-form-control" id="msg" rows="3"
                                                placeholder="Entrez des details" required></textarea>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="col-md-12 booking-form-group">
                                            <button type="submit" class="btn-default">Reservez Maintenant</button>
                                            <div id="msgSubmit" class="h3 hidden"></div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                            <!-- Booking PopUp Form End -->
                        </div>
                        <!-- Booking Form Box End -->
                    </div>
                    <!-- Feets Single Sidebar End -->
                </div>

                <div class="col-lg-8">
                    <!-- Feets Single Content Start -->
                    <div class="fleets-single-content">
                        <!-- Feets Single Slider Start -->
                        <div class="fleets-single-slider">
                            <div class="swiper">
                                <div class="swiper-wrapper">
                                    @if($car->vehiculeMedias)
                                        <!-- Fleets Image Slide Start -->
                                        <div class="swiper-slide">
                                            <div class="fleets-slider-image">
                                                <figure class="image-anime">
                                                    <img src="{{asset($car->vehiculeMedias[0]->photo_avant)}}" alt="">
                                                </figure>
                                            </div>
                                        </div>
                                        <!-- Fleets Image Slide End -->


                                        <!-- Fleets Image Slide Start -->
                                        <div class="swiper-slide">
                                            <div class="fleets-slider-image">
                                                <figure class="image-anime">
                                                    <img src="{{asset($car->vehiculeMedias[0]->photo_arriere)}}" alt="">
                                                </figure>
                                            </div>
                                        </div>
                                        <!-- Fleets Image Slide End -->
                                        <!-- Fleets Image Slide Start -->
                                        <div class="swiper-slide">
                                            <div class="fleets-slider-image">
                                                <figure class="image-anime">
                                                    <img src="{{asset($car->vehiculeMedias[0]->photo_gauche)}}" alt="">
                                                </figure>
                                            </div>
                                        </div>
                                        <!-- Fleets Image Slide End -->
                                        <!-- Fleets Image Slide Start -->
                                        <div class="swiper-slide">
                                            <div class="fleets-slider-image">
                                                <figure class="image-anime">
                                                    <img src="{{asset($car->vehiculeMedias[0]->photo_droite)}}" alt="">
                                                </figure>
                                            </div>
                                        </div>
                                        <!-- Fleets Image Slide End -->
                                        <!-- Fleets Image Slide Start -->
                                        <div class="swiper-slide">
                                            <div class="fleets-slider-image">
                                                <figure class="image-anime">
                                                    <img src="{{asset($car->vehiculeMedias[0]->photo_dashboard)}}" alt="">
                                                </figure>
                                            </div>
                                        </div>
                                        <!-- Fleets Image Slide End -->
                                        <!-- Fleets Image Slide Start -->
                                        <div class="swiper-slide">
                                            <div class="fleets-slider-image">
                                                <figure class="image-anime">
                                                    <img src="{{asset($car->vehiculeMedias[0]->photo_interieur)}}" alt="">
                                                </figure>
                                            </div>
                                        </div>
                                        <!-- Fleets Image Slide End -->
                                    @endif

                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                        <!-- Feets Single Slider End -->

                        <!-- Feets Benefits Start -->
                        <div class="fleets-benefits wow fadeInUp">
                            <!-- Feets Benefits Item Start -->
                            <div class="fleets-benefits-item">
                                <div class="icon-box">
                                    <img src="{{asset('front/images/icon-fleets-benefits-1.svg')}}" alt="">
                                </div>
                                <div class="fleets-benefits-content">
                                    <h3>KMs illimités</h3>
                                    <p>Des kilomètres interminables sans frais supplémentaires</p>
                                </div>
                            </div>
                            <!-- Feets Benefits Item End -->

                            <!-- Feets Benefits Item Start -->
                            <div class="fleets-benefits-item">
                                <div class="icon-box">
                                    <img src="{{asset('front/images/icon-fleets-benefits-2.svg')}}" alt="">
                                </div>
                                <div class="fleets-benefits-content">
                                    <h3>KMs illimités</h3>
                                    <p>Des kilomètres interminables sans frais supplémentaires</p>
                                </div>
                            </div>
                            <!-- Feets Benefits Item End -->
                        </div>
                        <!-- Feets Benefits End -->

                        <!-- Feets Information Start -->
                        <div class="fleets-information">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h3 class="wow fadeInUp">Informations generales</h3>
                                <h2 class="text-anime-style-3" data-cursor="-opaque">Connaître notre service de voiture</h2>
                                <p class="wow fadeInUp" data-wow-delay="0.25s">
                                    Notre service de location de voitures au Gabon s'appuie sur une flotte diversifiée et moderne de véhicules soigneusement entretenus.
                                    Chaque véhicule subit des contrôles réguliers pour garantir sécurité et fiabilité optimales.Nos véhicules sont équipés de GPS, climatisation et systèmes de sécurité modernes. L'assurance tous risques et l'assistance 24/7 sont incluses dans nos forfaits.
                                    Notre équipe professionnelle assure un service personnalisé, de la réservation à la restitution.
                                </p>
                            </div>
                            <!-- Section Title End -->

                            <!-- Feets Information List Start -->
                            <div class="fleets-information-list wow fadeInUp" data-wow-delay="0.5s">
                                <ul>
                                    <li>Assistance routière 24h/24 et 7j/7</li>
                                    <li>Annulation et retour gratuits</li>
                                    <li>Louez maintenant, payez à votre arrivée</li>
                                </ul>
                            </div>
                            <!-- Feets Information List End -->
                        </div>
                        <!-- Feets Information End -->

                        <!-- Feets Amenities Start -->
                        <div class="fleets-amenities">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h3 class="wow fadeInUp">équipements</h3>
                                <h2 class="text-anime-style-3" data-cursor="-opaque">Équipements et fonctionnalités haut de gamme</h2>
                            </div>
                            <!-- Section Title End -->

                            <!-- Feets Amenities List Start -->
                            <div class="fleets-amenities-list wow fadeInUp" data-wow-delay="0.25s">
                                @if($car->latestEtat)
                                    <ul>
                                        @foreach ($car->latestEtat->toArray() as $key => $value)
                                            @if ($value === 1)
                                                <li>{{ str_replace('_', ' ', $key) }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <!-- Feets Amenities List End -->
                        </div>
                        <!-- Feets Amenities End -->

                        <!-- Rental Conditions Faqs Start -->
                        <div class="rental-conditions-faqs">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h3 class="wow fadeInUp">CONDITIONS GÉNÉRALES DU CONTRAT DE LOCATION</h3>
                                <h2 class="text-anime-style-3" data-cursor="-opaque">Politiques et accord</h2>
                            </div>
                            <!-- Section Title End -->

                            <!-- Rental Conditions FAQ Accordion Start -->
                            <div class="rental-condition-accordion" id="rentalaccordion">
                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp">
                                    <h2 class="accordion-header" id="rentalheading1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#rentalcollapse1" aria-expanded="true"
                                            aria-controls="rentalcollapse1">
                                            Objet
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse1" class="accordion-collapse collapse show"
                                        aria-labelledby="rentalheading1" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>Le Loueur met à disposition du Locataire un véhicule à titre onéreux pour un usage de tourisme dans le périmètre urbain du grand Libreville (Akanda, Libreville, Owendo
                                                et Nkok). La présente location est personnelle et non transmissible. Le Loueur s'engage à fournir le véhicule en bon état de fonctionnement avec tous les documents et
                                                équipements afférents à la circulation routière à jour.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="0.25s">
                                    <h2 class="accordion-header" id="rentalheading2">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#rentalcollapse2"
                                            aria-expanded="false" aria-controls="rentalcollapse2">
                                            Durée de location / Livraison et restitution du véhicule
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse2" class="accordion-collapse collapse"
                                        aria-labelledby="rentalheading2" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>La durée de la présente location est précisée dans les dispositions particulières. Un retard de 1 heure pourra être accordé par le Loueur, sans frais supplémentaires pour le Locataire. Au-delà, il sera facturé d'une pénalité de retard de 5000 FCFA, limité à 1 heure.
                                                Le Locataire doit demander au Loueur, au moins 24 heures à l'avance, la prolongation de sa location, en l'accompagnant de la provision correspondante au moins 6 heures avant l'heure prévue de la fin de la prestation initiale.
                                                Le véhicule devra être restitué dans le même état et les mêmes conditions que celles définies lors de la livraison à l'agence JOD. Tout dégât doit être signalé sur le contrat de location avant le départ. Toute livraison ou restitution hors de
                                                l'agence JOD donnera droit à des frais de déplacement de 5 000 F CFA.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="0.5s">
                                    <h2 class="accordion-header" id="rentalheading3">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#rentalcollapse3"
                                            aria-expanded="false" aria-controls="rentalcollapse3">
                                            Montant et modalités de paiement
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse3" class="accordion-collapse collapse"
                                        aria-labelledby="rentalheading3" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>Le montant total de la location est de 35 000 Francs CFA par jour. Le Locataire s'engage à payer le montant total selon les modalités suivantes: à la réservation ou à la livraison,
                                                en cash ou par mobile money (majoré des frais de transaction) au numéro suivant: 077 09 35 39.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="0.75s">
                                    <h2 class="accordion-header" id="rentalheading4">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#rentalcollapse4"
                                            aria-expanded="false" aria-controls="rentalcollapse4">
                                            Age minimal/conducteurs supplémentaires
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse4" class="accordion-collapse collapse"
                                        aria-labelledby="rentalheading4" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>L'âge minimal du conducteur est de 21 ans. Le conducteur doit être en possession d'un permis de conduire valide depuis une année au moins. Seul le Locataire a le droit de conduire le véhicule. Un conducteur supplémentaire ne peut conduire que si la taxe pour conducteur supplémentaire de 10 000 F CFA est convenue lors de la conclusion du contrat. Le Locataire est responsable pour la totalité des dégâts causés par une tierce personne qui conduisait.
                                                Sur demande, le Locataire doit fournir à tout moment le nom et l'adresse du conducteur à JOD.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="1s">
                                    <h2 class="accordion-header" id="rentalheading5">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#rentalcollapse5"
                                            aria-expanded="false" aria-controls="rentalcollapse5">
                                            Restrictions générales d'utilisation
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse5" class="accordion-collapse collapse"
                                        aria-labelledby="rentalheading5" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>Tout dépassement des zones définies ci-dessus est une violation du présent contrat et engendre une pénalité de 5 000 F CFA par kilomètre parcouru dans la limite de 10km.
                                                Le Locataire reconnaît qu'il est responsable pour la totalité du dommage en cas de violation. Il est strictement interdit de fumer dans le véhicule.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="1.25s">
                                    <h2 class="accordion-header" id="rentalheading6">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#rentalcollapse6"
                                            aria-expanded="false" aria-controls="rentalcollapse6">
                                            Responsabilité en cas de dommages, accident, vol ou infractions
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse6" class="accordion-collapse collapse"
                                        aria-labelledby="rentalheading6" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>Le Locataire est responsable jusqu'à hauteur de la franchise ou de la valeur du véhicule pour tous frais causés à JOD ainsi que des frais de gestion. Sont entre autres considérés comme frais: dommages au véhicule ou valeur actuelle en cas de vol, transport et expertise, traitement des dommages, pertes d'immobilisation, franchise de responsabilité civile et perte de bonus. Le Locataire est responsable indépendamment de la date ou du lieu de restitution.
                                                Le Locataire est entièrement responsable pour les dommages causés par une violation du contrat et pour les dommages au/dans le véhicule causés intentionnellement ou par faute grave tels que les dégâts causés par un tiers non identifié, pillage ou vol d'accessoires, dégâts causés aux parties hautes et en dessous du véhicule, jantes et pneumatiques, rayures sur la carrosserie ainsi qu'à l'intérieur (brûlures, salissures et autres...). Le Locataire est responsable de toutes les contraventions et infractions, aux lois, aux délibérations,
                                                arrêtés, règlements au Code de la Route. En tout état de cause, il doit lui-même s'acquitter de ces éventuelles sanctions.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="1.25s">
                                    <h2 class="accordion-header" id="rentalheading7">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#rentalcollapse7"
                                            aria-expanded="false" aria-controls="rentalcollapse7">
                                            Directives en cas d'accident
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse7" class="accordion-collapse collapse"
                                        aria-labelledby="rentalheading7" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>En cas d'accident, le Locataire doit protéger les intérêts de JOD et de la compagnie d'assurances en: (a) remplissant correctement le rapport
                                                d'accident remis par JOD, (b) notant les noms et adresses des personnes impliquées et des témoins, (c) ne reconnaissant aucun tort ou responsabilité,
                                                (d) prenant les mesures de sécurité nécessaires concernant le véhicule, (e) avisant JOD dans les 24 heures du sinistre et (f) prévenant immédiatement la police si cela s'impose pour l'établissement des torts d'un tiers ou s'il y a des blessés.
                                                Le Locataire répond de tout dommage causé à JOD par la violation de ces obligations.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="1.25s">
                                    <h2 class="accordion-header" id="rentalheading8">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#rentalcollapse8"
                                            aria-expanded="false" aria-controls="rentalcollapse8">
                                            Objets/animaux transportés
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse8" class="accordion-collapse collapse"
                                        aria-labelledby="rentalheading8" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>Le Locataire décharge JOD de toute responsabilité pour dommages et pertes touchant à des objets ou animaux transportés et indemnise JOD pour toute demande de tiers en découlant. Les animaux sont à transporter
                                                dans des cages convenables et ne doivent pas être laissés seuls dans le véhicule.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="1.25s">
                                    <h2 class="accordion-header" id="rentalheading9">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#rentalcollapse9"
                                            aria-expanded="false" aria-controls="rentalcollapse9">
                                            Mise en sécurité du véhicule
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse9" class="accordion-collapse collapse"
                                        aria-labelledby="rentalheading9" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>Lorsque le véhicule n'est pas utilisé, le verrou antivol du volant, les portes, fenêtres et toits ouvrants doivent être fermés,
                                                les clés retirées et le blocage électronique de conduite enclenché.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="1.25s">
                                    <h2 class="accordion-header" id="rentalheading0">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#rentalcollapse0"
                                            aria-expanded="false" aria-controls="rentalcollapse0">
                                            Pannes et défauts du véhicule
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse0" class="accordion-collapse collapse"
                                        aria-labelledby="rentalheading0" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>JOD n'est pas responsable pour les défauts et pannes du véhicule et pour les dommages en résultant. Les défauts et pannes sont à signaler à JOD.
                                                Le Locataire s'engage à entretenir le véhicule en parfait état de fonctionnement, et notamment la vérification du niveau d'huile, d'eau et autres fluides avec obligation de refaire les niveaux.
                                                Les réparations et travaux de service sont interdits sans l'accord exprès de JOD.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="1.25s">
                                    <h2 class="accordion-header" id="rentalheading01">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#rentalcollapse01"
                                            aria-expanded="false" aria-controls="rentalcollapse01">
                                            Immobilisation du véhicule
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse01" class="accordion-collapse collapse"
                                        aria-labelledby="rentalheading01" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>En cas de non-restitution du véhicule aux date et heure convenues dans les délais spécifiés, en cas de non-règlement de la prolongation
                                                de la location dans les délais spécifiés, en cas de dépassement de plus de 10 km des zones géographiques autorisées, sans accord préalable du Loueur,
                                                le système GPS intégré immobilisera le véhicule.
                                                Le déblocage du véhicule immobilisé engendre une pénalité de 10 000 F CFA.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="1.25s">
                                    <h2 class="accordion-header" id="rentalheading22">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#rentalcollapse22"
                                            aria-expanded="false" aria-controls="rentalcollapse22">
                                            Confidentialité
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse22" class="accordion-collapse collapse"
                                        aria-labelledby="rentalheading22" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>Sous réserve du respect de la règlementation comptable, les parties s'interdisent expressément de divulguer la présente convention à tous tiers, à la seule exception de leurs conseils,
                                                sauf en vue de contraindre l'autre partie à exécuter ses engagements.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->
                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="1.25s">
                                    <h2 class="accordion-header" id="rentalheading33">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#rentalcollapse33"
                                            aria-expanded="false" aria-controls="rentalcollapse33">
                                            Reserve de propriété
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse33" class="accordion-collapse collapse"
                                        aria-labelledby="rentalheading33" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>Le véhicule loué est et reste l'entière propriété du Loueur. Les plaques de propriétés apposées, ni les inscriptions ne doivent être enlevées ou
                                                modifiées par le Locataire. Le Locataire s'interdit de céder, donner en gage, en nantissement, ou sous-location ou de disposer de quelque manière que
                                                ce soit du véhicule loué. Si un tiers tentait de faire valoir des droits sur ledit véhicule, sous la forme de revendication d'une apposition ou d'une saisie
                                                , le Locataire est tenu d'en informer dans les plus brefs délais le Loueur.
                                                En cas d'inobservation de cette obligation, le Locataire serait responsable de tout dommage qui pourrait en résulter.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="1.25s">
                                    <h2 class="accordion-header" id="rentalheading16">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#rentalcollapse16"
                                            aria-expanded="false" aria-controls="rentalcollapse16">
                                            Election de Domicile
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse16" class="accordion-collapse collapse"
                                        aria-labelledby="rentalheading16" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>Pour l'exécution des présentes et de leurs suites, les parties font élection de domicile à leurs adresses respectives tel que précisé en tête des présentes.
                                                Toute modification du domicile de l'une des parties,
                                                devra être notifiée dans un bref délai par écrit à l'autre partie.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->

                                <!-- FAQ Item Start -->
                                <div class="accordion-item wow fadeInUp" data-wow-delay="1.25s">
                                    <h2 class="accordion-header" id="rentalheading26">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#rentalcollapse26"
                                            aria-expanded="false" aria-controls="rentalcollapse26">
                                            Dénonciation - Litiges - Modification
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse26" class="accordion-collapse collapse"
                                        aria-labelledby="rentalheading26" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>Tous les désaccords entre les signataires du présent accord concernant sa formation, son interprétation, son exécution, sa résiliation ou son expiration seront résolus par wvoie de négociation à l'amiable. Si une solution amiable n'est pas possible, les parties concernées acceptent de se conformer au droit gabonais en vigueur.
                                                Tout différend sera tranché définitivement par les Tribunaux de Libreville. Le Locataire est responsable de tous les frais occasionnés par le recouvrement éventuel du prix de la location, indemnités, frais, pénalités, ainsi que tous les frais de justice engagés par le Loueur résultant par lui de l'inexécution du présent bail.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item End -->
                            </div>
                            <!-- Rental Conditions FAQ Accordion End -->
                        </div>
                        <!-- Rental Conditions Faqs End -->
                    </div>
                    <!-- Feets Single Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Feets Single End -->
@endsection

@push('scripts')
@endpush
