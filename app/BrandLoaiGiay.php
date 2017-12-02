<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrandLoaiGiay extends Model
{
    //
    protected $table = "Brand_Loai_Giay";

    public function brand(){
    	return $this->belongsTo('App\Brand','brand_id','id');
    }

    public function loaigiay(){
    	return $this->belongsTo('App\LoaiGiay','loai_giay_id','id');
    }
}
