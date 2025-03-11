<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\BaseController;
use App\Models\Location;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class PaymentController extends BaseController {
    public function get_all_paiements(Request $request)
    {
        try {
            Log::info('Get Paiements all data  Endpoint Entered.');

            Log::debug('Get Paiements all data Endpoint - All Params: ' . json_encode($request->all()));

            $paiements = Paiement::with('location')->orderBy('created_at', 'desc');;

            $data['paiement'] = $paiements->get();

            Log::debug('Get Paiements all data Endpoint - Response: ' . json_encode($data));

            return DataTables::of($paiements->get())->make(true);
        } catch (Exception $e) {
            Log::error('Get Paiements all data Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Get Paiements all data Endpoint Exited.');
        }
    }
}
