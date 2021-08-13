<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gửi mã giảm giá</title>
    <link rel="stylesheet" href="{{asset('public/fontend/css/bootstrap.min.css')}}">
</head>
<body style="font-family:Arial;">
    <div style="border:5pxdotted #bbb;width:80%;border-radius:15px;margin:0 auto;max-width:600px;">
        <div >
        <h3>Mã khuyến mãi từ shop<a target="_blank" href="{{URL::to('Trangchu')}}"> quyen.com </a> </h3>
        </div>
        <div  style="padding:2px 16px;background-color:#f1f1f1;">
            <h2 class="note" style="text-align:center;font-size:large;text-decoration:underline;"><b><i>
                @if($coupon['coupon_condition']==1) 
                    Giảm {{$coupon['coupon_number']}} %
                @else 
                    Giảm {{number_format($coupon['coupon_number'],0,',','.')}}k
                @endif    
                cho tổng đơn hàng đặt mua
            </i></b></h2>
            <p>Quý khách đã từng mua hàng tại shop <a target="_blank" href="{{URL::to('Trangchu')}}" style="color:red"> quyen.com </a> nếu đã có tài 
            khoản xin vui long <a href="{{URL::to('login-checkout')}}" target="_blank"> đăng nhập </a> vào tài 
            khoản để mua hàng và nhập mã code phía dưới dể được giảm giá mua hàng, xin cảm ơn quý khách.Chúc quý khách 
            thất nhiều sức khỏe và bình an trong cuộc sống</p>
        </div>
        <div >
            <p  style=" text-align:center;font-size:20px;">Sử dụng Code sau:<span class="promo" style=" background-color:#ccc;padding:3px;">{{$coupon['coupon_code']}}</span> với chỉ {{$coupon['coupon_time']}} mã giảm giá</p>
            <p  style="color: red;text-align:center;">Ngày bắt đầu : {{$coupon['start_coupon']}} / Ngày hết hạn code: {{$coupon['end_coupon']}}</p>
        </div>
    </div>
</body>
</html>