@extends('Admin.layout.master')

@section('content')
<div id="page-wrapper" style="min-height: 611px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin Tức
                            <small>Thêm Mới</small>
                        </h1>
                    </div>
                            @if(session('thongbao'))
                                <div class="alert alert-success">
                                    {{session('thongbao')}}
                                </div>
                            @endif
                             @if(session('loi'))
                                <div class="alert alert-danger">
                                    {{session('loi')}}
                                </div>
                            @endif
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="{{route('addTINTUC')}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                             <div class="form-group">
                                <label>Tên Thể Loại</label>
                                <select name="TenTheLoai" class="form-control" id="TheLoaiAjax">
                                    @foreach($theloai as $tl)
                                    <!--xuat ra danh sach ten cac the loai-->
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                     @endforeach
                                </select>
                            </div>
                            <div class="form-group"><!--dùng trang ajax-->
                                <label>Tên Loại Tin</label>
                                <select name="TenLoaiTin" id="LoaiTin" class="form-control"><!--load trang ajax loai tin ve-->
                                    @foreach($loaitin as $lt)
                                        <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div class="form-group">
                                <label>Tiêu Đề</label>
                                @if($errors->has('TieuDe'))
                                    <div class="alert-danger">
                                        {{$errors->first('TieuDe')}}
                                    </div>
                                @endif
                                <input class="form-control" name="TieuDe"  placeholder="Vui lòng nhập vào tên tiêu đề">
                            </div>
                            <div class="form-group">
                                <label>Tóm Tắt</label>
                                     @if($errors->has('TomTat'))
                                        <div class="alert-danger">
                                            {{$errors->first('TomTat')}}
                                        </div>
                                    @endif
                                <textarea name="TomTat" class="form-control ckeditor" id="demo" rows="2"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Nội Dung</label>
                                     @if($errors->has('NoiDung'))
                                        <div class="alert-danger">
                                            {{$errors->first('NoiDung')}}
                                        </div>
                                    @endif
                                <textarea name="NoiDung" class="form-control ckeditor" id="demo"></textarea>
                            </div>
                             <div class="form-group">
                                <label>Hình Ảnh</label>
                                     @if($errors->has('Hinh'))
                                        <div class="alert-danger">
                                            {{$errors->first('Hinh')}}
                                        </div>
                                    @endif
                                <input  type="file" class="form-control" name="Hinh"  placeholder="Vui lòng nhập vào tên">
                            </div>
                            <div class="form-group">   
                                <label >Trạng Thái Nổi Bật</label>
                                <label class="radio-inline">
                                    <input name="NoiBat" type="radio" checked=""  value="1">Có
                                </label>
                                <label class="radio-inline">
                                    <input name="NoiBat" type="radio"  value="0">Không
                                </label>
                            </div>
                            <button type="submit" class="btn btn-info">Thêm Mới</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        
                    </form></div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection

@section('script') <!--chèn vào phần scipt của trang index-->
        <script>
           $(document).ready(function() {
                $("#TheLoaiAjax").change(function(event) {
                    //load trang ajax về như load 1 trang loại tin về sử dụng route
                   var idTheLoai = $(this).val(); //lấy dc id của thể loại đang chọn, truyền idTheLoai đi
                   //alert(Ten);
                     $.get("admin/ajax/loaitinAjax/"+idTheLoai,function(data){//theo route->controller
                         $("#LoaiTin").html(data); // load 1 trang html mới
                     });
                });
            });
        </script>
@endsection

