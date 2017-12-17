<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    protected $table = "TinTuc";

    public function loaitin() //loaitin để sử dụng cho hàm kế thức của tintuc
    {
    	return $this->belongsTo('App\LoaiTin','idLoaiTin','id');
    }
    public function comment()
    {
    	return $this->hasMany('App\Comment','idTinTuc','id'); 
        
    	//1 tin có tin tức khác nhau
    }
}
