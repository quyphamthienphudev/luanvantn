<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class RoleController extends Controller
{
    //INDEX
    public function index()
    {
        if (auth()->user()->role->name !== 'httt') 
        {
            return back();
        }
        $roles = DB::table('roles')->get();
        return view('httt.roles.index',compact('roles'));
    }

    //SHOW CREATE
    public function create()
    {
        if (auth()->user()->role->name !== 'httt') 
        {
            return back();
        }
        return view('httt.roles.create');
    }

    //STORE
    public function store(Request $request)
    {
        if (auth()->user()->role->name !== 'httt') 
        {
            return back();
        }

        $request->validate([
            'name' => 'required|regex:/^[A-Za-z0-9_-]+$/',
            'description' => 'required'
        ],[
            'name.required' => 'Tên quyền truy cập không được để trống',
            'name.regex' => 'Tên quyền truy cập không được chứa chữ có dấu, khoảng trắng hoặc ký tự đặc biệt',
            'description.required' => 'Mô tả không được để trống'
        ]);

        DB::table('roles')->insert([
            'name'=> $request->name,
            'description'=> $request->description
        ]);

        return redirect('/httt/roles')->with('success','Thêm quyền truy cập thành công');
    }

    //SHOW EDIT
    public function edit($id)
    {
        if (auth()->user()->role->name !== 'httt') 
        {
            return back();
        }
        $roles = DB::table('roles')->where('id',$id)->first();
        return view('httt.roles.edit',compact('roles'));
    }

    //UPDATE
    public function update(Request $request,$id)
    {
        if (auth()->user()->role->name !== 'httt') 
        {
            return back();
        }

        $request->validate([
            'description' => 'required'
        ],[
            'description.required' => 'Mô tả không được để trống'
        ]);

        DB::table('roles')
        ->where('id',$id)
        ->update(['description' => $request->description]);

        return redirect('/httt/roles')->with('success','Cập nhật quyền truy cập thành công');
    }

    //DELETE
    public function delete($id)
    {
        if (auth()->user()->role->name !== 'httt') 
        {
            return back();
        }

        $hasUser = DB::table('users')->where('role_id', $id)->exists();

        if($hasUser)
        {
            return back()->with('error','Quyền này đang có người dùng, không thể xóa');
        }

        DB::table('roles')->where('id',$id)->delete();

        return redirect('/httt/roles')->with('success','Xóa quyền truy cập thành công');
    }

    //SEARCH
    public function search(Request $request)
    {
        if (auth()->user()->role->name !== 'httt') 
        {
            return back();
        }
        
        $search = $request->search;

        $roles = DB::table('roles')
            ->when($search, function ($query) use ($search) {

            // Tìm theo id, name hoặc description
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            })
        ->get();

        return view('httt.roles.index', compact('roles', 'search'));
    }
}