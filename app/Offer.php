<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Offer extends Model
{
    protected $geofields = array('location');
    protected $primaryKey = "id_offer";
    protected $table = "offers";
    public $timestamps = false;
    protected $fillable = [
        'name',
        'address',
        'description',
        'euro',
        'leke',
        'note',
        'active',
        'city_id',
        'type_id',
        'user_id',
        'location',
        'bankAgent_id',
        'latitude',
        'longitude',
        'bedrooms',
        'bathrooms',
        'parking_spaces',
        'size',
        'air_conditioning',
        'heating',
        'secure_parking',
        'solar_panel',
        'water_tank',
        'floor_plan',
        'hipotek'
    ];


    public function offerUser()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function offerCity()
    {
        return $this->belongsTo('App\City', 'city_id');
    }

    public function offerAgent()
    {
        return $this->belongsTo('App\BankAgent', 'bankAgent_id');
    }

    public function offerType()
    {
        return $this->belongsTo('App\Type', 'type_id');
    }

    public function photos()
    {
        return $this->hasMany('App\Photos', 'offer_id');
    }
}
