<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAgent extends Model
{
    protected $primaryKey = "id_bankAgent";
    protected $table = "bankAgent";
    public $timestamps = false;
    protected $fillable = [
        'name', 'phone', 'email',
    ];

    public function agentOffer()
    {
        return $this->hasMany('App\Offer', 'bankAgent_id');
    }
}
