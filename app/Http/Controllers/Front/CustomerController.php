<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index() {
        $user = auth()->user();

        return view('front.customer.profil', compact('user'));
    }
}
