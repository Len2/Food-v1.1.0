<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public $timestamps=false;
    protected $fillable=
    [
        'product_id',
        'page_id',
        'price',
        'description',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
