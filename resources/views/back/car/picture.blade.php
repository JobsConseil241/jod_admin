@extends('layouts.back')

@push('styles')
    <!--datatable css-->
@endpush

@inject('Lang', 'App\Services\LanguageService')

@section('content')
    <!-- Page Header -->
    <div class="block justify-between page-header md:flex">
        <div>
            <h3 class="text-gray-700 hover:text-gray-900 dark:text-white dark:hover:text-white text-2xl font-medium">
                Images de <a href="{{ url('backend/car/view/' . $car->id) }}">{{ $car->name }}</a></h3>
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
                <form method="post" action="{{ url('backend/car/picture/' . $car->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body p-0">
                        <div class="grid grid-cols-12 gap-x-6">
                            @foreach ([
            'photo_avant' => 'Photo Avant',
            'photo_arriere' => 'Photo Arrière',
            'photo_gauche' => 'Photo Gauche',
            'photo_droite' => 'Photo Droite',
            'photo_dashboard' => 'Photo Tableau de Bord',
            'photo_interieur' => 'Photo Intérieur',
        ] as $field => $label)
                                <div class="col-span-6 xl:col-span-3">
                                    <div class="box ">
                                        <div class="box-body">
                                            <div class="space-y-3">
                                                <div class="space-y-2">
                                                    <label class="flex justify-between ti-form-label">
                                                        <span class="my-auto">{{ $label }}</span>
                                                    </label>
                                                    <input type="file"
                                                        class="block w-full border border-gray-200 focus:shadow-sm dark:focus:shadow-white/10 rounded-sm text-sm focus:z-10 focus:outline-0 focus:border-gray-200 dark:focus:border-white/10 dark:border-white/10 dark:text-white/70
                              file:bg-transparent file:border-0
                              file:bg-gray-100 ltr:file:mr-4 rtl:file:ml-4
                              file:py-2 file:px-4
                              dark:file:bg-black/20 dark:file:text-white/70"
                                                        name="{{ $field }}" accept="image/*" data-max-file-size="2MB"
                                                        data-current-url="{{ $car->vehicule_medias[0]->{$field} ? asset($car->vehicule_medias[0]->{$field}) : '' }}">

                                                    <!-- Conteneur de prévisualisation -->
                                                    <div id="preview-{{ $field }}" class="preview-container mt-3">
                                                        @if ($car->vehicule_medias[0]->{$field})
                                                            <img src="{{ asset($car->vehicule_medias[0]->{$field}) }}"
                                                                alt="{{ $label }}" class="max-h-32 rounded shadow">
                                                        @endif
                                                    </div>
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
                        <button type="reset" class="ti-btn ti-btn-danger"><i
                                class="ri-delete-bin-line"></i>Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End::row-1 -->
@endsection

@push('scripts')
    <!-- Choices JS -->
    <script src="{{ asset('back/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    <script>
        "use strict";

        document.addEventListener('DOMContentLoaded', function() {
            // Gestion des prévisualisations
            document.querySelectorAll('input[type="file"]').forEach(function(input) {
                input.addEventListener('change', function(event) {
                    const file = event.target.files[0]; // Récupérer le fichier sélectionné
                    const previewContainer = document.querySelector(
                        `#preview-${event.target.name}`); // Conteneur de prévisualisation

                    // Réinitialiser le conteneur
                    previewContainer.innerHTML = '';

                    // Validation de la taille du fichier
                    if (file && file.size > 2 * 1024 * 1024) {
                        alert('Le fichier ne doit pas dépasser 2 Mo.');
                        input.value = ''; // Réinitialiser le champ fichier
                        return;
                    }

                    // Validation du type de fichier
                    if (file && !file.type.startsWith('image/')) {
                        alert('Veuillez sélectionner un fichier image.');
                        input.value = ''; // Réinitialiser le champ fichier
                        return;
                    }

                    // Prévisualisation de l'image
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.alt = 'Prévisualisation';
                            img.style.maxWidth = '100%';
                            img.style.maxHeight = '150px';
                            previewContainer.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        });
    </script>
@endpush
