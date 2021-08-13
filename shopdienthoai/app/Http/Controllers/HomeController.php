<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use App\Models\CatePost;
use Session;
use Mail;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request) {
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','asc')->get();
        $category_post = CatePost::orderby('cate_post_id','asc')->get();
        if(isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            if($sort_by=='giam_dan') {
                $all_product = DB::table('tbl_product')
                ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
                ->orderby('tbl_product.product_price','desc')->paginate(8)->appends(request()->query());
                $all_product_hightlight = DB::table('tbl_product')
                ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
                ->where('promotion_type','=',0)
                ->orderby('tbl_product.product_price','desc')->paginate(8)->appends(request()->query());
            }
            elseif($sort_by=='tang_dan') {
                $all_product = DB::table('tbl_product')
                ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
                ->orderby('tbl_product.product_price','asc')->paginate(8)->appends(request()->query());
                $all_product_hightlight = DB::table('tbl_product')
                ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
                ->where('promotion_type','=',0)
                ->orderby('tbl_product.product_price','asc')->paginate(8)->appends(request()->query());
            }
            elseif($sort_by=='kytu_az') {
                $all_product = DB::table('tbl_product')
                ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
                ->orderby('tbl_product.product_name','asc')->paginate(8)->appends(request()->query());
                $all_product_hightlight = DB::table('tbl_product')
                ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
                ->where('promotion_type','=',0)
                ->orderby('tbl_product.product_name','asc')->paginate(8)->appends(request()->query());
            }
            elseif($sort_by=='kytu_za') {
                $all_product = DB::table('tbl_product')
                ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
                ->orderby('tbl_product.product_name','desc')->paginate(8)->appends(request()->query());
                $all_product_hightlight = DB::table('tbl_product')
                ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
                ->where('promotion_type','=',0)
                ->orderby('tbl_product.product_name','desc')->paginate(8)->appends(request()->query());
            }
        }
        else {
            $all_product = DB::table('tbl_product')
            ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
            ->where('promotion_type','!=',0)
            ->orderby('tbl_product.product_id','asc')->paginate(8);
            $all_product_hightlight = DB::table('tbl_product')
            ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
            ->where('promotion_type','=',0)
            ->orderby('tbl_product.product_id','desc')->paginate(8);
        }
        return view('pages.home')->with('brand_product_home',$brand_product)->with('all_product',$all_product)->with('all_product_hightlight',$all_product_hightlight)
        ->with('category_post',$category_post);
    }

    public function product_selling() {
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','asc')->get();
        $category_post = CatePost::orderby('cate_post_id','asc')->get();
        
        if(isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            if($sort_by=='giam_dan') {
                $product_selling = DB::table('tbl_product')
                ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
                ->orderby('tbl_product.product_price','desc')->paginate(12)->appends(request()->query());
            }
            elseif($sort_by=='tang_dan') {
                $product_selling = DB::table('tbl_product')
                ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
                ->orderby('tbl_product.product_price','asc')->paginate(12)->appends(request()->query());
            }
            elseif($sort_by=='kytu_az') {
                $product_selling = DB::table('tbl_product')
                ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
                ->orderby('tbl_product.product_name','asc')->paginate(12)->appends(request()->query());
            }
            elseif($sort_by=='kytu_za') {
                $product_selling = DB::table('tbl_product')
                ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
                ->orderby('tbl_product.product_name','desc')->paginate(12)->appends(request()->query());
            }
        }
        else {
            $product_selling = DB::table('tbl_product')
            ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
            ->orderby('tbl_product.product_sold','desc')->paginate(12);
        }
        return view('pages.product.product_sell')->with('brand_product_home',$brand_product)->with('product_selling',$product_selling)->with('category_post',$category_post);
    }

    public function product_latest() {
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','asc')->get();
        
        $category_post = CatePost::orderby('cate_post_id','asc')->get();
        if(isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            if($sort_by=='giam_dan') {
                $product_laest = DB::table('tbl_product')
                ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
                ->orderby('tbl_product.product_price','desc')->paginate(12)->appends(request()->query());
            }
            elseif($sort_by=='tang_dan') {
                $product_laest = DB::table('tbl_product')
                ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
                ->orderby('tbl_product.product_price','asc')->paginate(12)->appends(request()->query());
            }
            elseif($sort_by=='kytu_az') {
                $product_laest = DB::table('tbl_product')
                ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
                ->orderby('tbl_product.product_name','asc')->paginate(12)->appends(request()->query());
            }
            elseif($sort_by=='kytu_za') {
                $product_laest = DB::table('tbl_product')
                ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
                ->orderby('tbl_product.product_name','desc')->paginate(12)->appends(request()->query());
            }
        }
        else {
            $product_laest = DB::table('tbl_product')
            ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
            ->orderby('tbl_product.product_id','desc')->paginate(12);
        }
        return view('pages.product.product_latest')->with('brand_product_home',$brand_product)->with('product_laest',$product_laest)->with('category_post',$category_post);
    }

    public function Autocomplete(Request $request) {
        $data = $request->all();
        if($data['query']) {
            $product=DB::table('tbl_product')->where('product_price', '<=',$data['query'])->orwhere('product_name', 'LIKE','%'.$data['query'].'%')->get();
            $output = '<span class="header__search-history-label">Lịch sử tìm kiếm</span> 
                        <ul class="header__search-history-list">';
            foreach($product as $key => $val) {
                $output.=
                '<li class="header_li"><a href="#" class="header__search-history-item">'.$val->product_name.'</a></li>';
            }
            $output.='</ul>';
            echo $output;
        }
    }

    public function search(Request $request) {
        $keywords = $request->keywords_submit;

        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','asc')->get();
        $category_post = CatePost::orderby('cate_post_id','asc')->get();

        // if(isset($_GET['sort_by'])) {
        //     $sort_by = $_GET['sort_by'];
        //     // dd($sort_by);
        //     if($sort_by=='giam_dan') {
        //         $search_product = DB::table('tbl_product')->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
        //         ->where('product_name','LIKE','%'.$keywords.'%')->paginate(12)->appends(request()->query());
        //     }
        //     elseif($sort_by=='tang_dan') {
        //         $search_product = DB::table('tbl_product')->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
        //         ->where('product_name','LIKE','%'.$keywords.'%')->paginate(12)->appends(request()->query());
        //     }
        //     elseif($sort_by=='kytu_az') {
        //         $search_product = DB::table('tbl_product')->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
        //         ->where('product_name','LIKE','%'.$keywords.'%')->paginate(12)->appends(request()->query());
        //     }
        //     elseif($sort_by=='kytu_za') {
        //         $search_product = DB::table('tbl_product')->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
        //         ->where('product_name','LIKE','%'.$keywords.'%')->paginate(12)->appends(request()->query());
        //     }
        // }
        // else {
            $search_product = DB::table('tbl_product')->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
            ->where('product_name','LIKE','%'.$keywords.'%')->orwhere('product_price','<=',$keywords)->orderby('product_price','desc')->paginate(12)->appends(request()->query());
        //}
        return view('pages.product.search')->with('brand_product_home',$brand_product)
        ->with('search_product',$search_product)->with('category_post',$category_post)->with('keyword',$keywords);
        
    }


}
