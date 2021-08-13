<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Admin;
use Carbon\Carbon;
use App\Models\CatePost;
use Session;
use Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
session_start();
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function send_coupon_vip($coupon_time,$coupon_condition,$coupon_number,$coupon_code) {
        $customer_vip = Customer::where('customer_vip',1)->get();
        $coupon = Coupon::where('coupon_code',$coupon_code)->first();
        $start_coupon = $coupon->coupon_date_start;
        $end_coupon = $coupon->coupon_date_end;
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Mã khuyến mãi ngày" . '' .$now;
       
        $data = [];
        foreach($customer_vip as $vip) {
            $data['email'][] = $vip->customer_email;
        }
        $coupon = array(
            'start_coupon' => $start_coupon,
            'end_coupon' => $end_coupon,
            'coupon_time' => $coupon_time,
            'coupon_condition' => $coupon_condition,
            'coupon_number' => $coupon_number,
            'coupon_code' => $coupon_code
        );
        Mail::send('pages.send_coupon_vip',['coupon'=>$coupon],function($message) use ($title_mail,$data){
            $message->to($data['email'])->subject($title_mail);//send this mail with subject
            $message->from($data['email'],$title_mail);//send from this mail
        });
        return redirect()->back()->with('message','Gửi mã khuyến mãi khách vip thành công');
    }
    public function mail_example() {
        return view('pages.send_coupon_vip');
    }

    public function send_coupon($coupon_time,$coupon_condition,$coupon_number,$coupon_code) {
        $customer = Customer::where('customer_vip',"=",NULL)->get();
        $coupon = Coupon::where('coupon_code',$coupon_code)->first();
        $start_coupon = $coupon->coupon_date_start;
        $end_coupon = $coupon->coupon_date_end;
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Mã khuyến mãi ngày" . '' .$now;
        $data = [];

        foreach($customer as $normal) {
            $data['email'][] = $normal->customer_email;
        }
        $coupon = array(
            'start_coupon' => $start_coupon,
            'end_coupon' => $end_coupon,
            'coupon_time' => $coupon_time,
            'coupon_condition' => $coupon_condition,
            'coupon_number' => $coupon_number,
            'coupon_code' => $coupon_code
        );
        Mail::send('pages.send_coupon',['coupon'=>$coupon],function($message) use ($title_mail,$data){
            $message->to($data['email'])->subject($title_mail);//send this mail with subject
            $message->from($data['email'],$title_mail);//send from this mail
        });
        return redirect()->back()->with('message','Gửi mã khuyến mãi khách thường thành công');
    }

    public function forget_password() {
        $category_post = CatePost::orderby('cate_post_id','asc')->get();
        return view('pages.checkout.forget_password')->with(compact('category_post'));
    }

    public function recover_pass(Request $request) {
        $data = $request->all();       
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_mail = "Lấy lại mật khẩu quyen.com" . '' .$now;
        
        $customer = Customer::where('customer_email',"=",$data['email_account'])->get();
        foreach($customer as $key => $value) {
            $customer_id = $value->customer_id;
        }
        if($customer) {
            $count_customer = $customer->count();
            if($count_customer==0) {
                return redirect()->back()->with('error','Email chưa được đăng kí để khôi phục mật khẩu');

            }else {
                $token_random = Str::random();
                $customer = Customer::find($customer_id);
                $customer->customer_token = $token_random;
                $customer->save();

                //send email
                $to_email = $data['email_account'];
                $link_reset_pass = url('/update-new-pass?email='.$to_email.'&token='.$token_random);
                $data = array("name"=>$title_mail,"body"=>$link_reset_pass,"email"=>$data['email_account']);
                Mail::send('pages.checkout.forget_pass_notify',['data'=>$data],function($message) use ($title_mail,$data){
                    $message->to($data['email'])->subject($title_mail);//send this mail with subject
                    $message->from($data['email'],$title_mail);//send from this mail
                });
                return redirect()->back()->with('message','Gửi mail thành công . Vui lòng vào email để cài lại mật khẩu');
            }
        }
    
        
    }

    public function update_new_pass() {
        $category_post = CatePost::orderby('cate_post_id','asc')->get();
        return view('pages.checkout.update_new_password')->with(compact('category_post'));
    }

    public function reset_new_pass(Request $request) {
        $data = $request->all();
        $token_random = Str::random();
        $customer = Customer::where('customer_email',"=",$data['email'])->where('customer_token',$data['token'])->get();
        $count = $customer->count();
        if($count>0) {
            foreach($customer as $key => $cus) {
                $customer_id = $cus->customer_id;
            }
            $reset = Customer::find($customer_id);
            $reset->customer_password = md5($data['password_account']);
            $reset->customer_token = $token_random;
            $reset->save();
            return redirect('/login-checkout')->with('message','Mật khẩu đã cập nhật mới. Quay lại trang đăng nhập');

        }else {
            return redirect('forget-password')->with('error','Vui lòng nhập lại email vì link đã quá hạn');
        }
    }

    // forget email password admin

    public function forget_password_admin() {
        return view('admin.users.forget_password_admin');
    }

    public function recover_pass_admin(Request $request) {
        $data = $request->all();       
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_mail = "Lấy lại mật khẩu quyen.com" . '' .$now;
        
        $admin = Admin::where('admin_email',"=",$data['admin_email'])->get();
        foreach($admin as $key => $value) {
            $admin_id = $value->admin_id;
        }
        if($admin) {
            $count_admin = $admin->count();
            if($count_admin==0) {
                return redirect()->back()->with('error','Email chưa được đăng kí để khôi phục mật khẩu');

            }else {
                $token_random = Str::random();
                $admin = Admin::find($admin_id);
                $admin->admin_token = $token_random;
                $admin->save();

                //send email
                $to_email = $data['admin_email'];
                $link_reset_pass = url('/update-new-pass-admin?email='.$to_email.'&token='.$token_random);
                $data = array("name"=>$title_mail,"body"=>$link_reset_pass,"email"=>$data['admin_email']);
                Mail::send('pages.checkout.forget_pass_notify',['data'=>$data],function($message) use ($title_mail,$data){
                    $message->to($data['email'])->subject($title_mail);//send this mail with subject
                    $message->from($data['email'],$title_mail);//send from this mail
                });
                return redirect()->back()->with('message','Gửi mail thành công . Vui lòng vào email để cài lại mật khẩu');
            }
        }
    }

    public function update_new_pass_admin() {
        return view('admin.users.update_new_pass_admin');
    }

    public function reset_new_pass_admin(Request $request) {
        $data = $request->all();
        $token_random = Str::random();
        $admin = Admin::where('admin_email',"=",$data['email'])->where('admin_token',$data['token'])->get();
        $count = $admin->count();
        if($count>0) {
            foreach($admin as $key => $adm) {
                $admin_id = $adm->admin_id;
            }
            $reset = Admin::find($admin_id);
            $reset->admin_password = md5($data['admin_password']);
            $reset->admin_token = $token_random;
            $reset->save();
            return redirect('/login-auth')->with('message','Mật khẩu đã cập nhật mới. Mời bạn đăng nhập');

        }else {
            return redirect('forget-password-admin')->with('error','Vui lòng nhập lại email vì link đã quá hạn');
        }
    }
}
