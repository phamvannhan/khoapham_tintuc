@extends('layout.index')

@section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            @include('layout.menu-left')
            <?php 
                function doimau($str,$tukhoa)
                {
                    return str_replace($tukhoa,"<span style='color:red; '>$tukhoa</span>", $str);
                }
            ?>
            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b>Kết quả tìm thấy: {{count($tintuc)}} tin có liên quan đế từ khoá "{{$tukhoa}}"</b></h4>
                    </div>
                    
                    @foreach($tintuc as $tt)
                    <div class="row-item row">
                        <div class="col-md-3">

                            <a href="detail.html">
                                <br>
                                <img width="200px" height="200px" class="img-responsive" src="upload/tintuc/{{$tt->Hinh}}" alt="tên hình">
                            </a>
                        </div>

                        <div class="col-md-9">
                            <!--do có function đổi màu nên ko dc dùng $tt-> mà dùng {!}-->
                            <h3>{!! doimau ($tt->TieuDe,$tukhoa) !!}</h3>
                            
                            <p>{!! doimau ($tt->TomTat,$tukhoa) !!}</p>
                            <a class="btn btn-primary" href="chi-tiet-tin/{{$tt->id}}/{{$tt->TieuDeKhongDau}}">Xem chi tiết<span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                        <div class="break"></div>
                    </div>
                  @endforeach
                  
                </div>
                {{$tintuc->links()}}
            </div> 

        </div>

    </div>
    <!-- end Page Content -->
@endsection