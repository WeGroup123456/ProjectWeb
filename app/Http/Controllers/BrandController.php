<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Brand;
use App\LoaiGiay;

class BrandController extends Controller
{
    public function getDanhsach(){
    	$brand = Brand::all();
    	return view('admin.brand.danhsach',['brand'=>$brand]);
    }

    public function getThem(){
    	return view('admin.brand.them');
    }

    public function postThem(Request $request){
    	//echo $request->Ten; //Ten nay la name cua tag input
    	$this->validate($request,
    		[
    			'Ten' => 'required|unique:Brand,Ten|min:1|max:100',
                'MoTa' => 'required',
                'Hinh' => 'required'
    		],[
    			'Ten.required' => 'Bạn chưa nhập tên hãng',
    			'Ten.unique' => 'Tên hãng đã tồn tại',
    			'Ten.min' => 'Tên hãng phải có độ dài từ 1 đến 100 ký tự',
    			'Ten.max' => 'Tên hãng phải có độ dài từ 1 đến 100 ký tự',
                'MoTa.required' => 'Bạn chưa nhập mô tả',
                'Hinh.required' => 'Bạn chưa nhập hình ảnh',
    		]);

    	$brand = new Brand;
    	$brand->Ten = $request->Ten;
    	$brand->TenKhongDau = changeTitle($request->Ten);
        $brand->MoTa = $request->MoTa;

        if ($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
                return redirect('admin/brand/them')->with('loi','Bạn chỉ được chọn file có đuôi jpg,jpeg,png');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/brand/".$Hinh)) {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/brand",$Hinh);
            $brand->Hinh = $Hinh;
        }

    	$brand->save();

    	return redirect('admin/brand/them')->with('thongbao','Thêm thành công'); // gán thêm session thongbao
    }

    public function getSua($id){
    	$brand = Brand::find($id);
    	return view('admin.brand.sua',['brand'=>$brand]);
    }

    public function postSua(Request $request,$id){
    	$brand = Brand::find($id);
    	$this->validate($request,
            [
                'MoTa' => 'required',
                'Hinh' => 'required'
            ],[
                'MoTa.required' => 'Bạn chưa nhập mô tả',
                'Hinh.required' => 'Bạn chưa nhập hình ảnh',
            ]);
        
        $brand->MoTa = $request->MoTa;
        
        if ($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
                return redirect('admin/brand/them')->with('loi','Bạn chỉ được chọn file có đuôi jpg,jpeg,png');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/brand/".$Hinh)) {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/brand",$Hinh);
            unlink("upload/brand/".$brand->Hinh);
            $brand->Hinh = $Hinh;
        }

    	$brand->save();

    	return redirect('admin/brand/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id){
    	$brand = Brand::find($id);
    	$brand->delete();

    	return redirect('admin/brand/danhsach')->with('thongbao','Xóa thành công');
    }
}
