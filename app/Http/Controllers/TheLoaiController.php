<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
class TheLoaiController extends Controller
{
	public function __construct()
	{
        //truyền dữ liệu cho tất cả cả public sau 
		//$theloai = TheLoai::all();
		//view()->share('theloai');
	}
    public function getList()
    {
    	$theloai = TheLoai::all();
    	return view('admin.theloai.danhsach',compact('theloai'));
    }
    public function getAdd()
    {
    	return view('admin.theloai.them');
    }
    public function postAdd(Request $request)
    {
    	//bài 7 có sử dụng thêm function đổi title
    	$this->validate($request,
    		[
    		'Ten'=>'required|unique:TheLoai,Ten',//ktra tồn tại
    		],
    		[
    			'Ten.required'=>'Bạn chưa nhập vào tên',
    			'Ten.min'=>'Tên phải lớn hơn 3 ký tự',
    			'Ten.unique'=>'Tên thể loại đã tồn tại',
    		]);
    	$theloai = new TheLoai;
    	$theloai->Ten = $request->Ten;
    	$theloai->TenKhongDau = changeTitle($request->Ten);
    	$theloai->save();
    	return view('admin.theloai.them',compact('theloai'))->with('thongbao','Thêm thành công');
    }
    public function getEdit($id)
    {
        $theloai = TheLoai::find($id);//da tim id nen view khong can truyen
        return view('admin/theloai/sua',compact('theloai'));
    }
    public function postEdit(Request $request,$id)
    {
        $this->validate($request,
            [
                'Ten'=>'required|unique:TheLoai,Ten|min:3',//ktra tồn tại
            ],
            [
                'Ten.required'=>'Tên bắt buộc phải điền',
                'Ten.unique'=>'Tên thể loại đã tồn tại',
                'Ten.min'=>'Tên phải bắt buộc từ 3 ký tự trở lên'
            ]);
         $theloai = TheLoai::find($id);//tìm id để lưu sửa mới
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
        return redirect()->back()->with('thongbao','Chỉnh sửa thành công');
    }



    public function getDelete($id)
    {
    	$theloai = TheLoai::find($id);
    	$theloai->delete();
    	return view('admin.theloai.danhsach')->with('thongbao','Xoá thành công');
    }
}
