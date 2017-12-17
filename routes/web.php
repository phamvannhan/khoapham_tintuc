<?php
//trang layout
use Illuminate\Support\Facades\Auth;
Route::get('/', function () {
    return view('welcome');
});
Route::get('trang',function(){
	return view('Admin.layout.master'); //bai 20 su dung blade 
});
//bài 22; tạo route đăng nhập cho người dùng khi vào website
//bài 23 bảo mật bằng middle ware chưa làm dc..dùng Auth;



//Route::get('dangki',['as'=>'Register','uses'=>'UserController@getRegister']);
//Route::post('dangki',['as'=>'Register','uses'=>'UserController@postRegister']);
//Admin
//'middleware'=>'AdminMiddleware' bị lỗi redircet
//Route::get('dangnhap',['as'=>'adminLogin','uses'=>'UserController@getLogin']);
//	Route::post('dangnhap',['as'=>'adminLogin','uses'=>'UserController@postLogin']);

	Route::get('admin/Login',['as'=>'adminLogin','uses'=>'UserController@getLogin']);
	Route::post('admin/Login',['as'=>'adminLogin','uses'=>'UserController@postLogin']);
	Route::get('admin/dangxuat',['as'=>'adminLogout','uses'=>'UserController@getLogout']);
Route::group(['prefix'=>'admin','middleware'=>'AdminMiddleware'],function(){
	//dùng middleware bảo mật cho admin
	//trang đăng nhập của admin

	//admin/slide
	Route::group(['prefix'=>'slide'],function(){

		Route::get('danhsach',[
				'as'=>'listSlide',
				'uses'=>'SlideController@getList'
				]);
		Route::get('them',[
				'as'=>'addSlide',
				'uses'=>'SlideController@getAdd'
				]);
		Route::post('them',[
				'as'=>'addSlide',
				'uses'=>'SlideController@postAdd'
				]);

		Route::get('sua/{id}','SlideController@getEdit');
		Route::post('sua/{id}','SlideController@postEdit');

		Route::get('xoa/{id}','SlideController@getDelete');
				
	});/*ket thuc route group Slide----------------------------*/
	//admin/theloai/-------phần Thể Loại---------------
	route::group(['prefix'=>'theloai'],function(){

		Route::get('danhsach',[
				'as'=>'listTHELOAI',
				'uses'=>'TheLoaiController@getList'
				]);
		Route::get('them',[
				'as'=>'addTHELOAI',
				'uses'=>'TheLoaiController@getAdd'
				]);
		Route::post('them',[
				'as'=>'addTHELOAI',
				'uses'=>'TheLoaiController@postAdd'
				]);
		Route::get('sua/{id}','TheLoaiController@getEdit');
		Route::post('sua/{id}','TheLoaiController@postEdit');

		Route::get('xoa/{id}','TheLoaiController@getDelete');

	});
	//route xoá comment--> chỉ cần tìm id 
	route::get('delComment/{id}','CommentController@getDelete');
	/*ket thuc route group theloai----------------------------------*/
	//Admin/loaitin
	route::group(['prefix'=>'loaitin'],function(){

		Route::get('danhsach',[
				'as'=>'listLOAITIN',
				'uses'=>'LoaiTinController@getList'
				]);
		Route::get('them',[
				'as'=>'addLOAITIN',
				'uses'=>'LoaiTinController@getAdd'
				]);
		Route::post('them',[
				'as'=>'addLOAITIN',
				'uses'=>'LoaiTinController@postAdd'
				]);
		Route::get('sua/{id}','LoaiTinController@getEdit');
		Route::post('sua/{id}','LoaiTinController@postEdit');

		Route::get('xoa/{id}','LoaiTinController@getDelete');

	});
	//Admin/tintuc
	route::group(['prefix'=>'tintuc'],function(){

		Route::get('danhsach',[
				'as'=>'listTINTUC',
				'uses'=>'TinTucController@getList'
				]);
		Route::get('them',[
				'as'=>'addTINTUC',
				'uses'=>'TinTucController@getAdd'
				]);
		Route::post('them',[
				'as'=>'addTINTUC',
				'uses'=>'TinTucController@postAdd'
				]);
		Route::get('sua/{id}','TinTucController@getEdit');
		Route::post('sua/{id}','TinTucController@postEdit');

		Route::get('xoa/{id}','TinTucController@getDelete');

	});
	//trang ajax admin/loaitinAjax
	route::group(['prefix'=>'ajax'],function(){
		//admin/ajax/loaitinAjax
		Route::get('loaitinAjax/{idTheLoai}','AjaxController@getLoaiTin');

	});
	//Admin/user
	route::group(['prefix'=>'user'],function(){

		Route::get('danhsach',[
				'as'=>'listUSERS',
				'uses'=>'UserController@getList'
				]);
		Route::get('them',[
				'as'=>'addUSERS',
				'uses'=>'UserController@getAdd'
				]);
		Route::post('them',[
				'as'=>'addUSERS',
				'uses'=>'UserController@postAdd'
				]);
		Route::get('sua/{id}','UserController@getEdit');
		Route::post('sua/{id}','UserController@postEdit');

		Route::get('xoa/{id}','UserController@getDelete');

	});
});//ket thuc route group Admin
	

//Route trang người dùng
//dùng trang chủ gồm xuất thể loại, loại tin, tin tức
Route::get('/',['as'=>'trangchu','uses'=>'PageController@TrangChu']);

Route::get('loaitin/{id}/{TenKhongDau}','PageController@LoaiTin');
Route::get('chi-tiet-tin/{id}/{TieuDeKhongDau}','PageController@TinTuc');
route::post('user-comment','PageController@userComment');
//bài 36 tìm kiếm tin tin trong trang chủ, ko dùng post vì phân trang bị lỗi
Route::get('timkiem','PageController@timkiem');
//route đăng kí,đăng nhập, đăng xuất cho người dùng
Route::get('dangnhap','PageController@LoginUser');
Route::post('dangnhap','PageController@postLoginUser');

Route::get('dangki','PageController@RegisterUser');
Route::post('dangki','PageController@postRegisterUser');

Route::get('dangxuat','PageController@LogoutUser');

//Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/home', 'HomeController@index')->name('home');
