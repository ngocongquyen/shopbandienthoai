@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm mã giảm giá
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
                        <form role="form" action="{{URL::to('/insert-coupon-code')}}" method="post" id="insert_coupon"> 
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên mã giảm giá</label>
                            <input type="text" name="coupon_name" class="form-control" id="name_coupon" placeholder="Tên danh mục">
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ngày bắt đầu</label>
                            <input type="text" name="coupon_date_start" class="form-control" id="start_coupon" placeholder="Tên danh mục" autocomplete="off">
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ngày kết thúc</label>
                            <input type="text" name="coupon_date_end" class="form-control" id="end_coupon" placeholder="Tên danh mục" autocomplete="off">
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mã giảm giá</label>
                            <input style="resize:none" row="5" name="coupon_code" type="text" class="form-control" id="code_coupon">
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số lượng mã</label>
                            <input style="resize:none"  name="coupon_time" type="text" class="form-control" id="time_coupon">
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tính năng mã</label>
                            <select name="coupon_condition" class="form-control" id="condition_coupon" required>
                                <option value="0">---Chọn---</option>
                                <option value="1">Giảm theo phần trăm</option>
                                <option value="2">Giảm theo tiền</option>
                            </select>
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nhập số hoặc tiền giảm</label>
                            <input style="resize:none" name="coupon_number" type="text" class="form-control" id="number_coupon">
                            <span class="auth-form__message"></span>
                        </div>
        
                        <button type="submit" name="add_coupon" class="btn btn-info" style="display:flex;margin:auto">Thêm mã</button>
                    </form>
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection()