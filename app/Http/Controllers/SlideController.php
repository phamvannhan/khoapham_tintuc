<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class SlideController extends Controller
{
    public function getList(){

    	$slide = Slide::paginate(3);
    	return view('Admin.slide.danhsach',compact('slide'));
    }
    //-------------phần thêm mới slide------------------------
    public function getAdd()
    {
        return view('admin.slide.them');
    }
    public function postAdd(Request $request)
    {
        $this->validate($request,
            [
                'Ten'=>'required|unique:Slide,Ten|min:5|max:20',
                'link'=>'required',
                'NoiDung'=>'required',
                'Hinh'=>'required|unique:Slide,Hinh'
            ],[
                'Ten.unique'=>'Tên slide đã tồn tại',
                'Ten.required'=>'Bạn chưa nhập vào tên slide',
                'link.required'=>'Bạn chưa nhập vào đường dẫn',
                'Hinh.required'=>'Bạn chưa chọn vào hình ảnh',
                'NoiDung.required'=>'Phần nội dung không được bỏ trống'
            ]);
        $slide = new Slide; //thêm mới
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
       if($request->has('link'))
            { $slide->link = $request->link;}
        if($request->hasFile('Hinh')) //nếu request có firl tên hình
        {
            $file = $request->file('Hinh'); 
            $duoi = $file->getClientOriginalExtension(); //yêu cầu đuôi file
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') 
                {
                    return redirect('admin/slide/them')->with('loi','Bạn chỉ được chọn file ảnh có đuôi jpg,png,jpeg');
                }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/slide/".$Hinh)) 
                {
                    $Hinh = str_random(4)."_".$name;
                }
            $file->move("upload/slide",$Hinh); // chuyển file mới vào thư mục máy
            $slide->Hinh = $Hinh; // tải lên web

        }
        else
        {
            $slide->Hinh = "";
        }
        $slide->save();

        return back()->with('thongbao','Bạn đã thêm thành công !');
    }


    //-------------Phần chỉnh sửa slide----------------------
     public function getEdit($id){

        $slide = Slide::find($id);
    	
    	return view('Admin.slide.sua',compact('slide'));
    }
    public function postEdit(Request $request,$id)
    {
    	$this->validate($request,[
    		'Ten'=>'required',
    		'link'=>'required',
    		'NoiDung'=>'required'
    		],[
    		'Ten.required'=>'Bạn chưa nhập vào tên hình ảnh',
    		'link.required'=>'Bạn chưa nhập vào đường dẫn',
    		'NoiDung.required'=>'Phần nội dung không được bỏ trống'

    		]);
    	$slide = Slide::find($id);
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        if($request->has('link'))//ktra nếu đã có link rồi
            $slide->link = $request->link;
        if($request->hasFile('Hinh')) //TH: đã có fiile
        {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'jpeg' && $duoi != 'png')
            {
                return redirect('admin/slide/sua/'.$id)->with('loi','Bạn chỉ được chọn file có đuôi jpg,png,jpeg');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/slide/".$Hinh)) {
                $Hinh = str_random(4)."_".$name;
            }
           unlink("upload/slide/".$slide->Hinh);
            $file->move("upload/slide",$Hinh);
            $slide->Hinh = $Hinh;
        }
        $slide->save();
        return redirect('admin/slide/sua/'.$id)->with('thongbao',"Chỉnh sửa thành công");
    }
    public function getDelete($id)
    {
        $slide = Slide::find($id);
        $slide->delete();
        return redirect()->back()->with('thongbao',"Xoá thành công");
    }
}
