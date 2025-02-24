<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 
        'bio', 
        'profile_picture', 
        'social_links'
    ];

    public function blogs()
    {
        return $this->hasMany(Post::class);
    }
}