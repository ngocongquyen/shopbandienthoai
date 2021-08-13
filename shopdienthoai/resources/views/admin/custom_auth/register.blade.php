<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('public/backend/css/Login.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('public/fontend/fonts/fontawesome-free-5.15.1-web/fontawesome-free-5.15.1-web/css/all.min.css')}}">
    <title>Admin</title>
</head>
<body>
    <div class="over-lay">
        <div class="header_register">
            <div class="content" >
                <h3 class="heading">Đăng Ký Auth</h3>
                <?php
                    $message = Session::get('message');
                    if($message) {
                        echo "<span class='text'>$message</span>";
                        Session::put('message',null);
                    }
                ?>
                <form action="{{URL::to('register')}}" class="auth-form" method="post">
                    {{csrf_field()}}
                    <div class="auth-form__form">
                        <div class="auth-form__group">
                            <input type="text"  name="admin_name" value="{{old('admin_name')}}" class="auth-form__input" placeholder="Điền tên" required>
                            <i class="fa fa-user users"></i>
                        </div>
                        <div class="auth-form__group">
                            <input type="text" name="admin_email" value="{{old('admin_email')}}" class="auth-form__input" placeholder="Nhập email" required>
                            <i class="fas fa-envelope-square square"></i>       
                        </div>
                        <div class="auth-form__group">
                            <input type="text"  name="admin_phone" value="{{old('admin_phone')}}" class="auth-form__input" placeholder="Nhập SĐT" required>
                            <i class="fas fa-phone phone"></i>
                        </div>
                        <div class="auth-form__group">
                            <input type="password"  name="admin_password" class="auth-form__input" placeholder="Mật khẩu của bạn" required>
                            <i class="fa fa-unlock-alt unblock"></i>
                        </div>
                        
                    </div>
                    <div class="remember">
                        <p style="margin:0;text-align:center;"> Bằng việc đăng kí, bạn đã đồng ý với shop về Điều khoản & Chính sách bảo mật</p>
                    </div>
                    <div class="login">
                        <input type="submit" class="login__input" value="ĐĂNG KÍ">
                    </div>
                </form>
                <a href="{{URL::to('register-auth')}}" style="font-size:18px;color:white;text-decoration:none;margin-top:10px;display:inline-block;margin-right:4px;">Đăng kí Auth</a>
                <a href="{{URL::to('login-auth')}}" style="font-size:18px;color:white;text-decoration:none;margin-top:10px;display:inline-block">Đăng nhập Auth</a>
            </div>
        </div>
    </div>
</body>
</html>