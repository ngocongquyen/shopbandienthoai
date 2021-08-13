<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Statistical;
use Mail;
use Carbon\Carbon;

use PDF;
use DB;
use Auth;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();


class OrderController extends Controller
{

    public function AuthLogin() {
        if(Session::get('login_normal')) {
            $admin_id = Session::get('admin_id');
        } else {
            $admin_id = Auth::id();
        }
        if($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
       
    }

    public function manager_order() {
        $this->AuthLogin();
        $order = Order::orderby('created_at','desc')->paginate(10);
        return view('admin.manage_order')->with(compact('order'));
    }

    public function print_order($checkout_code) {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }

    public function print_order_convert($checkout_code) {
        $order_details = OrderDetails::with('product')->where('order_id',$checkout_code)->get();
        $order = Order::where('order_id',$checkout_code)->get();
        foreach($order as $key => $ord) {
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
           
        }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();
        $order_details_product = OrderDetails::with('product')->where('order_id',$checkout_code)->get();

        foreach($order_details_product as $key => $order_d){

			$coupon_id = $order_d->coupon_id;
		}
		if($coupon_id != ''){
			$coupon = Coupon::where('coupon_id',$coupon_id)->first();

			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;
            $coupon_code = $coupon->coupon_code;

			if($coupon_condition==1){
				$coupon_echo = $coupon_number.'%';
			}elseif($coupon_condition==2){
				$coupon_echo = number_format($coupon_number,0,',','.').'đ';
			}
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;
            $coupon_code = '';
			$coupon_echo = '0';
		
		}
        $output = '';

		$output.='<style>body{
			font-family: DejaVu Sans;
		}
		.table-styling{
			border:1px solid #000;
		}
		.table-styling tbody tr td{
			border:1px solid #000;
		}
		</style>
		<h1><centerCông ty TNHH một thành viên Ngô Quyến</center></h1>
		<h4><center>Độc lập - Tự do - Hạnh phúc</center></h4>
		<p>Người đặt hàng</p>
		<table class="table-styling">
				<thead>
					<tr>
						<th>Tên khách đặt</th>
						
						<th>Email</th>
					</tr>
				</thead>
				<tbody>';
				
		$output.='		
					<tr>
						<td>'.$customer->customer_name.'</td>
						<td>'.$customer->customer_email.'</td>
						
					</tr>';
				

		$output.='				
				</tbody>
			
		</table>

		<p>Ship hàng tới</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>Tên người nhận</th>
						<th>Địa chỉ</th>
						<th>Sdt</th>
						<th>Email</th>
						
					</tr>
				</thead>
				<tbody>';
				
		$output.='		
					<tr>
						<td>'.$shipping->shipping_name.'</td>
						<td>'.$shipping->shipping_address.'</td>
						<td>'.$shipping->shipping_phone.'</td>
						<td>'.$shipping->shipping_email.'</td>
						
						
					</tr>';
				

		$output.='				
				</tbody>
			
		</table>

		<p>Đơn hàng đặt</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>Tên sản phẩm</th>
						<th>Mã giảm giá</th>
						<th>Số lượng</th>
						<th>Giá sản phẩm</th>
						<th>Thành tiền</th>
					</tr>
				</thead>
				<tbody>';
			
				$total = 0;

				foreach($order_details_product as $key => $product){

					$subtotal = $product->product_price*$product->product_sales_qty;
					$total+=$subtotal;

					if($product->coupon_id!='') {
                        $coupon_code;
                    }            
                    else{
                        $coupon_code = 'Không Mã';
                    }
                        
		$output.='		
					<tr>
						<td>'.$product->product_name.'</td>
						<td>'.$coupon_code.'</td>
						<td>'.$product->product_sales_qty.'</td>
						<td>'.number_format($product->product_price,0,',','.').'đ'.'</td>
						<td>'.number_format($subtotal,0,',','.').'đ'.'</td>
						
					</tr>';
				}

				if($coupon_condition==1){
					$total_after_coupon = ($total*$coupon_number)/100;
	                $total_coupon = $total - $total_after_coupon;
				}else{
                  	$total_coupon = $total - $coupon_number;
				}

		$output.= '<tr>
				<td colspan="2">
					<p>Tổng giảm: '.$coupon_echo.'</p>
					<p>Thanh toán : '.number_format($total_coupon,0,',','.').'đ'.'</p>
				</td>
		</tr>';
		$output.='				
				</tbody>
			
		</table>

		<p>Ký tên</p>
			<table>
				<thead>
					<tr>
						<th width="200px">Người lập phiếu</th>
						<th width="800px">Người nhận</th>
						
					</tr>
				</thead>
				<tbody>';
						
		$output.='				
				</tbody>
			
		</table>

		';


		return $output;
    }

    public function view_order($order_id) {
        $this->AuthLogin();
        $order_details = OrderDetails::with('product')->where('order_id',$order_id)->get();
        $order = Order::where('order_id',$order_id)->get();
        foreach($order as $key => $ord) {
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            $payment_id = $ord->payment_id;
            $order_status = $ord->order_status;
        }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();
        $payment = Payment::where('payment_id',$payment_id)->first();
        
        $order_details_product = OrderDetails::with('product')->where('order_id',$order_id)->get();
        
        foreach($order_details as $key => $order_d) {
            $coupon_id = $order_d->coupon_id;
        }   
        // $coupon = Coupon::where('coupon_code',$product_coupon)->first();
        if($coupon_id!='') {
            $coupon = Coupon::where('coupon_id',$coupon_id)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
            $coupon_code = $coupon->coupon_code;
        } else {
            $coupon_condition = 2;
            $coupon_number = 0;
            $coupon_code = '';
        }
        return view('admin.view_order')->with(compact('order_details','customer','shipping','payment','order_details','coupon_condition','coupon_code','coupon_number','order','order_status'));
    }

    public function update_order_qty(Request $request) {
        $this->AuthLogin(); 
        //update order
        $data = $request->all();
        $order = Order::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();

        $order_date = $order->created_at;
        $statistic = Statistical::where('order_date',$order_date)->get();
        if($statistic) {
            $statistic_count = $statistic->count();
        }
        else {
            $statistic_count = 0;
        }
        if($order->order_status == 2) {
            foreach($data['order_product_id'] as $key =>$product_id) {
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
               
                $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                foreach($data['quantity'] as $key2 => $qty) {
                    if($key==$key2) {
                        $pro_remain = $product_quantity - $qty;
                        $product->product_quantity = $pro_remain;
                        $product->product_sold = $product_sold + $qty;
                        $product->save();

        
                    }
                }
            }
            $total_order = 0;
            $sales = 0;
            $quantity = 0;
            $total = 0;
            $sales+=$order->order_total;
            $order_details = OrderDetails::where('order_id',$order->order_id)->get();
            foreach($order_details as $key => $value) {
                $quantity+=$value->product_sales_qty;
                $total_order+=1;
              
            }

            if($statistic_count>0) {
                $statistic_update = Statistical::where('order_date',$order_date)->first();
                $statistic_update->sales = $statistic_update->sales +$sales;
                $statistic_update->quantity = $statistic_update->quantity +$quantity;
                $statistic_update->total_order = $statistic_update->total_order +$total_order;
                $statistic_update->save();
            }
            else {
                $statistic_new = new Statistical();
                $statistic_new->order_date = $order_date;
                $statistic_new->sales = $sales;
                $statistic_new->quantity = $quantity;
                $statistic_new->total_order = $total_order;
                $statistic_new->save()  ;
            }


             //send mail 
         $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
         $title_mail = "Đơn hàng đã đặt được xác nhận".' '.$now;
         $customer = Customer::where('customer_id',$order->customer_id)->first();
         $data['email'][] = $customer->customer_email;
 
         //Lay gio hang
         $order_details_product = OrderDetails::where('order_id',$order->order_id)->get();
            $total =0;
         foreach ($data['order_product_id'] as $key => $product) {
            $product_mail = Product::find($product); 
            foreach($order_details_product as $key3 => $value) {
                $product_price = $value->product_price;
               
                foreach($data['quantity'] as $key2 =>$qty) {
                    if($key==$key2 && $key==$key3 && $key2==$key3) {
                        $cart_array[] = array(
                            'product_name' => $product_mail['product_name'],
                            'product_price' => $product_price,
                            'product_qty' => $qty
                        );
                    }
                    
                }
               
            }         
          
        }

        foreach($order_details_product as $key => $ord_pri) {
            $subtotal = $ord_pri->product_price*$ord_pri->product_sales_qty;
            $total+=$subtotal;  
        }
          
        
         //Lay shipping 
         $details = OrderDetails::where('order_id',$order->order_id)->get();
         foreach($details as $key => $detail) {
            $coupon_id = $detail->coupon_id;
        }  
        if($coupon_id!='') {
            $coupon = Coupon::where('coupon_id',$coupon_id)->first();
            $coupon_mail = $coupon->coupon_code;
           
            if($coupon->coupon_condition==1)
            {
                $total_coupon = ($total*$coupon->coupon_number)/100;
                $total_data = $total-$total_coupon;
            }     
            elseif($coupon->coupon_condition==2)
            {
                $total_coupon = $coupon->coupon_number;
                $total_data = $total-$coupon->coupon_number;
               
            }
        }
        else {
            $coupon_mail = 'Không có';
            $total_coupon = 0;
            $total_data = $total;
        }

        $shipping = Shipping::where('shipping_id',$order->shipping_id)->first();
        $payment = Payment::where('payment_id',$order->payment_id)->first();
        $shipping_array = array(
             'customer_name' => $customer->customer_name,
             'shipping_name' => $shipping->shipping_name, 
             'shipping_email' => $shipping->shipping_email, 
             'shipping_phone' => $shipping->shipping_phone,  
             'shipping_address' => $shipping->shipping_address, 
             'payment_method' => $payment->payment_method
         );
 
         $ordercode_mail = array(
             'coupon_code' => $coupon_mail,
             'total_coupon' =>$total_coupon,
             'order_total' => $total_data
         );
 
         $customer_method = Order::groupby('customer_id')->where('order_status','=',2)->where('customer_id',$order->customer_id)->select(\DB::raw('sum(order_total) as total,customer_id'))->get();
         foreach($customer_method as $key => $value) {
             $customer_id = $value['customer_id'];
             $order_total = $value['total'];
         }
 
         $customer_id = Customer::find($customer_id);
         if($order_total > 40000000) {
             $customer_id->customer_vip = 1;
             $customer_id->save();
         }
         else {
            $customer_id->customer_vip = 1;
            $customer_id->save();
         }
     
         Mail::send('admin.confirm_order',['cart_array'=>$cart_array,'shipping_array'=>$shipping_array,'code'=>$ordercode_mail],function($message) use ($title_mail,$data){
             $message->to($data['email'])->subject($title_mail);//send this mail with subject
             $message->from($data['email'],$title_mail);//send from this mail
         });
        }
        // elseif($order->order_status!=2 && $order->order_status!=3) {
        //     foreach($data['order_product_id'] as $key =>$product_id) {
        //         $product = Product::find($product_id);
        //         $product_quantity = $product->product_quantity;
        //         $product_sold = $product->product_sold;
        //         foreach($data['quantity'] as $key2 => $qty) {
        //             if($key==$key2) {
        //                 $pro_remain = $product_quantity + $qty;
        //                 $product->product_quantity = $pro_remain;
        //                 $product->product_sold = $product_sold - $qty;
        //                 $product->save();
        //             }
        //         }
        //     }
        //     $customer_method = Order::groupby('customer_id')->where('order_status','=',2)->where('customer_id',$order->customer_id)->select(\DB::raw('sum(order_total) as total,customer_id'))->get();
                    
        //             foreach($customer_method as $key => $value) {
        //                 $customer_id = $value['customer_id'];
        //                 $order_total = $value['total'];
        //             }
        //             if($customer_method) {
        //                 $count_admin = $customer_method->count();
        //                 if($count_admin==0) {
        //                     $customer_meth = Customer::where('customer_id',$order->customer_id)->first();
        //                     $customer_meth->customer_vip = NULL;
        //                     $customer_meth->save();
                            
        //                 }else {
        //                      $customer_id = Customer::find($customer_id);
        //                     if($order_total < 20000000) {
        //                         $customer_id->customer_vip = NULL;
        //                         $customer_id->save();
        //                     }
        //             }
                
            
        //         }
        //     }
    }

    public function update_qty(Request $request) {
        $data = $request->all();
        $order_details = OrderDetails::where('product_id',$data['order_product_id'])->where('order_id',$data['order_id'])->first();
        $order_details->product_sales_qty = $data['order_qty'];
        $order_details->save();
    }

    public function delete_order(Request $request, $order_id) {
        $this->AuthLogin();
        $order = Order::where('order_id',$order_id)->first();
        $order->delete();
        Session::put('message',"Xóa đơn hàng thành công");
        return redirect()->back();
    }
}
