<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuc;
use App\TheLoai;
use App\LoaiTin;
use App\Comment;
class TinTucController extends Controller
{
	public function __construct()
	{
		$theloai = TheLoai::all();
		
		return view()->share('theloai',$theloai);
	}
    public function  getList()
    {
    	$tintuc = TinTuc::all();
    	return view('admin.tintuc.danhsach',compact('tintuc'));
    	//$tintuc = TinTuc::orderBy('id','DESC')->get(); //ham lay va sap xep 
    }
    public function getAdd()
    {
    	$loaitin = LoaiTin::all();
    	return view('admin.tintuc.them',compact('loaitin'));
    }
    public function postAdd(Request $req)
    {
        $this->validate($req,
            [
                'TieuDe'=>'required|unique:TinTuc,TieuDe|min:5',
                'TomTat'=>'required|min:10',
                'NoiDung'=>'required|min:10',
                'Hinh'=>'required'
            ],[
                'TieuDe.required'=>'Vui lòng nhập vào tiêu đề !',
                'TieuDe.min'=>'Tiêu đề chứa ít nhất 5 ký tự !',
                'TomTat.required'=>'Vui lòng nhập vào tóm tắt !',
                'TomTat.min'=>'Tiêu đề chứa ít nhất 10 ký tự !',
                'NoiDung.required'=>'Nội dung chưa được nhập!',
                'NoiDung.min'=>'Tiêu đề chứa ít nhất 10 ký tự !',
                'Hinh.required'=>'Hình ảnh chưa được chọn !'
            ]); 
        $tintuc = new TinTuc;
        $tintuc->idLoaiTin=$req->TenLoaiTin;
        $tintuc->TieuDe = $req->TieuDe;
        $tintuc->TomTat = $req->TomTat;
        $tintuc->TieuDeKhongDau = changeTitle($req->TieuDe);
        $tintuc->NoiDung = $req->NoiDung;
        if($req->NoiBat == 0)//nếu chọn req NB có value=0
        {
        	$tintuc->NoiBat =0;//luu vào csdl la 0
        }
        else
        {
        	$tintuc->NoiBat=1;
        }

         if($req->hasFile('Hinh')) //nếu request có firl tên hình
        {
            $file = $req->file('Hinh'); 
            $duoi = $file->getClientOriginalExtension(); //yêu cầu đuôi file
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') 
                {
                    return redirect('admin/tintuc/them')->with('loi','Bạn chỉ được chọn file ảnh có đuôi jpg,png,jpeg');
                }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/tintuc/".$Hinh)) 
                {
                    $Hinh = str_random(4)."_".$name;
                }
            $file->move("upload/tintuc",$Hinh); // chuyển file mới vào thư mục máy
            $tintuc->Hinh = $Hinh; // tải lên web

        }
        else
        {
            $tintuc->Hinh = "";
        }
        $tintuc->save();
        return redirect()->back()->with('thongbao','Bạn đã thêm thành công !');
    }
    //sửa
    public function getEdit($id)
    {
    	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::all();
    	$tintuc = TinTuc::find($id);
        $comment = Comment::all();
        //$comment = Comment::where('idTinTuc','id')->get();//dkien idTinTuc = id đã chọn
    	return view('admin/tintuc/sua',['theloai'=>$theloai,'loaitin'=>$loaitin,'tintuc'=>$tintuc,'comment'=>$comment]);
    }

    public function postEdit(Request $req,$id)
    {
        $this->validate($req,
             [
                'TieuDe'=>'required|min:5',
                'TomTat'=>'required|min:10',
                'NoiDung'=>'required|min:10',
                
            ],[
                'TieuDe.required'=>'Vui lòng nhập vào tiêu đề !',
                'TieuDe.min'=>'Tiêu đề chứa ít nhất 5 ký tự !',
                'TomTat.required'=>'Vui lòng nhập vào tóm tắt !',
                'TomTat.min'=>'Tiêu đề chứa ít nhất 10 ký tự !',
                'NoiDung.required'=>'Nội dung chưa được nhập!',
                'NoiDung.min'=>'Tiêu đề chứa ít nhất 10 ký tự !',
            ]); 
         $tintuc = TinTuc::find($id);
         $tintuc->idLoaiTin = $req->TenLoaiTin;//sửa lại idloaitin nếu cần
         $tintuc->TieuDe = $req->TieuDe;
        $tintuc->TomTat = $req->TomTat;
        $tintuc->TieuDeKhongDau = changeTitle($req->TieuDe);
        $tintuc->NoiDung = $req->NoiDung;
        $tintuc->NoiBat = $req->NoiBat;
        if( $tintuc->checked == 0)
        {
             //$request->NoiBat = 1;
             $req->NoiBat = 0;
        }
        else
        {
            //$request->NoiBat=0;
            $req->NoiBat = 1;
        }

         if($req->hasFile('Hinh')) //nếu request có firl tên hình
        {
            $file = $req->file('Hinh'); 
            $duoi = $file->getClientOriginalExtension(); //yêu cầu đuôi file
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') 
                {
                    return redirect('admin/tintuc/them')->with('loi','Bạn chỉ được chọn file ảnh có đuôi jpg,png,jpeg');
                }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/tintuc/".$Hinh)) 
                {
                    $Hinh = str_random(4)."_".$name;
                }
            $file->move("upload/tintuc",$Hinh); // chuyển file mới vào thư mục máy
            unlink("upload/tintuc/".$tintuc->Hinh);//gỡ bỏ file cũ
            $tintuc->Hinh = $Hinh; // tải lên web

        }
        $tintuc->save();
        
        return redirect()->back()->with('thongbao','Bạn đã sửa tin tức mới thành công !');
    }

     public function getDelete($id)
    {
        $tintuc = TinTuc::find($id);
        $tintuc->delete();
        if($tintuc == 1)
        {
            return redirect('admin/tintuc/danhsach')->with('thongbao','Xoá thành công');
        }
        else
        {
            return redirect('admin/tintuc/danhsach')->with('loi','Xoá thành công');
        }
        
    }
}
