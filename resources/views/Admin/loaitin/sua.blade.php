@extends('Admin.layout.master')

@section('content')
<div id="page-wrapper" style="min-height: 611px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chỉnh Sửa Loại Tin
                            <small>{{$loaitin->Ten}}</small>
                        </h1>
                    </div>
                     @if(count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}} <br>
                            @endforeach
                        </div>
                            @endif
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
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                             <div class="form-group">
                                <label>Tên Thể Loại</label>
                                <select name="TenTheLoai" class="form-control">
                                    @foreach($theloai as $tl)
                                        <!--xuat ra danh sach ten, cho if chạy trong option-->
                                         <option 
                                             @if( $tl->id == $loaitin->idTheLoai)
                                             {{"selected"}}
                                             @endif
                                            value="{{$tl->id}}">{{$tl->Ten}}
                                         </option>
                                     @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên Loại Tin</label>
                                <input class="form-control" name="Ten" value="{{$loaitin->Ten}}" placeholder="Vui lòng nhập vào tên">
                            </div>
                            <button type="submit" class="btn btn-info">Chỉnh Sửa</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        
                    </form></div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection