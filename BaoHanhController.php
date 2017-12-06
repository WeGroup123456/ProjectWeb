<?php
class BaoHanhController extends Controller
{
    //
    public function getDanhsach(){
    	$baohanh = BaoHanh::all();
    	return view('admin.baohanh.danhsach',['baohanh'=>$baohanh]);
    }

    public function getThem(){
        $baohanh = BaoHanh::all();
    	return view('admin.baohanh.them',['baohanh'=>$baohanh]);
    }

    public function postThem(Request $request){
    	//echo $request->Ten; //Ten nay la name cua tag input
    	$this->validate($request,
            [
                'TieuDe' => 'required|min:3|unique:BaoHanh,TieuDe',
                'Kieu' => 'required',
                'TomTat' => 'required',
                'NoiDung' => 'required',
            ],[
                'TieuDe.required' => 'Bạn chưa nhập tên tiêu đề',
                'TomTat.required' => 'Bạn chưa nhập tên thể loại',
                'NoiDung.required' => 'Bạn chưa nhập tên thể loại',
                'TieuDe.unique' => 'Tên tiêu đề đã tồn tại',
                'TieuDe.min' => 'Tên tiêu đề phải có độ dài từ 3 đến 100 ký tự',
                'TieuDe.max' => 'Tên tiêu đề phải có độ dài từ 3 đến 100 ký tự',
            ]);

        $baohanh = new BaoHanh;
        $baohanh->TieuDe = $request->TieuDe;
        $baohanh->TenKhongDau = changeTitle($request->TieuDe);
        $baohanh->Kieu = $request->Kieu;
        $baohanh->TomTat = $request->TomTat;
        $baohanh->NoiDung = $request->NoiDung;
        $baohanh->save();

        return redirect('admin/baohanh/them')->with('thongbao','Thêm thành công');
    }

    public function getSua($id){
    	$baohanh = BaoHanh::find($id);
    	return view('admin.baohanh.sua',['baohanh'=>$baohanh]);
    }

    public function postSua(Request $request,$id){
    	
    	$this->validate($request,
            [
                'TieuDe' => 'required|min:3|unique:BaoHanh,TieuDe',
                'Kieu' => 'required',
                'TomTat' => 'required',
                'NoiDung' => 'required',
            ],[
                'TieuDe.required' => 'Bạn chưa nhập tên tiêu đề',
                'TomTat.required' => 'Bạn chưa nhập tóm tắt',
                'NoiDung.required' => 'Bạn chưa nhập nội dung',
                'TieuDe.unique' => 'Tên tiêu đề đã tồn tại',
                'TieuDe.min' => 'Tên tiêu đề phải có độ dài từ 3 đến 100 ký tự',
                'TieuDe.max' => 'Tên tiêu đề phải có độ dài từ 3 đến 100 ký tự',
            ]);

    	$baohanh = BaoHanh::find($id);

    	$baohanh->TieuDe = $request->TieuDe;
        $baohanh->TenKhongDau = changeTitle($request->TieuDe);
        $baohanh->Kieu = $request->Kieu;
        $baohanh->TomTat = $request->TomTat;
        $baohanh->NoiDung = $request->NoiDung;
        $baohanh->save();


    	$baohanh->save();

    	return redirect('admin/baohanh/sua/'.$id)->with('thongbao','Sửa thành công'); // gán thêm session thongbao
    }

    public function getXoa($id){
    	$baohanh = BaoHanh::find($id);
    	$baohanh->delete();

    	return redirect('admin/baohanh/danhsach')->with('thongbao','Xóa thành công');
    }
}
