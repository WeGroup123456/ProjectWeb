<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Brand;
use App\LoaiGiay;
use App\BrandLoaiGiay;

class LoaiGiayController extends Controller
{
     public function getDanhsach(){
    	$loaigiay = LoaiGiay::all();

    	return view('admin.loaigiay.danhsach',['loaigiay'=>$loaigiay]);
    }

    public function getThem(){
        $loaigiay = LoaiGiay::all();
        $brand = Brand::all();
    	return view('admin.loaigiay.them',['loaigiay'=>$loaigiay,'brand'=>$brand]);
    }

    public function postThem(Request $request){
    	//echo $request->Ten; //Ten nay la name cua tag input
    	/*$this->validate($request,
    		[
    			'Ten' => 'required|min:3|max:100',
                'Brand' => 'required'
    		],[
    			'Ten.required' => 'Bạn chưa nhập tên loại giày',
    			'Ten.min' => 'Tên loại giày phải có độ dài từ 3 đến 100 ký tự',
    			'Ten.max' => 'Tên loại giày phải có độ dài từ 3 đến 100 ký tự',
                'Brand.required' => 'Bạn chưa chọn hãng',
    		]);*/

    	/*$loaigiay = new LoaiGiay;
    	$loaigiay->Ten = $request->Ten;
    	$loaigiay->TenKhongDau = changeTitle($request->Ten);

        $loaigiay->save();*/
        $exist = BrandLoaiGiay::where('brand_id',$request->Brand)->where('loai_giay_id',$request->LoaiGiay)->get();

        if(isset($exist[0])){
            return redirect('admin/loaigiay/them')->with('thatbai','Đã tồn tại');
        }else{
            $brandloaigiay = new BrandLoaiGiay;
            $brandloaigiay->brand_id = $request->Brand;
            $brandloaigiay->loai_giay_id = $request->LoaiGiay;

            
            $brandloaigiay->save();

            return redirect('admin/loaigiay/them')->with('thongbao','Thêm thành công');
        }
        /*$brandloaigiay = new BrandLoaiGiay;
        $brandloaigiay->brand_id = $request->Brand;
        $brandloaigiay->loai_giay_id = $request->LoaiGiay;

    	
        $brandloaigiay->save();

    	return redirect('admin/loaigiay/them')->with('thongbao','Thêm thành công'); // gán thêm session thongbao*/
    }

    public function getThemMoi(){
        return view('admin.loaigiay.themmoi');
    }

    public function postThemMoi(Request $request){
        $this->validate($request,
            [
                'Ten' => 'required|min:3|max:100',
            ],[
                'Ten.required' => 'Bạn chưa nhập tên loại giày',
                'Ten.min' => 'Tên loại giày phải có độ dài từ 3 đến 100 ký tự',
                'Ten.max' => 'Tên loại giày phải có độ dài từ 3 đến 100 ký tự',
            ]);

        $loaigiay = new LoaiGiay;
        $loaigiay->Ten = $request->Ten;
        $loaigiay->TenKhongDau = changeTitle($request->Ten);

        $loaigiay->save();

        return redirect('admin/loaigiay/themmoi')->with('thongbao','Thêm thành công');
    }

    public function getSua($id){
        $brand = Brand::all();
    	$loaigiay = LoaiGiay::find($id);
    	return view('admin.loaigiay.sua',['loaigiay'=>$loaigiay,'brand'=>$brand]);
    }

    public function postSua(Request $request,$id){
    	
    	$this->validate($request,
            [
                'Ten' => 'required|min:3|max:100',
                'Brand' => 'required'
            ],[
                'Ten.required' => 'Bạn chưa nhập tên loại giày',
                /*'Ten.unique' => 'Tên loại giày đã tồn tại',*//*|unique:loai_giay,Ten*/
                'Ten.min' => 'Tên loại giày phải có độ dài từ 3 đến 100 ký tự',
                'Ten.max' => 'Tên loại giày phải có độ dài từ 3 đến 100 ký tự',
                'Brand.required' => 'Bạn chưa chọn hãng',
            ]);

        $loaigiay = LoaiGiay::find($id);
    	$loaigiay->Ten = $request->Ten;
        $loaigiay->TenKhongDau = changeTitle($request->Ten);

        $loaigiay->save();
        
        
        foreach ($loaigiay->brand as $element) {
            $brand_id = $element->id;
        }

        $brandloaigiay = BrandLoaiGiay::where('brand_id',$brand_id)->where('loai_giay_id',$loaigiay->id)->get();
        
        /*foreach ($brandloaigiay as $brand_loai_giay) {
            $brand_loai_giay->brand_id = $request->Brand;
            $brand_loai_giay->loai_giay_id = $loaigiay->id;
        }*/

        $brandloaigiay[0]->brand_id = $request->Brand;
        $brandloaigiay[0]->loai_giay_id = $loaigiay->id;

        
        $brandloaigiay[0]->save();
        
    	return redirect('admin/loaigiay/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id){
        $brandloaigiay = BrandLoaiGiay::where('loai_giay_id',$id);
        $brandloaigiay->delete();

    	$loaigiay = LoaiGiay::find($id);
    	$loaigiay->delete();

    	return redirect('admin/loaigiay/danhsach')->with('thongbao','Xóa thành công');
    }
}
