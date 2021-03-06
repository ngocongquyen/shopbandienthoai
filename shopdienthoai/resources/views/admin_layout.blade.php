<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
<meta name="csrf-token" content="{{csrf_token()}}">
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/auth_form.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css"/>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<link rel="stylesheet" href="{{asset('public/backend/css/jquery-ui.css')}}" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- calendar -->
<link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
<script src="{{asset('public/backend/js/morris.js')}}"></script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="{{URL::to('/dashboard')}}" class="logo">
        Admin
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{asset('public/backend/images/3.png')}}">
                <span class="username">
				<?php
                   if(Session::get('login_normal')) {
                       $name = Session::get('admin_name');
                   } else {
                       $name = Auth::user()->admin_name;
                   }
                   if($name) {
                       echo $name;
                   }
                ?>
				</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>H??? s??</a></li>
                <li><a href="#"><i class="fa fa-cog"></i>C??i ?????t</a></li>
                <?php
                    if(Session::get('login_normal')) {
                    ?>
                     <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i>????ng xu???t</a></li>
                <?php } else { ?>
                    <li><a href="{{URL::to('/logout-auth')}}"><i class="fa fa-key"></i>????ng xu???t</a></li>
                <?php } ?>
               
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL::to('/dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>T???ng quan</span>
                    </a>
                </li>
               
                <li>
                    <a href="{{URL::to('/information')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Th??ng tin website</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>????n h??ng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/manage-order')}}">Qu???n l?? ????n h??ng</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>M?? gi???m gi??</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/insert-coupon')}}">Th??m m?? gi???m gi??</a></li>
						<li><a href="{{URL::to('/list-coupon')}}">Li???t k?? m?? gi???m gi??</a></li>
                    </ul>
                </li>

                <!-- <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>V???n chuy???n</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/delivery')}}">Qu???n l?? v???n chuy???n</a></li>
                    </ul>
                </li> -->
                <!-- <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh M???c s???n ph???m</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-category-product')}}">Th??m danh m???c s???n ph???m</a></li>
						<li><a href="{{URL::to('/all-category-product')}}">Li???t k?? danh m???c s???n ph???m</a></li>
                    </ul>
                </li> -->

				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Th????ng hi???u s???n ph???m</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-brand-product')}}">Th??m th????ng hi???u s???n ph???m</a></li>
						<li><a href="{{URL::to('/all-brand-product')}}">Li???t k?? th????ng hi???u s???n ph???m</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh m???c b??i vi???t</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-category-post')}}">Th??m danh m???c b??i vi???t</a></li>
						<li><a href="{{URL::to('/all-category-post')}}">Li???t k?? danh m???c b??i vi???t</a></li>
                    </ul>
                </li>
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>S???n ph???m</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-product')}}">Th??m s???n ph???m</a></li>
						<li><a href="{{URL::to('/all-product')}}">Li???t k?? s???n ph???m</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Khuy???n m??i</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-promotion')}}">Th??m m?? khuy???n m??i</a></li>
						<li><a href="{{URL::to('/all-promotion')}}">Li???t k?? khuy???n m??i</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Th??ng s??? k?? thu???t</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-specification')}}">Th??m th??ng s??? k?? thu???t</a></li>
						<li><a href="{{URL::to('/all-specification')}}">Li???t k?? th??ng s??? k?? thu???t</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>B??nh lu???n</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/comment')}}">Li???t k?? b??nh lu???n</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>B??i vi???t</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-post')}}">Th??m b??i vi???t</a></li>
						<li><a href="{{URL::to('/all-post')}}">Li???t k?? b??i vi???t</a></li>
                    </ul>
                </li>
                
                @impersonate
                <li>
                    <a class="active" href="{{url('/impersonate-destroy')}}">
                        <i class="fa fa-book"></i>
                        <span>Stop chuy???n quy???n</span>
                    </a>
                </li>
                @endimpersonate
              
                @hasrole(['admin','author'])
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Users</span>
                    </a>
                    <ul class="sub">
                         <li><a href="{{URL::to('/add-users')}}">Th??m user</a></li>
                        <li><a href="{{URL::to('/users')}}">Li???t k?? user</a></li>     
                    </ul>
                </li>
                @endhasrole
            </ul>            
		</div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		@yield('admin_content')
</section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>?? 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('public/backend/js/jquery-ui.js')}}"></script>
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script> -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
<!-- Slug -->
<script>
     function ChangeToSlug()
        {
            var slug;
         
            //L???y text t??? th??? input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //?????i k?? t??? c?? d???u th??nh kh??ng d???u
                slug = slug.replace(/??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'a');
                slug = slug.replace(/??|??|???|???|???|??|???|???|???|???|???/gi, 'e');
                slug = slug.replace(/i|??|??|???|??|???/gi, 'i');
                slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'o');
                slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???/gi, 'u');
                slug = slug.replace(/??|???|???|???|???/gi, 'y');
                slug = slug.replace(/??/gi, 'd');
                //X??a c??c k?? t??? ?????t bi???t
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //?????i kho???ng tr???ng th??nh k?? t??? g???ch ngang
                slug = slug.replace(/ /gi, "-");
                //?????i nhi???u k?? t??? g???ch ngang li??n ti???p th??nh 1 k?? t??? g???ch ngang
                //Ph??ng tr?????ng h???p ng?????i nh???p v??o qu?? nhi???u k?? t??? tr???ng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //X??a c??c k?? t??? g???ch ngang ??? ?????u v?? cu???i
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox c?? id ???slug???
            document.getElementById('convert_slug').value = slug;
        }
         
</script>

<!-- CKEDITOR -->
<script>
    CKEDITOR.replace('ckeditor');
    CKEDITOR.replace('ckeditor1');
    CKEDITOR.replace('ckeditor2');
    CKEDITOR.replace('ckeditor3');
</script>

<!-- l???ch coupon -->
<script type="text/javascript">
    $(function(){
        $('#start_coupon').datepicker({
            prevText:"Th??ng tr?????c",
            nextText:"Th??ng sau",
            dateFormat:'yy-mm-dd',
            dayNamesMin: ['Th??? 2', "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7", "Ch??? nh???t"],
            duration:"slow"
        });
        $("#end_coupon").datepicker({
            prevText:"Th??ng tr?????c",
            nextText:"Th??ng sau",
            dateFormat:'yy-mm-dd',
            dayNamesMin: ['Th??? 2', "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7", "Ch??? nh???t"],
            duration:"slow"
        });
        $("#datepicker").datepicker({
            prevText:"Th??ng tr?????c",
            nextText:"Th??ng sau",
            dateFormat:'yy-mm-dd',
            dayNamesMin: ['Th??? 2', "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7", "Ch??? nh???t"],
            duration:"slow"
        });
        $("#datepicker2").datepicker({
            prevText:"Th??ng tr?????c",
            nextText:"Th??ng sau",
            dateFormat:'yy-mm-dd',
            dayNamesMin: ['Th??? 2', "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7", "Ch??? nh???t"],
            duration:"slow"
        });
    });
</script>

<!-- Cap nhap so luong admin -->
<script>
    $('.update_quantity_order').click(function(){
        var order_product_id = $(this).data('product_id');
        var order_qty = $('.order_qty_'+ order_product_id).val();
        var order_id = $('.order_id').val();
        var _token = $('input[name="_token"]').val();

        $.ajax({
            url : '{{url('/update-qty')}}',
            method: 'post',
            data: {_token:_token,order_product_id:order_product_id,order_qty:order_qty,order_id:order_id},
            success:function(data){
                alert("C???p nh???t s??? l?????ng th??nh c??ng");
                location.reload();
                }
            });

        
    })
</script>

<!-- L???c k???t qu??? doanh thu -->
<script >
    $('document').ready(function(){
        chart30daysorder();
    //   var chart =  new Morris.Bar({
    //         // ID of the element in which to draw the chart.
    //         element: 'myfirstchart',
    //         lineColors: ['#819C79','#fc8710','#FF6541','A4ADD3'],
    //         parseTime: false,
    //         hideHover: 'auto',
    //         xkey:  'period',
    //         ykeys: ['order','sales','quantity'],
    //         labels: ['????n h??ng','doanh thu','s??? l?????ng'],
    //     });
    //     // chart30daysorder();
    //    new Morris.Bar({
    //         element:'myfirstchart',
    //         lineColors: ['#819C79','#fc8710','#FF6541','A4ADD3'],
    //         hideHover: 'auto',
    //         parseTime: false,

    //         data:[
    //             {period:'2008',order:10,sales:2000000,quantity:6},
    //             {period:'2009',order:4,sales:1000000,quantity:4},
    //             {period:'2002',order:6,sales:300000,quantity:4},
    //             {period:'2010',order:4,sales:50000,quantity:6},
    //         ],
    //         xkey : 'period',
    //         ykeys: ['order','sales','quantity'],
    //         labels: ['????n h??ng','doanh thu','s??? l?????ng']
    //     });

        function chart30daysorder() {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url : '{{url('/days-order')}}',
                method: 'post',
                data: {_token:_token},
                success:function(data){
                    $('#thongkedonhang').html(data);
                }
            });
        }
        $('.dashboard-filter').change(function(){
            var _token = $('input[name="_token"]').val();
            var dashboard_value = $(this).val();
            $.ajax({
                url : '{{url('/dashboard-filter')}}',
                method: 'post',
                data: {_token:_token,dashboard_value:dashboard_value},
                success:function(data){
                    $('#thongkedonhang').html(data);
                }
            });
        })

        $('#btn-dashboard-filter').click(function(){
            var _token = $('input[name="_token"]').val();
            var from_date = $('#datepicker').val();
            var to_date = $('#datepicker2').val();
            $.ajax({
                url : '{{url('/filter-by-date')}}',
                method: 'post',
                dateType: "JSON",
                data: {_token:_token,from_date:from_date,to_date:to_date},
                success:function(data){
                    $('#thongkedonhang').html(data);
                }
            });
        }) 
    });
</script>
<!-- thay doi tinh trang don hang -->
<script>
    $('.order_details').change(function(){
        var order_status = $(this).val();
        var order_id = $(this).children(":selected").attr("id");
        var _token = $('input[name="_token"]').val();

        quantity = [];
        $("input[name='product_sales_quantity']").each(function(){
            quantity.push($(this).val());
        });
        //lay ra product id
        order_product_id = [];
        $("input[name='order_product_id']").each(function(){
            order_product_id.push($(this).val());
        });
        j=0;
        for(i=0;i<order_product_id.length;i++) {
            var order_qty = $('.order_qty_' + order_product_id[i]).val();
            var order_qty_storge = $('.order_qty_storge_' + order_product_id[i]).val()
            
            if(parseInt(order_qty)  > parseInt(order_qty_storge)) {
                j = j + 1;
                alert("S??? l????ng trong kho kh??ng ????? ????? giao h??ng");
                $('.color_qty_' + order_product_id[i]).css('background','#000');
            }
        }
        if(j==0) {
            $.ajax({
                url : '{{url('/update-order-qty')}}',
                method: 'post',
                data: {_token:_token,order_status:order_status,order_id:order_id,quantity:quantity,order_product_id:order_product_id},
                success:function(data){
                    alert("Thay ?????i t??nh tr???ng ????n h??ng th??nh c??ng");
                    location.reload();
                  
                }
            });
        }
        
     })
</script>

<script>
    $(document).ready(function(){
        // $('.add_delivery').click(function(){
        //     var city = $('.city').val();
        //     var province = $('province').val();
        //     var wards = $('.wards').val();
        // })
        $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            // alert(action);
            //  alert(matp);
            //   alert(_token);

            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url : '{{url('/select-delivery')}}',
                method: 'post',
                data: {action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                    $('#' + result).html(data); 
                }
            });
        }); 
    })
</script>

<!-- Load gallery -->
<script>
    $(document).ready(function(){
        load_gallery();

            function load_gallery() {
                var pro_id = $('.pro_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{url('/select-gallery')}}',
                    method:"POST",
                    data:{pro_id:pro_id,_token:_token},
                    success:function(data) {
                        $('#gallery_load').html(data);
                    }
                });
            }
            $('#file').change(function(){
                var error='';
                var files = $('#file')[0].files;
                if(files.length>5) {
                    error+='<p>B???n ch???n t???i ??a ch??? ???????c 5 ???nh</p>';
                }else if(files.length=='') {
                    error+='<p>B???n kh??ng ???????c b??? tr???ng ???nh</p>';

                }else if(files.size>2000000) {
                    error+='<p>File ???nh kh??ng ???????c l???n h??n 2MB</p>'
                }
                if(error=='') {

                }else{
                    $('#file').val('');
                    $('#error_gallery').html('<span class="text-danger">'+error+'</span>');
                    return false;
                }
            });
            $(document).on('blur','.edit_gal_name',function(){
                var gal_id = $(this).data('gal_id');
                var gal_text = $(this).text();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{url('/update-gallery-name')}}',
                    method:"POST",
                    data:{gal_id:gal_id,gal_text:gal_text,_token:_token},
                    success:function(data) {
                        load_gallery();
                        $('#error_gallery').html('<span class="text-danger">C???p nh???t t??n h??nh ???nh th??nh c??ng</span>');
                    }
                });
            })

            $(document).on('click','.delete-gallery',function(){
                var gal_id = $(this).data('gal_id');
                var _token = $('input[name="_token"]').val();
                if(confirm("B???n c?? mu???n x??a h??nh ???nh n??y kh??ng"));
                {
                    $.ajax({
                    url:'{{url('/delete-gallery')}}',
                    method:"POST",
                    data:{gal_id:gal_id,_token:_token},
                    success:function(data) {
                        load_gallery();
                        $('#error_gallery').html('<span class="text-danger">X??a h??nh ???nh th??nh c??ng</span>');
                    }
                });
                }
            })

            $(document).on('change','.file_image',function(){
                var gal_id = $(this).data('gal_id');
                var image = document.getElementById('file-'+gal_id).files[0];
                
                var form_data = new FormData();
                form_data.append("file",document.getElementById('file-'+gal_id).files[0]);
                form_data.append('gal_id',gal_id); 
                
                    $.ajax({
                    url:'{{url('/update-gallery')}}',
                    method:"POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:form_data,
                    contentType:false,
                    cache:false,
                    processData:false,
                    success:function(data) {
                        load_gallery();
                        $('#error_gallery').html('<span class="text-danger">C???p nh???t h??nh ???nh th??nh c??ng</span>');
                    }
                });
                
            })
    }); 
</script>    

<!-- Th???ng k?? -->
<script type="text/javascript">
    $(document).ready(function(){
        var donut = Morris.Donut({
            element: 'donut',
            resize: true,
            colors:[
                '#ce616a',
                '#61a1ce',
                '#ce8f51',
                '#f5b942',
                '#4842f5',
                '#42f55d',
            ],
            data: [
                {label:"S???n ph???m", value:<?php echo $p_product?>},
                {label:"B??i vi???t", value:<?php echo $p_post?>},
                {label:"????n h??ng", value:<?php echo $o_order?>},
                {label:"Th????ng hi???u", value:<?php echo $b_brand?>},
                {label:"Kh??ch h??ng", value:<?php echo $c_customer?>},
                {label:"Qu???n tr???", value:<?php echo $a_admin?>},
            ]
        });

    });
</script>

<!-- b??nh lu???n -->
<script type="text/javascript">
    $('.btn-reply-comment').click(function(){
        
        var comment_id = $(this).data('comment_id');
        var comment = $('.reply_comment_'+comment_id).val();
        var comment_product_id = $(this).data('product_id');
        $.ajax({
            url:'{{url('/reply-comment')}}',
            method:"POST",
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{comment_id:comment_id,comment:comment,comment_product_id:comment_product_id},
            success:function(data) {
                $('.reply_comment_'+comment_id).val('');
                $('#notify_comment').html('<span class="text text-alert">Tr??? l???i b??nh lu???n th??nh c??ng</span>');
                location.reload();
            }
        });
        
    })
</script>

<!-- Validator -->
<script src="{{asset('public/backend/js/basejs/validator.js')}}">></script>

<!-- Validator add coupon -->
<script>
    // Mong muon cua chung ta
    Validator({
        form: '#insert_coupon',
        formGroupSelector: '.form-group',
        errorSelector:'.auth-form__message',
        rules: [
            Validator.isRequired('#name_coupon'),
            Validator.isRequired('#start_coupon'),
            Validator.isRequired('#end_coupon'),
            Validator.isRequired('#code_coupon'),
            Validator.isRequired('#time_coupon'),
            Validator.isNumber('#time_coupon'),
            Validator.isRequired('#condition_coupon'),
            Validator.isRequired('#number_coupon'),
            Validator.isNumber('#number_coupon'),
           
        ],
        //  onSubmit : function(data) {
        //     console.log(data);
        //  }
    })
</script>

<!-- Validator add brand -->
<script>
    // Mong muon cua chung ta
    Validator({
        form: '#save-brand',
        formGroupSelector: '.form-group',
        errorSelector:'.auth-form__message',
        rules: [
            Validator.isRequired('#brand_name'),
            Validator.isRequired('#brand_desc'),
            Validator.isRequired('#brand_image'),
            Validator.isImage('#brand_image'),
        ],
        //  onSubmit : function(data) {
        //     console.log(data);
        //  }
    })
</script>

<!-- Validator add category post -->
<script>
    // Mong muon cua chung ta
    Validator({
        form: '#save-category',
        formGroupSelector: '.form-group',
        errorSelector:'.auth-form__message',
        rules: [
            Validator.isRequired('.cate_post_name'),
            Validator.isRequired('#cate_post_desc'),
        ],
        //  onSubmit : function(data) {
        //     console.log(data);
        //  }
    })
</script>

<!-- Validator add product -->
<script>
    // Mong muon cua chung ta
    Validator({
        form: '#save-product',
        formGroupSelector: '.form-group',
        errorSelector:'.auth-form__message',
        rules: [
            Validator.isRequired('#product_name'),
            Validator.isRequired('#product_price'),
            Validator.isNumber('#product_price'),
            Validator.isRequired('#product_quantity'),
            Validator.isNumber('#product_quantity'),
            Validator.isRequired('#product_image'),
            Validator.isImage('#product_image'),
            Validator.isRequired('.product_desc'),
            Validator.isRequired('.product_content'),
        ],
        //  onSubmit : function(data) {
        //     console.log(data);
        //  }
    })
</script>

<!-- Validator add promotion -->
<script>
    // Mong muon cua chung ta
    Validator({
        form: '#save-promotion',
        formGroupSelector: '.form-group',
        errorSelector:'.auth-form__message',
        rules: [
            Validator.isRequired('#promotion_type'),
            Validator.isNumber('#promotion_type'),
        ],
        //  onSubmit : function(data) {
        //     console.log(data);
        //  }
    })
</script>

<!-- Validator add specification -->
<script>
    // Mong muon cua chung ta
    Validator({
        form: '#save-specification',
        formGroupSelector: '.form-group',
        errorSelector:'.auth-form__message',
        rules: [
            Validator.isRequired('#hdh'),
            Validator.isRequired('#camerasau'),
            Validator.isRequired('#cameratruoc'),
            Validator.isRequired('#cpu'),
            Validator.isRequired('#ram'),
            Validator.isRequired('#bonhotrong'),
            Validator.isRequired('#thenho'),
            Validator.isRequired('#thesim'),
            Validator.isRequired('#dungluongpin'),
            Validator.isRequired('#manhinh'),
        ],
        //  onSubmit : function(data) {
        //     console.log(data);
        //  }
    })
</script>

<!-- Validator add post -->
<script>
    // Mong muon cua chung ta
    Validator({
        form: '#save-post',
        formGroupSelector: '.form-group',
        errorSelector:'.auth-form__message',
        rules: [
            Validator.isRequired('.post_name'),
            Validator.isRequired('.post_desc'),
            Validator.isRequired('.post_content'),
            Validator.isRequired('#post_image'),
            Validator.isImage('#post_image'),
        ],
        //  onSubmit : function(data) {
        //     console.log(data);
        //  }
    })
</script>

<!-- Validator add user -->
<script>
     Validator({
        form: '#store-user',
        formGroupSelector: '.form-group',
        errorSelector:'.auth-form__message',
        rules: [
            Validator.isRequired('#admin_name',"Vui l??ng nh???p t??n ?????y ?????"),
            Validator.isRequired('#admin_email'),
            Validator.isEmail('#admin_email'),
            Validator.minLength('#admin_password',6),
            Validator.isRequired('#admin_password'),
            Validator.isRequired('#admin_phone'),
            Validator.isPhone('#admin_phone'),
        ]
    })
</script>
<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="{{asset('public/backend/js/monthly.js')}}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->
</body>
</html>
