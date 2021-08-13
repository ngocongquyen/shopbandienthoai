<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Http\Requests;
use App\Models\Rating;
use App\Models\Product;
use App\Models\CatePost;
use App\Models\Comment;
use Session;
use App\Models\Gallery;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;

class ProductController extends Controller
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
    public function add_product() {
        $this->AuthLogin();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','asc')->get();
        $specification_product = DB::table('tbl_specifications')->orderby('IDTSSP','asc')->get();
        $promotion_product = DB::table('tbl_promotion')->orderby('promotion_id','asc')->get();
        return view('admin.add_product')->with('brand_product', $brand_product)
        ->with('specification_product', $specification_product)->with('promotion_product', $promotion_product);
    }
    public function all_product() {
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
        ->orderby('tbl_product.product_id','asc')
        ->paginate(12);
        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product',$manager_product);

    }   
    public function save_product(Request $request) {
        $this->AuthLogin();
        $data = array();    
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
      //  $data['product_images'] = $request->product_image;
        $data['product_content'] = $request->product_content;
        $data['brand_id'] = $request->product_brand;
        $data['product_quantity'] = $request->product_quantity;
        $data['promotion_id'] = $request->product_promotion;
        $data['IDTSSP'] = $request->product_specification;
        $data['product_status'] = $request->product_status;
        $data['created_at'] = date('Y/m/d');

        
        $get_image = $request->file('product_image');
        if($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_images'] = $new_image;
            $data['product_sold'] = 0;
            $data['product_total_rating'] = 0;
            $data['product_total_number'] = 0;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('/all-product');

        }
        $data['product_total_rating'] = 0;
        $data['product_total_number'] = 0;
        $data['product_sold'] = 0;
        $data['product_images'] = '';
        DB::table('tbl_product')->insert($data);
        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('/all-product');
    }   

    public function unactive_product($product_id) {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Không kích hoạt sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    public function active_product($product_id) {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Kích hoạt sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    public function edit_product($product_id) {
        $this->AuthLogin();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','asc')->get();
        $specification_product = DB::table('tbl_specifications')->orderby('IDTSSP','asc')->get();
        $promotion_product = DB::table('tbl_promotion')->orderby('promotion_id','asc')->get();
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)
        ->with('brand_product',$brand_product)
        ->with('specification_product', $specification_product)->with('promotion_product', $promotion_product);
        return view('admin_layout')->with('admin.edit_product',$manager_product);
    }

    public function update_product($product_id, Request $request) {
        $this->AuthLogin();
        $data = array();    
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
      //  $data['product_images'] = $request->product_image;
        $data['product_content'] = $request->product_content;
        $data['brand_id'] = $request->product_brand;
        $data['promotion_id'] = $request->product_promotion;
        $data['IDTSSP'] = $request->product_specification;
        $data['product_status'] = $request->product_status;
        
        $get_image = $request->file('product_image');
        if($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_images'] = $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập nhật sản phẩm thành công');
            return Redirect::to('/all-product');
        }   
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    public function delete_product($product_id) {
        $this->AuthLogin();
        $product = Product::find($product_id);
        $product_image = $product->product_images;
        if($product_image) {
            unlink('public/uploads/product/'.$product_image);
        }
        $product->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return redirect()->back();

    }
    //End Amin page

    //chi tiet san pham
    public function details_product($product_id) {
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','asc')->get();
        $category_post = CatePost::orderby('cate_post_id','asc')->get();
        $details_product = DB::table('tbl_product')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
        ->join('tbl_specifications','tbl_specifications.IDTSSP','=','tbl_product.IDTSSP')
        ->where('tbl_product.product_id',$product_id)->get();
        
        $ratings = Rating::with('customer')->where('product_id',$product_id)->orderby('rating_id','desc')->paginate(10);
        $ratingsDasboard = Rating::groupby('rating_number')->where('product_id',$product_id)->select(\DB::raw('count(rating_number) as count_number'),\DB::raw('sum(rating_number) as total'))
        ->addSelect('rating_number')->get()->toArray();
        $ratingDefault = $this->mapRatingDefault();
        foreach($ratingsDasboard as $key => $item) {
            $ratingDefault[$item['rating_number']] = $item;
        }
        
        foreach($details_product as $key => $value){
            $brand_id = $value->brand_id;
            $product_id = $value->product_id;
        }
        $gallery = Gallery::where('product_id',$product_id)->get();
        $product_view = Product::where('product_id',$product_id)->first();
        $product_view->product_views = $product_view->product_views +1;
        $product_view->save();
        $product_v =Product::where('product_id',$product_id)->first();

        $top_product = DB::table('tbl_product')
        ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')->orderby('product_sold','desc')->limit(5)->get();

        $related_product = DB::table('tbl_product')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
        ->join('tbl_specifications','tbl_specifications.IDTSSP','=','tbl_product.IDTSSP')
        ->where('tbl_brand.brand_id',$brand_id)
        ->whereNotIn('tbl_product.product_id',[$product_id])->get();
        

        return view('pages.product.detail_product')
        ->with('brand_product',$brand_product)
        ->with('detail_product',$details_product)
        ->with('relate_product',$related_product)
        ->with('gallery',$gallery)
        ->with('ratings',$ratings)
        ->with('ratingDefault',$ratingDefault)
        ->with('top_product',$top_product)
        ->with('category_post',$category_post)
        ->with('product_v',$product_v);
    }

    private function mapRatingDefault() {
        $ratingDefault = [];
        for($i=1;$i<=5;$i++) {
            $ratingDefault[$i] = [
                "count_number" => 0,
                "total" => 0,
                "rating_number" =>0
            ];
        } 
        return $ratingDefault;
    }

    public function save_rating(Request $request, $product_id) {
        $data = $request->all();
        if(!Session::get('customer_id')) {
            echo('error');
        } 
        else {
            $rating = new Rating();
            $rating->product_id=$product_id;
            $rating->rating_number = $data['number'];
            $rating->rating_content = $data['content'];
            $rating->customer_id = Session::get('customer_id');

            $rating->save();
            $product = Product::find($product_id);
            $product->product_total_number += $data['number'];
            $product->product_total_rating +=1;
            
            $product->save();

            echo ('done');
        }
        
    }

    public function product_view(Request $request) {
        $data = $request->all();
        echo($data['id']);
    }

    public function load_comment(Request $request) {
        $product_id = $request->product_id;
        $customer_name = $request->customer_name;
        $output='';

        $comment = Comment::where('comment_product_id',$product_id)->where('comment_parent_comment','=',NULL)->orderby('comment_id','desc')->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','!=',NULL)->get();
        foreach($comment as $key => $comm) {
            $output.='
                    <div class="product_comment-wrapper">
                    <img src="'.url('public/fontend/images/20141114-082404-batman1_520x603.jpg').'" alt="" class="product_comment-img">
                    <div class="product_comment-box">
                        <div class="product_comment-boxall">
                            <h3 class="product_comment-box__name">'.$comm->comment_name.'</h3>   
                            <span>'.$comm->comment_date.'</span>
                        </div>
                                                    
                        <span class="product_comment-box__desc">'.$comm->comment.'</span>
                    </div>
                </div>
            ';
            foreach($comment_rep as $key =>$rep_comment){
                if($rep_comment->comment_parent_comment == $comm->comment_id) {
                    $output.='
                        <div class="product_comment-content">
                            <img src="'.url('public/fontend/images/unnamed.jpg').'" alt="" class="product_comment-img">
                            <div class="product_comment-content__wrapper">
                                <div class="product_comment-boxall">
                                    <h3 class="product_comment-content__label">'.$rep_comment->comment_name.'</h3>
                                    <span class="badge badge-primary">Quản trị viên</span>
                                </div>
                                
                                <span class="product_comment-content__desc">'.$rep_comment->comment.'</span>
                            </div>
                        </div>';
                }
            }
            
        }
        echo $output;
    }

    public function send_comment(Request $request) {
        $product_id = $request->product_id;
        $customer_name = $request->customer_name;
        $comment_content = $request->comment_content;
        $comment = new Comment();
        $comment->comment_product_id =  $product_id;
        $comment->comment_name =  $customer_name ;
        $comment->comment =  $comment_content;
        $comment->save();

    }

    public function list_comment() {
        $this->AuthLogin();
        $comment = Comment::with('product')->where('comment_parent_comment','=',NULL)->orderby('comment_id','desc')->paginate(20);
        $comment_rep = Comment::with('product')->where('comment_parent_comment','!=',NULL)->paginate(20);
        return view('admin.comment.list_comment')->with(compact('comment','comment_rep'));
    }

    public function reply_comment(Request $request) {
        $this->AuthLogin();
        $product_id = $request->comment_product_id;
        $comment_content = $request->comment;
        $comment_id = $request->comment_id;
        $comment = new Comment();
        
        $comment->comment_product_id = $product_id;
        $comment->comment =  $comment_content;
        $comment->comment_parent_comment = $comment_id;
        if(Session::get('login_normal')) {
            $comment->comment_name = Session::get('admin_name');
        } else {
            $comment->comment_name = Auth::user()->admin_name;
        }
        $comment->save();
    }

    public function delete_comment($comment_id) {
        $this->AuthLogin();
        $comment_id = Comment::where('comment_id', $comment_id)->first();  
      
        $comment_id->delete();
        Session::put('message','Xóa bình luận thành công');
        return Redirect::to('/comment');
    }
}
