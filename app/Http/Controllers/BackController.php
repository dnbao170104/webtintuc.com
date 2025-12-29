<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\UserLevel;
use Illuminate\Support\Facades\Hash;
use  Illuminate\Support\Facades\File;
use App\Models\Page;
use App\Models\Social;
use App\Models\Newsletter;
use App\Models\Contact;
use App\Models\NewsCategory;
use App\Models\News;
use App\Models\Slider;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;



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
    //Page Management--------------------------------------------------------------------------------------
    public function page_list(){
        $Pages = DB::table('page')->get();
        return view("back.pages.list", compact('Pages'));
        
    }
    public function page_edit(Request $request, $id){
        $Pages = DB::table('page')->where('RowID', $id)->first();
        return view("back.pages.edit", compact('Pages'));
    }
    public function page_edit_post(Request $request, $id){
        // Kiểm tra validate dữ liệu đầu vào
        if($request->Name == '' ){
            return redirect('admin/pages/edit/'.$id)->with(['flash_level'=>'danger','flash_message'=>'Vui lòng điền đầy đủ các trường bắt buộc']);
        }
        $page = Page::find($id);
        $page->Name = $request->Name;
        $page->Font = $request->Font;
        $page->Sort = $request->Sort;
        $page->MetaTitle = $request->MetaTitle;
        $page->MetaKeyword = $request->MetaKeyword;
        $page->MetaDescription = $request->MetaDescription;
        $page->Description = $request->Description;
        $flag = $page->save();
        if($flag == true){
            return redirect('admin/pages/edit/'.$id)->with(['flash_level'=>'success','flash_message'=>'Cập nhật trang thành công.']);
        }else{
            return redirect('admin/pages/edit/'.$id)->with(['flash_level'=>'danger','flash_message'=>'Cập nhật trang không thành công. Vui lòng thử lại!']);
        }
    }
    //social management--------------------------------------------------------------------------------------
    public function social_list(){
        $Socials = DB::table('social')->get();
        return view("back.social.list", compact('Socials'));
    }
    public function social_edit(Request $request, $id){
        $Social = DB::table('social')->where('RowID', $id)->first();
        return view("back.social.edit", compact('Social'));
    }
    public function social_edit_post(Request $request, $id){
        // Kiểm tra validate dữ liệu đầu vào
        if($request->Font == '' ){
            return redirect('admin/social/edit/'.$id)->with(['flash_level'=>'danger','flash_message'=>'Vui lòng điền đầy đủ các trường bắt buộc']);
        }
        $social = Social::find($id);    
        $social->Name = $request->Name;
        $social->Font = $request->Font;
        $social->Sort = $request->Sort;
        $flag = $social->save();
        if($flag == true){
            return redirect('admin/social/edit/'.$id)->with(['flash_level'=>'success','flash_message'=>'Cập nhật mạng xã hội thành công.']);
        }else{
            return redirect('admin/social/edit/'.$id)->with(['flash_level'=>'danger','flash_message'=>'Cập nhật mạng xã hội không thành công. Vui lòng thử lại!']);
        }   
    }
    public function newsletter_list(){
        $Newsletter = DB::table('newsletter')->get();
        return view("back.newsletter.list", compact('Newsletter'));
    }
    public function newsletter_edit(Request $request, $id){
        $Newsletter = DB::table('newsletter')->where('RowID', $id)->first();
        return view("back.newsletter.edit", compact('Newsletter'));
    }
    public function newsletter_edit_post(Request $request, $id){
        // Kiểm tra validate dữ liệu đầu vào
        if($request->Email == '' ){
            return redirect('admin/newsletter/edit/'.$id)->with(['flash_level'=>'danger','flash_message'=>'Vui lòng điền đầy đủ các trường bắt buộc']);
        }
        $newsletter = Newsletter::find($id);    
        $newsletter->Email = $request->Email;
        $newsletter->IsViews = $request->Status;
        $flag = $newsletter->save();
        if($flag == true){
            return redirect('admin/newsletter/edit/'.$id)->with(['flash_level'=>'success','flash_message'=>'Cập nhật khuyến mãi thành công.']);
        }else{
            return redirect('admin/newsletter/edit/'.$id)->with(['flash_level'=>'danger','flash_message'=>'Cập nhật khuyến mãi không thành công. Vui lòng thử lại!']);
        }  
    }
    public function newsletter_delete($id) 
{
    $Newsletter = Newsletter::find($id);
    $flag = $Newsletter->delete();
    // Thực hiện xóa
    if($flag == true){
            return redirect('admin/newsletter/list')->with(['flash_level'=>'success','flash_message'=>'Xóa email thành công.']);
        }else{
            return redirect('admin/newsletter/list')->with(['flash_level'=>'danger','flash_message'=>'Xóa email không thành công. Vui lòng thử lại!']);
        }  
    }
    //contact management--------------------------------------------------------------------------------------
    public function contact_list(){
        $Contact = DB::table('contact')->get();
        return view("back.contact.list", compact('Contact'));   
    }
    public function contact_edit(Request $request, $id){
        $Contact = DB::table('contact')->where('RowID', $id)->first();
        return view("back.contact.edit", compact('Contact'));
    }
    public function contact_edit_post(Request $request, $id){
        // Kiểm tra validate dữ liệu đầu vào
        if($request->Name == '' || $request->Email == '' || $request->Phone == '' ){
            return redirect('admin/contact/edit/'.$id)->with(['flash_level'=>'danger','flash_message'=>'Vui lòng điền đầy đủ các trường bắt buộc']);
        }
        $contact = Contact::find($id);    
        $contact->Name = $request->Name;
        $contact->Email = $request->Email;
        $contact->Phone = $request->Phone;
        $contact->IsViews = $request->IsViews;
        $flag = $contact->save();
        if($flag == true){
            return redirect('admin/contact/edit/'.$id)->with(['flash_level'=>'success','flash_message'=>'Cập nhật liên hệ thành công.']);
        }else{
            return redirect('admin/contact/edit/'.$id)->with(['flash_level'=>'danger','flash_message'=>'Cập nhật liên hệ không thành công. Vui lòng thử lại!']);
        }   }
    public function contact_delete($id)
{
    $Contact = Contact::find($id);
    $flag = $Contact->delete();
    // Thực hiện xóa
    if($flag == true){
            return redirect('admin/contact/list')->with(['flash_level'=>'success','flash_message'=>'Xóa liên hệ thành công.']);
        }else{
            return redirect('admin/contact/list')->with(['flash_level'=>'danger','flash_message'=>'Xóa liên hệ không thành công. Vui lòng thử lại!']);      
        }
    }
    public function news_cat_list(){
        $NewsCategory = DB::table('news_cat')->where('Status', 1)->get();
        return view("back.news.cat_list", compact('NewsCategory'));
    }
    public function news_cat_edit(Request $request, $id){
        $NewsCategory = DB::table('news_cat')->where('RowID', $id)->first();
        return view("back.news.cat_edit", compact('NewsCategory'));
    }
    public function news_cat_edit_post(Request $request, $id){
        // Kiểm tra validate dữ liệu đầu vào
        if($request->Name == '' ){
            return redirect('admin/news_cat/edit/'.$id)->with(['flash_level'=>'danger','flash_message'=>'Vui lòng điền đầy đủ các trường bắt buộc']);
        }   
        $news_cat = NewsCategory::find($id);    
        $news_cat->Name = $request->Name;
        $news_cat->Status = $request->Status;
        $flag = $news_cat->save();
        if($flag == true){
            return redirect('admin/news_cat/cat_edit/'.$id)->with(['flash_level'=>'success','flash_message'=>'Cập nhật danh mục tin tức thành công.']);
        }else{
            return redirect('admin/news_cat/cat_edit/'.$id)->with(['flash_level'=>'danger','flash_message'=>'Cập nhật danh mục tin tức không thành công. Vui lòng thử lại!']);      
        }
    }
    public function news_cat_delete($id)
{
    $NewsCategory = NewsCategory::find($id);
    $flag = $NewsCategory->delete();
    // Thực hiện xóa
    if($flag == true){
            return redirect('admin/news_cat/list')->with(['flash_level'=>'success','flash_message'=>'Xóa danh mục tin tức thành công.']);
        }else{
            return redirect('admin/news_cat/list')->with(['flash_level'=>'danger','flash_message'=>'Xóa danh mục tin tức không thành công. Vui lòng thử lại!']);
        }
    }
    //news management--------------------------------------------------------------------------------------
   public function news_list(){
        $News = DB::table('news as a')->join('news_cat as b', 'a.RowIDCat', '=', 'b.RowID')
        ->selectRaw('a.*, b.Name as CatName')
        ->where('a.Status', 1)
        ->orderBy('a.RowID', 'desc')->get();
        return view("back.news.list", compact('News'));
    }
    public function news_getAdd(){
        $NewsCategory = DB::table('news_cat')->get();
        return view("back.news.add", compact('NewsCategory'));
    }
    public function news_postAdd(Request $request){
        // Kiểm tra validate dữ liệu đầu vào
        if($request->Name == '' || $request->Description == '' ){
            return redirect('admin/news/add')->with(['flash_level'=>'danger','flash_message'=>'Vui lòng điền đầy đủ các trường bắt buộc']);
        }   
        $news = new News();    
        $news->Name = $request->Name;
        $news->RowIDCat = $request->RowIDCat;
        $news->Status = $request->Status;
        if ($request->has('Alias') && !empty($request->Alias)) {
    $news->Alias = $request->Alias;
} else {
    // Nếu Alias rỗng, tự động tạo từ Name
    $news->Alias = Str::slug($request->Name);
}
        $news->MetaTitle = $request->MetaTitle;
        $news->MetaKeyword = $request->MetaKeyword; 
        $news->MetaDescription = $request->MetaDescription;
        $news->SmallDescription = $request->SmallDescription;
        $news->Description = $request->Description;
        if($request->hasFile('images')){
    $file = $request->file('images');
    $random_digit = rand(000000000, 999999999);
    $name = $random_digit.'-'.$file->getClientOriginalName();
    $duoi = strtolower($file->getClientOriginalExtension());

    
    if($duoi != 'png' && $duoi != 'jpg' && $duoi != 'jpeg' && $duoi != 'svg'){
        return back()->with(['flash_level' => 'danger', 'flash_message' => 'Định dạng ảnh không hợp lệ (chỉ hỗ trợ png, jpg, jpeg, svg)']);
    }

    
    $file->move('images/news', $name);

    
    $img = Image::make('images/news/'.$name);

   
    $filePath = "images/news/".date('Ymd');
    if (!file_exists($filePath)) {
        mkdir("images/news/".date('Ymd'), 0777, true);
    }

    
    $img->fit(208, 141);
    
    // Lưu ảnh vào folder ngày
    $img->save('images/news/'.date('Ymd').'/'.$name);

    // Xóa ảnh gốc vừa upload (ảnh tạm ở dòng move trên) để tránh rác
    if (file_exists('images/news/'.$name)) {
        unlink('images/news/'.$name);
    }

    // Lưu đường dẫn vào CSDL (Biến $news phải được định nghĩa trước đó)
    $news->Images = date('Ymd').'/'.$name; 
   
}

        $flag = $news->save();
        if($flag == true){
            return redirect('admin/news/add')->with(['flash_level'=>'success','flash_message'=>'Thêm tin tức thành công.']);
        }else{
            return redirect('admin/news/add')->with(['flash_level'=>'danger','flash_message'=>'Thêm tin tức không thành công. Vui lòng thử lại!']);      
        }   
    }
    public function news_getEdit(Request $request, $id){
        $News = DB::table('news')->where('RowID', $id)->first();
        $NewsCategory = DB::table('news_cat')->get();
        return view("back.news.edit", compact('News', 'NewsCategory'));
    }
    public function news_postEdit(Request $request, $id){
        // Kiểm tra validate dữ liệu đầu vào
        if($request->Name == '' || $request->Description == '' ){
            return redirect('admin/news/edit/'.$id)->with(['flash_level'=>'danger','flash_message'=>'Vui lòng điền đầy đủ các trường bắt buộc']);
        }   
        $news = News::find($id);    
        $news->Name = $request->Name;
        // $news->RowIDCat = $request->RowIDCat;
        $news->MetaTitle = $request->MetaTitle;
        $news->MetaKeyword = $request->MetaKeyword;
        $news->MetaDescription = $request->MetaDescription;
        $news->SmallDescription = $request->SmallDescription;
        $news->Description = $request->Description;
       if ($request->has('Alias') && !empty($request->Alias)) {
    $news->Alias = $request->Alias;
} else {
    // Nếu Alias rỗng, tự động tạo từ Name
    $news->Alias = Str::slug($request->Name);
}
        $news->Status = $request->Status;
        if($request->hasFile('images')){
        $file = $request->file('images');
        $id_random_digit = rand(000000000, 999999999);
        $name = $id_random_digit.'-'.$file->getClientOriginalName();
        $duoi = strtolower($file->getClientOriginalExtension());

      
        if($duoi != 'png' && $duoi != 'jpg' && $duoi != 'jpeg' && $duoi != 'svg'){
            return back()->with(['flash_level' => 'danger', 'flash_message' => 'Phần mở rộng ảnh không được hỗ trợ.']);
        }

        // Kiểm tra và xóa ảnh cũ nếu có
        if($news->Images != ''){
            if(file_exists('images/news/'.$news->Images)) {
                unlink('images/news/'.$news->Images);
            }
        }
        $file->move('images/news', $name);
        $img = Image::make('images/news/'.$name);
        $filePath = "images/news/".date('Ymd');
        if (!file_exists($filePath)) {
            mkdir("images/news/".date('Ymd'), 0777, true);
        }
        $img->fit(208, 141);
        $img->save('images/news/'.date('Ymd').'/'.$name);
        if (file_exists('images/news/'.$name)) {
            unlink('images/news/'.$name);
        }
        $news->Images = date('Ymd').'/'.$name;
    }
        $flag = $news->save();
        if($flag == true){
            return redirect('admin/news/edit/'.$id)->with(['flash_level'=>'success','flash_message'=>'Cập nhật tin tức thành công.']);
        }else{
            return redirect('admin/news/edit/'.$id)->with(['flash_level'=>'danger','flash_message'=>'Cập nhật tin tức không thành công. Vui lòng thử lại!']);      
        }   
    }
    public function news_delete($id)
{
    $News = News::find($id);
    $flag = $News->delete();
    // Thực hiện xóa    
    if($flag == true){
            return redirect('admin/news/list')->with(['flash_level'=>'success','flash_message'=>'Xóa tin tức thành công.']);
        }else{
            return redirect('admin/news/list')->with(['flash_level'=>'danger','flash_message'=>'Xóa tin tức không thành công. Vui lòng thử lại!']);
        }
    }
    //slider management--------------------------------------------------------------------------------------
    public function slider_list(){
        $Slider = DB::table('slider')->where('Status', 1)->orderBy('Sort', 'DESC')->get();
        return view("back.slider.list", compact('Slider'));
    }
    public function slider_getAdd(){
        return view("back.slider.add");
    }
    public function slider_postAdd(Request $request){
        // Kiểm tra validate dữ liệu đầu vào
        if($request->Name == '' ){
            return redirect('admin/slider/add')->with(['flash_level'=>'danger','flash_message'=>'Vui lòng điền đầy đủ các trường bắt buộc']);
        }   
        $slider = new Slider();   
        $slider->Name = $request->Name;
        $slider->Status = $request->Status;
        if($request->hasFile('images')){
    $file = $request->file('images');
    $random_digit = rand(000000000, 999999999);
    $name = $random_digit.'-'.$file->getClientOriginalName();
    $duoi = strtolower($file->getClientOriginalExtension());

    
    if($duoi != 'png' && $duoi != 'jpg' && $duoi != 'jpeg' && $duoi != 'svg'){
        return back()->with(['flash_level' => 'danger', 'flash_message' => 'Định dạng ảnh không hợp lệ (chỉ hỗ trợ png, jpg, jpeg, svg)']);
    }

    
    $file->move('images/news_slider', $name);

    $img = Image::make('images/news_slider/'.$name);

   
    $filePath = "images/news_slider/".date('Ymd');
    if (!file_exists($filePath)) {
        mkdir("images/news_slider/".date('Ymd'), 0777, true);
    }

    
    $img->fit(1920, 600);
    
    // Lưu ảnh vào folder ngày
    $img->save('images/news_slider/'.date('Ymd').'/'.$name);

    // Xóa ảnh gốc vừa upload (ảnh tạm ở dòng move trên) để tránh rác
    if (file_exists('images/news_slider/'.$name)) {
        unlink('images/news_slider/'.$name);
    }

    // Lưu đường dẫn vào CSDL (Biến $news phải được định nghĩa trước đó)
    $slider->Images = date('Ymd').'/'.$name; 
   
}
        $flag = $slider->save();
        if($flag == true){
            return redirect('admin/slider/list')->with(['flash_level'=>'success','flash_message'=>'Thêm slider thành công.']);
        }else{
            return redirect('admin/slider/add')->with(['flash_level'=>'danger','flash_message'=>'Thêm slider không thành công. Vui lòng thử lại!']);      
        } 
    }
    public function slider_getEdit(Request $request, $id){
        $Slider = DB::table('slider')->where('RowID', $id)->first();
        return view("back.slider.edit", compact('Slider'));
    }
    public function slider_postEdit(Request $request, $id){
        // Kiểm tra validate dữ liệu đầu vào
        if($request->Name == '' ){
            return redirect('admin/slider/edit/'.$id)->with(['flash_level'=>'danger','flash_message'=>'Vui lòng điền đầy đủ các trường bắt buộc']);
        }   
        $slider = Slider::find($id);    
        $slider->Name = $request->Name;
        $slider->Sort = $request->Sort;
        $slider->Status = $request->Status;
        if($request->hasFile('images')){
    $file = $request->file('images');
    $random_digit = rand(000000000, 999999999);
    $name = $random_digit.'-'.$file->getClientOriginalName();
    $duoi = strtolower($file->getClientOriginalExtension());

    
    if($duoi != 'png' && $duoi != 'jpg' && $duoi != 'jpeg' && $duoi != 'svg'){
        return back()->with(['flash_level' => 'danger', 'flash_message' => 'Định dạng ảnh không hợp lệ (chỉ hỗ trợ png, jpg, jpeg, svg)']);
    }

    
    $file->move('images/news_slider', $name);

    $img = Image::make('images/news_slider/'.$name);

   
    $filePath = "images/news_slider/".date('Ymd');
    if (!file_exists($filePath)) {
        mkdir("images/news_slider/".date('Ymd'), 0777, true);
    }

    
    $img->fit(1920, 600);
    
    // Lưu ảnh vào folder ngày
    $img->save('images/news_slider/'.date('Ymd').'/'.$name);

    // Xóa ảnh gốc vừa upload (ảnh tạm ở dòng move trên) để tránh rác
    if (file_exists('images/news_slider/'.$name)) {
        unlink('images/news_slider/'.$name);
    }

    // Lưu đường dẫn vào CSDL (Biến $news phải được định nghĩa trước đó)
    $slider->Images = date('Ymd').'/'.$name; 
   
}
        $flag = $slider->save();
        if($flag == true){
            return redirect('admin/slider/edit/'.$id)->with(['flash_level'=>'success','flash_message'=>'Cập nhật slider thành công.']);
        }else{
            return redirect('admin/slider/edit/'.$id)->with(['flash_level'=>'danger','flash_message'=>'Cập nhật slider không thành công. Vui lòng thử lại!']);      
        } 
    }
    public function slider_delete($id)
{
    $Slider = Slider::find($id);
    $flag = $Slider->delete();
    // Thực hiện xóa    
    if($flag == true){
            return redirect('admin/slider/list')->with(['flash_level'=>'success','flash_message'=>'Xóa slider thành công.']);
        }else{
            return redirect('admin/slider/list')->with(['flash_level'=>'danger','flash_message'=>'Xóa slider không thành công. Vui lòng thử lại!']);
        }
    }

    }