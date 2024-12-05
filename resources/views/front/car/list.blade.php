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
                        <h1 class="text-anime-style-3" data-cursor="-opaque">Our Fleets</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-2.html">home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">fleets</li>
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
                                        placeholder="Search..." required>
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
                                    <h3>categories</h3>
                                </div>

                                <ul>
                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox1">
                                        <label class="form-check-label" for="checkbox1">sport cars</label>
                                    </li>

                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox2">
                                        <label class="form-check-label" for="checkbox2">electric car</label>
                                    </li>

                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox3">
                                        <label class="form-check-label" for="checkbox3">Convertible</label>
                                    </li>

                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox4">
                                        <label class="form-check-label" for="checkbox4">luxury cars</label>
                                    </li>

                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox5">
                                        <label class="form-check-label" for="checkbox5">sedan</label>
                                    </li>

                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox6">
                                        <label class="form-check-label" for="checkbox6">coupe cars</label>
                                    </li>
                                </ul>
                            </div>
                            <!-- Fleets Sidebar List End -->

                            <!-- Fleets Sidebar List Start -->
                            <div class="fleets-sidebar-list">
                                <div class="fleets-list-title">
                                    <h3>pickup location</h3>
                                </div>

                                <ul>
                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox7">
                                        <label class="form-check-label" for="checkbox7">abu dhabi</label>
                                    </li>

                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox8">
                                        <label class="form-check-label" for="checkbox8">alain</label>
                                    </li>

                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox9">
                                        <label class="form-check-label" for="checkbox9">dubai</label>
                                    </li>

                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox10">
                                        <label class="form-check-label" for="checkbox10">sharjah</label>
                                    </li>
                                </ul>
                            </div>
                            <!-- Fleets Sidebar List End -->

                            <!-- Fleets Sidebar List Start -->
                            <div class="fleets-sidebar-list">
                                <div class="fleets-list-title">
                                    <h3>dropoff location</h3>
                                </div>

                                <ul>
                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox11">
                                        <label class="form-check-label" for="checkbox11">abu dhabi</label>
                                    </li>

                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox12">
                                        <label class="form-check-label" for="checkbox12">alain</label>
                                    </li>

                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox13">
                                        <label class="form-check-label" for="checkbox13">dubai</label>
                                    </li>
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
                            <div class="col-lg-4 col-md-6">
                                <!-- Perfect Fleets Item Start -->
                                <div class="perfect-fleet-item fleets-collection-item wow fadeInUp">
                                    <!-- Image Box Start -->
                                    <div class="image-box">
                                        <img src="images/perfect-fleet-img-1.png" alt="">
                                    </div>
                                    <!-- Image Box End -->

                                    <!-- Perfect Fleets Content Start -->
                                    <div class="perfect-fleet-content">
                                        <!-- Perfect Fleets Title Start -->
                                        <div class="perfect-fleet-title">
                                            <h3>luxury car</h3>
                                            <h2>BMW M2 Car 2017</h2>
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
                                                <h2>$280<span>/day</span></h2>
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

                            <div class="col-lg-4 col-md-6">
                                <!-- Perfect Fleets Item Start -->
                                <div class="perfect-fleet-item fleets-collection-item wow fadeInUp" data-wow-delay="0.4s">
                                    <!-- Image Box Start -->
                                    <div class="image-box">
                                        <img src="images/perfect-fleet-img-3.png" alt="">
                                    </div>
                                    <!-- Image Box End -->

                                    <!-- Perfect Fleets Content Start -->
                                    <div class="perfect-fleet-content">
                                        <!-- Perfect Fleets Title Start -->
                                        <div class="perfect-fleet-title">
                                            <h3>luxury car</h3>
                                            <h2>Ferrari F12 Car 2022</h2>
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
                                                <h2>$450<span>/day</span></h2>
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

                            <div class="col-lg-4 col-md-6">
                                <!-- Perfect Fleets Item Start -->
                                <div class="perfect-fleet-item fleets-collection-item wow fadeInUp" data-wow-delay="0.6s">
                                    <!-- Image Box Start -->
                                    <div class="image-box">
                                        <img src="images/perfect-fleet-img-4.png" alt="">
                                    </div>
                                    <!-- Image Box End -->

                                    <!-- Perfect Fleets Content Start -->
                                    <div class="perfect-fleet-content">
                                        <!-- Perfect Fleets Title Start -->
                                        <div class="perfect-fleet-title">
                                            <h3>luxury car</h3>
                                            <h2>Toyota Yaris 2017</h2>
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
                                                <h2>$220<span>/day</span></h2>
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

                            <div class="col-lg-4 col-md-6">
                                <!-- Perfect Fleets Item Start -->
                                <div class="perfect-fleet-item fleets-collection-item wow fadeInUp" data-wow-delay="0.8s">
                                    <!-- Image Box Start -->
                                    <div class="image-box">
                                        <img src="images/perfect-fleet-img-5.png" alt="">
                                    </div>
                                    <!-- Image Box End -->

                                    <!-- Perfect Fleets Content Start -->
                                    <div class="perfect-fleet-content">
                                        <!-- Perfect Fleets Title Start -->
                                        <div class="perfect-fleet-title">
                                            <h3>luxury car</h3>
                                            <h2>BMW M2 Car 2017</h2>
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
                                                <h2>$280<span>/day</span></h2>
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

                            <div class="col-lg-4 col-md-6">
                                <!-- Perfect Fleets Item Start -->
                                <div class="perfect-fleet-item fleets-collection-item wow fadeInUp" data-wow-delay="1s">
                                    <!-- Image Box Start -->
                                    <div class="image-box">
                                        <img src="images/perfect-fleet-img-6.png" alt="">
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

                            <div class="col-lg-4 col-md-6">
                                <!-- Perfect Fleets Item Start -->
                                <div class="perfect-fleet-item fleets-collection-item wow fadeInUp" data-wow-delay="1.2s">
                                    <!-- Image Box Start -->
                                    <div class="image-box">
                                        <img src="images/perfect-fleet-img-3.png" alt="">
                                    </div>
                                    <!-- Image Box End -->

                                    <!-- Perfect Fleets Content Start -->
                                    <div class="perfect-fleet-content">
                                        <!-- Perfect Fleets Title Start -->
                                        <div class="perfect-fleet-title">
                                            <h3>luxury car</h3>
                                            <h2>Ferrari F12 Car 2022</h2>
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
                                                <h2>$450<span>/day</span></h2>
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

                            <div class="col-lg-4 col-md-6">
                                <!-- Perfect Fleets Item Start -->
                                <div class="perfect-fleet-item fleets-collection-item wow fadeInUp" data-wow-delay="1.4s">
                                    <!-- Image Box Start -->
                                    <div class="image-box">
                                        <img src="images/perfect-fleet-img-4.png" alt="">
                                    </div>
                                    <!-- Image Box End -->

                                    <!-- Perfect Fleets Content Start -->
                                    <div class="perfect-fleet-content">
                                        <!-- Perfect Fleets Title Start -->
                                        <div class="perfect-fleet-title">
                                            <h3>luxury car</h3>
                                            <h2>Toyota Yaris 2017</h2>
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
                                                <h2>$220<span>/day</span></h2>
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

                            <div class="col-lg-4 col-md-6">
                                <!-- Perfect Fleets Item Start -->
                                <div class="perfect-fleet-item fleets-collection-item wow fadeInUp" data-wow-delay="1.4s">
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
                                            <h2>Toyota Yaris 2017</h2>
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
                                                <h2>$220<span>/day</span></h2>
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
