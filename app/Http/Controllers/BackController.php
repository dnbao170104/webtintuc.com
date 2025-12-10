<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\UserLevel;

class BackController extends Controller
{
    public function __construct(){
        @session_start();
    }
    public function home(){
        return view("back.home.home");
    }
    public function staff_profile(){
        return view("back.staff.profile");
    }
    public function staff_profile_post(Request $request) {
        // Kiểm tra validate dữ liệu đầu vào
        if ($request->fullname == '' || $request->email == '' || $request->phone == '') {
            return redirect('admin/staff/profile')->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền đầy đủ các trường bắt buộc']);
        }

        // Lấy user hiện tại
       $user = User::find($request->id);
        $user->fullname = $request->fullname;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->phone = $request->phone;

        // Kiểm tra nếu password có được nhập thì cập nhật
        if (isset($request->password) && $request->password != '') {
            $user->password = bcrypt($request->password);
        }
        $flag = $user->save();

        if ($flag == true) {
            return redirect('admin/staff/profile')->with(['flash_level' => 'success', 'flash_message' => 'Cập nhật tài khoản thành công.']);
        } else {
            return redirect('admin/staff/profile')->with(['flash_level' => 'danger', 'flash_message' => 'Thêm tài khoản không thành công. Vui lòng thử lại!']);
        }
    }
    public function staff(){
    $User = DB::table('users as a')
        ->join('users_level as b', 'a.level', '=', 'b.id')
        // Thêm a.id và đổi tên b.name thành level_name cho dễ gọi
        ->selectRaw('a.id, a.fullname, a.address, a.email, a.phone, b.name as level_name') 
        ->get();
    
    return view('back.staff.list', compact('User'));
}
    public function staff_list(){
        $User = User::all();
        return view("back.staff.list", compact('User'));
    }
    public function staff_add(){
        $UserLevel = DB::table('users_level')->where('status', 1)->get();
        return view("back.staff.add", compact('UserLevel'));
    }
    public function staff_add_post(Request $request){
        // Kiểm tra validate dữ liệu đầu vào
        if($request->fullname == '' || $request->email == '' || $request->phone == '' || $request->password == ''){
            return redirect('admin/staff/add')->with(['flash_level'=>'danger','flash_message'=>'Vui lòng điền đầy đủ các trường bắt buộc']);
        }
        $user = new User();
        $user->status = 1;
        $user->username = $request->username;
        $user->fullname = $request->fullname;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->level = $request->level;
        $flag = $user->save();
        if($flag == true){
            return redirect('admin/staff/add')->with(['flash_level'=>'success','flash_message'=>'Thêm tài khoản thành công.']);
        }else{
            return redirect('admin/staff/add')->with(['flash_level'=>'danger','flash_message'=>'Thêm tài khoản không thành công. Vui lòng thử lại!']);
        }
    }
   public function staff_delete($id) 
{
    // Thực hiện xóa
    $flag = DB::table('users')->where('id', $id)->delete();

    if ($flag) {
        // SỬA: Redirect về trang danh sách (admin.staff.list)
        return redirect()->route('admin.staff.list')
                         ->with(['flash_level'=>'success', 'flash_message'=>'Xóa tài khoản thành công.']);
    } else {
        // SỬA: Redirect về trang danh sách nếu lỗi
        return redirect()->route('admin.staff.list')
                         ->with(['flash_level'=>'danger', 'flash_message'=>'Xóa tài khoản không thành công. Vui lòng thử lại!']);
    }
}
    function staff_edit(Request $request, $id){
        $User = User::find($id);
        $UserLevel = DB::table('users_level')->where('status', 1)->get();
        return view('back.staff.edit', compact('User', 'UserLevel'));
    }
    function staff_edit_post(Request $request, $id){
        // Kiểm tra validate dữ liệu đầu vào
        if($request->fullname == '' || $request->email == '' || $request->phone == ''){
            return redirect('admin/staff/edit/'.$id)->with(['flash_level'=>'danger','flash_message'=>'Vui lòng điền đầy đủ các trường bắt buộc']);
        }
        $user = User::find($id);
        $user->status = $request->status;
        $user->fullname = $request->fullname;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->phone = $request->phone;
        // Kiểm tra nếu password có được nhập thì cập nhật
        if(isset($request->password) && $request->password != ''){
            $user->password = bcrypt($request->password);
        }
        $user->level = $request->level;
        $flag = $user->save();
        if($flag == true){
            return redirect('admin/staff/edit/'.$id)->with(['flash_level'=>'success','flash_message'=>'Cập nhật tài khoản thành công.']);
        }else{
            return redirect('admin/staff/edit/'.$id)->with(['flash_level'=>'danger','flash_message'=>'Cập nhật tài khoản không thành công. Vui lòng thử lại!']);
        }
    }
    
}
