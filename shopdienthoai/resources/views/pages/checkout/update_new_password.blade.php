@extends('welcome')
@section('content')
       <!-- Modal  -->
       <div class="modal">
            <div class="modal__overlay">  
            </div>
            <div class="modal__body" >
                <!-- Login form -->
                <form class="auth-form" method="POST" action="{{URL::to('/reset-new-pass')}}"> 
                    @csrf
                   
                    <div class="auth-form__container" > 
                        <div class="auth-form__header">
                            @php
                                $token = $_GET['token'];
                                $email = $_GET['email'];
                            @endphp
                            <h3 class="auth-form__heading" style="margin:12px 0 12px 0">Điền mật khẩu mới</h3>
                           
                        </div>
                        @if(session()->has('message'))
                            <div style="font-size: 14px;background-color: white;padding: 10px;color:green;">
                                {!! session()->get('message')!!}
                            </div>
                        @elseif(session()->has('error'))
                            <div style="font-size: 14px;background-color: white;padding: 10px;color: var(--primary-color);">
                                {!! session()->get('error')!!}
                            </div>
                        @endif    
                        <div class="auth-form__form">
                            <div class="auth-form__group">
                                <input type="hidden" name="email" value="{{$email}}">
                                <input type="hidden" name="token" value="{{$token}}">
                                <input type="text" class="auth-form__input " id="email_account" name="password_account" placeholder="Nhập mật khẩu mới" autocomplete="off">
                                <span class="auth-form__message"></span>
                            </div>
                        </div>
                        
                        <div class="auth-form__controls" style="margin-top:40px;margin-bottom:40px">
                            <!-- <button class="btn auth-form__controls-back btn-normal" onclick="document.location.href=this.getAttribute('href');" href="{{URL::to('/Trangchu')}}">TRỞ LẠI</button> -->
                            <button class="btn btn--primary">Gửi</button>
                        </div>
            
                    </div>
                </form>
            </div>  
        </div>
@endsection()