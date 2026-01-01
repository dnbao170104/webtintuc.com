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

    $PageInfo=Page::where('Status', 1)->where('Alias','/')->selectRaw('Name,Description,Images,Alias,MetaTitle,MetaDescription,MetaKeyword')->first();
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
    return view('front.home.home', compact('slider', 'news', 'promotions', 'hot_news','PageInfo'));
}
    public function contact()
    {
        $PageInfo=Page::where('Status', 1)->where('Alias','lien-he')->selectRaw('Name,Description,Images,Alias,MetaTitle,MetaDescription,MetaKeyword')->first();
         return view('front.contact.contact', compact('PageInfo'));
    }
   public function contact_post(Request $request)
{
    // 1. Lấy dữ liệu (Lưu ý: Phải khớp chính xác tên 'name' trong thẻ input HTML)
    // Nếu HTML là <input name="Name"> thì ở đây phải là $request->input('Name')
    $name = $request->input('Name');     // Sửa 'name' thành 'Name'
    $email = $request->input('Email');   // Sửa 'email' thành 'Email'
    $message = $request->input('Message'); // Sửa 'message' thành 'Message'

    // 2. Lưu vào bảng 'contact' (số ít)
    DB::table('contact')->insert([
        'Name' => $name,
        'Email' => $email,
        'Message' => $message,
        'IsViews' => 0,          // Thêm cột này (dựa vào cấu trúc bảng bạn gửi)
        'created_at' => now(),   // Sửa 'CreatedAt' thành 'created_at' (chuẩn Laravel/MySQL)
        'updated_at' => now()
    ]);

    return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ với chúng tôi!');
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
    // public function about()
    // {
    //     $PageInf=Page::where('Status', 1)->where('Alias','ve-chung-toi')->selectRaw('Name,Description,Images,Alias,MetaTitle,MetaDescription,MetaKeyword')->first();
    //      return view('front.about.about', compact('PageInf'));
    // }
    public function about()
    {
        $PageInfo = Page::where('Status', 1)
            ->where('Alias', 've-chung-toi')
            ->selectRaw('Name, Description, Images, Alias, MetaTitle, MetaDescription, MetaKeyword')
            ->first();

        return view('front.about.about', compact('PageInfo'));
    }
    // Hàm phụ trợ: Lấy Alias danh mục theo ID
    public function getCategoryAlias($rowIdCat)
    {
        $alias = DB::table('news_cat')
            ->where('RowID', $rowIdCat)
            ->value('Alias'); // Chỉ lấy đúng giá trị cột Alias
        
        return $alias;
    }
    
    public function slug(Request $request, $slug)
    {
        // --- ƯU TIÊN 1: Kiểm tra xem có phải DANH MỤC TIN TỨC? ---
        $newsCat = DB::table('news_cat')->where('Alias', $slug)->where('Status', 1)->first();

        if ($newsCat) {
            // Xử lý lấy bài viết theo danh mục (Giữ nguyên logic cũ của bạn)
            $listNews = DB::table('news as a')
                ->join('news_cat as b', 'a.RowIDCat', '=', 'b.RowID')
                ->selectRaw('a.*, b.Name as CategoryName')
                ->where('a.RowIDCat', $newsCat->RowID)
                ->where('a.Status', 1);

            // Xử lý sắp xếp (nếu có)
            if ($request->get('sort') == 'views') {
                $listNews->orderBy('a.Views', 'DESC');
            } else {
                $listNews->orderBy('a.RowID', 'DESC');
            }
            
            $listNews = $listNews->paginate(12)->appends(['sort' => $request->get('sort')]);

            return view('front.news.cat', compact('newsCat', 'listNews'));
        }

        // --- ƯU TIÊN 2: Kiểm tra xem có phải CHI TIẾT TIN TỨC? ---
        // (Đây là phần bạn đang thiếu, khiến web báo lỗi 404)
        $newsDetail = DB::table('news')->where('Alias', $slug)->where('Status', 1)->first();

        if ($newsDetail) {
            // Tăng view
            DB::table('news')->where('RowID', $newsDetail->RowID)->increment('Views');
            
            // Lấy tên danh mục cha
            $catName = DB::table('news_cat')->where('RowID', $newsDetail->RowIDCat)->value('Name');

            $catAlias = $this->getCategoryAlias($newsDetail->RowIDCat);

            // Lấy tin liên quan
            $relatedNews = DB::table('news')
                ->where('RowIDCat', $newsDetail->RowIDCat)
                ->where('RowID', '!=', $newsDetail->RowID)
                ->where('Status', 1)
                ->orderBy('RowID', 'DESC')
                ->limit(4)
                ->get();

            return view('front.news.detail', compact('newsDetail', 'relatedNews', 'catName','catAlias'));
        }

        // --- ƯU TIÊN 3: Kiểm tra xem có phải TRANG TĨNH (Page)? ---
        $page = DB::table('page')->where('Alias', $slug)->where('Status', 1)->first();

        if ($page) {
            return view('front.about.about', ['PageInfo' => $page]);
        }

        // Nếu không tìm thấy ở đâu cả -> 404 thật
        return abort(404);
    }
}
