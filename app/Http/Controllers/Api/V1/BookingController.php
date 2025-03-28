<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\BaseController;
use App\Models\Location;
use App\Models\LocationPanne;
use App\Models\Paiement;
use App\Models\Panne;
use App\Models\User;
use App\Models\Vehicule;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BookingController extends BaseController
{

    public function get_all_locations(Request $request)
    {
        try {
            Log::info('Get Locations all data  Endpoint Entered.');

            Log::debug('Get Locations all data Endpoint - All Params: ' . json_encode($request->all()));

            $resas = Location::with('user', 'vehicule.vehiculeMedias', 'pannes', 'etatAvantLocation', 'etatApresLocation', 'clientAssocie', 'paiementAssocie',);

            $data['resas'] = $resas->get();

            Log::debug('Get Locations all data Endpoint - Response: ' . json_encode($data));

            return DataTables::of($resas->get())->make(true);
        } catch (Exception $e) {
            Log::error('Get Locations all data Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Get Locations all data Endpoint Exited.');
        }
    }

    public function registerBookingBack(Request $request)
    {
        try {
            Log::info('Add the reservation of a vehicule  Endpoint Entered.');

            Log::debug('Add Reservation Endpoint - All Params: ' . json_encode($request->all()));
            $datas = $request->all();
            $rules = [
                'date_debut' => 'required|date_format:Y-m-d H:i',
                'date_retour' => 'required|date_format:Y-m-d H:i|after:date_heure_debut',
                'vehicule' => 'required|integer',
                'type_loca' => 'required|string|in:courte,longue',
                'comission' => 'required|in:true,false',
                'jours' => 'required|integer',
                'etat_avant' => 'required|integer',
                'livraison' => 'required|in:true,false',
                'method_paie' => 'required|string',
                'mntant_a_payer' => 'required|integer',
                'mntant_paye' => 'required|integer',
                'montant_restant' => 'required|integer',
                'client_id' => 'sometimes|numeric|nullable',
                'name' => 'sometimes|string',
                'surname' => 'sometimes|string',
                'phone' => 'sometimes|string',
                'phone_code' => 'sometimes|string',
                'email' => 'sometimes|string',
                'adresse' => 'sometimes|string',
                'bp' => 'sometimes|string',
                'npiece' => 'sometimes|string',
                'piece' => 'sometimes|string'

            ];


            $validator = Validator::make($request->all(), $rules);


            // Convertir les chaînes en booléens
            $datas['comission'] = $datas['comission'] === 'true';
            $datas['livraison'] = $datas['livraison'] === 'true';

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }
            // Deja fait sur le frontend
            //            $dateDebut = Carbon::parse($datas['date_heure_debut']);
            //            $dateFin = Carbon::parse($datas['date_heure_fin']);
            //
            //            // Calculer la différence en jours
            //            $differenceEnJours = $dateDebut->diffInDays($dateFin);

            if ($request->has('client_id') && $request->filled('client_id')) {

                $paie_id = Paiement::create([
                    'reference' => Paiement::generateUniqueCode(),
                    'methode_paiement' => $datas['method_paie'],
                    'montant_total' => $datas['mntant_a_payer'],
                    'montant_paye' => $datas['mntant_paye'],
                    'montant_restant' => $datas['montant_restant'],
                    'statut' => ($datas['montant_restant'] == 0) ? 1 : 0,

                ]);

                $state_resa = 7;
                $today = Carbon::today()->format('Y-m-d');
                $end_day = Carbon::parse($datas['date_retour'])->locale('fr')->isoFormat('Y-m-d');

                if ($today == $end_day) {
                    $disponible = true;
                    $state_resa = 5;
                }
                if ($today > $end_day) {
                    $disponible = true;
                    $state_resa = 5;
                }
                if ($today < $end_day) {
                    $disponible = false;
                }

                $vehicule = Vehicule::find($datas['vehicule']);
                $vehicule->statut_location = $disponible;
                $vehicule->save();

                $location = Location::create([
                    'code_contrat' => Location::generateUniqueCode(),
                    'date_heure_debut' => $datas['date_debut'],
                    'date_heure_fin' => $datas['date_retour'],
                    'vehicule_id' => $datas['vehicule'],
                    'type_location' => $datas['type_loca'],
                    'jours' => $datas['jours'],
                    'statut' => $state_resa,
                    'comission' => $datas['comission'],
                    'etat_livraison_id' => $datas['etat_avant'],
                    'livraison' => $datas['livraison'],
                    'client_id' => $datas['client_id'],
                    'paiement_id' => $paie_id->id,
                ]);
            } else {
                $thumbUrl = '';

                if ($request->hasFile('thumb')) {
                    // Générer un nom unique pour le fichier
                    $fileName = time() . '_' . $request->file('thumb')->getClientOriginalName();

                    // Déplacer le fichier vers le dossier public/thumbs
                    $request->file('thumb')->move(public_path('Permis_De_Conduire'), $fileName);

                    // Chemin pour stocker en base de données
                    $thumbUrl = 'Permis_De_Conduire/' . $fileName;
                }

                $clientId = User::create([
                    'first_name' => $datas['name'],
                    'last_name' => $datas['surname'],
                    'email' => $datas['email'],
                    'phone' => $datas['phone'],
                    'phone_code' => $datas['phone_code'],
                    'password' => hash('sha256', $datas['phone']),
                    'adresse' => $datas['adresse'],
                    'bp' => $datas['bp'],
                    'thumb_url' => $thumbUrl,
                    'piece_identite' => $datas['piece'],
                    'numero_piece' => $datas['npiece'],
                    'user_type_id' => 1000002,
                    'is_active' => 1,
                ]);

                $paie_id = Paiement::create([
                    'reference' => Paiement::generateUniqueCode(),
                    'methode_paiement' => $datas['method_paie'],
                    'montant_total' => $datas['mntant_a_payer'],
                    'montant_paye' => $datas['mntant_paye'],
                    'montant_restant' => $datas['montant_restant'],
                    'statut' => ($datas['montant_restant'] == 0) ? 1 : 0,

                ]);

                $state_resa = 7;
                $today = Carbon::today()->format('Y-m-d');
                $end_day = Carbon::parse($datas['date_retour'])->locale('fr')->isoFormat('Y-m-d');

                if ($today == $end_day) {
                    $disponible = true;
                    $state_resa = 5;
                }
                if ($today > $end_day) {
                    $disponible = true;
                    $state_resa = 5;
                }
                if ($today < $end_day) {
                    $disponible = false;
                }

                $vehicule = Vehicule::find($datas['vehicule']);
                $vehicule->statut_location = $disponible;
                $vehicule->save();


                $location = Location::create([
                    'code_contrat' => Location::generateUniqueCode(),
                    'date_heure_debut' => $datas['date_debut'],
                    'date_heure_fin' => $datas['date_retour'],
                    'vehicule_id' => $datas['vehicule'],
                    'type_location' => $datas['type_loca'],
                    'jours' => $datas['jours'],
                    'statut' => $state_resa,
                    'comission' => $datas['comission'],
                    'etat_livraison_id' => $datas['etat_avant'],
                    'livraison' => $datas['livraison'],
                    'client_id' => $clientId->id,
                    'paiement_id' => $paie_id->id,
                ]);
            }



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

    public function updateBooking(Request $request)
    {
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

    public function cancelBooking(Request $request)
    {
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

     public function getDetailBooking(Request $request)
    {
        try {
            Log::info('Get detail Booking vehicules  Endpoint Entered.');

            Log::debug('Get detail Booking Vehicules Endpoint - All Params: ' . json_encode($request->all()));
            $data = $request->all();
            $rules = [
                'id' => 'required|string'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }


            $category = Location::with(['user',
                'vehicule' => function($query) {
                $query->with(['locations', 'vehiculeMedias', 'categorie', 'marque', 'latestEtat']);
            }, 'pannes', 'etatAvantLocation', 'etatApresLocation', 'clientAssocie', 'paiementAssocie'])
                        ->where('code_contrat', $data['id'])->get();

            if ($category == null) {
                return $this->sendError("Contrat de Location not found");
            }

            Log::debug('detail Booking Vehicules - Response: ' . json_encode($data));

            return $this->sendResponse($category, "Detail Booking retrieve successfully");
        } catch (Exception $e) {
            Log::error('Cancel Booking Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Cancel Booking Endpoint Exited.');
        }
    }

    public function validateBooking(Request $request)
    {
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
    public function rejectBooking(Request $request)
    {
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


    public function assign_pannes_locations(Request $request)
    {
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

    public function update_pannes_locations(Request $request)
    {
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

    public function delete_pannes_locations(Request $request)
    {
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
