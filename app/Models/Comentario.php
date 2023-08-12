<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_comentario';
    protected $fillable = ['id_user', 'comen_id', 'id_review', 'contenido', 'created_at'];

    public $timestamps = false;
    // Relación con el usuario que hizo el comentario
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Relación con el comentario padre (si existe)
    public function comentarioPadre()
    {
        return $this->belongsTo(Comentario::class, 'comen_id', 'id_comentario');
    }

    // Relación con la reseña a la que pertenece el comentario
    public function review()
    {
        return $this->belongsTo(Review::class, 'id_review', 'id_review');
    }

    // Relación con los comentarios hijos
    public function comentariosHijos()
    {
        return $this->hasMany(Comentario::class, 'comen_id', 'id_comentario');
    }
}
