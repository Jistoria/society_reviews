<?php

namespace App\Services;

use App\Jobs\SendReplyNotificationJob;
use App\Models\Comment;
use App\Notifications\ReplyNotification;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    private $commentModel;
    public function __construct(Comment $comment)
    {
        $this->commentModel = $comment;
    }

    public function getAllComment()
    {
        return $this->commentModel->with('user')->get();
    }

    public function showReviewComment($comment)
    {
        return $this->commentModel
                ->with(['user.roles:name','replies'])
                ->where('review_id', $comment)
                ->orderBy('created_at', 'desc')
                ->get();
    }

    public function updateComment($data, $commentId): bool
    {
        try {
            $comment = $this->commentModel->findOrFail($commentId);

            if (Auth::id() !== $comment->user_id) {
                return false; // El usuario actual no tiene permiso para actualizar este comentario
            }

            $comment->update($data);

            return true; // La actualización se realizó con éxito
        } catch (ModelNotFoundException $e) {
            return false; // El comentario no se encontró
        } catch (Exception $e) {
            return false; // Ocurrió un error inesperado al intentar actualizar el comentario
        }
    }

    /**
     * Crea un nuevo comentario.
     *
     * @param array $data Los datos del comentario a crear.
     * @return Comment El comentario creado.
     */
    public function createComment(array $data): Comment
    {
        // Crea un nuevo comentario con los datos proporcionados
        $comment = $this->commentModel->create($data);
        if($comment->com_comment_id)
        {
            // Despacha el Job para enviar la notificación a la cola
            SendReplyNotificationJob::dispatch($comment);
        }
        // Devuelve el comentario creado
        return $comment;
    }

    /**
     * Elimina un comentario dado su ID.
     *
     * @param int $id El ID del comentario a eliminar.
     * @return bool True si el comentario fue eliminado correctamente, de lo contrario, false.
     */
    public function deleteComment($id,$user_id): bool
    {

        $comment = $this->commentModel->findOrFail($id);
        if($user_id === $comment->user_id)
        {
            $comment->delete();
            return true;
        }
        return false;
    }


}
