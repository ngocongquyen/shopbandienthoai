@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê đơn hàng
    </div>
    <div class="row w3-res-tb">
     
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
            <th>Thứ tự</th>
            <th>Mã đơn hàng</th>
            <th>Ngày tháng</th>
            <th>Tình trạng đơn hàng</th>
      
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @php 
          $i=0;
        @endphp
        @foreach($order as $key => $ord)
          @php
            $i++
          @endphp
          <tr>
            <td><i>{{$i}}</i></td>
            <td>{{$ord->order_id}}</td>
            <td>{{$ord->created_at}}</td>
            <td>
              @if($ord->order_status==1) 
                <span style="color:green">Đơn hàng mới</span>
              @elseif($ord->order_status==2)
                <span style="color:red">Đã xử lý - Đã giao hàng</span>
              @else 
                 <span style="color:#333"> Đơn hàng đã bị hủy</span>
              @endif    
            </td>
           
            <td>
              <a href="{{URL::to('/view-order/'.$ord->order_id)}}" class="active style-edit" ui-toggle-class="">
                <i class="fa fa-eye text-success text-active"></i>

              </a>
              <!-- <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không')" href="{{URL::to('/delete-order/'.$ord->order_id)}}" class="active style-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>

              </a>
               -->
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
          <small class="text-muted inline m-t-sm m-b-sm">{!!$order->links()!!}</small>
        </div>
      </div>
    </footer>
  </div>
@endsection()