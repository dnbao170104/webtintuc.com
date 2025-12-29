<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
// Import các Model
use App\Models\System;
use App\Models\User;
use App\Models\Page;
use App\Models\Social;
use App\Models\News;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;
 // Nhớ tạo Model Slider: php artisan make:model Slider

class FrontController extends Controller
{
    public function __construct()
    {
        // Các dữ liệu dùng chung cho Header/Footer (Logo, Menu, Social...)
        $logo = System::where('Code', 'logo')->first();
        $favicon = System::where('Code', 'favicon')->first();
        $copyright = System::where('Code', 'copyright')->first();
        
        $social = Social::where('Status', 1)->orderBy('Sort', 'ASC')->get();
        $Pages = Page::where('Status', 1)->orderBy('Sort', 'ASC')->get();

        // Chia sẻ biến global cho tất cả các view
        View::share([
            'logo' => $logo,
            'favicon' => $favicon,
            'social' => $social,
            'Pages' => $Pages,
            'copyright' => $copyright
        ]);
    }

    public function home()
{
    // 1. Lấy Slider (Chuyển sang Query Builder cho đồng bộ)
    $slider = DB::table('slider')
                ->where('Status', 1)
                ->orderBy('Sort', 'ASC')
                ->get();

    // 2. Lấy 6 tin tức mới nhất (Có Join với bảng danh mục để lấy CategoryName)
    $news = DB::table('news as a')
        ->join('news_cat as b', 'a.RowIDCat', '=', 'b.RowID')
        ->selectRaw('a.*, b.Name as CategoryName')
        ->where('a.Status', 1)
        ->orderBy('a.RowID', 'DESC')
        ->limit(6)
        ->get();

    // 3. Lấy 4 tin Khuyến mãi (RowIDCat = 2)
    $promotions = DB::table('news as a')
        ->join('news_cat as b', 'a.RowIDCat', '=', 'b.RowID')
        ->selectRaw('a.*, b.Name as CategoryName')
        ->where('a.Status', 1)
        ->where('a.RowIDCat', 2) // ID danh mục khuyến mãi
        ->orderBy('a.RowID', 'DESC')
        ->limit(4)
        ->get();

    // 4. Lấy 4 tin Xem nhiều/Ngẫu nhiên (Hot News)
    $hot_news = DB::table('news as a')
        ->join('news_cat as b', 'a.RowIDCat', '=', 'b.RowID')
        ->selectRaw('a.*, b.Name as CategoryName')
        ->where('a.Status', 1)
        ->orderBy('a.Views', 'DESC')
        ->inRandomOrder() // Lấy ngẫu nhiên
        ->limit(4)
        ->get();

    // Trả về view và truyền biến sang
    return view('front.home.home', compact('slider', 'news', 'promotions', 'hot_news'));
}
    public function slug($slug)
    {
         // Xử lý trang chi tiết sau
         return view('front.slug');
    }
    public function contact()
    {
         return view('front.contact.contact');
    }
    public function SubEmail(Request $request)
    {
        $email = $request->input('email');
        // Xử lý lưu email vào cơ sở dữ liệu hoặc gửi email
        // Ví dụ: Lưu vào bảng Newsletter
        DB::table('newsletter')->insert([
            'Email' => $email,
            'CreatedAt' => now(),
            'Status' => 1
        ]);
         return redirect()->back()->with('success', 'Cảm ơn bạn đã đăng ký nhận tin khuyến mãi!');
    }
}