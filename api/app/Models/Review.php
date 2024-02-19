<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($review) {
            $review->slug = Str::slug($review->title);
        });

        static::updating(function ($review) {
            $review->slug = Str::slug($review->title);
        });
    }
    protected $primaryKey = 'review_id';

    protected $fillable = [
        'content_type_id',
        'user_id',
        'title_alternative',
        'description_alternative',
        'data',
        'rating_main',
        'spoiler_content',
        'release_year',
        'release_year_end',
        'quantity_episode',
        'duration_time',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean', // Convertir el campo 'published' a boolean
        'release_year' => 'date',
        'release_year_end' => 'date',
    ];

    public function review()
    {
        return $this->belongsTo(review::class, 'review_id');
    }

    // public function contentType()
    // {
    //     return $this->belongsTo(ContentType::class, 'content_type_id');
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
