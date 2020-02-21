<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $table = 'gallery_images';
    protected $fillable =
    [
        'page_id',
        'user_id',
        'album_id',
        'photo',
    ];

    protected $guarded = ['id'];
    public $timestamps = false;

    public function album(){
        return $this->belongsTo('App\Albums');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function page(){
        return $this->belongsTo('App\Page');
    }
}
