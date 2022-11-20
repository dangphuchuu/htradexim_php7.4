<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use App\Models\categories;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class ProductsController extends Controller
{
    public function list()
    {
        $products = products::orderBy('id','DESC')->Paginate(5);
        return view('admin.products.list',['products' => $products]);
    }
    public function getAdd()
    {
        $categories = categories::all();
        $products = products::all();
        return view('admin.products.add',['categories'=> $categories,'products'=>$products]);
    }
    public function postAdd(Request $request)
    {
       
        if($request->hasFile('Image'))
       {
        foreach( $request->file('Image') as $file)
        {

            $format = $file->getClientOriginalExtension();
            if($format !='jpg' && $format !='jpeg' && $format !='png')
            {
                return redirect('admin/products/add')->with('thongbao','Không hỗ trợ '.$format);
            }
            $name = $file->getClientOriginalName();
            $img = Str::random(4).'-'.$name;
            while(file_exists("upload/products/".$img))
            {
             $img = Str::random(4).'-'.$name;
            }
            $file->move('upload/products',$img);
            $request['image'] = $img;
            products::create($request->all());
        }
       }
       else
       {
           $request['image'] = '';
       }
      
       return redirect('admin/products/list')->with('thongbao','Thêm thành công');
    }
    public function getEdit($id)
    {
        $categories = categories::all();
        $products = products::find($id);
        return view('admin.products.edit',['products' => $products],['categories' => $categories]);
    }
    public function postEdit(Request $request,$id)
    {
        $products = products::find($id);
        if ($request->hasFile('Image'))
        {
            $file = $request->file('Image');
            $format = $file->getClientOriginalExtension();
            if($format !='jpg' && $format !='png' &&$format !='jpeg')
            {
                return redirect('admin/products/list')->with('thongbao','Không hỗ trợ '.$format);
            }
            $name = $file->getClientOriginalName();
            $img = Str::random(4).'-'.$name;
            while(file_exists('upload/products/'.$img))
            {
                $img = Str::random(4).'-'.$name;
            }
            $file->move('upload/products',$img);
            if($products['image']!='')
            {
                File::delete('upload/products/'.$products['image']);
            }
            $request['image'] = $img;
        }
        $products->update($request->all());
        return redirect('admin/products/list')->with('thongbao','Sửa thành công');
    }
    public function delete_products($id)
    {
        $image = products::find($id);
        if(File::exists('upload/products/'.$image->image))
        {
            File::delete('upload/products/'.$image->image);
        }
        $image->delete();
        return response()->json(['success' => 'Delete Successfully']);
    }
    public function deleteall_products(Request $request)
    {
        $ids = $request->ids;
        $products = products::all();
        foreach( $products as $img)
        {
            if(File::exists('upload/products/'.$img->image))
            {
                File::delete('upload/products/'.$img->image);
            }
        }
        products::whereIn('id', explode(',', $ids))->delete();
        return response()->json(['success' => "Products deleted successfully."]);
    }
}
