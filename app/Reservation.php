<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';
    protected $fillable = 
        ['user_id',
        'table_id',
        'page_id',
        'date',
        'total',
        'time',
        'number_of_persons'
        ];
    protected $guarded = ['id'];
    public $timestamps = false;

    public function page(){
        return $this->belongsTo('App\Page');
    }

    public function table(){
        return $this->belongsTo('App\Table');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
