<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return void
     */
    public function register(Request $request){
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users',
            'phone_code' => 'required',
            'password' => 'required',
        ]);


    }

    /**
     * @param Request $request
     * @return void
     */
    public function login(Request $request){

    }

    /**
     * @param Request $request
     * @return void
     */
    public function logout(Request $request){

    }
}
