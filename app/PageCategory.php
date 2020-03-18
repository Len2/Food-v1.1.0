<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageCategory extends Model
{
    protected $table = 'page_categories';
    public $timestamps = false;
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
