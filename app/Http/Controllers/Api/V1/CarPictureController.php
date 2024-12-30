<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Vehicule;
use App\Models\VehiculeMedia;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CarPictureController extends BaseController
{
    public function add_Vehicule_Picture(Request $request)
    {

        try {
            Log::info('Add Vehicules Pictures  Endpoint Entered.');

            Log::debug('Add Vehicules Pictures Endpoint - All Params: ' . json_encode($request->all()));
            $datas = $request->all();
            $rules = [
                'vehicule_id' => 'required|exists:vehicules,id', // Assurez-vous que vehicule_id existe
                'photo_avant' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
                'photo_arriere' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
                'photo_gauche' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
                'photo_droite' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
                'photo_dashboard' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
                'photo_interieur' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }

            // Préparer les données à insérer ou mettre à jour
            $data = [
                'photo_avant' => $request->file('photo_avant') ? $this->uploadFile($request->file('photo_avant'), 'uploads/photos/vehicules') : null,
                'photo_arriere' => $request->file('photo_arriere') ? $this->uploadFile($request->file('photo_arriere'), 'uploads/photos/vehicules') : null,
                'photo_gauche' => $request->file('photo_gauche') ? $this->uploadFile($request->file('photo_gauche'), 'uploads/photos/vehicules') : null,
                'photo_droite' => $request->file('photo_droite') ? $this->uploadFile($request->file('photo_droite'), 'uploads/photos/vehicules') : null,
                'photo_dashboard' => $request->file('photo_dashboard') ? $this->uploadFile($request->file('photo_dashboard'), 'uploads/photos/vehicules') : null,
                'photo_interieur' => $request->file('photo_interieur') ? $this->uploadFile($request->file('photo_interieur'), 'uploads/photos/vehicules') : null,
            ];

            // Filtrer pour ne pas écraser les champs existants si les fichiers ne sont pas fournis
            $data = array_filter($data, fn($value) => $value !== null);

            // Utiliser updateOrCreate pour insérer ou mettre à jour
            $vehiculeMedia = VehiculeMedia::updateOrCreate(
                ['vehicule_id' => $request->vehicule_id], // Condition de recherche
                $data // Données à insérer ou mettre à jour
            );


            $data['carMedia'] = $vehiculeMedia;

            Log::debug('Add Vehicule Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($data, "Add Vehicule Pictures successfully");
        } catch (Exception $e) {
            Log::error('Add Vehicules Pictures Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Add Vehicules Pictures Endpoint Exited.');
        }
    }

    public function delete_single_Image(Request $request)
    {
        $datas = $request->all();
        $rules = [
            'image_field' => 'required|string|in:photo_avant,photo_arriere,photo_gauche,photo_droite,photo_dashboard,photo_interieur',
            'vehicule_id' => 'required|exists:vehicules,id',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->sendError($errors->first(), $errors);
        }

        // Trouver l'enregistrement correspondant au vehicule_id
        $vehiculeMedia = VehiculeMedia::where('vehicule_id', $request->vehicule_id)->first();

        if (!$vehiculeMedia) {
            return $this->sendError("Aucun média trouvé pour ce vehicule_id");
        }

        $imageField = $request->image_field;
        $imagePath = $vehiculeMedia->$imageField;

        // Vérifiez si l'image existe
        if (!$imagePath) {
            return $this->sendError("Aucune image trouvée pour ce champ.");
        }

        // Supprimer l'image du stockage
        $ptpt =  Storage::disk('public')->delete($imagePath);

        // Mettre à jour le champ dans la base de données
        $vehiculeMedia->$imageField = null;
        $vehiculeMedia->save();

        $data['carMedia'] = $vehiculeMedia;

        Log::debug('Delete Vehicule Picture Endpoint - Response: ' . json_encode($data));

        return $this->sendResponse($ptpt, "Delete Vehicule Picture successfully");
    }

    private function uploadFile($file, $destination)
    {
        // Chemin complet du répertoire
        $destinationPath = public_path($destination);

        // S'assurer que le répertoire existe
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true); // Crée le répertoire s'il n'existe pas
        }

        // Générer un nom unique pour le fichier
        $filename = uniqid() . '_' . $file->getClientOriginalName();

        // Déplacer le fichier vers le dossier public
        $file->move($destinationPath, $filename);

        // Retourner le chemin relatif
        return $destination . '/' . $filename;
    }
}
