<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    
use Illuminate\Routing\UrlGenerator;
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
        
        $new_shoes_1 = MauGiay::orderBy('created_at','desc')->take(4)->get();
        $new_shoes_2 = MauGiay::orderBy('created_at','desc')->skip(4)->take(4)->get();

        $special_deals_1 = MauGiay::orderByRaw('(GiaMoi/GiaCu) ASC')->take(4)->get();
        $special_deals_2 = MauGiay::orderByRaw('(GiaMoi/GiaCu) ASC')->skip(4)->take(4)->get();

        return view('pages.homepage',['slide_all'=>$slide_all,'special_deals_1'=>$special_deals_1,'special_deals_2'=>$special_deals_2,'hot_shoes_1'=>$hot_shoes_1,'hot_shoes_2'=>$hot_shoes_2,'new_shoes_1'=>$new_shoes_1,'new_shoes_2'=>$new_shoes_2]);
    }

    function product(){
        $shoe = MauGiay::paginate(6);
        return view('product.productgird',['shoe'=>$shoe]);
    }

    function productDetail($alias,$idShoe){
        $shoe = MauGiay::find($idShoe);
        $special_deals = MauGiay::orderByRaw('(GiaMoi/GiaCu) ASC')->take(3)->get();
        $hot_shoes_1 = MauGiay::where('NoiBat',1)->take(3)->get();
        $hot_shoes_2 = MauGiay::where('NoiBat',1)->skip(3)->take(3)->get();

        $sort = Size::where('mau_giay_id',$idShoe)->orderBy('Size', 'asc')->get();
        return view('details.index',['shoe'=>$shoe,'sort'=>$sort,'special_deals'=>$special_deals,'hot_shoes_1'=>$hot_shoes_1,'hot_shoes_2'=>$hot_shoes_2]);
    }

    function unparse_url($parsed_url) {
        $scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '';
        $host     = isset($parsed_url['host']) ? $parsed_url['host'] : '';
        $port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';
        $user     = isset($parsed_url['user']) ? $parsed_url['user'] : '';
        $pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : '';
        $pass     = ($user || $pass) ? "$pass@" : '';
        $path     = isset($parsed_url['path']) ? $parsed_url['path'] : '';
        $query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
        $fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';
        return "$scheme$user$pass$host$port$path$query$fragment";
    }


    function removeQueryParam($url, $param_to_remove) {
        $parsed = parse_url($url);
        if ($parsed && isset($parsed['query'])) {
            $parsed['query'] = implode('&', array_filter(explode('&', $parsed['query']), function($param) use ($param_to_remove) {
                return explode('=', $param)[0] !== $param_to_remove;
            }));
            if ($parsed['query'] === '') unset($parsed['query']);
            return $this->unparse_url($parsed);
        } else {
            return $url;
        }
    }

    function productFilter(Request $request, $unsetcon = null){
        if ($unsetcon != null) {
            if($unsetcon === "price"){
                $urlTemp = $this->removeQueryParam(url()->previous(), "max_price");
                echo $urlTemp;
                return redirect($this->removeQueryParam($urlTemp, "min_price")) ;
            }
            return redirect($this->removeQueryParam(url()->previous(), $unsetcon)) ;
        }

        $gender = $request->gender;
        $brands = $request->brands;
        $cate = $request->cate;
        $max_price = $request->max_price;
        $min_price = $request->min_price;

        $sorting = $request->sorting;
        $numItem = 6;
        if ($request->numItem != null) {
            $numItem = $request->numItem;
        }

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
                    echo '<script language="javascript">';
                    echo 'alert("No product found!!")';
                    echo '</script>';
                    $query->where('Status',3);
                }
            }
        })->where(function ($query) use ($min_price,$max_price,$count_query_5) {
            if($min_price != null && $max_price != null) {
                if ($count_query_5 == 0) {
                    $count_query_5++;
                    $query->whereBetween('GiaMoi',array((int)$min_price,(int)$max_price));
                }

                if ($count_query_5 == 0) {
                    echo '<script language="javascript">';
                    echo 'alert("No product found!!")';
                    echo '</script>';
                    $query->where('Status',3);
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
                    echo '<script language="javascript">';
                    echo 'alert("No product found!!")';
                    echo '</script>';
                    $query->where('Status',3);
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
                    echo '<script language="javascript">';
                    echo 'alert("No product found!!")';
                    echo '</script>';
                    $query->where('Status',3);
                }
            }
        });

        if($sorting != null) {
            if ($sorting == "popularity") {
                //chua lam
            }else if($sorting == "lowest_price"){
                $query->orderBy('GiaMoi', 'asc');
            }else if($sorting == "name_shoe"){
                $query->orderBy('Ten', 'asc');
            }else if($sorting == "highest_price"){
                $query->orderBy('GiaMoi', 'desc');
            }else if($sorting == "latest_arrival"){
                $query->orderBy('created_at', 'asc');
            }else if($sorting == "discount"){
                //chua lam
            }
        }

        $count = $count_query_1 + $count_query_2 + $count_query_3 + $count_query_4 + $count_query_5;

        if ($count != 0) {
            $shoe = $query->paginate($numItem)->appends(['gender' => $gender, 'brands' => $brands, 'cate' => $cate, 'min_price' => $min_price, 'max_price' => $max_price, 'sorting' => $sorting,  'numItem' => $numItem]);
            
            Session::put('shoe', $shoe);
            // echo "oke";
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

    function getPayNow(){
        return view('checkout.paynow');
    }

    function postPayNow(Request $request){
        $this->validate($request,
            [
                'Ten' => 'required',
                'Email' => 'required',
                'DiaChi' => 'required',
                'DienThoai' => 'required',
            ],[
                'Ten.required' => 'Bạn chưa nhập tên',
                'Email.required' => 'Bạn chưa nhập email',
                'DiaChi.required' => 'Bạn chưa nhập địa chỉ',
                'DienThoai.required' => 'Bạn chưa nhập điện thoại',
            ]);
        $customer = new Customer;
        $customer->Ten = $request->Ten;
        $customer->DiaChi = $request->DiaChi;
        $customer->Email = $request->Email;
        $customer->DienThoai = $request->DienThoai;

        $customer->save();

        Session::put('customer', $customer);
        return redirect()->route('vnpay')->with('thongbao','Cài đặt thông tin khách hàng thành công');
    }

    function getVnPay(){
        return view('checkout.vn-pay');
    }

    function getCheckOrder(){
        return view('checkout.checkorder');
    }

    function postCheckOrder(Request $request){
        $order = Orders::where('vnp_TransactionNo',$request->MaDonHang)->get()->first();
         
        return view('checkout.orderstatus',['order'=>$order]);
    }

    function getOrderStatus(){
        return view('checkout.orderstatus');
    }

    function deleteSession(){
        return view('delete-session');
    }

    public function search(Request $request)
    {
        $q = $request->q;
        $q = strtoupper($q);


        $shoe = MauGiay::where('Ten','like',"%$q%")->orWhere('MaGiay','like',"%$q%")->orWhere('Mau','like',"%$q%")->paginate(6)->appends(['q' => $q]);
        Session::put('q', $q);
        Session::put('shoe', $shoe);
        return view('product.productgird');
    }
}
