<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class galleryController extends Controller
{
    public function gallShow()
    {
        $gallery=DB::table('image_mast')->where('img_type','gallery_photo')->get();
        // dd($gallery);
        return view('gallery',compact('gallery'));
    }
}
