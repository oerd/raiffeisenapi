<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    protected $primaryKey = "id_types";
    protected $table = "types";
    public $timestamps = false;
    protected $fillable = [
        'type', 'file',
    ];

    public function typeOffer()
    {
        return $this->hasMany('App\Offer', 'type_id');
    }
}
