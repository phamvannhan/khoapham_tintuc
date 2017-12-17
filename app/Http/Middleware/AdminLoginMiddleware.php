<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;//sử dụng lệnh auth
use Closure;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //ktra đề phòng vào route khác mà ko đăng nhập
        if(Auth::check())
        {
            $user = Auth::user();
           if($user->quyen == 1)//ktra quyen user dung ko
                return $next($request);
           else
           //return redirect('admin/dangnhap');
           //return response()->view('admin.login');
           return response()->view('admin/Login');
        }
        //nếu nhập sai thì băt quay lại đăng nhập tiếp
        else
        {
            //return redirect('admin/dangnhap');
            return response()->view('admin/Login');
        }//
    }
}
