<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use App\Models\Product;
use App\Models\Post;
use App\Models\Customer;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Admin;
use App\Models\Statistical;
use Carbon\Carbon;
use Socialite;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Login;

session_start();
class AdminController extends Controller
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
    public function index() {
        return view('admin_login');
    }
    public function showdashboard() {
        $p_product=Product::all()->count();
        $b_brand=Brand::all()->count();
        $o_order=Order::all()->count();
        $p_post=Post::all()->count();
        $c_customer=Customer::all()->count();
        $a_admin=Admin::all()->count();
        $product_sold = Product::orderby('product_sold','desc')->take(20)->get();
    
        $post_views = Post::orderby('post_views','desc')->take(20)->get();
        $this->AuthLogin();

        return view('admin.dashboard')->with(compact('product_sold','post_views','p_product','b_brand','o_order','p_post','c_customer','a_admin'));
    }
    public function dashboard(Request $request) {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($result) {
            Session::put('login_normal',true);
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            return Redirect::to('/dashboard');
        }
        else {
            Session::put('message',"Mật khẩu hoặc tài khoản bị sai");
            return Redirect::to('/admin');
        }
    }
    public function logout() {
        $this->AuthLogin();
        Session::forget('login_normal');
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }

    public function filter_by_date(Request $request) {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = Statistical::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','asc')->get();
        if($get) {
            $output = '<table class="table style="max-hight:56vh;overf">
            <thead>
                <tr>
                <th scope="col">Ngày đặt</th>
                <th scope="col">Doanh thu</th>
                <th scope="col">Số lượng bán</th>
                <th scope="col">Tổng hóa đơn</th>
                </tr>
            </thead>
            <tbody>';
            foreach($get as $key => $val) {
                $output.=
                '<tr>
                <th scope="row">'.$val->order_date.'</th>
                <td>'.number_format($val->sales,0,',','.').' đ</td>
                <td>'.$val->quantity.'</td>
                <td>'.$val->total_order.'</td>
                </tr>
                <tr>';
            }
            $output.='</tbody>
            </table>';
            echo $output;
        }
        
    }

    public function dashboard_filter(Request $request) {
        $data = $request->all();
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        
        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        if($data['dashboard_value']=='7ngay') {
            $get = Statistical::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date','asc')->get();
        }
        elseif($data['dashboard_value']=='thangtruoc') {
            $get = Statistical::whereBetween('order_date',[$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('order_date','asc')->get();
        }
        elseif($data['dashboard_value']=='thangnay') {
            $get = Statistical::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date','asc')->get();
        }
        else {
            $get = Statistical::whereBetween('order_date',[$sub365days,$now])->orderBy('order_date','asc')->get();
        }

        if($get) {
            $output = '<table class="table style="max-hight:56vh;overf">
            <thead>
                <tr>
                <th scope="col">Ngày đặt</th>
                <th scope="col">Doanh thu</th>
                <th scope="col">Số lượng bán</th>
                <th scope="col">Tổng hóa đơn</th>
                </tr>
            </thead>
            <tbody>';
            foreach($get as $key => $val) {
                $output.=
                '<tr>
                <th scope="row">'.$val->order_date.'</th>
                <td>'.number_format($val->sales,0,',','.').' đ</td>
                <td>'.$val->quantity.'</td>
                <td>'.$val->total_order.'</td>
                </tr>
                <tr>';
            }
            $output.='</tbody>
            </table>';
            echo $output;
        }
    }

    public function days_order() {
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistical::whereBetween('order_date',[$sub30days,$now])->orderBy('order_date','desc')->get();
        if($get) {
            $output = '<table class="table style="max-hight:56vh;overf">
            <thead>
                <tr>
                <th scope="col">Ngày đặt</th>
                <th scope="col">Doanh thu</th>
                <th scope="col">Số lượng bán</th>
                <th scope="col">Tổng hóa đơn</th>
                </tr>
            </thead>
            <tbody>';
            foreach($get as $key => $val) {
                $output.=
                '<tr>
                <th scope="row">'.$val->order_date.'</th>
                <td>'.number_format($val->sales,0,',','.').' đ</td>
                <td>'.$val->quantity.'</td>
                <td>'.$val->total_order.'</td>
                </tr>
                <tr>';
            }
            $output.='</tbody>
            </table>';
            echo $output;
        }
    }
    // public function login_facebook(){
    //     return Socialite::driver('facebook')->redirect();
    // }

    // public function callback_facebook(){
    //     $provider = Socialite::driver('facebook')->user();
    //     $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
    //     if($account){
    //         //login in vao trang quan tri  
    //         $account_name = Login::where('admin_id',$account->user)->first();
    //         Session::put('admin_name',$account_name->admin_name);
    //         Session::put('admin_id',$account_name->admin_id);
            
    //         return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
    //     }else{

    //         $hieu = new Social([
    //             'provider_user_id' => $provider->getId(),
    //             'provider' => 'facebook'
    //         ]);

    //         $orang = Login::where('admin_email',$provider->getEmail())->first();

    //         if(!$orang){
    //             $orang = Login::create([
    //                 'admin_name' => $provider->getName(),
    //                 'admin_email' => $provider->getEmail(),
    //                 'admin_password' => '',
    //                 'admin_phone' => '',

    //             ]);
    //         }
    //         $hieu->login()->associate($orang);
    //         $hieu->save();

    //         $account_name = Login::where('admin_id',$account->user)->first();

    //         Session::put('admin_name',$account_name->admin_name);
    //         Session::put('admin_id',$account_name->admin_id);
    //         return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
    //     } 
    // }

}
