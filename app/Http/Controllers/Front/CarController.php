<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarController extends Controller
{
    //
    public function index()
    {

        return view('front.car.list');
    }

    public function show()
    {

        return view('front.car.item');
    }
}
