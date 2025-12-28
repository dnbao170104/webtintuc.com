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
    }
   public function home()
   {
       return view('front.home');
   }
    public function slug()
    {
         return view('front.slug');
    }
}