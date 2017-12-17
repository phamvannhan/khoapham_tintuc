<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Laravel trang nguoi dung</title>
	 <base href="{{asset('')}}">
    <!-- Bootstrap Core CSS -->
    <link href="style_pages/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="style_pages/css/shop-homepage.css" rel="stylesheet">
    <link href="style_pages/css/my.css" rel="stylesheet">
    <!--trang dang nhap của người dùng-->
    <link href="source/dist/css/sb-admin-2.css" rel="stylesheet">


</head>

<body>

    <!-- Navigation -->
   @include('layout.header')

    <!-- Page Content -->
    
    <!-- end Page Content -->
		@yield('content')
    <!-- Footer -->
    <hr>
    <div class="container">
    	<footer>
        <div class="row">
            <div class="col-md-12">
                <p>Copyright &copy; Your Website 2014</p>
            </div>
        </div>
    </footer>
    </div>
    
    <!-- end Footer -->
    <!-- jQuery -->
    <script src="style_pages/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="style_pages/js/bootstrap.min.js"></script>
    <script src="style_pages/js/my.js"></script>

</body>

</html>
