<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>OD Compta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="{{ asset('Back/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('Back/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('Back/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('Back/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- custom CSS -->
    @stack('styles')

</head>

<body class="auth-bg 100-vh">
    <div class="bg-overlay bg-light"></div>

    <div class="account-pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="auth-full-page-content d-flex min-vh-100 py-sm-5 py-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100 py-0 py-xl-4">

                                <div class="text-center mb-5">
                                    <a href="index-2.html">
                                        <span class="logo-lg">
                                            <img src="assets/images/logo-dark.png" alt="" height="21">
                                        </span>
                                    </a>
                                </div>

                                <div class="card my-auto overflow-hidden">
                                    <div class="row g-0">
                                        <div class="col-lg-12">

                                            @yield('content')

                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->

                                <div class="mt-5 text-center">
                                    <p class="mb-0 text-muted">©
                                        <script>
                                            document.write(new Date().getFullYear())
                                        </script> OD Compta. Développer avec <i
                                            class="mdi mdi-heart text-danger"></i> par Codeur X
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('Back/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Back/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('Back/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('Back/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('Back/js/plugins.js') }}"></script>

    <!-- password-addon init -->
    <script src="{{ asset('Back/js/pages/password-addon.init.js') }}"></script>

    <!-- Custom js -->
    @stack('scripts')

</body>

</html>
