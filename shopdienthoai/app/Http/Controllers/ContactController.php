<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Http\Requests;
use App\Models\Contact;
use App\Models\CatePost;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;

class ContactController extends Controller
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
    public function lien_he() {
        $category_post = CatePost::orderby('cate_post_id','asc')->get();
        $contact = Contact::where('info_id',1)->get();
        return view('pages.lienhe.contact')->with('category_post',$category_post)->with('contact',$contact);
    }

    public function information() {
        $this->AuthLogin();
        $contact = Contact::where('info_id',1)->get();
        return view('admin.information.add_information')->with(compact('contact'));
    }

    public function save_infor(Request $request) {
        $this->AuthLogin();
        $data = $request->all();
        $contact = new Contact();
        $contact->info_contact = $data['info_contact'];
        $contact->info_map = $data['info_map'];
        $contact->save();
        return redirect()->back()->with('message',"Cập nhật thông tin website thành công");

    }
    public function  update_infor(Request $request, $info_id) {
        $this->AuthLogin();
        $data = $request->all();
        $contact = Contact::find($info_id);
        $contact->info_contact = $data['info_contact'];
        $contact->info_map = $data['info_map'];
        $contact->update();
        return redirect()->back()->with('message',"Cập nhật thông tin website thành công");

    }
   
}
