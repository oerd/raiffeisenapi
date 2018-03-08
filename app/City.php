<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $primaryKey = "id_city";
    protected $table = "city";
    public $timestamps = false;
    protected $fillable = [
        'city',
    ];

    public function cityOffer()
    {
        return $this->hasMany('App\Offer', 'city_id');
    }
}
