@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="panel-heading">
        Thông tin khách hàng
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
            <th>Tên khách hàng</th>
            <th>Email</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <tr>      
            <td>{{$customer->customer_name}}</td>
            <td>{{$customer->customer_email}}</td>
          </tr>
        </tbody>
      </table>
    </div>
</div>
<br>
<div class="panel panel-default">
    <div class="panel-heading">
      Thông tin vận chuyển
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
            <th>Tên người vận chuyển</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Hình thức thanh toán</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
       
          <tr>
            <td>{{$shipping->shipping_name}}</td>
            <td>{{$shipping->shipping_address}}</td>
            <td>{{$shipping->shipping_phone}}</td>
            <td>{{$shipping->shipping_email}}</td>
            <td>
              @if($payment->payment_method==0) 
                @php
                  echo 'Chuyển khoản';
                @endphp
              @else 
              @php
                  echo 'Tiền mặt';
                @endphp
              @endif
            </td>
          </tr>
       
        </tbody>
      </table>
    </div>
</div>
<br><br>
<div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê đơn hàng
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
            <th>Thứ tự</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng kho</th>
            <th>Mã giảm giá</th>
            <th>Số lượng</th>
            <th>Giá sản phẩm</th>
            <th>Tổng tiền</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
      @php
        $i=0;
        $total = 0;
      @endphp
       @foreach($order_details as $key => $details)
       @php
        $i++;
        $subtotal = $details->product_price*$details->product_sales_qty;
        $total+=$subtotal;
       @endphp
          <tr class="color_qty_{{$details->product_id}}">
            <td><i>{{$i}}</i></td>
            <td>{{$details->product_name}}</td>
            <td>{{$details->product->product_quantity}}</td>
            <td> @if($details->coupon_id!='')
                    {{$coupon_code}}
                  @else
                    Không mã
                  @endif  
            <td>
              @if($order_status==3)
                <input type="text" disabled class="order_qty_{{$details->product_id}}" min="1"  value="{{$details->product_sales_qty}}" name="product_sales_quantity">
              @else
              <input type="number" disabled {{$order_status==2 ? 'disabled' : ''}}  class="order_qty_{{$details->product_id}}" min="1"  value="{{$details->product_sales_qty}}" name="product_sales_quantity">
              <input type="hidden" name="order_qty_storge" class="order_qty_storge_{{$details->product_id}}" value="{{$details->product->product_quantity}}">
              <input type="hidden" name="order_id" class="order_id" value="{{$details->order_id}}">
              <input type="hidden" name="order_product_id" class="order_checkout_quantity" value="{{$details->product_id}}">

              <!-- @if($order_status!=2)
                <button  class="btn btn-default update_quantity_order"  data-product_id="{{$details->product_id}}" name="update_quantity_order">Cập nhật</button>
              @endif -->
              @endif
             
            </td>
            <td>{{number_format($details->product_price,0,',','.')}} đ</td>
            <td>{{number_format($subtotal,0,',','.')}} đ</td>
            
          </tr>
        @endforeach
        </tbody>
      </table>
      <div style="text-align:center;padding:10px">
        @php
          $total_coupon = 0;
        @endphp
        @if($coupon_condition==1) 
          @php
            $total_after_coupon = ($total*$coupon_number)/100;
            echo 'Tổng giảm : '.number_format($total_after_coupon,0,',','.').' đ'.'</br>';
            $total_coupon = $total - $total_after_coupon;
          @endphp
        @else 
          @php 
            echo 'Tổng giảm : '.number_format($coupon_number,0,',','.').' đ'.'</br>';
            $total_coupon = $total - $coupon_number;
          @endphp
        @endif
        Tổng tiền: {{number_format($total_coupon,0,',','.')}} đ
      </div>
      <table>
        <tr>
          <td colspan="6">
          @foreach($order as $key => $or)
            @if($or->order_status == 1)
              <form>
                @csrf
                <select class="form-control order_details">
                  <option value="">Chưa xử lý</option>
                  <option id="{{$or->order_id}}" value="2">Xử lý giao hàng</option>
                  
                </select>  
                
              </form> 
            @elseif($or->order_status == 2)
              <form>
                @csrf
                <select class="form-control order_details">
                  <!-- <option value="">---Chọn hình thức đơn hàng----</option> -->
                  <!-- <option disabled id="{{$or->order_id}}" value="1">Chưa xử lý</option> -->
                  <option id="{{$or->order_id}}" selected value="2">Đã xử lý giao hàng</option>
          
                </select>  
                <a target="_blank" href="{{url('/print-order/'.$details->order_id)}}" style="margin:10px;text-decoration:none">In đơn hàng</a>
              </form>
            @endif 
          @endforeach  
          </td>
        </tr>
      </table>
    </div>
</div>
@endsection()