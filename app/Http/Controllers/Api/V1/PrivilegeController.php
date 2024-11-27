<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\Privilege;
use App\Models\V1\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrivilegeController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'data' => Privilege::with('userType')->get()
        ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function store(Request $request)
    {
        $validateData = Validator::make($request->all(),[
            'name' => 'required|string',
            'description' => 'required|string',
            'user_type_id' => 'required|numeric'
        ]);

        if (!$validateData->fails()) {

            $validated = $validateData->validated();

            $creation = Privilege::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'user_type_id' => $validated['user_type_id']
            ]);

            if ($creation) {
                return response()->json([
                    'data' => $creation,
                    'message' => 'Privilege crée avec succès.'
                ], 200);
            }
        } else {
            return response()->json([
                'message' => 'Bad request',
                'errors' => $validateData->errors()
            ], 422);
        }
    }

    /**
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        if (!is_numeric($id) || $id <= 0) {
            return response()->json([
                'message' => 'Invalide ID fournit',
            ], 403); // Bad Request 403
        }

        // Rechercher la ressource
        $data = Privilege::find($id);

        // Vérifier si la ressource existe
        if (!$data) {
            return response()->json([
                'message' => 'Privilege pas trouvé',
            ], 404); // Ressource non trouvée
        }

        // Retourner la ressource si tout va bien
        return response()->json([
            'data' => $data,
        ], 200);
    }

    /**
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        // Trouver le formulaire par son ID
        $data = Privilege::find($id);

        // Vérifier si le formulaire existe
        if (!$data) {
            return response()->json([
                'message' => 'Privilège n\'existe pas',
            ], 404); // Ressource non trouvée
        }

        // Valider les données entrantes (partielle)
        $validatedData = $request->validate([
            'name' => 'sometimes|string',
            'description' => 'sometimes|string',
            'user_type_id' => 'sometimes|numeric'
        ]);

        // Mettre à jour uniquement les champs présents dans la requête
        $data->update($validatedData);

        // Retourner la réponse
        return response()->json([
            'message' => 'données partiellement mis à jour avec succès',
            'data' => $data,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * @param Request $request
     * @param Privilege $privilege
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function assign(Request $request, Privilege $privilege) {


        $validateData = Validator::make($request->all(),[
            'role_id' => 'required|exists:roles,id',
        ]);

        if (!$validateData->fails()) {
            $validated = $validateData->validated();

            $associe  = $privilege->roles()->attach($validated['role_id']);

            return response()->json([
                'message' => 'Privilège ajouté au role.'
            ], 200);

        } else {
            return response()->json([
                'message' => 'Bad request',
                'errors' => $validateData->errors()
            ], 422);
        }
    }

    /**
     * @param Request $request
     * @param Privilege $privilege
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove(Request $request, Privilege $privilege, Role $role) {

        $privilege->roles()->detach($role);

        return response()->json(['message' => 'Privilège ajouté au role supprimé avec succès.']);
    }
}
