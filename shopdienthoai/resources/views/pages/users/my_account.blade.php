@extends('welcome')
@section('content')
<div class="grid wide">
    <div class="row app__content">
        <div class="c-3 col">
            <div class="user-page">
                <img src="{{asset('public/fontend/images/10-logo-dep-nhat-nam-2018-4.jpg')}}" alt="" class="user-page__img">
                <div class="user-page__right">
                    <span class="user-page__username"><?php $customer_name = Session::get('customer_name');
                                            if($customer_name) {
                                                echo $customer_name;
                                            }
                                ?></span>
                    <a href="" class="user-page__edit">
                        <i class="fas fa-edit"></i>
                        Sửa hồ sơ
                    </a>
                </div>
            </div>
           
            <ul class="user-page__list">
                <li class="user-page__item">
                    <a href="#" class="user-page__link">
                        <i class="fas fa-user-circle" style="margin-right:4px;"></i>
                        <span class="user-page__item-title">Tài khoản của tôi</span>
                    </a>
                </li>
                <li class="user-page__item">
                    <a href="{{URL::to('history')}}" class="user-page__link">
                        <i class="fas fa-file-invoice" style="margin-right:4px;"></i>
                        <span class="user-page__item-title">Lịch sử đơn hàng</span>
                       
                    </a>
                </li>
            </ul>
        </div>
        <div class="c-9 col">
            <div class="user-main">
                <div class="user-section">
                    <h3 class="user-section__header">Hồ sơ của tôi</h3>
                </div>
                <div class="user-profile">
                    <div class="user-profile__wrapper">
                        <h3 style="font-size: 14px;text-align: center;color: var(--primary-color);"> <?php
                            $message = Session::get('message');
                            if($message) {
                                echo "<span class='text'>$message</span>";
                                Session::put('message',null);
                            }
                        ?></h3>
                        <?php 
                            $customer_id = Session::get('customer_id');
                            if($customer_id!=NULL) {
                                ?>

                        <form class="auth-form" action="{{URL::to('/change-account/'. $customer_id)}}" method="POST" >
                            @csrf
                            <div class="user-profile__input">
                                <span class="user-profile__input-title">Tên đăng nhập</span>
                                <span class="user-profile__input-name">{{$customer->customer_name}}</span>
                            </div>
                            <div class="user-profile__input">
                                <span class="user-profile__input-title">Tên</span>
                                <input type="text" class="user-profile__input-value " value="{{$customer->customer_name}}" id="name" name="name_account" placeholder="Nhập Tên">
                            </div>
                            <div class="user-profile__input">
                                <span class="user-profile__input-title">Email</span>
                                <input type="text" class="user-profile__input-value " value="{{$customer->customer_email}}" id="email" name="email_account" placeholder="Nhập email">
                            </div>
                            <div class="user-profile__input">
                                <span class="user-profile__input-title">Loại tài khoản</span>
                                @if($customer->customer_vip == 1)
                                    <span class="user-profile__input-name">Khách hàng vip</span>
                                @else     
                                    <span class="user-profile__input-name">Khách hàng thường</span>
                                @endif
                            </div>
                            <div style="width:100%;text-align:center">
                                <button class="btn btn-primary" style="margin-top:10px">Cập nhật tài khoản</button>
                            </div>
                        </form>     
                        <?php        
                            }
                        ?>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection()