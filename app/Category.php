<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps=false;
    protected $fillable=[
    	'name',
    	'image'
 	];

 	public function pageCategory(){
 	 	return $this->hasMany('App\PageCategory');
 	}
}
