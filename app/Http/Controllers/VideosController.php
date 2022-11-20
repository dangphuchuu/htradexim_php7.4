<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\videos;
use App\Models\categories;
class VideosController extends Controller
{
    public function list()
    {
        $videos=videos::orderBy('id','DESC')->Paginate(5);
        return view('admin.videos.list',['videos'=>$videos]);
    }
    public function getAdd()
    {
        $categories=categories::all();
        $videos=videos::all();
        return view('admin.videos.add',['videos'=>$videos,'categories'=>$categories]);
    }
    public function postAdd(Request $request)
    {
        $request->validate([
            'path'=>'required|unique:videos'
        ],[
            'path.required' => 'Chưa nhập link video',
            'path.unique'=>'Đường dẫn video đã tồn tại'
        ]);
        videos::create($request->all());
        return redirect('admin/videos/list')->with('thongbao','Thêm video thành công');
    }
    public function getEdit($id)
    {
        $categories = categories::all();
        $videos =videos::find($id);
        return view('admin.videos.edit',['videos'=>$videos,'categories'=>$categories]);
    }
    public function postEdit(Request $request,$id)
    {
        $videos = videos::find($id);
        $request->validate([
            'path'=>'required'
        ],[
            'path.required' => 'Chưa nhập link video',
        ]);
        $videos->update($request->all());
        return redirect('admin/videos/list')->with('thongbao','Sửa video thành công');
    }
    public function delete_videos($id)
    {
            videos::destroy($id);
            return response()->json(['success' => 'Delete Successfully']);
    }
    public function deleteall_videos(Request $request)
    {
            $ids = $request->ids;
            videos::whereIn('id', explode(',', $ids))->delete();
            return response()->json(['success' => "Videos deleted successfully."]);
    }
}
