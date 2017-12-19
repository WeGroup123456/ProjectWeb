<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\LoaiGiay;
use App\Brand;
use App\BrandLoaiGiay;
use App\MauGiay;
use App\Size;
use Session;

class AjaxController extends Controller
{
    //
    public function getLoaiGiay($idBrand){

    	$brandloaigiay = BrandLoaiGiay::where('brand_id',$idBrand)->get();
    	foreach ($brandloaigiay as $blg) {
    		echo "<option value='".$blg->loaigiay->id."'>".$blg->loaigiay->Ten."</option>";
    	}
    }

    public function getSoLuong($idSize){

    	$size = Size::where('id',$idSize)->get();
    	foreach ($size as $si) {
    		//echo $si->SoLuong;
            echo "<option value='".$si->SoLuong."'>".$si->SoLuong."</option>";
            for ($i=0; $i <= 50; $i++) {
                if ($i == $si->SoLuong) {
                    echo "<option selected value='".$i."'>".$i."</option>";
                }else{
                    echo "<option value='".$i."'>".$i."</option>";
                }
            }
    	}
    	
    }

    public function getSoLuongSize($idSize,$soLuong){

        $size = Size::find($idSize);
        $size->SoLuong = $soLuong;
        $size->save();
        echo "ok";
        
    }

    public function getSoLuong2($idSize){

        $size = Size::where('id',$idSize)->get();
        foreach ($size as $si) {
            echo $si->SoLuong;
        }
        
    }
}
