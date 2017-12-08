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

    public function getChiTiet($id){
        $giay = Giay::find($id);
        $maugiay = MauGiay::where('idGiay',$id)->get();
        return view('admin.giay.chitiet',['maugiay'=>$maugiay,'giay'=>$giay]);
    }

    public function getThemChiTiet($id){
        $giay = Giay::find($id);
        return view('admin.giay.themchitiet',[
            'giay'=>$giay
            ]);
    }

    public function postThemChiTiet(Request $request,$id){

        $maugiay = new MauGiay;
        $size = new Size;
        $giay = Giay::where('id',$id)->get();

        if ($request->hasFile('HinhBe')) {
            $file = $request->file('HinhBe');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
                return redirect('admin/giay/themchitiet/'.$id)->with('loi','Bạn chỉ được chọn file có đuôi jpg,jpeg,png');
            }
            $name = $file->getClientOriginalName();
            $HinhBe = str_random(4)."_".$name;
            while (file_exists("upload/giay/".$request->MaGiay."/chinh/".$HinhBe)) {
                $HinhBe = str_random(4)."_".$name;
            }
            $file->move("upload/giay/".$request->MaGiay."/chinh",$HinhBe);
            $maugiay->HinhBe = $HinhBe;
        }

        $maugiay->Ten = $giay[0]->Ten;
        $maugiay->MaGiay = $request->MaGiay;
        $maugiay->Mau = $request->Mau;
        $maugiay->LuotXem = 0;
        $maugiay->LuotThich = 0;
        $maugiay->GiaCu = $request->GiaCu;
        $maugiay->GiaMoi = $request->GiaMoi;
        $maugiay->NoiBat = $request->NoiBat;
        $maugiay->Status = $request->Status;
        $maugiay->GioiTinh = $request->GioiTinh;
        $maugiay->idGiay = $id;

        $maugiay->save();

        $size->SoLuong = $request->SoLuong;
        $size->Size = $request->Size;
        $size->mau_giay_id = $maugiay->id;

        $size->save();

        if(count($_FILES['upload']['name']) > 0){

            for($i=0; $i<count($_FILES['upload']['name']); $i++) {
                $file = $request->file('upload');
                //$file=$_FILES['upload']['name'][$i];

                $duoi = $file[$i]->getClientOriginalExtension();
                if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
                    return redirect('admin/giay/themchitiet/'.$id)->with('loi','Bạn chỉ được chọn file có đuôi jpg,jpeg,png');
                }
                $name = $file[$i]->getClientOriginalName();
                $Hinh = str_random(4)."_".$name;
                while (file_exists("upload/giay/".$maugiay->MaGiay."/hinhphu/".$Hinh)) {
                    $Hinh = str_random(4)."_".$name;
                }
                $filePath = "upload/giay/".$maugiay->MaGiay."/hinhphu";

                $file[$i]->move($filePath,$Hinh);

                $hinhgiay = new HinhGiay;
                $hinhgiay->Hinh = $Hinh;
                $hinhgiay->mau_giay_id = $maugiay->id;
                $hinhgiay->save();
            }

        }

        

        return redirect('admin/giay/themchitiet/'.$id)->with('thongbao','Thêm thành công'); // gán thêm session thongbao
    }

    public function getSuaChiTiet($idMauGiay){
        $maugiay = MauGiay::find($idMauGiay);
        return view('admin.giay.suachitiet',[
            'maugiay'=>$maugiay
            ]);
    }

    public function postSuaChiTiet(Request $request,$idMauGiay,$idSize){
        $this->validate($request,
            [
                //'MaGiay' => 'required',
                'Mau' => 'required',
                'Size' => 'required',
                'SoLuong' => 'required',
                'GiaCu' => 'required',
                'GiaMoi' => 'required',
            ],[
                //'MaGiay.required' => 'Bạn chưa nhập mã giày',
                'Mau.required' => 'Bạn chưa nhập màu giày',
                'Size.required' => 'Bạn chưa nhập đủ thông tin',
                'SoLuong.required' => 'Bạn chưa nhập đủ thông tin',
                'GiaCu.required' => 'Bạn chưa nhập đủ thông tin',
                'GiaMoi.required' => 'Bạn chưa nhập đủ thông tin',
            ]);

        $maugiay = MauGiay::find($idMauGiay);
        $size = Size::where('idMauGiay',$idMauGiay)->where('id',$idSize)->get();

        //$maugiay->MaGiay = $request->MaGiay;
        $maugiay->Mau = $request->Mau;
        $maugiay->GiaCu = $request->GiaCu;
        $maugiay->GiaMoi = $request->GiaMoi;
        $maugiay->NoiBat = $request->NoiBat;
        $maugiay->Status = $request->Status;
        $maugiay->GioiTinh = $request->GioiTinh;

        $size[0]->Size = $request->Size;
        $size[0]->SoLuong = $request->SoLuong;

        $size[0]->save();

        $maugiay->save();

        if ($request->hasFile('HinhBe')) {
            $file = $request->file('HinhBe');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
                return redirect('admin/giay/themchitiet/'.$idMauGiay)->with('loi','Bạn chỉ được chọn file có đuôi jpg,jpeg,png');
            }
            $name = $file->getClientOriginalName();
            $HinhBe = str_random(4)."_".$name;
            while (file_exists("upload/giay/".$maugiay->MaGiay."/chinh/".$HinhBe)) {
                $HinhBe = str_random(4)."_".$name;
            }
            unlink("upload/giay/".$maugiay->MaGiay."/chinh/".$maugiay->HinhBe);
            $file->move("upload/giay/".$maugiay->MaGiay."/chinh",$HinhBe);
            $maugiay->HinhBe = $HinhBe;
        }

        $hinhgiay = HinhGiay::where('idMauGiay',$idMauGiay)->get();
        foreach ($hinhgiay as $element) {
            unlink("upload/giay/".$maugiay->MaGiay."/hinhphu/".$element->Hinh);
            $element->delete();
        }


        if(count($_FILES['upload']['name']) > 0){

            for($i=0; $i<count($_FILES['upload']['name']); $i++) {
                $file = $request->file('upload');
                //$file=$_FILES['upload']['name'][$i];

                $duoi = $file[$i]->getClientOriginalExtension();
                if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
                    return redirect('admin/giay/themchitiet/'.$id)->with('loi','Bạn chỉ được chọn file có đuôi jpg,jpeg,png');
                }
                $name = $file[$i]->getClientOriginalName();
                $Hinh = str_random(4)."_".$name;
                while (file_exists("upload/giay/".$maugiay->MaGiay."/hinhphu/".$Hinh)) {
                    $Hinh = str_random(4)."_".$name;
                }
                $filePath = "upload/giay/".$maugiay->MaGiay."/hinhphu";

                $file[$i]->move($filePath,$Hinh);

                $hinhgiay = new HinhGiay;
                $hinhgiay->Hinh = $Hinh;
                $hinhgiay->idMauGiay = $maugiay->id;
                $hinhgiay->save();
            }

        }

        return redirect('admin/giay/suachitiet/'.$idMauGiay.'/'.$idSize)->with('thongbao','Sửa thành công');
    }

    public function getXoaChiTiet($id,$idGiay){
        $maugiay = MauGiay::find($id);

        $size = Size::where('mau_giay_id',$id)->get();
        foreach ($size as $si) {
            $si->delete();
        }

        $hinhgiay = HinhGiay::where('mau_giay_id',$id)->get();
        foreach ($hinhgiay as $hinh) {
            $hinh->delete();
        }

        $maugiay->delete();

        return redirect('admin/giay/chitiet/'.$idGiay)->with('thongbao','Xóa thành công');
    }
}
