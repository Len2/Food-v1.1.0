<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


//    public function page()
//    {
//        return $this->belongsTo(Page::class);
//    }

//    public function orderProducts()
//    {
//        return $this->hasMany(OrderProducts::class);
//    }
//
//    public function category()
//    {
//        return $this->belongsTo(Category::class);
//    }
//
//    public function orders()
//    {
//        return $this->belongsToMany(Order::class);
//    }
//
//    public function offers()
//    {
//        return $this->hasMany(Offer::class);
//    }

//    public function pageCategory()
//    {
//        return $this->belongsTo(PageCategory::class);
//    }
//
//    public function userLikes()
//    {
//        return $this->hasMany(UserLike::class);
//    }
}
