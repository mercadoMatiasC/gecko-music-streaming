<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['username', 'email', 'password', 'profile_image_route'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //INFORMATION
    public function isAdmin() {
        return $this->is_admin;
    }

    //RELATIONSHIPS
    public function uploadedArtists() {
        return $this->hasMany(Artist::class, 'uploader_id');
    }

    public function uploadedAlbums() {
        return $this->hasMany(Album::class, 'uploader_id');
    }

    public function followers() {
        return $this->belongsToMany(User::class, 'user_follows', 'followed_user_id', 'follower_user_id')->withTimestamps();
    }

    public function following() {
        return $this->belongsToMany(User::class, 'user_follows', 'follower_user_id', 'followed_user_id')->withTimestamps();
    }

    public function playlists() {
        return $this->hasMany(Playlist::class, 'owner_id');
    }

    public function reports(): HasMany {
        return $this->hasMany(Report::class, 'reporter_id');
    }

    public function hostedChannel(): HasOne {
        return $this->hasOne(Channel::class, 'host_id');
    }
}