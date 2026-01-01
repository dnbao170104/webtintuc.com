<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BackController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FrontController;
use Symfony\Component\Routing\Route as RoutingRoute;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('welcome');
});
// Frontend routes
Route::get('/', [FrontController::class, 'home'])->name('home');
Route::get('/lien-he', [FrontController::class, 'contact'])->name('contact');
Route::post('/lien-he', [FrontController::class, 'contact_post'])->name('contact.post');
Route::post('/dang-ky-nhan-tin-khuyen-mai', [FrontController::class, 'SubEmail'])->name('contact.sub.email');
Route::get('/ve-chung-toi', [FrontController::class, 'about'])->name('about');
// Route tìm kiếm
Route::get('/tim-kiem', [FrontController::class, 'search'])->name('search');
// --- Đặt đoạn này ở cuối file web.php ---

// 1. Ưu tiên bắt các link có đuôi .html (Chi tiết bài viết)
// Ví dụ: /tin-tuc-hot.html -> $slug sẽ là 'tin-tuc-hot'
// Route::get('{Slug}.html', [FrontController::class, 'slugHtml'])->name('slug.html');

// 2. Sau đó mới bắt các link còn lại (Danh mục tin, Trang giới thiệu...)
// Ví dụ: /xu-huong-thoi-trang
Route::get('{slug}', [FrontController::class, 'slug'])->name('slug');








// Login routes
Route::get('/login', [UserController::class, 'getLogin'])->name('login');
Route::post('/login', [UserController::class, 'postLogin']);
Route::get('/logout', [UserController::class, 'getLogout'])->name('logout');

// admin route group
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    // welcome to admin
    Route::get('/home', [BackController::class, 'home'])->name('admin.home');
    
    // Staff
    Route::group(['prefix' => 'staff'], function() {
        Route::get('profile', [BackController::class, 'staff_profile'])->name('staff.profile');
        Route::post('profile', [BackController::class, 'staff_profile_post'])->name('staff.profile.post');
        Route::get('list', [BackController::class, 'staff_list'])->name('admin.staff.list');
        Route::get('add', [BackController::class, 'staff_add'])->name('staff.add');
        Route::post('add', [BackController::class, 'staff_add_post']);
        Route::get('edit/{id}', [BackController::class, 'staff_edit'])->name('staff.edit');
        Route::post('edit/{id}', [BackController::class, 'staff_edit_post'])->name('staff.edit_post');

        Route::get('delete/{id}', [BackController::class, 'staff_delete'])->name('staff.delete');
        Route::post('filter', [BackController::class, 'staff_filter'])->name('staff.filter');
        Route::resource('posts', PostController::class);
        Route::resource('users', UserController::class);
    });
    // System
    route::get('/system', [BackController::class, 'system'])->name('admin.system');
    route::post('/system', [BackController::class, 'system_post'])->name('admin.system.post');
    //page management
    Route::group(['prefix' => 'pages'], function() {
        Route::get('list', [BackController::class, 'page_list'])->name('admin.page.about');
        Route::get('edit/{id}', [BackController::class, 'page_edit'])->name('admin.page.about.edit');
        Route::post('edit/{id}', [BackController::class, 'page_edit_post'])->name('admin.page.about.edit.post');
    });
    //social management----------------------------------------------------------------------------------
    Route::group(['prefix' => 'social'], function() {
        Route::get('list', [BackController::class, 'social_list'])->name('admin.social.list');
        Route::get('edit/{id}', [BackController::class, 'social_edit'])->name('admin.social.edit');
        Route::post('edit/{id}', [BackController::class, 'social_edit_post'])->name('admin.social.edit.post');
    });
    //newsletter management----------------------------------------------------------------------------------
    Route::group(['prefix' => 'newsletter'], function() {
        Route::get('list', [BackController::class, 'newsletter_list'])->name('admin.newsletter.list');
        Route::get('edit/{id}', [BackController::class, 'newsletter_edit'])->name('admin.newsletter.edit');
        Route::post('edit/{id}', [BackController::class, 'newsletter_edit_post'])->name('admin.newsletter.edit.post');
        Route::get('delete/{id}', [BackController::class, 'newsletter_delete'])->name('admin.newsletter.delete');
    });
    //contact management----------------------------------------------------------------------------------
    Route::group(['prefix' => 'contact'], function() {
        Route::get('list', [BackController::class, 'contact_list'])->name('admin.contact.list');
        Route::get('edit/{id}', [BackController::class, 'contact_edit'])->name('admin.contact.edit');
        Route::post('edit/{id}', [BackController::class, 'contact_edit_post'])->name('admin.contact.edit.post');
        Route::get('delete/{id}', [BackController::class, 'contact_delete'])->name('admin.contact.delete');
    });
    //new category management----------------------------------------------------------------------------------
    Route::group(['prefix' => 'news_cat'], function() {
        Route::get('list', [BackController::class, 'news_cat_list'])->name('admin.newcategory.list');
        Route::get('cat_edit/{id}', [BackController::class, 'news_cat_edit'])->name('admin.newcategory.edit');
        Route::post('cat_edit/{id}', [BackController::class, 'news_cat_edit_post'])->name('admin.newcategory.edit.post');
        Route::get('delete/{id}', [BackController::class, 'news_cat_delete'])->name('admin.newcategory.delete');

    });
    Route::group(['prefix' => 'news'], function() {
        Route::get('list', [BackController::class, 'news_list'])->name('admin.news.list');
        Route::get('add', [BackController::class, 'news_getAdd'])->name('admin.news.add');  
        Route::post('add', [BackController::class, 'news_postAdd']);
        Route::get('edit/{id}', [BackController::class, 'news_getEdit'])->name('admin.news.edit');  
        Route::post('edit/{id}', [BackController::class, 'news_postEdit'])->name('admin.news.edit.post');
        Route::get('delete/{id}', [BackController::class, 'news_delete'])->name('admin.news.delete');

    });
   Route::group(['prefix' => 'slider'], function() {
        Route::get('list', [BackController::class, 'slider_list'])->name('admin.slider.list');
        Route::get('add', [BackController::class, 'slider_getAdd'])->name('admin.slider.add');  
        Route::post('add', [BackController::class, 'slider_postAdd']);
        Route::get('edit/{id}', [BackController::class, 'slider_getEdit'])->name('admin.slider.edit');  
        Route::post('edit/{id}', [BackController::class, 'slider_postEdit'])->name('admin.slider.edit.post');
        Route::get('delete/{id}', [BackController::class, 'slider_delete'])->name('admin.slider.delete');

    });
});