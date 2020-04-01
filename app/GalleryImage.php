<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $table = 'gallery_images';
    protected $guarded = [];

    public function page()
    {
        return $this->hasOne(Page::class);
    }

//    public function user()
//    {
//        return $this->belongsTo(User::class);
//    }
//
//    public function album()
//    {
//        return $this->belongsTo(Album::class);
//    }
}
