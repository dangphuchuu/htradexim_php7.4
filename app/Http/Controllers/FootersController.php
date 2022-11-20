<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\footers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class FootersController extends Controller
{
     public function getEdit()
    {
        $footers = footers::find(1);
        return view ('admin.footers.details',['footers' => $footers]);
    }
    public function postEdit(Request $request)
    {
        $footers = footers::find(1);
        if ($request->hasFile('Image'))
        {
            $file = $request->file('Image');
            $format = $file->getClientOriginalExtension();
            if($format !='jpg' && $format !='png' &&$format !='jpeg')
            {
                return redirect('admin/footers')->with('thongbao','Không hỗ trợ '.$format);
            }
            $name = $file->getClientOriginalName();
            $img = Str::random(4).'-'.$name;
            while(file_exists('upload/footers/'.$img))
            {
                $img = Str::random(4).'-'.$name;
            }
            $file->move('upload/footers',$img);
            if($footers['image']!='')
            {
                File::delete('upload/footers/'.$footers['image']);
            }
            $request['image'] = $img;
        }
        $footers->update($request->all());
        return redirect('admin/footers')->with('thongbao','Sửa thành công');
    }
}
