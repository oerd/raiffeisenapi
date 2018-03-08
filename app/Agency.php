<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $primaryKey = "id_agency";
    protected $table = "agency";
    public $timestamps = false;
    protected $fillable = [
        'name', 'url', 'address', 'user_id'
    ];

    public function agencyuser()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
