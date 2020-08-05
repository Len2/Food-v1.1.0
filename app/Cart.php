<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];


        public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }

}
