<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public $timestamps=false;
	protected $fillable=[
        'name',
        'description',
        'workingTime',
        'phoneNumber',
        'address_id'
    ];

  	public function invoice(){
		return $this->hasMany('App\Invoice');
	}
    
	public function offer(){
		return $this->hasMany('App\Offer');
	}

    public function order(){
		return $this->hasMany('App\Order');
	}
    public function reservation(){
	    return $this->hasMany('App\Reservation');
    }

	public function table(){
		return $this->hasMany('App\Table');
	}

	public function taskList(){
		return $this->hasMany('App\TaskList');
	}
}
