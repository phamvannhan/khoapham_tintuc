@extends('Admin.layout.master')

@section('content')
<div id="page-wrapper" style="min-height: 611px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chỉnh sửa tin tức
                            <small>{{$tintuc->TieuDe}}</small>
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
                        <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                             <div class="form-group">
                                <label>Tên Thể Loại</label>
                                <select name="TenTheLoai" class="form-control" id="TheLoaiAjax">
                                    @foreach($theloai as $tl) <!--chạy danh sach ten cac the loai-->
                                       <!--dieu kien id sửa = id theloai-->
                                        <!--nếu id = thì chọn 1 selected trong danh sách-->
                                        <option 
                                        @if($tintuc->loaitin->theloai->id == $tl->id)
                                            {{"selected"}} 
                                        @endif 
                                        value="{{$tl->id}}">{{$tl->Ten}}
                                        </option>
                                     @endforeach

                                </select>
                            </div>
                            <div class="form-group"><!--dùng trang ajax-->
                                <label>Tên Loại Tin</label>
                                <select name="TenLoaiTin" id="LoaiTin" class="form-control" ><!--load trang ajax loai tin ve-->
                                    @foreach($loaitin as $lt)
                                        <option
                                        @if($tintuc->idLoaiTin== $lt->id)
                                            {{"selected"}} 
                                        @endif 
                                         value="{{$lt->id}}">{{$lt->Ten}}</option>
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
                                <input class="form-control" name="TieuDe"  placeholder="Vui lòng nhập vào tên tiêu đề" value="{{$tintuc->TieuDe}}" >
                            </div>
                            <div class="form-group">
                                <label>Tóm Tắt</label>
                                     @if($errors->has('TomTat'))
                                        <div class="alert-danger">
                                            {{$errors->first('TomTat')}}
                                        </div>
                                    @endif
                                <textarea name="TomTat" class="form-control ckeditor" id="demo" rows="2">{{$tintuc->TomTat}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Nội Dung</label>
                                     @if($errors->has('NoiDung'))
                                        <div class="alert-danger">
                                            {{$errors->first('NoiDung')}}
                                        </div>
                                    @endif
                                <textarea name="NoiDung" class="form-control ckeditor" id="demo">{{$tintuc->NoiDung}}</textarea>
                            </div>
                             <div class="form-group">
                                <label>Hình Ảnh</label>
                                     @if($errors->has('Hinh'))
                                        <div class="alert-danger">
                                            {{$errors->first('Hinh')}}
                                        </div>
                                    @endif
                                <p><img src="upload/tintuc/{{$tintuc->Hinh}}" width="100px" height="80px"></p>
                                <input  type="file" class="form-control" name="Hinh" >
                            </div>
                            <div class="form-group">   
                                <label >Trạng Thái Nổi Bật</label>
                                
                                <label class="radio-inline">
                                    <input value="1" 
                                         @if($tintuc->NoiBat == 1)
                                            {{"checked"}}
                                          @endif
                                    name="NoiBat" type="radio"  >Có
                                </label>
                                <label class="radio-inline">
                                    <input value="0" 
                                         @if($tintuc->NoiBat == 0)
                                            {{"checked"}}
                                          @endif
                                       name="NoiBat" type="radio">Không
                                </label>
                            </div>
                            <button type="submit" class="btn btn-info">Chỉnh Sửa</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        
                    </form></div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

         <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Bình Luận
                            <small>Danh Sách</small>
                        </h1>
                         
                        </div>
                         @if(session('tbXoaBL'))
                                <div class="alert alert-success">
                                    {{session('tbXoaBL')}}
                                </div>
                            @endif
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Người Dùng</th>
                                <th>Nội Dung</th>
                                <th>Ngày Đăng</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($tintuc->comment as $cm)
                            <tr class="odd gradeX" align="center">
                                <td>{{$cm->id}}</td>
                                <td>{{$cm->users->name}}</td>
                                <td>{{$cm->NoiDung}}</td>
                                <td>{{$cm->created_at}}</td>
                                <td><a href="admin/delComment/{{$cm->id}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                            </tr>
                       @endforeach
                        </tbody>
                    </table>
                  
                </div>
                <!-- /.row -->
        </div><!--end div page-wrapper-->

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


