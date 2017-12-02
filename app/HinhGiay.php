<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HinhGiay extends Model
{
    //
    protected $table = "hinh_giay";

    public function maugiay(){
    	return $this->belongsTo('App\MauGiay','mau_giay_id','id');
    }
}
