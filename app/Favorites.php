<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    protected $primaryKey = "id";
    protected $table = "favorites";
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'favorite_id',
    ];

    public function userFavorite()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function offer()
    {
        return $this->belongsTo('App\Offer', 'favorite_id');
    }
}
