<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps=false;
    protected $fillable=[
    	'name',
    	'description',
        'price',
    	'category_id',
        'page_id',
        'image'
    ];
    
    public function pageCategory(){
    	return $this->belongsTo('App\PageCategory');
    }

        public function page(){
        return $this->belongsTo('App\Page');
    }

    public function orderProducts(){
    	return $this->hasMany('App\OrderProducts');
    }
    
    public function offer(){
        return $this->hasMany('App\Offer');
    }
}
