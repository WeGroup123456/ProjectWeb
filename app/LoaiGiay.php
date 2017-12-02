<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaiGiay extends Model
{
    //
    protected $table = "loai_giay";

    public function brand(){
    	/*return $this->belongstoMany('App\Brand','brand_loai_giay','loai_giay_id','brand_id');*/
    	return $this->belongsToMany('App\Brand');
    }

    public function giay(){
    	return $this->hasMany('App\Giay','idLoaiGiay','id');
    }
}
