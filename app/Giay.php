<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Giay extends Model
{
    //
    protected $table = "giay";

    public function maugiay(){
    	return $this->hasMany('App\MauGiay','idGiay','id');
    }

    public function brand(){
    	return $this->belongsTo('App\Brand','idBrand','id');
    }

    public function loaigiay(){
    	return $this->belongsTo('App\LoaiGiay','idLoaiGiay','id');
    }
}
