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
                Privilèges</h3>
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
                Privilèges
            </li>
        </ol>
    </div>
    <!-- Page Header Close -->

    <!--begin::Container-->


    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="box-header">
                    <h5 class="box-title">Liste des Privilèges</h5>
                </div>
                <div class="box-body">
                    <table id="data" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">ID</th>
                                <th>Types d'Utilisateurs</th>
                                <th>Nom</th>
                                <th>Description</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($privileges as $privilege)
                                <tr>
                                    <td>{{ $privilege->id }}</td>
                                    <td>{{ $privilege->user_type->name }}</td>
                                    <td>{{ $privilege->name }}</td>
                                    <td>{{ $privilege->description }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--end::Container-->
@endsection

@push('scripts')
    <!--datatable js-->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.tailwindcss.js"></script>
    <script>
        $(document).ready(function() {
            $("#data").DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
                },
                searching: true
            })
        });
    </script>
@endpush
