<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Review extends Model
{
    use HasFactory;
    use Searchable;
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reviews';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_review';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_admin',
        'titulo',
        'titulo2',
        'imagen',
        'sinopsis',
        'contenido',
        'slug',
    ];

//FUNCIONES PROPIAS DEL REVIEW
    public function scopeBySlug($query, $slug)
    {
        return $query->where('slug', $slug)->first();
    }
 /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        // Customize the data array...

        return [
            'titulo' => $this->titulo,
            'titulo2'=> $this->titulo2,
        ];
    }



//FUNCIONES DE RELACIONES
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'review_tag', 'review_id', 'tag_id');
    }
    public function grades()
    {
        return $this->belongsToMany(Grade::class, 'review_grade', 'id_review', 'id_grade');
    }
    public function grade_master (){
        return $this->belongsToMany(Grade::class, 'review_grade', 'id_review', 'id_grade')
        ->where('id_admin', $this->admin->id_admin)  ->value('letter');
    }
    public function pivot_admin(){
        return $this->belongsToMany(UsersAdmin::class, 'review_grade', 'id_review', 'id_admin');
    }
    public function admin()
    {
        return $this->belongsTo(UsersAdmin::class, 'id_admin', 'id_admin');
    }
    public function user()
    {
        return $this->belongsToMany(User::class, 'review_grade', 'id_review', 'id_user');
    }
    public function calificacion_final()
    {
          // Calcula el promedio de las calificaciones de usuarios utilizando el método avg de la relación userGrades
        $promedio = $this->userGrades()->avg('value');
        return $promedio ?: 'N/A';
    }
    public function userGrades()
{
    return $this->belongsToMany(Grade::class, 'review_grade', 'id_review', 'id_grade')
                ->wherePivot('id_admin', null); // Filtra solo calificaciones de usuarios
}
    public function comments(){
        return  $this->hasMany(Comentario::class, 'id_review', 'id_review');
    }
}
