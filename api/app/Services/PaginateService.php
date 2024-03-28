<?php

namespace App\Services;

use App\Models\Franchise;
use App\Models\Review;
use Illuminate\Http\Request;

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
    public function paginate($search = null, Request $request)
{
    try {
        $query = $this->reviewModel::with([
            'franchise:franchise_id,title,slug,image_url',
            'franchise.tags:tag_id,name_tag',
            'contentType:content_type_id,type',
            'user:id,name'
        ])
        ->select('review_id', 'franchise_id', 'content_type_id','user_id', 'title_alternative', 'rating_main', 'slug')
        ->where('published', true);

        // Búsqueda con el título de franquicia
        $query->whereHas('franchise', function($query) use($search) {
            $query->when($search, function($query) use ($search) {
                $query->where('title','like',"%$search%")
                ->orWhere('title_alternative','like',"%$search%");
            });
        });

        // Filtro con tags
        $query->when($tags = $request->input('tags'), function ($query) use ($tags) {
            $query->whereHas('franchise.tags', function ($query) use ($tags) {
                $query->whereIn('tags.tag_id', $tags)
                    ->groupBy('review_id')
                    ->havingRaw('COUNT(*) = ?', [count($tags)]);
            });
        });
        //Filtro con autor
        $query->when($author = $request->input('authors'),function ($query) use($author){
            $query->whereHas('user', function ($query) use ($author) {
                $query->where('id',$author)
                ->groupBy('review_id');
            });
        });
        //Filtrar con tipo de contenido
        $query->when($content = $request->input('content_type'),function ($query) use($content){
            $query->whereHas('user', function ($query) use ($content) {
                $query->whereIn('content_type_id',$content)
                ->groupBy('review_id');
            });
        });
        //Filtrar por el rating promediado

        // ->when($request->input('time'))

        return $query->paginate(10);
    } catch (\Exception $e) {
        // Manejar el error aquí
        // Por ejemplo, puedes registrar el error o devolver un mensaje de error
        return response()->json(['error' => 'Hubo un error al procesar la solicitud', 'e'=>$e], 500);
    }
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
