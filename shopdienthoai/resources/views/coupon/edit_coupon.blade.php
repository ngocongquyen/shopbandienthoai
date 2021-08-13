@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa mã giảm giá
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
                        <form role="form" action="{{URL::to('/update-coupon-code/'.$coupon->coupon_id)}}" method="post"> 
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên mã giảm giá</label>
                            <input type="text" value="{{$coupon->coupon_name}}" name="coupon_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ngày bắt đầu</label>
                            <input type="text" value="{{$coupon->coupon_date_start}}" name="coupon_date_start" class="form-control" id="start_coupon" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ngày kết thúc</label>
                            <input type="text" value="{{$coupon->coupon_date_end}}" name="coupon_date_end" class="form-control" id="end_coupon" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mã giảm giá</label>
                            <input style="resize:none" value="{{$coupon->coupon_code}}" row="5" name="coupon_code" type="text" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số lượng mã</label>
                            <input style="resize:none"  value="{{$coupon->coupon_time}}" name="coupon_time" type="text" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tính năng mã</label>
                            <select name="coupon_condition" class="form-control input-sm m-bot15">
                                @if($coupon->coupon_condition==1)
                                    <option selected value="1">Giảm theo phần trăm</option>
                                    <option value="2">Giảm theo tiền</option>
                                @else
                                    <option value="1">Giảm theo phần trăm</option>
                                    <option selected value="2">Giảm theo tiền</option>
                                @endif
                            </select>
                        </div>    
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tình trạng mã</label>
                            <select name="coupon_status" class="form-control input-sm m-bot15">
                                @if($coupon->coupon_status==0)
                                    <option selected value="0">Đã khóa</option>
                                    <option value="1">Đang kích hoạt</option>
                                @else
                                    <option value="0">Đã khóa</option>
                                    <option selected value="1">Đang kích hoạt</option>
                                @endif
                            </select>
                        </div>    
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nhập số hoặc tiền giảm</label>
                            <input style="resize:none" value="{{$coupon->coupon_number}}" name="coupon_number" type="text" class="form-control" id="exampleInputPassword1">
                        </div>
        
                        <button type="submit" name="edit_coupon" class="btn btn-info" style="display:flex;margin:auto">Cập nhập mã giảm giá</button>
                    </form>
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection()