@extends('welcome')
@section('content')
<div class="cart-main">
    @if(Session::get('cart')==true) 
    <div class="grid wide">
        <div class="cart-wrapper">
        @if(session()->has('message'))
            <div style="font-size: 14px;text-align: center;background-color: white;padding: 10px;color:green;">
                {!! session()->get('message')!!}
            </div>
        @elseif(session()->has('error'))
            <div style="font-size: 14px;text-align: center;background-color: white;padding: 10px;color: var(--primary-color);">
                {!! session()->get('error')!!}
            </div>
        @endif    
            <div class="cart-suggestion">
                    <i class="fas fa-truck-loading cart-suggestion__icon"></i>
                    <span class="cart-suggestion__label">Nhấn vào mục Mã giảm giá ở cuối trang để hưởng miễn phí vận chuyển bạn nhé!</span>
            </div>
            <div class="cart-page-product-header">
                <!-- <div class="cart-checkbox cart-checkbox-sup">
                    <input class="cart-checkbox__input" type="checkbox">
                    <div class="cart-checkbox__bgc"></div>
                    
                </div> -->
                <div class="cart-page-product-header__product">Sản phẩm</div>
                <ul class="cart-page-product-header__list">
                    <li class="cart-page-product-header__list-item">Đơn Giá</li>
                    <li class="cart-page-product-header__list-item">Số Lượng</li>
                    <li class="cart-page-product-header__list-item">Số Tiền</li>
                    <li class="cart-page-product-header__list-item">Thao Tác</li>
                </ul>
            </div>
            <div class="">
                <div class="cart-page-shop-section">
                    <div class="cart-page-shop-header">
                        <div class="cart-page-shop-header__wrapper">
                            <!-- <div class="cart-checkbox cart-checkbox-sup">
                                <input class="cart-checkbox__input" type="checkbox">
                                <div class="cart-checkbox__bgc"></div>
                    
                            </div>  -->
                            <a href="" class="cart-page-shop-header__shop-name">
                                <div class="label-loving">
                                    Yêu Thích
                                </div>   
                                <span>Officail</span>
                            </a>
                        </div>
                    </div>
                    
                    <div class="cart-page-shop-section__items">
                        <?php $total=0 ?>
                        @foreach(Session::get('cart') as $key => $cart)
                        <?php
                            $subtotal = $cart['product_old_price']*$cart['product_qty'];
                            $total+=$subtotal;
                        ?>
                        <div class="cart-item">
                            <form action="{{URL::to('/update-cart')}}" method="POST" style="flex:1">
                                {{csrf_field()}}
                                <div class="cart-item__content">
                                    <div class="cart-checkbox cart-checkbox-sup">
                                        <input class="cart-checkbox__input" type="checkbox">
                                        <div class="cart-checkbox__bgc"></div>
                                    </div> 
                                    <div class="cart-item__cell-overview">
                                        <a href="{{url('/chi-tiet-san-pham/'.$cart['product_id'])}}" class="cart-item-overview__wrapper">
                                            <img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" alt="" class="cart-item-overview__wrapper-link" title="Áo thun unisex N7 Basic tee phông trơn nam nữ lỡ tay overtsize rong 12 mau">
                                            <h3 class="cart-item-overview__wrapper-name" title="Áo thun unisex N7 Basic tee phông trơn nam nữ lỡ tay overtsize rong 12 mau" >{{$cart['product_name']}}</h3>
                                        </a>
                                    </div>
                                    <!-- <div class="cart-item__cell-variation">
                                        <div class="cart-item-variation__wrapper">
                                            <span class="cart-item-variation__color">Phân loại màu:</span>
                                            <i class="fas fa-chevron-down cart-item-variation__icon"></i>
                                        </div>
                                        <span class="cart-item-variation__name">
                                            Đỏ
                                        </span>
                                    </div> -->
                                    <div class="cart-item__cell-unit-price">
                                        <span class="cart-item__cell-unit-price--old">đ{{number_format($cart['product_new_price'],0,",",".")}}</span>
                                        <span class="cart-item__cell-unit-price--new">đ{{number_format($cart['product_old_price'],0,",",".")}}</span>
                                    </div>
                                    <div class="cart-item__cell-quantity">
                                        <button class="product__qnt-btn product__qnt-btn--dec">
                                            <i class="product__qnt-btn-icon fas fa-minus"></i>
                                        </button>
                                        <input class="product__qntInput" type="text" id="current_qty" name="cart_quantity" value="{{$cart['product_qty']}}" min="1" max="{{$cart['product_max_quantity']}}">
                                        <input class="product__qntInput" type="text" name="rowId_cart" hidden value="{{$cart['session_id']}}" min="1" max="10">
                                        <input class="product__max_quantity" type="text"  hidden value="{{$cart['product_max_quantity']}}" >

                                        <button class="product__qnt-btn product__qnt-btn--inc">
                                            <i class="product__qnt-btn-icon fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="cart-item__cell-total-price" >
                                        <span class="price">đ{{number_format($subtotal,0,",",".")}}</span>
                                    </div>
                                    <div class="cart-item__cell-actions">
                                        <button class="cart-item-action__update">Cập nhật</button>
                                        <a class="cart-item-action__delete"  href="{{url('/del-product/'.$cart['session_id'])}}">Xóa</a>      
                                        <!-- <div class="cart-item-action__wrapper">                            
                                            <button class="cart-button-no-outline">
                                                <span class="cart-item-action__similar">
                                                    Tìm sản phẩm tương tự
                                                </span>
                                                <i class="fas fa-chevron-down cart-item-action__icon"></i>
                                            </button>
                                        </div>
                                        <div class="cart-item-action__wrapper-has-product" style="display:none">
                                            <button class="cart-button-has-outline">
                                                <span class="cart-item-action__similar-product">
                                                    Tìm sản phẩm tương tự
                                                </span>
                                                <i class="fas fa-chevron-down cart-item-action__icon"></i>
                                            </button>  
                                            <div class="cart-item-action__wrapper-details-product">
                                                <div class="grid wide ">
                                                    <div class="row cart-item-action__wrapper-product">

                                                        <div class="col l-2-4">
                                                            <a class="home-product-item" href="http://localhost/shopdienthoai/chi-tiet-san-pham/5">
                                                                <div>
                                                                    <img src="http://localhost/shopdienthoai/public/uploads/product/xiomi94.jpg" class="home-product-item__img">
                                                                </div>
                                                                <h4 class="home-product-item__name">Iphone 8</h4>
                                                                <div class="home-product-item__price">
                                                                    <span class="home-product-item__price-old">2.000.000 đ</span>
                                                                    <span class="home-product-item__price-new">1.800.000đ</span>
                                                                </div>
                                                                <div class="home-product-item__action">
                                                                    <span class="home-product-item__like home-product-item__like--liked">
                                                                    <i class="home-product-item__like-icon-empty far fa-heart"></i>
                                                                    <i class="home-product-item__like-icon-fill fas fa-heart home-product-item__liked"></i>
                                                                    </span>
                                                                    <div class="home-product-item__rating">
                                                                        <i class="home-product-item__star--gold fas fa-star"></i>
                                                                        <i class="home-product-item__star--gold fas fa-star"></i>
                                                                        <i class="home-product-item__star--gold fas fa-star"></i>
                                                                        <i class="home-product-item__star--gold fas fa-star"></i>
                                                                        <i class="fas fa-star"></i>
                                                                    </div>
                                                                    <span class="home-product-item__sold">88 đã bán</span>
                                                                </div>
                                                                <div class="home-product-item__orgin">
                                                                    <span class="home-product-item__brand">Whoo</span>
                                                                    <span class="home-product-item__orgin-name">Hàn Quốc</span>
                                                                </div>
                                                                <div class="home-product-item__favourite">
                                                                    <i class="fas fa-check"></i>
                                                                    <span>Yêu thích</span>
                                                                </div>
                                                                <div class="home-product-item__sell-off">
                                                                    <span class="home-product-item__sell-off-percent">10%</span>
                                                                    <span class="home-product-item__sell-off-label">GIẢM</span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>                                                  
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid wide">
        <div class="cart-page-footer">
            <div class="cart-page-footer__wrapper">
                <div class="cart-page-footer__wrapper-voucher">
                    <span style="margin-right: 20px;dispplay:block">
                        @if(Session::get('coupon'))
                            @foreach(Session::get('coupon') as $key =>$cou)
                                @if($cou['coupon_condition']==1)
                                    Mã giảm: {{$cou['coupon_number']}} %
                                    <p>
                                        @php
                                            $total_coupon = ($total*$cou['coupon_number'])/100;
                                            echo '<p>Tổng giảm: '.number_format($total_coupon,0,',','.').'d</p>';

                                        @endphp
                                    </p>
                                    <p>Tổng đã giảm: {{number_format($total-$total_coupon,0,',','.')}}d</p>
                                @elseif($cou['coupon_condition']==2)
                                    Mã giảm: {{$cou['coupon_number']}} đ
                                    <p>
                                        @php
                                            $total_coupon = $total-$cou['coupon_number'];

                                        @endphp
                                    </p>
                                    <p>Tổng đã giảm: {{number_format($total_coupon,0,',','.')}}đ</p>
                                @endif     
                            @endforeach
                        @endif    
                    </span>
                </div>
                <form action="{{url('/check-coupon')}}" method="POST" class="mobile__cart-coupon">
                    {{csrf_field()}}
                    <input class="cart-page-footer__link" type="text" name="coupon" placeholder="Nhập mã giảm giá" autocomplete="off">
                    <input class="cart-page-footer__checkout-btn" type="submit" value="Tính mã giảm giá" name="check_coupon">
                </form>    
            </div>
            <div class="cart-page-footer__row">
                <div id="cart-checkbox-all" class="cart-checkbox hide-on-mobile">
                    <input class="cart-checkbox__input" type="checkbox">
                    <div class="cart-checkbox__bgc"></div>
                </div>
                <button class="cart-page-footer__product-count clear-btn hide-on-mobile">Chọn tất cả
                    <span class="hide-on-mobile-tablet">(<span class="qnt"></span> sản phẩm):</span>
                </button>
                <button class="cart-page-footer__btn-delete clear-btn hide-on-mobile" onclick="document.location.href=this.getAttribute('href');" href="{{url('/del-all-product')}}">Xóa tất cả</button>
                <div class="cart-page-footer__pay">
                    <div class="cart-page-footer__summary">
                        <div class="cart-page-footer__summary-text">Tổng tiền hàng 
                            <span class="hide-on-mobile-tablet">(<span class="qnt"></span> sản phẩm):</span>
                        </div>
                        <div class="cart-page-footer__summary-amount">đ{{number_format($total,0,",",".")}}</div>
                    </div>
                    <div class="cart-page-footer__checkout">
                        <?php 
                            $customer_id = Session::get('customer_id');
                            $shipping_id = Session::get('shipping_id');
                            if($customer_id!=NULL && $shipping_id=="") {
                         ?>
                          <button class="cart-page-footer__checkout-btn" onclick="document.location.href=this.getAttribute('href');" href="{{URL::to('/checkout')}}">Mua ngay</button>
                         <?php } elseif($customer_id!=NULL && $shipping_id!=NULL) {

                        ?>
                         <button class="cart-page-footer__checkout-btn" onclick="document.location.href=this.getAttribute('href');" href="{{URL::to('/payment')}}">Mua ngay</button>
                        <?php } else {?>
                            <button class="cart-page-footer__checkout-btn" onclick="document.location.href=this.getAttribute('href');" href="{{URL::to('/login-checkout')}}">Mua ngay</button>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="confirm-deletion-container" style="display: none;">
            <div class="confirm-deletion-overlay"></div>
            <div class="confirm-deletion ">
                <div class="confirm-deletion__message">
                    Bạn có muốn xóa <span class="qnt">tất cả</span> sản phẩm?
                </div>
                <div class="confirm-deletion__btn-wrapper">
                    <button class="confirm-deletion__btn confirm-deletion__btn--back clear-btn">Trở lại</button>
                    <button class="confirm-deletion__btn confirm-deletion__btn--agree clear-btn" onclick="document.location.href=this.getAttribute('href');" href="{{url('/del-all-product')}}">Có</button>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="cart-no-product">
        <img src="{{asset('public/fontend/images/no-cart.png')}}" alt="" class="cart-no-product__img">
        <span class="cart-no-product__desc">Giỏ hàng của bạn còn trống</span>
        <button class="product-btn-main product-btn-main__buying cart-no-product__label" type="button" onclick="document.location.href=this.getAttribute('href');" href="{{URL::to('/Trangchu')}}">
            <span class="product-btn-main__text product-btn-main__buying-text">Mua Ngay</span>
        </button>
    </div>
    @endif
    <div class="grid wide ">
        <div class="cart-viewed" >
            <div class="cart-viewed-header">Vừa xem</div>
            <div class="cart-viewed-grid" id="row_viewed">

            </div>
        </div>
    </div>
</div>

</body>
</html>
  
<script src="{{asset('public/fontend/js/basejs/product-cart.js')}}"></script>   

<script src="{{asset('public/fontend/js/jquery.min.js')}}"></script>

@endsection()

