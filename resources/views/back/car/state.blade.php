@extends('layouts.back')

@push('styles')
@endpush

@inject('Lang', 'App\Services\LanguageService')

@section('content')
    <!-- Page Header -->
    <div class="block justify-between page-header md:flex">
        <div>
            <h3 class="text-gray-700 hover:text-gray-900 dark:text-white dark:hover:text-white text-2xl font-medium">
                État de <a href="{{ url('backend/car/view/' . $car->id) }}">{{ $car->name }}</a> </h3>
        </div>
        <ol class="flex items-center whitespace-nowrap min-w-0">
            <li class="text-sm">
                <a class="flex items-center font-semibold text-primary hover:text-primary dark:text-primary truncate"
                    href="{{ route('dashboard') }}">
                    Tableau de Bord
                    <i
                        class="ti ti-chevrons-right flex-shrink-0 mx-3 overflow-visible text-gray-300 dark:text-gray-300 rtl:rotate-180"></i>
                </a>
            </li>
            <li class="text-sm text-gray-500 hover:text-primary dark:text-white/70 " aria-current="page">
                <a href="{{ url('backend/car/view/' . $car->id) }}">{{ $car->name }}</a>
            </li>
        </ol>
    </div>
    <!-- Page Header Close -->

    @include('layouts.alert')

    <!-- Start::row-1 -->
    <div class="grid grid-cols-12 gap-x-6">
        <div class="col-span-12">
            <div class="box !bg-transparent border-0 shadow-none">
                <form method="post" action="{{ url('backend/car/etat/' . $car->id) }}">
                    @csrf
                    <div class="box-body p-0">
                        <div class="grid grid-cols-12 gap-x-6">
                            @foreach ([
            'kilometrage' => ['label' => 'Kilométrage', 'type' => 'integer'],
            'proprete_int' => ['label' => 'Propreté intérieure', 'type' => 'integer', 'max' => 10, 'text'=> 'Valeur Entre (0 - 10)'],
            'propreter_exte' => ['label' => 'Propreté extérieure', 'type' => 'integer', 'max' => 10, 'text'=> 'Valeur Entre (0 - 10)'],
            'carburant' => ['label' => 'Carburant', 'type' => 'integer'],
            'cle_vehicule' => ['label' => 'Clé du véhicule', 'type' => 'boolean'],
            'carte_grise' => ['label' => 'Carte grise', 'type' => 'boolean'],
            'carte_assurance' => ['label' => 'Carte d\'assurance', 'type' => 'boolean'],
            'carte_viste_technique' => ['label' => 'Carte de visite technique', 'type' => 'boolean'],
            'carte_extincteur' => ['label' => 'Carte extincteur', 'type' => 'boolean'],
            'triangle_signalisation' => ['label' => 'Triangle de signalisation', 'type' => 'boolean'],
            'extincteur' => ['label' => 'Extincteur', 'type' => 'boolean'],
            'trousse_secours' => ['label' => 'Trousse de secours', 'type' => 'boolean'],
            'gilet' => ['label' => 'Gilet', 'type' => 'boolean'],
            'cric_manivelle' => ['label' => 'Cric et manivelle', 'type' => 'boolean'],
            'cle_a_roue' => ['label' => 'Clé à roue', 'type' => 'boolean'],
            'cales_metalliques' => ['label' => 'Cales métalliques', 'type' => 'boolean'],
            'cle_plate' => ['label' => 'Clé plate', 'type' => 'boolean'],
            'anneau_remorquage' => ['label' => 'Anneau de remorquage', 'type' => 'boolean'],
            'tournevis' => ['label' => 'Tournevis', 'type' => 'boolean'],
            'compresseur' => ['label' => 'Compresseur', 'type' => 'boolean'],
            'roue_secours' => ['label' => 'Roue de secours', 'type' => 'boolean'],
            'etat_general' => ['label' => 'État général', 'type' => 'boolean'],
            'date' => ['label' => 'Date', 'type' => 'date'],
        ] as $field => $meta)
                                <div class="col-span-6 xl:col-span-3">
                                    <div class="box">
                                        <div class="box-body">
                                            <div class="space-y-3">
                                                <div class="space-y-2">
                                                    @if ($meta['type'] === 'integer')
                                                        <!-- Input number -->
                                                        <label class="ti-form-label"
                                                            for="input-{{ $field }}">{{ $meta['label'] }} <span class="text-sm text-danger">@if($meta['text']) max="{{$meta['text']}}" @endif</span></label>
                                                        <input type="number" id="input-{{ $field }}"
                                                            name="{{ $field }}"
                                                            value="{{ old($field, $car->etats[0]->{$field} ?? '') }}" min="0" @if($meta['max']) max="{{$meta['max']}}" @endif
                                                            class="block w-full border border-gray-200 focus:shadow-sm dark:focus:shadow-white/10 rounded-sm text-sm focus:z-10 focus:outline-0 focus:border-gray-200 dark:focus:border-white/10 dark:border-white/10 dark:text-white/70">
                                                    @elseif ($meta['type'] === 'boolean')
                                                        <!-- Switch -->
                                                        <div class="flex items-center">
                                                            <input type="checkbox" id="input-{{ $field }}"
                                                                name="{{ $field }}"
                                                                value="{{ old($field, $car->etats[0]->{$field} ?? '') }}"
                                                                class="ti-switch shrink-0">
                                                            <label for="input-{{ $field }}"
                                                                class="text-sm text-gray-500 ltr:ml-3 rtl:mr-3 dark:text-white/70">{{ $meta['label'] }}</label>
                                                        </div>
                                                    @elseif ($meta['type'] === 'date')
                                                        <!-- Input date -->
                                                        <label class="ti-form-label"
                                                            for="input-{{ $field }}">{{ $meta['label'] }}</label>
                                                        <input type="date" id="input-{{ $field }}"
                                                            name="{{ $field }}"
                                                            oninput="this.value = this.value || new Date().toISOString().split('T')[0]"
                                                            value="{{ old($field, $car->etats[0]->{$field} ?? '2024-02-19') }}"
                                                            class="block w-full border border-gray-200 focus:shadow-sm dark:focus:shadow-white/10 rounded-sm text-sm focus:z-10 focus:outline-0 focus:border-gray-200 dark:focus:border-white/10 dark:border-white/10 dark:text-white/70">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="box-footer text-end border-t-0 px-0">
                        <button type="submit" class="ti-btn ti-btn-primary"><i class="ri-add-line"></i>Enregistrer</button>

                        <button type="button" data-hs-overlay="#cardModalDelete" class="ti-btn ti-btn-danger"><i
                                class="ri-delete-bin-line"></i>Supprimer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End::row-1 -->

    <div id="cardModalDelete" class="hs-overlay ti-modal hidden">
        <div class="ti-modal-box">
            <div class="ti-modal-content">
                <div class="ti-modal-header">
                    <h3 class="ti-modal-title">
                        Supprimer l'état
                    </h3>
                    <button type="button" class="hs-dropdown-toggle ti-modal-clode-btn" data-hs-overlay="#cardModalDelete">
                        <span class="sr-only">Fermer</span>
                        <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                fill="currentColor" />
                        </svg>
                    </button>
                </div>
                <div class="ti-modal-body">
                    <p class="mt-1 text-gray-800 dark:text-white/70">
                        Êtes-vous sûr de vouloir supprimer l'état du véhicule : {{ $car->name }} ?
                    </p>
                </div>
                <div class="ti-modal-footer">
                    <form action="{{ url('backend/car/etat/' . $car->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="delete" value="true" />
                        <button type="button"
                            class="hs-dropdown-toggle ti-btn ti-border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:ring-offset-white focus:ring-primary dark:bg-bgdark dark:hover:bg-black/20 dark:border-white/10 dark:text-white/70 dark:hover:text-white dark:focus:ring-offset-white/10"
                            data-hs-overlay="#cardModalView">
                            Fermer
                        </button>
                        <button type="submit" class="ti-btn ti-btn-danger">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('back/js/custom.js') }}"></script>
@endpush
