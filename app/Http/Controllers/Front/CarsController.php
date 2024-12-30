<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    //
    public function index()
    {

        return view('front.car.list');
    }

    public function show($name)
    {
        $car = Vehicule::with(['categorie', 'marque', 'vehiculeMedias', 'latestEtat'])->where('name', $name)->first();
        return view('front.car.item', compact('car'));
    }
}
