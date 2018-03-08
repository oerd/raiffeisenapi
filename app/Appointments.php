<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    protected $primaryKey = "id_appointments";
    protected $table = "appointments";
    public $timestamps = false;
    protected $fillable = [
        'title',
        'name',
        'lastname',
        'phone',
        'birthday',
        'email',
        'liked',
        'preferences',
        'description',
        'postcode',
        'subscribe',
        'interes'
    ];
}
