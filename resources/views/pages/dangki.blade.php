@extends('layout.index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Vui lòng điền đăng kí thông tin dưới đây</h3>
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
                    </div>
                    <div class="panel-body" style="margin-left: 5px;">
                       <form class="form-horizontal" method="POST" action="dangki">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <fieldset>
                             <div class="form-group">
                                    @if($errors->has('name'))
                                         <div class="alert-danger">
                                             {{$errors->first('name')}}
                                         </div>
                                     @endif
                                     <label>Name:</label>
                                    <input class="form-control" placeholder="nhập vào tên ..." name="name" type="text"  value="{{old('name')}}">
                                </div>
                                <div class="form-group">
                                    @if($errors->has('email'))
                                         <div class="alert-danger">
                                             {{$errors->first('email')}}
                                         </div>
                                     @endif
                                     <label>Email:</label>
                                    <input class="form-control" placeholder="nhập vào email" name="email" type="email"  value="{{old('email')}}">
                                </div>
                                <div class="form-group">
                                    @if($errors->has('password'))
                                     <div class="alert-danger">
                                         {{$errors->first('password')}}
                                     </div>
                                     @endif
                                     <label>Password:</label>
                                    <input class="form-control" placeholder="nhập vào password" name="password" type="password" >
                                </div>
                                 <div class="form-group">
                                    @if($errors->has('password2'))
                                     <div class="alert-danger">
                                         {{$errors->first('password2')}}
                                     </div>
                                     @endif
                                     <label>Password Confirm:</label>
                                    <input class="form-control" placeholder="nhập xác nhận password" name="password2" type="password" >
                                </div>
                               
                                <button type="submit" class="btn btn-lg btn-danger btn-block">Register</button>
                                
                            </fieldset>
                        </form>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection