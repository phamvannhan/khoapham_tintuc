<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    protected $table = "TheLoai";

    public function loaitin()
    {
    	return $this->hasMany('App\LoaiTin','idTheLoai','id');
    	//hasMany co nhieu loai tin==>khoa ngoai, khoa chinh
    }
    public function tintuc()
    {
    	return $this->hasManyThrough('App\TinTuc','App\LoaiTin','idTheLoai','idLoaiTin','id');
    	//do loai tin la bang lien ket trung gian giua tin tuc vs theloai = idLoaiTin,idTheLoai
    }
}
