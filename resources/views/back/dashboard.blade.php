@extends('layouts.back')

@push('styles')
@endpush

@inject('Lang', 'App\Services\LanguageService')

@section('content')
    <!-- Page Header -->
    <div class="block justify-between page-header md:flex">
        <div>
            <h3 class="text-gray-700 hover:text-gray-900 dark:text-white dark:hover:text-white text-2xl font-medium">
                Tableau de Bord</h3>
        </div>
        <ol class="flex items-center whitespace-nowrap min-w-0">
            <li class="text-sm">
                <a class="flex items-center font-semibold text-primary hover:text-primary dark:text-primary truncate"
                    href="{{route('dashboard')}}">
                    Accueil
                    <i
                        class="ti ti-chevrons-right flex-shrink-0 mx-3 overflow-visible text-gray-300 dark:text-gray-300 rtl:rotate-180"></i>
                </a>
            </li>
            <li class="text-sm text-gray-500 hover:text-primary dark:text-white/70 " aria-current="page">
                Tableau de Bord
            </li>
        </ol>
    </div>
    <!-- Page Header Close -->

    <!-- Start::row-1 -->
    <div class="grid grid-cols-12 gap-x-5">
        <div class="col-span-12 md:col-span-6 xxl:col-span-3">
            <div class="box overflow-hidden">
                <div class="box-body">
                    <div class="flex">
                        <div class="flex space-x-3 rtl:space-x-reverse">
                            <div class="avatar p-2 rounded-sm bg-primary/10">
                                <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg"
                                    enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                                    <path class="fill-primary"
                                        d="M9,10h2.5c0.276123,0,0.5-0.223877,0.5-0.5S11.776123,9,11.5,9H10V8c0-0.276123-0.223877-0.5-0.5-0.5S9,7.723877,9,8v1c-1.1045532,0-2,0.8954468-2,2s0.8954468,2,2,2h1c0.5523071,0,1,0.4476929,1,1s-0.4476929,1-1,1H7.5C7.223877,15,7,15.223877,7,15.5S7.223877,16,7.5,16H9v1.0005493C9.0001831,17.2765503,9.223999,17.5001831,9.5,17.5h0.0006104C9.7765503,17.4998169,10.0001831,17.276001,10,17v-1c1.1045532,0,2-0.8954468,2-2s-0.8954468-2-2-2H9c-0.5523071,0-1-0.4476929-1-1S8.4476929,10,9,10z M21.5,12H17V2.5c0.000061-0.0875244-0.0228882-0.1735229-0.0665283-0.2493896c-0.1375732-0.2393188-0.4431152-0.3217773-0.6824951-0.1842041l-3.2460327,1.8603516L9.7481079,2.0654297c-0.1536865-0.0878906-0.3424072-0.0878906-0.4960938,0l-3.256897,1.8613281L2.7490234,2.0664062C2.6731567,2.0227661,2.5871582,1.9998779,2.4996338,1.9998779C2.2235718,2.000061,1.9998779,2.223938,2,2.5v17c0.0012817,1.380188,1.119812,2.4987183,2.5,2.5H19c1.6561279-0.0018311,2.9981689-1.3438721,3-3v-6.5006104C21.9998169,12.2234497,21.776001,11.9998169,21.5,12z M4.5,21c-0.828064-0.0009155-1.4990845-0.671936-1.5-1.5V3.3623047l2.7412109,1.5712891c0.1575928,0.0872192,0.348877,0.0875854,0.5068359,0.0009766L9.5,3.0761719l3.2519531,1.8583984c0.157959,0.0866089,0.3492432,0.0862427,0.5068359-0.0009766L16,3.3623047V19c0.0008545,0.7719116,0.3010864,1.4684448,0.7803345,2H4.5z M21,19c0,1.1045532-0.8954468,2-2,2s-2-0.8954468-2-2v-6h4V19z">
                                    </path>
                                </svg>
                            </div>
                            <h6 class="text-lg font-medium text-gray-800 mb-2 dark:text-white my-auto">
                                Revenues Total</h6>
                        </div>
                        <span class="badge bg-primary/10 text-primary py-1 ltr:ml-auto rtl:mr-auto !my-auto">
                            <i class="ti ti-trending-up"></i> 5%
                        </span>
                    </div>
                    <div class="mt-2">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">95 000 FCFA</h2>
                        <p class="text-xs text-gray-400 ">la semaine derniere</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 md:col-span-6 xxl:col-span-3">
            <div class="box overflow-hidden">
                <div class="box-body">
                    <div class="flex">
                        <div class="flex space-x-3 rtl:space-x-reverse">
                            <div class="avatar p-2 rounded-sm bg-secondary/10">
                                <svg class="fill-secondary" xmlns="http://www.w3.org/2000/svg"
                                    enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                                    <path class="fill-secondary"
                                        d="M9.5,7h7C16.776123,7,17,6.776123,17,6.5S16.776123,6,16.5,6h-7C9.223877,6,9,6.223877,9,6.5S9.223877,7,9.5,7z M7.5,11h9c0.276123,0,0.5-0.223877,0.5-0.5S16.776123,10,16.5,10h-9C7.223877,10,7,10.223877,7,10.5S7.223877,11,7.5,11z M20.5,2H3.4993896C3.2234497,2.0001831,2.9998169,2.223999,3,2.5v19c-0.000061,0.1124268,0.0378418,0.2216187,0.1074829,0.3098755c0.1710205,0.2167358,0.4853516,0.2537231,0.7020874,0.0827026l2.8652344-2.2617188l2.3583984,1.7695312c0.1777954,0.1328125,0.421814,0.1328125,0.5996094,0L12,19.625l2.3671875,1.7753906c0.1777954,0.1328125,0.421814,0.1328125,0.5996094,0l2.3583984-1.7695312l2.8652344,2.2617188C20.2785034,21.9623413,20.3876343,22.0002441,20.5,22h0.0006104C20.7766113,21.9998169,21.0001831,21.7759399,21,21.5V2.4993896C20.9998169,2.2234497,20.776001,1.9998169,20.5,2z M20,20.46875l-2.3574219-1.8613281c-0.0882568-0.069519-0.1972656-0.1072998-0.3095703-0.1074219c-0.1080933-0.000061-0.2132568,0.0349121-0.2998047,0.0996094L14.6669922,20.375l-2.3671875-1.7753906c-0.1777954-0.1328125-0.421814-0.1328125-0.5996094,0L9.3330078,20.375l-2.3662109-1.7753906c-0.1817017-0.1348877-0.4311523-0.1317139-0.609375,0.0078125L4,20.46875V3h16V20.46875z M7.5,15h9c0.276123,0,0.5-0.223877,0.5-0.5S16.776123,14,16.5,14h-9C7.223877,14,7,14.223877,7,14.5S7.223877,15,7.5,15z">
                                    </path>
                                </svg>
                            </div>
                            <h6 class="text-lg font-medium text-gray-800 mb-2 dark:text-white my-auto">
                                Total Dépenses Pannes</h6>
                        </div>
                        <span class="badge bg-secondary/10 text-secondary py-1 ltr:ml-auto rtl:mr-auto !my-auto"><i
                                class="ti ti-trending-up"></i> 0.8%</span>
                    </div>
                    <div class="mt-2">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">15 000 FCFA</h2>
                        <p class="text-xs text-gray-400 ">la semaine dernière</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 md:col-span-6 xxl:col-span-3">
            <div class="box overflow-hidden">
                <div class="box-body">
                    <div class="flex">
                        <div class="flex space-x-3 rtl:space-x-reverse">
                            <div class="avatar p-2 rounded-sm bg-warning/10">
                                <svg class="fill-warning" xmlns="http://www.w3.org/2000/svg"
                                    enable-background="new 0 0 24 24" viewBox="0 0 24 24" id="shopping-bag">
                                    <path class="fill-warning" fill="#4B5563"
                                        d="M19.5,7H16V5.9169922c0-2.2091064-1.7908325-4-4-4s-4,1.7908936-4,4V7H4.5C4.4998169,7,4.4996338,7,4.4993896,7C4.2234497,7.0001831,3.9998169,7.223999,4,7.5V19c0.0018311,1.6561279,1.3438721,2.9981689,3,3h10c1.6561279-0.0018311,2.9981689-1.3438721,3-3V7.5c0-0.0001831,0-0.0003662,0-0.0006104C19.9998169,7.2234497,19.776001,6.9998169,19.5,7z M9,5.9169922c0-1.6568604,1.3431396-3,3-3s3,1.3431396,3,3V7H9V5.9169922z M19,19c-0.0014038,1.1040039-0.8959961,1.9985962-2,2H7c-1.1040039-0.0014038-1.9985962-0.8959961-2-2V8h3v2.5C8,10.776123,8.223877,11,8.5,11S9,10.776123,9,10.5V8h6v2.5c0,0.0001831,0,0.0003662,0,0.0005493C15.0001831,10.7765503,15.223999,11.0001831,15.5,11c0.0001831,0,0.0003662,0,0.0006104,0C15.7765503,10.9998169,16.0001831,10.776001,16,10.5V8h3V19z">
                                    </path>
                                </svg>
                            </div>
                            <h6 class="text-lg font-medium text-gray-800 mb-2 dark:text-white my-auto">
                                nombres de vehicules</h6>
                        </div>
                        <span class="badge bg-warning/10 text-warning py-1 ltr:ml-auto rtl:mr-auto !my-auto"><i
                                class="ti ti-trending-down"></i> 0%</span>
                    </div>
                    <div class="mt-2">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">10</h2>
                        <p class="text-xs text-gray-400 ">la semaine dernière</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 md:col-span-6 xxl:col-span-3">
            <div class="box overflow-hidden">
                <div class="box-body">
                    <div class="flex">
                        <div class="flex space-x-3 rtl:space-x-reverse">
                            <div class="avatar p-2 rounded-sm bg-success/10">
                                <svg class="fill-success" xmlns="http://www.w3.org/2000/svg"
                                    enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                                    <path class="fill-success"
                                        d="M10.75,8H12h0.0006104H15.5C15.776123,8,16,7.776123,16,7.5S15.776123,7,15.5,7h-3V5.5C12.5,5.223877,12.276123,5,12,5s-0.5,0.223877-0.5,0.5V7h-0.75C9.2312012,7,8,8.2312012,8,9.75s1.2312012,2.75,2.75,2.75h2.5c0.9664917,0,1.75,0.7835083,1.75,1.75S14.2164917,16,13.25,16H8.5C8.223877,16,8,16.223877,8,16.5S8.223877,17,8.5,17h3v1.5c0,0.0001831,0,0.0003662,0,0.0005493C11.5001831,18.7765503,11.723999,19.0001831,12,19c0.0001831,0,0.0003662,0,0.0006104,0c0.2759399-0.0001831,0.4995728-0.223999,0.4993896-0.5V17h0.75c1.5187988,0,2.75-1.2312012,2.75-2.75s-1.2312012-2.75-2.75-2.75h-2.5C9.7835083,11.5,9,10.7164917,9,9.75S9.7835083,8,10.75,8z M12,1C5.9248657,1,1,5.9248657,1,12s4.9248657,11,11,11c6.0722656-0.0068359,10.9931641-4.9277344,11-11C23,5.9248657,18.0751343,1,12,1z M12,22C6.4771729,22,2,17.5228271,2,12S6.4771729,2,12,2c5.5201416,0.0064697,9.9935303,4.4798584,10,10C22,17.5228271,17.5228271,22,12,22z">
                                    </path>
                                </svg>
                            </div>
                            <h6 class="text-lg font-medium text-gray-800 mb-2 dark:text-white my-auto">
                                Nombre de reservations</h6>
                        </div>
                        <span class="badge bg-success/10 text-success py-1 ltr:ml-auto rtl:mr-auto !my-auto"><i
                                class="ti ti-trending-up"></i> 0.2%</span>
                    </div>
                    <div class="mt-2">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">4</h2>
                        <p class="text-xs text-gray-400 ">la semaine dernière</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-x-5">
        <div class="col-span-12 lg:col-span-12 xxl:col-span-6">
            <div class="box">
                <div class="box-header">
                    <div class="flex">
                        <h5 class="box-title my-auto">Sales Over View</h5>
                        <div class="hs-dropdown ti-dropdown block ltr:ml-auto rtl:mr-auto my-auto">
                            <button type="button" aria-label="button"
                                class="hs-dropdown-toggle ti-dropdown-toggle rounded-sm p-2 bg-white !border border-gray-200 text-gray-500 hover:bg-gray-100  focus:ring-gray-200 dark:bg-black/20 dark:hover:bg-black/30 dark:border-white/10 dark:hover:border-white/20 dark:focus:ring-white/10 dark:focus:ring-offset-white/10">
                                <i class="text-sm leading-none ti ti-dots-vertical"></i> </button>
                            <div class="hs-dropdown-menu ti-dropdown-menu">
                                <a class="ti-dropdown-item" href="javascript:void(0)">Download</a>
                                <a class="ti-dropdown-item" href="javascript:void(0)">Import</a>
                                <a class="ti-dropdown-item" href="javascript:void(0)">Export</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <ul class="flex flex-wrap sm:space-x-6 sm:rtl:space-x-reverse">
                        <li>
                            <p class="inline-flex items-center">
                                <span
                                    class="block w-3 h-3 rounded-full ltr:mr-2 rtl:ml-2 border-4 border-primary pointer-events-none"></span>
                                <span class="flex items-center">
                                    <span
                                        class="text-2xl text-gray-800 dark:text-white font-semibold ltr:mr-2 rtl:ml-2 pointer-events-none">$9.65K</span>
                                    <span class="text-sm text-gray-400 dark:text-white/80">/ Income</span>
                                </span>
                            </p>
                        </li>
                        <li>
                            <p class="inline-flex items-center">
                                <span
                                    class="block w-3 h-3 rounded-full ltr:mr-2 rtl:ml-2 border-4 border-gray-200 pointer-events-none"></span>
                                <span class="flex items-center">
                                    <span
                                        class="text-2xl text-gray-800 dark:text-white font-semibold ltr:mr-2 rtl:ml-2 pointer-events-none">$3.75K</span>
                                    <span class="text-sm text-gray-400 dark:text-white/80">/
                                        Expenses</span>
                                </span>
                            </p>
                        </li>
                    </ul>
                    <div id="salesOverview"></div>
                </div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-6 xxl:col-span-3">
            <div class="box">
                <div class="box-header">
                    <div class="flex">
                        <h5 class="box-title my-auto">Top Customers</h5>
                        <div class="hs-dropdown ti-dropdown block ltr:ml-auto rtl:mr-auto my-auto">
                            <button type="button" aria-label="button"
                                class="hs-dropdown-toggle ti-dropdown-toggle rounded-sm p-2 bg-white !border border-gray-200 text-gray-500 hover:bg-gray-100  focus:ring-gray-200 dark:bg-black/20 dark:hover:bg-black/30 dark:border-white/10 dark:hover:border-white/20 dark:focus:ring-white/10 dark:focus:ring-offset-white/10">
                                <i class="text-sm leading-none ti ti-dots-vertical"></i> </button>
                            <div class="hs-dropdown-menu ti-dropdown-menu">
                                <a class="ti-dropdown-item" href="javascript:void(0)">Download</a>
                                <a class="ti-dropdown-item" href="javascript:void(0)">Import</a>
                                <a class="ti-dropdown-item" href="javascript:void(0)">Export</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <ul class="flex flex-col">
                        <li class="px-0 pt-0 ti-list-group border-0 text-gray-800 dark:text-white">
                            <a href="javascript:void(0);" class="flex  justify-between items-center w-full">
                                <div class="flex space-x-3 rtl:space-x-reverse w-full">
                                    <img class="avatar avatar-sm rounded-sm" src="../assets/img/users/2.jpg"
                                        alt="Image Description">
                                    <div class="flex w-full">
                                        <div class="block my-auto">
                                            <p
                                                class="block text-sm font-semibold text-gray-800 hover:text-gray-900 my-auto  dark:text-white dark:hover:text-gray-200">
                                                Socrates Itumay</p>
                                            <p
                                                class="text-xs text-gray-400 dark:text-white/80 truncate sm:max-w-max max-w-[100px] font-normal">
                                                15 Purchases</p>
                                        </div>
                                    </div>
                                </div>
                                <div class=""><span class="text-sm font-medium">$1,835</span>
                                </div>
                            </a>
                        </li>
                        <li class="px-0 pt-3 ti-list-group border-0 text-gray-800 dark:text-white">
                            <a href="javascript:void(0);" class="flex  justify-between items-center w-full">
                                <div class="flex space-x-3 rtl:space-x-reverse w-full">
                                    <img class="avatar avatar-sm rounded-sm" src="../assets/img/users/3.jpg"
                                        alt="Image Description">
                                    <div class="flex w-full">
                                        <div class="block my-auto">
                                            <p
                                                class="block text-sm font-semibold text-gray-800 hover:text-gray-900 my-auto  dark:text-white dark:hover:text-gray-200">
                                                Json Taylor</p>
                                            <p
                                                class="text-xs text-gray-400 dark:text-white/80 truncate sm:max-w-max max-w-[100px] font-normal">
                                                18 Purchases</p>
                                        </div>
                                    </div>
                                </div>
                                <div class=""><span class="text-sm font-medium">$2,415</span>
                                </div>
                            </a>
                        </li>
                        <li class="px-0 pt-3 ti-list-group border-0 text-gray-800 dark:text-white">
                            <a href="javascript:void(0);" class="flex  justify-between items-center w-full">
                                <div class="flex space-x-3 rtl:space-x-reverse w-full">
                                    <img class="avatar avatar-sm rounded-sm" src="../assets/img/users/4.jpg"
                                        alt="Image Description">
                                    <div class="flex w-full">
                                        <div class="block my-auto">
                                            <p
                                                class="block text-sm font-semibold text-gray-800 hover:text-gray-900 my-auto  dark:text-white dark:hover:text-gray-200">
                                                Suzika Stallone</p>
                                            <p
                                                class="text-xs text-gray-400 dark:text-white/80 truncate sm:max-w-max max-w-[100px] font-normal">
                                                21 Purchases</p>
                                        </div>
                                    </div>
                                </div>
                                <div class=""><span class="text-sm font-medium">$2,341</span>
                                </div>
                            </a>
                        </li>
                        <li class="px-0 pt-3 ti-list-group border-0 text-gray-800 dark:text-white">
                            <a href="javascript:void(0);" class="flex  justify-between items-center w-full">
                                <div class="flex space-x-3 rtl:space-x-reverse w-full">
                                    <img class="avatar avatar-sm rounded-sm" src="../assets/img/users/5.jpg"
                                        alt="Image Description">
                                    <div class="flex w-full">
                                        <div class="block my-auto">
                                            <p
                                                class="block text-sm font-semibold text-gray-800 hover:text-gray-900 my-auto  dark:text-white dark:hover:text-gray-200">
                                                Angelina Hose</p>
                                            <p
                                                class="text-xs text-gray-400 dark:text-white/80 truncate sm:max-w-max max-w-[100px] font-normal">
                                                24 Purchases</p>
                                        </div>
                                    </div>
                                </div>
                                <div class=""><span class="text-sm font-medium">2,624</span></div>
                            </a>
                        </li>
                        <li class="px-0 pt-3 ti-list-group border-0 text-gray-800 dark:text-white">
                            <a href="javascript:void(0);" class="flex  justify-between items-center w-full">
                                <div class="flex space-x-3 rtl:space-x-reverse w-full">
                                    <img class="avatar avatar-sm rounded-sm" src="../assets/img/users/6.jpg"
                                        alt="Image Description">
                                    <div class="flex w-full">
                                        <div class="block my-auto">
                                            <p
                                                class="block text-sm font-semibold text-gray-800 hover:text-gray-900 my-auto  dark:text-white dark:hover:text-gray-200">
                                                Selena Deoyl</p>
                                            <p
                                                class="text-xs text-gray-400 dark:text-white/80 truncate sm:max-w-max max-w-[100px] font-normal">
                                                12 Purchases</p>
                                        </div>
                                    </div>
                                </div>
                                <div class=""><span class="text-sm font-medium">$1,035</span>
                                </div>
                            </a>
                        </li>
                        <li class="px-0 pt-3 pb-0 ti-list-group border-0 text-gray-800 dark:text-white">
                            <a href="javascript:void(0);" class="flex  justify-between items-center w-full">
                                <div class="flex space-x-3 rtl:space-x-reverse w-full">
                                    <img class="avatar avatar-sm rounded-sm" src="../assets/img/users/10.jpg"
                                        alt="Image Description">
                                    <div class="flex w-full">
                                        <div class="block my-auto">
                                            <p
                                                class="block text-sm font-semibold text-gray-800 hover:text-gray-900 my-auto  dark:text-white dark:hover:text-gray-200">
                                                Charlie Davieson</p>
                                            <p
                                                class="text-xs text-gray-400 dark:text-white/80 truncate sm:max-w-max max-w-[100px] font-normal">
                                                15 Purchases</p>
                                        </div>
                                    </div>
                                </div>
                                <div class=""><span class="text-sm font-medium">$1,835</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-6 xxl:col-span-3">
            <div class="box">
                <div class="box-header">
                    <div class="flex">
                        <h5 class="box-title my-auto">Sale Value</h5>
                        <div class="hs-dropdown ti-dropdown block ltr:ml-auto rtl:mr-auto my-auto">
                            <button type="button" aria-label="button"
                                class="hs-dropdown-toggle ti-dropdown-toggle rounded-sm p-2 bg-white !border border-gray-200 text-gray-500 hover:bg-gray-100  focus:ring-gray-200 dark:bg-black/20 dark:hover:bg-black/30 dark:border-white/10 dark:hover:border-white/20 dark:focus:ring-white/10 dark:focus:ring-offset-white/10">
                                <i class="text-sm leading-none ti ti-dots-vertical"></i> </button>
                            <div class="hs-dropdown-menu ti-dropdown-menu">
                                <a class="ti-dropdown-item" href="javascript:void(0)">Download</a>
                                <a class="ti-dropdown-item" href="javascript:void(0)">Import</a>
                                <a class="ti-dropdown-item" href="javascript:void(0)">Export</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body pb-0 px-0">
                    <div class="sales-value relative border-b border-gray-200 dark:border-white/10 pb-6">
                        <canvas id="sales-donut" class="!h-[230px] !w-full mx-auto my-auto"></canvas>
                        <div
                            class="chart-circle-value circle-style absolute border-2 border-dashed border-primary -top-5 inset-0 flex justify-center items-center w-[150px] h-[150px] leading-[70px] rounded-full text-5xl mx-auto my-auto">
                            <div class="text-xl font-bold">75%</div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="p-5 ltr:border-r rtl:border-l border-gray-200 dark:border-white/10">
                            <div class="text-sm text-gray-500 dark:text-white/80 text-center font-medium">
                                Sale Items
                            </div>
                            <div class="text-center">
                                <p class="text-gray-800 dark:text-white text-2xl font-medium">567</p>
                                <span class="text-success font-semibold"><i
                                        class="ri-arrow-up-s-fill align-middle"></i>0.23%</span>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="text-sm text-gray-500 dark:text-white/80 text-center font-medium">
                                Sale Revenue
                            </div>
                            <div class="text-center">
                                <p class="text-gray-800 dark:text-white text-2xl font-medium">$11,197</p>
                                <span class="text-danger font-semibold">
                                    <i class="ri-arrow-down-s-fill align-middle"></i>0.15%
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End::row-1 -->

    <!-- Start::row-2 -->
    <div class="p-6">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Tableau de bord</h2>
                <p class="mt-1 text-sm text-gray-500">Statistiques et performances</p>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-3">
                <div class="relative">
                    <select id="dateFilter" class="appearance-none block w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="current">{{ Carbon\Carbon::now()->locale('fr')->format('F Y') }}</option>
                        <option value="previous">{{ Carbon\Carbon::now()->subMonth()->locale('fr')->format('F Y') }}</option>
                        <option value="year">Année {{ Carbon\Carbon::now()->year }}</option>
                    </select>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute right-3 top-2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                    </svg>
                </div>
                <button id="exportStats" class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow-sm text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span>Exporter</span>
                </button>
            </div>
        </div>

        <!-- Stats Overview Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 mb-6">
            <!-- Total Revenue Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total des revenus</p>
                            <p class="mt-1 text-2xl font-semibold text-gray-900">{{ number_format($stats['total_revenue']['value'], 0, ',', ' ') }} FCFA</p>
                        </div>
                        <div class="h-12 w-12 bg-indigo-50 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center mt-4">
                        @if($stats['total_revenue']['evolution'] > 0)
                            <span class="text-green-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        <span class="ml-1">{{ $stats['total_revenue']['evolution'] }}%</span>
                    </span>
                        @elseif($stats['total_revenue']['evolution'] < 0)
                            <span class="text-red-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        <span class="ml-1">{{ abs($stats['total_revenue']['evolution']) }}%</span>
                    </span>
                        @else
                            <span class="text-gray-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                        </svg>
                        <span class="ml-1">0%</span>
                    </span>
                        @endif
                        <span class="ml-2 text-xs text-gray-500">{{ $stats['total_revenue']['period'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Active Rentals Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Locations actives</p>
                            <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $stats['active_rentals']['value'] }}</p>
                        </div>
                        <div class="h-12 w-12 bg-blue-50 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center mt-4">
                        @if($stats['active_rentals']['evolution'] > 0)
                            <span class="text-green-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        <span class="ml-1">{{ $stats['active_rentals']['evolution'] }}%</span>
                    </span>
                        @elseif($stats['active_rentals']['evolution'] < 0)
                            <span class="text-red-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        <span class="ml-1">{{ abs($stats['active_rentals']['evolution']) }}%</span>
                    </span>
                        @else
                            <span class="text-gray-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                        </svg>
                        <span class="ml-1">0%</span>
                    </span>
                        @endif
                        <span class="ml-2 text-xs text-gray-500">{{ $stats['active_rentals']['period'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Fleet Utilization Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Taux d'occupation</p>
                            <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $stats['occupation_rate']['value'] }}%</p>
                        </div>
                        <div class="h-12 w-12 bg-green-50 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a2 2 0 01-2 2H9m11-3a2 2 0 01-2 2h-1" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center mt-4">
                        @if($stats['occupation_rate']['evolution'] > 0)
                            <span class="text-green-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        <span class="ml-1">{{ $stats['occupation_rate']['evolution'] }}%</span>
                    </span>
                        @elseif($stats['occupation_rate']['evolution'] < 0)
                            <span class="text-red-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        <span class="ml-1">{{ abs($stats['occupation_rate']['evolution']) }}%</span>
                    </span>
                        @else
                            <span class="text-gray-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                        </svg>
                        <span class="ml-1">0%</span>
                    </span>
                        @endif
                        <span class="ml-2 text-xs text-gray-500">{{ $stats['occupation_rate']['period'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Vehicles Needing Maintenance Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Véhicules en maintenance</p>
                            <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $stats['maintenance_vehicles']['value'] }}</p>
                        </div>
                        <div class="h-12 w-12 bg-amber-50 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center mt-4">
                        @if($stats['maintenance_vehicles']['evolution'] > 0)
                            <span class="text-red-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        <span class="ml-1">{{ $stats['maintenance_vehicles']['evolution'] }}%</span>
                    </span>
                        @elseif($stats['maintenance_vehicles']['evolution'] < 0)
                            <span class="text-green-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        <span class="ml-1">{{ abs($stats['maintenance_vehicles']['evolution']) }}%</span>
                    </span>
                        @else
                            <span class="text-gray-500 flex items-center text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                        </svg>
                        <span class="ml-1">0%</span>
                    </span>
                        @endif
                        <span class="ml-2 text-xs text-gray-500">{{ $stats['maintenance_vehicles']['period'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Revenue Chart (2/3 width) -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Revenus mensuels</h3>
                </div>
                <div class="p-6">
                    <div id="revenueChart" class="h-80"></div>
                </div>
            </div>

            <!-- Amount to Recover Card (1/3 width) -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Montants à recouvrer</h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-5">
                        <div>
                            <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['amount_to_recover']['value'], 0, ',', ' ') }} FCFA</p>
                            <p class="mt-1 text-sm text-gray-500">Montant total à recouvrer</p>
                        </div>
                        <div class="h-16 w-16 bg-red-50 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Récupération progress -->
                    <div class="mt-8">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-medium text-gray-700">En attente</span>
                            <span class="text-sm font-medium text-gray-700">100%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-red-600 h-2 rounded-full" style="width: 100%"></div>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Aucun recouvrement effectué</p>
                    </div>

                    <div class="mt-8">
                        <a href="{{  route('recouvrements.index') }}" class="block w-full text-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Gérer les recouvrements
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grid Layout for Bottom Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Rentals (2/3 width) -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Locations récentes</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Véhicule</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Période</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($recentRentals as $rental)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $rental['id'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $rental['client'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $rental['vehicle'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $rental['start_date'] }} - {{ $rental['end_date'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($rental['amount'], 0, ',', ' ') }} FCFA</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($rental['status'] == 'En cours')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $rental['status'] }}
                                </span>
                                    @elseif($rental['status'] == 'Terminée')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $rental['status'] }}
                                </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    {{ $rental['status'] }}
                                </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-200">
                    <a href="{{ route('backend.booking.list') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Voir toutes les locations &rarr;</a>
                </div>
            </div>

            <!-- Customer Distribution + Fleet Info (1/3 width) -->
            <div class="space-y-6">
                <!-- Customer Distribution Card -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Répartition des clients</h3>
                    </div>
                    <div class="p-6">
                        <div id="customerDistribution" class="h-64"></div>
                        <div class="mt-4 space-y-2">
                            @foreach($customerTypes as $type)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="h-3 w-3 rounded-full {{ $loop->first ? 'bg-indigo-500' : 'bg-blue-400' }} mr-2"></div>
                                        <span class="text-sm text-gray-600">{{ $type['type'] }}</span>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">{{ $type['count'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Fleet Info Card -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Informations sur la flotte</h3>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-medium text-gray-500">Total des véhicules</span>
                            <span class="text-lg font-semibold text-gray-900">{{ $fleetInfo['total'] }}</span>
                        </div>
                        <div class="space-y-4">
                            <!-- Par catégorie -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-2">Par catégorie</h4>
                                <div class="space-y-2">
                                    @foreach($fleetInfo['by_category'] as $category)
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">{{ $category->name }}</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $category->count }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Par marque -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-2">Par marque</h4>
                                <div class="space-y-2">
                                    @foreach($fleetInfo['by_brand'] as $brand)
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">{{ $brand->name }}</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $brand->count }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Par type de carburant -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-2">Par carburant</h4>
                                <div class="space-y-2">
                                    @foreach($fleetInfo['by_fuel'] as $fuel)
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">{{ ucfirst($fuel->type_carburant) }}</span>
                                            <span class="text-sm font-medium text-gray-900">{{ $fuel->count }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End::row-2 -->
@endsection

@push('scripts')
    <script src="../assets/js/custom.js"></script>
    <script src="{{ asset('back/js/apexcharts.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Revenue Chart
            const revenueChartOptions = {
                series: [{
                    name: 'Revenus',
                    data: [
                        @foreach($monthlyRevenue as $item)
                            {{ $item['amount'] }},
                        @endforeach
                    ]
                }],
                chart: {
                    type: 'bar',
                    height: 320,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        columnWidth: '60%',
                    }
                },
                dataLabels: {
                    enabled: false
                },
                colors: ['#4F46E5'],
                xaxis: {
                    categories: [
                        @foreach($monthlyRevenue as $item)
                            '{{ $item['month'] }}',
                        @endforeach
                    ],
                    labels: {
                        style: {
                            colors: '#6B7280',
                            fontSize: '12px',
                            fontFamily: 'Inter, sans-serif',
                        }
                    },
                    axisBorder: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            return value.toLocaleString() + ' FCFA';
                        },
                        style: {
                            colors: '#6B7280',
                            fontSize: '12px',
                            fontFamily: 'Inter, sans-serif',
                        }
                    }
                },
                grid: {
                    borderColor: '#E5E7EB',
                    strokeDashArray: 4,
                    xaxis: {
                        lines: {
                            show: false
                        }
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(value) {
                            return value.toLocaleString() + ' FCFA';
                        }
                    }
                }
            };

            const revenueChart = new ApexCharts(document.querySelector("#revenueChart"), revenueChartOptions);
            revenueChart.render();

            // Customer Distribution Chart
            const customerDistributionOptions = {
                series: [
                    @foreach($customerTypes as $type)
                        {{ $type['percentage'] }},
                    @endforeach
                ],
                chart: {
                    type: 'donut',
                    height: 250,
                },
                labels: [
                    @foreach($customerTypes as $type)
                        '{{ $type['type'] }}',
                    @endforeach
                ],
                colors: ['#4F46E5', '#60A5FA'],
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    fontSize: '16px',
                                    fontFamily: 'Inter, sans-serif',
                                    color: '#1F2937',
                                    offsetY: -10
                                },
                                value: {
                                    show: true,
                                    fontSize: '24px',
                                    fontFamily: 'Inter, sans-serif',
                                    color: '#1F2937',
                                    formatter: function (val) {
                                        return val + '%';
                                    }
                                },
                                total: {
                                    show: true,
                                    label: 'Total',
                                    fontSize: '16px',
                                    fontFamily: 'Inter, sans-serif',
                                    color: '#6B7280',
                                    formatter: function (w) {
                                        return '{{ array_sum(array_column($customerTypes, 'count')) }}';
                                    }
                                }
                            }
                        }
                    }
                }
            };

            const customerDistributionChart = new ApexCharts(document.querySelector("#customerDistribution"), customerDistributionOptions);
            customerDistributionChart.render();

            // Export functionality
            document.getElementById('exportStats').addEventListener('click', function() {
                // In a real application, this would trigger an AJAX request to download a report
                alert('Exportation des statistiques en cours...');
            });

            // Date filter functionality
            document.getElementById('dateFilter').addEventListener('change', function() {
                // In a real application, this would trigger an AJAX request to update the stats
                alert('Changement de période : ' + this.options[this.selectedIndex].text);
            });
        });
    </script>
@endpush
