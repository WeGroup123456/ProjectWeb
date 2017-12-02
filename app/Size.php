<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    //
    protected $table = "size";

    public function maugiay(){
    	return $this->belongsTo('App\MauGiay','mau_giay_id','id');
    }
}
