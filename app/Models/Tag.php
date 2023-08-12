<?php

namespace App\Models;
use App\Observers\TagObserver;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
 /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_tag';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_tag',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id_tag' => 'integer',
    ];

    /**
     * The reviews that belong to the tag.
     */
    public function toSearchableArray(): array
    {
        // Customize the data array...
        return [
            'name_tag' => $this->name_tag,
        ];
    }

    public function reviews()
    {
        return $this->belongsToMany(Review::class, 'review_tag', 'tag_id', 'review_id');
    }
    public function getRouteKeyName()
    {
        // Utilizar el campo 'name_tag' como clave para las rutas en lugar del campo 'id_tag'
        return 'name_tag';
    }


}
