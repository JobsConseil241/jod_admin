@extends('layouts.back')

@push('styles')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css" />
@endpush

@inject('Lang', 'App\Services\LanguageService')

@section('content')
    <!-- Page Header -->
    <div class="block justify-between page-header md:flex">
        <div>
            <h3 class="text-gray-700 hover:text-gray-900 dark:text-white dark:hover:text-white text-2xl font-medium">
                Types d'Utilisateurs</h3>
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
                Types d'Utilisateurs
            </li>
        </ol>
    </div>
    <!-- Page Header Close -->

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="box-header">
                    <h5 class="box-title">Liste des Types</h5>
                </div>
                <div class="box-body">
                    <table id="data" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">ID</th>
                                <th>Nom</th>
                                <th>Description</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($types as $type)
                                <tr>
                                    <td>{{ $type->id }}</td>
                                    <td>{{ $type->name }}</td>
                                    <td>{{ $type->description }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!--datatable js-->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

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
