@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">
    <style type="text/css">
        p.title_thongke {
            text-align: center;
            font-size:20px;
            font-weight:bold;
        }

        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
            color:#000;
        }
    </style>
    <div class="row">
        <p class="title_thongke">Thống kê đơn hàng doanh số</p>
        <form action="" autocomplete="off">
            @csrf
            <div class="col-md-2">
                <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
                <input type="button" id="btn-dashboard-filter" class="btn btn-primary" value="Lọc kết quả">

            </div>
            <div class="col-md-2">
                <p>Đến ngày:<input type="text" id="datepicker2" class="form-control"></p>
            </div>
            <div class="col-md-2">
                <p>
                    Lọc theo:
                    <select class="dashboard-filter form-control">
                        <option value="">--Chọn--</option>
                        <option value="7ngay">7 ngày trước</option>
                        <option value="thangtruoc">tháng trước</option>
                        <option value="thangnay">tháng này</option>
                        <option value="365ngayqua">365 ngày qua</option>
                    </select>
                </p>
            </div>
       
            <div class="col-md-12">
                <div id="thongkedonhang" style="color:red;max-height: 60vh;overflow-y: auto;">
                    
                </div>
            </div>
        </form>    
    </div>
</div>

<div class="row" style="margin-top:20px">
    <div class="col-md-4 col-xs-12">
        <p class="title_thongke" style="color: black;font-weight: bold;text-align: center;font-size: 20px;">Thống kê</p>
        <div id="donut"></div>
    </div>
    <div class="col-md-4 col-xs-12">
        <h3>Bài viết xem nhiều</h3>
        <ol class="list_views">
            @foreach($post_views as $key => $post)
                <li>
                    <a href="{{url('/bai-viet/'.$post->post_slug)}}" target="_blank" >{{$post->post_title}} | <span style="color:black">
                    {{$post->post_views}}
                    </span>
                    </a>
                </li>
            @endforeach
        </ol>
    </div>

    <div class="col-md-4 col-xs-12">
        <style type="text/css">
            ol.list_views {
                margin:10px 0;
                color:#fff;
            }
            ol.list_views a {
                color:red;
                font-weight:400;
                text-decoration: none;
            }
        </style>
        <h3>Sản phẩm bán nhiều nhất</h3>
        <ol class="list_views">
            @foreach($product_sold as $key =>$pro)
            <li>
                <a href="{{url('/chi-tiet-san-pham/'.$pro->product_id)}}" target="_blank">{{$pro->product_name}} | <span style="color:black">{{$pro->product_sold}}</span> </a>
            </li>
            @endforeach
        </ol>
    </div>
</div>
@endsection()