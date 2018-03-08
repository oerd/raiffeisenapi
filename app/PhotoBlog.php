<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoBlog extends Model
{
    protected $primaryKey = "id_photo";
    protected $table = "blog_photo";
    public $timestamps = true;
    protected $fillable = [
        'photo', 'id_post'
    ];

    protected $appends = ['photo_path'];

    public function getPhotoPathAttribute($value)
    {
        $value =  asset("/storage");
        $val = public_path('uploads');
//        $value = base_path().'/public/uploads';
//        $value = "https://www.shtepiaime.al/storage/";
        return $this->attributes['photo_path'] = $value . '/';
    }

    public function photos()
    {
        return $this->belongsTo('App\Post', 'id_post');
    }

}
