@extends('layouts.back')

@push('styles')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.tailwindcss.css" />

    <style>
        .col-start-2 {
            grid-column-start: 3 !important;
        }
    </style>
@endpush

@inject('Lang', 'App\Services\LanguageService')

@section('content')
    <!-- Page Header -->
    <div class="block justify-between page-header md:flex">
        <div>
            <h3 class="text-gray-700 hover:text-gray-900 dark:text-white dark:hover:text-white text-2xl font-medium">
                Pannes ({{ $car['name'] }})</h3>
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
                <a class="flex items-center font-semibold text-primary hover:text-primary dark:text-primary truncate"
                   href="{{ route('backend.view.car', $car['id']) }}">
                    {{ $car['name'] }}<i
                        class="ti ti-chevrons-right flex-shrink-0 mx-3 overflow-visible text-gray-300 dark:text-gray-300 rtl:rotate-180"></i>
                </a>
            </li>
            <li class="text-sm text-gray-500 hover:text-primary dark:text-white/70 " aria-current="page">
                Pannes
            </li>
        </ol>
    </div>
    <!-- Page Header Close -->

    @include('layouts.alert')

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="box-header">
                    <h5 class="box-title">Liste des Pannes</h5>
                    <div class="flex justify-end">
                        <button type="button" class="hs-dropdown-toggle ti-btn ti-btn-primary"
                            data-hs-overlay="#hs-basic-modal">
                            Ajouter une panne
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <table id="data" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">ID</th>
                                <th>Catégorie</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Montant</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           @php
                               $index = 0;
                           @endphp


                            @foreach ($car['pannes'] as $panne)
                                @php
                                    ++ $index;
                                @endphp
                                <tr>
                                    <td>{{ $panne['id'] }}</td>
                                    <td>{{ $panne['categorie']['name'] }}</td>
                                    <td class="font-bold">{{ $panne['name'] }}</td>
                                    <td>{{ Str::limit($panne['description'], 100, '...') }}</td>
                                    <td>{{ $panne['pivot']['montant'] }}</td>
                                    <td>
                                        @switch($panne['pivot']['status'])
                                            @case('TERMINE')
                                                <span class="text-success">{{$panne['pivot']['status']}}</span>
                                            @break
                                            @case('ABANDONNE')
                                                <span class="text-danger">{{$panne['pivot']['status']}}</span>
                                            @break
                                            @default
                                                <span class="text-warning">{{$panne['pivot']['status']}}</span>
                                         @endswitch
                                    </td>
                                    <td>
                                        <button type="button" class="ti-btn ti-btn-soft-primary"
                                            data-hs-overlay="#cardModalView{{ $panne['id'] }}">
                                            <i class="ri-pencil-fill align-bottom me-2"></i> Modifier
                                        </button>

                                        <button type="button" class="ti-btn ti-btn-soft-danger"
                                            data-hs-overlay="#cardModalDelete{{ $panne['id'] }}">
                                            <i class="ri-delete-bin-fill align-bottom me-2"></i> Supprimer
                                        </button>
                                    </td>
                                </tr>

                                <div id="cardModalView{{ $panne['id'] }}" class="hs-overlay ti-modal hidden">
                                    <div class="ti-modal-box">
                                        <div class="ti-modal-content">
                                            <form action="{{ url('backend/car/pannes/' . $car['id'].'/assign_update') }}" method="POST">
                                                @csrf
                                                <div class="ti-modal-header">
                                                    <h3 class="ti-modal-title">
                                                        Modifier Le statut de la panne : {{ $panne['name'] }}
                                                    </h3>
                                                    <button type="button" class="hs-dropdown-toggle ti-modal-clode-btn"
                                                            data-hs-overlay="#cardModalView{{ $panne['id'] }}">
                                                        <span class="sr-only">Close</span>
                                                        <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="ti-modal-body">

                                                    <div class="mb-3">
                                                        <label class="ti-form-label mb-0">Panne Associée</label>
                                                        <select name="ids_pannes[]" class="ti-form-select" required>
                                                            <option>--- Choisissez la panne ---</option>
                                                            @foreach ($pannes as $item)
                                                                <option value="{{ $item['id'] }}"
                                                                    {{ $panne['name'] == $item['name'] ? 'selected' : '' }}>
                                                                    {{ $item['name'] }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" name="id_vehicule" value="{{$car['id']}}">
                                                        <input type="hidden" name="id_panne" value="{{$index}}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="ti-form-label">Statut</label>
                                                        <select class="ti-form-select" name="status" autocomplete="off">
                                                            {{--                                <option value="initie">--}}
                                                            {{--                                    Initie--}}
                                                            {{--                                </option>--}}
                                                            <option value="EN COURS" {{ $panne['pivot']['status'] == 'EN COURS' ? 'selected' : '' }}>
                                                                En cours
                                                            </option>
                                                            <option value="TERMINE" {{ $panne['pivot']['status'] == 'TERMINE' ? 'selected' : '' }}>
                                                                Traité
                                                            </option>
                                                            <option value="ABANDONNE" {{ $panne['pivot']['status'] == 'ABANDONNE' ? 'selected' : '' }}>
                                                                Abandonnée
                                                            </option>
                                                        </select>
                                                    </div>


                                                    <div class="mb-3">
                                                        <label class="ti-form-label">Montant</label>
                                                        <input type="number" name="montant" class="ti-form-input" min="0" value="{{$panne['pivot']['montant']}}">
                                                    </div>
                                                </div>
                                                <div class="ti-modal-footer">
                                                    <button type="button"
                                                            class="hs-dropdown-toggle ti-btn ti-border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:ring-offset-white focus:ring-primary dark:bg-bgdark dark:hover:bg-black/20 dark:border-white/10 dark:text-white/70 dark:hover:text-white dark:focus:ring-offset-white/10"
                                                            data-hs-overlay="#cardModalView{{ $panne['id'] }}">
                                                        Annuler
                                                    </button>
                                                    <button class="ti-btn ti-btn-primary" type="submit">
                                                        Enregistrer
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div id="cardModalDelete{{ $panne['id'] }}" class="hs-overlay ti-modal hidden">
                                    <div class="ti-modal-box">
                                        <div class="ti-modal-content">
                                            <div class="ti-modal-header">
                                                <h3 class="ti-modal-title">
                                                    Supprimer une Panne associé à {{ $car['name'] }}
                                                </h3>
                                                <button type="button" class="hs-dropdown-toggle ti-modal-clode-btn"
                                                        data-hs-overlay="#cardModalDelete{{ $panne['id'] }}">
                                                    <span class="sr-only">Close</span>
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
                                                    Êtes-vous sûr de vouloir supprimer cette panne : {{ $panne['name'] }} ?
                                                </p>
                                            </div>
                                            <div class="ti-modal-footer">
                                                <form action="{{ url('backend/car/pannes/' . $car['id'].'/delete_update') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="delete" value="true" />
                                                    <button type="button"
                                                            class="hs-dropdown-toggle ti-btn ti-border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:ring-offset-white focus:ring-primary dark:bg-bgdark dark:hover:bg-black/20 dark:border-white/10 dark:text-white/70 dark:hover:text-white dark:focus:ring-offset-white/10"
                                                            data-hs-overlay="cardModalDelete{{ $panne['id'] }}">
                                                        Fermer
                                                    </button>
                                                    <button type="submit" class="ti-btn ti-btn-danger" data-hs-overlay="cardModalDelete{{ $panne['id'] }}">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="cardModalView" class="hs-overlay ti-modal hidden">
        <div class="ti-modal-box">
            <div class="ti-modal-content">
                <form action="{{ url('backend/car/pannes/'.$car['id'].'/assign') }}" method="POST">
                    @csrf
                    <div class="ti-modal-header">
                        <h3 class="ti-modal-title">
                            Ajouter une panne
                        </h3>
                        <button type="button" class="hs-dropdown-toggle ti-modal-clode-btn"
                            data-hs-overlay="#hs-basic-modal">
                            <span class="sr-only">Close</span>
                            <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                    fill="currentColor"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="ti-modal-body">

                        <div class="mb-3">
                            <label class="ti-form-label mb-0">Panne associe</label>
                            <select name="ids_pannes[]" class="ti-form-select" required>
                                <option>--- Choisissez la panne ---</option>
                                @foreach ($pannes as $item)
                                    <option value="{{ $item['id'] }}"
                                        {{ old('panne_id') == $item['id'] ? 'selected' : '' }}>
                                        {{ $item['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="id_vehicule" value="{{$car['id']}}">
                        </div>

                        <div class="mb-3">
                            <label class="ti-form-label">Statut</label>
                            <select class="ti-form-select" name="status" autocomplete="off">
{{--                                <option value="initie">--}}
{{--                                    Initie--}}
{{--                                </option>--}}
                                <option value="EN COURS">
                                    En cours
                                </option>
                                <option value="TERMINE">
                                    Traité
                                </option>
                                <option value="ABANDONNE">
                                    Abandonnée
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="ti-form-label">Montant</label>
                            <input type="number" name="montant" class="ti-form-input" min="0" value="0">
                        </div>
                    </div>
                    <div class="ti-modal-footer">
                        <button type="button"
                            class="hs-dropdown-toggle ti-btn ti-border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:ring-offset-white focus:ring-primary dark:bg-bgdark dark:hover:bg-black/20 dark:border-white/10 dark:text-white/70 dark:hover:text-white dark:focus:ring-offset-white/10"
                            data-hs-overlay="#hs-basic-modal">
                            Annuler
                        </button>
                        <button class="ti-btn ti-btn-primary" type="submit">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

{{--    @foreach ($pannes as $panne)--}}
{{--        <div id="cardModalView{{ $panne->id }}" class="hs-overlay ti-modal hidden">--}}
{{--            <div class="ti-modal-box">--}}
{{--                <div class="ti-modal-content">--}}
{{--                    <form action="{{ url('backend/panne/update/' . $panne->id) }}" method="POST">--}}
{{--                        @csrf--}}
{{--                        <div class="ti-modal-header">--}}
{{--                            <h3 class="ti-modal-title">--}}
{{--                                Modifier une panne : {{ $panne->name }}--}}
{{--                            </h3>--}}
{{--                            <button type="button" class="hs-dropdown-toggle ti-modal-clode-btn"--}}
{{--                                data-hs-overlay="#cardModalView{{ $panne->id }}">--}}
{{--                                <span class="sr-only">Close</span>--}}
{{--                                <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"--}}
{{--                                    xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path--}}
{{--                                        d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"--}}
{{--                                        fill="currentColor"></path>--}}
{{--                                </svg>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        <div class="ti-modal-body">--}}

{{--                            <div class="mb-3">--}}
{{--                                <label class="ti-form-label mb-0">Catégorie</label>--}}
{{--                                <select name="category_id" class="ti-form-select" required>--}}
{{--                                    <option>Choisissez</option>--}}
{{--                                    @foreach ($categories as $item)--}}
{{--                                        <option value="{{ $item->id }}"--}}
{{--                                            {{ $panne->category_panne_id == $item->id ? 'selected' : '' }}>--}}
{{--                                            {{ $item->name }}--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}

{{--                            <div class="mb-3">--}}
{{--                                <label for="input-label" class="ti-form-label">Nom</label>--}}
{{--                                <input type="text" name="name" value="{{ $panne->name }}" id="input-label"--}}
{{--                                    class="ti-form-input">--}}
{{--                            </div>--}}

{{--                            <div class="mb-3">--}}
{{--                                <label for="input-description" class="ti-form-label">Description</label>--}}
{{--                                <textarea class="ti-form-input" rows="3" name="description">{{ $panne->description }}</textarea>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="ti-modal-footer">--}}
{{--                            <button type="button"--}}
{{--                                class="hs-dropdown-toggle ti-btn ti-border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:ring-offset-white focus:ring-primary dark:bg-bgdark dark:hover:bg-black/20 dark:border-white/10 dark:text-white/70 dark:hover:text-white dark:focus:ring-offset-white/10"--}}
{{--                                data-hs-overlay="#cardModalView{{ $panne->id }}">--}}
{{--                                Annuler--}}
{{--                            </button>--}}
{{--                            <button class="ti-btn ti-btn-primary" type="submit">--}}
{{--                                Enregistrer--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div id="cardModalDelete{{ $panne->id }}" class="hs-overlay ti-modal hidden">--}}
{{--            <div class="ti-modal-box">--}}
{{--                <div class="ti-modal-content">--}}
{{--                    <div class="ti-modal-header">--}}
{{--                        <h3 class="ti-modal-title">--}}
{{--                            Supprimer une catégorie--}}
{{--                        </h3>--}}
{{--                        <button type="button" class="hs-dropdown-toggle ti-modal-clode-btn"--}}
{{--                            data-hs-overlay="#cardModalDelete{{ $panne->id }}">--}}
{{--                            <span class="sr-only">Close</span>--}}
{{--                            <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"--}}
{{--                                xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path--}}
{{--                                    d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"--}}
{{--                                    fill="currentColor" />--}}
{{--                            </svg>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="ti-modal-body">--}}
{{--                        <p class="mt-1 text-gray-800 dark:text-white/70">--}}
{{--                            Êtes-vous sûr de vouloir supprimer cette panne : {{ $panne->name }} ?--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <div class="ti-modal-footer">--}}
{{--                        <form action="{{ url('backend/panne/update/' . $panne->id) }}" method="POST">--}}
{{--                            @csrf--}}
{{--                            <input type="hidden" name="delete" value="true" />--}}
{{--                            <button type="button"--}}
{{--                                class="hs-dropdown-toggle ti-btn ti-border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:ring-offset-white focus:ring-primary dark:bg-bgdark dark:hover:bg-black/20 dark:border-white/10 dark:text-white/70 dark:hover:text-white dark:focus:ring-offset-white/10"--}}
{{--                                data-hs-overlay="#cardModalView">--}}
{{--                                Fermer--}}
{{--                            </button>--}}
{{--                            <button type="submit" class="ti-btn ti-btn-danger">--}}
{{--                                Supprimer--}}
{{--                            </button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endforeach--}}
@endsection

@push('scripts')
    <<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.tailwindcss.js"></script>

    <script>
        $(document).ready(function() {
            $("#data").DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
                },
                order: [
                    [0, 'desc']
                ],
                searching: true
            })
        });

        $(document).on("click", ".edit_action", function() {
            var id = $(this).data('id');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('backend.edit.role') }}",
                dataType: 'json',
                data: {
                    "id": id,
                    "action": "edit",
                },
                success: function(data) {
                    //get data value params
                    var body = data.body;
                    //dynamic title
                    $('#cardModalView .ti-modal-content').html(body); //url to delete item
                    $('#cardModalView').removeClass('hidden').addClass('open');
                }
            });
        });

        $(document).on("click", ".delete_action", function() {
            var id = $(this).data('id');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('backend.edit.role') }}",
                dataType: 'json',
                data: {
                    "id": id,
                    "action": "delete",
                },
                success: function(data) {
                    //get data value params
                    var body = data.body;
                    //dynamic title
                    $('#cardModalView .ti-modal-content').html(body); //url to delete item
                    $('#cardModalView').removeClass('hidden').addClass('open');
                }
            });
        });

        $(document).on("click", "#cardModalView", function(e) {
            if ($(e.target).is('#cardModalView')) {
                $('#cardModalView').removeClass('open').addClass('hidden');
            }
        });
    </script>
@endpush
