<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\UserType;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        return response()->json(['data' => UserType::all()], 200);
    }
}
