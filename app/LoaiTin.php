<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaiTin extends Model
{
   protected $table = "LoaiTin";

    public function theloai() //thuoc the loai và sử dụng để kế thừa từ Thể Loại
    {
    	return $this->belongsTo('App\TheLoai','idTheLoai','id');
    }
    public function tintuc()//trong loại tin có nhiều tin tức
    {
    	return $this->hasMany('App\TinTuc','idLoaiTin','id');
    }
}
