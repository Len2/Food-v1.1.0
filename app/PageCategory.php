<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageCategory extends Model
{

	protected $table = 'page_categories';
    protected $fillable=
    [
     'page_id',
     'category_id',
     'displayName',
    ]; 

    public function category(){
      return $this->belongsTo('App\Category');
    }

    public function page(){
      return $this->belongsTo('App\Page');
    }
}
