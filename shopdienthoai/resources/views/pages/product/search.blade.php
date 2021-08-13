@extends('welcome')
@section('content')
<div class="grid wide">
   <div class="row app__content">
   <div class="col l-3 m-3">
         <nav class="category">
            <h3 class="category__heading"><i class="fas fa-list category__heading-icon"></i>Danh Mục</h3>
            <ul class="category-list">
            @foreach($brand_product_home  as $key => $all_brand)
               <li class="category-item">
                  <div class="category-item__icon">
                     <i class="fas fa-caret-right"></i>
                  </div>
                  <a href="{{URL::to('/danh-muc-san-pham/'.$all_brand->brand_id)}}" class="category-item__link">{{$all_brand->brand_name}}</a>
               </li>
               @endforeach
            </ul>
         </nav>
   </div>
      <div class="col l-9 m-9 c-12">
         <h1>
            <span>Kết quả tìm kiếm với khóa {{$keyword}}</span>
         </h1>
         <div class="home-content">
            <div class="row">
               <div class="home-filter hide-on-mobile-table col">
                  <span class="home-filter__label">Sắp xếp theo</span>
                  <button class="home-filter__btn btn btn--primary">Liên quan</button>
                  <button class="home-filter__btn btn" onclick="document.location.href=this.getAttribute('href');" href="{{URL::to('product-latest')}}">Mới nhất</button>
                  <button class="home-filter__btn btn" onclick="document.location.href=this.getAttribute('href');" href="{{URL::to('product-selling')}}">Bán chạy</button>
                  <!-- <div class="select-input"> -->
                     <!-- list sort -->
                     <!-- <form>
                        @csrf
                        <select name="sort" id="sort" class="select-input__list-item" >
                           <option value="{{Request::url()}}?sort_by=none">--Sắp xếp theo--</option>
                           <option value="{{Request::url()}}?sort_by=tang_dan">Giá tăng dần</option>
                           <option value="">Giá giảm dần</option>
                           <option value="{{Request::url()}}?sort_by=kytu_az">Tên thấp đến cao</option>
                           <option value="{{Request::url()}}?sort_by=kytu_za">Tên cao đến thấp</option>
                        </select>
                     </form>
                  </div> -->
                  <!-- <div class="home-filter__page">
                     <span class="home-filter__page-num">
                     <span class="home-filter__page-current">1</span>/14
                     </span>
                     <div class="home-filter__page-control">
                        <a href="" class="home-filter__page-btn home-filter__page-btn--disabled">
                        <i class="home-filter__page-icon  fas fa-angle-left"></i>
                        </a>
                        <a href="" class="home-filter__page-btn">
                        <i class="home-filter__page-icon fas fa-angle-right"></i>
                        </a>
                     </div>
                  </div> -->
               </div>
             
               <div class="home-product">                 
               @foreach($search_product as $key => $product)
                  <input type="hidden" id="wishlist_productname{{$product->product_id}}"  value="{{$product->product_name}}">
                  <input type="hidden" id="wishlist_producturl{{$product->product_id}}"   value="{{url('chi-tiet-san-pham/'.$product->product_id)}}">
                  <input type="hidden" id="wishlist_productprice{{$product->product_id}}" value="{{number_format($product->product_price-($product->product_price*($product->promotion_type/100)),0,',','.')}}">
                  <input type="hidden" id="wishlist_productimage{{$product->product_id}}" value="{{asset('public/uploads/product/'.$product->product_images)}}">
                  <input type="hidden" id="wishlist_producttype{{$product->product_id}}" value="{{$product->promotion_type}}">
                  <input type="hidden" id="wishlist_productsold{{$product->product_id}}" value="{{$product->product_sold}}">
                  <div class="col l-3 m-6 c-6">
                     <div class="home-product-item" >
                        <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
                           <img src="{{URL::to('public/uploads/product/'.$product->product_images)}}" class="home-product-item__img">
                        </a>
                        <h4 class="home-product-item__name">{{$product->product_name}}</h4>
                        <div class="home-product-item__price">
                           <span class="home-product-item__price-old">{{number_format($product->product_price,0,',','.')}} đ</span>
                           <span class="home-product-item__price-new">{{number_format($product->product_price-($product->product_price*($product->promotion_type/100)),0,",",".") }}đ</span>
                        </div>
                        <div class="home-product-item__action">
                           <span class="home-product-item__like home-product-item__like--liked">
                              <i class="home-product-item__like-icon-empty far fa-heart" id="{{$product->product_id}}" onclick="add_wistlist(this.id)"></i>
                              <i class="home-product-item__like-icon-fill fas fa-heart home-product-item__liked"></i>
                           </span>
                           <?php
                                $number_star = 0;
                                if($product->product_total_rating) {
                                    $number_star = round($product->product_total_number / $product->product_total_rating,2); 
                                }
                              ?>
                           <div class="home-product-item__rating">
                           @for($i=1; $i<=5; $i++)
                                 <i class="{{$i<=$number_star ? 'home-product-item__star--gold' : ''}} fas fa-star"></i>
                           @endfor   
                           </div>
                           <span class="home-product-item__sold">{{$product->product_sold}} đã bán</span>
                        </div>
                        <!-- <div class="home-product-item__orgin">
                           <span class="home-product-item__brand">Whoo</span>
                           <span class="home-product-item__orgin-name">Hàn Quốc</span>
                        </div> -->
                        <div class="home-product-item__favourite">
                           <i class="fas fa-check"></i>
                           <span>Yêu thích</span>
                        </div>
                        @if($product->promotion_type!=0) 
                           <div class="home-product-item__sell-off">
                              <span class="home-product-item__sell-off-percent">{{$product->promotion_type}}%</span>
                              <span class="home-product-item__sell-off-label">GIẢM</span>
                           </div>
                        @endif   
                     </div>
                  </div>
               @endforeach
               </div>             
              {!!$search_product->links()!!}
            </div>
         </div>
      </div>
   </div>
</div>

<script src="{{asset('public/fontend/js/jquery.min.js')}}"></script>
<!-- <script type="text/javascript">
   $(document).ready(function(){
      $('#sort').on('change',function(){
         var url = $(this).val();
         if(url) {
             window.location = url;
         }
         return false;
      })
   })
</script> -->
@endsection()