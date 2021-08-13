@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa thông số kĩ thuật
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
                        <form role="form" action="{{URL::to('/update-specification/'.$specification->IDTSSP)}}" method="post"> 
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hệ điều hành</label>
                            <input type="text" value="{{$specification->Hedieuhanh}}" name="hdh" class="form-control"  placeholder="Tên danh mục" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Camera sau</label>
                            <input type="text" value="{{$specification->Camerasau}}" name="camerasau" class="form-control"  placeholder="Tên danh mục" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Camera trước</label>
                            <input type="text" value="{{$specification->Cameratruoc}}" name="cameratruoc" class="form-control"  placeholder="Tên danh mục" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">CPU</label>
                            <input type="text" value="{{$specification->CPU}}" name="cpu" class="form-control"  placeholder="Tên danh mục" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ram</label>
                            <input type="text" value="{{$specification->Ram}}" name="ram" class="form-control"  placeholder="Tên danh mục" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Bộ nhớ trong</label>
                            <input type="text" value="{{$specification->Bonhotrong}}" name="bonhotrong" class="form-control"  placeholder="Tên danh mục" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thẻ nhớ</label>
                            <input type="text" value="{{$specification->Thenho}}" name="thenho" class="form-control"  placeholder="Tên danh mục" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thẻ sim</label>
                            <input type="text" value="{{$specification->Thesim}}" name="thesim" class="form-control"  placeholder="Tên danh mục" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Dung lượng pin</label>
                            <input type="text" value="{{$specification->Dungluongpin}}" name="dungluongpin" class="form-control"  placeholder="Tên danh mục" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Màn hình</label>
                            <input type="text" value="{{$specification->Manhinh}}" name="manhinh" class="form-control"  placeholder="Tên danh mục" autocomplete="off">
                        </div>
                        <button type="submit" name="edit_specification" class="btn btn-info" style="display:flex;margin:auto">Sửa thông số kĩ thuật</button>
                    </form>
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection()