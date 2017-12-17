<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\Auth;//sử dụng lệnh auth để đăng nhập và kiểm tra
class PageController extends Controller
{
	public function __construct()
	{
		$slide = Slide::all();
		$theloai = TheLoai::all();
		
		view()->share('slide',$slide);
		view()->share('theloai',$theloai);

	}
    public function TrangChu()
    {
    	$theloaiPhanTrang = TheLoai::orderBy('Ten','DESC')->paginate(5);
    	//ko dùng share, lọc dkien phân trang cho 5tin/1trang
    	return view('pages.trangchu',compact('theloaiPhanTrang'));
    }
    public function LoaiTin($id)
    {
    	$loaitin = LoaiTin::find($id);
    	//so sánh where ddieu kiện where('idloaitin',$id) $id ko đặt trong ''
    	$tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
    	return view('pages.loaitin',compact('loaitin','tintuc'));
    }
    public function TinTuc($id)
    {
    	$tintuc = TinTuc::where('id',$id)->first();//đã tìm dc id và xuất ra view
        //tin lien quan là cùng loại tin có nhiều tin tức where('idLoaiTin',$id)
        $tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();//take đem ra 4 loai tin lien quan
        $tinnoibat = TinTuc::where('NoiBat','1')->take(4)->get();
       //$tinkhac = TinTuc::where('tinnoibat','<>',$tintu->idLoaiTin) ?? chưa tìm ra cùng id mà ko xuất hiện nhiều lần
    	return view('pages.chitiet',compact('tintuc','tinlienquan','tinnoibat'));
    }
    //bài 36 tìm kiếm từ khoá tin tức trên trang chủ
    function timkiem(Request $req)
    {
        $tukhoa = $req->tukhoa;//trỏ sang name=tukhoa ở header
        $tintuc = TinTuc::where('TieuDe','like',"%$tukhoa%")->orWhere('TieuDe','like',"%$tukhoa%")->orWhere('NoiDung','like',"%$tukhoa%")->take(20)->paginate(5);
        //lấy 30 kqua tìm kiếm và phân trang trong 5tin
        return view('pages.timkiem',compact('tukhoa','tintuc'));
    }

    //controller đăng nhập,đăng xuất cho người dùng
    public function LoginUser()
    {
        return view('pages.dangnhap');
    }
    public function postLoginUser(Request $req)
    {
        $this->validate($req,[

            'email'=>'required|email',
             'password'=>'required'
            ],[
            'email.required'=>'Vui lòng nhập vào email !',
            'email.email'=>'Email không đúng định dạng !',
            'password.required'=>'Bạn chưa nhập vào password'

            ]);

        $dl =array('email'=>$req->email, 'password'=>$req->password);
        if (Auth::attempt($dl)) {
            return redirect('/');
           //$user = Auth::user();
           //echo $user->name;
        }
        else
            return redirect('/')->with('loi','Lỗi đăng nhập, xin kiểm tra lại !');
    }
    public function LogoutUser()
    {
        Auth::logout();
        return redirect('/');
    }

    //đăng kí user người dùng
    public function RegisterUser()
    {
        return view('pages.dangki');
    }
    public function postRegisterUser(Request $req)
    {
        $this->validate($req,[
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
             'password'=>'required',
             'password2'=>'required|same:password'
            ],[
            'name.required'=>'Bạn chưa nhập vào tên',
            'email.required'=>'Vui lòng nhập vào email !',
            'email.email'=>'Email không đúng định dạng !',
            'email.unique'=>'Email đã tồn tại',
            'password.required'=>'Bạn chưa nhập vào password',
            'password2.required'=>'Bạn chưa nhập vào password',
            'password2.same'=>'mật khẩu nhập lại không khớp !'

            ]);
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = bcrypt($req->password);
        $user->quyen =0; //chỉ cho người dùng quyền 0 vì 1 đã là admin
        $user->save();
        return redirect()->back()->with('thongbao','Đăng kí tài khoản thành công !');
    }
}
