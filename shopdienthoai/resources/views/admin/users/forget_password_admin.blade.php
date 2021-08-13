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
                <h3 class="heading">Điền email để lấy lại mật khẩu</h3>
                @if(session()->has('message'))
                    <div style="font-size: 16px;color:green;margin-bottom:10px;text-align:center">
                        {!! session()->get('message')!!}
                    </div>
                @elseif(session()->has('error'))
                    <div style="font-size: 16px;color:red; margin-bottom:10px;text-align:center">
                        {!! session()->get('error')!!}
                    </div>
                @endif    
                <form action="{{URL::to('/recover-pass-admin')}}" class="auth-form" method="post">
                    {{csrf_field()}}
                    <div class="auth-form__form">
                        <div class="auth-form__group">
                            <input type="text" name="admin_email" class="auth-form__input" placeholder="Nhập email" required>
                            <i class="fa fa-user users"></i>
                        </div>
                    <div class="login" style="display:flex;justify-content: space-between;margin-bottom: 10px;">
                        <a href="{{url('login-auth')}}" class="login__input" style="text-decoration:none;width:125px;padding-left:0;padding-right:0;text-align:center">TRỞ LẠI</a>
                        <input type="submit" class="login__input" value="GỬI" style="width:150px;padding-left:0;padding-right:0;text-align:center" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>