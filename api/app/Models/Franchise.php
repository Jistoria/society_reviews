<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Franchise extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($franchise) {
            $franchise->slug = Str::slug($franchise->title);
        });

        static::updating(function ($franchise) {
            $franchise->slug = Str::slug($franchise->title);
        });
    }
    protected $primaryKey = 'franchise_id'; // Definir clave primaria personalizada si es diferente de 'id'
    protected $hidden = ['pivot'];
    protected $fillable = [
        'title',
        'title_alternative',
        'description',
        'animation_studio_latest',
        'image_url',
        'author',
        'original_work',
        'franchise_rating',
        'first_release',
        'end_release',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'franchise_tag', 'franchise_id', 'tag_id')->withTimestamps();
    }
    // Puedes definir relaciones con otros modelos aquí, por ejemplo:
    public function reviews()
    {
        return $this->hasMany(Review::class, 'franchise_id');
    }

    //FUNCION PARA LA HUEVADA DE RATINGS DIOSITO SEPA QUE ESPERO QUE FUNCIONE, SI NO ME MATO
    public function updateRating()
    {
        // Obtener todas las rating_main de las reviews asociadas a esta franquicia
        $ratings = $this->reviews->pluck('rating_main');

        // Calcular el promedio de las rating_main
        $avgRating = $ratings->avg();

        // Actualizar el campo franchise_rating con el promedio calculado
        $this->update(['franchise_rating' => $avgRating]);
    }
}
