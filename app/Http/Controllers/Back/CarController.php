<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Marque;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class CarController extends Controller
{
    //
    public function index()
    {
        return view('back.car.list');
    }

    public function ajax_get_cars(Request $request)
    {
        $access_token = Session::get('personnalToken');

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_cars_datatables', $request->all());

        $objet = json_decode($response->getBody());

        if (!$objet) {
            dd($response);
        }

        return response()->json($objet);
    }

    public function add()
    {
        $access_token = Session::get('personnalToken');

        //categories
        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_category_cars');

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            $categories = $object->data->categories;
        } else {
            $categories = [];
        }

        //marques
        $response_pr = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_brand_cars');

        $object_br = json_decode($response_pr->body());

        if ($object_br && $object_br->success == true) {
            $marques = $object_br->data->brands;
        } else {
            $marques = [];
        }

        return view('back.car.add', compact('categories', 'marques'));
    }

    public function store(Request $request)
    {
        $access_token = Session::get('personnalToken');

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->post(env('SERVER_PC') . 'add_cars', [
            'name' => $request->name,
            'modele' => $request->modele,
            'couleur' => $request->couleur,
            'annee' => $request->annee,
            'immatriculation' => $request->immatriculation,
            'type_carburant' => $request->type_carburant,
            'prix_location' => $request->prix_location,
            'kilometrage' => $request->kilometrage,
            'nombre_places' => $request->nombre_places,
            'nombre_portes' => $request->nombre_portes,
            'transmission' => $request->transmission,
            'assurance_nom' => $request->assurance_nom,
            'assurance_date_expi' => $request->assurance_date_expi,
            'category_id' => $request->category_id,
            'marque_id' => $request->marque_id,
            'note' => $request->note
        ]);

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            return redirect('backend/cars')->with('success', "le véhicule a été créé avec succès.");
        } else {

            return back()->with('error', $object->message ?? 'Une erreur s\'est produite.')->withInput();
        }
    }

    public function view($car)
    {
        $access_token = Session::get('personnalToken');

        //roles
        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_cars', [
            'id' => $car,
        ]);

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            $car = $object->data->cars[0];
        } else {
            $car = [];
        }

        return view('back.car.item', compact('car'));
    }

    public function edit($car)
    {
        $access_token = Session::get('personnalToken');

        //roles
        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_cars', [
            'id' => $car,
        ]);

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            $car = $object->data->cars[0];
        } else {
            $car = [];
        }

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_category_cars');

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            $categories = $object->data->categories;
        } else {
            $categories = [];
        }

        //marques
        $response_pr = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_brand_cars');

        $object_br = json_decode($response_pr->body());

        if ($object_br && $object_br->success == true) {
            $marques = $object_br->data->brands;
        } else {
            $marques = [];
        }

        return view('back.car.edit', compact('car', 'categories', 'marques'));
    }

    public function update(Request $request, $car)
    {
        $access_token = Session::get('personnalToken');

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->post(env('SERVER_PC') . 'update_cars', [
            'name' => $request->name,
            'modele' => $request->modele,
            'couleur' => $request->couleur,
            'annee' => $request->annee,
            'immatriculation' => $request->immatriculation,
            'type_carburant' => $request->type_carburant,
            'prix_location' => $request->prix_location,
            'kilometrage' => $request->kilometrage,
            'nombre_places' => $request->nombre_places,
            'nombre_portes' => $request->nombre_portes,
            'transmission' => $request->transmission,
            'assurance_nom' => $request->assurance_nom,
            'assurance_date_expi' => $request->assurance_date_expi,
            'category_id' => $request->category_id,
            'marque_id' => $request->marque_id,
            'note' => $request->note,
            'id' => $car
        ]);

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            return redirect('backend/car/view/' . $car)->with('success', "le véhicule a été mis à jour avec succès.");
        } else {

            return back()->with('error', $object->message ?? 'Une erreur s\'est produite.')->withInput();
        }
    }

    public function media($car)
    {
        $access_token = Session::get('personnalToken');

        //vehicule
        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_cars', [
            'id' => $car,
        ]);

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            $car = $object->data->cars[0];
        } else {
            $car = [];
        }

        return view('back.car.picture', compact('car'));
    }

    public function update_picutre(Request $request, $car)
    {
        $access_token = Session::get('personnalToken');

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->post(env('SERVER_PC') . 'add_cars', [
            'name' => $request->name,
            'modele' => $request->modele,
            'couleur' => $request->couleur,
            'annee' => $request->annee,
            'immatriculation' => $request->immatriculation,
            'type_carburant' => $request->type_carburant,
            'prix_location' => $request->prix_location,
            'kilometrage' => $request->kilometrage,
            'nombre_places' => $request->nombre_places,
            'nombre_portes' => $request->nombre_portes,
            'transmission' => $request->transmission,
            'assurance_nom' => $request->assurance_nom,
            'assurance_date_expi' => $request->assurance_date_expi,
            'category_id' => $request->category_id,
            'marque_id' => $request->marque_id,
            'note' => $request->note,
            'id' => $car
        ]);

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            return redirect('backend/car/view/' . $car)->with('success', "le véhicule a été mis à jour avec succès.");
        } else {

            return back()->with('error', $object->message ?? 'Une erreur s\'est produite.')->withInput();
        }
    }

    public function categories()
    {
        $access_token = Session::get('personnalToken');

        //categories
        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_category_cars');

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            $categories = $object->data->categories;
        } else {
            $categories = [];
        }

        return view('back.car.categories', compact('categories'));
    }

    public function store_category(Request $request)
    {
        $access_token = Session::get('personnalToken');

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->post(env('SERVER_PC') . 'add_category_cars', [
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            return back()->with('success', "la catégorie a été créé avec succès.");
        } else {

            return back()->with('error', $object->message ??  'Une erreur s\'est produite.');
        }
    }

    public function update_category(Request $request, $category)
    {
        $access_token = Session::get('personnalToken');

        if ($request->has('delete')) {
            $response = Http::withHeaders([
                "Authorization" => "Bearer " . $access_token
            ])->delete(env('SERVER_PC') . 'delete_category_cars', [
                'id' => $category,
            ]);

            $object = json_decode($response->body());

            if ($object && $object->success == true) {
                return back()->with('success', "la catégorie a été supprimé avec succès.");
            } else {
                return back()->with('error', $object->message ??  'Une erreur s\'est produite.');
            }
        } else {
            $response = Http::withHeaders([
                "Authorization" => "Bearer " . $access_token
            ])->post(env('SERVER_PC') . 'update_category_cars', [
                'id' => $category,
                'name' => $request->name,
                'description' => $request->description,
            ]);

            $object = json_decode($response->body());

            if ($object && $object->success == true) {
                return back()->with('success', "la catégorie a été mis à jour avec succès.");
            } else {
                return back()->with('error', $object->message ??  'Une erreur s\'est produite.');
            }
        }
    }

    public function marques()
    {
        $access_token = Session::get('personnalToken');

        //brands
        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_brand_cars');

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            $marques = $object->data->brands;
        } else {
            $marques = [];
        }

        return view('back.car.marques', compact('marques'));
    }

    public function store_marque(Request $request)
    {
        $access_token = Session::get('personnalToken');

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->post(env('SERVER_PC') . 'add_brand_cars', [
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            return back()->with('success', "la marque a été créé avec succès.");
        } else {

            return back()->with('error', $object->message ??  'Une erreur s\'est produite.');
        }
    }

    public function update_marque(Request $request, $marque)
    {
        $access_token = Session::get('personnalToken');

        if ($request->has('delete')) {
            $response = Http::withHeaders([
                "Authorization" => "Bearer " . $access_token
            ])->delete(env('SERVER_PC') . 'delete_brand_cars', [
                'id' => $marque,
            ]);

            $object = json_decode($response->body());

            if ($object && $object->success == true) {
                return back()->with('success', "la marque a été supprimé avec succès.");
            } else {
                return back()->with('error', $object->message ??  'Une erreur s\'est produite.');
            }
        } else {
            $response = Http::withHeaders([
                "Authorization" => "Bearer " . $access_token
            ])->post(env('SERVER_PC') . 'update_brand_cars', [
                'id' => $marque,
                'name' => $request->name,
                'description' => $request->description,
            ]);

            $object = json_decode($response->body());

            if ($object && $object->success == true) {
                return back()->with('success', "la marque a été mis à jour avec succès.");
            } else {

                return back()->with('error', $object->message ??  'Une erreur s\'est produite.');
            }
        }
    }
}
