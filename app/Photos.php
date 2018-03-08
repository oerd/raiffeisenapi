<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    protected $primaryKey = "id_photo";
    protected $table = "photos";
    protected $fillable = [
        'photo', 'offer_id'
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

    public function photoOffer()
    {
        return $this->belongsTo('App\Offer', 'offer_id');
    }

}