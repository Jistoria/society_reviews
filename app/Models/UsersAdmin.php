<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UsersAdmin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users_admins';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'color',
        'enabled',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'enabled' => 'boolean',
    ];
}
