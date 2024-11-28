<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="codeur X">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Page Title -->
    <title>JOD Trade & Co</title>
    <!-- Favicon Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
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

    <!-- custom CSS -->
    @stack('styles')

    @inject('Lang', 'App\Services\LanguageService')
</head>

<body>

    <!-- Preloader Start -->
    <div class="preloader">
        <div class="loading-container">
            <div class="loading"></div>
            <div id="loading-icon"><img src="images/loader.svg" alt=""></div>
        </div>
    </div>
    <!-- Preloader End -->

    <!-- Header Start -->
    <header class="main-header">
        <div class="header-sticky">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <!-- Logo Start -->
                    <a class="navbar-brand" href="index-2.html">
                        <img src="images/logo.svg" alt="Logo">
                    </a>
                    <!-- Logo End -->

                    <!-- Main Menu Start -->
                    <div class="collapse navbar-collapse main-menu">
                        <div class="nav-menu-wrapper">
                            <ul class="navbar-nav mr-auto" id="menu">
                                <li class="nav-item submenu"><a class="nav-link" href="index-2.html">Home</a>
                                    <ul>
                                        <li class="nav-item submenu"><a class="nav-link" href="index.html">Home -
                                                Light</a>
                                            <ul>
                                                <li class="nav-item"><a class="nav-link" href="index.html">Home -
                                                        Background Image</a></li>
                                                <li class="nav-item"><a class="nav-link" href="index-3.html">Home -
                                                        Background Video</a></li>
                                                <li class="nav-item"><a class="nav-link" href="index-4.html">Home -
                                                        Background Slider</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item submenu"><a class="nav-link"
                                                href="https://demo.awaikenthemes.com/html-preview/novaride/dark/index.html">Home
                                                - Dark</a>
                                            <ul>
                                                <li class="nav-item"><a class="nav-link"
                                                        href="https://demo.awaikenthemes.com/html-preview/novaride/dark/index.html">Home
                                                        - Background Image</a></li>
                                                <li class="nav-item"><a class="nav-link"
                                                        href="https://demo.awaikenthemes.com/html-preview/novaride/dark/index-2.html">Home
                                                        - Background Video</a></li>
                                                <li class="nav-item"><a class="nav-link"
                                                        href="https://demo.awaikenthemes.com/html-preview/novaride/dark/index-3.html">Home
                                                        - Background Slider</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="about.html">About Us</a></li>
                                <li class="nav-item"><a class="nav-link" href="service.html">Services</a></li>
                                <li class="nav-item submenu"><a class="nav-link" href="#">Cars</a>
                                    <ul>
                                        <li class="nav-item"><a class="nav-link" href="cars.html">Car Lists</a></li>
                                        <li class="nav-item"><a class="nav-link" href="car-single.html">Car
                                                Details</a></li>
                                        <li class="nav-item"><a class="nav-link" href="car-type.html">Cars Type</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item submenu"><a class="nav-link" href="#">Pages</a>
                                    <ul>
                                        <li class="nav-item"><a class="nav-link" href="service-single.html">Service
                                                Details</a></li>
                                        <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
                                        <li class="nav-item"><a class="nav-link" href="blog-single.html">Blog
                                                Details</a></li>
                                        <li class="nav-item"><a class="nav-link" href="drivers.html">Drivers</a></li>
                                        <li class="nav-item"><a class="nav-link" href="driver-single.html">Driver
                                                Details</a></li>
                                        <li class="nav-item"><a class="nav-link" href="pricing.html">Pricing</a></li>
                                        <li class="nav-item"><a class="nav-link" href="image-gallery.html">Image
                                                Gallery</a></li>
                                        <li class="nav-item"><a class="nav-link" href="video-gallery.html">Video
                                                Gallery</a></li>
                                        <li class="nav-item"><a class="nav-link"
                                                href="testimonials.html">Testimonials</a></li>
                                        <li class="nav-item"><a class="nav-link" href="faqs.html">FAQ's</a></li>
                                        <li class="nav-item"><a class="nav-link" href="404.html">404</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="contact.html">Contact Us</a></li>
                            </ul>
                        </div>
                        <!-- Let’s Start Button Start -->
                        <div class="header-btn d-inline-flex">
                            <a href="#" class="btn-default">book a rental</a>
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

    @yield('content')

    <!-- Footer Start -->
    <footer class="main-footer bg-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <!-- About Footer Start -->
                    <div class="about-footer">
                        <!-- Footer Logo Start -->
                        <div class="footer-logo">
                            <img src="images/footer-logo.svg" alt="">
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
                        <h3>legal policy</h3>
                        <ul>
                            <li><a href="#">term & condition</a></li>
                            <li><a href="#">privacy policy</a></li>
                            <li><a href="#">legal notice</a></li>
                            <li><a href="#">accessibility</a></li>
                        </ul>
                    </div>
                    <!-- Footer Quick Links End -->
                </div>

                <div class="col-lg-3 col-md-4">
                    <!-- Footer Menu Start -->
                    <div class="footer-links footer-menu">
                        <h3>quick links</h3>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">about us</a></li>
                            <li><a href="#">cars</a></li>
                            <li><a href="#">services</a></li>
                        </ul>
                    </div>
                    <!-- Footer Menu End -->
                </div>

                <div class="col-lg-3 col-md-4">
                    <!-- Footer Newsletter Start -->
                    <div class="footer-newsletter">
                        <h3>Subscribe to the Newsleeters</h3>
                        <!-- Footer Newsletter Form Start -->
                        <div class="footer-newsletter-form">
                            <form id="newslettersForm" action="#" method="POST">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" id="mail"
                                        placeholder="Email ..." required>
                                    <button type="submit" class="section-icon-btn"><img src="images/arrow-white.svg"
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

    <!-- Custom js -->
    @stack('scripts')
</body>

</html>
