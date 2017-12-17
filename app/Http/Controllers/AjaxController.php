<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
class AjaxController extends Controller
{
	//lọc lấy tên loại tin thuộc thể loại
    public function getLoaiTin($idTheLoai)
    {
    	$loaitin = LoaiTin::where('idTheLoai',$idTheLoai)->get();//dkien loc idTheLoai đang chọn trong danh sách thể loại = idTheLoai trong loại tin
    	foreach($loaitin as $lt)
    	{
       	 	echo "<option value='".$lt->id."'>".$lt->Ten."</option>";
    	}
        
    }
}
