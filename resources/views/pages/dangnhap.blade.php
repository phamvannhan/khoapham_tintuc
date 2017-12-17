@extends('layout.index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
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
                    <div class="panel-body">
                       <form class="form-horizontal" method="POST" action="dangnhap">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <fieldset>
                                <div class="form-group">
                                    @if($errors->has('email'))
                                         <div class="alert-danger">
                                             {{$errors->first('email')}}
                                         </div>
                                     @endif
                                    <input class="form-control" placeholder="nhập vào email" name="email" type="email"  value="{{old('email')}}">
                                </div>
                                <div class="form-group">
                                    @if($errors->has('password'))
                                     <div class="alert-danger">
                                         {{$errors->first('password')}}
                                     </div>
                                     @endif
                                    <input class="form-control" placeholder="nhập vào password" name="password" type="password" >
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                                
                            </fieldset>
                        </form>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection