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
                <li><a href="#"><i class=" fa fa-suitcase"></i>Hồ sơ</a></li>
                <li><a href="#"><i class="fa fa-cog"></i>Cài đặt</a></li>
                <?php
                    if(Session::get('login_normal')) {
                    ?>
                     <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i>Đăng xuất</a></li>
                <?php } else { ?>
                    <li><a href="{{URL::to('/logout-auth')}}"><i class="fa fa-key"></i>Đăng xuất</a></li>
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
                        <span>Tổng quan</span>
                    </a>
                </li>
               
                <li>
                    <a href="{{URL::to('/information')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Thông tin website</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Đơn hàng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/manage-order')}}">Quản lý đơn hàng</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Mã giảm giá</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/insert-coupon')}}">Thêm mã giảm giá</a></li>
						<li><a href="{{URL::to('/list-coupon')}}">Liệt kê mã giảm giá</a></li>
                    </ul>
                </li>

                <!-- <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Vận chuyển</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/delivery')}}">Quản lý vận chuyển</a></li>
                    </ul>
                </li> -->
                <!-- <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh Mục sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-category-product')}}">Thêm danh mục sản phẩm</a></li>
						<li><a href="{{URL::to('/all-category-product')}}">Liệt kê danh mục sản phẩm</a></li>
                    </ul>
                </li> -->

				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Thương hiệu sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-brand-product')}}">Thêm thương hiệu sản phẩm</a></li>
						<li><a href="{{URL::to('/all-brand-product')}}">Liệt kê thương hiệu sản phẩm</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục bài viết</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-category-post')}}">Thêm danh mục bài viết</a></li>
						<li><a href="{{URL::to('/all-category-post')}}">Liệt kê danh mục bài viết</a></li>
                    </ul>
                </li>
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
						<li><a href="{{URL::to('/all-product')}}">Liệt kê sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Khuyến mãi</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-promotion')}}">Thêm mã khuyến mãi</a></li>
						<li><a href="{{URL::to('/all-promotion')}}">Liệt kê khuyến mãi</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Thông số kĩ thuật</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-specification')}}">Thêm thông số kĩ thuật</a></li>
						<li><a href="{{URL::to('/all-specification')}}">Liệt kê thông số kĩ thuật</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Bình luận</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/comment')}}">Liệt kê bình luận</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Bài viết</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-post')}}">Thêm bài viết</a></li>
						<li><a href="{{URL::to('/all-post')}}">Liệt kê bài viết</a></li>
                    </ul>
                </li>
                
                @impersonate
                <li>
                    <a class="active" href="{{url('/impersonate-destroy')}}">
                        <i class="fa fa-book"></i>
                        <span>Stop chuyển quyền</span>
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
                         <li><a href="{{URL::to('/add-users')}}">Thêm user</a></li>
                        <li><a href="{{URL::to('/users')}}">Liệt kê user</a></li>     
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
			  <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
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
         
            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “slug”
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

<!-- lịch coupon -->
<script type="text/javascript">
    $(function(){
        $('#start_coupon').datepicker({
            prevText:"Tháng trước",
            nextText:"Tháng sau",
            dateFormat:'yy-mm-dd',
            dayNamesMin: ['Thứ 2', "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
            duration:"slow"
        });
        $("#end_coupon").datepicker({
            prevText:"Tháng trước",
            nextText:"Tháng sau",
            dateFormat:'yy-mm-dd',
            dayNamesMin: ['Thứ 2', "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
            duration:"slow"
        });
        $("#datepicker").datepicker({
            prevText:"Tháng trước",
            nextText:"Tháng sau",
            dateFormat:'yy-mm-dd',
            dayNamesMin: ['Thứ 2', "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
            duration:"slow"
        });
        $("#datepicker2").datepicker({
            prevText:"Tháng trước",
            nextText:"Tháng sau",
            dateFormat:'yy-mm-dd',
            dayNamesMin: ['Thứ 2', "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
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
                alert("Cập nhật số lượng thành công");
                location.reload();
                }
            });

        
    })
</script>

<!-- Lọc kết quả doanh thu -->
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
    //         labels: ['đơn hàng','doanh thu','số lượng'],
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
    //         labels: ['đơn hàng','doanh thu','số lượng']
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
                alert("Số lương trong kho không đủ để giao hàng");
                $('.color_qty_' + order_product_id[i]).css('background','#000');
            }
        }
        if(j==0) {
            $.ajax({
                url : '{{url('/update-order-qty')}}',
                method: 'post',
                data: {_token:_token,order_status:order_status,order_id:order_id,quantity:quantity,order_product_id:order_product_id},
                success:function(data){
                    alert("Thay đổi tình trạng đơn hàng thành công");
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
                    error+='<p>Bạn chọn tối đa chỉ được 5 ảnh</p>';
                }else if(files.length=='') {
                    error+='<p>Bạn không được bỏ trống ảnh</p>';

                }else if(files.size>2000000) {
                    error+='<p>File ảnh không được lớn hơn 2MB</p>'
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
                        $('#error_gallery').html('<span class="text-danger">Cập nhật tên hình ảnh thành công</span>');
                    }
                });
            })

            $(document).on('click','.delete-gallery',function(){
                var gal_id = $(this).data('gal_id');
                var _token = $('input[name="_token"]').val();
                if(confirm("Bạn có muốn xóa hình ảnh này không"));
                {
                    $.ajax({
                    url:'{{url('/delete-gallery')}}',
                    method:"POST",
                    data:{gal_id:gal_id,_token:_token},
                    success:function(data) {
                        load_gallery();
                        $('#error_gallery').html('<span class="text-danger">Xóa hình ảnh thành công</span>');
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
                        $('#error_gallery').html('<span class="text-danger">Cập nhật hình ảnh thành công</span>');
                    }
                });
                
            })
    }); 
</script>    

<!-- Thống kê -->
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
                {label:"Sản phẩm", value:<?php echo $p_product?>},
                {label:"Bài viết", value:<?php echo $p_post?>},
                {label:"Đơn hàng", value:<?php echo $o_order?>},
                {label:"Thương hiệu", value:<?php echo $b_brand?>},
                {label:"Khách hàng", value:<?php echo $c_customer?>},
                {label:"Quản trị", value:<?php echo $a_admin?>},
            ]
        });

    });
</script>

<!-- bình luận -->
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
                $('#notify_comment').html('<span class="text text-alert">Trả lời bình luận thành công</span>');
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
            Validator.isRequired('#admin_name',"Vui lòng nhập tên đầy đủ"),
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
