<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //
    public function index()
    {
        $car_categories = Category::all();
        $vehicules = Vehicule::all();

        return view('welcome', compact('car_categories', 'vehicules'));
    }

    public function about()
    {
        return view('front.about');
    }

    public function contact()
    {
        return view('front.contact');
    }
}
