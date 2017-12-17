@extends('layout.index')
@section('content')
<div class="container">
		<!--phần slide-->
    	@include('layout.slide')
		<!--end phần slide-->
        <div class="space20"></div>

        <div class="row main-left">
            <!--phần menu bên trái đã cắt-->
            @include('layout.menu-left')
			<!--end col-md-3-->
            <div class="col-md-9">
	            <div class="panel panel-default">            
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Laravel Tin Tức</h2>
	            	</div>

	            	<div class="panel-body">
	            		
		                <!-- chạy tất cả thể loại chứa tin tưc... -->
		                @foreach($theloaiPhanTrang as $tl)
					    <div class="row-item row">
		                	<h3><a href="#">{{$tl->Ten}}</a> 
								@foreach($tl->loaitin as $lt)
		                		|<small><a href="loaitin/{{$lt->id}}/{{$lt->TenKhongDau}}"><i>{{$lt->Ten}}</i></a>/</small>
		                		@endforeach
		                	</h3>
		                	<!-- dùng php tạo ra 1 data chứa mảng gồm 5 tin tức nổi bật để in ra phía bên phải-->
			                	<!--trỏ model theloai->tintuc và lệnh shift lấy ra 1 tin-->
									<?php
									$data = $tl->tintuc->where('NoiBat','1')->sortByDesc('created_at')->take(5);//lấy 5tin nổi bật ngày giảm dần

									$tin1 = $data->shift(); //lấy 1 tin =>data còn lại 4tin
									 ?>

		                	<div class="col-md-8 border-right">
		                	<!--do đang chạy trong foreach của 1 tin sẽ tự động xuất nhiều tin -->
		                		<div class="col-md-5">
			                        <a href="detail.html">
			                            <img class="img-responsive" src="upload/tintuc/{{$tin1['Hinh']}}" alt="thêm hình ở đây">
			                        </a>
			                    </div>
			                    <div class="col-md-7">
			                        <h3>{{$tin1['TieuDe']}}<small>lấy 1 nổi bật</small></h3>
			                        <p>{{$tin1['TomTat']}}</p>
			                        <a class="btn btn-primary" href="chi-tiet-tin/{{$tin1['id']}}/{{$tin1['TieuDeKhongDau']}}">Xem Thêm<span class="glyphicon glyphicon-chevron-right"></span></a>
								</div>
		                	</div>
		                    
							<!--sau khi dùng shift thì data còn lại 4 tin trong 5-->
							<div class="col-md-4">
							<h3>Các Tin Liên Quan</h3>
							@foreach($data->all() as $dt)
								<a href="chi-tiet-tin/{{$dt->id}}/{{$dt->TieuDeKhongDau}}">
									
									<h4>
										<span class="glyphicon glyphicon-list-alt"></span>
										{{$dt->TieuDe}}
									</h4>
									
								</a>
							@endforeach
							</div>
							
							<div class="break"></div>
		                </div>
		                @endforeach
		                <!-- end item -->
						{{$theloaiPhanTrang->links()}}
					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
@endsection