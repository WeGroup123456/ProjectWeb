<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Giay;
use App\LoaiGiay;
use App\Brand;
use App\BrandLoaiGiay;
use App\MauGiay;
use App\Size;
use Session;
use DB;
use Cart;

class PagesAjaxController extends Controller
{
    //
    public function getUpdate($id, $qty, Request $request) {
        $id = $request->id;
        $qty = $request->qty;
        Cart::update($id,$qty);
        echo "oke";
    }

    public function checkSize($idparent, $size, Request $request) {
        $idparent = $request->idparent;
        $size = $request->size;
        $result = Size::where('mau_giay_id',$idparent)->where('Size',$size)->first();
        if ($result->SoLuong > 0) {
            echo "avail";
        }else{
           echo "not avail"; 
        }
        
    }

    public function getSorting($action){
        if ($action == "popularity") {
            //chua lam
            $maugiay = MauGiay::orderBy('GiaMoi', 'desc')->get();
        }else if($action == "lowest_price"){
            $maugiay = MauGiay::orderBy('GiaMoi', 'asc')->get();
        }else if($action == "highest_price"){
            $maugiay = MauGiay::orderBy('GiaMoi', 'desc')->get();
        }else if($action == "latest_arrival"){
            $maugiay = MauGiay::orderBy('created_at', 'asc')->get();
        }else if($action == "discount"){
            //chua lam
            $maugiay = MauGiay::orderBy('GiaMoi', 'desc')->get();
        }

        if (count($maugiay) > 0) {
            Session::flash('maugiay', $maugiay);
            echo "oke";
        }else{
            echo "no";
        }
    }

    public function getGiayTheoLoai($idLoaiGiay){
        $query = MauGiay::where('Status',1);

        $count = 0;

        foreach ($query->get() as $mg) {
            if ($mg->giay->idLoaiGiay == $idLoaiGiay) {
                if ($count == 0) {
                    $count++;
                    $query = $query->where('id',$mg->id);
                }else{
                    $query = $query->orWhere('id',$mg->id);
                }
            }
        }

        if ($count != 0) {
            $maugiay = $query->get();
            Session::flash('maugiay', $maugiay);
            echo "oke";
        }else{
            echo "Không tìm thấy dữ liệu phù hợp";
        }
        /*$giay = Giay::where('idLoaiGiay',$idLoaiGiay)->get();
        $i=0;
        foreach ($giay as $gi) {
            foreach ($gi->maugiay as $mg) {
                $maugiay[$i] = $mg;
            $i++;
            }
        }

        if (count($maugiay) > 0) {
            Session::flash('maugiay', $maugiay);
            echo "oke";
        }else{
            echo "no";
        }*/
    }

    public function getGiayTheoHang($idBrand){
        $query = MauGiay::where('Status',1);

        $count = 0;

        foreach ($query->get() as $mg) {
            if ($mg->giay->idBrand == $idBrand) {
                if ($count == 0) {
                    $count++;
                    $query = $query->where('id',$mg->id);
                }else{
                    $query = $query->orWhere('id',$mg->id);
                }
            }
        }

        if ($count != 0) {
            $maugiay = $query->get();
            Session::flash('maugiay', $maugiay);
            echo "oke";
        }else{
            echo "Không tìm thấy dữ liệu phù hợp";
        }

        /*$giay = Giay::where('idBrand',$idBrand)->get();
        $i=0;
        foreach ($giay as $gi) {
            foreach ($gi->maugiay as $mg) {
                $maugiay[$i] = $mg;
            $i++;
            }
        }

        if (count($maugiay) > 0) {
            Session::flash('maugiay', $maugiay);
            echo "oke";
        }else{
            echo "no";
        }*/
    }

    public function getGiayTheoGioiTinh($num){
        $maugiay = MauGiay::where('GioiTinh',$num)->get();
        if (count($maugiay) > 0) {
            Session::flash('maugiay', $maugiay);
            echo "oke";
        }else{
            echo "no";
        }
    }

    public function getGiayTheoGia($from,$to){
        
        
    }

    public function getGiayTheoSize($size){
        $query = MauGiay::where('Status',1);

        $count = 0;
        foreach ($query->get() as $mg) {
            foreach ($mg->size as $si) {
                if ($si->Size == $size) {
                    if ($count == 0) {
                        $count++;
                        $query = $query->where('id',$mg->id);
                    }else{
                        $query = $query->orWhere('id',$mg->id);
                    }
                }
            }
        }

        if ($count != 0) {
            $maugiay = $query->get();
            Session::flash('maugiay', $maugiay);
            echo "oke";
        }else{
            echo "Không tìm thấy dữ liệu phù hợp";
        }

        /*$size = Size::where('Size',$size)->get();
        if (count($size)>0) {
            $i=0;
            foreach ($size as $si) {
                $maugiay[$i] = $si->maugiay;
                $i++;
            }
            Session::flash('maugiay', $maugiay);
            echo "oke";
        }else{
            echo "no";
        }*/
    }

    public function filterCoditions(Request $request){
        $size = $request->get('size');
        $gender = $request->get('gender');
        $typeshoes = $request->get('typeshoes');
        $typebrand = $request->get('typebrand');
        $sorting = $request->get('sorting');

        $priceFrom = $request->get('priceFrom');
        $priceTo = $request->get('priceTo');

        $count_query_1 = 1;
        $count_query_2 = 0;
        $count_query_3 = 0;
        $count_query_4 = 0;
        $count_query_5 = 0;

        //$query = MauGiay::where('Status',1);

        $query = MauGiay::where(function ($query) {
            $query->where('Status',1);
        })->where(function ($query) use ($gender,$count_query_1) {
            if($gender != null) {
                $count_query_1++;
                $query->where('GioiTinh',$gender);
                if ($count_query_1 == 1) {
                    echo "gender"; // trả về item nếu không lọc được sản phẩm nào để delete trong localStorage
                    exit();
                }
            }
        })->where(function ($query) use ($priceFrom,$priceTo,$count_query_5) {
            if($priceFrom != null && $priceTo != null) {
                if ($count_query_5 == 0) {
                    $count_query_5++;
                    $query->whereBetween('GiaMoi',array((int)$priceFrom,(int)$priceTo));
                }

                if ($count_query_5 == 0) {
                    echo "price"; // trả về item nếu không lọc được sản phẩm nào để delete trong localStorage
                    exit();
                }
            }
        })->where(function ($query) use ($size,$count_query_2) {
            if($size != null) {
                foreach ($query->get() as $mg) {
                    foreach ($mg->size as $si) {
                        if ($si->Size == $size) {
                            if ($count_query_2 == 0) {
                                $count_query_2++;
                                $query->where('id',$mg->id);
                            }else{
                                $query->orWhere('id',$mg->id);
                            }
                        }
                    }
                }
                if ($count_query_2 == 0) {
                    echo "SizeType"; // trả về item nếu không lọc được sản phẩm nào để delete trong localStorage
                    exit();
                }
            }
        })->where(function ($query) use ($typeshoes,$count_query_3) {
            if($typeshoes != null) {
                foreach ($query->get() as $mg) {
                    if ($mg->giay->idLoaiGiay == $typeshoes) {
                        if ($count_query_3 == 0) {
                            $count_query_3++;
                            $query->where('id',$mg->id);
                        }else{
                            $query->orWhere('id',$mg->id);
                        }
                    }
                }
                if ($count_query_3 == 0) {
                    echo "typeshoes"; // trả về item nếu không lọc được sản phẩm nào để delete trong localStorage
                    exit();
                }
            }
        })->where(function ($query) use ($typebrand,$count_query_4) {
            if($typebrand != null) {
                foreach ($query->get() as $mg) {
                    if ($mg->giay->idBrand == $typebrand) {
                        if ($count_query_4 == 0) {
                            $count_query_4++;
                            $query->where('id',$mg->id);
                        }else{
                            $query->orWhere('id',$mg->id);
                        }
                    }
                }
                if ($count_query_4 == 0) {
                    echo "BrandType"; // trả về item nếu không lọc được sản phẩm nào để delete trong localStorage
                    exit();
                }
            }
        });

        if($sorting != null) {
            if ($sorting == "popularity") {
                //chua lam
            }else if($sorting == "lowest_price"){
                $query->orderBy('GiaMoi', 'asc');
            }else if($sorting == "highest_price"){
                $query->orderBy('GiaMoi', 'desc');
            }else if($sorting == "latest_arrival"){
                $query->orderBy('created_at', 'asc');
            }else if($sorting == "discount"){
                //chua lam
            }
        }

        /*if($gender != null) {
            $count_query_1++;
            $query = $query->where('GioiTinh',$gender);
        }

        if($size != null) {
            foreach ($query->get() as $mg) {
                foreach ($mg->size as $si) {
                    if ($si->Size == $size) {
                        if ($count_query_2 == 0) {
                            $count_query_2++;
                            $query = $query->where('id',$mg->id);
                        }else{
                            $query = $query->orWhere('id',$mg->id);
                        }
                    }
                }
            }
            if ($count_query_2 == 0) {
                echo "Không tìm thấy dữ liệu phù hợp";
            }
        }

        if($typeshoes != null) {
            foreach ($query->get() as $mg) {
                if ($mg->giay->idLoaiGiay == $typeshoes) {
                    if ($count_query_3 == 0) {
                        $count_query_3++;
                        $query = $query->where('id',$mg->id);
                    }else{
                        $query = $query->orWhere('id',$mg->id);
                    }
                }
            }
            if ($count_query_3 == 0) {
                echo "Không tìm thấy dữ liệu phù hợp";
            }
        }

        if($typebrand != null) {
            foreach ($query->get() as $mg) {
                if ($mg->giay->idBrand == $typebrand) {
                    if ($count_query_4 == 0) {
                        $count_query_4++;
                        $query = $query->where('id',$mg->id);
                    }else{
                        $query = $query->orWhere('id',$mg->id);
                    }
                }
            }
            if ($count_query_4 == 0) {
                echo "Không tìm thấy dữ liệu phù hợp";
            }
        }*/

        $count = $count_query_1 + $count_query_2 + $count_query_3 + $count_query_4 + $count_query_5;

        if ($count != 0) {
            $maugiay = $query->paginate(6);
            Session::put('maugiay', $maugiay);
            echo "oke";
            $page = $request->get('page');
            if ($page != null) {
                return redirect('product?page='.$page);
            }
        }else{
            echo "Không tìm thấy dữ liệu phù hợp";
        }
    }
}