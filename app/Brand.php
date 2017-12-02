<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
    protected $table = "brand";

    public function loaigiay(){
        /*return $this->belongstoMany('App\LoaiGiay','BrandLoaiGiay','idBrand','idLoaiGiay');*/
    	return $this->belongsToMany('App\LoaiGiay');
    }

    public function giay(){
    	return $this->hasMany('App\Giay','idBrand','id');
    }

    /*public function giay(){
    	return $this->hasManyThrough('App\Giay','App\LoaiGiay','idBrand','idLoaiGiay','id');
    }*/
}
