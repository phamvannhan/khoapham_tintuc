@extends('layout.index')

@section('content')
 <!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{!! $tintuc->TieuDe !!}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Start Bootstrap</a>
                </p>

                <!-- Preview Image -->
                <img class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="80x80" width="180px" height="180px">

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Đăng ngày {{$tintuc->created_at}}</p>
                <hr>

                <!-- Post Content -->
                <p class="lead">{!!$tintuc->TomTat!!}</p>
                <p>{!!$tintuc->NoiDung!!}</p>

                <hr>

                <!-- Blog Comments -->
                
                <!-- Comments Form -->
                <div class="well">
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form role="form" action="user-comment" method="POST">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="comment"></textarea>
                        </div>
                        <button type="submit" class="btn btn-info">Đăng</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                @foreach($tintuc->comment as $cm)
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$cm->users->name}}
                            <small>{{$cm->created_at}}</small>
                    
                        </h4>
                        {{$cm->NoiDung}}
                    </div>
                </div>
                @endforeach

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">

                        <!-- item -->
                        @foreach($tinlienquan as $tlq)
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="chi-tiet-tin/{{$tlq->id}}/{{$tlq->TieuDeKhongDau}}">
                                    <img class="img-responsive" src="upload/tintuc/{{$tlq->Hinh}}" alt="">
                                </a>
                                
                            </div>
                            <div class="col-md-7">
                                <a href="chi-tiet-tin/{{$tlq->id}}/{{$tlq->TieuDeKhongDau}}"><b>{{$tlq->TieuDe}}</b></a>
                            </div>
                            <p style="margin-left: 5px;">{!!$tlq->TomTat!!}</p>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                        @endforeach
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">
                        @foreach($tinnoibat as $tnb)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="chi-tiet-tin/{{$tnb->id}}/{{$tnb->TieuDeKhongDau}}">
                                    <img class="img-responsive" src="upload/tintuc/{{$tnb->Hinh}}" alt="hinh anh">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="chi-tiet-tin/{{$tnb->id}}/{{$tnb->TieuDeKhongDau}}"><b>{{$tnb->TieuDe}}</b></a>
                            </div>
                            <p>{!! $tnb->TomTat !!}</p>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                        @endforeach
                    </div>
                </div>
                
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection