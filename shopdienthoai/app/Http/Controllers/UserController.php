<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Roles;

use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;

use Auth;
session_start();

class UserController extends Controller
{
    public function index() {
        $admin = Admin::with('roles')->orderBy('admin_id','desc')->paginate(5);
        return view('admin.users.all_users')->with(compact('admin'));
    }

    public function add_users(){
        return view('admin.users.add_users');
    }
    public function assign_roles(Request $request){
        if(Auth::id()==$request->admin_id) {
            return redirect()->back()->with('message','Bạn không được phân quyền chính mình');
        }
        $data = $request->all();
        $user = Admin::where('admin_email',$data['admin_email'])->first();
        $user->roles()->detach();
        if($request['author_role']){
           $user->roles()->attach(Roles::where('name','author')->first());     
        }
        if($request['user_role']){
           $user->roles()->attach(Roles::where('name','user')->first());     
        }
        if($request['admin_role']){
           $user->roles()->attach(Roles::where('name','admin')->first());     
        }
        return redirect()->back()->with('message',"Cấp quyền thành công");
    }
    public function store_users(Request $request){
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        
        $admin_user = Admin::orderby('admin_email','asc')->get();
        if($admin_user) {
            foreach ($admin_user as $key => $value) {
                if($value['admin_email'] == $data['admin_email']) {
                    return Redirect::to('/add-users')->with('message','Tài khoản này đã tồn tại');
                }
            }
        }
        $admin->save();
        $admin->roles()->attach(Roles::where('name','user')->first());
        Session::put('message','Thêm users thành công');
        return Redirect::to('users');
    }

    public function delete_user_roles($admin_id) {
        if(Auth::id()==$admin_id) {
            return redirect()->back()->with('message','Bạn không được xóa chính mình');
        }
        $admin = Admin::find($admin_id);
        if($admin) {
            $admin->roles()->detach();
            $admin->delete();
        }
        return redirect()->back()->with('message','Xóa user thành công');
    }

    public function impersonate($admin_id) {
        $user = Admin::where('admin_id',$admin_id)->first();
        if($user) {
            session()->put('impersonate',$user->admin_id);

        }
        return redirect('/users');
    }

    public function impersonate_destroy() {
        session()->forget('impersonate');
        return redirect('/users');
    }
}
