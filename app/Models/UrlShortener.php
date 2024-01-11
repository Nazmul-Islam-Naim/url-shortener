<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UrlShortener extends Model
{
    protected $fillable = [
        'long_url', 'short_url', 'count', 'user_id'
    ];

    //relations
    public function user() {
        return $this->belongsTo(User::class);
    }
}
