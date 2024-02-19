<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $user = User::create($userRequest->all());
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
    public function update(UserRequest $userRequest, string $id)
    {
        $user = User::where('id',$id)->update($userRequest->all());

        return response()->json(['message'=>'modification effectuer']);
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
