@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm khuyến mãi
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
                        <form role="form" action="{{URL::to('/save-promotion')}}" id="save-promotion" method="post"> 
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phần trăm khuyến mãi</label>
                            <input type="text" name="promotion_type" class="form-control" id="promotion_type"  placeholder="Tên danh mục" autocomplete="off">
                            <span class="auth-form__message"></span>
                        </div>
                        <button type="submit" name="add_post_cate" class="btn btn-info" style="display:flex;margin:auto">Thêm khuyến mãi</button>
                    </form>
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection()