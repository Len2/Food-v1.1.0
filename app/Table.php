<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public $timestamps=false;
    protected $fillable=[
        'number',
        'nr_chairs',
        'status',
        'type_of_table',
        'page_id'
    ];
    public function order(){

    	return $this->hasMany('App\Order');
    }

    public function reservation(){
    	return $this->hasMany('App\Reservation');
    }

    public function page(){
    	return $this->belongsTo('App\Page');
    }
}
