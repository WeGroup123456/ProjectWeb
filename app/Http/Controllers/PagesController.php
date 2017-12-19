<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    
use App\Http\Requests;
use App\BaoHanh;
use App\Brand;
use App\BrandLoaiGiay;
use App\Comment;
use App\Giay;
use App\MauGiay;
use App\Size;
use App\Slide;
use App\LoaiGiay;
use App\User;
use App\Orders;
use App\Customer;
use Session;
use Cart;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;

class PagesController extends Controller
{
    //
    function __construct(){
        $shoe_brand_all = Brand::all();
        $shoe_cate_all = LoaiGiay::all();
    	$shoe_all = MauGiay::all();

    	view()->share('shoe_brand_all',$shoe_brand_all);
    	view()->share('shoe_cate_all',$shoe_cate_all);
        view()->share('shoe_all',$shoe_all);

        if (Auth::check()) {
            view()->share('nguoidung',Auth::user());
        }

        $content = Cart::content();
        $total = Cart::total();

        view()->share('content',$content);
        view()->share('total',$total);
    }

    function home(){
        $slide_all = Slide::all();
        $hot_shoes_1 = MauGiay::where('NoiBat',1)->take(4)->get();
        $hot_shoes_2 = MauGiay::where('NoiBat',1)->skip(4)->take(4)->get();
        
        $new_shoes_1 = MauGiay::orderBy('created_at')->take(4)->get();
        $new_shoes_2 = MauGiay::orderBy('created_at')->skip(4)->take(4)->get();
    	return view('pages.homepage',['slide_all'=>$slide_all,'hot_shoes_1'=>$hot_shoes_1,'hot_shoes_2'=>$hot_shoes_2,'new_shoes_1'=>$new_shoes_1,'new_shoes_2'=>$new_shoes_2]);
    }

    function errorPage(){
        return view('error-page');
    }

    function product(){
        $shoe = MauGiay::paginate(6);
        return view('product.productgird',['shoe'=>$shoe]);
    }

    function productDetail($alias,$idShoe){
        $shoe = MauGiay::find($idShoe);
        $sort = Size::where('mau_giay_id',$idShoe)->orderBy('Size', 'asc')->get();
        return view('details.index',['shoe'=>$shoe,'sort'=>$sort]);
    }

    function productFilter(Request $request){
        $gender = $request->gender;
        $brands = $request->brands;
        $cate = $request->cate;
        $max_price = $request->max_price;
        $min_price = $request->min_price;

        $count_query_1 = 1;
        $count_query_2 = 0;
        $count_query_3 = 0;
        $count_query_4 = 0;
        $count_query_5 = 0;

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
        })->where(function ($query) use ($min_price,$max_price,$count_query_5) {
            if($min_price != null && $max_price != null) {
                if ($count_query_5 == 0) {
                    $count_query_5++;
                    $query->whereBetween('GiaMoi',array((int)$min_price,(int)$max_price));
                }

                if ($count_query_5 == 0) {
                    echo "price"; // trả về item nếu không lọc được sản phẩm nào để delete trong localStorage
                    exit();
                }
            }
        })->where(function ($query) use ($brands,$count_query_4) {
            if($brands != null) {
                foreach ($query->get() as $mg) {
                    if (strcmp ( $mg->giay->brand->TenKhongDau , $brands ) == 0) {
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
        })->where(function ($query) use ($cate,$count_query_3) {
            if($cate != null) {
                foreach ($query->get() as $mg) {
                    if (strcmp ($mg->giay->loaigiay->TenKhongDau , $cate ) == 0) {
                        if ($count_query_3 == 0) {
                            $count_query_3++;
                            $query->where('id',$mg->id);
                        }else{
                            $query->orWhere('id',$mg->id);
                        }
                    }
                }
                if ($count_query_3 == 0) {
                    echo "cate"; // trả về item nếu không lọc được sản phẩm nào để delete trong localStorage
                    exit();
                }
            }
        });

        $count = $count_query_1 + $count_query_2 + $count_query_3 + $count_query_4 + $count_query_5;

        if ($count != 0) {
            $shoe = $query->paginate(5)->appends(['gender' => $gender, 'brands' => $brands, 'cate' => $cate, 'min_price' => $min_price, 'max_price' => $max_price]);
            
            Session::put('shoe', $shoe);
            echo "oke";
        }else{
            echo "Không tìm thấy dữ liệu phù hợp";
        }

        return view('product.productgird');
        //return redirect()->route('product')->with('thongbao','Lọc thành công');
    }

    function getCart(){
        return view('cart.index');
    }

    function postInsertcart($id = null,Request $request){
        $this->validate($request,
            [
                'Size' => 'required',
            ],[
                'Size.required' => 'Bạn chưa chọn Size',
            ]);

        $exist = 10;
        $maugiay = MauGiay::find($id);
        foreach ($maugiay->size as $si) {
            if($si->Size == $request->Size){
                $exist = $si->SoLuong;
                if ($si->SoLuong == 0 ) {
                    return redirect()->back()->withErrors("Xin lỗi sản phẩm với size tương ứng đã hết hàng");
                }
            }
        }

        $content = Cart::content();

        foreach ($content as $item) {
            if ($item->id == $maugiay->MaGiay && $item->options->size == $request->Size) {
                $qty = $item->qty + 1;
                Cart::update($item->rowId,$qty);
                return redirect()->route('cart')->with('thongbao','Thêm 1 sản phẩm vào giỏ hàng thành công');
            }
        }
        Cart::add(array(
                'id'=>$maugiay->MaGiay,
                'name'=>$maugiay->giay->Ten,
                'qty' => 1,
                'price'=>$maugiay->GiaMoi,
                'options'=>array(
                    'image'=>$maugiay->HinhBe,
                    'gender'=>$maugiay->GioiTinh,
                    'size'=>$request->Size,
                    'brand'=>$maugiay->giay->brand->Ten,
                    'exist'=>$exist
                    )
            ));
        
        //print_r($content);
        return redirect()->route('cart')->with('thongbao','Thêm 1 sản phẩm vào giỏ hàng thành công');
    }

    function getDeletecart($rowId){
        Cart::remove($rowId);
        return redirect()->route('cart');
    }
}
