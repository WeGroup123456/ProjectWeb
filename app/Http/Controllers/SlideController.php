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
    public function getThem(){
        $slide = Slide::all();
    	return view('admin.slide.them',['slide'=>$slide]);
    }

    public function postThem(Request $request){
    	//echo $request->Ten; //Ten nay la name cua tag input
    	$this->validate($request,
    		[
    			'Ten' => 'required', //dieu kien: có, trùng trong bảng thể loại value Ten
    			'NoiDung' => 'required'
    		],
    		[
    			'Ten.required' => 'Bạn chưa nhập tên thể loại',
    			'Ten.required' => 'Bạn chưa nhập nội dung',
    		]);

    	$slide = new Slide;
    	$slide->Ten = $request->Ten;
    	$slide->NoiDung = $request->NoiDung;
    	$slide->link = $request->link;

    	if ($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
                return redirect('admin/slide/them')->with('loi','Bạn chỉ được chọn file có đuôi jpg,jpeg,png');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/slide/".$Hinh)) {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/slide",$Hinh);
            $slide->Hinh = $Hinh;
        }else{
            $slide->Hinh = "";
        }


    	$slide->save();

    	return redirect('admin/slide/them')->with('thongbao','Thêm thành công'); // gán thêm session thongbao
    }
    public function getSua($id){
    	$slide = Slide::find($id);
    	return view('admin.slide.sua',['slide'=>$slide]);
    }

    public function postSua(Request $request,$id){
    	
    	$this->validate($request,
    		[
    			'Ten' => 'required', //dieu kien: có, trùng trong bảng thể loại value Ten
    			'NoiDung' => 'required'
    		],
    		[
    			'Ten.required' => 'Bạn chưa nhập tên thể loại',
    			'Ten.required' => 'Bạn chưa nhập nội dung',
    		]);

    	$slide = Slide::find($id);
    	$slide->Ten = $request->Ten;
    	$slide->NoiDung = $request->NoiDung;
    	$slide->link = $request->link;

    	if ($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
                return redirect('admin/slide/them')->with('loi','Bạn chỉ được chọn file có đuôi jpg,jpeg,png');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/slide/".$Hinh)) {
                $Hinh = str_random(4)."_".$name;
            }
            unlink("upload/slide/".$slide->Hinh);
            $file->move("upload/slide",$Hinh);
            $slide->Hinh = $Hinh;
        }


    	$slide->save();

    	return redirect('admin/slide/sua/'.$id)->with('thongbao','Sửa thành công'); // gán thêm session thongbao
    }
}
