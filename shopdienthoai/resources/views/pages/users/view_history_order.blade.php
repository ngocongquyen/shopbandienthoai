@extends('welcome')
@section('content')
<div class="grid wide">
    <div class="row app__content">
        <div class="col l-3">
            <div class="user-page">
                <img src="{{asset('public/fontend/images/10-logo-dep-nhat-nam-2018-4.jpg')}}" alt="" class="user-page__img">
                <div class="user-page__right">
                    <span class="user-page__username"><?php $customer_name = Session::get('customer_name');
                                            if($customer_name) {
                                                echo $customer_name;
                                            }
                                ?></span>
                    <a href="{{URL::to('my-account')}}" class="user-page__edit">
                        <i class="fas fa-edit"></i>
                        Sửa hồ sơ
                    </a>
                </div>
            </div>
           
            <ul class="user-page__list">
                <li class="user-page__item">
                    <a href="{{URL::to('my-account')}}" class="user-page__link">
                        <i class="fas fa-user-circle" style="margin-right:4px;"></i>
                        <span class="user-page__item-title">Tài khoản của tôi</span>
                    </a>
                </li>
                <li class="user-page__item">
                    <a href="{{URL::to('/history')}}" class="user-page__link">
                        <i class="fas fa-file-invoice" style="margin-right:4px;"></i>
                        <span class="user-page__item-title">Lịch sử đơn hàng</span>
                       
                    </a>
                </li>
            </ul>
        </div>
        <div class="col l-9 c-12">
            <div class="panel panel-default">
                <div class="panel-heading history-heading">
                    Thông tin khách hàng
                </div>
                <div class="table-responsive">
                    <?php
                    $message = Session::get('message');
                    if($message) {
                        echo '<span class="text">'.$message.'</span>';
                        Session::put('message',null);
                    }
                    ?>
                <table class="history-list">
                    <thead>
                    <tr class="history-wrapper">
                        <th class="history-item">Tên khách hàng</th>
                        <th class="history-item">Email</th>
                        <th class="history-item"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="history-wrapper">      
                        <td class="history-item">{{$customer->customer_name}}</td>
                        <td class="history-item">{{$customer->customer_email}}</td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
            <br>
            <div class="panel panel-default">
                <div class="panel-heading history-heading">
                    Thông tin vận chuyển
                </div>
                <div class="table-responsive">
                    <?php
                    $message = Session::get('message');
                    if($message) {
                        echo '<span class="text">'.$message.'</span>';
                        Session::put('message',null);
                    }
                    ?>
                <table class="history-list">
                    <thead>
                    <tr class="history-wrapper">
                        <th  class="history-item">Tên người vận chuyển</th>
                        <th  class="history-item">Địa chỉ</th>
                        <th class="history-item">Số điện thoại</th>
                        <th class="history-item">Email</th>
                        <th class="history-item">Hình thức thanh toán</th>
                       
                    </tr>
                    </thead>
                    <tbody>
                
                    <tr class="history-wrapper">
                        <td class="history-item">{{$shipping->shipping_name}}</td>
                        <td class="history-item">{{$shipping->shipping_address}}</td>
                        <td class="history-item">{{$shipping->shipping_phone}}</td>
                        <td class="history-item">{{$shipping->shipping_email}}</td>
                        <td class="history-item">
                            @if($payment->payment_method==0) 
                                @php
                                echo 'Chuyển khoản';
                                @endphp
                            @else 
                            @php
                                echo 'Tiền mặt';
                                @endphp
                            @endif
                        </td>
                    </tr>
                
                    </tbody>
                </table>
                </div>
            </div>
            <br><br>
            <div class="panel panel-default">
                <div class="panel-heading history-heading">
                    Chi tiết đơn hàng 
                </div>
                <div class="table-responsive">
                    <?php
                    $message = Session::get('message');
                    if($message) {
                        echo '<span class="text">'.$message.'</span>';
                        Session::put('message',null);
                    }
                    ?>
                <table class="history-list">
                    <thead>
                        <tr class="history-wrapper">
                            <th class="history-item">Thứ tự</th>
                            <th class="history-item">Tên sản phẩm</th>
                            <th class="history-item">Số lượng kho</th>
                            <th class="history-item">Mã giảm giá</th>
                            <th class="history-item">Số lượng</th>
                            <th class="history-item">Giá sản phẩm</th>
                            <th class="history-item">Tổng tiền</th>
                            <th class="history-item"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=0;
                            $total = 0;
                        @endphp
                        @foreach($order_details as $key => $details)
                        @php
                            $i++;
                            $subtotal = $details->product_price*$details->product_sales_qty;
                            $total+=$subtotal;
                        @endphp
                        <tr class="color_qty_{{$details->product_id}} history-wrapper">
                            <td class="history-item"><i>{{$i}}</i></td>
                            <td class="history-item">{{$details->product_name}}</td>
                            <td class="history-item">{{$details->product->product_quantity}}</td>
                            <td class="history-item"> @if($details->coupon_id!='')
                                    {{$coupon_code}}
                                @else
                                    Không mã
                                @endif  
                            <td>
                            <input type="number" readonly {{$order_status==2 ? 'disabled' : ''}} class="order_qty_{{$details->product_id}} mobile__width" min="1"  value="{{$details->product_sales_qty}}" name="product_sales_quantity">
                            <input type="hidden" name="order_qty_storge" class="order_qty_storge_{{$details->product_id}}" value="{{$details->product->product_quantity}}">
                            <input type="hidden" name="order_id" class="order_id" value="{{$details->order_id}}">
                            <input type="hidden" name="order_product_id" class="order_checkout_quantity" value="{{$details->product_id}}">
                            </td>
                            <td class="history-item">{{number_format($details->product_price,0,',','.')}} đ</td>
                            <td class="history-item">{{number_format($subtotal,0,',','.')}} đ</td>
                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div style="text-align:center;padding:10px;font-size:16px;color:var(--primary-color)">
                    @php
                    $total_coupon = 0;
                    @endphp
                    @if($coupon_condition==1) 
                    @php
                        $total_after_coupon = ($total*$coupon_number)/100;
                        echo 'Tổng giảm : '.number_format($total_after_coupon,0,',','.').' đ'.'</br>';
                        $total_coupon = $total - $total_after_coupon;
                    @endphp
                    @else 
                    @php 
                        echo 'Tổng giảm : '.number_format($coupon_number,0,',','.').' đ'.'</br>';
                        $total_coupon = $total - $coupon_number;
                    @endphp
                    @endif
                    Tổng tiền: {{number_format($total_coupon,0,',','.')}} đ
                </div>
                </div>
            </div>
        </div>
    </div>
</div>        

@endsection()