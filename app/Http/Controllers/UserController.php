<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;//sử dụng lệnh auth
use App\User;
use Hash;
class UserController extends Controller
{
    public function getList()
    {
    	$user = User::orderBy('quyen','DESC')->get();//sắp xếp theo quyền admin trước
    	return view('admin.user.danhsach',compact('user'));
    }
    public function getAdd()
    {
    	return view('admin.user.them');
    }

    public function postAdd(Request $req)
    {
    	$this->validate($req,
    		[
    			'name'=>'required|min:3|max:20',
    			'Pass'=>'required|min:5|max:32',
    			'Pass2'=>'required|same:Pass',//same -->phai giong pass đầu tiên
    			'email'=>'required|email|unique:users,email|'//ko dc trung email
    		],[
    			'name.required'=>'Bạn chưa nhập tên người dùng',
    			'name.min'=>'Tên người dùng phải chứa từ 3 đến 20 ký tự',
    			'email.required'=>'Bạn chưa nhập địa chỉ Email',
    			'email.email'=>'Bạn chưa nhập đúng định dạng Email',
    			'email.unique'=>'Email đã tồn tại',
    			'Pass.required'=>'Bạn chưa nhập mật khẩu',
    			'Pass.min'=>'Mật khẩu ít nhất từ 5 đến 32 ký tự',
    			'Pass.max'=>'Mật khẩu ít nhất từ 5 đến 32 ký tự',
    			'Pass2.required'=>'Bạn chưa lại nhập mật khẩu lần 2',
    			'Pass2.same'=>'Mật khẩu nhập lại chưa khớp'
    		]);
    	$user = new User;
    	$user->name = $req->name;
    	$user->password = Hash::make($req->Pass);
    	//$user->password = bcrypt($request->Pass);//bcrypt mã hoá ???tìm cách giải mã
    	$user->email = $req->email;
    	if($user->quyen == 0)
    	{
    		$req->quyen =0;
    	}
    	else
    	{
    		$req->quyen=1;
    	}
    	$user->save();
    	return redirect()->back()->with('thongbao','Thêm user mới thành công !');
    }
    //có dùng javascript để mở checkbox thay đổi mật khẩu hay không?
    public function getEdit($id)
    {
    	$user = User::find($id);
    	return view('admin.user.sua',compact('user'));
    }
    public function postEdit(Request $req, $id)
    {
    	$this->validate($req,
    		[
    			'name'=>'required|min:3|max:20'
    		],[
    			'name.required'=>'Bạn chưa nhập tên người dùng',
    			'name.min'=>'Tên người dùng phải chứa từ 3 đến 20 ký tự',
    			
    		]);
    	$user = User::find($id);
    	$user->name = $req->name;
    	$user->email = $req->email;
    	$user->quyen = $req->quyen;
    	if($req->changePass == "on")
    	{
    		$this->validate($req,
    		[
    			'Pass'=>'required|min:2|max:32',
    			'Pass2'=>'required|same:Pass',//same -->phai giong pass đầu tiên
    		],[
    			'Pass.required'=>'Bạn chưa nhập mật khẩu',
    			'Pass.min'=>'Mật khẩu ít nhất từ 2 đến 32 ký tự',
    			'Pass.max'=>'Mật khẩu ít nhất từ 2 đến 32 ký tự',
    			'Pass2.required'=>'Bạn chưa lại nhập mật khẩu lần 2',
    			'Pass2.same'=>'Mật khẩu nhập lại chưa khớp'
    		]);
    		$user->password = Hash::make($req->Pass); //nếu thay đổi thì lưu mk mới
    		//$user->password = bcrypt($request->Pass);//bcrypt mã hoá ???tìm cách giải mã
    	}
    	$user->save();
    	return redirect()->back()->with('thongbao','Chỉnh sửa user mới thành công !');
    }

    public function getDelete($id)
    {
    	$user = User::find($id);
    	$user->delete();
        return redirect()->back()->with('thongbao','Đã xoá 1 user thành công !');
        if($user->fail())
        {
            return redirect()->back()->with('loi','Không thể xoá user nầy !');
        }
        
    	
    	//phải có thông báo cho ngời dùng mún xoá hay ko....???
    	//trường hợp có khoá ngoại với comment thì ko xoá dc?????
    }

    //tạo trang đăng nhập cho admin
  
    public function getLogin(){
        
            return view('Admin.login');
    }

    public function postLogin(Request $req){
       $this->validate($req,
            [
                'email' => 'required',
                'password' => 'required|min:2|max:32'
            ],
            [
                'email.required' => 'Bạn chưa nhập Địa chỉ Email!',
                'password.required' => 'Bạn chưa nhập Mật khẩu!',
                'password.min' => 'Mật Khẩu gồm tối thiểu 2 ký tự!',
                'password.max' => 'Mật Khẩu gồm tối đa 32 ký tự!'
            ]);
       
       /* chạy đúng nhưng ko dùng Auth
        $email=$request->input('email');
        $pwd=$request->input('password');
        $data=with(new User)->Login($email,$pwd);
        $row=count($data);
        if($row > 0){
            return redirect('admin/theloai/danhsach')->with('thongbao','Đăng Nhập  thành công!');
        }else{
          //  return redirect()->back()->with('loi','Đăng Nhập không thành công!');
              return view('admin.login')->with('loi','Đăng Nhập không thành công!');
        }
        */
        //dùng lệnh Auth có laravel có sẵn
        
        $dl = array('email' => $req->email, 'password' => $req->password);
        if (Auth::attempt($dl)) {
           
            //$user = Auth::user();
            //echo $user->name;
            
            return redirect()->route('listUSERS')->with('thongbao','Đăng nhập thành công');

        }
        else
        {
            //echo "loi dang nhap !";
           return redirect()->back()->with('loi','Đăng nhập thất bại, vui lòng kiểm tra lại !');
        }
    }
    //route logout admin
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('adminLogin');
    }
}
