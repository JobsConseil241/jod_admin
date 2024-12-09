<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class CarController extends Controller
{
    //
    public function index()
    {

        return view('front.car.list');
    }

    public function show(Vehicule $car)
    {

        return view('front.car.item');
    }
}
