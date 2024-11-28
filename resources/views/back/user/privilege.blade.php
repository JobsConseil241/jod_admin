@extends('layouts.back')

@push('styles')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.tailwindcss.css" />
@endpush

@inject('Lang', 'App\Services\LanguageService')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ $Lang->trans('privileges') }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $Lang->trans('management_user') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $Lang->trans('privileges') }}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!--begin::Container-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ $Lang->trans('list_privileges') }}</h5>
                </div>
                <div class="card-body">
                    <table id="data" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">{{ $Lang->trans('id') }}</th>
                                <th>{{ $Lang->trans('user_type') }}</th>
                                <th>{{ $Lang->trans('name') }}</th>
                                <th>{{ $Lang->trans('description') }}</th>

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
        </div><!--end col-->
    </div><!--end row-->
    <!--end::Container-->
@endsection

@push('scripts')
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
        }), document.addEventListener("DOMContentLoaded", function() {
            new DataTable("#fixed-header", {
                fixedHeader: !0
            })
        }), document.addEventListener("DOMContentLoaded", function() {
            new DataTable("#model-datatables", {
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function(e) {
                                e = e.data();
                                return "Details for " + e[0] + " " + e[1]
                            }
                        }),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                            tableClass: "table"
                        })
                    }
                }
            })
        }), document.addEventListener("DOMContentLoaded", function() {
            new DataTable("#buttons-datatables", {
                dom: "Bfrtip",
                buttons: ["copy", "csv", "excel", "print", "pdf"]
            })
        }), document.addEventListener("DOMContentLoaded", function() {
            new DataTable("#ajax-datatables", {
                ajax: "assets/json/datatable.json"
            })
        });
    </script>
@endpush
