 @extends('admin.layout.master')

 @section('content')
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
                            <small>Danh Sách</small>
                        </h1>
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    {{$err}} <br>
                                @endforeach
                                </div>
                        @endif
                         @if(session('thongbao'))
                                <div class="alert alert-success">
                                    {{session('thongbao')}}
                                </div>
                            @endif
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Id</th>
                                <th>Tên </th>
                                <th>Hình</th>
                                <th>Nội Dung</th>
                                <th>Link</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($slide as $sl )
                            <tr class="odd gradeX" align="center">
                                <td>{{$sl->id}}</td>
                                <td>{{$sl->Ten}}</td>
                                <td>
                                    <img src="upload/slide/{{$sl->Hinh}}" alt="{{$sl->Hinh}}" width="200px">
                                </td>
                                <td>{!!$sl->NoiDung!!}</td>
                                <td>{{$sl->link}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/slide/xoa/{{$sl->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/slide/sua/{{$sl->id}}">Edit</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pull-right">
                        {{$slide->links()}}
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection