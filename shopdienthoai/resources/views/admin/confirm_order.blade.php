<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng</title>
    <link rel="stylesheet" href="{{asset('public/fontend/css/bootstrap.min.css')}}">
</head>
<body>
    <div class="container" style="background:#222; border-radius:12px;padding:15px">
        <div class="col-md-12">
            <p style="text-align:center;color:#fff">Đây là email tự động. Quý khách vui lòng không trả lời email này</p>
            <div class="row" style="background:#ff66cc;padding:15px">
                <div class="col-md-6" style="text-align:center;color:#fff;font-weight:bold;font-size:30px">
                    <h4 style="margin:0">CÔNG TY BÁN HÀNG</h4>
                    <h6 style="margin:0">Đọc lập - Tự do -Hạnh phúc</h6>
                </div>
                <div class="col-md-6 logo" style="color:#fff">
                    <p>Chào bạn <strong style="color:#000;text-decoration:underline;">{{$shipping_array['customer_name']}}</strong>, chúng tôi đã xác nhận bạn đặt hàng gồm những thông tin sau:</p>
                </div>
                <div class="col-md-12">
                    <p style="color:#fff;font-size:17px">Bạn hoặc một ai đó đã đăng ký dịch vụ tại shop với thông tin như sau:</p>
                    <h4 style="color:#000;text-transform:uppercase">Thông tin đơn hàng</h4>
                    <p>Mã khuyến mãi áp dụng: <strong style="text-transform:uppercase;color:#fff">{{$code['coupon_code']}}</strong> </p>
                    <p>Dịch vụ: <strong style="text-transform:uppercase;color:#fff">Đặt hàng trực tuyến</strong></p>
                    <h4 style="color:#000;text-transform:uppercase;">Thông tin người nhận </h4>
                    <p>Mail:
                        @if($shipping_array['shipping_email'] == '')
                            <span style="color:#fff">không có</span>
                        @else
                            <span style="color:#fff">{{$shipping_array['shipping_email']}}</span>
                        @endif    
                    </p>
                    <p>Họ và tên người gửi:
                        @if($shipping_array['shipping_name'] == '')
                            <span style="color:#fff">không có</span>
                        @else
                            <span style="color:#fff">{{$shipping_array['shipping_name']}}</span>
                        @endif   
                    </p>
                    <p>Số điện thoại:
                        @if($shipping_array['shipping_phone'] == '')
                            <span style="color:#fff">không có</span>
                        @else
                            <span style="color:#fff">{{$shipping_array['shipping_phone']}}</span>
                        @endif   
                    </p>
                    <p>Địa chỉ:
                        @if($shipping_array['shipping_address'] == '')
                            <span style="color:#fff">không có</span>
                        @else
                            <span style="color:#fff">{{$shipping_array['shipping_address']}}</span>
                        @endif   
                    </p>
                    <p>Hình thức thanh toán: <strong style="text-transform:uppercase;color:#fff">
                        @if($shipping_array['payment_method'] == 0)
                            <span style="color:#fff">Chuyển khoản</span>
                        @else
                            <span style="color:#fff">Tiền mặt</span>
                        @endif   
                    </strong></p>
                    <p style="color:#fff">Nếu thông tin người nhận hàng không có chung tôi sẽ liên hệ với người đặt hàng để trao đổi thông tin về đơn hàng đã đặt</p>
                    <h4 style="color:#000;text-transform:uppercase">Sản phẩm đã được chúng tôi xác nhận</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá tiền</th>
                                <th>Số lượng đặt</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sub_total = 0;
                                $total = 0;
                            @endphp
                            @foreach($cart_array as $cart) 
                                @php
                                    $sub_total = $cart['product_qty']*$cart['product_price'];
                                    $total+=$sub_total;
                                @endphp
                                <tr>
                                    <td>{{$cart['product_name']}}</td>
                        
                                    <td>{{number_format($cart['product_price'],0,',','.')}}</td>
                                    <td style="text-align:center">{{$cart['product_qty']}}</td>
                                    <td>{{number_format($sub_total,0,',','.')}} vnđ</td>
                                </tr> 
                            @endforeach   
                            <tr>
                                <td colspan="4" align="right">Tổng tiền đã giảm : {{number_format($code['total_coupon'],0,',','.')}} vnđ</td>
                            </tr>    
                            <tr>
                                <td colspan="4" align="right">Tổng tiền thanh toán: {{number_format($code['order_total'],0,',','.')}} vnđ</td>
                            </tr>    
                        </tbody>
                    </table>
                </div>
                <p style="color:#fff;text-align:center;font-size:15px">Xem lại lịch sử đơn hàng đã đặt tại : <a href="{{url('/history')}}">lịch sử đơn hàng của bạn</a> </p>
                <p style="color:#fff">Mọi chi tiết xin liên hệ website tại: <a href="http://localhost:10080/shopdienthoai/" target="_blank">Shop</a>, hoặc liên hệ qua số hotline : 19008080 . Xin cảm ơn quý khách đã đặt hàng.</p>
            </div>
        </div>
    </div>
</body>
</html>