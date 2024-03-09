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
        $query = $this->franchiseModel::with('reviews:review_id,franchise_id,content_type_id,title_alternative,rating_main','reviews.contentType:content_type_id,type')
            ->select('franchise_id','title','slug','franchise_rating');

        if ($search) {
            // Agregar condiciones de búsqueda según tus criterios
            $query->where('title', 'like', "%$search%")
                    ->orWhere('title_alternative', 'like', "%$search%");
        }

        return $query->paginate(10);
    }

}
