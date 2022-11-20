<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\banners;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class BannersController extends Controller
{
    public function getEdit()
    {
        $banners = banners::find(1);
        return view ('admin.banners.details',['banners' => $banners]);
    }
    public function postEdit(Request $request)
    {
        $banners = banners::find(1);
        if ($request->hasFile('Image'))
        {
            $file = $request->file('Image');
            $format = $file->getClientOriginalExtension();
            if($format !='jpg' && $format !='png' &&$format !='jpeg')
            {
                return redirect('admin/banners')->with('thongbao','Không hỗ trợ '.$format);
            }
            $name = $file->getClientOriginalName();
            $img = Str::random(4).'-'.$name;
            while(file_exists('upload/banners/'.$img))
            {
                $img = Str::random(4).'-'.$name;
            }
            $file->move('upload/banners',$img);
            if($banners['image']!='')
            {
                File::delete('upload/banners/'.$banners['image']);
            }
            $request['image'] = $img;
        }
        $banners->update($request->all());
        return redirect('admin/banners')->with('thongbao','Sửa thành công');
    }
}

