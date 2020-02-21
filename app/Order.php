<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps=false;
    protected $fillable=
    [
        'user_id',
        'table_id',
        'page_id',
        'date',
        'status',
        'type',
        'current_location_id',
        'delivery_location_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

}
