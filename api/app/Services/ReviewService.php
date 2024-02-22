<?php

namespace App\Services;

use App\Jobs\NotifyUsersAboutReview;
use App\Models\Review;
use App\Models\Franchise;
use App\Models\User;
use App\Notifications\ReviewAvailableNotification;

class ReviewService
{
    /**
     * Regresar un pluck de las Reseñas
     * @return Review
     */
    public function indexReview(): Review
    {
        return Review::pluck('title_alternative','review_id');
    }
    /**
     * Crear una nueva revisión.
     *
     * @param array $data
     * @return Review
     */
    public function createReview(array $data): Review
    {
        // Aquí puedes realizar validaciones adicionales antes de crear la revisión, si es necesario
        $franchiseId = $data['franchise_id'];
        $releaseYear = $data['release_year'];
        $releaseYearEnd = $data['release_year_end'];
        $this->updateFranchiseReleaseYear($franchiseId, $releaseYear, $releaseYearEnd);
        // Crear la nueva revisión
        $review = Review::create($data);

        return $review;
    }

    protected function updateFranchiseReleaseYear($franchiseId, $releaseYear, $releaseYearEnd)
    {
        $franchise = Franchise::find($franchiseId);
        if ($franchise && $franchise->first_release === null) {
            $franchise->update(['first_release' => $releaseYear]);
        }
        if ($franchise && strtotime($franchise->end_release)< strtotime($releaseYearEnd)) {
            $franchise->update(['end_release' => $releaseYearEnd]);
        }
    }
    /**
     * Actualizar una revisión existente.
     *
     * @param Review $review
     * @param array $data
     * @return Review
     */
    public function updateReview(Review $review, array $data): Review
    {
        // Aquí puedes realizar validaciones adicionales antes de actualizar la revisión, si es necesario

        // Actualizar los datos de la revisión
        $review->update($data);

        return $review;
    }

    /**
     * Validar si la fecha de la revisión es posterior o igual a la fecha de lanzamiento de la franquicia.
     *
     * @param Review $review
     * @return bool
     */
    public function validateReviewDate(Review $review): bool
    {
        $franchise = Franchise::find($review->franchise_id);

        // Verificar si la fecha de lanzamiento de la franquicia está establecida y si la fecha de la revisión es posterior o igual
        if ($franchise && $franchise->first_release && $review->release_year) {
            return strtotime($review->release_year) >= strtotime($franchise->first_release);
        }

        // Si no se puede realizar la validación, devolver verdadero por defecto
        return true;
    }

    public function togglePublishedStatus(Review $review)
    {
        $review->update(['published' => !$review->published]);
        if(!$review->notify && $review->published){
            $this->notifyUsersAboutReview($review->dataNotify());
            $review->update(['notify' => 1]);
        }
    }

    /**
     * Notificar a los usuarios sobre la disponibilidad de una revisión.
     *
     * @param Review $review
     * @return void
     */
    public function notifyUsersAboutReview(Array $data)
    {
        // Notificar a los usuarios sobre la disponibilidad de la reseña
        dispatch(new NotifyUsersAboutReview($data));
    }

    public function deleteReview(Review $review)
    {
        $review->delete();
    }

}
