@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thông số kĩ thuật
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
                        <form role="form" action="{{URL::to('/save-specification')}}" id="save-specification" method="post"> 
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hệ điều hành</label>
                            <input type="text" name="hdh" class="form-control" id="hdh"  placeholder="Tên danh mục" autocomplete="off">
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Camera sau</label>
                            <input type="text" name="camerasau" class="form-control" id="camerasau" placeholder="Tên danh mục" autocomplete="off">
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Camera trước</label>
                            <input type="text" name="cameratruoc" class="form-control" id="cameratruoc" placeholder="Tên danh mục" autocomplete="off">
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">CPU</label>
                            <input type="text" name="cpu" class="form-control" id="cpu"  placeholder="Tên danh mục" autocomplete="off">
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ram</label>
                            <input type="text" name="ram" class="form-control" id="ram" placeholder="Tên danh mục" autocomplete="off">
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Bộ nhớ trong</label>
                            <input type="text" name="bonhotrong" class="form-control" id="bonhotrong" placeholder="Tên danh mục" autocomplete="off">
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thẻ nhớ</label>
                            <input type="text" name="thenho" class="form-control" id="thenho" placeholder="Tên danh mục" autocomplete="off">
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thẻ sim</label>
                            <input type="text" name="thesim" class="form-control" id="thesim" placeholder="Tên danh mục" autocomplete="off">
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Dung lượng pin</label>
                            <input type="text" name="dungluongpin" class="form-control" id="dungluongpin"  placeholder="Tên danh mục" autocomplete="off">
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Màn hình</label>
                            <input type="text" name="manhinh" class="form-control" id="manhinh" placeholder="Tên danh mục" autocomplete="off">
                            <span class="auth-form__message"></span>
                        </div>
                        <button type="submit" name="add_specification" class="btn btn-info" style="display:flex;margin:auto">Thêm thông số kĩ thuật</button>
                    </form>
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection()