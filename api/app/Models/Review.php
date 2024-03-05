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
            $review->slug = Str::slug($review->title_alternative);
        });

        static::updating(function ($review) {
            $review->slug = Str::slug($review->title_alternative);
        });
    }
    protected $primaryKey = 'review_id';

    protected $fillable = [
        'franchise_id',
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
        'notify'
    ];

    protected $casts = [
        'notify' => 'boolean',
        'published' => 'boolean', // Convertir el campo 'published' a boolean
        'release_year' => 'date',
        'release_year_end' => 'date',
    ];

    public function dataNotify()
    {
        return [
            'title' =>$this->franchise->title,
            'title_alternative'=>$this->title_alternative,
            'name'=>$this->user->name,
            'type'=>$this->contentType->type,
            'slug'=>$this->slug,
        ];

    }
    public function franchise()
    {
        return $this->belongsTo(Franchise::class, 'franchise_id');
    }

    public function contentType()
    {
        return $this->belongsTo(ContentType::class, 'content_type_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function indexData()
    {
        return self::with('franchise:franchise_id,title','contentType:content_type_id,type')
        ->select('review_id','title_alternative','slug','rating_main','published','franchise_id','content_type_id')->get();
    }
    // public function dataIndex()
    // {
    //     return [
    //         'review_id'=> $this->id_review,
    //         'title_alternative' => $this->title_alternative,
    //         'slug' => $this->slug,
    //         'franchise_id'=> $this->franchise_id,
    //         'franchise_title'=> $this->franchise->title,
    //         'rating_main'=> $this->rating_main,
    //         'published'=> $this->published
    //     ];
    // }
}
