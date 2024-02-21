<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentType extends Model
{
    use HasFactory;
    protected $primaryKey = 'content_type_id';
    protected $fillable = ['type'];

    public function reviews()
    {
        return $this->hasMany(Review::class, 'content_type_id');
    }
}
