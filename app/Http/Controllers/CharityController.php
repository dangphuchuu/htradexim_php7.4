<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\charity;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class CharityController extends Controller
{
    public function list()
    {
        $charity = charity::orderBy('id','ASC')->Paginate(15);
        return view('admin.charity.list',['charity' => $charity]);
    }
    public function getAdd()
    {
        return view('admin.charity.add');
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
                   return redirect('admin/charity/add')->with('thongbao','Không hỗ trợ '.$format);
               }
               $name = $file->getClientOriginalName();
               $img = Str::random(4).'-'.$name;
               while(file_exists("upload/charity/".$img))
               {
                $img = Str::random(4).'-'.$name;
               }
               $file->move('upload/charity',$img);
               $request['image'] = $img;
               charity::create($request->all());
           }
       }
       else
       {
           $request['image'] = '';
       }
      
       return redirect('admin/charity/list')->with('thongbao','Thêm thành công');
    }
    public function getEdit($id)
    {
        $charity = charity::find($id);
        return view ('admin.charity.edit',['charity' => $charity]);
    }
    public function postEdit(Request $request,$id)
    {
        $charity = charity::find($id);
        if ($request->hasFile('Image'))
        {
            $file = $request->file('Image');
            $format = $file->getClientOriginalExtension();
            if($format !='jpg' && $format !='png' &&$format !='jpeg')
            {
                return redirect('admin/charity/list')->with('thongbao','Không hỗ trợ '.$format);
            }
            $name = $file->getClientOriginalName();
            $img = Str::random(4).'-'.$name;
            while(file_exists('upload/charity/'.$img))
            {
                $img = Str::random(4).'-'.$name;
            }
            $file->move('upload/charity',$img);
            if($charity['image']!='')
            {
                File::delete('upload/charity/'.$charity['image']);
            }
            $request['image'] = $img;
        }
        $charity->update($request->all());
        return redirect('admin/charity/list')->with('thongbao','Sửa thành công');
    }
    public function getAddVideo()
    {
        $charity=charity::all();
        return view('admin.charity.addvideo',['charity'=>$charity]);
    }
    public function postAddVideo(Request $request)
    {
        $request->validate([
            'path'=>'required'
        ],[
            'path.required' => 'Chưa nhập link video'
        ]);
        charity::create($request->all());
        return redirect('admin/charity/list')->with('thongbao','Thêm video thành công');
    }
    public function getEditVideo($id)
    {
        $charity =charity::find($id);
        return view('admin.charity.editvideo',['charity'=>$charity]);
    }
    public function postEditVideo(Request $request,$id)
    {
        $charity = charity::find($id);
        $request->validate([
            'path'=>'required'
        ],[
            'path.required' => 'Chưa nhập link video',
        ]);
        $charity->update($request->all());
        return redirect('admin/charity/list')->with('thongbao','Sửa video thành công');
    }
    public function delete_charity($id)
    {
        $image = charity::find($id);
        if(File::exists('upload/charity/'.$image->image))
        {
            File::delete('upload/charity/'.$image->image);
        }
        $image->delete();
        return response()->json(['success' => 'Delete Successfully']);
    }
    public function deleteall_charity(Request $request)
    {
        $ids = $request->ids;
        $charity = charity::all();
        foreach( $charity as $img)
        {
            if(File::exists('upload/charity/'.$img->image))
            {
                File::delete('upload/charity/'.$img->image);
            }
        }
        charity::whereIn('id', explode(',', $ids))->delete();
        return response()->json(['success' => "charity deleted successfully."]);
    }
    public function delete_charity_videos($id)
    {
        charity::destroy($id);
        return response()->json(['success' => 'Delete Successfully']);
    }
    public function deleteall_charity_videos(Request $request)
    {
        $ids = $request->ids;
            charity::whereIn('id', explode(',', $ids))->delete();
            return response()->json(['success' => "Videos deleted successfully."]);
    }
}
