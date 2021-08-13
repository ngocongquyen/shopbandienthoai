<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Http\Requests;
use App\Models\Specification;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Http\Request;

class SpecificationController extends Controller
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
    public function add_specification() {
        $this->AuthLogin();
        return view('admin.specification.add_specification');
    }

    public function save_specification(Request $request) {
        $data = $request->all();
        $specification = new Specification();
        $specification->Hedieuhanh = $data['hdh'];
        $specification->Camerasau = $data['camerasau'];
        $specification->Cameratruoc = $data['cameratruoc'];
        $specification->CPU = $data['cpu'];
        $specification->Ram = $data['ram'];
        $specification->Bonhotrong = $data['bonhotrong'];
        $specification->Thenho = $data['thenho'];
        $specification->Thesim = $data['thesim'];
        $specification->Dungluongpin = $data['dungluongpin'];
        $specification->Manhinh = $data['manhinh'];

        $specification->save();
        Session::put('message','Thêm thông số kĩ thuật thành công');
        return Redirect::to('/add-specification');
    }

    public function all_specification() {
        $this->AuthLogin();
        $specification = Specification::orderBy('IDTSSP','ASC')->paginate(10);
        return view('admin.specification.list_specification')->with(compact('specification'));
    }

    public function edit_specification($idtssp) {
        $this->AuthLogin();
        $specification = Specification::find($idtssp);
        return view('admin.specification.edit_specification')->with(compact('specification'));
    }

    public function update_specification($idtssp, Request $request) {
        $data = $request->all();
        $specification = Specification::find($idtssp);

        $specification->Hedieuhanh = $data['hdh'];
        $specification->Camerasau = $data['camerasau'];
        $specification->Cameratruoc = $data['cameratruoc'];
        $specification->CPU = $data['cpu'];
        $specification->Ram = $data['ram'];
        $specification->Bonhotrong = $data['bonhotrong'];
        $specification->Thenho = $data['thenho'];
        $specification->Thesim = $data['thesim'];
        $specification->Dungluongpin = $data['dungluongpin'];
        $specification->Manhinh = $data['manhinh'];

        $specification->save();
        Session::put('message','Cập nhật thông số kĩ thuật thành công');
        return redirect('all-specification');
    }

    public function delete_specification($idtssp) {
        $this->AuthLogin();
        $specification = Specification::find($idtssp);
        $specification->delete();
        Session::put('message','Xóa thông số kĩ thuật thành công');
        return redirect()->back();
    }
}
