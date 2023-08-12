<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Grade;
use App\Models\Review;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReviewController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //este index aun no lo uso, tal vez para la vista de reseña normal
    public function index()
    {
        $reviews = Review::all();
        return view('reviews.index', compact('reviews'));
    }
//la funcion fumada de la vista para crear un review, lean vien esta vaina es brujeria
public function create_review($review = null)
{
    //genero los grades
    $grades = Grade::get();
    //genero todos los tags
    $tags = Tag::get();
    //comprobamos si viene un valor de para editar
    if ($review) {
        // Si se proporciona un ID, intentamos obtener la reseña desde la base de datos
        $review_edit = Review::find($review);

        // Verificamos si encontramos la reseña
        if ($review_edit) {
            // Si encontramos la reseña, obtenemos las etiquetas asociadas a ella
            $reviewTags = $review_edit->tags;
            $reviewGrades = $review_edit->grades;

            // Pasamos a la vista tanto la reseña como las etiquetas, se pasan todas la tags y las tags que son del review
            return view('reviews.create_review', compact('review_edit', 'tags', 'reviewTags','grades','reviewGrades'));
        } else {
            // Si no encontramos la reseña, redireccionamos o mostramos un mensaje de error
            return redirect()->route('reviews.index')->with('error', 'Reseña no encontrada.');
        }
    } else {
        // Si no se proporciona un ID, la vista se utilizará para crear una nueva reseña
        return view('reviews.create_review', compact('tags','grades'));
    }
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request)
    {
        // Convertir el título en un slug
        $slug = Str::slug($request->input('titulo'));
        // Agregar el slug a los datos de la reseña antes de crearla
        $data = $request->all();
        $data['slug'] = $slug;
        // Crear la reseña con los datos actualizados
        $review = Review::create($data);
        // Obtener las etiquetas del formulario (si existen)
        $tags = $request->input('tags');
        // Asociar las etiquetas con la reseña (si hay etiquetas seleccionadas)
        if ($tags && is_array($tags)) {
            foreach ($tags as $tagName) {
                // Buscar o crear la etiqueta por su nombre
                $tag = Tag::firstOrCreate(['name_tag' => $tagName]);
                // Asociar la etiqueta con la reseña
                $review->tags()->attach($tag);
            }
        }

        // Obtener la calificación del formulario (si existe)
        $grade = $request->input('grade');

        // Obtener el ID del administrador o usuario que está realizando la calificación (si existe)
        $idAdmin = $request->input('id_admin');
        $idUser = $request->input('id_user');
        // Asociar la calificación con la reseña (si hay una calificación seleccionada)
        if ($grade) {
            // Buscar calificación por su letra
            $c_grade = Grade::where('letter', $grade)->first();
            // Asociar la calificación con la reseña usando attach() y los ID de administrador o usuario
            if ($idAdmin) {
                $review->grades()->attach($c_grade, ['id_admin' => $idAdmin]);
            } elseif ($idUser) {
                $review->grades()->attach($c_grade, ['id_user' => $idUser]);
            }
        }
        return redirect()->route('table_reviews')
            ->with('success', 'Reseña creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show_table()
    {
        $reviews = Review::pluck('titulo', 'id_review');
        // dd($reviews);
        return view('reviews.show_table', compact('reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $reviews)
    {
        return view('reviews.edit', compact('reviews'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    //actualizar la reseña como admin, se puede separa varias funcionalidades para que no se vea tan compleja
    public function update(Request $request, Review $review)
    {
        // Convertir el título en un slug
        $slug = Str::slug($request->input('titulo'));
        // Agregar el slug a los datos de la reseña antes de actualizarla
        $data = $request->all();
        $data['slug'] = $slug;
        // Actualizar la reseña con los datos actualizados
        $review->update($data);
        // Obtener las etiquetas del formulario (si existen)
        $tags = $request->input('tags');
        // Sincronizar las etiquetas con la reseña (si hay etiquetas seleccionadas)
        if ($tags && is_array($tags)) {
            $tagIds = [];
            foreach ($tags as $tagName) {
                // Buscar o crear la etiqueta por su nombre
                $tag = Tag::firstOrCreate(['name_tag' => $tagName]);
                $tagIds[] = $tag->id_tag;
            }
            // Sincronizar las etiquetas con la reseña
            $review->tags()->sync($tagIds);
        } else {
            // Si no hay etiquetas seleccionadas, desasociar todas las etiquetas de la reseña
            $review->tags()->detach();
        }
        // Obtener la calificación del formulario (si existe)
        $grade = $request->input('grade');
        // Obtener el ID del administrador o usuario que está realizando la calificación (si existe)
        $idAdmin = $request->input('id_admin');
        $idUser = $request->input('id_user');
        // Asociar la calificación con la reseña (si hay una calificación seleccionada)
        if ($grade) {
            // Buscar calificación por su letra
            $c_grade = Grade::where('letter', $grade)->first();
            // Asociar la calificación con la reseña usando attach() y los ID de administrador o usuario
            if ($idAdmin) {
                $review->pivot_admin()->syncWithoutDetaching([ $idAdmin=> ['id_grade' => $c_grade->id_grade ]]);
            } elseif ($idUser) {
                $review->user()->syncWithoutDetaching([$idUser => ['id_grade' => $c_grade->id_grade ]]);
            }
        } else {
            // Si no hay calificación seleccionada, desasociar todas las calificaciones de la reseña
            $review->grades()->detach();
        }
        return redirect()->route('table_reviews')
            ->with('success', 'Reseña actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('table_reviews')
            ->with('success', 'Reseña eliminada exitosamente.');
    }
    //Funcion para mostrar la reseña, se usa un slug de forma que queda mejor la url
    public function show($slug)
    {
        // Obtener la reseña por el slug
        $review = Review::bySlug($slug);
        $grades = Grade::all();
        // Verificar si se encontró la reseña
        if ($review) {
            // Obtener la calificación final
            $calificacion_final = $review->calificacion_final();
            return view('reviews.review_index', compact('review', 'grades','calificacion_final'));
        } else {
            // Si no se encontró la reseña, redireccionar o mostrar un mensaje de error
            return redirect()->route('reviews.index')->with('error', 'Reseña no encontrada.');
        }
    }
    //nota: tal vez separa el update_calificar para que la funcion no se vea tan compleja
    //Funcion para calificar la reseña siendo usuario, puede estar en user la funcion
    public function calificar_review(Request $request, $slug)
    {
        $idUser = auth()->user()->id_user; // Obtener el ID del usuario autenticado
        $grade = $request->input('grade');//obtener la letra que se paso en el request
        $review = Review::whereSlug($slug)->firstOrFail();//encontrar la reseña calificada
        if ($grade && $review) {
            // Buscar calificación por su letra
            $c_grade = Grade::where('letter', $grade)->firstOrFail();
            if (!$review->user()->wherePivot('id_user', $idUser)->exists()) {
                $review->user()->syncWithoutDetaching([
                    $idUser => [
                        'id_grade' => $c_grade->id_grade,
                        ],
                ]);
                return redirect()->back()->with('success', 'Reseña calificada exitosamente.');
            } else {
                //logica para cambiar la calificacion
                $new_grade = $c_grade->id_grade; //agregamos la id de la calificacion a una variable
                // funcion sync sin hacer un detach, donde se relaciona muchos a muchos review con user, de forma que nos da el pivot
                $review->user()->syncWithoutDetaching([$idUser =>['id_grade' => $new_grade]]);//le pasamos la fk idUser, y el arreglo del valor a cambiar
                return redirect()->back()->with('success', 'Se ha cambiado la calificacion que le diste');
            }
        } else {
        return redirect()->back()->with('error', 'Error al calificar la reseña.');
    }
    }
}
