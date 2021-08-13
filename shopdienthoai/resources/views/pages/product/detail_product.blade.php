@extends('welcome')
@section('content')

@foreach($detail_product as $key => $value_detail)
<input type="hidden" id="viewed_productname{{$value_detail->product_id}}" value="{{$value_detail->product_name}}">
<input type="hidden" id="viewed_producturl{{$value_detail->product_id}}" value="{{url('chi-tiet-san-pham/'.$value_detail->product_id)}}">
<input type="hidden" id="viewed_productprice{{$value_detail->product_id}}" value="{{number_format($value_detail->product_price-($value_detail->product_price*($value_detail->promotion_type/100)),0,',','.')}}">
<input type="hidden" id="viewed_productimage{{$value_detail->product_id}}" value="{{asset('public/uploads/product/'.$value_detail->product_images)}}">
<div class="grid wide" style="padding-top:20px">
    <div class="row product" id="content_product" data-id="{{$value_detail->product_id}}">
        <div class="col l-5 m-12 c-12">
            <div class="product-slider">
                <img src="{{asset('public/uploads/product/'.$value_detail->product_images)}}" alt="" class="product_iamge">
                <div class="product__cards">
                    <button class="product__cards-btn product__cards-btn--prev" style="display:none">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="product__cards-btn product__cards-btn--next" style="display:block">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    <div class="product__card-container">
                        @foreach($gallery as $key => $gal)
                            <div class="product__card-wrapper">
                                <div class="product__card">
                                    <img src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" alt="" class="product__card-img">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- <div class="product__actions">
                    <div class="product__sharing-social">
                        <h3 class="product_text">Chia sẻ:</h3>
                        <ul class="product__sharing-icon">
                            <li class="product__sharing-item"><a href="" class="product__sharing-link messenger">
                                <i class="fab fa-facebook-messenger"></i>
                            </a></li>
                            <li class="product__sharing-item"><a href="" class="product__sharing-link facebook">
                                <i class="fab fa-facebook"></i>
                            </a></li>
                            <li class="product__sharing-item"><a href="" class="product__sharing-link google">
                                <i class="fab fa-google-plus"></i>
                            </a></li>
                            <li class="product__sharing-item"><a href="" class="product__sharing-link pinterest">
                                <i class="fab fa-pinterest"></i>
                            </a></li>
                            <li class="product__sharing-item"><a href="" class="product__sharing-link twitter">
                                <i class="fab fa-twitter-square"></i>
                            </a></li>
                        </ul>
                    </div>
                    <div class="product__liking">
                        <i class="far fa-heart product__liking-icon"></i>
                        <span class="product__liking-text ">Đã thích (2.1k)</span>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="col l-7 m-12 c-12">
            <div class="product-content">
                <form>
                    <input type="hidden" value="{{$value_detail->product_id}}" class="cart_product_id_{{$value_detail->product_id}}">
                    <input type="hidden" value="{{$value_detail->product_name}}" class="cart_product_name_{{$value_detail->product_id}}">
                    <input type="hidden" value="{{$value_detail->product_images}}" class="cart_product_image_{{$value_detail->product_id}}">
                    <input type="hidden" value="{{$value_detail->product_price}}" class="cart_product_new_price_{{$value_detail->product_id}}">
                    <input type="hidden" value='{{$value_detail->product_price-($value_detail->product_price*($value_detail->promotion_type/100))}}' class="cart_product_old_price_{{$value_detail->product_id}}">
                    <input type="hidden" id="postnumber" value="1" class="cart_product_qty_{{$value_detail->product_id}}">
                    <input type="hidden" value="{{$value_detail->product_quantity}}" class="cart_product_qty_max_{{$value_detail->product_id}}">
                    @csrf
                    <div class="product__title">
                        <div class="label-loving">
                            Yêu Thích
                        </div>
                        <span class="product__name">{{$value_detail->product_name}}</span>
                    </div>
                    <div class="product__status">
                        <div class="product__status-rating">
                            <?php
                                $number_star = 0;
                                if($value_detail->product_total_rating) {
                                    $number_star = round($value_detail->product_total_number / $value_detail->product_total_rating,2); 
                                }
                            ?>
                            <div class="product__status-rating-point underscore">{{$number_star}}</div>
                            <div class="product__status-rating-stars">
                            @for($i=1; $i<=5; $i++)
                                <i class="{{$i <= $number_star ? 'product__status-rating--active' : ''}} fas fa-star"></i>
                            @endfor
                            </div>
                        </div>
                        <div class="product__status-reviewing">
                            <span class="product__status-reviewing-qnt underscore">{{$value_detail->product_total_rating}}</span>
                            <span class="product__status-reviewing-text">Đánh giá</span>
                        </div>
                        <div class="product__status-sold">
                            <span class="product__status-sold-qnt ">{{$value_detail->product_sold}}</span>
                            <span class="product__status-sold-text">Đã bán</span>
                        </div>
                    </div>
                    <div class="product__price">
                        <div class="product__price-main">
                            @if($value_detail->promotion_type!=0)
                                <span class="product__price-old">₫{{number_format($value_detail->product_price,0,',','.')}}</span>
                            @endif
                            <span class="product__price-new">₫{{number_format($value_detail->product_price-($value_detail->product_price*($value_detail->promotion_type/100)),0,",",".") }}</span>
                            @if($value_detail->promotion_type!=0)
                                <span class="product__price-label">{{$value_detail->promotion_type}}% GIẢM</span>
                            @endif
                        </div>
                        <div class="product__price-slogan">
                            <i class="product__price-icon-tag fas fa-tags"></i>
                            <span class="product__price-slogan-text">Ở đâu rẻ hơn, Shop hoàn tiền</span>
                            <i class="product__price-icon-question far fa-question-circle"></i>
                        </div>
                    </div>
                    <div class="product__info">
                        <!-- <div class="product__codes">
                            <label class="product__codes-label with-label">Mã giảm giá của product</label>
                            <div class="product__codes-wrapper">
                                <div class="product__code">Giảm ₫3k</div>
                                <div class="product__code">Giảm ₫5k</div>
                                <div class="product__code">Giảm ₫8k</div>
                            </div>
                        </div> -->
                        <!-- <div class="product__combo">
                            <label class="product__combo-label with-label">Combo khuyến mãi</label>
                            <div class="product__combo-note">Mua 2 & giảm 5%</div>
                        </div>   -->
                        <div class="product__shipping">
                            <label class="product__shipping-label with-label">Vận chuyển</label>
                            <div class="product__shipping-wrapper">
                                <div class="product__shipping-free">
                                    <i class="product__shipping-free-icon fas fa-truck-loading"></i>
                                    <div class="product__shipping-free-wrapper">
                                        <span class="product__shipping-free-title">Miễn Phí Vận Chuyển</span>
                                        <span class="product__shipping-free-note">Miễn Phí Vận Chuyển khi đơn đạt giá trị tối thiểu</span>
                                    </div>
                                </div>
                                <!-- <div class="product__shipping-to">
                                    <i class="product__shipping-to-icon-truck fas fa-truck"></i>
                                    <div class="product__shipping-to-wrapper">
                                        <div class="product__shipping-place">
                                            <span class="product__shipping-place-title">Vận chuyển tới</span>
                                            <div class="product__shipping-to-cities">
                                                <span class="product__shipping-to-citi">Huyện Ba Vì, Hà Nội</span>
                                                <i class="product__shipping-to-icon fas fa-chevron-down"></i>
                                            </div>
                                        </div>
                                        <div class="product__shipping-fee">
                                            <span class="product__shipping-fee-title">Phí vận chuyển</span>
                                            <div class="product__shipping-to-fee">
                                                <span class="product__shipping-fee-price">₫10.500</span>
                                                <i class="product__shipping-to-icon fas fa-chevron-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <!-- <div class="product__options">
                            <label class="product__options-label with-label">Mau</label>
                            <div class="product__options-items">
                                <button class="product__options-item">Balo Creeper</button>
                                <button class="product__options-item">Túi chéo</button>
                                <button class="product__options-item">Túi xách tay</button>
                            </div>
                        </div>
                     -->
                     <div class="product_view">
                        <label class="product__view-label with-label">Lượt xem</label>
                        <span class="product__view-number">{{$product_v->product_views}}</span>
                    </div>
                        <div class="product__qnt">  
                            <label class="product__qnt-label with-label">Số Lượng</label>
                            <div class="product__qnt-btns">
                                <button class="product__qnt-btn product__qnt-btn--dec">
                                    <i class="product__qnt-btn-icon fas fa-minus"></i>
                                </button>
                                <input id="qtygettext" class="product__qntInput" type="text" value="1" min="1" max="{{$value_detail->product_quantity}}">
                                <!-- <input class="productid__hidden" hidden type="text" value="{{$value_detail->product_id}}"> -->
                                <button class="product__qnt-btn product__qnt-btn--inc">
                                    <i class="product__qnt-btn-icon fas fa-plus "></i>
                                </button>
                            </div>
                            <div class="product__qnt-note">
                                <span class="product__qnt-note-num">{{$value_detail->product_quantity}}</span>
                                sản phẩm có sẵn
                            </div>
                        </div>

                        <div class="product_limit_order" style="display:none">Bạn không thể thêm sản phẩm vì đã đạt tới giới hạn đặt hàng</div>
                        <div class="product-btns-main">
                        
                            <button class="product-btn-main product-btn-main__adding add-to-cart" name="add-to-cart" type="button" data-id="{{$value_detail->product_id}}">
                                <i class="product-btn-main__adding-icon fas fa-cart-plus"></i>
                                <span class="product-btn-main__text product-btn-main__adding-text">Thêm Vào Giỏ Hàng</span>
                            </button>
                            <button class="product-btn-main product-btn-main__buying buy-cart" name="buy-cart" type="button" data-id="{{$value_detail->product_id}}">
                                <span class="product-btn-main__text product-btn-main__buying-text">Mua Ngay</span>
                            </button>
                           
                        </div>
                    
                        <div style="margin-top: 30px; border-top: 1px solid rgba(0, 0, 0, 0.05);" class="product-return">
                            <a href="*" class="product__guarantee">
                                <span><i class="product__guarantee-icon fas fa-clipboard-check"></i></span>
                                <div class="product__guarantee-text">Minecraft Shop Đảm Bảo</div>
                                <span class="product__guarantee-note">3 Ngày Trả Hàng / Hoàn Tiền</span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach()
<!-- Product shop -->
<!-- <div class="grid wide">
    <div class="row product-shop">
        <div class="product-shop__contact">
            <a href=""class="product-shop__contact-img-link">
                <div class="product-shop__contact-avatar-wrapper">
                    <img src="{{asset('public/fontend/images/shop_manager.png')}}" alt="" class="product-shop__contact-avatar">
                </div>
                <span class="label-loving">Yeu thich</span>
            </a>
            <div class="product-shop__contact-container">
                <span class="product-shop__contact-name">Ngo Quyen</span>
                <span class="product-shop__contact-online">Online 28 phut truoc</span>
                <div class="product-shop__contact-main">
                    <a href="" class="product-shop__contact-btn product-shop__contact-btn--message">
                        <i class="product-shop__contact-icon far fa-comment-alt"></i>
                        <span class="product-shop__contact-message-text">Chat Ngay</span>
                    </a>
                    <a href="" class="product-shop__contact-btn product-shop__contact-btn--viewing">
                        <i class="product-shop__contact-viewing-icon fas fa-store"></i>
                        <span class="product-shop__contact-viewing-text">Xem Shop</span>
                    </a>
                </div>
            </div>
        </div> -->
        <!-- <div class="product-shop__side">
            <div class="product-shop__side-container">
                <div class="product-shop__side-wrapper">
                    <label for="" class="product-shop__side-label">Đánh giá</label>
                    <span class="product-shop__side-qnt product-shop__side-qnt-link">220</span>
                </div>
                <div class="product-shop__side-wrapper">
                    <label for="" class="product-shop__side-label">Sản phẩm</label>
                    <span class="product-shop__side-qnt">12</span>
                </div>
            </div>
            <div class="product-shop__side-container">
                <div class="product-shop__side-wrapper">
                    <label for="" class="product-shop__side-label">Tỉ lệ phản hồi</label>
                    <span class="product-shop__side-qnt product-shop__side-qnt-link">95%</span>
                </div>
                <div class="product-shop__side-wrapper">
                    <label for="" class="product-shop__side-label">Thời gian phản hồi</label>
                    <span class="product-shop__side-qnt">trong vài phút</span>
                </div>
            </div>
            <div class="product-shop__side-container">
                <div class="product-shop__side-wrapper">
                    <label for="" class="product-shop__side-label">Tham gia</label>
                    <span class="product-shop__side-qnt product-shop__side-qnt-link">6 tháng trước</span>
                </div>
                <div class="product-shop__side-wrapper">
                    <label for="" class="product-shop__side-label">Người theo dõi</label>
                    <span class="product-shop__side-qnt">1.5k</span>
                </div>
            </div>
        </div> -->
    <!-- </div>
</div> -->

@foreach ($detail_product as $key => $value_detail)
<!-- Product content -->
<div class="grid wide">
    <div class="row product-content__details">
        <div class="product-content--left">
            <!-- product details -->
            <div class="product-details">
                <div class="product-detail">
                    <h2 class="product-detail__name">Thông số kĩ thuật</h2>
                    <div class="product-detail__container">
                        <div class="product-detail__wrapper">
                            <label for="" class="product-detail__label">Danh Mục</label>
                            <div class="product-detail__links">
                                <a href="" class="product-detail__link">Shop</a>
                                <svg class="product-detail__icon" enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0"><path d="m2.5 11c .1 0 .2 0 .3-.1l6-5c .1-.1.2-.3.2-.4s-.1-.3-.2-.4l-6-5c-.2-.2-.5-.1-.7.1s-.1.5.1.7l5.5 4.6-5.5 4.6c-.2.2-.2.5-.1.7.1.1.3.2.4.2z"></path></svg>
                                <a href="" class="product-detail__link">Điện Thoại</a>
                                <svg class="product-detail__icon" enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0"><path d="m2.5 11c .1 0 .2 0 .3-.1l6-5c .1-.1.2-.3.2-.4s-.1-.3-.2-.4l-6-5c-.2-.2-.5-.1-.7.1s-.1.5.1.7l5.5 4.6-5.5 4.6c-.2.2-.2.5-.1.7.1.1.3.2.4.2z"></path></svg>
                                <a href="" class="product-detail__link">Điện thoại thông minh</a>
                        
                            </div>
                        </div>
                        <div class="product-detail__wrapper">
                            <label for="" class="product-detail__label">Thương hiệu</label>
                            <a href="" class="product-detail__link">{{$value_detail->brand_name}}</a>
                        </div>
                        <div class="product-detail__wrapper">
                            <label for="" class="product-detail__label">Model</label>
                            <a href="" class="product-detail__link">{{$value_detail->product_name}}</a>
                        </div>
                        <div class="product-detail__wrapper">
                            <label for="" class="product-detail__label">Bộ nhớ trong</label>
                            <span class="product-detail__text">{{$value_detail->Bonhotrong}}</span>
                        </div>
                        <div class="product-detail__wrapper">
                            <label for="" class="product-detail__label">Hệ điều hành</label>
                            <a href="" class="product-detail__link">{{$value_detail->Hedieuhanh}}</a>
                        </div>
                        <div class="product-detail__wrapper">
                            <label for="" class="product-detail__label">Camera sau</label>
                            <span class="product-detail__text">{{$value_detail->Camerasau}}</span>
                        </div>
                        <div class="product-detail__wrapper">
                            <label for="" class="product-detail__label">Camera trước</label>
                            <span class="product-detail__text">{{$value_detail->Cameratruoc}}</span>
                        </div>
                        <div class="product-detail__wrapper">
                            <label for="" class="product-detail__label">Ram</label>
                            <span class="product-detail__text">{{$value_detail->Ram}}</span>
                        </div>
                        <div class="product-detail__wrapper">
                            <label for="" class="product-detail__label">Thẻ sim</label>
                            <span class="product-detail__text">{{$value_detail->Thesim}}</span>
                        </div>
                        <div class="product-detail__wrapper">
                            <label for="" class="product-detail__label">Thẻ nhớ</label>
                            <span class="product-detail__text">{{$value_detail->Thenho}}</span>
                        </div>
                        <div class="product-detail__wrapper">
                            <label for="" class="product-detail__label">Màn hình</label>
                            <span class="product-detail__text">{{$value_detail->Manhinh}}</span>
                        </div>
                        <div class="product-detail__wrapper">
                            <label for="" class="product-detail__label">CPU</label>
                            <span class="product-detail__text">{{$value_detail->CPU}}</span>
                        </div>
                        <div class="product-detail__wrapper">
                            <label for="" class="product-detail__label">Màu</label>
                            <span class="product-detail__text">Nhiều màu</span>
                        </div>
                        <div class="product-detail__wrapper">
                            <label for="" class="product-detail__label">Kho hàng</label>
                            <span class="product-detail__text">{{$value_detail->product_quantity}}</span>
                        </div>
                        <!-- <div class="product-detail__wrapper">
                            <label for="" class="product-detail__label">Gửi từ</label>
                            <span class="product-detail__text">TP. Hồ Chí Minh</span>
                        </div> -->
                        <div class="product-detail__wrapper">
                            <label for="" class="product-detail__label"></label>
                            <span class="product-detail__text"></span>
                        </div>
                    </div>
                </div>
                <div class="product-description">
                    <h2 class="product-desc__name">Chi tiết sản phẩm</h2>
                    <span class="product-desc__content">
                        {!!$value_detail->product_content!!}
                    </span>
                    <button class="read-more-btn clear-btn">
                        <span class="read-more-btn__text">Xem thêm</span>
                        <span class="read-more-btn__icon--down">
                            <i class="read-more-btn__icon fas fa-angle-down"></i>
                        </span>
                        <span class="read-more-btn__icon--up hidden">
                            <i class="read-more-btn__icon fas fa-angle-up"></i>
                        </span>
                    </button>
                </div>
            </div>
            <div class="product-reviews">
                <h2 class="product-reviews__header">{{$value_detail->product_total_rating}} Đánh giá  {{$value_detail->product_name}}</h2>
                <div class="component__rating-content">
                   
                    <div class="rating__item">
                            <?php
                                $number_star1 = 0;
                                if($value_detail->product_total_rating) {
                                    $number_star1 = round($value_detail->product_total_number / $value_detail->product_total_rating,2); 
                                }
                            ?>
                        <div class=""> 
                            <span class="fa fa-star rating__item-span" ></span><b class="rating__item-number">{{$number_star1}}</b>
                        </div>
                    </div>
                
                    <div class="list__rating">
                    @foreach($ratingDefault as $key => $item)
                        <div class="item__rating">
                            <div class="item__rating-key">
                                {{ $key }} <span class="fa fa-star"></span>
                            </div >
                            <div class="item__rating-render">
                                @php
                                    $ageItem = 0;
                                    if($value_detail->product_total_rating) 
                                      $ageItem=($item['count_number'] / $value_detail->product_total_rating)*100

                                @endphp
                                <span class="item__rating-render-number" ><b class="item__rating-render-width" style="width:{{$ageItem}}%"></b></span>
                            </div>
                            <div class="item__rating-evaluate">
                                <a href="" style="text-decoration:none;">{{$item['count_number']}} đánh giá</a>
                            </div>
                           
                        </div>
                    @endforeach    
                    </div>
                    
                    <div class="rating__submit">
                        <a href="" class="js_rating_action">Gửi đánh giá của bạn</a>
                    </div>
                </div>
                <?php 
                    $listRating = [
                        1 => 'Không thích',
                        2 => 'Tạm được',
                        3 => 'Bình thường',
                        4 => 'Rất tốt',
                        5 => 'Tuyệt vời quá',
                    ];
                ?>
                <div class="form_rating hide">
                    <div class="form_rating-choose">
                        <p>Chọn đánh giá của bạn</p>
                        <span class="list_start">
                            @for($i=1; $i<=5; $i++)
                                <i class="fa fa-star" data-key="{{ $i }}"></i>
                            @endfor    
                        </span>
                        <span class="list_text"></span>
                        <input type="hidden" value="" class="number_rating">
                    </div>
                    <div style="margin-top:15px">
                        <textarea name="" id="ra_content" required cols="125" rows="3"></textarea>
                    </div>
                    @foreach($detail_product as $key => $value_detail)
                    <form >
                        @csrf
                        <div style="margin-top:15px">
                            <a href="{{URL::to('save-rating/'.$value_detail->product_id)}}" class="js_rating_product" style="">Gửi đánh giá</a>
                        </div>
                    </form>
                    @endforeach
                </div>
                <div class="product-reviews__comments">
					
                    @if(isset($ratings))
                        @foreach($ratings as $rating)
                        <div class="" style="margin:10px 0;">
                            <div>
                            <span style="color:#333; font-weight:bold; text-transform:capitalize;">{{isset($rating->customer->customer_name) ? $rating->customer->customer_name : 'N/A'}}</span>
                            <a href="" style="color:#2ba832; text-decoration: none;">Đã mua tại website</a>
                            </div>
                            <p style="margin:4px 0">
                                <span>
                                    @for($i=1;$i<=5;$i++)
                                        <i class="{{$i<= $rating->rating_number ? 'product__status-rating--active' : ''}} fa fa-star"></i>
                                    @endfor    
                                </span>
                                {{$rating->rating_content}}
                            </p>
                            <div>
                                <span><i class="fa fa-clock-o"></i>{{$rating->created_at}}</span>
                            </div>
                        </div>
                        @endforeach
                    @else 
                        <div class="product-reviews__comment">Rất tiếc, hiện chưa có bình luận nào</div>
                    @endif

                    <!-- <a href="" class="btn-load-rating">Xem tất cả đánh giá <i class="fas fa-chevron-right" style="font-size:10px"></i></a>     -->
				</div>
                
            </div>

            <div class="product_comment">
                    <h2 class="product_comment-label">Hỏi đáp về {{$value_detail->product_name}}</h2>
                    @if(Session::get('customer_id'))
                    <form action="">
                        @csrf
                        <input type="hidden" class="comment_product_id" name="comment_product_id" value="{{$value_detail->product_id}}">
                        <input type="hidden" class="comment_customer_name" name="comment_customer_name" value="{{Session::get('customer_name')}}">
                        <div class="product_comment-body">
                            <textarea class="product_comment-desc" rows=4  placeholder="Viết câu hỏi của bạn"></textarea>
                            <button type="button" class="btn btn-primary product_comment-send ">Gửi câu hỏi</button>
                        </div>
                        <div id="notify_comment"></div>
                    </form>
                      
                    @endif
                    <form action="">
                        @csrf
                        <div class="product_comment-container" id="comment_show">
                            <input type="hidden" class="comment_product_id" name="comment_product_id" value="{{$value_detail->product_id}}">
                            <input type="hidden" class="comment_customer_name" name="comment_customer_name" value="{{Session::get('customer_name')}}">
                       
                            <!-- <div class="product_comment-content">
                                <div class="product_comment-content__wrapper">
                                    <div class="product_comment-boxall">
                                        <h3 class="product_comment-content__label">Ngo Quyen</h3>
                                        <span class="badge badge-primary">Quản trị viên</span>
                                    </div>
                                    
                                    <span class="product_comment-content__desc">SAn pham gi do</span>
                                </div>
                            </div> -->
                           
                        </div>
                    </form>
                  
                    
            </div>

            <div class="product-similar">
                <h3 class="product-similar__label">Sản phẩm tương tự</h3>
                <div class="product-similar__items">
                    <button class="product-similar__items-btn product-similar__items-btn--left clear-btn" style="display:none">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="product-similar__items-btn product-similar__items-btn--right clear-btn" style="display:block">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    <div class="product-similar-hidden">
                        <div class="product-similar-container">
                        @foreach($relate_product as $key => $relate)
                            <div class="product-similar__wrapper">
                                <a  class="product-similar__item" href="{{URL::to('chi-tiet-san-pham/'.$relate->product_id)}}">
                                    <div class="product-similar__item-img-wrapper">
                                        <img src="{{asset('public/uploads/product/'.$relate->product_images)}}" alt="" class="product-similar__item-img">
                                    </div>
                                    <div class="home-product-item__favourite">
                                        <i class="fas fa-check"></i>
                                        <span>Yêu thích</span>
                                    </div>
                                    @if($relate->promotion_type!=0)
                                        <div class="home-product-item__sell-off">
                                            <span class="home-product-item__sell-off-percent">{{$relate->promotion_type}}%</span>
                                            <span class="home-product-item__sell-off-label">GIẢM</span>
                                        </div>
                                    @endif    
                                    <h4 class="product-similar__item-name">{{$relate->product_name}}</h4>
                                    <div class="product-similar__item-price">
                                        <span class="product-similar__item-price-old">đ{{number_format($relate->product_price,0,',','.')}} </span>
                                        <span class="product-similar__item-sold">Đã bán {{$relate->product_sold}}</span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-loving" style="margin: 40px 16px 0 16px;">
                <h3 class="product-similar__label">Sản phẩm yêu thích</h3>
                <div class="product-similar__items">
                    <div class="product-loving-detail">
                        <div class="product-loving-container" >
                            <div class="row" id="row_wishlist">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endforeach()
        <div class="product-content--right">
            <!-- Product vouchers -->
            <!-- <div class="product-vouchers">
                <div class="product-vouchers__header">Mã giảm giá của Shop</div>
                <div class="product-vouchers__list">
                    <div class="product-vouchers__item">
                        <div class="product-vouchers__item-wrapper">
                            <div class="product-vouchers__item-title">Giảm ₫3k Đơn Tối Thiểu ₫89k</div>
                            <div class="product-vouchers__item-expiry">HSD:31-03-2021</div>
                        </div>
                        <div class="product-vouchers__btn-wrapper">
                            <button class="product-vouchers__btn-save">Lưu</button>
                            <div class="product-vouchers__border-dashed"></div>
                        </div>
                        <div class="product-vouchers__border-circle">
                            <div class="product-vouchers__border-circle-edge"></div>
                        </div>
                    </div>

                    <div class="product-vouchers__item">
                        <div class="product-vouchers__item-wrapper">
                            <div class="product-vouchers__item-title">Giảm ₫3k Đơn Tối Thiểu ₫89k</div>
                            <div class="product-vouchers__item-expiry">HSD:31-03-2021</div>
                        </div>  
                        <div class="product-vouchers__btn-wrapper">
                            <button class="product-vouchers__btn-save">Lưu</button>
                            <div class="product-vouchers__border-dashed"></div>
                        </div>
                        <div class="product-vouchers__border-circle">
                            <div class="product-vouchers__border-circle-edge"></div>
                        </div>
                    </div>

                    <div class="product-vouchers__item">
                        <div class="product-vouchers__item-wrapper">
                            <div class="product-vouchers__item-title">Giảm ₫3k Đơn Tối Thiểu ₫89k</div>
                            <div class="product-vouchers__item-expiry">HSD:31-03-2021</div>
                        </div>
                        <div class="product-vouchers__btn-wrapper">
                            <button class="product-vouchers__btn-save">Lưu</button>
                            <div class="product-vouchers__border-dashed"></div>
                        </div>
                        <div class="product-vouchers__border-circle">
                            <div class="product-vouchers__border-circle-edge"></div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- Product hot sales -->
            <div class="product-hot-sales">
                <div class="product-hot-sales__header">Top Sản Phẩm Bán Chạy</div>
                @foreach($top_product as $key => $top_pro)
                    <a href="{{URL::to('chi-tiet-san-pham/'.$top_pro->product_id)}}" class="product-hot-sales__link">
                        <div>
                            <img class="product-hot-sales__item-img" src="{{asset('public/uploads/product/'.$top_pro->product_images)}}">
                        </div>
                        <div class="product-hot-sales__item-wrapper">
                            <div class="product-hot-sales__item-name">{{$top_pro->product_name}}</div>
                            <div class="product-hot-sales__item-price">₫{{number_format($top_pro->product_price-($top_pro->product_price*($top_pro->promotion_type/100)),0,",",".") }} - ₫{{number_format($top_pro->product_price,0,',','.')}}</div>
                        </div>
                    </a>
                @endforeach    
            </div>
        </div>
    </div>
</div>
<script src="{{asset('public/fontend/js/jquery.min.js')}}"></script>
<script src="{{asset('public/fontend/js/basejs/product-info.js')}}"></script>
<script src="{{asset('public/fontend/js/basejs/detail-input.js')}}"></script>

<!-- Js Rating -->
<script>
    $(function(){
        let listStart = $(".list_start .fa");
     
        listRatingText = {
            1 : 'Không thích',
            2 : 'Tạm được',
            3 : 'Bình thường',
            4 : 'Rất tốt',
            5 : 'Tuyệt vời quá',
        }
               
        
        listStart.mouseover(function(){
            let $this = $(this);
            let number = $this.attr('data-key');
            listStart.removeClass('rating_active');
            $('.number_rating').val(number);
            $.each(listStart,function(key){
                if(key+1<= number) {
                    $(this).addClass('rating_active')
                }
            });
            $('.list_text').text(listRatingText[$this.attr('data-key')]).show();
        });
        $(".js_rating_action").click(function(event){
            event.preventDefault();
            if($('.form_rating').hasClass('hide'))
            {
                $('.form_rating').addClass('active_rating').removeClass('hide');
            }
            else {
                $('.form_rating').addClass('hide').removeClass('active_rating');
            }
        })

        $('.js_rating_product').click(function(e) {
            event.preventDefault();
            let content = $('#ra_content').val();
            let number = $('.number_rating').val();
            let url = $(this).attr('href');
            let _token = $('input[name="_token"]').val();
            if(content && number) {
                $.ajax({
                    url:url,
                    type: "POST",
                    data: {
                        number:number,
                        content: content,
                        _token:_token,
                    }
                }).done(function(result) {
                   
                    if(result=='done') {
                        alert('Đạn đã đánh giá thành công');
                        location.reload();
                    }
                    else { 
                        alert("Bạn cần phải đăng nhập trước khi đánh giá sao");
                        window.location.href="{{URL::to('login-checkout')}}"
                    }
                })
            }

            else {
                alert('Bạn cần phải chọn số sao và viết nội dung');
            }
        })
    });
</script>

<script>
    $(document).ready(function() {
        
        load_comment();
        function load_comment() {
            var product_id = $('.comment_product_id').val();
            var customer_name = $('.comment_customer_name').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/load-comment')}}",
                method:"post",
                data:{product_id:product_id,customer_name:customer_name,_token:_token},
                success:function(data) {
                    $('#comment_show').html(data);
                }
            });
        }
        $('.product_comment-send').click(function(){
            var product_id = $('.comment_product_id').val();
            var customer_name = $('.comment_customer_name').val(); 
            var comment_content = $('.product_comment-desc').val(); 
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/send-comment')}}",
                method:"post",
                data:{product_id:product_id,customer_name:customer_name,comment_content:comment_content,_token:_token},
                success:function(data) {
                   $('#notify_comment').html('<p>Thêm bình luận thành công</p>');
                   $('#notify_comment').fadeOut(2000);
                   $('.product_comment-desc').val(''); 
                    load_comment();
                }
            });
        });
    });
</script>
@endsection()
