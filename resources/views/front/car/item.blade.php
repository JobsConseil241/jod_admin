@extends('layouts.front')

@push('styles')
    <style>
        /* Styles pour le stepper */
        .reservation-stepper-wrapper {
            margin-bottom: 40px;
        }

        .stepper-items {
            position: relative;
            z-index: 1;
        }

        .stepper-item {
            text-align: center;
            flex: 1;
            position: relative;
        }

        .step-counter {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: #ECECEC;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 10px;
            font-weight: bold;
            transition: all 0.3s ease;
            color: #040401;
        }

        .stepper-item.active .step-counter {
            background-color: #02172C;
            color: #FFFFFF;
        }

        .stepper-item.completed .step-counter {
            background-color: #02172C;
            color: #FFFFFF;
        }

        .stepper-item.completed .step-counter {
            background-color: #4caf50; /* Couleur verte */
            color: #FFFFFF;
        }

        .step-name {
            font-size: 14px;
            font-weight: 500;
            color: #040401;
            margin-bottom: 15px; /* Ajoute de l'espace entre le nom et la barre de progression */
        }

        .stepper-progress {
            height: 4px;
            background-color: #ECECEC;
            margin-top: 0; /* Ajusté pour respecter l'espace ajouté au step-name */
            position: relative;
            z-index: 0;
        }

        .stepper-progress-bar {
            height: 100%;
            background-color: #02172C;
            transition: width 0.3s ease;
        }

        /* Styles pour les étapes du contenu */
        .step-content {
            display: none;
        }

        .step-content.active {
            display: block;
        }

        .step-title {
            color: #040401;
            font-weight: 600;
            font-size: 20px;
            margin-bottom: 20px;
        }

        /* Styles pour les champs du formulaire */
        .booking-form-control {
            width: 100%;
            padding: 12px 20px;
            background-color: transparent;
            border: 1px solid #ECECEC;
            border-radius: 10px;
            color: #040401;
            box-shadow: none;
            font-size: 16px;
            font-weight: 400;
            line-height: 1.7em;
        }

        .booking-form-control:focus {
            border-color: #02172C;
            outline: none;
            box-shadow: none;
        }

        .booking-form-control::placeholder {
            color: #616161;
        }

        /* Styles pour les boutons */
        .btn-default {
            display: inline-block;
            font-size: 16px;
            font-weight: 700;
            line-height: 1em;
            text-transform: capitalize;
            background: #02172C;
            color: #FFFFFF;
            border-radius: 100px;
            padding: 16px 25px;
            margin-right: 48px;
            border: none;
            transition: all 0.5s ease-in-out;
            position: relative;
            z-index: 1;
        }

        .btn-default::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: #02172C;
            background-image: url('../images/arrow-white.svg');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: 14px auto;
            transform: translate(48px, 0px);
            transition: all 0.4s ease-in-out;
        }

        .btn-default:hover::before {
            background-color: #040401;
            background-size: 14px auto;
            transform: translate(48px, 0px) rotate(45deg);
        }

        .btn-outline {
            display: inline-block;
            font-size: 16px;
            font-weight: 700;
            line-height: 1em;
            text-transform: capitalize;
            background: transparent;
            color: #040401;
            border: 1px solid #ECECEC;
            border-radius: 100px;
            padding: 16px 25px;
            margin-right: 48px;
            transition: all 0.5s ease-in-out;
            position: relative;
            z-index: 1;
        }

        .btn-outline::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: transparent;
            background-image: url('../images/arrow-black.svg');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: 14px auto;
            transform: translate(48px, 0px) rotate(180deg);
            transition: all 0.4s ease-in-out;
        }

        .btn-outline:hover {
            background-color: #f8f9fa;
            color: #040401;
        }

        .btn-outline:hover::before {
            transform: translate(48px, 0px) rotate(225deg);
        }

        /* Styles pour le résumé de réservation */
        .reservation-summary {
            background-color: #FFF8F6;
            border-radius: 16px;
            border: 1px solid #ECECEC;
        }

        .text-accent {
            color: #02172C;
        }

        /* Styles pour les champs de paiement */
        .payment-fields {
            background-color: #FFF8F6;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        /* Styles pour l'alerte d'info */
        .alert-info {
            background-color: #FFF8F6;
            border-color: #02172C;
            color: #040401;
            border-radius: 10px;
            padding: 16px;
        }

        .form-check-input:checked {
            background-color: #02172C;
            border-color: #02172C;
        }

        /* Styles responsive */
        @media only screen and (max-width: 767px) {
            .btn-default, .btn-outline {
                font-size: 14px;
                padding: 12px 20px;
                margin-right: 30px;
            }

            .btn-default::before, .btn-outline::before {
                width: 36px;
                height: 36px;
                transform: translate(30px, 0px);
            }

            .step-counter {
                width: 36px;
                height: 36px;
            }

            .step-name {
                font-size: 12px;
            }

            .step-title {
                font-size: 18px;
            }
        }
    </style>
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

                                        <form id="reservationForm" action="" method="post">
                                            <!-- Indicateur de progression du stepper -->
                                            <div class="reservation-stepper-wrapper mb-5">
                                                <div class="stepper-items d-flex justify-content-between">
                                                    <div class="stepper-item active" data-step="1">
                                                        <div class="step-counter">1</div>
                                                        <div class="step-name">Véhicule</div>
                                                    </div>
                                                    <div class="stepper-item" data-step="2">
                                                        <div class="step-counter">2</div>
                                                        <div class="step-name">Dates</div>
                                                    </div>
                                                    <div class="stepper-item" data-step="3">
                                                        <div class="step-counter">3</div>
                                                        <div class="step-name">Informations</div>
                                                    </div>
                                                    <div class="stepper-item" data-step="4">
                                                        <div class="step-counter">4</div>
                                                        <div class="step-name">Paiement</div>
                                                    </div>
                                                    <div class="stepper-item" data-step="5">
                                                        <div class="step-counter">5</div>
                                                        <div class="step-name">Confirmation</div>
                                                    </div>
                                                </div>
                                                <div class="stepper-progress">
                                                    <div class="stepper-progress-bar" style="width: 20%"></div>
                                                </div>
                                            </div>

                                            <!-- Étape 1: Choix du véhicule -->
                                            <div class="step-content active" data-step="1">
                                                <h3 class="step-title mb-4">Choisissez votre véhicule</h3>

                                                <div class="booking-form-group col-md-12 mb-4">
                                                    <select name="cartype" class="booking-form-control form-select" id="cartype" required>
                                                        <option value="" disabled selected>Choisissez votre vehicule</option>
                                                        <option value="sport_car">Sport car</option>
                                                        <option value="convertible_car">Convertible car</option>
                                                        <option value="sedan_car">Sedan car</option>
                                                        <option value="luxury_car">Luxury car</option>
                                                        <option value="electric_car">Electric car</option>
                                                        <option value="coupe_car">Coupe car</option>
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                </div>

                                                <div class="mt-4 d-flex justify-content-end">
                                                    <button type="button" class="btn-default next-step">
                                                        Suivant
                                                        <span class="btn-icon"></span>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Étape 2: Dates et lieux -->
                                            <div class="step-content" data-step="2">
                                                <h3 class="step-title mb-4">Dates et lieux</h3>

                                                <div class="row">
                                                    <div class="booking-form-group col-md-6 mb-4">
                                                        <select name="location" class="booking-form-control form-select" id="pickuplocation" required>
                                                            <option value="" disabled selected>Zone de Récupération du Véhicule</option>
                                                            <option value="livraison">Livraison</option>
                                                            <option value="Agence">À L'agence</option>
                                                        </select>
                                                        <div class="help-block with-errors"></div>
                                                    </div>

                                                    <div class="booking-form-group col-md-6 mb-4">
                                                        <input type="text" name="pickupdate" placeholder="Date de Récupération" class="booking-form-control datepicker" id="pickupdate" required>
                                                        <div class="help-block with-errors"></div>
                                                    </div>

                                                    <div class="booking-form-group col-md-6 mb-4">
                                                        <select name="droplocation" class="booking-form-control form-select" id="droplocation" required>
                                                            <option value="" disabled selected>Lieu de Retour</option>
                                                            <option value="livraison">Livraison</option>
                                                            <option value="Agence">À L'agence</option>
                                                        </select>
                                                        <div class="help-block with-errors"></div>
                                                    </div>

                                                    <div class="booking-form-group col-md-6 mb-4">
                                                        <input type="text" name="returndate" class="booking-form-control datepicker" id="returndate" placeholder="Date de retour" required>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>

                                                <div class="mt-4 d-flex justify-content-between">
                                                    <button type="button" class="btn-outline prev-step">
                                                        Précédent
                                                        <span class="btn-icon prev-icon"></span>
                                                    </button>
                                                    <button type="button" class="btn-default next-step">
                                                        Suivant
                                                        <span class="btn-icon"></span>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Étape 3: Informations utilisateur -->
                                            <div class="step-content" data-step="3">
                                                <h3 class="step-title mb-4">Vos informations</h3>

                                                <div class="row">
                                                    <div class="booking-form-group col-md-6 mb-4">
                                                        <input type="text" name="firstname" class="booking-form-control" placeholder="Prénom" required>
                                                        <div class="help-block with-errors"></div>
                                                    </div>

                                                    <div class="booking-form-group col-md-6 mb-4">
                                                        <input type="text" name="lastname" class="booking-form-control" placeholder="Nom" required>
                                                        <div class="help-block with-errors"></div>
                                                    </div>

                                                    <div class="booking-form-group col-md-6 mb-4">
                                                        <input type="email" name="email" class="booking-form-control" placeholder="Email" required>
                                                        <div class="help-block with-errors"></div>
                                                    </div>

                                                    <div class="booking-form-group col-md-6 mb-4">
                                                        <input type="tel" name="phone" class="booking-form-control" placeholder="Téléphone" required>
                                                        <div class="help-block with-errors"></div>
                                                    </div>

                                                    <div class="booking-form-group col-md-12 mb-4">
                                                        <input type="text" name="address" class="booking-form-control" placeholder="Adresse" required>
                                                        <div class="help-block with-errors"></div>
                                                    </div>

                                                    <div class="booking-form-group col-md-6 mb-4">
                                                        <select name="piece" class="booking-form-control form-select" required>
                                                            <option value="" disabled selected>Type de pièce d'identité</option>
                                                            <option value="permis">Permis de conduire</option>
                                                            <option value="cni">Carte Nationale d'Identité</option>
                                                            <option value="passeport">Passeport</option>
                                                        </select>
                                                        <div class="help-block with-errors"></div>
                                                    </div>

                                                    <div class="booking-form-group col-md-6 mb-4">
                                                        <input type="text" name="pieceNumber" class="booking-form-control" placeholder="Numéro de pièce d'identité" required>
                                                        <div class="help-block with-errors"></div>
                                                    </div>

                                                    <div class="booking-form-group col-md-12 mb-4">
                                                        <textarea name="msg" class="booking-form-control" id="msg" rows="3" placeholder="Informations complémentaires"></textarea>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>

                                                <div class="mt-4 d-flex justify-content-between">
                                                    <button type="button" class="btn-outline prev-step">
                                                        Précédent
                                                        <span class="btn-icon prev-icon"></span>
                                                    </button>
                                                    <button type="button" class="btn-default next-step">
                                                        Suivant
                                                        <span class="btn-icon"></span>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Étape 4: Paiement -->
                                            <div class="step-content" data-step="4">
                                                <h3 class="step-title mb-4">Paiement</h3>

                                                <div class="row">
                                                    <div class="booking-form-group col-md-12 mb-4">
                                                        <select name="paymentMethod" class="booking-form-control form-select" id="paymentMethod" required>
                                                            <option value="" disabled selected>Méthode de paiement</option>
                                                            <option value="card">Carte bancaire</option>
                                                            <option value="cash">Espèces à la récupération</option>
                                                            <option value="transfer">Virement bancaire</option>
                                                            <option value="momo">Mobile Money (MTN, Orange, etc.)</option>
                                                            <option value="wave">Wave</option>
                                                        </select>
                                                        <div class="help-block with-errors"></div>
                                                    </div>

                                                    <!-- Champs conditionnels pour paiement par carte -->
                                                    <div class="payment-fields card-payment-fields" style="display: none;">
                                                        <div class="booking-form-group col-md-12 mb-4">
                                                            <input type="text" name="cardHolder" class="booking-form-control" placeholder="Nom du titulaire">
                                                            <div class="help-block with-errors"></div>
                                                        </div>

                                                        <div class="booking-form-group col-md-12 mb-4">
                                                            <input type="text" name="cardNumber" class="booking-form-control" placeholder="Numéro de carte">
                                                            <div class="help-block with-errors"></div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="booking-form-group col-md-6 mb-4">
                                                                <input type="text" name="expiryDate" class="booking-form-control" placeholder="Date d'expiration (MM/AA)">
                                                                <div class="help-block with-errors"></div>
                                                            </div>

                                                            <div class="booking-form-group col-md-6 mb-4">
                                                                <input type="text" name="cvv" class="booking-form-control" placeholder="CVV">
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Champs conditionnels pour paiement Mobile Money -->
                                                    <div class="payment-fields momo-payment-fields" style="display: none;">
                                                        <div class="booking-form-group col-md-12 mb-4">
                                                            <select name="momoProvider" class="booking-form-control form-select">
                                                                <option value="" disabled selected>Choisissez votre opérateur</option>
                                                                <option value="mtn">MTN Mobile Money</option>
                                                                <option value="orange">Orange Money</option>
                                                                <option value="moov">Moov Money</option>
                                                            </select>
                                                            <div class="help-block with-errors"></div>
                                                        </div>

                                                        <div class="booking-form-group col-md-12 mb-4">
                                                            <input type="tel" name="momoNumber" class="booking-form-control" placeholder="Numéro de téléphone Mobile Money">
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>

                                                    <!-- Champs conditionnels pour paiement Wave -->
                                                    <div class="payment-fields wave-payment-fields" style="display: none;">
                                                        <div class="booking-form-group col-md-12 mb-4">
                                                            <input type="tel" name="waveNumber" class="booking-form-control" placeholder="Numéro de téléphone Wave">
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>

                                                    <div class="booking-form-group col-md-12 mb-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="termsCheck" required>
                                                            <label class="form-check-label" for="termsCheck">
                                                                J'accepte les <a href="#" class="text-accent">conditions générales de location</a>
                                                            </label>
                                                        </div>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>

                                                <div class="mt-4 d-flex justify-content-between">
                                                    <button type="button" class="btn-outline prev-step">
                                                        Précédent
                                                        <span class="btn-icon prev-icon"></span>
                                                    </button>
                                                    <button type="button" class="btn-default next-step">
                                                        Suivant
                                                        <span class="btn-icon"></span>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Étape 5: Confirmation -->
                                            <div class="step-content" data-step="5">
                                                <h3 class="step-title mb-4">Confirmation de votre réservation</h3>

                                                <div class="reservation-summary card p-4 mb-4">
                                                    <h4 class="mb-3">Récapitulatif de votre réservation</h4>
                                                    <div id="reservationSummary">
                                                        <!-- Le contenu sera rempli dynamiquement par JavaScript -->
                                                    </div>
                                                </div>

                                                <div class="booking-form-group col-md-12 mb-4">
                                                    <div class="alert alert-info" role="alert">
                                                        Veuillez vérifier les informations ci-dessus. Une fois la réservation confirmée, vous recevrez un email avec les détails de votre réservation.
                                                    </div>
                                                </div>

                                                <div class="mt-4 d-flex justify-content-between">
                                                    <button type="button" class="btn-outline prev-step">
                                                        Précédent
                                                        <span class="btn-icon prev-icon"></span>
                                                    </button>
                                                    <button type="submit" class="btn-default">
                                                        Confirmer la réservation
                                                        <span class="btn-icon"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialisation des éléments
            const form = document.getElementById('reservationForm');
            const stepItems = document.querySelectorAll('.stepper-item');
            const stepContents = document.querySelectorAll('.step-content');
            const progressBar = document.querySelector('.stepper-progress-bar');
            const nextButtons = document.querySelectorAll('.next-step');
            const prevButtons = document.querySelectorAll('.prev-step');
            const paymentMethodSelect = document.getElementById('paymentMethod');
            const paymentFields = document.querySelectorAll('.payment-fields');

            // Configuration des datepickers (si vous utilisez un plugin comme bootstrap-datepicker)
            if (typeof $.fn.datepicker !== 'undefined') {
                $('.datepicker').datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    language: 'fr',
                    startDate: 'today'
                });
            }

            // Gestion des étapes
            function goToStep(stepNumber) {
                // Mise à jour des classes des étapes
                stepItems.forEach(item => {
                    const itemStep = parseInt(item.dataset.step);
                    item.classList.remove('active', 'completed');

                    if (itemStep === stepNumber) {
                        item.classList.add('active');
                    } else if (itemStep < stepNumber) {
                        item.classList.add('completed');
                    }
                });

                // Afficher la bonne étape de contenu
                stepContents.forEach(content => {
                    content.classList.remove('active');
                    if (parseInt(content.dataset.step) === stepNumber) {
                        content.classList.add('active');
                    }
                });

                // Mettre à jour la barre de progression
                const progressPercentage = ((stepNumber - 1) / (stepItems.length - 1)) * 100;
                progressBar.style.width = progressPercentage + '%';
            }

            // Événements pour les boutons suivant
            nextButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const currentStep = parseInt(this.closest('.step-content').dataset.step);

                    // Valider les champs avant de passer à l'étape suivante
                    if (validateStep(currentStep)) {
                        // Si c'est la dernière étape avant la confirmation, générer le résumé
                        if (currentStep === 4) {
                            generateSummary();
                        }

                        goToStep(currentStep + 1);
                    }
                });
            });

            // Événements pour les boutons précédent
            prevButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const currentStep = parseInt(this.closest('.step-content').dataset.step);
                    goToStep(currentStep - 1);
                });
            });

            // Gestion des champs de paiement conditionnels
            if (paymentMethodSelect) {
                paymentMethodSelect.addEventListener('change', function() {
                    // Cacher tous les champs de paiement
                    paymentFields.forEach(field => {
                        field.style.display = 'none';
                    });

                    // Afficher les champs correspondant à la méthode de paiement sélectionnée
                    switch(this.value) {
                        case 'card':
                            document.querySelector('.card-payment-fields').style.display = 'block';
                            break;
                        case 'momo':
                            document.querySelector('.momo-payment-fields').style.display = 'block';
                            break;
                        case 'wave':
                            document.querySelector('.wave-payment-fields').style.display = 'block';
                            break;
                    }
                });
            }

            // Fonction pour valider les champs d'une étape
            function validateStep(stepNumber) {
                const currentStepContent = document.querySelector(`.step-content[data-step="${stepNumber}"]`);
                const requiredFields = currentStepContent.querySelectorAll('[required]');

                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value) {
                        isValid = false;
                        field.classList.add('is-invalid');

                        // Ajouter un message d'erreur
                        const errorContainer = field.nextElementSibling;
                        if (errorContainer && errorContainer.classList.contains('with-errors')) {
                            errorContainer.textContent = 'Ce champ est requis';
                        }
                    } else {
                        field.classList.remove('is-invalid');

                        // Supprimer le message d'erreur
                        const errorContainer = field.nextElementSibling;
                        if (errorContainer && errorContainer.classList.contains('with-errors')) {
                            errorContainer.textContent = '';
                        }
                    }
                });

                return isValid;
            }

            // Fonction pour générer le résumé de la réservation
            function generateSummary() {
                const summaryContainer = document.getElementById('reservationSummary');
                const carType = document.getElementById('cartype').options[document.getElementById('cartype').selectedIndex].text;
                const pickupLocation = document.getElementById('pickuplocation').options[document.getElementById('pickuplocation').selectedIndex].text;
                const pickupDate = document.getElementById('pickupdate').value;
                const dropLocation = document.getElementById('droplocation').options[document.getElementById('droplocation').selectedIndex].text;
                const returnDate = document.getElementById('returndate').value;
                const firstName = document.querySelector('input[name="firstname"]').value;
                const lastName = document.querySelector('input[name="lastname"]').value;
                const email = document.querySelector('input[name="email"]').value;
                const phone = document.querySelector('input[name="phone"]').value;

                // Récupérer la méthode de paiement
                let paymentMethod = '';
                if (document.querySelector('select[name="paymentMethod"]').selectedIndex > 0) {
                    paymentMethod = document.querySelector('select[name="paymentMethod"]').options[document.querySelector('select[name="paymentMethod"]').selectedIndex].text;
                }

                let summaryHTML = `
            <div class="row mb-2">
                <div class="col-md-4 fw-bold">Véhicule:</div>
                <div class="col-md-8">${carType}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 fw-bold">Client:</div>
                <div class="col-md-8">${firstName} ${lastName}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 fw-bold">Contact:</div>
                <div class="col-md-8">${email} | ${phone}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 fw-bold">Prise en charge:</div>
                <div class="col-md-8">${pickupLocation} - ${pickupDate}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 fw-bold">Retour:</div>
                <div class="col-md-8">${dropLocation} - ${returnDate}</div>
            </div>
        `;

                if (paymentMethod) {
                    summaryHTML += `
                <div class="row mb-2">
                    <div class="col-md-4 fw-bold">Méthode de paiement:</div>
                    <div class="col-md-8">${paymentMethod}</div>
                </div>
            `;
                }

                summaryContainer.innerHTML = summaryHTML;
            }

            // Soumission du formulaire
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Validation finale
                if (validateStep(5)) {
                    // Ici, vous pourriez envoyer les données via AJAX ou laisser le formulaire se soumettre normalement
                    alert('Votre réservation a été confirmée! Vous recevrez un email de confirmation.');
                    // form.submit(); // Décommentez pour soumettre le formulaire
                }
            });
        });
    </script>
@endpush
