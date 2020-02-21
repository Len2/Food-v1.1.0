<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderTask extends Model
{
    protected $table = 'order_tasks';
    public $timestamps=false;
    protected $fillable=[
      'order_id',
      'users_id',
      'status',
      'description',
  ];
    public function user(){
    	return $this->belongsTo('App\User');

    }

    public function order(){
    	return $this->belongsTo('App\Order');
    }
}
