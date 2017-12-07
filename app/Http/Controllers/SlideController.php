<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Slide;

class SlideController extends Controller
{
    public function getDanhsach(){
    	$slide = Slide::all();
    	return view('admin.slide.danhsach',['slide'=>$slide]);
    }
}
