<?php

namespace App\Http\Controllers;

use App\Http\Requests\FranchiseRequest;
use App\Models\Franchise;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FranchiseController extends Controller
{
    //Mostrar todas las franquicias
    public function index(Request $request)
    {
        $search = $request->query('search');
        $franchises = Franchise::select('franchise_id','title', 'image_url','animation_studio_latest','author','original_work');
        if ($search) {
            // Agregar condiciones de búsqueda según tus criterios
            $franchises->where('title', 'like', "%$search%");
        }
        $franchises = $franchises->paginate(3); // Aquí necesitas asignar el resultado paginado a la variable $franchises
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

            return response()->json(['success' => true, 'message' => 'Se ha creado la franquicia'], 201);
        } catch (Exception $e) {
            // Manejar errores
            return response()->json(['success' => false, 'message' => 'Error al crear la franquicia', 'error' => $e->getMessage()]);
        }
    }
    public function edit(Franchise $franchise)
    {
        return response()->json(['success'=>true, 'franchise'=>$franchise]);
    }
    public function update(Request $request, Franchise $franchise)
    {
        try{
            $request->validate(['title'=> 'nullable|unique:franchises,title,'.$franchise->franchise_id.',franchise_id'],[
                'title.unique'=>'Ya esta en uso este titulo'
            ]);
            $franchise->update($request->all());
            return response()->json(['success'=>true, 'message'=>'Franquicia actualizada']);
        }catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->getMessages();
            return response()->json(['success' => false, 'message' => 'Error de validación', 'errors' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch(Exception $e){
            return response()->json(['success'=> false, 'message'=> 'Error de servidor', 'error'=>$e->getMessage()]);
        }
    }

    public function destroy(Franchise $franchise)
    {
        try {
            if($franchise->reviews()->exists()){
                return response()->json(['success' => false, 'message' => 'No se puede eliminar una franquicia con reseña'], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $franchise->delete();
            return response()->json(['success' => true, 'message' => 'Se ha eliminado la franquicia']);
        } catch (QueryException $e) {
            // Capturar errores de la base de datos (QueryException)
            return response()->json(['success' => false, 'message' => 'Error de base de datos al eliminar la franquicia', 'error' => $e->getMessage()], 500);
        } catch (Exception $e) {
            // Capturar cualquier otro tipo de excepción
            return response()->json(['success' => false, 'message' => 'Error al eliminar la franquicia', 'error' => $e->getMessage()], 500);
        }
    }

    public function updateTags(Request $request, Franchise $franchise)
    {
        try{
            $request->validate([ 'tag_id' => 'required|array|exists:tags,tag_id'],[
                'tag_id.required' => 'Se requiere al menos un tag',
                'tag_id.exists' => 'El tag seleccionado no es válido',
            ]);
            $franchise->tags()->sync($request->tag_id);
            return response()->json(['success'=>true, 'message'=>'Se han actualizado los Tags de la Franquicia']);
        }catch(Exception $e){
            //Log::error('Error al actualizar los tags de la franquicia: '.$e->getMessage());
            return response()->json(['success'=>false, 'message'=>'Error al actualizar los Tags de la Franquicia', 'error'=>$e->getMessage()], 500);
        }
    }

    public function getTags(Franchise $franchise)
    {
        $tags = $franchise->tags()->select('tags.tag_id')->get();
        return response()->json(['success'=>true,'tags_franchise'=>$tags]);
    }
    public function pluckFranchise()
    {
        $franchise = Franchise::pluck('title','franchise_id');
        return response()->json(['success'=>true,'franchise'=>$franchise]);
    }
}
