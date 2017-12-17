<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
class LoaiTinController extends Controller
{
    public function __construct()
    {
    	$loaitin = LoaiTin::all();
    	view()->share('loaitin',$loaitin);
    }

    //danh sach cac loai tin dùng MODEL khoá ngoại để truy vấn, ko cần tryền tại controller 
    public function getList()
    {
    	//$theloai = TheLoai::where('id','==','idTheLoai');//dieu kien id 
    	return view('admin.loaitin.danhsach');
    }
    //sửa
    public function getAdd()
    {
    		$theloai = TheLoai::all();
    	return view('admin.loaitin.them',compact('theloai'));
    }
    public function postAdd(Request $req)
    {
    	$this->validate($req,
    		[
    			//'TenTheLoai'=>'required' ko cần vì select đã có cũng ko dc thêm ở đây
    			'Ten'=>'required|unique:LoaiTin,Ten|min:5|max:30'
    		],
    		[
    			'Ten.required'=>'Tên loại tin bắt buộc phải nhập !',
    			'Ten.unique'=>'Tên loại tin đã tồn tại',
    			'Ten.min'=>'Tên loại tin phải lớn hơn 5 ký tự',
    			'Ten.max'=>'Tên loại tin không được lớn hơn 30 ký tự'
    		]);
    	$loaitin = new LoaiTin;
    	$loaitin->Ten = $req->Ten;
    	$loaitin->TenKhongDau = changeTitle($req->Ten);
    	$loaitin->idTheLoai = $req->TenTheLoai;//name trong danh sách selection
    	$loaitin->save();
    	return redirect()->back()->with('thongbao','Bạn đã thêm loại tin mới thành công !');
    }
    //sửa loại tin
   public function getEdit($id)
    {		
    		//phần chỉnh sửa bat buoc phải truyền 2 cái biến tl,lt
    		$loaitin = LoaiTin::find($id);
    		$theloai = TheLoai::all();
    		return view('admin.loaitin.sua',compact('theloai','loaitin'));
    		
    }
    public function postEdit(Request $req, $id)
    {
    	$this->validate($req,
    		[
    			//'TenTheLoai'=>'required' ko cần vì select đã có cũng ko dc thêm ở đây
    			'Ten'=>'required|unique:LoaiTin,Ten|min:5|max:30'
    		],
    		[
    			'Ten.required'=>'Tên loại tin bắt buộc phải nhập',
    			'Ten.unique'=>'Tên loại tin đã tồn tại',
    			'Ten.min'=>'Tên loại tin phải lớn hơn 5 ký tự',
    			'Ten.max'=>'Tên loại tin không được lớn hơn 30 ký tự'
    		]);

    	$loaitin = LoaiTin::find($id);
    	$loaitin->Ten = $req->Ten;
    	$loaitin->TenKhongDau = changeTitle($req->Ten);
    	$loaitin->idTheLoai = $req->TenTheLoai;//name trong danh sách selection
    	$loaitin->save();
    	return redirect()->back()->with('thongbao','Bạn đã sửa loại tin mới thành công !');
    }
    public function getDelete($id)
    {
    	$loaitin = LoaiTin::find($id);
    	$loaitin->delete();
    	return redirect()->back()->with('thongbao','Bạn đã xoá thành công !');
    	
    }
    
}
