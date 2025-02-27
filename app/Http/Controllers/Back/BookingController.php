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
    {;
        return view('back.booking.list');
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

        return view('back.booking.add', compact('users', 'cars'));

    }

    public function getPannesByVoiture($voitureId)
    {
        // Récupérer les pannes associées à cette voiture
        $pannes = EtatVehicule::where('vehicule_id', $voitureId)->get();

        // Retourner les pannes au format JSON
        return response()->json($pannes);
    }

    public function Store($request) {}
}
