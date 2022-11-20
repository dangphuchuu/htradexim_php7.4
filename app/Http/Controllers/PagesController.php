<?php

namespace App\Http\Controllers;
use App\Models\categories;
use Illuminate\Http\Request;
use App\Models\banners;
use App\Models\footers;
use App\Models\profiles;
use App\Models\logos;
use App\Models\products;
use App\Models\videos;
use App\Models\charity;
class PagesController extends Controller
{
    public function profile()
    {
        $footers = footers::all();
        $banners = banners::all();
        $profiles = profiles::orderBy('id','ASC')->Paginate(1000);
        $logos = logos::all();
        $categories = categories::all();
        return view('pages.profile',
        [
        'categories' => $categories,
        'footers'=>$footers,
        'banners'=>$banners,
        'profiles'=>$profiles,
        'logos'=>$logos
        ]);
    }
    public function products($id)
    {
        $logos = logos::all();
        $categories = categories::all();
        $catname = categories::where('id',$id)->first();
        $banners = banners::all();
        $footers = footers::all();
        $products = products::where('categories_id',$id)->get();
        $videos = videos::where('categories_id',$id)->get();
        return view('pages.products',
        [
            'logos' => $logos,
            'categories'=>$categories,
            'banners'=>$banners,
            'footers'=>$footers,
            'products'=>$products,
            'videos'=>$videos,
            'catname'=> $catname
    ]);
    }
    public function charity()
    {
        $footers = footers::all();
        $banners = banners::all();
        $charity = charity::orderBy('id','ASC')->Paginate(1000);
        $logos = logos::all();
        $categories = categories::all();
        $videos = videos::all();
        return view('pages.charity',
        [
        'categories' => $categories,
        'footers'=>$footers,
        'banners'=>$banners,
        'charity'=>$charity,
        'logos'=>$logos,
        'videos'=>$videos
        ]);
    }

}
