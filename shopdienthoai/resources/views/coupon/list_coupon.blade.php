@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê mã giảm giá
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <!-- <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button> -->
            
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
    <?php
      $message = Session::get('message');
      if($message) {
          echo '<span class="text">'.$message.'</span>';
          Session::put('message',null);
      }
    ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên mã giảm giá</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Mã giảm giá</th>
            <th>Số lượng giảm giá</th>
            <th>Điều kiện giảm giá</th>
            <th>Số giảm</th>
            <th>Tình trạng</th>
            <th>Hết hạn</th>
            <th>Quản lý</th>
            <th>Gửi mã</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($coupon as $key => $cou)
          <tr>
            <td>{{$cou->coupon_name}}</td>
            <td>{{$cou->coupon_date_start}}</td>
            <td>{{$cou->coupon_date_end}}</td>
            <td>{{$cou->coupon_code}}</td>
            <td>{{$cou->coupon_time}}</td>
            <td><span class="text-ellipsis">
              <?php 
                if($cou->coupon_condition==1){
              ?>
                  Giảm theo %
              <?php    
                }
                else {
              ?>    
                  Giảm theo tiền
              <?php
                }
              ?>
            </span></td>
         
            <td><span class="text-ellipsis">
              <?php 
                if($cou->coupon_condition==1){
              ?>
                  Giảm {{$cou->coupon_number}} %
              <?php    
                }
                else {
              ?>    
                  Giảm {{$cou->coupon_number}} đồng
              <?php
                }
              ?>
            </span></td>
            <td>
              <span class="text-ellipsis">
              <?php 
                if($cou->coupon_status==1){
              ?>
                 <span style="color:green">Đang kích hoạt</span> 
              <?php    
                }
                else {
              ?>    
                  <span style="color:red">Đã khóa</span>
              <?php
                }
              ?>
              </span>
            </td>
            <td>
                <?php 

                ?>
                @if($cou->coupon_date_end>=$today)
                  <span style="color:green">Còn hạn</span> 
                @else
                  <span style="color:red">Đã hết hạn</span> 
                @endif
               
            </td>
            <td style="display:inline-flex">
              <a onclick="return confirm('Bạn có chắc muốn xóa mã này không')" href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" class="active style-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
              <a href="{{URL::to('/edit-coupon/'.$cou->coupon_id)}}" class="active style-edit" ui-toggle-class="" style="margin-left:4px">
                <i class="fa fa-pencil-square-o text-success text-active"></i>
              </a>
            </td>
            
            <td>
              <p><a href="{{url('/send-coupon-vip',[
                'coupon_time' => $cou->coupon_time,
                'coupon_condition' => $cou->coupon_condition,
                'coupon_number' => $cou->coupon_number,
                'coupon_code' => $cou->coupon_code

              ])}}" class="btn btn-success" style="margin:5px 0">Gửi giảm giá khách vip</a></p>
              <p><a href="{{url('/send-coupon',[
                'coupon_time' => $cou->coupon_time,
                'coupon_condition' => $cou->coupon_condition,
                'coupon_number' => $cou->coupon_number,
                'coupon_code' => $cou->coupon_code

              ])}}" class="btn btn-default">Gửi giảm giá khách thường</a></p>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
         
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
                {!!$coupon->links()!!}
        </div>
      </div>
    </footer>
  </div>
@endsection()