<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interes extends Model
{
    protected $primaryKey = "id_interes";
    protected $table = "interes";
    public $timestamps = false;
    protected $fillable = [
        'first_year',
        'next_years',
        'active'
    ];
}
