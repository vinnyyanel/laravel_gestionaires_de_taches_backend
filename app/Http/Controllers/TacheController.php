<?php

namespace App\Http\Controllers;
use App\Http\Requests\TacheRequest;
use App\Models\tache;

use Illuminate\Http\Request;

class TacheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taches = tache::all();
        return response()->json($taches);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TacheRequest $tacheRequest)
    {
        $tache = tache::create($tacheRequest->all());
        return response()->json(['message'=>'tache creer']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $tache= tache::findOrFail($id);
            return response()->json($tache);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response()->json(['error' => 'utilisateur non trouvé.'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TacheRequest $tacheRequest, string $id)
    {
        $tache = tache::where('id', $id)
                ->update($tacheRequest->all());

        return response()->json(['message'=>'modification effectuer']);
    }
     /**
     * getTacheByUserId the specified function in storage.
     */
    public function getTacheByUserId( string $id)
    {
        $taches = tache::where('user_id', $id)->get();

        return response()->json($taches);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tache = tache::where('id',$id)->delete();

        return response()->json(['message'=>'la tache a éte suprimé avec succes']);
    }
}
