<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\EtatVehicule;
use App\Models\Panne;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    //
    public function index()
    {
        $resa_on = 'active';
        $resa_op = 'open';
        $resa_list_on = 'active';
        return view('back.booking.list', compact('resa_on', 'resa_list_on', 'resa_op'));
    }

    public function ajax_get_locations(Request $request)
    {
        $access_token = Session::get('personnalToken');

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_all_locations', $request->all());

        $objet = json_decode($response->getBody());

        if (!$objet) {
            dd($response);
        }

        return response()->json($objet);
    }


    public function add(Request $request) {

        $access_token = Session::get('personnalToken');

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_users', ['user_type_id' => 1000002]);

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            $users = $object->data->users;
        } else {
            $users = [];
        }

        $cars = Vehicule::with('categorie', 'marque', 'vehiculeMedias', 'etats', 'pannes')->get();

//        $respond = Http::withHeaders([
//            "Authorization" => "Bearer " . $access_token
//        ])->get(env('SERVER_PC') . 'get_users', ['user_type_id' => 1000002]);
//
//        $object = json_decode($respond->body());
//
//        if ($object && $object->success == true) {
//            $users = $object->data->users;
//        } else {
//            $users = [];
//        }

        $resa_on = 'active';
        $resa_add_on = 'active';
        $resa_op = 'open';

        return view('back.booking.add', compact('users', 'cars', 'resa_on', 'resa_add_on', 'resa_op'));

    }

    public function get_detail_booking(Request $request, $reference) {

        $access_token = Session::get('personnalToken');

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_detail_reservation_car', ['id' => $reference]);

        $responses = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_users', ['user_type_id' => 1000002]);

        $resp = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_pannes');

        $object = json_decode($response->body());

        $objec = json_decode($resp->body());

        $objects = json_decode($responses->body());

        if ($object && $object->success == true) {
            $booking = $object->data[0];
        } else {
            $booking = [];
        }

        if ($objec && $objec->success == true) {
            $pannes = $objec->data->pannes;
        } else {
            $pannes = [];
        }

        if ($objects && $objects->success == true) {
            $users = $objects->data->users;
        } else {
            $users = [];
        }

        $cars = Vehicule::with('categorie', 'marque', 'vehiculeMedias', 'etats', 'pannes')->get();

//        $respond = Http::withHeaders([
//            "Authorization" => "Bearer " . $access_token
//        ])->get(env('SERVER_PC') . 'get_users', ['user_type_id' => 1000002]);
//
//        $object = json_decode($respond->body());
//
//        if ($object && $object->success == true) {
//            $users = $object->data->users;
//        } else {
//            $users = [];
//        }

        return view('back.booking.detail', compact('booking', 'cars', 'users', 'reference', 'pannes'));

    }

    public function assign_pannes(Request $request, $carId)
    {

        $access_token = Session::get('personnalToken');
        $data = $request->all();

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->post(env('SERVER_PC') . 'assign_pannes_location', $data);

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            return redirect('backend/booking/detail/' . $carId)->with('success', "L'état du véhicule a été mis à jour avec succès.");
        } else {
            return back()->with('error', $object->message ?? 'Une erreur s\'est produite.')->withInput();
        }

    }

    public function update_booking_data(Request $request, $carId)
    {

        $access_token = Session::get('personnalToken');
        $data = $request->all();

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->post(env('SERVER_PC') . 'update_reservation_cars', $data);

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            return redirect('backend/booking/detail/' . $carId)->with('success', "L'état de la location a été mis à jour avec succès.");
        } else {
            return back()->with('error', $object->message ?? 'Une erreur s\'est produite.')->withInput();
        }

    }


    public function update_assign_pannes(Request $request, $carId)
    {

        $access_token = Session::get('personnalToken');
        $data = $request->all();

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->post(env('SERVER_PC') . 'update_pannes_location', $data);

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            return redirect('backend/booking/detail/' . $carId)->with('success', "L'état du véhicule a été mis à jour avec succès.");
        } else {
            return back()->with('error', $object->message ?? 'Une erreur s\'est produite.')->withInput();
        }

    }

    public function get_details_booking_edit(Request $request, $reference) {

        $access_token = Session::get('personnalToken');

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_detail_reservation_car', ['id' => $reference]);

        $responses = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_users', ['user_type_id' => 1000002]);

        $object = json_decode($response->body());

        $objects = json_decode($responses->body());

        if ($object && $object->success == true) {
            $booking = $object->data[0];
        } else {
            $booking = [];
        }

        if ($objects && $objects->success == true) {
            $users = $objects->data->users;
        } else {
            $users = [];
        }

        $cars = Vehicule::with('categorie', 'marque', 'vehiculeMedias', 'etats', 'pannes')->get();

//        $respond = Http::withHeaders([
//            "Authorization" => "Bearer " . $access_token
//        ])->get(env('SERVER_PC') . 'get_users', ['user_type_id' => 1000002]);
//
//        $object = json_decode($respond->body());
//
//        if ($object && $object->success == true) {
//            $users = $object->data->users;
//        } else {
//            $users = [];
//        }

        return view('back.booking.edit', compact('booking', 'cars', 'users', 'reference'));

    }

    public function getPannesByVoiture($voitureId)
    {
        // Récupérer les pannes associées à cette voiture
        $pannes = EtatVehicule::where('vehicule_id', $voitureId)->get();

        // Retourner les pannes au format JSON
        return response()->json($pannes);
    }

    public function Store(Request $request) {
        $access_token = Session::get('personnalToken');

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->post(env('SERVER_PC') . 'set_reservation_cars', $request->all());

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            return back()->with('success', "la Location a été enregistré avec succès.");
        } else {

            return back()->with('error', $object->message ??  'Une erreur s\'est produite.');
        }
    }
}
