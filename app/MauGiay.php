<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MauGiay extends Model
{
    //
    protected $table = "maugiay";

    public function giay(){
    	return $this->belongsTo('App\Giay','idGiay','id');
    }

    public function hinhgiay(){
    	return $this->hasMany('App\HinhGiay','mau_giay_id','id');
    }

    public function size(){
    	return $this->hasMany('App\Size','mau_giay_id','id');
    }
}
