<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Services\ReviewService;
use Exception;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    private $reviewService;
    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    //Matenme
    public function index(Request $request)
    {
        $reviews = $this->reviewService->indexReview($request->query('search'));
        return response()->json(['success'=>true,'reviews'=>$reviews]);
    }
    //Crear Review
    public function store(ReviewRequest $review_request)
    {
        // Crear la revisión utilizando el servicio
        $review = $this->reviewService->createReview($review_request->validated());

        // Retornar una respuesta JSON con la revisión creada
        return response()->json(['success' => true, 'review' => $review], 201);
    }

    public function publishedReview(Request $request, Review $review)
    {
        // Cambiar el valor de 'published' utilizando el servicio
        $this->reviewService->togglePublishedStatus($review);

        // Retornar una respuesta JSON indicando que el valor ha sido cambiado
        return response()->json(['success' => true, 'message' => 'Estado "published" actualizado para la reseña.']);
    }

    public function notifyReview(Review $review)
    {
        $this->reviewService->notifyUsersAboutReview($review->dataNotify());
    }


    public function destroy(Review $review)
    {
        try {
            $title = $review->title_alternative;
            $this->reviewService->deleteReview($review);
            return response()->json(['success' => true, 'message' => "Se ha eliminado la reseña {$title}"]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al eliminar la reseña', 'error' => $e->getMessage()], 500);
        }
    }

    public function edit(Review $review)
    {
        return $this->reviewService->editReview($review);
    }

    public function update(Request $request, Review $review)
    {
        try {
            $request->validate([
                'title_alternative' => 'nullable|unique:reviews,title_alternative,' . $review->review_id.',review_id',
            ], [
                'title_alternative.unique' => 'Ya está en uso este título',
            ]);

            $this->reviewService->updateReview($review, $request->all());

            return response()->json(['success' => true, 'message' => 'Review actualizada']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->getMessages();
            return response()->json(['success' => false, 'message' => 'Error de validación', 'errors' => $errors]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error de servidor', 'error' => $e->getMessage()]);
        }
    }

    public function pluckContenType()
    {
        return response()->json(['success'=>true, 'content_type'=>$this->reviewService->getContentType()]);
    }

    public function pluckAuthors()
    {
        return response()->json(['success'=>true,'authors'=>$this->reviewService->getAuthors()]);
    }

}
