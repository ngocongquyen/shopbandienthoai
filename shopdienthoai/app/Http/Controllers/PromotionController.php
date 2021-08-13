<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use App\Http\Requests;
use App\Models\Promotion;
use App\Models\Brand;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;

class PromotionController extends Controller
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

    public function add_promotion() {
        $this->AuthLogin();
        return view('admin.promotion.add_promotion');
    }

    public function save_promotion(Request $request) {
        $this->AuthLogin();
        $data = $request->all();

        $promotion = new Promotion();
        $promotion->promotion_type = $data['promotion_type'];
        $promotion_type = Promotion::orderby('promotion_type','asc')->get();
        if($promotion_type) {
            foreach ($promotion_type as $key => $value) {
                if($value['promotion_type'] == $data['promotion_type']) {
                    return Redirect::to('/add-promotion')->with('message','Mã khuyến mã này đã tồn tại');
                }
            }
        }
        $promotion->save();
        Session::put('message','Thêm mã khuyến mãi thành công');
        return Redirect::to('/add-promotion');
    }

    public function all_promotion() {
        $this->AuthLogin();
        $promotion = Promotion::orderBy('promotion_id','asc')->get();
        return view('admin.promotion.list_promotion')->with(compact('promotion'));
    }

    public function delete_promotion($promotion_id) {
        $this->AuthLogin();
        $promotion = Promotion::find($promotion_id);
        $promotion->delete();
        Session::put('message','Xóa khuyến mãi thành công');
        return redirect()->back();
    }
    public function edit_promotion($promotion_id) {
        $this->AuthLogin();
        $promotion = Promotion::find($promotion_id);
        return view('admin.promotion.edit_promotion')->with(compact('promotion'));
    }

    public function update_promotion(Request $request, $promotion_id) {
        $this->AuthLogin();
        $data = $request->all();
        $promotion = Promotion::find($promotion_id);
        $promotion->promotion_type = $data['promotion_type'];
        $promotion_type = Promotion::whereNotIn('promotion_id',[$promotion_id])->orderby('promotion_type','asc')->get(); 
        if($promotion_type) {
            foreach ($promotion_type as $key => $value) {
                if($value['promotion_type'] == $data['promotion_type']) {
                    return Redirect::to('/all-promotion')->with('message','Mã khuyến mãi này đã tồn tại');
                }
            }
        }
        $promotion->save();
        Session::put('message','Cập nhật mã khuyến mãi thành công');
        return redirect('all-promotion');
    }
}
