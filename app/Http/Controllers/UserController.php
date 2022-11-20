<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class UserController extends Controller
{
    public function index()
    {
        return view('admin.layout.index');
    }
    //show view đăng nhập
    public function getLogin()
    {
        return view('admin.login');
    }
    //xử lý đăng nhập
    public function postLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ],
        [
            'username.required'=>'Chưa nhập tài khoản',
            'password.required'=>'Chưa nhập mật khẩu'
        ]);
        //check username và mật khẩu
        if(Auth::attempt(['username'=>$request->username,'password'=>$request->password])|| Auth::attempt(['username'=>$request['username'],'password'=>$request['password']]))
        {
            return redirect('admin/categories/list');
        }
        else
        {
            return redirect('admin/login')->with('thongbao','Đăng nhập không thành công');
        }
    }
    public function getLogout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}
