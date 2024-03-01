<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $primaryKey = 'comment_id';
    protected $table = 'comments';
    protected $fillable = [
        'user_id',
        'content',
        'review_id',
        'com_comment_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function review()
    {
        return $this->belongsTo(Review::class,'review_id');
    }
    public function replies()
    {
        return $this->hasMany(Comment::class, 'com_comment_id');
    }

    /**
     * Define la relación para el comentario padre.
     */
    public function parentComment()
    {
        return $this->belongsTo(Comment::class, 'com_comment_id');
    }
    public function notifyComment()
    {
        return [
            'title' =>$this->review->title_alternative,
            'name' => $this->user->name,
            'slug'=>"{$this->review->franchise->slug}/{$this->review->slug}"
        ];
    }


}
