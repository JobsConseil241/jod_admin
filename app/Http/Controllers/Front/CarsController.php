<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Marque;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    //
    public function index()
    {
        $cars = Vehicule::with(['categorie', 'marque', 'vehiculeMedias', 'latestEtat'])->get();

        $categories = Category::all();
        $marques = Marque::all();


        return view('front.car.list', compact('cars', 'categories', 'marques'));
    }

    public function show($name)
    {
        $car = Vehicule::with(['categorie', 'marque', 'vehiculeMedias', 'latestEtat'])->where('name', $name)->first();

        return view('front.car.item', compact('car', 'name'));
    }
}
