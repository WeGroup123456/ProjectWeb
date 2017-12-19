<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('admin/','UserController@getDangnhapAdmin');

Route::get('admin/dangnhap','UserController@getDangnhapAdmin');
Route::post('admin/dangnhap','UserController@postDangnhapAdmin');
Route::get('admin/logout','UserController@getDangxuatAdmin');

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function() {
	Route::get('trangchu', 'UserController@getDanhSach');

	Route::group(['prefix'=>'brand'],function() {
		Route::get('danhsach','BrandController@getDanhSach');

		Route::get('sua/{id}','BrandController@getSua');
		Route::post('sua/{id}','BrandController@postSua');

		Route::get('them','BrandController@getThem');
		Route::post('them','BrandController@postThem');

		Route::get('xoa/{id}','BrandController@getXoa');
	});

	Route::group(['prefix'=>'loaigiay'],function() {
		Route::get('danhsach','LoaiGiayController@getDanhSach');

		Route::get('sua/{id}','LoaiGiayController@getSua');
		Route::post('sua/{id}','LoaiGiayController@postSua');

		Route::get('them','LoaiGiayController@getThem');
		Route::post('them','LoaiGiayController@postThem');

		Route::get('themmoi','LoaiGiayController@getThemMoi');
		Route::post('themmoi','LoaiGiayController@postThemMoi');

		Route::get('xoa/{id}','LoaiGiayController@getXoa');
	});

	Route::group(['prefix'=>'giay'],function() {
		Route::get('danhsach','GiayController@getDanhSach');

		Route::get('sua/{id}','GiayController@getSua');
		Route::post('sua/{id}','GiayController@postSua');

		Route::get('suachitiet/{idMauGiay}','GiayController@getSuaChiTiet');// /{size_id}
		Route::post('suachitiet/{idMauGiay}','GiayController@postSuaChiTiet');// /{size_id}

		Route::get('them','GiayController@getThem');
		Route::post('them','GiayController@postThem');

		Route::get('themchitiet/{id}','GiayController@getThemChiTiet');
		Route::post('themchitiet/{id}','GiayController@postThemChiTiet');

		Route::get('xoa/{id}','GiayController@getXoa');

		Route::get('chitiet/{id}','GiayController@getChiTiet');
		Route::get('xoachitiet/{id}/{idGiay}','GiayController@getXoaChiTiet');

		Route::get('themsize/{id}','GiayController@getThemSize');
		Route::post('themsize/{id}','GiayController@postThemSize');
	});

	Route::group(['prefix'=>'comment'],function() {

		Route::get('xoa/{id}/{idGiay}','CommentController@getXoa');
	});

	Route::group(['prefix'=>'slide'],function() {
		Route::get('danhsach','SlideController@getDanhSach');

		Route::get('sua/{id}','SlideController@getSua');
		Route::post('sua/{id}','SlideController@postSua');

		Route::get('them','SlideController@getThem');
		Route::post('them','SlideController@postThem');

		Route::get('xoa/{id}','SlideController@getXoa');
	});

	Route::group(['prefix'=>'baohanh'],function() {
		Route::get('danhsach','BaoHanhController@getDanhSach');

		Route::get('sua/{id}','BaoHanhController@getSua');
		Route::post('sua/{id}','BaoHanhController@postSua');

		Route::get('them','BaoHanhController@getThem');
		Route::post('them','BaoHanhController@postThem');

		Route::get('xoa/{id}','BaoHanhController@getXoa');
	});

	Route::group(['prefix'=>'user'],function() {
		Route::get('danhsach','UserController@getDanhSach');

		Route::get('sua/{id}','UserController@getSua');
		Route::post('sua/{id}','UserController@postSua');

		Route::get('them','UserController@getThem');
		Route::post('them','UserController@postThem');

		Route::get('xoa/{id}','UserController@getXoa');
	});

	Route::group(['prefix'=>'ajax'],function() {
		Route::get('loaigiay/{idBrand}','AjaxController@getLoaiGiay');
		Route::get('soluong/{idSize}','AjaxController@getSoLuong');
		Route::get('soluong2/{idSize}','AjaxController@getSoLuong2');
		Route::get('soluongsize/{idSize}/{soLuong}','AjaxController@getSoLuongSize');
	});
});

/*shoppingcart*/
Route::get('cart',['as'=>'cart','uses'=>'PagesController@getCart']);
//Route::get('insertcart/{id}','PagesController@getInsertcart');
Route::post('insertcart/{id}','PagesController@postInsertcart');
Route::get('ajax/capnhat/{id}/{qty}','PagesAjaxController@getCapNhat');
Route::get('deletecart/{rowId}','PagesController@getDeletecart');
/*end-shoppingcart*/

/*Product*/
Route::get('product',['as'=>'product','uses'=>'PagesController@product']);
Route::get('productdetail/{alias}/shoe{idShoe}.html','PagesController@productDetail');
/*End Product*/

/*Product Filter*/
Route::get('productfilter',['as'=>'productfilter','uses'=>'PagesController@productFilter']);
/*End Product Filter*/

Route::get('errorpage','PagesController@errorPage');
Route::get('home','PagesController@home');