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
    
    public function getThem(){
    	$giay = Giay::all();
        $loaigiay = LoaiGiay::all();
        $brand = Brand::all();
    	return view('admin.giay.them',[
            'giay'=>$giay,
            'loaigiay'=>$loaigiay,
            'brand'=>$brand
            ]);
    }

    public function postThem(Request $request){
    	//echo $request->Ten; //Ten nay la name cua tag input
    	$this->validate($request,
    		[
                'Ten' => 'required|min:3|unique:Giay,Ten',
                'TomTat' => 'required',
                'NoiDung' => 'required',
    		],[
                'Ten.required' => 'Bạn chưa nhập tên tiêu đề',
                'TomTat.required' => 'Bạn chưa nhập tóm tắt',
                'NoiDung.required' => 'Bạn chưa nhập nội dung',
    			'Ten.unique' => 'Tên giày đã tồn tại',
    			'Ten.min' => 'Tên giày phải có độ dài từ 3 đến 100 ký tự',
    			'Ten.max' => 'Tên giày phải có độ dài từ 3 đến 100 ký tự',
    		]);

    	$giay = new Giay;
    	$giay->Ten = $request->Ten;
    	$giay->TenKhongDau = changeTitle($request->Ten);
        $giay->TomTat = $request->TomTat;
        $giay->NoiDung = $request->NoiDung;
        $giay->idBrand = $request->Brand;
        $giay->idLoaiGiay = $request->LoaiGiay;

    	$giay->save();

    	return redirect('admin/giay/them')->with('thongbao','Thêm thành công'); // gán thêm session thongbao
    }

    public function getSua($id){
        $brand = Brand::all();
        $loaigiay = LoaiGiay::all();
        $giay = Giay::find($id);
        return view('admin.giay.sua',[
            'giay'=>$giay,
            'brand'=>$brand,
            'loaigiay'=>$loaigiay
            ]);
    }

    public function postSua(Request $request,$id){

        $this->validate($request,
            [
                'TomTat' => 'required',
                'NoiDung' => 'required',
            ],[
                'TomTat.required' => 'Bạn chưa nhập tóm tắt',
                'NoiDung.required' => 'Bạn chưa nhập nội dung',
            ]);

        $giay = Giay::find($id);
        /*$giay->Ten = $request->Ten;
        $giay->TenKhongDau = changeTitle($request->Ten);*/
        $giay->TomTat = $request->TomTat;
        $giay->NoiDung = $request->NoiDung;
        /*$giay->idBrand = $request->Brand;
        $giay->idLoaiGiay = $request->LoaiGiay;*/

        $giay->save();

        return redirect('admin/giay/sua/'.$id)->with('thongbao','Sửa thành công'); // gán thêm session thongbao
    }

    public function getXoa($id){
        $giay = Giay::find($id);

        $maugiay = MauGiay::where('idGiay',$id)->get();

        foreach ($maugiay as $mg) {
            $size = Size::where('mau_giay_id',$mg->id)->get();
            foreach ($size as $si) {
                $si->delete();
            }
            $mg->delete();
        }

        $giay->delete();

        return redirect('admin/giay/danhsach')->with('thongbao','Xóa thành công');
    }
}
