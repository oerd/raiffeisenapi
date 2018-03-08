<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = "id_category";
    protected $table = "category";
    public $timestamps = true;
    protected $fillable = [
        'title'
    ];

    public function posts()
    {
        return $this->hasMany('App\Post', 'id_category');
    }

}
