<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Services\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    private ReviewService $reviewService;
    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    //Matenme
    public function index()
    {
        $reviews = $this->indexReview();
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
}
