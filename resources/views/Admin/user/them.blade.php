@extends('Admin.layout.master')

@section('content')
<div id="page-wrapper" style="min-height: 611px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Người Dùng
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
                        <form action="{{route('addUSERS')}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Tên người dùng</label>
                                 @if($errors->has('name'))
                                     <div class="alert-danger">
                                         {{$errors->first('name')}}
                                     </div>
                                 @endif
                                <input class="form-control" name="name" value=""  placeholder="Vui lòng nhập vào tên người dùng">
                            </div>
                            
                            <div class="form-group">
                                <label>Mật Khẩu</label>
                                 @if($errors->has('Pass'))
                                     <div class="alert-danger">
                                         {{$errors->first('Pass')}}
                                     </div>
                                 @endif
                                <input type="password" class="form-control" name="Pass" placeholder="Vui lòng nhập mật khẩu">
                            </div>
                            <div class="form-group">
                                <label>Nhập Lại Mật Khẩu</label>
                                 @if($errors->has('Pass2'))
                                     <div class="alert-danger">
                                         {{$errors->first('Pass2')}}
                                     </div>
                                 @endif
                                <input type="password" class="form-control" name="Pass2"  placeholder="Vui lòng nhập mật khẩu">
                            </div>
                          
                            <div class="form-group">
                                <label>Email</label>
                                 @if($errors->has('email'))
                                     <div class="alert-danger">
                                         {{$errors->first('email')}}
                                     </div>
                                 @endif
                                <input type="email" class="form-control" name="email" placeholder="Vui lòng nhập địa chỉ email">
                            </div>
                            <div class="form-group">
                                <label >Chọn quyền sử dụng:</label>
                                <label class="radio-inline">
                                    <input name="quyen" type="radio" value="1">Admin
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" type="radio" value="0" checked="">Người dùng
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