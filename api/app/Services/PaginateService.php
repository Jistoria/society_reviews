<?php

namespace App\Services;

use App\Models\Franchise;
use App\Models\Review;

class PaginateService
{
    protected $franchiseModel;
    public function __construct(Franchise $franchise)
    {
        $this->franchiseModel = $franchise;
    }

    public function paginate($search = null)
    {
        $query = $this->franchiseModel::with([
            'reviews' => function ($query) {
                $query->select('review_id', 'franchise_id', 'content_type_id', 'title_alternative', 'rating_main', 'slug', 'published')
                        ->where('published', true);
            },
            'reviews.contentType:content_type_id,type',
            'tags:tag_id,name_tag'
        ])->select('franchise_id', 'title', 'slug', 'franchise_rating');

        $query->when($search, function ($query, $search) {
            // Agregar condiciones de búsqueda según tus criterios
            $query->where('title', 'like', "%$search%")
                ->orWhere('title_alternative', 'like', "%$search%");
        });

        // Franquicias con al menos una revisión publicada
        $query->whereHas('reviews',function($query){ $query->where('published',true);});

        return $query->paginate(10);
    }



}
