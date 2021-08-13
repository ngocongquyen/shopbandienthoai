<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Http\Requests;
use App\Models\CatePost;
use App\Models\Customer;
use App\Models\Coupon;
use Carbon\Carbon;
use App\Models\Order;
use Session;
use Mail;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;

class CheckoutController extends Controller
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
    public function login_checkout() {
        $category_post = CatePost::orderby('cate_post_id','asc')->get();
        return view('pages.checkout.login_checkout')->with('category_post',$category_post);
    }

    public function add_customer(Request $request) {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        
        $customer = Customer::orderby('customer_email','asc')->get();
        if($customer) {
            foreach ($customer as $key => $value) {
                if($value['customer_email'] == $request->customer_email) {
                    return Redirect::to('/login-checkout')->with('message','Tài khoản đã tồn tại');
                }
            }
        }
            $customer_id = DB::table('tbl_customers')->insertGetId($data);
            Session::put('customer_id',$customer_id);
            Session::put('customer_name',$request->customer_name);
            Session::put('customer_email',$request->customer_email);
            
           if(Session::get('cart')) {
                return Redirect::to('/checkout');
           } 
           else {
                return Redirect::to('/Trangchu');
           }    
        
       
      
    }

    public function checkout() {
        $category_post = CatePost::orderby('cate_post_id','asc')->get();
        return view('pages.checkout.show_checkout')->with('category_post',$category_post);
    }

    public function save_checkout_customer(Request $request) {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_address'] = $request->shipping_address;
        
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id',$shipping_id);
        Session::put('shipping_name',$request->shipping_name);
        Session::put('shipping_phone',$request->shipping_phone);
        Session::put('shipping_email',$request->shipping_email);
        Session::put('shipping_address',$request->shipping_address);
        return Redirect::to('/payment');
    }

    public function payment() {
        $category_post = CatePost::orderby('cate_post_id','asc')->get();
        return view('pages.checkout.show_payment')->with('category_post',$category_post);
    }

    public function logout_checkout() {
        Session::flush('');
        return Redirect::to('/login-checkout');
    }

    public function login_customer(Request $request) {
        $email = $request->email_acount;
        $password = md5($request->password_acount);
        $result = DB::table('tbl_customers')->where('customer_email',$email)->where('customer_password',$password)->first();
        if($result) {
            Session::put('customer_id',$result->customer_id);
            Session::put('customer_name',$result->customer_name);
            Session::put('customer_email',$result->customer_email);
            if(Session::get('cart')) {
                return Redirect::to('/checkout');
            }
            else {
                return Redirect::to('/Trangchu');
            }
        }       
        else {
            Session::put('message','Mật khẩu hoặc tài khoản không đúng');
            return Redirect::to('/login-checkout');
        }
    }

    public function order_place(Request $request) {
        // foreach(Session::get('cart') as $key => $cart)
        // echo $cart['product_id'].'</br>';
        //insert payment method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        // $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);
        
        //insert order
        $total = 0;
        foreach(Session::get('cart') as $key => $cart) {
            $subtotal = $cart['product_old_price']*$cart['product_qty'];
            $total+=$subtotal;
        }
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id'); 
        $order_data['payment_id'] = $payment_id; 
        if(Session::get('coupon'))
        {
            foreach(Session::get('coupon') as $key =>$cou)
            if($cou['coupon_condition']==1)
            {
                $total_coupon = ($total*$cou['coupon_number'])/100;
                $order_data['order_total'] = $total-$total_coupon;
                $coupon = Coupon::where('coupon_id',$cou['coupon_id'])->first();
                $coupon->coupon_time = $cou['coupon_time'] - 1;
                $coupon->save();
            }     
            elseif($cou['coupon_condition']==2)
            {
                $total_coupon = $cou['coupon_number'];
                $order_data['order_total'] = $total-$cou['coupon_number'];
                $coupon = Coupon::where('coupon_id',$cou['coupon_id'])->first();
                $coupon->coupon_time = $cou['coupon_time'] - 1;
                $coupon->save();
            }
        }    
        else {
            $order_data['order_total'] = $total;
            $total_coupon = 0;
        }
        // $check_code = substr(md5(microtime()),rand(0,26),5);
        $order_data['order_status'] = 1;
        // $order_data['order_code'] = $check_code;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order_data['created_at'] = now();
        $order_id = DB::table('tbl_order')->insertGetId($order_data);
      
        //insert order details
        foreach(Session::get('cart') as $key => $cart)
        {
            $order_details_data['order_id'] = $order_id;
            $order_details_data['product_id'] = $cart['product_id'];
            $order_details_data['product_name'] = $cart['product_name']; 
            $order_details_data['product_price'] = $cart['product_old_price'];
            $order_details_data['product_sales_qty'] = $cart['product_qty']; 
           
            if(Session::get('coupon'))
            {
                foreach(Session::get('coupon') as $key =>$coup) {
                    $order_details_data['coupon_id'] = $coup['coupon_id'];
                    $coupon_mail = $coup['coupon_code'];
                }
            }
            else {
                $order_details_data['coupon_id'] = NULL;
                $coupon_mail = 'không có';
            }                       
            DB::table('tbl_order_details')->insert($order_details_data);
        }

        //send mail 
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Đơn hàng xác nhận ngày".' '.$now;
        $customer = Customer::find(Session::get('customer_id'));
        $data['email'][] = $customer->customer_email;

        //Lay gio hang
        if(Session::get('cart')==true) {
            foreach(Session::get('cart') as $key =>$cart_email) {
                $cart_array[] = array(
                    'product_name' => $cart_email['product_name'],
                    'product_price' => $cart_email['product_old_price'],
                    'product_qty' => $cart_email['product_qty'],
                );
            }
        }

        //Lay shipping 
        $shipping_array = array(
            'customer_name' => $customer->customer_name,
            'shipping_name' => Session::get('shipping_name'), 
            'shipping_email' => Session::get('shipping_email'), 
            'shipping_phone' => Session::get('shipping_phone'), 
            'shipping_address' => Session::get('shipping_address'), 
            'payment_method' => $data['payment_method']
        );

        $ordercode_mail = array(
            'coupon_code' => $coupon_mail,
            'order_total' =>  $order_data['order_total'],
            'total_coupon' => $total_coupon
        );

        Mail::send('pages.mail.mail_order',['cart_array'=>$cart_array,'shipping_array'=>$shipping_array,'code'=>$ordercode_mail],function($message) use ($title_mail,$data){
            $message->to($data['email'])->subject($title_mail);//send this mail with subject
            $message->from($data['email'],$title_mail);//send from this mail
        });

        Session::forget('coupon');
        Session::forget('cart');
        Session::put('shipping_id',null);
        Session::put('shipping_name',null);
        Session::put('shipping_phone',null);
        Session::put('shipping_address',null);
        Session::put('shipping_email',null);
        

        if($data['payment_method']==0) {
           
            $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','asc')->get();
            $get_order = Order::where('customer_id',Session::get('customer_id'))->orderby('order_id','desc')->get();
            $category_post = CatePost::orderby('cate_post_id','asc')->get();
            return Redirect::to('/history');
           
        }
        elseif($data['payment_method']==1) {
            $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','asc')->get();
            $get_order = Order::where('customer_id',Session::get('customer_id'))->orderby('order_id','desc')->get();
            $category_post = CatePost::orderby('cate_post_id','asc')->get();
            return Redirect::to('/history');
        }
        
    }

    public function manager_order() {
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->select('tbl_order.*','tbl_customers.customer_name')
        ->orderby('tbl_order.order_id','desc')->get();
        $manage_order = view('admin.manage_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manage_order',$manage_order);
    }

    public function view_order($orderID) {
        $this->AuthLogin();
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->where('tbl_order.order_id',$orderID)
        ->get();
       
        $manage_order_by_id = view('admin.view_order')->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin.view_order',$manage_order_by_id);
    }

}

