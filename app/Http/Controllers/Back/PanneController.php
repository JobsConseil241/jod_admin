<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PanneController extends Controller
{
    //
    public function index()
    {
        $access_token = Session::get('personnalToken');

        //categories
        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_pannes');

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            $pannes = $object->data->pannes;
        } else {
            $pannes = [];
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

        return view('back.panne.list', compact('pannes', 'categories'));
    }

    public function store(Request $request)
    {
        $access_token = Session::get('personnalToken');

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->post(env('SERVER_PC') . 'add_pannes', [
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            return back()->with('success', "la panne a été créé avec succès.");
        } else {

            return back()->with('error', $object->message ??  'Une erreur s\'est produite.');
        }
    }

    public function update(Request $request, $panne)
    {
        $access_token = Session::get('personnalToken');

        if ($request->has('delete')) {
            $response = Http::withHeaders([
                "Authorization" => "Bearer " . $access_token
            ])->delete(env('SERVER_PC') . 'delete_pannes', [
                'id' => $panne,
            ]);

            $object = json_decode($response->body());

            if ($object && $object->success == true) {
                return back()->with('success', "la panne a été supprimé avec succès.");
            } else {
                return back()->with('error', $object->message ??  'Une erreur s\'est produite.');
            }
        } else {
            $response = Http::withHeaders([
                "Authorization" => "Bearer " . $access_token
            ])->post(env('SERVER_PC') . 'update_pannes', [
                'id' => $panne,
                'name' => $request->name,
                'description' => $request->description,
                'category_id' => $request->category_id,
            ]);

            $object = json_decode($response->body());

            if ($object && $object->success == true) {
                return back()->with('success', "la panne a été mis à jour avec succès.");
            } else {
                return back()->with('error', $object->message ??  'Une erreur s\'est produite.');
            }
        }
    }

    public function categories()
    {
        $access_token = Session::get('personnalToken');

        //categories
        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_category_pannes');

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            $categories = $object->data->categories;
        } else {
            $categories = [];
        }

        return view('back.panne.categories', compact('categories'));
    }

    public function store_category(Request $request)
    {
        $access_token = Session::get('personnalToken');

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->post(env('SERVER_PC') . 'add_category_pannes', [
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            return back()->with('success', "la catégorie de panne a été créé avec succès.");
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
            ])->delete(env('SERVER_PC') . 'delete_category_pannes', [
                'id' => $category,
            ]);

            $object = json_decode($response->body());

            if ($object && $object->success == true) {
                return back()->with('success', "la catégorie de panne a été supprimé avec succès.");
            } else {
                return back()->with('error', $object->message ??  'Une erreur s\'est produite.');
            }
        } else {
            $response = Http::withHeaders([
                "Authorization" => "Bearer " . $access_token
            ])->post(env('SERVER_PC') . 'update_category_pannes', [
                'id' => $category,
                'name' => $request->name,
                'description' => $request->description,
            ]);

            $object = json_decode($response->body());

            if ($object && $object->success == true) {
                return back()->with('success', "la catégorie de panne a été mis à jour avec succès.");
            } else {
                return back()->with('error', $object->message ??  'Une erreur s\'est produite.');
            }
        }
    }
}
