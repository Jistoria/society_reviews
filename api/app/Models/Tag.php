<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $primaryKey ='tag_id';

    protected $fillable=[
        'name_tag',
        'description'
    ];

    public function franchises()
    {
        return $this->belongsToMany(Franchise::class, 'franchise_tag', 'tag_id', 'franchise_id')->withTimestamps();
    }
}
