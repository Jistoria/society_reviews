<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_grade';
    protected $fillable = ['letter', 'value'];

    // Relación muchos a muchos con la tabla reviews a través de la tabla pivote review_grade
    public function user(){
        return $this->belongsToMany(User::class,'review_grade','id_grade','id_user');
    }
    public function reviews()
    {
        return $this->belongsToMany(Review::class, 'review_grade', 'id_grade', 'id_review');
    }
    //funcion para buscar con letter
    public function getRouteKeyName()
    {
        return 'letter';
    }
}
