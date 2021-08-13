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
        <div class="c-9 col">
            <h2 class="post_heading">{{$meta_title}}</h2>
            <div class="main_post">
                <div class="post_container">
                    <div class="post_wrapper">
                        @foreach($post as $key => $p)
                            <div class="post_item">
                                <a href="{{URL::to('bai-viet/'.$p->post_slug)}}" class="post_item-link">
                                    <img src="{{asset('public/uploads/post/'.$p->post_image)}}" alt="{{$p->post_slug}}" class="post_item-img">
                                </a>
                                <div class="post_item-infor">
                                    <a href="{{URL::to('bai-viet/'.$p->post_slug)}}" class="post_item-infor__cate">{{$p->cate_post->cate_post_name}}</a>
                                    <a href="{{URL::to('bai-viet/'.$p->post_slug)}}" class="post_item-infor__link">
                                        <h3 class="post_item-infor__title">{{$p->post_title}}</h3>
                                    </a>     
                                        {!!$p->post_desc!!}
                                </div>
                            </div>
                        @endforeach()
                        
                    </div>
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