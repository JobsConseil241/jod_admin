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
                        <h1 class="text-anime-style-3" data-cursor="-opaque">Notre flotte</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Accueil</a></li>
                                <li class="breadcrumb-item" aria-current="page">fleets</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Page Fleets Start -->
    <div class="page-fleets">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Fleets Sidebar Start -->
                    <div class="fleets-sidebar wow fadeInUp">
                        <!-- Fleets Search Box Start -->
                        <div class="fleets-search-box">
                            <form id="fleetsForm" action="#" method="POST">
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" id="search"
                                        placeholder="Rechercher..." required>
                                    <button type="submit" class="section-icon-btn"><i
                                            class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                        <!-- Fleets Search Box End -->

                        <div class="fleets-sidebar-list-box">
                            <!-- Fleets Sidebar List Start -->
                            <div class="fleets-sidebar-list">
                                <div class="fleets-list-title">
                                    <h3>Categories</h3>
                                </div>

                                <ul>
                                    @foreach($categories as $catego)
                                        <li class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="id_{{$catego->name}}">
                                            <label class="form-check-label" for="id_{{$catego->name}}">{{$catego->name}}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Fleets Sidebar List End -->

                            <!-- Fleets Sidebar List Start -->
                            <div class="fleets-sidebar-list">
                                <div class="fleets-list-title">
                                    <h3>Marques</h3>
                                </div>

                                <ul>
                                    @foreach($marques as $mq)
                                        <li class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="id_{{$mq->name}}">
                                            <label class="form-check-label" for="id_{{$mq->name}}">{{$mq->name}}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Fleets Sidebar List End -->

                        </div>
                    </div>
                    <!-- Fleets Sidebar End -->
                </div>

                <div class="col-lg-9">
                    <!-- Fleets Collection Box Start -->
                    <div class="fleets-collection-box">
                        <div class="row">
                            @foreach($cars as $crs)
                                <div class="col-lg-4 col-md-6">
                                    <!-- Perfect Fleets Item Start -->
                                    <div class="perfect-fleet-item fleets-collection-item wow fadeInUp">
                                        <!-- Image Box Start -->
                                        <div class="image-box">
                                            <img src="{{asset($crs->vehiculeMedias[0]->photo_avant)}}" alt="">
                                        </div>
                                        <!-- Image Box End -->

                                        <!-- Perfect Fleets Content Start -->
                                        <div class="perfect-fleet-content">
                                            <!-- Perfect Fleets Title Start -->
                                            <div class="perfect-fleet-title">
                                                <h3>{{$crs->categorie->name}}</h3>
                                                <h2>{{$crs->marque->name}} {{$crs->name}}</h2>
                                            </div>
                                            <!-- Perfect Fleets Content End -->

                                            <!-- Perfect Fleets Body Start -->
                                            <div class="perfect-fleet-body">
                                                <ul>
                                                    <li><img src="{{asset('front/images/icon-fleets-single-sidebar-list-1.svg')}}" alt="">Places
                                                        <span>{{$crs->nombre_places}}</span></li>
                                                    <li><img src="{{asset('front/images/icon-fleets-single-sidebar-list-2.svg')}}" alt="">Bagages
                                                        <span>Oui</span></li>
                                                    <li><img src="{{asset('front/images/icon-fleets-single-sidebar-list-3.svg')}}" alt="">Portes
                                                        <span>{{$crs->nombre_portes}}</span></li>
                                                    <li><img src="{{asset('front/images/icon-fleets-single-sidebar-list-4.svg')}}" alt="">
                                                        <span>{{$crs->transmission}}</span></li>
                                                </ul>
                                            </div>
                                            <!-- Perfect Fleets Body End -->

                                            <!-- Perfect Fleets Footer Start -->
                                            <div class="perfect-fleet-footer">
                                                <!-- Perfect Fleets Pricing Start -->
                                                <div class="perfect-fleet-pricing">
                                                    <h2><span>XAF</span> {{ $crs->prix_location }}<span>/par jour</span></h2>
                                                </div>
                                                <!-- Perfect Fleets Pricing End -->

                                                <!-- Perfect Fleets Btn Start -->
                                                <div class="perfect-fleet-btn">
                                                    <a href="#" class="section-icon-btn"><img
                                                            src="{{asset('front/images/arrow-white.svg')}}" alt=""></a>
                                                </div>
                                                <!-- Perfect Fleets Btn End -->
                                            </div>
                                            <!-- Perfect Fleets Footer End -->
                                        </div>
                                        <!-- Perfect Fleets Content End -->
                                    </div>
                                    <!-- Perfect Fleets Item End -->
                                </div>

                            @endforeach

                            <div class="col-lg-4 col-md-6">
                                <!-- Perfect Fleets Item Start -->
                                <div class="perfect-fleet-item fleets-collection-item wow fadeInUp" data-wow-delay="0.2s">
                                    <!-- Image Box Start -->
                                    <div class="image-box">
                                        <img src="images/perfect-fleet-img-2.png" alt="">
                                    </div>
                                    <!-- Image Box End -->

                                    <!-- Perfect Fleets Content Start -->
                                    <div class="perfect-fleet-content">
                                        <!-- Perfect Fleets Title Start -->
                                        <div class="perfect-fleet-title">
                                            <h3>luxury car</h3>
                                            <h2>Audi RS7 Car 2016</h2>
                                        </div>
                                        <!-- Perfect Fleets Content End -->

                                        <!-- Perfect Fleets Body Start -->
                                        <div class="perfect-fleet-body">
                                            <ul>
                                                <li><img src="images/icon-fleet-list-1.svg" alt="">4 passenger
                                                </li>
                                                <li><img src="images/icon-fleet-list-2.svg" alt="">4 door</li>
                                                <li><img src="images/icon-fleet-list-3.svg" alt="">bags</li>
                                                <li><img src="images/icon-fleet-list-4.svg" alt="">auto</li>
                                            </ul>
                                        </div>
                                        <!-- Perfect Fleets Body End -->

                                        <!-- Perfect Fleets Footer Start -->
                                        <div class="perfect-fleet-footer">
                                            <!-- Perfect Fleets Pricing Start -->
                                            <div class="perfect-fleet-pricing">
                                                <h2>$320<span>/day</span></h2>
                                            </div>
                                            <!-- Perfect Fleets Pricing End -->

                                            <!-- Perfect Fleets Btn Start -->
                                            <div class="perfect-fleet-btn">
                                                <a href="#" class="section-icon-btn"><img
                                                        src="images/arrow-white.svg" alt=""></a>
                                            </div>
                                            <!-- Perfect Fleets Btn End -->
                                        </div>
                                        <!-- Perfect Fleets Footer End -->
                                    </div>
                                    <!-- Perfect Fleets Content End -->
                                </div>
                                <!-- Perfect Fleets Item End -->
                            </div>


                            <div class="col-lg-12">
                                <!-- Fleets Pagination Start -->
                                <div class="fleets-pagination wow fadeInUp" data-wow-delay="0.5s">
                                    <ul class="pagination">
                                        <li><a href="#"><i class="fa-solid fa-arrow-left-long"></i></a></li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#"><i class="fa-solid fa-arrow-right-long"></i></a></li>
                                    </ul>
                                </div>
                                <!-- Fleets Pagination End -->
                            </div>
                        </div>
                    </div>
                    <!-- Fleets Collection Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Fleets End -->
@endsection

@push('scripts')
@endpush
