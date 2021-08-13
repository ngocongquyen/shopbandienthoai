@extends('welcome')
@section('content')
       <!-- Modal  -->
       <div class="modal">
            <div class="modal__overlay">  
            </div>
            <div class="modal__body" >
                <!-- Resignter form -->
                <form class="auth-form" id="register-form" method="POST" action="{{URL::to('/add-customer')}}" style="display:none">
                    {{csrf_field()}}
                    <div class="auth-form__container">
                        <div class="auth-form__header">
                            <h3 class="auth-form__heading">Đăng Ký</h3>
                            <span class="auth-form__switch-btn">Đăng nhập</span>
                        </div>
                        
                        <div class="auth-form__form">
                            <div class="auth-form__group">
                                <input type="text" class="auth-form__input" name="customer_name" id="fullname" placeholder="Nhập họ tên" >
                                <span class="auth-form__message"></span>
                            </div>
                            <div class="auth-form__group">
                                <input type="text" class="auth-form__input" name="customer_email" id="email1" placeholder="Nhập email" >
                                <span class="auth-form__message"></span>
                            </div>
                            <div class="auth-form__group">
                                <input type="password" class="auth-form__input" name="customer_password" id="password1" placeholder="Mật khâu" >
                                <span class="auth-form__message"></span>
                            </div>
                            <div class="auth-form__group">
                                <input type="password" class="auth-form__input" name="customer_password_confirmation" id="password_confirmation" placeholder="Nhập lại mật khẩu" >
                                <span class="auth-form__message"></span>
                            </div>
                        </div>
                        
                        <div class="auth-form_aside">
                            <p class="auth-form__policy-text">
                                Bằng việc đăng kí, bạn đã đồng ý với shop về 
                                <a href="" class="auth-form__text-link">Điều khoản</a> &
                                <a href="" class="auth-form__text-link">Chính sách bảo mật</a>
                            </p>
                        </div>
                        <div class="auth-form__controls" style="margin-top:20px;margin-bottom:20px">
                            <button class="btn auth-form__controls-back btn-normal" onclick="document.location.href=this.getAttribute('href');" href="{{URL::to('/Trangchu')}}">TRỞ LẠI</button>
                            <button class="btn btn--primary">ĐĂNG KÍ</button>
                        </div>
                        <!-- <div class="auth-form__socials">
                            <a href="" class="auth-form__socials--facebook btn btn--size-s  btn--with-icon">
                                <i class="auth-form__socials-icon fab fa-facebook-square"></i>
                                <span class="auth-form__socials-title">Kết nối với facebook</span>
                            </a>
                            <a href="" class="btn btn--size-s auth-form__socials--google  btn--with-icon">
                                <i class="auth-form__socials-icon fab fa-google"></i>   
                                <span class="auth-form__socials-title">Kết nối với google</span>
                            </a>
                        </div> -->
                    </div>          
                </form>

                <!-- Login form -->
                <form class="auth-form" id="login-form" method="POST" action="{{URL::to('/login-customer')}}"> 
                    {{csrf_field()}}
                    <div class="auth-form__container" > 
                        <div class="auth-form__header">
                            <h3 class="auth-form__heading">Đăng Nhập</h3>
                            <span class="auth-form__switch-btn">Đăng Kí</span>
                        </div>
                        <h3 style="margin: 0;text-align: center;color: var(--primary-color);font-size: 14px;">
                        <?php
                            $message = Session::get('message');
                            if($message) {
                                echo "<span class='text'>$message</span>";
                                Session::put('message',null);
                            }
                        ?>
                        </h3>
                        <div class="auth-form__form">
                            <div class="auth-form__group">
                                <input type="text" class="auth-form__input " id="email" name="email_acount" placeholder="Nhập email">
                                <span class="auth-form__message"></span>
                            </div>
                            <div class="auth-form__group">
                                <input type="password" class="auth-form__input" id="password" name="password_acount" placeholder="Nhập mật khẩu">
                                <span class="auth-form__message"></span>
                            </div>
                        </div>
                        
                        <div class="auth-form_aside">
                            <div class="auth-form__help">
                                <a href="{{url('/forget-password')}}" class="auth-form__help-link auth-form__help-forget">Quên mật khẩu</a>
                                <span class="auth-form__help-separate"></span>
                                <a href="" class="auth-form__help-link ">Cần trợ giúp</a>
                            </div>
                        </div>
                        <div class="auth-form__controls" style="margin-top:20px;margin-bottom:20px">
                            <button class="btn auth-form__controls-back btn-normal" onclick="document.location.href=this.getAttribute('href');" href="{{URL::to('/Trangchu')}}">TRỞ LẠI</button>
                            <button class="btn btn--primary">ĐĂNG NHẬP</button>
                        </div>
                        <!-- <div class="auth-form__socials">
                            <a href="{{url('login-facebook-customer')}}" class="auth-form__socials--facebook btn btn--size-s  btn--with-icon">
                                <i class="auth-form__socials-icon fab fa-facebook-square"></i>
                                <span class="auth-form__socials-title">Kết nối với facebook</span>
                            </a>
                            <a href="" class="btn btn--size-s auth-form__socials--google  btn--with-icon">
                                <i class="auth-form__socials-icon fab fa-google"></i>   
                                <span class="auth-form__socials-title">Kết nối với google</span>
                            </a>
                        </div> -->
                    </div>
                </form>
            </div>  
        </div>
@endsection()