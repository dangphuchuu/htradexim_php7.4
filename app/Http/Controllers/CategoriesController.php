<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categories;
use App\Models\products;
use App\Models\videos;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class CategoriesController extends Controller
{
    public function list()
    {
        $categories = categories::orderBy('id','DESC')->get();
        return view('admin.categories.list',['categories' => $categories]);
    }
    public function getAdd()
    {
        return view ('admin.categories.add');
    }
    public function postAdd(Request $request)
    {
        $request->validate([
            'name' =>'required|unique:categories'
        ],[
            'name.required'=>"Vui lòng nhập tên danh mục",
            'name.unique' =>'Tên danh mục này đã tồn tại'
        ]);
        categories::create($request->all());

        return redirect('admin/categories/list')->with('thongbao','Thêm thành công');
    }
    public function getEdit($id)
    {
        $categories = categories::find($id);
        return view('admin.categories.edit',['categories'=>$categories]);
    }
    public function postEdit(Request $request,$id)
    {
        $categories = categories::find($id);
        $request->validate([
            'name' => 'required|unique:categories'
        ],[
            'name.required' => 'Vui lòng nhập tên danh mục',
            'name.unique' => 'Tên danh mục này đã tồn tại'
        ]);
        $categories->update($request->all());
        return redirect('admin/categories/list')->with('thongbao','Sửa thành công');
    }
    public function delete_categories($id)
    {
        $check = count(products::where('categories_id', $id)->get());
        $check2 = count(videos::where('categories_id', $id)->get());
        if ($check == 0) 
        {
            if($check2 == 0)
            {
                categories::destroy($id);
                return response()->json(['success' => 'Delete Successfully']);
            }
            else
            {
                return response()->json(['error' => "Can't delete because exist Videos in Categories"]);
            }
            
        } 
        else 
        {
            return response()->json(['error' => "Can't delete because exist Products in Categories"]);
        }
    }
    public function deleteall_categories(Request $request)
    {
        $ids = $request->ids;
        $check = count(products::where('categories_id', $ids)->get());
        if ($check != 0) 
        {
            return response()->json(['error' => "Can't delete because exist Products in Categories "]);
           
        } 
        else 
        {
            categories::whereIn('id', explode(',', $ids))->delete();
            return response()->json(['success' => "Categories deleted successfully."]);
        }
    }
}
