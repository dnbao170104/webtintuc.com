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
use Intervention\Image\Facades\Image;


class FrontController extends Controller
{
    public function __construct()
    {
        // Middleware can be added here if needed
        @session_start();

        $logo = System::select('Description')->where('Code','logo')->first();
        view()->share('logo',$logo);
        $favicon = System::select('Description')->where('Code','favicon')->first();
        view()->share('favicon',$favicon);     
        $social = Social::where('Status', 1)
            ->select('Name', 'Font', 'Alias') 
            ->orderBy('Sort', 'ASC')
            ->get();

        view()->share('social', $social);
        $Pages = Page::where('Status', 1)
            ->select('Name', 'Alias', 'Font')
            ->orderBy('Sort', 'ASC')
            ->get();
        view()->share('Pages', $Pages);
        $copyright = System::select('Description')->where('Code','copyright')->first();
        view()->share('copyright',$copyright);


    }
   public function home()
   {
       return view('front.home.home');
   }
    public function slug()
    {
         return view('front.slug');
    }
}