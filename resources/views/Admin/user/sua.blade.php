@extends('Admin.layout.master')

@section('content')
<div id="page-wrapper" style="min-height: 611px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chỉnh sửa thông tin user
                            <small>{{$user->name}}</small>
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
                        <form action="admin/user/sua/{{$user->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Tên người dùng</label>
                                 @if($errors->has('name'))
                                     <div class="alert-danger">
                                         {{$errors->first('name')}}
                                     </div>
                                 @endif
                                <input class="form-control" name="name" value="{{$user->name}}"  placeholder="Vui lòng nhập vào tên người dùng">
                            </div>
                            
                            <div class="form-group">
                                <label>Email</label>
                                 @if($errors->has('email'))
                                     <div class="alert-danger">
                                         {{$errors->first('email')}}
                                     </div>
                                 @endif
                                <input type="email" class="form-control" name="email" readonly="true" value="{{$user->email}}">
                            </div>

                            <div class="form-group">
                            	<input type="checkbox" name="changePass" id="changePass">
                            	<label>Đổi mật khẩu</label>
                                 @if($errors->has('Pass'))
                                     <div class="alert-danger">
                                         {{$errors->first('Pass')}}
                                     </div>
                                 @endif
                                <input type="password" class="form-control password" name="Pass" placeholder="Vui lòng nhập mật khẩu" value="{{$user->password}}" disabled="" >
                            </div>
                            <div class="form-group">
                                <label>Nhập Lại Mật Khẩu</label>
                                 @if($errors->has('Pass2'))
                                     <div class="alert-danger">
                                         {{$errors->first('Pass2')}}
                                     </div>
                                 @endif
                                <input type="password" class="form-control password" name="Pass2" disabled="" value="{{$user->password}}" >
                            </div>
                          
                            <div class="form-group">
                                <label >Chọn quyền sử dụng:</label>
                                <label class="radio-inline">
                                    <input 
									@if($user->quyen == 1)
										{{"checked"}}
									@endif
                                    name="quyen" type="radio" value="1">Admin
                                </label>
                                <label class="radio-inline">
                                    <input 
									@if($user->quyen == 0)
										{{"checked"}}
									@endif
                                    name="quyen" type="radio" value="0" >Người dùng
                                </label>
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

<!--sử dụng js để ktra khi nhấn nút đổi mk thì mở 2 cái input ra (remove==disabel), ko thì add vào--> 
@section('script')
	<script>
		$(document).ready(function() {
			$("#changePass").change(function(event) {
				//ktra có checkbox hay ko dùng  is
				if($(this).is(':checked'))
				{
					$(".password").removeAttr('disabled');//nếu có check thì bỏ disable ra
				}
				else
				{
					$(".password").attr('disabled', '');//ko thì thêm disable vào 
				}
			});
		});
	</script>
@endsection