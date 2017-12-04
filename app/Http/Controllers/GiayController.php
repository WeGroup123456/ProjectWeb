<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Giay;
use App\MauGiay;
use App\LoaiGiay;
use App\Brand;
use App\Comment;
use App\Size;
use App\HinhGiay;

class GiayController extends Controller
{
    //
    public function getDanhsach(){

    	$giay = Giay::orderBy('id','DESC')->get();
    	return view('admin.giay.danhsach',['giay'=>$giay]);
    }
}
