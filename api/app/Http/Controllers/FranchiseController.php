<?php

namespace App\Http\Controllers;

use App\Http\Requests\FranchiseRequest;
use App\Models\Franchise;
use Exception;
use Illuminate\Http\Request;

class FranchiseController extends Controller
{
    //Mostrar todas las franquicias
    public function index()
    {
        $franchises = Franchise::pluck('title','franchise_id');
        return response()->json(['success'=>true, 'franchises'=>$franchises]);
    }
    //Crear franquicia
    public function store(FranchiseRequest $f_request)
    {
        try {
            // Crear Franquicia
            $franchise = new Franchise($f_request->except('tag_id'));

            // Guardar la franquicia
            $franchise->save();

            // Adjuntar tags (relación muchos a muchos)
            $franchise->tags()->attach($f_request->tag_id);

            return response()->json(['success' => true, 'message' => 'Se ha creado la franquicia']);
        } catch (Exception $e) {
            // Manejar errores
            return response()->json(['success' => false, 'message' => 'Error al crear la franquicia', 'error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, Franchise $franchise)
    {
        try{
            $request->validate(['title'=> 'nullable|unique:franchises,title'.$franchise->franchise_id.',franchise_id']);
            $franchise->update($request->all());
            return response()->json(['success'=>true, 'message'=>$franchise]);
        }catch(Exception $e){

        }
    }
}
