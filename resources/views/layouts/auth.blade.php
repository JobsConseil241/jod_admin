<!DOCTYPE html>
<html lang="en" dir="ltr" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> JOD Trade & Co </title>
    <meta name="description" content="#">
    <meta name="keywords" content="jod, location vehicule">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/images/jod_ico.png') }}">

    <!-- Style Css -->
    <link rel="stylesheet" href="{{ asset('back/css/style.css') }}">

    <!-- Simplebar Css -->
    <link rel="stylesheet" href="{{ asset('back/libs/simplebar/simplebar.min.css') }}">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{ asset('back/libs/@simonwep/pickr/themes/nano.min.css') }}">

    <!-- custom CSS -->
    @stack('styles')

</head>

<body class="authentication-page">

    <!-- ========== MAIN CONTENT ========== -->
    @yield('content')
    <!-- ========== END MAIN CONTENT ========== -->

    <!-- popperjs -->
    <script src="{{ asset('back/libs/@popperjs/core/umd/popper.min.js') }}"></script>

    <!-- Custom-Switcher JS -->
    <script src="{{ asset('back/js/custom-switcher.js') }}"></script>

    <!-- Preline JS -->
    <script src="{{ asset('back/libs/preline/preline.js') }}"></script>

    <!-- Custom js -->
    @stack('scripts')

</body>

</html>
