@extends('Admin.layout.master')

@section('content')
<div id="page-wrapper" style="min-height: 611px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
                            <small>Chỉnh Sửa</small>
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
                        <form action="admin/slide/sua/{{$slide->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Tên Slide</label>
                                <input class="form-control" name="Ten" value="{{$slide->Ten}}"  placeholder="Vui lòng nhập vào tên slide">
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <p><img src="upload/slide/{{$slide->Hinh}}" width="400px"></p>
                                <input class="form-control"  type="file" name="Hinh" />
                            </div>
                            <div class="form-group">
                                <label>Link</label>
                                <input type="text" class="form-control" name="link" value="{{$slide->link}}" placeholder="Vui lòng nhập vào đường dẫn">
                            </div>
                          
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="form-control ckeditor" name="NoiDung" rows="3" id="demo">{{$slide->NoiDung}}</textarea>
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