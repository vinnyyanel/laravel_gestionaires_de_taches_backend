<?php

namespace App\Http\Controllers;
use App\Http\Requests\AuthUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

   public function login(AuthUserRequest $authUserRequest){

    $credentials = $authUserRequest->only('name', 'password');
    //$credentials = $authUserRequest->only('email', 'password');
         // Authentifier l'utilisateur
    if (Auth::attempt($credentials)) {
        // Générer un jeton d'accès
        $user = Auth::user();
        $token = $user->createToken($authUserRequest['name'])->accessToken;

        // Retourner le jeton d'accès
        return response()->json(['token' => $token]);
    }else {
        return response()->json(['error' => 'Les informations d\'identification ne correspondent pas'], 401);
    }
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Vous avez été déconnecté avec succès.']);
    }
}
