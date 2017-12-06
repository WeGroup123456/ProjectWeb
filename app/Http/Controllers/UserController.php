<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    //
    public function getDanhsach(){
    	$user = User::all();
    	return view('admin.user.danhsach',['user'=>$user]);
    }

    public function getDangnhapAdmin(){
    	return view('admin.login');
    }

    public function postDangnhapAdmin(Request $request){
    	$this->validate($request,
    		[
                'email' => 'required',
                'password' => 'required',
    		],[
                'email.required' => 'Bạn chưa nhập email',
    			'password.required' => 'Bạn chưa nhập mật khẩu',
    		]);

    	if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
    		return redirect('admin/trangchu');
    	}else{
    		return redirect('admin/dangnhap')->with('thongbao','Đăng nhập không thành công');
    	}
    }

    public function getDangxuatAdmin(){
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
