<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';
    protected $fillable = 
        ['user_id',
        'order_product_id',
        'page_id',
        'total',
        'description',
        'date',
        'status',
        'payment_method'];

    protected $guarded = ['id'];
    public $timestamps = false;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function orderProducts(){
        return $this->belongsTo('App\OrderProducts');
    }

    public function page(){
        return $this->belongsTo('App\Page');
    }
}
