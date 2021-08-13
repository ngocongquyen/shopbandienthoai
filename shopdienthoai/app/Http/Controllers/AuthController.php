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
class AuthController extends Controller
{
    public function register_auth(Request $request) { 
        return view('admin.custom_auth.register');
    }

    public function register(Request $request) {
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_password = md5($data['admin_password']);

        $admin_user = Admin::orderby('admin_email','asc')->get();
        if($admin_user) {
            foreach ($admin_user as $key => $value) {
                if($value['admin_email'] == $data['admin_email']) {
                    return Redirect::to('/register-auth')->with('message','Tài khoản này đã tồn tại');
                }
            }
        }
        $admin->save();
        $admin->roles()->attach(Roles::where('name','user')->first());
        return redirect('/login-auth')->with('message', 'Đăng kí thành công. Mời bạn đăng nhập');
    }

    public function login_auth() {
        return view('admin.custom_auth.login_auth');
    }

    public function loout_auth() {
        Auth::logout();
        return redirect('login-auth')->with('message','Đăng xuất thành công');
    }
    public function login(Request $request) {
        $data = $request->all();
        if(Auth::attempt(['admin_email' => $request->admin_email,'admin_password' => $request->admin_password])) {
            return redirect('/dashboard');
        }
        else {
            return redirect('login-auth')->with('message','Email hoặc mật khẩu không đúng');
        }
    }
}
