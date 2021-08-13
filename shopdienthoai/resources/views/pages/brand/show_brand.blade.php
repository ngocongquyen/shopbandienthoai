@extends('welcome')
@section('content')
<div class="grid wide">
    <div class="silderShow">
        <div class="slider">
            <div class="slide active">
                <img src="{{asset('public/uploads/slider/slider-1.png')}}" alt="" class="slider-images">
            </div>
            <div class="slide">
                <img src="{{asset('public/uploads/slider/slider-2.png')}}" alt="" class="slider-images">   
            </div>
            <div class="slide">
                <img src="{{asset('public/uploads/slider/slider-3.png')}}" alt="" class="slider-images">        
            </div>
            <div class="slide">
                <img src="{{asset('public/uploads/slider/slider-4.png')}}" alt="" class="slider-images">
            </div>
            <div class="slide">
                <img src="{{asset('public/uploads/slider/slider-5.png')}}" alt="" class="slider-images">
            </div>
        </div>
        <div class="slider-controls">
            <div class="slider-controls__prev">
                <i class="fas fa-chevron-left"></i>
            </div>
            <div class="slider-controls__next">
                <i class="fas fa-chevron-right"></i>
            </div>
            
        </div>
        <ul class="line">
            
        </ul>
    </div>
</div>
<div class="grid wide">
   <div class="row app__content">
      <div class="c-3 col">
            <nav class="category">
               <h3 class="category__heading"><i class="fas fa-list category__heading-icon"></i>Danh Mục</h3>
               <ul class="category-list">
               @foreach($brand_product  as $key => $show_brand)
                  <li class="category-item">
                     <div class="category-item__icon">
                        <i class="fas fa-caret-right"></i>
                     </div>
                     <a href="{{URL::to('/danh-muc-san-pham/'.$show_brand->brand_id)}}" class="category-item__link">{{$show_brand->brand_name}}</a>
                  </li>
                  @endforeach
               </ul>
            </nav>
      </div>
      <div class="c-9 col">
         <div class="home-brand">
            <div class="home-brand__header">
               <h1 class="honme-brand__label">Điện thoại</h1>
               <!-- <span class="home-brand__total">(322 sản phẩm)</span> -->
            </div>
            <!-- <div class="home-brand__filter">
               <span class="home-brand__filter-label">Lọc theo:</span>
               <span class="home-brand__filter-wrapper">
                  <h2 class="home-brand__filter-name" >Samsung</h2>
                  <i class="fas fa-times home-brand__filter-close"></i>
               </span>
            </div>
            <div class="home-brand__body">
               <div class="home-brand__body-wrapper">
               @foreach($brand_product  as $key => $show_brand)
                  <div class="home-brand__body-link">
                     <a href="{{URL::to('/danh-muc-san-pham/'.$show_brand->brand_id)}}">
                        <img src="{{asset('public/uploads/brand/'.$show_brand->brand_images)}}" alt="" class="home-brand__body-img">
                     </a>
                  </div>
                  @endforeach()
               </div>
            </div>
            <div class="home-brand__button home-brand__button--prev">   
               <i class=" fas fa-angle-left"></i>
            </div>
            <div class="home-brand__button home-brand__button--next">   
               <i class=" fas fa-angle-right"></i>
            </div> -->
         </div>
         <div class="home-content">
            <div class="row">
               <div class="home-filter hide-on-mobile-table col">
                  <span class="home-filter__label">Sắp xếp theo</span>
                  <button class="home-filter__btn btn" onclick="document.location.href=this.getAttribute('href');" href="{{URL::to('product-selling')}}">Phổ biến</button>
                  <button class="home-filter__btn btn btn--primary" onclick="document.location.href=this.getAttribute('href');" href="{{URL::to('product-latest')}}">Mới nhất</button>
                  <button class="home-filter__btn btn" onclick="document.location.href=this.getAttribute('href');" href="{{URL::to('product-selling')}}">Bán chạy</button>
                  <div class="select-input">
                     <!-- list sort -->
                     <form>
                     @csrf
                        <select name="sort" id="sort" class="select-input__list-item" >
                           <option value="{{Request::url()}}?sort_by=none">-- Sắp xếp theo --</option>
                           <option value="{{Request::url()}}?sort_by=tang_dan">Giá tăng dần</option>
                           <option value="{{Request::url()}}?sort_by=giam_dan">Giá giảm dần</option>
                           <option value="{{Request::url()}}?sort_by=kytu_az">Tên thấp đến cao</option>
                           <option value="{{Request::url()}}?sort_by=kytu_za">Tên cao đến thấp</option>
                        </select>
                     </form>
                  </div>
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
               @foreach($brand_by_id as $key => $brand)
                  <input type="hidden" id="wishlist_productname{{$brand->product_id}}"  value="{{$brand->product_name}}">
                  <input type="hidden" id="wishlist_producturl{{$brand->product_id}}"   value="{{url('chi-tiet-san-pham/'.$brand->product_id)}}">
                  <input type="hidden" id="wishlist_productprice{{$brand->product_id}}" value="{{number_format($brand->product_price-($brand->product_price*($brand->promotion_type/100)),0,',','.')}}">
                  <input type="hidden" id="wishlist_productimage{{$brand->product_id}}" value="{{asset('public/uploads/product/'.$brand->product_images)}}">
                  <input type="hidden" id="wishlist_producttype{{$brand->product_id}}" value="{{$brand->promotion_type}}">
                  <input type="hidden" id="wishlist_productsold{{$brand->product_id}}" value="{{$brand->product_sold}}">
                  <div class="c-3 col">
                     <div class="home-product-item" >
                        <a href="{{URL::to('/chi-tiet-san-pham/'.$brand->product_id)}}">
                              <img src="{{URL::to('public/uploads/product/'.$brand->product_images)}}" class="home-product-item__img">
                        </a>
                        <h4 class="home-product-item__name">{{$brand->product_name}}</h4>
                        <div class="home-product-item__price">
                            @if($brand->promotion_type!= 0) 
                                <span class="home-product-item__price-old">{{number_format($brand->product_price,0,',','.')}} đ</span>
                            @endif  
                              <span class="home-product-item__price-new">{{number_format($brand->product_price-($brand->product_price*($brand->promotion_type/100)),0,",",".") }}đ</span>
                        </div>
                        <div class="home-product-item__action">
                              <span class="home-product-item__like home-product-item__like--liked">
                              <i class="home-product-item__like-icon-empty far fa-heart" id="{{$brand->product_id}}" onclick="add_wistlist(this.id)"></i>
                              <i class="home-product-item__like-icon-fill fas fa-heart home-product-item__liked"></i>
                              </span>
                              <?php
                                $number_star = 0;
                                if($brand->product_total_rating) {
                                    $number_star = round($brand->product_total_number / $brand->product_total_rating,2); 
                                }
                              ?>
                              <div class="home-product-item__rating">
                              @for($i=1; $i<=5; $i++)
                                    <i class="{{$i<=$number_star ? 'home-product-item__star--gold' : ''}} fas fa-star"></i>
                              @endfor   
                              </div>
                              <span class="home-product-item__sold">{{$brand->product_sold}} đã bán</span>
                        </div>
                        <!-- <div class="home-product-item__orgin">
                              <span class="home-product-item__brand">Whoo</span>
                              <span class="home-product-item__orgin-name">Hàn Quốc</span>
                        </div> -->
                        <div class="home-product-item__favourite">
                              <i class="fas fa-check"></i>
                              <span>Yêu thích</span>
                        </div>
                        @if($brand->promotion_type !=0)
                            <div class="home-product-item__sell-off">
                                <span class="home-product-item__sell-off-percent">{{$brand->promotion_type}}%</span>
                                <span class="home-product-item__sell-off-label">GIẢM</span>                  
                            </div>
                        @endif   
                        <div class="home-product-item__specfications">   
                              <span>Màn hình:{{$brand->Manhinh}}</span>
                              <span>CPU: {{$brand->CPU}}</span>
                              <span>RAM: {{$brand->Ram}}, Bộ nhớ trong: {{$brand->Bonhotrong}}</span>
                              <span>Camera sau: {{$brand->Camerasau}}</span>
                              <span>Camera trước: {{$brand->Cameratruoc}}</span>
                              <span>Pin: {{$brand->Dungluongpin}}</span>
                        </div>
                     </div>
                  </div>
                  @endforeach
               </div>
              {!!$brand_by_id->links()!!}
            </div>
         </div>
      </div>
   </div>
</div>


<!-- Slider -->
<script type="text/javascript">
        const sliders = document.querySelector(".slider").children;
        const prev = document.querySelector(".slider-controls__prev");
        const next = document.querySelector(".slider-controls__next");
        const line=document.querySelector(".line");

        let index = 0;
        prev.addEventListener("click",function(){
            prevSlide();
            updateCircleIndicator();
            resetTimer();
        })

        next.addEventListener("click",function(){
            nextSlide();
            updateCircleIndicator();
            resetTimer();
        })

        function nextSlide() {
            if(index==sliders.length-1) {
                index=0;
            }
            else {
                index++;
            }
            changeSlide();
        }
        
        //create circle indicators
        function circleIndicator() {
            for(let i=0; i< sliders.length; i++) {
                const div = document.createElement("li");
                div.setAttribute("onclick",'indicateSlide(this)');
                div.id=i;
                if(i==0) {
                    div.className="active";
                }
                line.appendChild(div);


            }
        }

        circleIndicator();
        
        function indicateSlide(element) {
            index=element.id;
            changeSlide();
            updateCircleIndicator();
            resetTimer();
        }
        function updateCircleIndicator() {
            for(let i=0; i< line.children.length;i++) {
                line.children[i].classList.remove("active");
            }
            line.children[index].classList.add("active");
        }
        function prevSlide() {
            if(index==0) {
                index=sliders.length-1;
            }
            else {
                index--;
            }
            changeSlide();
        }
        function changeSlide() {
            for(let i=0; i<sliders.length; i++) {
                sliders[i].classList.remove('active');

            }
            sliders[index].classList.add('active');
        }

        function resetTimer() {
            clearInterval(timer);
            timer=setInterval(autoPlay,5000);
        }
        function autoPlay() {
            nextSlide();
            updateCircleIndicator();
        }

        let timer = setInterval(autoPlay,5000);
       
</script>
@endsection()