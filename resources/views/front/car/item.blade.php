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
                        <h1 class="text-anime-style-3" data-cursor="-opaque">BMW M2 Car 2017</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">home</a></li>
                                <li class="breadcrumb-item"><a href="index-2.html">car</a></li>
                                <li class="breadcrumb-item active" aria-current="page">luxury car</li>
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
                                <h2>$280<span>/rent par day</span></h2>
                            </div>
                            <!-- Feets Single Sidebar Pricing End -->

                            <!-- Feets Single Sidebar List Start -->
                            <div class="fleets-single-sidebar-list">
                                <ul>
                                    <li><img src="images/icon-fleets-single-sidebar-list-1.svg" alt="">Passengers
                                        <span>4</span></li>
                                    <li><img src="images/icon-fleets-single-sidebar-list-2.svg" alt="">Luggage
                                        <span>5</span></li>
                                    <li><img src="images/icon-fleets-single-sidebar-list-3.svg" alt="">Doors
                                        <span>4</span></li>
                                    <li><img src="images/icon-fleets-single-sidebar-list-4.svg" alt="">Transmission
                                        <span>auto</span></li>
                                    <li><img src="images/icon-fleets-single-sidebar-list-5.svg" alt="">Air Condition
                                        <span>yes</span></li>
                                    <li><img src="images/icon-fleets-single-sidebar-list-6.svg" alt="">Age (years)
                                        <span>5</span></li>
                                </ul>
                            </div>
                            <!-- Feets Single Sidebar List End -->

                            <!-- Feets Single Sidebar Btn Start -->
                            <div class="fleets-single-sidebar-btn">
                                <a href="#bookingform" class="btn-default popup-with-form">book now</a>
                                <span>or</span>
                                <a href="#" class="wp-btn"><i class="fa-brands fa-whatsapp"></i></a>
                            </div>
                            <!-- Feets Single Sidebar Btn End -->
                        </div>

                        <!-- Booking Form Box Start -->
                        <div class="booking-form-box">
                            <!-- Booking PopUp Form Start -->
                            <form id="bookingform" class="white-popup-block mfp-hide booking-form">
                                <div class="section-title">
                                    <h2>Reserve your vehicle today!</h2>
                                    <p>Fill out the form below to reserve your vehicle. Complete the necessary details to
                                        ensure a smooth rental experience.</p>
                                </div>
                                <fieldset>
                                    <div class="row">
                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="text" name="name" class="booking-form-control" id="name"
                                                placeholder="Full Name" required>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="email" name ="email" class="booking-form-control" id="email"
                                                placeholder="Enter Your Email" required>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="text" name="phone" class="booking-form-control" id="phone"
                                                placeholder="Enter Your Number" required>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <select name="cartype" class="booking-form-control form-select" id="cartype"
                                                required>
                                                <option value="" disabled selected>Choose Car Type</option>
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
                                                <option value="" disabled selected>Pick Up Location</option>
                                                <option value="abu_dhabi">abu dhabi</option>
                                                <option value="alain">alain</option>
                                                <option value="dubai">dubai</option>
                                                <option value="sharjah">sharjah</option>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-6 mb-4">
                                            <input type="text" name="date" placeholder="PickUp Date"
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
                                                id="returndate" placeholder="Return Date" required>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="booking-form-group col-md-12 mb-4">
                                            <textarea name="msg" class="booking-form-control" id="msg" rows="3"
                                                placeholder="Write Your Message" required></textarea>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="col-md-12 booking-form-group">
                                            <button type="submit" class="btn-default">rent now</button>
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
                                    <!-- Fleets Image Slide Start -->
                                    <div class="swiper-slide">
                                        <div class="fleets-slider-image">
                                            <figure class="image-anime">
                                                <img src="images/fleets-slider-img-1.jpg" alt="">
                                            </figure>
                                        </div>
                                    </div>
                                    <!-- Fleets Image Slide End -->

                                    <!-- Fleets Image Slide Start -->
                                    <div class="swiper-slide">
                                        <div class="fleets-slider-image">
                                            <figure class="image-anime">
                                                <img src="images/fleets-slider-img-1.jpg" alt="">
                                            </figure>
                                        </div>
                                    </div>
                                    <!-- Fleets Image Slide End -->

                                    <!-- Fleets Image Slide Start -->
                                    <div class="swiper-slide">
                                        <div class="fleets-slider-image">
                                            <figure class="image-anime">
                                                <img src="images/fleets-slider-img-1.jpg" alt="">
                                            </figure>
                                        </div>
                                    </div>
                                    <!-- Fleets Image Slide End -->

                                    <!-- Fleets Image Slide Start -->
                                    <div class="swiper-slide">
                                        <div class="fleets-slider-image">
                                            <figure class="image-anime">
                                                <img src="images/fleets-slider-img-1.jpg" alt="">
                                            </figure>
                                        </div>
                                    </div>
                                    <!-- Fleets Image Slide End -->
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
                                    <img src="images/icon-fleets-benefits-1.svg" alt="">
                                </div>
                                <div class="fleets-benefits-content">
                                    <h3>Unlimi ted KMs</h3>
                                    <p>Endless Km with no extra charge </p>
                                </div>
                            </div>
                            <!-- Feets Benefits Item End -->

                            <!-- Feets Benefits Item Start -->
                            <div class="fleets-benefits-item">
                                <div class="icon-box">
                                    <img src="images/icon-fleets-benefits-2.svg" alt="">
                                </div>
                                <div class="fleets-benefits-content">
                                    <h3>Unlimi ted KMs</h3>
                                    <p>Endless Km with no extra charge </p>
                                </div>
                            </div>
                            <!-- Feets Benefits Item End -->
                        </div>
                        <!-- Feets Benefits End -->

                        <!-- Feets Information Start -->
                        <div class="fleets-information">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h3 class="wow fadeInUp">general information</h3>
                                <h2 class="text-anime-style-3" data-cursor="-opaque">Know about our car service</h2>
                                <p class="wow fadeInUp" data-wow-delay="0.25s">Lorem pretium fermentum quam, sit amet
                                    cursus ante sollicitudin velen morbi consesua the miss sustion consation porttitor orci
                                    sit amet iaculis nisan. Lorem pretium fermentum quam sit amet cursus ante sollicitudin
                                    velen fermen morbinetion consesua the risus consequation the porttiton.</p>
                            </div>
                            <!-- Section Title End -->

                            <!-- Feets Information List Start -->
                            <div class="fleets-information-list wow fadeInUp" data-wow-delay="0.5s">
                                <ul>
                                    <li>24/7 Roadside Assistance</li>
                                    <li>Free Cancellation & Return</li>
                                    <li>Rent Now Pay When You Arrive</li>
                                </ul>
                            </div>
                            <!-- Feets Information List End -->
                        </div>
                        <!-- Feets Information End -->

                        <!-- Feets Amenities Start -->
                        <div class="fleets-amenities">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h3 class="wow fadeInUp">amenities</h3>
                                <h2 class="text-anime-style-3" data-cursor="-opaque">Premium amenities and features</h2>
                            </div>
                            <!-- Section Title End -->

                            <!-- Feets Amenities List Start -->
                            <div class="fleets-amenities-list wow fadeInUp" data-wow-delay="0.25s">
                                <ul>
                                    <li>music system</li>
                                    <li>toolkit</li>
                                    <li>abs system</li>
                                    <li>bluetooth</li>
                                    <li>full boot space</li>
                                    <li>usb charger</li>
                                    <li>aux input</li>
                                    <li>spare tyre</li>
                                    <li>power steering</li>
                                    <li>power windows</li>
                                </ul>
                            </div>
                            <!-- Feets Amenities List End -->
                        </div>
                        <!-- Feets Amenities End -->

                        <!-- Rental Conditions Faqs Start -->
                        <div class="rental-conditions-faqs">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h3 class="wow fadeInUp">rental conditions</h3>
                                <h2 class="text-anime-style-3" data-cursor="-opaque">Policies and agreement</h2>
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
                                            Driver's License Requirements
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse1" class="accordion-collapse collapse show"
                                        aria-labelledby="rentalheading1" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>It is a long established fact that a reader will be distracted by the
                                                readable content of a page when looking at its layout. The point of using
                                                Lorem Ipsum is that it has a more-or-less normal</p>
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
                                            Insurance and Coverage policy
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse2" class="accordion-collapse collapse"
                                        aria-labelledby="rentalheading2" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>It is a long established fact that a reader will be distracted by the
                                                readable content of a page when looking at its layout. The point of using
                                                Lorem Ipsum is that it has a more-or-less normal</p>
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
                                            Available payment Methods
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse3" class="accordion-collapse collapse"
                                        aria-labelledby="rentalheading3" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>It is a long established fact that a reader will be distracted by the
                                                readable content of a page when looking at its layout. The point of using
                                                Lorem Ipsum is that it has a more-or-less normal</p>
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
                                            Cancellation and Modification policy
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse4" class="accordion-collapse collapse"
                                        aria-labelledby="rentalheading4" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>It is a long established fact that a reader will be distracted by the
                                                readable content of a page when looking at its layout. The point of using
                                                Lorem Ipsum is that it has a more-or-less normal</p>
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
                                            Smoking and Pet Policies
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse5" class="accordion-collapse collapse"
                                        aria-labelledby="rentalheading5" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>It is a long established fact that a reader will be distracted by the
                                                readable content of a page when looking at its layout. The point of using
                                                Lorem Ipsum is that it has a more-or-less normal</p>
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
                                            The minimum age Requirements
                                        </button>
                                    </h2>
                                    <div id="rentalcollapse6" class="accordion-collapse collapse"
                                        aria-labelledby="rentalheading6" data-bs-parent="#rentalaccordion">
                                        <div class="accordion-body">
                                            <p>It is a long established fact that a reader will be distracted by the
                                                readable content of a page when looking at its layout. The point of using
                                                Lorem Ipsum is that it has a more-or-less normal</p>
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
