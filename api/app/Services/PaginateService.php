<?php

namespace App\Services;

use App\Models\Franchise;
use App\Models\Review;

class PaginateService
{
    protected $franchiseModel;
    protected $reviewModel;
    public function __construct(Franchise $franchise, Review $review)
    {
        $this->franchiseModel = $franchise;
        $this->reviewModel = $review;
    }

    /**
     * Pagina las Reviews con la opción de búsqueda opcional.
     *
     * @param string|null $search El término de búsqueda opcional para filtrar por título de franquicia.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($search = null)
    {
        $query = $this->reviewModel::with([
            'franchise:franchise_id,title,slug,image_url',
            'franchise.tags:tag_id,name_tag',
            'contentType:content_type_id,type'
        ])
        ->select('review_id', 'franchise_id', 'content_type_id', 'title_alternative', 'rating_main', 'slug')
        ->whereHas('franchise', function($query) use($search){
            $query->when($search, function($query) use ($search){
                $query->where('title','like',"%$search%");
            });
        })
        ->where('published', true);

        return $query->paginate(10);
    }

    // $query = $this->franchiseModel::with([
    //     'reviews' => function ($query) {
    //         $query->select('review_id', 'franchise_id', 'content_type_id', 'title_alternative', 'rating_main', 'slug', 'published')
    //                 ->where('published', true);
    //     },
    //     'reviews.contentType:content_type_id,type',
    //     'tags:tag_id,name_tag'
    // ])->select('franchise_id', 'title', 'slug', 'franchise_rating','image_url');

    // $query->when($search, function ($query, $search) {
    //     // Agregar condiciones de búsqueda según tus criterios
    //     $query->where('title', 'like', "%$search%")
    //         ->orWhere('title_alternative', 'like', "%$search%");
    // });

    // // Franquicias con al menos una revisión publicada
    // $query->whereHas('reviews',function($query){ $query->where('published',true);});


}
