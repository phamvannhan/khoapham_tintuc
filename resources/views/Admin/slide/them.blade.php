@extends('Admin.layout.master')

@section('content')
<div id="page-wrapper" style="min-height: 611px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
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
                        <form action="{{route('addSlide')}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Tên Slide</label>
                                @if($errors->has('Ten'))
                                    <div class="alert-danger"> 
                                    {{$errors->first('Ten')}}  
                                    </div>
                                @endif
                                <input class="form-control" name="Ten" value="{{ old('Ten') }}"  placeholder="Vui lòng nhập vào tên slide">
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                  @if($errors->has('Hinh'))
                                    <div class="alert-danger"> 
                                    {{$errors->first('Hinh')}}  
                                    </div>
                                @endif
                                <input class="form-control" value="{{old('Hinh')}}"  type="file" name="Hinh" />
                            </div>
                            <div class="form-group">
                                <label>Link</label>
                                  @if($errors->has('link'))
                                    <div class="alert-danger"> 
                                    {{$errors->first('link')}}  
                                    </div>
                                @endif
                                <input type="text" class="form-control" name="link" value="{{ old('link') }}" placeholder="Vui lòng nhập vào đường dẫn">
                            </div>
                          
                            <div class="form-group">
                                <label>Nội dung</label>
                                  @if($errors->has('NoiDung'))
                                    <div class="alert-danger"> 
                                    {{$errors->first('NoiDung')}}  
                                    </div>
                                @endif
                                <textarea class="form-control ckeditor" name="NoiDung" rows="3" id="demo" >{!! old('NoiDunng')}}</textarea>
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