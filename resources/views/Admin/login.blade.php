<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Khóa Học Lập Trình Laravel Framework 5.x Tại Khoa Phạm">
    <meta name="author" content="">
    <title>Admin - Khoa Phạm</title>
    
    <base href="{{asset('')}}"><!--sử dụng nó để css không bị mất khi cắt giao diện-->
    <!-- Bootstrap Core CSS -->
    <link href="source/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="source/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="source/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="source/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="source/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTab/source/les Responsive CSS -->
    <link href="source/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
</head>

<body>

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
                       <form class="form-horizontal" method="POST" action="{{route('adminLogin')}}">
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

     <!-- jQuery -->
    <script src="source/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="source/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="source/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="source/dist/js/sb-admin-2.js"></script>

    <!-- DataTables JavaScript -->
    <script src="source/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script src="source/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

</body>

</html>
