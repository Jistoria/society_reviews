<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Franchise extends Model
{
    use HasFactory;

    protected $primaryKey = 'franchise_id'; // Definir clave primaria personalizada si es diferente de 'id'

    protected $fillable = [
        'title',
        'description',
        'animation_studio_latest',
        'image_url',
        'author',
        'original_work',
        'publication_year',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'franchise_tag', 'franchise_id', 'tag_id')->withTimestamps();
    }
    // Puedes definir relaciones con otros modelos aquí, por ejemplo:
    // public function reviews()
    // {
    //     return $this->hasMany(Review::class, 'franchise_id');
    // }
}
