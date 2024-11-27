<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\Privilege;
use App\Models\V1\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $roles  = Role::with('userType')->get();

        return response()->json([
            'data' => $roles
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

            $creation = Role::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'active' => 1,
                'user_type_id' => $validated['user_type_id'],
            ]);

            if ($creation) {
                return response()->json([
                    'data' => $creation,
                    'message' => 'Role crée avec succès.'
                ], 200);
            }
        } else {
            return response()->json([
                'message' => 'Mauvaise requête',
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
        $data = Role::with(['userType', 'privileges'])->find($id);

        // Vérifier si la ressource existe
        if (!$data) {
            return response()->json([
                'message' => 'Rôle pas trouvé',
            ], 404); // Ressource non trouvée
        }

        // Retourner la ressource si tout va bien
        return response()->json([
            'data' => $data,
            'privileges' => $data->privileges
        ], 200);
    }

    /**
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        $data = Role::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Le Role n\'existe pas',
            ], 404);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|string',
            'description' => 'sometimes|string',
            'user_type_id' => 'sometimes|numeric'
        ]);

        $data->update($validatedData);

        return response()->json([
            'message' => 'données partiellement mis à jour avec succès',
            'data' => $data,
        ], 200);
    }

    /**
     * @param Role $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Role $id)
    {
        $id->delete();

        return response()->json(['message' => 'Role supprimé avec succès.'], 200);
    }
}
