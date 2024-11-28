<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Google2FA;


class LogOutController extends Controller
{
    public function index(Request $request){
        Google2FA::logout();
    }
}
