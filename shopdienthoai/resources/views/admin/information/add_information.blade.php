@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thông tin website
                </header>
                <?php
                    $message = Session::get('message');
                    if($message) {
                        echo '<span class="text">'.$message.'</span>';
                        Session::put('message',null);
                    }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                    @foreach($contact as $key => $con)
                        <form role="form" action="{{URL::to('/update-infor/'.$con->info_id)}}" method="post" enctype="multipart/form-data"> 
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thông tin liên hệ</label>
                            <textarea style="resize:none" row="5" name="info_contact" id="ckeditor1" type="text" class="form-control" id="exampleInputPassword1" placeholder="Mô tả danh mục">
                                {{$con->info_contact}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Bản đồ</label>
                            <textarea style="resize:none" row="5" name="info_map" type="text" class="form-control" id="exampleInputPassword1" placeholder="Mô tả danh mục">
                                {{$con->info_map}}
                            </textarea>
                        </div>
                       
                        <button type="submit" name="add_info" class="btn btn-info" style="display:flex;margin:auto">Cập nhật thông tin</button>
                    </form>
                    @endforeach
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection()