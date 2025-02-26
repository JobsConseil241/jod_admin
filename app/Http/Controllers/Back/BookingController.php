<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
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

        return view('back.booking.add', compact('users'));

    }

    public function Store($request) {}
}
