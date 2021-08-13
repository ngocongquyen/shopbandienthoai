<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use Session;
use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\CatePost;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function show_cart() {
        $cart = count(Session::get('cart'));
        echo $cart;
    }

    public function hover_cart() {
        $cart = count(Session::get('cart'));
        $output='';
        if($cart>0) {
            $output.='
                <h4 class="header__cart-heading">Sản phẩm đã thêm</h4>
                <ul class="header__cart-list-item">';                            
                foreach(Session::get('cart') as $key => $value) {
                    $output.='
                        <li class="header__cart-item">
                            <img src="'.asset('public/uploads/product/'.$value['product_image']).'" alt="" class="header__cart-img">
                            <div class="header__cart-item-info">
                                <div class="header__cart-item-head">
                                    <h5 class="header__cart-item-name">'.$value['product_name'].'</h5>
                                    <div class="header__cart-item-price-wrap">
                                        <span class="header__cart-item-price"></span>
                                        <span class="header__cart-item-mutiply">x</span>
                                        <span class="header__cart-item-quantity">'.$value['product_qty'].'</span>
                                    </div>
                                </div>
                                <div class="header__cart-item-body">
                                    <span class="header__cart-item-desc">Giá: '.number_format($value['product_old_price'],0,",",".").' đ</span>
                                    <a class="header__cart-item-remove" href="'.url("/del-product/".$value["session_id"]).'">Xóa</a>
                                </div>
                            </div>
                        </li>';
                };  
                            
            $output.='</ul>   
                <a href="'.url('/gio-hang').'" class="header__cart-view-cart btn btn--primary">Xem giỏ hàng</a>';
                        
        } else
        {
            $output.='
            <img src="'.asset('public/fontend/images/no-cart.png').'" alt="Không có sản phẩm" class="header__cart-list--no-cart-img">
            <span class="header__cart-list-no-cart-msg">
                Chưa có sản phẩm
            </span>';
        }
        echo $output;
    }

    public function gio_hang() {
        $category_post = CatePost::orderby('cate_post_id','asc')->get();
        return view('pages.cart.show_cart')->with('category_post',$category_post);
    }
    public function add_cart_ajax(Request $request) {
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true) {
            $is_avaiable = 0;
            foreach($cart as $key => $val) {
                if($val['product_id']==$data['cart_product_id']) {
                    $is_avaiable++;
                    $cart[$key] = array(
                    'session_id' => $val['session_id'],
                    'product_name' => $val['product_name'],
                    'product_id' => $val['product_id'],
                    'product_image' => $val['product_image'],
                    'product_qty' => $val['product_qty']+ $data['cart_product_qty'],
                    'product_new_price' => $val['product_new_price'],
                    'product_old_price' => $val['product_old_price'],
                    'product_max_quantity' => $val['product_max_quantity'],
                    );
                    Session::put('cart',$cart);
                }
            }
            if($is_avaiable == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_new_price' => $data['cart_product_new_price'],
                    'product_old_price' => $data['cart_product_old_price'],
                    'product_max_quantity' => $data['cart_product_qty_max'],
                );
                Session::put('cart',$cart);
            }
        } else {
            $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_new_price' => $data['cart_product_new_price'],
                    'product_old_price' => $data['cart_product_old_price'],
                    'product_max_quantity' => $data['cart_product_qty_max'],
            );
        }
        Session::put('cart',$cart);
    }

    public function del_product($session_id) {
        $cart = Session::get('cart');
        if($cart==true) {
            foreach($cart as $key => $val) {
                if($val['session_id']==$session_id) {
                    unset($cart[$key]);
                    Session::forget('coupon');
                }
            }
            Session::put('cart',$cart);
            return redirect()->back();
        }
        else {
            return redirect()->back();
        }
    }

    public function del_all_product() {
        $cart = Session::get('cart');
        if($cart==true) {
            Session::forget('coupon');
            Session::forget('cart');
            return redirect()->back();
        }
    }

    public function update_cart(Request $request) {
        // $data = $request->all();
        // $cart = Session::get('cart');
        // if($cart==true) {
        //     foreach($data['cart_qty'] as $key => $qty) {
        //         foreach($cart as $session => $val) {
        //             if($val['session_id']==$key) {
        //                 $cart[$session]['product_qty'] = $qty;
        //             }
        //         }
        //     }
        //     Session::put('cart',$cart);
        //     return redirect()->back();
        // }
        // else {
        //     return redirect()->back();
        // }

        $data = $request->rowId_cart;
        $qty = $request->cart_quantity;
        $cart = Session::get('cart');
        if($cart==true) {
            foreach($cart as $session => $val) {
                if($val['session_id']==$data) {
                    $cart[$session]['product_qty'] = $qty;
                }
            }
            Session::put('cart',$cart);
            return redirect()->back();
        }
        else {
                return redirect()->back();
        }
        
    }


    //Coupon
    public function check_coupon(Request $request) {
        $data = $request->all();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
        $coupon = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status',1)->where('coupon_date_end','>=',$today)->first();
        if($coupon) {
            $count_coupon = $coupon->count();
            if($count_coupon>0) {
                $coupon_session = Session::get('coupon');
                if($coupon_session==true) {
                    $is_avaiable = 0;
                    if($is_avaiable==0) {
                        $cou[] = array(
                            'coupon_id' => $coupon->coupon_id,
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,
                            'coupon_time' => $coupon->coupon_time,
                            
                        );
                        Session::put('coupon',$cou);
                    }
                }
                else {
                    $cou [] = array(
                        'coupon_id' => $coupon->coupon_id,
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,
                        'coupon_time' => $coupon->coupon_time,
                        
                    );
                    Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('message','Thêm mã giảm giá thành công');
            }
        } else {
            return redirect()->back()->with('error','Mã giảm giá không đúng hoặc đã hết hạn');
        }
    }
}
