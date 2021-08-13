<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;
use App\Http\Requests;
use DB;
use Auth;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CouponController extends Controller
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
    public function insert_coupon() {
        return view('coupon.insert_coupon');
    }
    
    public function list_coupon() {
        $this->AuthLogin();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $coupon = DB::table('tbl_coupon')->orderby('coupon_id','asc')->paginate(10);
        return view('coupon.list_coupon')->with(compact('coupon','today'));
    }

    public function delete_coupon($coupon_id) {
        $this->AuthLogin();
        DB::table('tbl_coupon')->where('coupon_id',$coupon_id)->delete();
        Session::put('message','Xóa mã giảm giá thành công');
        return Redirect::to('/list-coupon');
    }
    public function insert_coupon_code(Request $request) {
        $this->AuthLogin();
        $data = $request->all();
        $coupon = new Coupon();
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_date_start = $data['coupon_date_start'];
        $coupon->coupon_date_end = $data['coupon_date_end'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_time = $data['coupon_time'];
        $coupon->coupon_condition = $data['coupon_condition'];

        $cou_code = Coupon::orderby('coupon_code','asc')->get();
        if($cou_code) {
            foreach ($cou_code as $key => $value) {
                if($value['coupon_code'] == $data['coupon_code']) {
                    return Redirect::to('/insert-coupon')->with('message','Mã giảm giá này đã tồn tại');
                }
            }
        }

        $coupon->save();
        Session::put('message','Thêm mã giảm giá thành công');
        return Redirect::to('/insert-coupon');
    }

    public function edit_coupon($coupon_id) {
        $this->AuthLogin();
        $coupon = Coupon::find($coupon_id);
        return view('coupon.edit_coupon')->with(compact('coupon'));
    }

    public function update_coupon_code(Request $request , $coupon_id) {
        $this->AuthLogin();
        $data = $request->all();

        $coupon = Coupon::find($coupon_id);
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_date_start = $data['coupon_date_start'];
        $coupon->coupon_date_end = $data['coupon_date_end'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_time = $data['coupon_time'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_status = $data['coupon_status'];

        
        $cou_code = Coupon::whereNotIn('coupon_id',[$coupon_id])->orderby('coupon_code','asc')->get(); 
        if($cou_code) {
            foreach ($cou_code as $key => $value) {
                if($value['coupon_code'] == $data['coupon_code']) {
                    return Redirect::to('/list-coupon')->with('message','Mã giảm giá này đã tồn tại');
                }
            }
        }
        $coupon->save();
        Session::put('message','Cập nhật mã giảm giá thành công');
        return redirect('list-coupon');
    }
}
