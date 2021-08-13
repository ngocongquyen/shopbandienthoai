<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Http\Requests;
use App\Models\Post;
use App\Models\CatePost;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;

class PostController extends Controller
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
    public function add_post() {
        $this->AuthLogin();
        $cate_post = CatePost::orderBy('cate_post_id','asc')->get();
        return view('admin.post.add_post')->with(compact('cate_post'));
    }

    public function save_post(Request $request) {
        $this->AuthLogin();
        $data = $request->all();

        $post = new Post();
        $post->post_title = $data['post_name'];
        $post->post_slug = $data['post_slug'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->post_status = $data['post_status'];
        $post->cate_post_id = $data['cate_post_id'];
        
        $get_image = $request->file('post_image');
        if($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/post',$new_image);
            $post->post_image = $new_image;
            $post->save();
            Session::put('message','Thêm bài viết thành công');
            return redirect()->back();

        }
        else {
            Session::put('message','Làm ơn thêm hình ảnh');
            return redirect()->back();
        } 
    }
   
    public function all_post() {
        $this->AuthLogin();
        $all_post = Post::with('cate_post')->orderBy('post_id','asc')->paginate(10);
        return view('admin.post.list_post')->with(compact('all_post'));

    }   

    public function edit_post($post_id) {
        $this->AuthLogin();
        $cate_post = CatePost::orderBy('cate_post_id','asc')->get();
        $edit_post = Post::where('post_id',$post_id)->get();
        return view('admin.post.edit_post')->with(compact('edit_post','cate_post'));
    }

    public function update_post(Request $request, $post_id) {
        $this->AuthLogin();
        $data = $request->all();

        $post = Post::find($post_id);
        $post->post_title = $data['post_name'];
        $post->post_slug = $data['post_slug'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
       
        $post->post_status = $data['post_status'];
        $post->cate_post_id = $data['cate_post_id'];
        
        $get_image = $request->file('post_image');
        if($get_image) {
            //Xoa hinh anh cu
            $post_image_old = $post->post_image;
            $path = 'public/uploads/post/'.$post_image_old;
            unlink($path);

            //Them hinh anh moi
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/post',$new_image);
            $post->post_image = $new_image;
           

        }
        $post->save();
            Session::put('message','Cập nhật bài viết thành công');
            return redirect('all-post');
    }

    public function delete_post($post_id) {
        $this->AuthLogin();
        $post = Post::find($post_id);
        $post_image = $post->post_image;
        if($post_image) {
            unlink('public/uploads/post/'.$post_image);
        }
        $post->delete();
        Session::put('message','Xóa bài viết thành công');
        return redirect()->back();
    }

    //Danh muc bai viet
    public function danh_muc_bai_viet(Request $request, $post_slug) {
        $category_post = CatePost::orderby('cate_post_id','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','asc')->get();
        $catepost = CatePost::where('cate_post_slug',$post_slug)->take(1)->get();
        foreach($catepost as $key => $cate) {
           
            $meta_keywords = $cate->cate_post_slug;
            $meta_title = $cate->cate_post_name;
            $cate_id = $cate->cate_post_id;
            $url_canonical = $request->url();
        }
        $post = Post::with('cate_post')->where('post_status',0)->where('cate_post_id',$cate_id)->get();
        return view('pages.baiviet.danhmucbaiviet')->with('brand_product_home',$brand_product)->with('meta_title',$meta_title)
        ->with('category_post',$category_post)->with('post',$post);
    }

    public function bai_viet(Request $request,$post_slug) {
        $category_post = CatePost::orderby('cate_post_id','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','asc')->get();
        $post = Post::with('cate_post')->where('post_status',0)->where('post_slug',$post_slug)->take(1)->get();
        foreach($post as $key => $p) {
           
            $meta_title = $p->post_title;
            $cate_id = $p->cate_post_id;
            $url_canonical = $request->url();
            $post_id = $p->post_id;
        }
        $post_view = Post::where('post_id',$post_id)->first();
        $post_view->post_views = $post_view->post_views +1;
        $post_view->save();
        return view('pages.baiviet.baiviet')
        ->with('category_post',$category_post)->with('post',$post)->with('meta_title',$meta_title);
    }
}
