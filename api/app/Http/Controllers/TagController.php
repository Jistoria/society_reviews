<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TagController extends Controller
{
    //Obetener todos los Tags
    public function index()
    {
        $tags = Tag::all();
        return response(['success'=>true, 'tags'=>$tags]);
    }
    //Crear un Tag
    public function store(Request $request)
    {
        try {
            // Validar la solicitud
            $request->validate([
                'name_tag' => 'required|string|unique:tags',
            ],[
                'name_tag.unique' => 'El nombre del tag ya está en uso.',
            ]);

            // Crear el Tag
            $tag = Tag::create($request->all());
            return response(['success' => true, 'message' => "Se ha creado el tag: $tag->name_tag"], Response::HTTP_CREATED);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Manejar la excepción de validación
            $errors = $e->validator->errors()->getMessages();
            return response(['success' => false, 'message' => 'Error de validación', 'errors' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $e) {
            // Manejar otras excepciones
            return response(['success' => false, 'message' => 'Error interno del servidor', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    //Actualizar un Tag
    public function update(Request $request, Tag $tag)
    {
        try {
            // Validar la solicitud
            $request->validate([
                'name_tag' => 'required|string|unique:tags,name_tag,' . $tag->tag_id.',tag_id',
            ],[
                'name_tag.unique' => 'El nombre del tag ya está en uso.',
            ]);

            // Actualizar el tag
            $tag->update($request->all());

            return response(['success' => true, 'message' => 'Tag actualizado correctamente'], Response::HTTP_OK);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Manejar la excepción de validación
            return response(['success' => false, 'message' => 'Error de validación', 'errors' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $e) {
            // Manejar otras excepciones
            return response(['success' => false, 'message' => 'Error interno del servidor', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    //Eliminar un Tag
    public function destroy(Tag $tag)
    {
        try {
            $tag->delete();
            return response()->json(['success' => true, 'message' => 'Se ha eliminado el tag']);
        } catch (QueryException $e) {
            // Capturar errores de la base de datos (QueryException)
            return response()->json(['success' => false, 'message' => 'Error de base de datos al eliminar el tag', 'error' => $e->getMessage()], 500);
        } catch (Exception $e) {
            // Capturar cualquier otro tipo de excepción
            return response()->json(['success' => false, 'message' => 'Error al eliminar el tag', 'error' => $e->getMessage()], 500);
        }
    }
}
