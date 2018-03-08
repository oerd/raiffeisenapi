<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $primaryKey = "id_post";
    protected $table = "posts";
    public $timestamps = true;
    protected $fillable = [
        'title', 'cover', 'id_category', 'user_id'
    ];

    public function posts()
    {
        return $this->belongsTo('App\Category', 'id_category');
    }

    public function photos()
    {
        return $this->hasMany('App\PhotoBlog','id_post');
    }

}
