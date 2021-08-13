<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('public/backend/css/Login.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Admin</title>
</head>
<body>
    <div class="over-lay">
        <div class="header" style="height:400px">
            <div class="content">
                @php
                    $token = $_GET['token'];
                    $email = $_GET['email'];
                @endphp
                <h3 class="heading">Điền mật khẩu mới</h3>
                @if(session()->has('message'))
                    <div style="font-size: 16px;color:green;margin-bottom:10px">
                        {!! session()->get('message')!!}
                    </div>
                @elseif(session()->has('error'))
                    <div style="font-size: 16px;color:red; margin-bottom:10px">
                        {!! session()->get('error')!!}
                    </div>
                @endif    
                <form action="{{URL::to('/reset-new-pass-admin')}}" class="auth-form" method="post">
                    {{csrf_field()}}
                    <div class="auth-form__form">
                        <div class="auth-form__group">
                            <input type="hidden" name="email" value="{{$email}}">
                            <input type="hidden" name="token" value="{{$token}}">
                            <input type="text"  name="admin_password" class="auth-form__input" placeholder="Mật khẩu của bạn" required>
                            <i class="fa fa-unlock-alt unblock"></i>
                        </div>
                    <div class="login">
                        <input type="submit" class="login__input" value="GỬI">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>