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
                        <h1 class="text-anime-style-3" data-cursor="-opaque">Prime Clet</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">home</a></li>
                                <li class="breadcrumb-item"><a href="index-2.html">drivers</a></li>
                                <li class="breadcrumb-item active" aria-current="page">John Smith</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Page Team Single Start -->
    <div class="page-team-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <!-- Team member Details Start -->
                    <div class="team-member-details">
                        <!-- Team member Image Start -->
                        <div class="team-member-image">
                            <figure class="image-anime">
                                <img src="images/team-1.jpg" alt="">
                            </figure>
                        </div>
                        <!-- Team member Image End -->

                        <!-- Team member Content Start -->
                        <div class="team-member-content">
                            <!-- Team member Title Start -->
                            <div class="team-member-title">
                                <h2 class="wow fadeInUp">john smith</h2>
                                <p class="wow fadeInUp" data-wow-delay="0.25s">senior chauffeur</p>
                            </div>
                            <!-- Team member Title End -->

                            <!-- Team member Body Start -->
                            <div class="team-member-body wow fadeInUp" data-wow-delay="0.5s">
                                <ul>
                                    <li><span>Phone: </span>(+01) 789 456 789</li>
                                    <li><span>Email: </span>domain@gmail.com</li>
                                    <li><span>Position: </span>Senior Chauffeur</li>
                                </ul>
                            </div>
                            <!-- Team member Body End -->

                            <!-- member Social List Start -->
                            <div class="member-social-list">
                                <ul class="wow fadeInUp" data-wow-delay="0.75s">
                                    <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                </ul>
                            </div>
                            <!-- member Social List End -->
                        </div>
                        <!-- Team member Content End -->
                    </div>
                    <!-- Team member Details End -->
                </div>

                <div class="col-lg-7">
                    <!-- Team member Intero Start -->
                    <div class="team-member-intro">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Introduction</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">John biography</h2>
                        </div>
                        <!-- Section Title End -->

                        <!-- Team Intero Content Start -->
                        <div class="team-intro-content">
                            <p class="wow fadeInUp">We pride ourselves on having a team of highly skilled and professional
                                drivers dedicated to providing you with the best possible service. Here are some of the top
                                drivers who make your journeys safe, comfortable, and enjoyable:</p>
                            <p class="wow fadeInUp" data-wow-delay="0.25s">John brings over 15 years of professional driving
                                experience to our team. His extensive knowledge of the city, coupled with his impeccable
                                driving skills, ensures that you reach your destination safely and on time. John is known
                                for his punctuality and professionalism, making him a favorite among our corporate clients.
                            </p>
                        </div>
                        <!-- Team Intero Content End -->

                        <!-- Team Member Specialty Start -->
                        <div class="team-member-specialty wow fadeInUp" data-wow-delay="0.5s">
                            <ul>
                                <li><span>Experience :</span> 15 years</li>
                                <li><span>Specialty :</span> Senior Chauffeur, Airport Transfer</li>
                                <li><span>Specialty :</span> English, spanish</li>
                            </ul>
                        </div>
                        <!-- Team Member Specialty End -->
                    </div>
                    <!-- Team member Intero End -->

                    <!-- Team Member Features Start -->
                    <div class="team-member-features">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">features</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">Know about john</h2>
                        </div>
                        <!-- Section Title End -->

                        <!-- Team Intero Content Start -->
                        <div class="team-features-content wow fadeInUp" data-wow-delay="0.25s">
                            <p>We pride ourselves on having a team of highly skilled and professional drivers dedicated to
                                providing you with the best possible service.</p>
                        </div>
                        <!-- Team Intero Content End -->

                        <!-- Team Member Features List Start -->
                        <div class="team-features-list wow fadeInUp" data-wow-delay="0.5s">
                            <ul>
                                <li>Qualified and Experienced</li>
                                <li>Safety First</li>
                                <li>Highly Trained</li>
                                <li>Personalized Experience</li>
                                <li>Years of Experience</li>
                                <li>Local Knowledge</li>
                            </ul>
                        </div>
                        <!-- Team Member Features List End -->
                    </div>
                    <!-- Team Member Features End -->

                    <!-- Team Member Testimonials Start -->
                    <div class="team-member-testimonials">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">testimonials</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">Customers feedback</h2>
                        </div>
                        <!-- Section Title End -->

                        <!-- Team Member Slider Start -->
                        <div class="team-member-slider">
                            <div class="swiper">
                                <div class="swiper-wrapper" data-cursor-text="Drag">
                                    <!-- Member Testimonial Slide Start -->
                                    <div class="swiper-slide">
                                        <!-- Team Feedback Item Start -->
                                        <div class="team-feedback-item">
                                            <!-- Quote Icon Box Start -->
                                            <div class="quote-icon-box">
                                                <img src="images/icon-quote-img-1.svg" alt="">
                                            </div>
                                            <!-- Quote Icon Box End -->

                                            <!-- Team Feedback Content Start -->
                                            <div class="team-feedback-content">
                                                <p>John is professionalism and attention to detail are outstanding. We felt
                                                    safe and well-cared-for throughout our journey.</p>
                                            </div>
                                            <!-- Team Feedback Content End -->

                                            <!-- Team Feedback Body Start -->
                                            <div class="team-feedback-body">
                                                <h3>dakota young</h3>
                                                <p>customers</p>
                                            </div>
                                            <!-- Team Feedback Body End -->
                                        </div>
                                        <!-- Team Feedback Item End -->
                                    </div>
                                    <!-- Member Testimonial Slide End -->

                                    <!-- Member Testimonial Slide Start -->
                                    <div class="swiper-slide">
                                        <!-- Team Feedback Item Start -->
                                        <div class="team-feedback-item">
                                            <!-- Quote Icon Box Start -->
                                            <div class="quote-icon-box">
                                                <img src="images/icon-quote-img-1.svg" alt="">
                                            </div>
                                            <!-- Quote Icon Box End -->

                                            <!-- Team Feedback Content Start -->
                                            <div class="team-feedback-content">
                                                <p>John is professionalism and attention to detail are outstanding. We felt
                                                    safe and well-cared-for throughout our journey.</p>
                                            </div>
                                            <!-- Team Feedback Content End -->

                                            <!-- Team Feedback Body Start -->
                                            <div class="team-feedback-body">
                                                <h3>casey davis</h3>
                                                <p>customers</p>
                                            </div>
                                            <!-- Team Feedback Body End -->
                                        </div>
                                        <!-- Team Feedback Item End -->
                                    </div>
                                    <!-- Member Testimonial Slide End -->

                                    <!-- Member Testimonial Slide Start -->
                                    <div class="swiper-slide">
                                        <!-- Team Feedback Item Start -->
                                        <div class="team-feedback-item">
                                            <!-- Quote Icon Box Start -->
                                            <div class="quote-icon-box">
                                                <img src="images/icon-quote-img-1.svg" alt="">
                                            </div>
                                            <!-- Quote Icon Box End -->

                                            <!-- Team Feedback Content Start -->
                                            <div class="team-feedback-content">
                                                <p>John is professionalism and attention to detail are outstanding. We felt
                                                    safe and well-cared-for throughout our journey.</p>
                                            </div>
                                            <!-- Team Feedback Content End -->

                                            <!-- Team Feedback Body Start -->
                                            <div class="team-feedback-body">
                                                <h3>jamie clark</h3>
                                                <p>customers</p>
                                            </div>
                                            <!-- Team Feedback Body End -->
                                        </div>
                                        <!-- Team Feedback Item End -->
                                    </div>
                                    <!-- Member Testimonial Slide End -->
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                        <!-- Team Member Slider End -->
                    </div>
                    <!-- Team Member Testimonials End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Team Single End -->
@endsection

@push('scripts')
@endpush
