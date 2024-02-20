<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $userRequest)
    {
        $userData = $userRequest->all();
        if (isset($userData['password'])) {
            $userData['password'] = Hash::make($userData['password']);
        }
         // Créer un nouvel utilisateur
    $user = new User($userData);

    // Enregistrer l'utilisateur
    $user->save();

        return response()->json($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
         // Utilisation de findOrFail pour récupérer un utilisateur par son ID
         $user = User::findOrFail($id);

         // Vous pouvez maintenant travailler avec l'objet $user
         return response()->json($user);
     } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
         // Gérer l'exception si l'utilisateur n'est pas trouvé
         return response()->json(['error' => 'utilisateur non trouvé.'], 404);
     }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id,UserRequest $userRequest)
    {
        try {
            $user = User::where('id',$id)->update($userRequest->all());

        return response()->json(['message'=>'modification effectuer']);
        } catch (\Throwable $th) {
            return response()->json($th);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('id',$id)->delete();

        return response()->json(['message' => 'utilisateur suprimé']);
    }
}
