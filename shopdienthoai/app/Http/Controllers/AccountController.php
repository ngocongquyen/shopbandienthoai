<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use App\Models\CatePost;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Coupon;
use App\Models\Product;

use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function my_account() {
        $category_post = CatePost::orderby('cate_post_id','asc')->get();
        $customer = Customer::find(Session::get('customer_id'));
        return view('pages.users.my_account')->with(compact('category_post','customer'));
    }

    public function change_account(Request $request, $customer_id) {
        $data = array();
        $data['customer_name'] = $request->name_account;
        $data['customer_email'] = $request->email_account;
        
        DB::table('tbl_customers')->where('customer_id',$customer_id)->update($data);
        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->name_account);
        Session::put('customer_email',$request->email_account);
       
        Session::put('message','Cập nhật tài khoản thành công');
        return Redirect::to('/my-account');
    }

    public function history() {
        if(!Session::get('customer_id')) {
            return redirect('login-checkout')->with('message',"Vui lòng đăng nhập để xem lịch sử mua hàng");
        }
        else {
            $get_order = Order::where('customer_id',Session::get('customer_id'))->orderby('order_id','desc')->paginate(10);
            $category_post = CatePost::orderby('cate_post_id','asc')->get();
            return view('pages.users.history')->with(compact('get_order','category_post'));
        }
        
    }

    public function view_history_order(Request $request, $order_id) {
        if(!Session::get('customer_id')) {
            return redirect('login-checkout')->with('message',"Vui lòng đăng nhập để xem lịch sử mua hàng");
        }
        else {
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
            $category_post = CatePost::orderby('cate_post_id','asc')->get();
            return view('pages.users.view_history_order')->with(compact('order_details','customer','coupon_code',
            'shipping','payment','order_details','coupon_condition','coupon_number','order','order_status','category_post'));
        }
    }

    public function huy_don_hang(Request $request) {
        $data = $request->all();
        $order = Order::where('order_id',$data['id'])->first();
        $order->order_destroy = $data['lydo'];
        $order->order_status = 3;
        $order->save();
        echo('done');
    }
}
