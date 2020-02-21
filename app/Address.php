<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
     
    public $timestamps=false;
    protected $table = 'addresses';
	protected $fillable=[

        'longitude',
        'latitude',
        'city',
        'street',
        'description',
        'zipcode'

    ];
    
    public function user(){
		return $this->hasMany('App\User');
	}

	  public function order_currentaddress(){
        return $this->hasMany('App\Order');
    }

     public function order_deliveryaddress(){
    	return $this->hasMany('App\Order');
    }
}
