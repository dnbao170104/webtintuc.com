<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BackController;
use App\Http\Controllers\PostController;

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

Route::get('/', function () {
    return view('welcome');
});

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
        
        Route::get('list', [BackController::class, 'staff'])->name('staff.list');
        Route::get('add', [BackController::class, 'staff_add'])->name('staff.add');
        Route::post('add', [BackController::class, 'staff_add_post']);
        Route::get('edit/{id}', [BackController::class, 'staff_edit'])->name('staff.edit');
        Route::post('edit/{id}', [BackController::class, 'staff_edit_post']);
        Route::post('delete', [BackController::class, 'staff_delete'])->name('staff.delete');
        Route::post('filter', [BackController::class, 'staff_filter'])->name('staff.filter');
        Route::resource('posts', PostController::class);
        Route::resource('users', UserController::class);
    });
});
