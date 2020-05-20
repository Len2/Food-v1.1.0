<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

//    public function products()
//    {
//        return $this->belongsToMany(Product::class)
//    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function carts(){
        return $this->hasMany(Cart::class);
    }
//    public function table()
//    {
//        return $this->belongsTo(Table::class);
//    }
//
//    public function address()
//    {
//        return $this->belongsTo(Address::class);
//    }

//    public function invoices()
//    {
//        return $this->hasMany(Invoice::class);
//    }
}
