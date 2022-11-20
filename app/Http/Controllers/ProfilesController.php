<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\profiles;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class ProfilesController extends Controller
{
    //show all
    public function list()
    {
        $profiles = profiles::orderBy('id','ASC')->Paginate(15);
        return view('admin.profiles.list',['profiles' => $profiles]);
    }
    public function getAdd()
    {
        return view('admin.profiles.add');
    }
    public function postAdd(Request $request)
    {
       if($request->hasFile('Image'))
       {
           foreach($request->file('Image') as $file)
           {
               $format = $file->getClientOriginalExtension();
               if($format !='jpg'&&$format !='jpeg' && $format !='png')
               {
                   return redirect('admin/profiles/add')->with('thongbao','Không hỗ trợ '.$format);
               }
               $name = $file->getClientOriginalName();
               $img = Str::random(4).'-'.$name;
               while(file_exists("upload/profiles/".$img))
               {
                $img = Str::random(4).'-'.$name;
               }
               $file->move('upload/profiles',$img);
               $request['image'] = $img;
               profiles::create($request->all());
           }
       }
       else
       {
           $request['image'] = '';
       }
      
       return redirect('admin/profiles/list')->with('thongbao','Thêm thành công');
    }
    public function getEdit($id)
    {
        $profiles = profiles::find($id);
        return view ('admin.profiles.edit',['profiles' => $profiles]);
    }
    public function postEdit(Request $request,$id)
    {
        $profiles = profiles::find($id);
        if ($request->hasFile('Image'))
        {
            $file = $request->file('Image');
            $format = $file->getClientOriginalExtension();
            if($format !='jpg' && $format !='png' &&$format !='jpeg')
            {
                return redirect('admin/profiles/list')->with('thongbao','Không hỗ trợ '.$format);
            }
            $name = $file->getClientOriginalName();
            $img = Str::random(4).'-'.$name;
            while(file_exists('upload/profiles/'.$img))
            {
                $img = Str::random(4).'-'.$name;
            }
            $file->move('upload/profiles',$img);
            if($profiles['image']!='')
            {
                File::delete('upload/profiles/'.$profiles['image']);
            }
            $request['image'] = $img;
        }
        $profiles->update($request->all());
        return redirect('admin/profiles/list')->with('thongbao','Sửa thành công');
    }
    public function delete_profiles($id)
    {
        $image = profiles::find($id);
        if(File::exists('upload/profiles/'.$image->image))
        {
            File::delete('upload/profiles/'.$image->image);
        }
        $image->delete();
        return response()->json(['success' => 'Delete Successfully']);
    }
    public function deleteall_profiles(Request $request)
    {
        $ids = $request->ids;
        $profiles = profiles::all();
        foreach( $profiles as $img)
        {
            if(File::exists('upload/profiles/'.$img->image))
            {
                File::delete('upload/profiles/'.$img->image);
            }
        }
        profiles::whereIn('id', explode(',', $ids))->delete();
        return response()->json(['success' => "profiles deleted successfully."]);
    }
}
