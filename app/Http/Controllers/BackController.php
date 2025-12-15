<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\UserLevel;
use Illuminate\Support\Facades\Hash;
use  Illuminate\Support\Facades\File;

class BackController extends Controller
{
    public function __construct(){
        @session_start();
    }
    public function home(){
        return view("back.home.home");
    }
    //Staff Profile--------------------------------------------------------------------------------------
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
    //Staff Management--------------------------------------------------------------------------------------

    
    //System management--------------------------------------------------------------------------------------
    public function system(){
        $logo= DB::table('system')->where('Status', 1)->where('Code', 'logo')->first();
        $email= DB::table('system')->where('Status', 1)->where('Code', 'email')->first();
        $phone= DB::table('system')->where('Status', 1)->where('Code', 'phone')->first();
        $address= DB::table('system')->where('Status', 1)->where('Code', 'address')->first();
        $copyright= DB::table('system')->where('Status', 1)->where('Code', 'copyright')->first();
        $favicon= DB::table('system')->where('Status', 1)->where('Code', 'favicon')->first();
        $name= DB::table('system')->where('Status', 1)->where('Code', 'name')->first();

        return view("back.system.system",compact('logo','email','phone','address','copyright','favicon','name'));
    }
    public function system_post(Request $request){
        
        // Cập nhật các trường khác
        DB::table('system')->where('Code', 'email')->update(['Description' => $request->email]);
        DB::table('system')->where('Code', 'phone')->update(['Description' => $request->phone]);
        DB::table('system')->where('Code', 'address')->update(['Description' => $request->address]);
        DB::table('system')->where('Code', 'copyright')->update(['Description' => $request->copyright]);
        DB::table('system')->where('Code', 'name')->update(['Description' => $request->name]);

        // Xử lý logo
        if (!empty($request->file('logo'))) {
            $logo=System::where('Status', '1')->where('Code', 'logo')->first();
            $path='images/logo/'.$logo->Description;
            if(File::exists($path)){
                File::delete($path);    
            }
            $name = time() . '_' .$request->file('logo')->getClientOriginalName();

            $request->file('logo')->move('images/logo', $name);
           $logo->Description = $name;
            $logo->save();
        }

        // Xử lý favicon
        if (!empty($request->file('favicon'))) {
            $favicon=System::where('Status', '1')->where('Code', 'favicon')->first();
            $path='images/favicon/'.$favicon->Description;
            if(File::exists($path)){
                File::delete($path);    
            }
            $name = time() . '_' .$request->file('favicon')->getClientOriginalName();

            $request->file('favicon')->move('images/favicon', $name);
           $favicon->Description = $name;
            $favicon->save();}


        return redirect('admin/system')->with(['flash_level'=>'success','flash_message'=>'Cập nhật cài đặt hệ thống thành công.']);
    }
}
