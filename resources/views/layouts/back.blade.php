<!DOCTYPE html>
<html lang="fr" dir="ltr" data-nav-layout="vertical" class="light" data-header-styles="light"
    data-menu-styles="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOD - Administration</title>
    <meta name="author" content="codeur X">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="#">
    <meta name="keywords" content="#">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/images/jod_ico.png') }}">

    <!-- Main JS -->
    <script src="{{ asset('back/js/main.js') }}"></script>

    <!-- Style Css -->
    <link rel="stylesheet" href="{{ asset('back/css/style.css') }}">

    <!-- Simplebar Css -->
    <link rel="stylesheet" href="{{ asset('back/libs/simplebar/simplebar.min.css') }}">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{ asset('back/libs/@simonwep/pickr/themes/nano.min.css') }}">

    <!-- Vector Map Css-->
    <link rel="stylesheet" href="{{ asset('back/libs/jsvectormap/css/jsvectormap.min.css') }}">

    <style>
        .desktop-logo,
        .desktop-dark {
            width: 30%;
            margin-top: -15px !important;
        }
    </style>

    @stack('styles')

    @php
        $user = Auth::user();
        $user->load(['roles']);
    @endphp

</head>

<body class="">

    <div class="page">

        <!-- Start::app-sidebar -->
        <aside class="app-sidebar" id="sidebar">

            <!-- Start::main-sidebar-header -->
            <div class="main-sidebar-header">
                <a href="{{ route('dashboard') }}" class="header-logo">
                    <img src="{{ asset('front/images/jod.png') }}" alt="logo" class="main-logo desktop-logo">
                    <img src="{{ asset('front/images/jod.png') }}" alt="logo" class="main-logo toggle-logo">
                    <img src="{{ asset('front/images/jod_white.png') }}" alt="logo" class="main-logo desktop-dark">
                    <img src="{{ asset('front/images/jod_white.png') }}" alt="logo" class="main-logo toggle-dark">
                </a>
            </div>
            <!-- End::main-sidebar-header -->

            <!-- Start::main-sidebar -->
            <div class="main-sidebar " id="sidebar-scroll">

                <!-- Start::nav -->
                <nav class="main-menu-container nav nav-pills flex-column sub-open">
                    <div class="slide-left" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                        </svg></div>
                    <ul class="main-menu">
                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">JOD TRADE & CO</span></li>
                        <!-- End::slide__category -->

                        <!-- Start::slide -->
                        <li class="slide">
                            <a href="{{ route('dashboard') }}" class="side-menu__item">
                                <i class="ri-home-8-line side-menu__icon"></i>
                                <span class="side-menu__label">Tableau de Bord</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">Gestion des Véhicules</span></li>
                        <!-- End::slide__category -->

                        <!-- Start::slide -->
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <i class="ti ti-car side-menu__icon"></i>
                                <span class="side-menu__label">Véhicules</span>
                                <i class="ri ri-arrow-right-s-line side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide"><a href="{{ route('backend.list.cars') }}"
                                        class="side-menu__item">Liste</a></li>
                                <li class="slide"><a href="{{ route('backend.add.car') }}"
                                        class="side-menu__item">Ajouter</a></li>
                                <li class="slide"><a href="{{ route('backend.list.categories') }}"
                                        class="side-menu__item">Catégorie</a></li>
                                <li class="slide"><a href="{{ route('backend.list.marques') }}"
                                        class="side-menu__item">Marques</a></li>
                            </ul>
                        </li>
                        <!-- End::slide -->


                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">Gestion des Réservations</span></li>
                        <!-- End::slide__category -->

                        <!-- Start::slide -->
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <i class="ti ti-archive side-menu__icon"></i>
                                <span class="side-menu__label">Réservations</span>
                                <i class="ri ri-arrow-right-s-line side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide"><a href="#" class="side-menu__item">Liste</a></li>
                            </ul>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">Comptabilités</span></li>
                        <!-- End::slide__category -->

                        <!-- Start::slide -->
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <i class="ti ti-cash side-menu__icon"></i>
                                <span class="side-menu__label">Paiements</span>
                                <i class="ri ri-arrow-right-s-line side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide"><a href="#" class="side-menu__item">Liste</a></li>
                                <li class="slide"><a href="#" class="side-menu__item">Ajouter</a></li>
                            </ul>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <i class="ri-inbox-unarchive-line side-menu__icon"></i>
                                <span class="side-menu__label">Recouvrements</span>
                                <i class="ri ri-arrow-right-s-line side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide"><a href="#" class="side-menu__item">Liste</a></li>
                                <li class="slide"><a href="#" class="side-menu__item">Ajouter</a></li>
                            </ul>
                        </li>
                        <!-- End::slide -->


                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">Gestion des Utilisateurs</span></li>
                        <!-- End::slide__category -->

                        <!-- Start::slide -->
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <i class="ti ti-user-check side-menu__icon"></i>
                                <span class="side-menu__label">Gestion de Rôles</span>
                                <i class="ri ri-arrow-right-s-line side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide"><a class="side-menu__item"
                                        href="{{ route('backend.list.role') }}">Rôles</a></li>
                                <li class="slide"><a class="side-menu__item"
                                        href="{{ route('backend.list.privilege') }}">Privilèges</a>
                                </li>
                                <li class="slide"><a class="side-menu__item"
                                        href="{{ route('backend.list.user-type') }}">Types d'utlisateurs</a></li>
                            </ul>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide">
                            <a href="{{ route('backend.list.administrator') }}" class="side-menu__item">
                                <i class="ti ti-user-exclamation side-menu__icon"></i>
                                <span class="side-menu__label">Administrateurs</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide">
                            <a href="{{ route('backend.list.user') }}" class="side-menu__item">
                                <i class="ti ti-users side-menu__icon"></i>
                                <span class="side-menu__label">Clients</span>
                            </a>
                        </li>
                        <!-- End::slide -->
                    </ul>
                    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                        </svg></div>
                </nav>
                <!-- End::nav -->

            </div>
            <!-- End::main-sidebar -->

        </aside>
        <!-- End::app-sidebar -->

        <!-- Start::Header -->
        <header class="header custom-sticky !top-0 !w-full">
            <nav class="main-header" aria-label="Global">
                <div class="header-content">
                    <div class="header-left">
                        <!-- Navigation Toggle -->
                        <div class="">
                            <button type="button" class="sidebar-toggle !w-100 !h-100">
                                <span class="sr-only">Toggle Navigation</span>
                                <i class="ri-arrow-right-circle-line header-icon"></i>
                            </button>
                        </div>
                        <!-- End Navigation Toggle -->
                    </div>

                    <div class="responsive-logo">
                        <a class="responsive-logo-dark" href="index.html" aria-label="Brand"><img
                                src="{{ asset('back/img/brand-logos/desktop-logo.png') }}" alt="logo"
                                class="mx-auto"></a>
                        <a class="responsive-logo-light" href="index.html" aria-label="Brand"><img
                                src="{{ asset('back/img/brand-logos/desktop-dark.png') }}" alt="logo"
                                class="mx-auto"></a>
                    </div>

                    <div class="header-right">
                        <div class="responsive-headernav">
                            <div class="header-nav-right">

                                <div class="header-search">
                                    <button aria-label="button" type="button" data-hs-overlay="#search-modal"
                                        class="inline-flex flex-shrink-0 justify-center items-center gap-2 h-[2.375rem] w-[2.375rem] rounded-full font-medium bg-gray-100 hover:bg-gray-200 text-gray-500 align-middle focus:outline-none focus:ring-0 focus:ring-gray-400 focus:ring-offset-0 focus:ring-offset-white transition-all text-xs dark:bg-bgdark dark:hover:bg-black/20 dark:text-white/70 dark:hover:text-white dark:focus:ring-white/10 dark:focus:ring-offset-white/10">
                                        <i class="ri-search-2-line header-icon"></i>
                                    </button>
                                </div>

                                <div class="header-theme-mode hidden sm:block">
                                    <a aria-label="anchor"
                                        class="hs-dark-mode-active:hidden flex hs-dark-mode group flex-shrink-0 justify-center items-center gap-2 h-[2.375rem] w-[2.375rem] rounded-full font-medium bg-gray-100 hover:bg-gray-200 text-gray-500 align-middle focus:outline-none focus:ring-0 focus:ring-gray-400 focus:ring-offset-0 focus:ring-offset-white transition-all text-xs dark:bg-bgdark dark:hover:bg-black/20 dark:text-white/70 dark:hover:text-white dark:focus:ring-white/10 dark:focus:ring-offset-white/10"
                                        href="javascript:;" data-hs-theme-click-value="dark">
                                        <i class="ri-moon-line header-icon"></i>
                                    </a>
                                    <a aria-label="anchor"
                                        class="hs-dark-mode-active:flex hidden hs-dark-mode group flex-shrink-0 justify-center items-center gap-2 h-[2.375rem] w-[2.375rem] rounded-full font-medium bg-gray-100 hover:bg-gray-200 text-gray-500 align-middle focus:outline-none focus:ring-0 focus:ring-gray-400 focus:ring-offset-0 focus:ring-offset-white transition-all text-xs dark:bg-bgdark dark:hover:bg-black/20 dark:text-white/70 dark:hover:text-white dark:focus:ring-white/10 dark:focus:ring-offset-white/10"
                                        href="javascript:;" data-hs-theme-click-value="light">
                                        <i class="ri-sun-line header-icon"></i>
                                    </a>
                                </div>

                                <div class="header-fullscreen hidden lg:block">
                                    <a aria-label="anchor" href="javascript:void(0);" onclick="openFullscreen();"
                                        class="inline-flex flex-shrink-0 justify-center items-center gap-2 h-[2.375rem] w-[2.375rem] rounded-full font-medium bg-gray-100 hover:bg-gray-200 text-gray-500 align-middle focus:outline-none focus:ring-0 focus:ring-gray-400 focus:ring-offset-0 focus:ring-offset-white transition-all text-xs dark:bg-bgdark dark:hover:bg-black/20 dark:text-white/70 dark:hover:text-white dark:focus:ring-white/10 dark:focus:ring-offset-white/10">
                                        <i class="ri-fullscreen-line header-icon full-screen-open"></i>
                                        <i
                                            class="ri-fullscreen-line header-icon fullscreen-exit-line full-screen-close hidden"></i>
                                    </a>
                                </div>

                                <div class="header-notification hs-dropdown ti-dropdown hidden sm:block"
                                    data-hs-dropdown-placement="bottom-right">
                                    <button id="dropdown-notification" type="button"
                                        class="hs-dropdown-toggle ti-dropdown-toggle p-0 border-0 flex-shrink-0 h-[2.375rem] w-[2.375rem] rounded-full shadow-none focus:ring-gray-400 text-xs dark:focus:ring-white/10">
                                        <i class="ri-notification-2-line header-icon animate-bell"></i>
                                        <span
                                            class="flex absolute h-5 w-5 top-0 ltr:right-0 rtl:left-0 -mt-1 ltr:-mr-1 rtl:-ml-1">
                                            <span
                                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-success/80 opacity-75"></span>
                                            <span
                                                class="relative inline-flex rounded-full h-5 w-5 bg-success text-white justify-center items-center"
                                                id="notify-data">4</span>
                                        </span>
                                    </button>
                                    <div class="hs-dropdown-menu ti-dropdown-menu w-[20rem] border-0"
                                        aria-labelledby="dropdown-notification">
                                        <div
                                            class="ti-dropdown-header !bg-primary border-b dark:border-white/10 flex justify-between items-center">
                                            <p class="ti-dropdown-header-title !text-white font-semibold">
                                                Notifications</p>
                                            <a href="javascript:void(0)"
                                                class="badge bg-black/20 text-white rounded-sm">Mark All Read</a>
                                        </div>
                                        <div class="ti-dropdown-divider divide-y divide-gray-200 dark:divide-white/10">
                                            <div class="py-2 first:pt-0 last:pb-0" id="allNotifyContainer">
                                                <div class="ti-dropdown-item relative header-box">
                                                    <a href="mail-inbox.html"
                                                        class="flex space-x-3 rtl:space-x-reverse">
                                                        <div class="ltr:mr-2 rtl:ml-2 avatar rounded-full ring-0">
                                                            <img src="{{ asset('back/img/users/17.jpg" alt="img') }}"
                                                                class="rounded-sm">
                                                        </div>
                                                        <div class="relative w-full">
                                                            <h5
                                                                class="text-sm text-gray-800 dark:text-white font-semibold mb-1">
                                                                Elon Isk</h5>
                                                            <p class="text-xs mb-1 max-w-[200px] truncate">Hello
                                                                there! How are you doing? Call me when...</p>
                                                            <p class="text-xs text-gray-400 dark:text-white/70">2 min
                                                            </p>
                                                        </div>
                                                    </a>
                                                    <a aria-label="anchor" href="javascript:void(0);"
                                                        class="header-remove-btn ltr:ml-auto rtl:mr-auto text-lg text-gray-500/20 dark:text-white/20 hover:text-gray-800 dark:hover:text-white">
                                                        <i class="ri-close-circle-line"></i>
                                                    </a>
                                                </div>
                                                <div class="ti-dropdown-item relative header-box">
                                                    <a href="mail-inbox.html"
                                                        class="flex items-center space-x-3 rtl:space-x-reverse">
                                                        <div class="ltr:mr-2 rtl:ml-2 avatar rounded-full ring-0">
                                                            <img src="{{ asset('back/img/users/2.jpg" alt="img') }}"
                                                                class="rounded-sm">
                                                        </div>
                                                        <div class="relative w-full">
                                                            <h5
                                                                class="text-sm text-gray-800 dark:text-white font-semibold mb-1">
                                                                Shakira Sen</h5>
                                                            <p class="text-xs mb-1 max-w-[200px] truncate">I would
                                                                like to discuss about that assets...</p>
                                                            <p class="text-xs text-gray-400 dark:text-white/70">09:43
                                                            </p>
                                                        </div>
                                                    </a>
                                                    <a aria-label="anchor" href="javascript:void(0);"
                                                        class="header-remove-btn ltr:ml-auto rtl:mr-auto text-lg text-gray-500/20 dark:text-white/20 hover:text-gray-800 dark:hover:text-white">
                                                        <i class="ri-close-circle-line"></i>
                                                    </a>
                                                </div>
                                                <div class="ti-dropdown-item relative header-box">
                                                    <a href="mail-inbox.html"
                                                        class="flex items-center space-x-3 rtl:space-x-reverse">
                                                        <div class="ltr:mr-2 rtl:ml-2 avatar rounded-full ring-0">
                                                            <img src="{{ asset('back/img/users/21.jpg') }}"
                                                                alt="img" class="rounded-sm">
                                                        </div>
                                                        <div class="relative w-full">
                                                            <h5
                                                                class="text-sm text-gray-800 dark:text-white font-semibold mb-1">
                                                                Sebastian</h5>
                                                            <p class="text-xs mb-1 max-w-[200px] truncate">Shall we go
                                                                to the cafe at downtown...</p>
                                                            <p class="text-xs text-gray-400 dark:text-white/70">
                                                                yesterday</p>
                                                        </div>
                                                    </a>
                                                    <a aria-label="anchor" href="javascript:void(0);"
                                                        class="header-remove-btn ltr:ml-auto rtl:mr-auto text-lg text-gray-500/20 dark:text-white/20 hover:text-gray-800 dark:hover:text-white">
                                                        <i class="ri-close-circle-line"></i>
                                                    </a>
                                                </div>
                                                <div class="ti-dropdown-item relative header-box">
                                                    <a href="mail-inbox.html"
                                                        class="flex items-center space-x-3 rtl:space-x-reverse">
                                                        <div class="ltr:mr-2 rtl:ml-2 avatar rounded-full ring-0">
                                                            <img src="{{ asset('back/img/users/11.jpg') }}"
                                                                alt="img" class="rounded-sm">
                                                        </div>
                                                        <div class="relative w-full">
                                                            <h5
                                                                class="text-sm text-gray-800 dark:text-white font-semibold mb-1">
                                                                Charlie Davieson</h5>
                                                            <p class="text-xs mb-1 max-w-[200px] truncate">Lorem ipsum
                                                                dolor sit amet, consectetur</p>
                                                            <p class="text-xs text-gray-400 dark:text-white/70">
                                                                yesterday</p>
                                                        </div>
                                                    </a>
                                                    <a aria-label="anchor" href="javascript:void(0);"
                                                        class="header-remove-btn ltr:ml-auto rtl:mr-auto text-lg text-gray-500/20 dark:text-white/20 hover:text-gray-800 dark:hover:text-white">
                                                        <i class="ri-close-circle-line"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="py-2 first:pt-0 px-5">
                                                <a class="w-full ti-btn ti-btn-primary p-2" href="mail-inbox.html">
                                                    View All
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="header-profile hs-dropdown ti-dropdown"
                                    data-hs-dropdown-placement="bottom-right">
                                    <button id="dropdown-profile" type="button"
                                        class="hs-dropdown-toggle ti-dropdown-toggle gap-2 p-0 flex-shrink-0 h-8 w-8 rounded-full shadow-none focus:ring-gray-400 text-xs dark:focus:ring-white/10">
                                        <img class="inline-block rounded-full ring-2 ring-white dark:ring-white/10"
                                            src="{{ asset('back/img/users/1.jpg') }}" alt="Image Description">
                                    </button>

                                    <div class="hs-dropdown-menu ti-dropdown-menu border-0 w-[20rem]"
                                        aria-labelledby="dropdown-profile">
                                        <div class="ti-dropdown-header !bg-primary flex">
                                            <div class="ltr:mr-3 rtl:ml-3">
                                                <img class="avatar shadow-none rounded-full !ring-transparent"
                                                    src="{{ asset('back/img/users/1.jpg') }}" alt="profile-img">
                                            </div>
                                            <div>
                                                <p class="ti-dropdown-header-title !text-white">
                                                    {{ $user['last_name'] . ' ' . $user['first_name'] }}</p>
                                                <p class="ti-dropdown-header-content !text-white/50">
                                                    {{ $user->roles->first()['name'] ?? '-' }}</p>
                                            </div>
                                        </div>
                                        <div class="mt-2 ti-dropdown-divider">
                                            <a href="{{ route('backend.profil.user') }}" class="ti-dropdown-item">
                                                <i class="ti ti-user-circle text-lg"></i>
                                                Profil
                                            </a>
                                            <a href="{{ url('log-out') }}" class="ti-dropdown-item">
                                                <i class="ti ti-logout  text-lg"></i>
                                                Déconnexion
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <!-- End::Header -->

        <div class="content">
            <!-- Start::main-content -->
            <div class="main-content">

                @yield('content')

            </div>
            <!-- Start::main-content -->
        </div>


        <!-- ========== Search Modal ========== -->
        <div id="search-modal" class="hs-overlay ti-modal hidden">
            <div class="ti-modal-box">
                <div class="ti-modal-content">
                    <div class="ti-modal-body">
                        <div class="header-search">
                            <label for="icon" class="sr-only">Search</label>
                            <div class="relative">
                                <div class="search-btn">
                                    <i class="ri ri-search-2-line search-btn-icon"></i>
                                </div>
                                <input type="text" id="icon" name="icon"
                                    class="py-2 ltr:pl-11 rtl:pr-11 ti-form-input focus:z-10" placeholder="Search">
                                <div class="voice-search">
                                    <i class="ri ri-mic-2-line voice-btn-icon"></i>
                                </div>
                                <div class="search-dropdown">
                                    <i class="ri ri-more-2-line search-dropdown-btn-icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <p class="font-semibold text-[13px] text-gray-400 dark:text-gray-200 mb-2">Are You Looking
                                For...</p>
                            <div class="badge rounded-sm bg-secondary/20 text-secondary relative header-box">
                                <a href="team.html"
                                    class="w-full my-auto items-center flex space-x-2 rtl:space-x-reverse">
                                    <span class="inline-block text-secondary ltr:mr-1 rtl:ml-1"><i
                                            class="ri ri-user-line text-sm"></i></span>
                                    Team
                                </a>
                                <a href="javascript:void(0);"
                                    class="header-remove-btn flex-shrink-0 h-4 w-4 inline-flex items-center justify-center rounded-full text-secondary hover:bg-secondary hover:text-secondary focus:outline-none focus:bg-secondary focus:text-white">
                                    <span class="sr-only">Remove badge</span>
                                    <svg class="h-4 w-4 hover:fill-white" xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                            <div class="badge rounded-sm bg-secondary/20 text-secondary relative header-box">
                                <a href="form-elements.html"
                                    class="w-full my-auto items-center flex space-x-2 rtl:space-x-reverse">
                                    <span class="inline-block text-secondary ltr:mr-1 rtl:ml-1"><i
                                            class="ri ri-file-text-line text-sm"></i></span>
                                    Forms
                                </a>
                                <a href="javascript:void(0);"
                                    class="header-remove-btn flex-shrink-0 h-4 w-4 inline-flex items-center justify-center rounded-full text-secondary hover:bg-secondary hover:text-secondary focus:outline-none focus:bg-secondary focus:text-white">
                                    <span class="sr-only">Remove badge</span>
                                    <svg class="h-4 w-4 hover:fill-white" xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                            <div class="badge rounded-sm bg-secondary/20 text-secondary relative header-box">
                                <a href="vector-maps.html"
                                    class="w-full my-auto items-center flex space-x-2 rtl:space-x-reverse">
                                    <span class="inline-block text-secondary ltr:mr-1 rtl:ml-1"><i
                                            class="ri ri-map-pin-line text-sm"></i></span>
                                    Maps
                                </a>
                                <a href="javascript:void(0);"
                                    class="header-remove-btn flex-shrink-0 h-4 w-4 inline-flex items-center justify-center rounded-full text-secondary hover:bg-secondary hover:text-secondary focus:outline-none focus:bg-secondary focus:text-white">
                                    <span class="sr-only">Remove badge</span>
                                    <svg class="h-4 w-4 hover:fill-white" xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                            <div class="badge rounded-sm bg-secondary/20 text-secondary relative header-box">
                                <a href="widgets.html"
                                    class="w-full my-auto items-center flex space-x-2 rtl:space-x-reverse">
                                    <span class="inline-block text-secondary ltr:mr-1 rtl:ml-1"><i
                                            class="ri ri-server-line text-sm"></i></span>
                                    Widgets
                                </a>
                                <a href="javascript:void(0);"
                                    class="header-remove-btn flex-shrink-0 h-4 w-4 inline-flex items-center justify-center rounded-full text-secondary hover:bg-secondary hover:text-secondary focus:outline-none focus:bg-secondary focus:text-white">
                                    <span class="sr-only">Remove badge</span>
                                    <svg class="h-4 w-4 hover:fill-white" xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path
                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="mt-5">
                            <p class="font-semibold text-sm text-gray-500 mb-2">Recent Search :</p>
                            <div
                                class="p-2 border dark:border-white/10 rounded-sm flex items-center text-gray-500 mb-1 relative header-box">
                                <a href="notifications.html" class="w-full my-auto items-center flex">
                                    <span class="text-sm">Notifications</span>
                                </a>
                                <a aria-label="anchor" href="javascript:void(0);"
                                    class="ltr:ml-auto rtl:mr-auto flex-shrink-0 h-4 w-4 inline-flex items-center justify-center rounded-full text-gray-500 focus:outline-none header-remove-btn">
                                    <i class="ri-close-line"></i>
                                </a>
                            </div>
                            <div
                                class="p-2 border dark:border-white/10 rounded-sm flex items-center text-gray-500 mb-1 relative header-box">
                                <a href="alerts.html" class="w-full my-auto items-center flex">
                                    <span class="text-sm">Alerts</span>
                                </a>
                                <a aria-label="anchor" href="javascript:void(0);"
                                    class="ltr:ml-auto rtl:mr-auto flex-shrink-0 h-4 w-4 inline-flex items-center justify-center rounded-full text-gray-500 focus:outline-none header-remove-btn">
                                    <i class="ri-close-line"></i>
                                </a>
                            </div>
                            <div
                                class="p-2 border dark:border-white/10 rounded-sm flex items-center text-gray-500 relative header-box">
                                <a href="tables.html" class="w-full my-auto items-center flex">
                                    <span class="text-sm">Tables</span>
                                </a>
                                <a aria-label="anchor" href="javascript:void(0);"
                                    class="ltr:ml-auto rtl:mr-auto flex-shrink-0 h-4 w-4 inline-flex items-center justify-center rounded-full text-gray-500 focus:outline-none header-remove-btn">
                                    <i class="ri-close-line"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="ti-modal-footer">
                        <div class="inline-flex rounded-md shadow-sm">
                            <button type="button" class="ti-btn-group py-1 ti-btn-soft-primary dark:border-white/10">
                                Search
                            </button>
                            <button type="button" class="ti-btn-group py-1 ti-btn-primary dark:border-white/10">
                                Clear Recents
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ========== END Search Modal ========== -->

        <footer class="mt-auto py-3 border-t dark:border-white/10 bg-white dark:bg-bgdark">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <p class="text-center">Copyright © <span id="year"></span> <a href="javascript:void(0)"
                        class="text-primary">JOD</a>. Développer avec <span
                        class="ri ri-heart-fill text-red-500"></span> Par <a class="text-primary"
                        href="javascript:void(0)"> JOBS </a> - Tous Droits Réservés </p>
            </div>
        </footer>


    </div>


    <!-- Apex Charts JS -->
    <script src="{{ asset('back/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Chartjs Chart JS -->
    <script src="{{ asset('back/libs/chart.js/chart.min.js') }}"></script>

    <!-- Index JS -->
    <script src="{{ asset('back/js/index.js') }}"></script>

    <!-- back To Top -->
    <div class="scrollToTop">
        <span class="arrow"><i class="ri-arrow-up-s-fill text-xl"></i></span>
    </div>

    <div id="responsive-overlay"></div>

    <!-- popperjs -->
    <script src="{{ asset('back/libs/@popperjs/core/umd/popper.min.js') }}"></script>

    <!-- Color Picker JS -->
    <script src="{{ asset('back/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>

    <!-- sidebar JS -->
    <script src="{{ asset('back/js/defaultmenu.js') }}"></script>

    <!-- sticky JS -->
    <script src="{{ asset('back/js/sticky.js') }}"></script>

    <!-- Switch JS -->
    <script src="{{ asset('back/js/switch.js') }}"></script>

    <!-- Preline JS -->
    <script src="{{ asset('back/libs/preline/preline.js') }}"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('back/libs/simplebar/simplebar.min.js') }}"></script>

    <!-- Custom JS -->
    @stack('scripts')

    <!-- Custom-Switcher JS -->
    <script src="{{ asset('back/js/custom-switcher.js') }}"></script>

</body>

</html>
