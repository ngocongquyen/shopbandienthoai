<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Http\Requests;
use App\Models\CatePost;
use App\Models\Brand;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;

class BrandProduct extends Controller
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
    public function add_brand_product() {
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }
    public function all_brand_product() {
        $this->AuthLogin();
        $all_brand_product = DB::table('tbl_brand')->get();
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product',$manager_brand_product);

    }   
    public function save_brand_product(Request $request) {
        $this->AuthLogin();
        $data = $request->all();

        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->brand_desc = $data['brand_product_desc'];
        
        $get_image = $request->file('brand_slide');
        if($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/brand',$new_image);
            $brand->brand_images = $new_image;
            $brand_name = Brand::orderby('brand_name','asc')->get();
            if($brand_name) {
            foreach ($brand_name as $key => $value) {
                if($value['brand_name'] == $data['brand_product_name']) {
                    return Redirect::to('/add-brand-product')->with('message','Tên thương hiệu đã tồn tại');
                }
            }
        }
            $brand->save();
            Session::put('message','Thêm thương hiệu sản phẩm thành công');
            return Redirect::to('/add-brand-product');

        }
        else {
            Session::put('message','Làm ơn thêm hình ảnh thương hiệu');
            return Redirect::to('/add-brand-product');
        } 
    }   

    public function unactive_brand_product($brand_product_id) {
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('message','Không kích hoạt danh mục thành công');
        return Redirect::to('/all-brand-product');
    }

    public function active_brand_product($brand_product_id) {
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
        Session::put('message','Kích hoạt danh mục thành công');
        return Redirect::to('/all-brand-product');
    }

    public function edit_brand_product($brand_product_id) {
        $this->AuthLogin();
        $edit_brand_product = DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product',$manager_brand_product);
    }

    public function update_brand_product($brand_product_id, Request $request) {
        $this->AuthLogin();
        $data = $request->all();
        $brand = Brand::find($brand_product_id);   
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
       
        $get_image = $request->file('brand_slide');
        if($get_image) {
            $brand_image_old = $brand->brand_images;
            $path = 'public/uploads/brand/'.$brand_image_old;
            unlink($path);
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/brand',$new_image);
            $brand->brand_images = $new_image;

        }
        $brand_name = Brand::whereNotIn('brand_id',[$brand_product_id])->orderby('brand_name','asc')->get(); 
        if($brand_name) {
            foreach ($brand_name as $key => $value) {
                if($value['brand_name'] == $data['brand_product_name']) {
                    return Redirect::to('/all-brand-product')->with('message','Thương hiệu này đã tồn tại');
                }
            }
        }
        $brand->save();
        Session::put('message','Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }

    public function delete_brand_product($brand_product_id) {
        $this->AuthLogin();
        $brand = Brand::find($brand_product_id);
        $brand_image=$brand->brand_images;
        if($brand_image) {
            unlink('public/uploads/brand/'.$brand_image);
        }
        $brand->delete();
        Session::put('message','Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }

    //End Admin

    // Show brand trang home
    public function show_brand_home($brand_id) {
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','asc')->get();
        $category_post = CatePost::orderby('cate_post_id','asc')->get();
        // $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
        // ->join('tbl_specifications','tbl_specifications.IDTSSP','=','tbl_product.IDTSSP')
        // ->where('tbl_product.brand_id',$brand_id)->get();

        if(isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            if($sort_by=='giam_dan') {
                $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
                ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
                ->join('tbl_specifications','tbl_specifications.IDTSSP','=','tbl_product.IDTSSP')
                ->where('tbl_product.brand_id',$brand_id)->orderby('tbl_product.product_price','desc')->paginate(8)->appends(request()->query());
            }
            elseif($sort_by=='tang_dan') {
                $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
                ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
                ->join('tbl_specifications','tbl_specifications.IDTSSP','=','tbl_product.IDTSSP')
                ->where('tbl_product.brand_id',$brand_id)->orderby('tbl_product.product_price','asc')->paginate(8)->appends(request()->query());
            }
            elseif($sort_by=='kytu_az') {
                $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
                ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
                ->join('tbl_specifications','tbl_specifications.IDTSSP','=','tbl_product.IDTSSP')
                ->where('tbl_product.brand_id',$brand_id)->orderby('tbl_product.product_name','desc')->paginate(8)->appends(request()->query());
            }
            elseif($sort_by=='kytu_za') {
                $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
                ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
                ->join('tbl_specifications','tbl_specifications.IDTSSP','=','tbl_product.IDTSSP')
                ->where('tbl_product.brand_id',$brand_id)->orderby('tbl_product.product_name','asc')->paginate(8)->appends(request()->query());
            }
        }
        else {
            $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
                ->join('tbl_promotion','tbl_promotion.promotion_id','=','tbl_product.promotion_id')
                ->join('tbl_specifications','tbl_specifications.IDTSSP','=','tbl_product.IDTSSP')
                ->where('tbl_product.brand_id',$brand_id)->orderby('tbl_product.product_id','asc')->paginate(8);
        }
        return view('/pages.brand.show_brand')->with('brand',$brand_id)
        ->with('brand_by_id',$brand_by_id)->with('brand_product',$brand_product)->with('category_post',$category_post);
    }
}
