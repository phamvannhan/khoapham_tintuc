@extends('Admin.layout.master')

@section('content')
<div id="page-wrapper" style="min-height: 611px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại Tin
                            <small>Thêm Mới</small>
                        </h1>
                    </div>
                            @if(session('thongbao'))
                                <div class="alert alert-success">
                                    {{session('thongbao')}}
                                </div>
                            @endif
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="{{route('addLOAITIN')}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                             <div class="form-group">
                                <label>Tên Thể Loại</label>
                                <select name="TenTheLoai" class="form-control">
                                    @foreach($theloai as $tl)
                                    <!--xuat ra danh sach ten cac the loai-->
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                     @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên Loại Tin</label>
                                    @if($errors->has('Ten'))
                                        <p class="alert-danger">
                                            {{$errors->first('Ten')}}
                                        </p>
                                    @endif
                                <input class="form-control" name="Ten"  placeholder="Vui lòng nhập vào tên">
                                
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