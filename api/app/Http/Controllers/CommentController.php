<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Services\CommentService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    private $commentService;
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    //Traer todos los comentarios
    public function index()
    {
        return response()->json($this->commentService->getAllComment());
    }

    //Mostrar los comentarios de una reseña
    public function show($comment)
    {
        return response()->json($this->commentService->showReviewComment($comment));
    }

    //crear un comentario
    public function store(CommentRequest $request)
    {
        try{
            $comment = $this->commentService->createComment($request->all());
            return response()->json(['success'=>true, 'comment'=>$comment], 201);
        }catch(Exception $e){
            $error = $e->getMessage();
            return response()->json(['success'=>false, 'error'=>"Se ha producido un error {$error}"],500);
        }
    }

    public function update(Request $request, $comment)
    {
        $request->validate(['content'=> 'required|string'],['content.required'=>'Debes escribir algo']);
        try{
            $success = $this->commentService->updateComment($request->all(), $comment);
            $message = $success ? 'Se ha actualizado el comentario': 'Ha ocurrido un error';
            return response()->json(['success'=>$success, 'message'=>$message]);
        }catch(Exception $e){
            return response()->json(['success'=>false, 'Ha ocurrido un error']);;
        }
    }
    public function destroy($comment)
    {
        try{
            $success = $this->commentService->deleteComment($comment, Auth::id());
            $message = $success ? 'Se ha eliminado el comentario': 'Ha ocurrido un error';
            return response()->json(['success'=>$success, 'message'=>$message]);
        }catch(Exception $e){
            $error = $e->getMessage();
            return response()->json(['success'=>false, 'error'=>"Error interno, $error"],500);
        }
    }
}
