<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\BaseController;
use App\Models\Location;
use App\Models\LocationPanne;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BookingController extends BaseController {

    public function registerBooking(Request $request) {
        try {
            Log::info('Add the reservation of a vehicule  Endpoint Entered.');

            Log::debug('Add Reservation Endpoint - All Params: ' . json_encode($request->all()));
            $datas = $request->all();
            $rules = [
                'date_heure_debut' => 'required|date|after_or_equal:today',
                'date_heure_fin' => 'required|date|after:date_heure_debut',
                'vehicule_id' => 'required|integer',
                'type_location' => 'required|string|in:courte,longue',
                'comission' => 'required|boolean',
                'etat_livraison_id' => 'required|integer',
                'livraison' => 'required|boolean',
                'client_id' => 'required|integer'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }

            $dateDebut = Carbon::parse($datas['date_heure_debut']);
            $dateFin = Carbon::parse($datas['date_heure_fin']);

            // Calculer la différence en jours
            $differenceEnJours = $dateDebut->diffInDays($dateFin);


            $location = Location::create([
                'code_contrat' => Location::generateUniqueCode(),
                'date_heure_debut' => $datas['date_heure_debut'],
                'date_heure_fin' => $datas['date_heure_fin'],
                'vehicule_id' => $datas['vehicule_id'],
                'type_location' => $datas['type_location'],
                'jours' => round($differenceEnJours),
                'statut' => 1,
                'comission' => $datas['comission'],
                'etat_livraison_id' => $datas['etat_livraison_id'],
                'livraison' => $datas['livraison'],
                'client_id' => $datas['client_id']
            ]);

            $data['location'] = $location;

            Log::debug('Add reservation Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($data, "Add Reservation successfully");
        } catch (Exception $e) {
            Log::error('Add Reservation Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Add Reservation Endpoint Exited.');
        }
    }

    public function updateBooking(Request $request) {
        try {
            Log::info('Edit Booking vehicules  Endpoint Entered.');

            Log::debug('Edit Booking Vehicules Endpoint - All Params: ' . json_encode($request->all()));
            $data = $request->all();
            $rules = [
                'date_heure_debut' => 'sometimes|date|after_or_equal:today',
                'date_heure_fin' => 'sometimes|date|after:date_heure_debut',
                'vehicule_id' => 'sometimes|integer',
                'type_location' => 'sometimes|string|in:courte,longue',
                'comission' => 'sometimes|boolean',
                'etat_livraison_id' => 'sometimes|integer',
                'livraison' => 'sometimes|boolean',
                'client_id' => 'sometimes|integer',
                'id' => 'required|integer'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }


            $category = Location::find($data['id']);

            if ($category == null) {
                return $this->sendError("Contrat de Location not found");
            }

            $category->update($data);
            Log::debug('Edit Contrat de Location Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($category, "Edit Contrat de Location successfully");
        } catch (Exception $e) {
            Log::error('Edit Contrat de location Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Edit Contrat de location Endpoint Exited.');
        }
    }

    public function cancelBooking(Request $request) {
        try {
            Log::info('Cancel Booking vehicules  Endpoint Entered.');

            Log::debug('Cancel Booking Vehicules Endpoint - All Params: ' . json_encode($request->all()));
            $data = $request->all();
            $rules = [
                'id' => 'required|integer'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }


            $category = Location::find($data['id']);

            if ($category == null) {
                return $this->sendError("Contrat de Location not found");
            }

            $category->statut = 2;
            $category->save();
            Log::debug('Cancel Booking Cars Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($category, "Cancel Booking successfully");
        } catch (Exception $e) {
            Log::error('Cancel Booking Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Cancel Booking Endpoint Exited.');
        }
    }

    public function validateBooking(Request $request) {
        try {
            Log::info('Validate Booking vehicules  Endpoint Entered.');

            Log::debug('Validate Booking Vehicules Endpoint - All Params: ' . json_encode($request->all()));
            $data = $request->all();
            $rules = [
                'id' => 'required|integer'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }


            $location = Location::find($data['id']);

            if ($location == null) {
                return $this->sendError("Contrat de Location not found");
            }

            $location->statut = 3;
            $location->save();
            Log::debug('Validate Booking Cars Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($location, "Validate Booking successfully");
        } catch (Exception $e) {
            Log::error('Validate Booking Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Validate Booking Endpoint Exited.');
        }
    }
    public function rejectBooking(Request $request) {
        try {
            Log::info('Reject Booking vehicules  Endpoint Entered.');

            Log::debug('Reject Booking Vehicules Endpoint - All Params: ' . json_encode($request->all()));
            $data = $request->all();
            $rules = [
                'id' => 'required|integer'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }


            $location = Location::find($data['id']);

            if ($location == null) {
                return $this->sendError("Contrat de Location not found");
            }

            $location->statut = 4;
            $location->save();
            Log::debug('Cancel Booking Cars Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($location, "Cancel Booking successfully");
        } catch (Exception $e) {
            Log::error('Cancel Booking Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Cancel Booking Endpoint Exited.');
        }
    }


    public function assign_pannes_locations(Request $request) {
        try {
            Log::info('Assign Pannes to Locations Endpoint Entered.');

            Log::debug('Assign Pannes to Locations Endpoint - All Params: ' . json_encode($request->all()));
            $data = $request->all();
            $rules = [
                'id_location' => ['required', 'integer'],
                'ids_pannes' => ['required', 'array'],
                'ids_pannes.*' => ['integer', 'exists:pannes,id'],
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }


            $category = Location::find($data['id_location']);

            if ($category == null) {
                return $this->sendError("Contrat not found");
            }

            $category->pannes()->attach($data['ids_pannes']);
            Log::debug('Add pannes to Location Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($category, "Add Panne successfully");
        } catch (Exception $e) {
            Log::error('Assign Pannes to Vehicules Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Assign Pannes to Locations Endpoint Exited.');
        }
    }

    public function update_pannes_locations(Request $request) {
        try {
            Log::info('Update Pannes to Locations Endpoint Entered.');

            Log::debug('Assign Pannes to Locations Endpoint - All Params: ' . json_encode($request->all()));
            $data = $request->all();
            $rules = [
                'id_panne' => ['required', 'integer'],
                'status' => ['sometimes', 'string'],
                'montant' => ['sometimes', 'integer']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }


            $category = LocationPanne::find($data['id_panne']);

            if ($category == null) {
                return $this->sendError("panne associate to location not found");
            }

            $vehiculePanne = LocationPanne::find($data['id_panne']);
            $vehiculePanne->status = $data['status'] ?? '';
            $vehiculePanne->montant = $data['montant'] ?? '';
            $vehiculePanne->save();

            Log::debug('update state pannes aasociate to locations Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($category, "Update successfully");
        } catch (Exception $e) {
            Log::error('Update Pannes to Locations Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Update Pannes to Locations Endpoint Exited.');
        }
    }

    public function delete_pannes_locations(Request $request) {
        try {
            Log::info('Delete Pannes to Locations Endpoint Entered.');

            Log::debug('Delete Pannes to Locations Endpoint - All Params: ' . json_encode($request->all()));
            $data = $request->all();
            $rules = [
                'id_panne' => ['required', 'integer']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }


            $category = LocationPanne::find($data['id_panne']);

            if ($category == null) {
                return $this->sendError("panne associate to location not found");
            }

            LocationPanne::find($data['id_panne'])->delete();

            Log::debug('delete pannes associate to Location Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($category, "Delete successfully");
        } catch (Exception $e) {
            Log::error('Delete Panne to Location Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Delete Panne to Location Endpoint Exited.');
        }
    }

}
