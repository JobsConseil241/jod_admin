<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function index()
    {
        $paie_on = 'active';
        $paie_op = 'open';
        $paie_list_on = 'active';

        return view('back.paiement.list', compact('paie_on', 'paie_list_on', 'paie_op'));
    }

    public function ajax_get_paiements(Request $request)
    {
        $access_token = Session::get('personnalToken');

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_all_paiements', $request->all());

        $objet = json_decode($response->getBody());

        if (!$objet) {
            dd($response);
        }

        return response()->json($objet);
    }

}
