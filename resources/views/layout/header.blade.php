 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="trangchu">Laravel Trang Chủ</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="about.html">Giới thiệu</a>
                    </li>
                    <li>
                        <a href="contact.html">Liên hệ</a>
                    </li>
                </ul>
                <!--bài 36 tìm kiếm tin tức laravel-khoapham-->
                <form class="navbar-form navbar-left" role="search" action="timkiem" method="GET">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
			        <div class="form-group">
			          <input type="text" name="tukhoa" class="form-control" placeholder="Tìm kiếm từ khoá" >
			        </div>
			        <button type="submit" class="btn btn-default">Tìm Kiếm</button>
			    </form>
                 <!--end bài 36 tìm kiếm tin tức laravel-khoapham-->
			    <ul class="nav navbar-nav pull-right">
                @if(Auth::check())
                   
                    <li>
                    	<a>
                    		<span class ="glyphicon glyphicon-user"></span>
                    		{{Auth::user()->name}}
                    	</a>
                    </li>

                    <li>
                    	<a href="dangxuat">Đăng xuất</a>
                    </li>
                @else
                     <li>
                        <a href="dangki">Đăng ký</a>
                    </li>
                    <li>
                        <a href="dangnhap">Đăng nhập</a>
                    </li>
                @endif
                </ul>
            </div>


            
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>