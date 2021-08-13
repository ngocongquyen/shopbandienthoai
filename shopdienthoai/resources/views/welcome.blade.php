<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Cửa hàng điện thoại</title>
    <link rel="stylesheet" href="{{asset('public/fontend/css/normalize.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/fontend/css/base.css')}}">
    <link rel="stylesheet" href="{{asset('public/fontend/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('public/fontend/css/grid.css')}}">
    <link rel="stylesheet" href="{{asset('public/fontend/css/detail.css')}}">
    <link rel="stylesheet" href="{{asset('public/fontend/css/cart.css')}}">
    <link rel="stylesheet" href="{{asset('public/fontend/css/payment.css')}}">
    <link rel="stylesheet" href="{{asset('public/fontend/css/post.css')}}">
    <link rel="stylesheet" href="{{asset('public/fontend/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('public/fontend/css/sweetalert.css')}}">
    <link rel="stylesheet" href="{{asset('public/fontend/fonts/fontawesome-free-5.15.1-web/fontawesome-free-5.15.1-web/css/all.min.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main">
        <header class="header">
            <div class="grid wide">
                <nav class="header__navbar hide-on-mobile-table">
                    <ul class="header__navbar-list">
                        <li class="header__navbar-item header__navbar-item--separate header__navbar-item--has-qr">
                            Vào cửa hàng trên ứng dụng
                            <div class="header__qr">
                                <img src="{{asset('public/fontend/images/pickaxe.png')}}" alt="QR code" class="header__qr-img">
                                <div class="header__qr-apps">
                                    <a href="" class="header__qr-link"></a>
                                        <img src="{{asset('public/fontend/images/google.png')}}" alt="google" class="header__qr-dowload-img">
                                    </a>
                                    <a href="" class="header__qr-link">
                                        <img src="{{asset('public/fontend/images/app-store.png')}}" alt="app-store" class="header__qr-dowload-img">
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="header__navbar-item">
                            <span class="header__navbar-title--no-pointer">Kết nối</span>
                            <a href="" class="header__navbar-icon-link">
                                <i class="fab fa-facebook header__navbar-icon"></i>
                            </a>
                            <a href="" class="header__navbar-icon-link">
                                <i class="fab fa-instagram header__navbar-icon"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="header__navbar-list">
                        <li class="header__navbar-item header__navbar-item--has-notifi">
                            <a href="" class="header__navbar-icon-link">
                                <i class="fas fa-newspaper" style="margin-right:2px"></i>
                                Tin Tức
                            </a>

                            <!-- THong bao -->
                            <div class="header__notifi">
                                <ul class="header-notifi-list">
                                    @foreach($category_post as $key =>$danhmucbaiviet)
                                    <li class="header__notifi-item header__notifi-item--viewed">
                                        <a href="{{URL::to('danh-muc-bai-viet/'.$danhmucbaiviet->cate_post_slug)}}" class="header__notifi-link">
                                            {{$danhmucbaiviet->cate_post_name}}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                                <!-- <footer class="header__notifi-footer">
                                    <a href="" class="header__notifi-footer-btn">Xem tất cả</a>
                                </footer> -->
                            </div>
                        </li>
                        <li class="header__navbar-item">
                            <a href="{{URL::to('lien-he')}}" class="header__navbar-icon-link">
                                <i class="fas fa-phone header__navbar-icon"></i>
                                Liên hệ
                            </a>
                        </li>
                        <?php 
                            $customer_id = Session::get('customer_id');
                            if($customer_id!=NULL) {
                                ?>
                                <li class="header__navbar-item header__navbar-user">
                                <img src="{{asset('public/fontend/images/10-logo-dep-nhat-nam-2018-4.jpg')}}" alt="" class="header__navbar-user-img">
                                <span class="header__navbar-user-name">
                                    <?php $customer_name = Session::get('customer_name');
                                            if($customer_name) {
                                                echo $customer_name;
                                            }
                                    ?>
                                </span>
                                
                                <div class="header__navbar-user-info">
                                    <ul class="header__navbar-user-list">
                                        <li class="header__navbar-user-item">
                                            <a href="{{URL::to('my-account')}}">Tài khoản của tôi</a>
                                        </li>
                                        <!-- <li class="header__navbar-user-item">
                                            <a href="">Địa chỉ của tôi</a>
                                        </li> -->
                                        <li class="header__navbar-user-item">
                                            <a href="{{URL::to('history')}}">Lịch sử đơn hàng</a>
                                        </li>
                                        <li class="header__navbar-user-item">
                                            <a href="{{URL::to('/logout-checkout')}}">Đăng xuất</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <?php }
                             else { ?>
                                <li id="register-item" class="header__navbar-item header__navbar-item--strong header__navbar-item--separate">Đăng kí</li>
                                <li id="login-item" class="header__navbar-item header__navbar-item--strong">Đăng nhập</li>
                            <?php }  ?>
                    </ul>
                </nav>

                <!-- Header - with-search -->
                <div class="header-with-search">
                    <label for="mobile-search-checkbox" class="header__mobile-search">
                        <i class="fas fa-search header__mobile-search-icon"></i>
                    </label>
                    <div class="header__logo hide-on-tablet">
                        <a href="{{URL::to('Trangchu')}}" class="header__logo-link">
                            <img src="{{asset('public/fontend/images/logo.png')}}" alt=""  class="header__logo-img">
                        </a>     
                    </div>
                    
                    <input type="checkbox" hidden id="mobile-search-checkbox" class="header__search-box">
                   <form action="{{URL::to('/tim-kiem')}}" method="get" style="flex:1;" class="header__search-box-form" autocomplete="off">
                        <div class="header__search">
                            <div class="header__search-input-wrap">
                                <input type="text" name="keywords_submit"  class="header__search-input" id="keywords" placeholder="Nhập để tìm kiếm theo tên hoặc giá sản phẩm"></input>
                                <!-- Seaarch history -->
                                <div class="header__search-history" id="search-history">
                                    
                                </div>
                                <!-- {{csrf_field()}} -->
                            </div>   
                            <button class="header__search-btn">
                                <i class="header__search-btn-icon fas fa-search"></i>
                            </button>
                        </div>
                   </form>

                    <!-- Cart Layout-->
                    <div class="header__cart">
                        <div class="header__cart-wrap ">
                            <i class="header__cart-icon fas fa-cart-plus "></i>
                            <span class="header__cart-notice" id="show-cart">0</span>
                            <!-- header__cart-list--no-cart -->
                            <div class="header__cart-list">
                                <img src="{{asset('public/fontend/images/no-cart.png')}}" alt="Không có sản phẩm" class="header__cart-list--no-cart-img">
                                <span class="header__cart-list-no-cart-msg">
                                    Chưa có sản phẩm
                                </span>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <ul class="header__sort-bar">
                <li class="header__sort-item">
                    <a href="{{URL::to('product-selling')}}" class="header__sort-link">Phổ biến</a>
                </li>
                <li class="header__sort-item header__sort-item--active">
                    <a href="{{URL::to('product-latest')}}" class="header__sort-link">Mới nhất</a>
                </li>
                <li class="header__sort-item">
                    <a href="{{URL::to('product-selling')}}" class="header__sort-link">Bán chạy</a>
                </li>
                <li class="header__sort-item hidden-onmobile-sort">
                    <a href="" class="header__sort-link">Sắp xếp theo</a>
                </li>
            </ul>
        </header>
            
        <div class="app__container">
           @yield('slider')
            @yield('content')
        </div>

        <footer class="footer">
            <div class="grid wide">
                <div class="row ">
                    <div class="col l-3 m-4 c-6">
                        <h3 class="footer__heading">Chăm sóc khách hàng</h3>
                        <ul class="footer-list">
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Trung Tâm Trợ Giúp</a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">TickID Mail</a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Hướng Dẫn Mua Hàng</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col l-3 m-4 c-6">
                        <h3 class="footer__heading">Giới thiệu</h3>
                        <ul class="footer-list">
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Giới thiệu</a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Tuyển dụng</a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Điều khoản</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col l-3 m-4 c-5">
                        <h3 class="footer__heading">Theo dõi chúng tôi trên</h3>
                        <ul class="footer-list">
                            <li class="footer-item">
                                <i class="footer-item__icon fab fa-facebook"></i>
                                <a href="" class="footer-item__link">Facebook</a>
                            </li>
                            <li class="footer-item">
                                <i class="footer-item__icon fab fa-instagram-square"></i>
                                <a href="" class="footer-item__link">Instagram</a>
                            </li>
                            <li class="footer-item">
                                <i class="footer-item__icon fab fa-linkedin"></i>
                                <a href="" class="footer-item__link">LinkedIn</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col l-3 m-4 c-7">
                        <h3 class="footer__heading">Vào Cửa Hàng Trên Ứng Dụng</h3>
                        <div class="footer__download">
                            <img src="{{asset('public/fontend/images/pickaxe.png')}}" alt="" class="footer__download-qr">
                            <div class="footer__download-apps">
                                <a href="" class="footer__download-app-link">
                                    <img src="{{asset('public/fontend/images/google.png')}}" alt="" class="footer__download-app-img">
                                </a>
                                <a href="" class="footer__download-app-link">
                                    <img src="{{asset('public/fontend/images/app-store.png')}}" alt="" class="footer__download-app-img">
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__bottom">
				<div class="grid wide">
					<p class="footer__text">© 2020 - Bản quyền thuộc về Ngô Quyến</p>
				</div>
			</div>
        </footer>
    </div>
    <div class="modal" style="display:none;z-index:4">
        <div class="modal__overlay">  
        </div>
        <div class="modal__body" >
            <!-- Resignter form -->
            <form class="auth-form" id="register-form" method="POST" action="{{URL::to('/add-customer')}}">
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
                    
                    <div class="auth-form_aside" >
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
</body>
</html>

<script src="{{asset('public/fontend/js/jquery.js')}}"></script>
<script src="{{asset('public/fontend/js/bootstrap.min.js')}}js/"></script>
<script src="{{asset('public/fontend/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('public/fontend/js/price-range.js')}}"></script>
<script src="{{asset('public/fontend/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('public/fontend/js/jquery.min.js')}}"></script>
<script src="{{asset('public/fontend/js/sweetalert.min.js')}}"></script>

<!-- Autocomplete -->
<script type="text/javascript">
  
        $('#keywords').keyup(function(){
            var query = $(this).val();
            if(query != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{url('/fetch')}}",
                    method:"POST",
                    data:{query:query, _token:_token},
                    success:function(data) {
                        $('.header__search-history').fadeIn();
                        $('.header__search-history').html(data);
                    }
                });
            }
            else {
                $('.header__search-history').fadeOut();
            } 
            
        });
        $(document).on('mousedown','.header__search-history-list',function(e){
               e.preventDefault();
            })  
        $(document).on('click','.header_li',function(){
            $('#keywords').val($(this).text());
            $('.header__search-history').fadeOut();
        })  
</script>

<!-- Validator -->
<script src="{{asset('public/fontend/js/validator.js')}}">></script>
<script src="{{asset('public/fontend/js/basejs/handle-form.js')}}"></script>
<script>
    // Mong muon cua chung ta
    Validator({
        form: '#register-form',
        formGroupSelector: '.auth-form__group',
        errorSelector:'.auth-form__message',
        rules: [
            Validator.isRequired('#fullname',"Vui lòng nhập tên đầy đủ"),
            Validator.isRequired('#email1'),
            Validator.isEmail('#email1'),
            Validator.minLength('#password1',6),
            Validator.isRequired('#password_confirmation'),
            Validator.isConfirmed('#password_confirmation',function(){
            return document.querySelector("#register-form #password1").value;
            },"Mat khau nhap lai khong chinh xac")
        ],
        //  onSubmit : function(data) {
        //     console.log(data);
        //  }
    })
</script>

<script>
     Validator({
        form: '#login-form',
        formGroupSelector: '.auth-form__group',
        errorSelector:'.auth-form__message',
        rules: [
            // Validator.isRequired('#fullname',"Vui lòng nhập tên đầy đủ"),
            Validator.isRequired('#email'),
            Validator.isEmail('#email'),
            Validator.minLength('#password',6),
            // Validator.isRequired('#password_confirmation'),
            // Validator.isConfirmed('#password_confirmation',function(){
            // return document.querySelector("#form-2 #password").value;
            // },"Mat khau nhap lai khong chinh xac")
        ],
        //  onSubmit : function(data) {
        //     console.log(data);
        //  }
    })
</script>


<!-- Gửi cart -->
<script>
    $(document).ready(function(){
        $('.buy-cart').click(function(){
            var id = $(this).data('id');
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_new_price = $('.cart_product_new_price_' + id).val();
            var cart_product_old_price = $('.cart_product_old_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();
            var cart_product_qty_max = $('.cart_product_qty_max_' + id).val();
            var _token = $('input[name="_token"]').val();   
            $.ajax({
                url:"{{url('/add-cart-ajax')}}",
                method:'post',
                data:{
                    cart_product_id:cart_product_id,
                    cart_product_name:cart_product_name,
                    cart_product_image:cart_product_image,
                    cart_product_new_price:cart_product_new_price,
                    cart_product_old_price:cart_product_old_price,
                    cart_product_qty:cart_product_qty,
                    cart_product_qty_max:cart_product_qty_max,
                    _token:_token,
                },
                success:function(data) {
                    window.location.href="{{ url('/gio-hang')}}";
                }
            });
            show_cart();
        });
    });      
</script>

<!-- cart ajax show cart hover-cart -->
<script>
    $(document).ready(function(){
        show_cart();
        hover_cart();
        function hover_cart() {
            $.ajax({
                url:"{{url('/hover-cart')}}",
                method:"get",
                success: function(data) {
                    $('.header__cart-list').html(data);
                }
            })
        }

        function show_cart() {
            $.ajax({
                url:"{{url('/show-cart')}}",
                method:"get",
                success: function(data) {
                    $('#show-cart').html(data);
                }
            })
        }
        $('.add-to-cart').click(function(){
            var id = $(this).data('id');
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_new_price = $('.cart_product_new_price_' + id).val();
            var cart_product_old_price = $('.cart_product_old_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();
            var cart_product_qty_max = $('.cart_product_qty_max_' + id).val();
            var _token = $('input[name="_token"]').val();   
            $.ajax({
                url:"{{url('/add-cart-ajax')}}",
                method:'post',
                data:{
                    cart_product_id:cart_product_id,
                    cart_product_name:cart_product_name,
                    cart_product_image:cart_product_image,
                    cart_product_new_price:cart_product_new_price,
                    cart_product_old_price:cart_product_old_price,
                    cart_product_qty:cart_product_qty,
                    cart_product_qty_max:cart_product_qty_max,
                    _token:_token,
                },
                success:function(data) {
                    swal("Thành công","Sản phẩm đã được thêm vào giỏ hàng", "success");
                   
                }
            });
            show_cart();
            hover_cart();
        });
    });      
</script>
<!-- product-info -->

<!-- Sap xep -->
<script type="text/javascript">
   $(document).ready(function(){
      $('#sort').on('change',function(){
         var url = $(this).val();
         if(url) {
             window.location = url;
         }
         return false;
      })
   })
</script>

<!-- Sản phẩm đã xem -->
<script>

    function viewed() {
        if(localStorage.getItem('viewed')!=null){
            var data = JSON.parse(localStorage.getItem('viewed'));
            data.reverse();
            for(i=0;i<data.length;i++) {
                var name = data[i].name;
                var price = data[i].price;
                var image = data[i].image;
                var url = data[i].url;
                $('#row_viewed').append('<a href="'+url+'" class="cart-viewed-grid__wrapper">'+
                    '<img src="'+image+'" alt="" class="cart-viewed-grid__img">'+
                    '<div class="cart-viewed-grid__list">'+
                        '<span class="cart-viewed-grid__name">'+name+'</span>'+
                        '<span class="cart-viewed-grid__price">'+price+'đ</span>'+
                    '</div>'+
                '</a>');
            }
        }
        
    }
    viewed();
    product_viewed();
    function product_viewed() {
        var id = $("#content_product").attr("data-id");
        var name = document.getElementById('viewed_productname'+id).value;
        var url = document.getElementById('viewed_producturl'+id).value;
        var price = document.getElementById('viewed_productprice'+id).value;
        var image = document.getElementById('viewed_productimage'+id).value;
    
        var newItem = {
            'url':url,
            'id':id,
            'name':name,
            'price':price,
            'image':image
        }
        if(localStorage.getItem('viewed')==null) {
            localStorage.setItem('viewed','[]');
        }
        var old_data = JSON.parse(localStorage.getItem('viewed'));
        var matches = $.grep(old_data,function(obj){
            return obj.id == id;
        })
        if(matches.length) {
        }
        else {
            old_data.push(newItem);
            $('#row_viewed').append('<a class="cart-viewed-grid__wrapper" href="'+newItem.url+'">'+
                    '<img src="'+newItem.image+'" alt="" class="cart-viewed-grid__img">'+
                    '<div class="cart-viewed-grid__list">'+
                        '<span class="cart-viewed-grid__name">'+newItem.name+'</span>'+
                        '<span class="cart-viewed-grid__price">'+newItem.price+' đ</span>'+
                    '</div>'+
                '</a>');
        }
        localStorage.setItem('viewed',JSON.stringify(old_data));
    }

    
</script>

<!-- Thay đổi yêu thích -->
<script>
    var a =document.querySelectorAll('.home-product-item__like--liked');
    var b = document.querySelectorAll('.home-product-item__like--liked .home-product-item__like-icon-fill');
    var c = document.querySelectorAll('.home-product-item__like--liked .home-product-item__like-icon-empty');

    function changeForms(showForm, hideForm) {
        showForm.style.display = 'block';
        hideForm.style.display = 'none';
    }
    a.forEach((tab,index) => {
    const pane = b[index]
    const pane1 = c[index]
    tab.onclick = function() {
        changeForms(pane,pane1);
    }
})
</script>    

<!-- Sản phẩm yêu thích -->
<script>

    function view() {
        if(localStorage.getItem('data')!=null){
            var data = JSON.parse(localStorage.getItem('data'));
            data.reverse();
            for(i=0;i<data.length;i++) {
                var name = data[i].name;
                var price = data[i].price;
                var image = data[i].image;
                var url = data[i].url;
                var type = data[i].type;
                var sold = data[i].sold;
                $('#row_wishlist').append('<div class="col l-3 m-6 c-6" >'+
                                        '<div class="product-loving__wrapper" >'+
                                            '<a class="product-loving__item" href="'+url+'">'+
                                        '<div class="product-loving__item-img-wrapper">'+
                                            '<img src="'+image+'" alt="" class="product-similar__item-img">'+
                                        '</div>'+
                                        '<div class="home-product-item__favourite">'+
                                            '<i class="fas fa-check"></i>'+
                                            '<span>Yêu thích</span>'+
                                        '</div>'+
                                        '<div class="home-product-item__sell-off">'+
                                            '<span class="home-product-item__sell-off-percent">'+type+'%</span>'+
                                            '<span class="home-product-item__sell-off-label">GIẢM</span>'+
                                        '</div>'+
                                        '<h4 class="product-similar__item-name">'+name+'</h4>'+
                                        '<div class="product-similar__item-price">'+
                                            '<span class="product-similar__item-price-old">'+price+'đ</span>'+
                                            '<span class="product-similar__item-sold">'+sold+' Đã bán</span>'+
                                        '</div>'+
                                    '</a>'+
                                '</div>'+
                                '</div>');
                
                
            }
        }
    }

    view()
    function add_wistlist(clicked_id) {
        var id = clicked_id;
        var name = document.getElementById('wishlist_productname'+id).value;
        var url = document.getElementById('wishlist_producturl'+id).value;
        var price = document.getElementById('wishlist_productprice'+id).value;
        var image = document.getElementById('wishlist_productimage'+id).value;
        var type = document.getElementById('wishlist_producttype'+id).value;
        var sold = document.getElementById('wishlist_productsold'+id).value;
    
        var newItem = {
            'url':url,
            'id':id,
            'name':name,
            'price':price,
            'image':image,
            'type':type,
            'sold':sold
        }
        if(localStorage.getItem('data')==null) {
            localStorage.setItem('data','[]');
        }
        var old_data = JSON.parse(localStorage.getItem('data'));
        var matches = $.grep(old_data,function(obj){
            return obj.id == id;
        })
        if(matches.length) {   
            alert("Sản phẩm bạn đã yêu thích nên không thể thêm");
        }
        else {
            old_data.push(newItem);
            $('#row_wishlist').append(' <div class="product-loving__wrapper" >'+
                                    '<a class="product-loving__item" href="'+newItem.url+'">'+
                                        '<div class="product-loving__item-img-wrapper">'+
                                            '<img src="'+newItem.image+'" alt="" class="product-similar__item-img">'+
                                        '</div>'+
                                        '<div class="home-product-item__favourite">'+
                                            '<i class="fas fa-check"></i>'+
                                            '<span>Yêu thích</span>'+
                                        '</div>'+
                                        '<div class="home-product-item__sell-off">'+
                                            '<span class="home-product-item__sell-off-percent">'+newItem.type+'%</span>'+
                                            '<span class="home-product-item__sell-off-label">GIẢM</span>'+
                                        '</div>'+
                                        '<h4 class="product-similar__item-name"></h4>'+
                                        '<div class="product-similar__item-price">'+
                                            '<span class="product-similar__item-price-old">'+newItem.price+'đ</span>'+
                                            '<span class="product-similar__item-sold">'+newItem.sold+' Đã bán</span>'+
                                        '</div>'+
                                '</a>'+
                                '</div>');
           
        }
        localStorage.setItem('data',JSON.stringify(old_data));
    }
</script>

<script>
    function sortProducts() {
    let btnClassList = document.getElementsByClassName('header__sort-item'); // get button class list
    let cmBtn = btnClassList[0]; // get element of the common button
    let sellBtn = btnClassList[2]; // get element of best-selling button

    // remove background class of button
    function removeBgrClass() {
        for (let el of btnClassList) {
            el.classList.remove('header__sort-item--active');
        }
    }

    if (cmBtn) {
        cmBtn.onclick = () => {
            removeBgrClass();
            cmBtn.classList.add('header__sort-item--active');
        }
    }

    if (sellBtn) {
        sellBtn.onclick = () => {
            removeBgrClass();
            sellBtn.classList.add('header__sort-item--active');
        }
    }
}

sortProducts();
</script>
<script src="{{asset('public/fontend/js/basejs/index.js')}}"></script>
  