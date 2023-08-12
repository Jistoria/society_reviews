<?php

namespace App\Observers;

use App\Models\Review;
use App\Models\Tag;

class TagObserver
{
    /**
     * Handle the Tag "created" event.
     */
    public function created(Tag $tag): void
    {
        //
    }

    /**
     * Handle the Tag "updated" event.
     */
    public function updated(Tag $tag): void
    {
        //
    }

    /**
     * Handle the Tag "deleted" event.
     */
    public function deleted(Tag $tag): void
    {
        //
    }

    /**
     * Handle the Tag "restored" event.
     */
    public function restored(Tag $tag): void
    {
        //
    }

    /**
     * Handle the Tag "force deleted" event.
     */
    public function forceDeleted(Tag $tag): void
    {
        //
    }
    public function deleting(Tag $tag)
    {
        // Verificar si el tag está asociado con alguna revisión en la tabla pivot review_tag
        $reviewsCount = $tag->reviews()->count();

        if ($reviewsCount === 0) {
            return;
        }

        // Si no hay más relaciones en la tabla pivot, eliminamos también las revisiones asociadas
        $tag->reviews()->detach();
        Review::whereIn('id_review', $tag->reviews->pluck('id_review'))->delete();
    }
}
