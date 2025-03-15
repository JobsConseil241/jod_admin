<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Recouvrement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class RecouvrementController extends BaseController
{
    public function get_all_recouvrements(Request $request)
    {
        try {
            Log::info('Get Recouvrements all data  Endpoint Entered.');

            Log::debug('Get Recouvrements all data Endpoint - All Params: ' . json_encode($request->all()));

            $recou = Recouvrement::with(['location', 'paiement', 'agent'])->orderBy('date_echeance');

            $data['recouvrement'] = $recou->get();

            Log::debug('Get Recouvrements all data Endpoint - Response: ' . json_encode($data));

            return DataTables::of($recou->get())->make(true);
        } catch (Exception $e) {
            Log::error('Get Recouvrements all data Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Get Recouvrements all data Endpoint Exited.');
        }
    }
}
