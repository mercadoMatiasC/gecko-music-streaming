<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFollow extends Model {
    protected $fillable = [
        'follower_user_id',
        'followed_user_id',
    ];

    protected $table = 'user_follows';
}
