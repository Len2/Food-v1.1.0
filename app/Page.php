<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function categories() //important
    {
        return $this->hasMany(Category::class);
    }

//
//    public function tables()
//    {
//        return $this->hasMany(Table::class);
//    }
//
//    public function orders()
//    {
//        return $this->hasMany(Order::class);
//    }
//
//    public function offers()
//    {
//        return $this->hasMany(Offer::class);
//    }
//
//    public function reservations()
//    {
//        return $this->hasMany(Reservation::class);
//    }
//

//
//    public function invoices()
//    {
//        return $this->hasMany(Invoice::class);
//    }
//
//    public function taskLists()
//    {
//        return $this->hasMany(TaskList::class);
//    }
//
//    public function address()
//    {
//        return $this->belongsTo(Address::class);
//    }
//
//    public function pageUsers()
//    {
//        return $this->hasMany(PageUser::class);
//    }
//
//    public function pageFollowers()
//    {
//        return $this->hasMany(PageFollowers::class);
//    }
//
//    public function galleryImages()
//    {
//        return $this->hasMany(GalleryImage::class);
//    }
}
