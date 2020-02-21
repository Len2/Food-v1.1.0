<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    protected $table = 'orders_products';
    protected $fillable = [
        'orders_id',
        'product_id',
        'quantity',
        'total',
    ];
    protected $guarded = ['id'];
    public $timestamps = false;

    public function order(){
        return $this->belongsTo('App\Order');
    }

    public function product(){
        return $this->belongsToMany('App\Product');
    }
}
