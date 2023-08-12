<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComentarioRequest;
use App\Jobs\CommentUpdateJob;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //
    public function index()
    {
        $comentarios = Comentario::all();
        return view('comentarios.index', compact('comentarios'));
    }

    public function create()
    {
        // Implementa la lógica para crear un nuevo comentario si es necesario
    }

    public function store(ComentarioRequest $request)
    {
        $comentario = new Comentario([
            'id_user' => $request->input('id_user'),
            'id_review' => $request->input('id_review'),
            'contenido' => $request->input('contenido'),
        ]);
        // Pasar solo el ID del comentario al trabajo
        dispatch(new CommentUpdateJob($comentario));
        return redirect()->back()->with('success', 'Comentario agregado exitosamente.');
    }

    public function show($id)
    {
        $comentario = Comentario::find($id);
        return view('comentarios.show', compact('comentario'));
    }

    public function edit($id)
    {
        $comentario = Comentario::find($id);
        return view('comentarios.edit', compact('comentario'));
    }

    public function update(Request $request, $id)
    {
        // Implementa la lógica para actualizar un comentario en la base de datos
    }

    public function destroy($id)
    {
        // Implementa la lógica para eliminar un comentario de la base de datos
    }
}
