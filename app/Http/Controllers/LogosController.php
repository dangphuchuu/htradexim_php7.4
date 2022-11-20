<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\logos;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class LogosController extends Controller
{
    public function getEdit()
    {
        $logos = logos::find(1);
        return view ('admin.logos.details',['logos' => $logos]);
    }
    public function postEdit(Request $request)
    {
        $logos = logos::find(1);
        if ($request->hasFile('Image'))
        {
            $file = $request->file('Image');
            $format = $file->getClientOriginalExtension();
            if($format !='jpg' && $format !='png' &&$format !='jpeg')
            {
                return redirect('admin/logos')->with('thongbao','Không hỗ trợ '.$format);
            }
            $name = $file->getClientOriginalName();
            $img = Str::random(4).'-'.$name;
            while(file_exists('upload/logos/'.$img))
            {
                $img = Str::random(4).'-'.$name;
            }
            $file->move('upload/logos',$img);
            if($logos['image']!='')
            {
                File::delete('upload/logos/'.$logos['image']);
            }
            $request['image'] = $img;
        }
        $logos->update($request->all());
        return redirect('admin/logos')->with('thongbao','Sửa thành công');
    }
}
