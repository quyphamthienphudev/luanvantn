<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Week3;
class Week3Controller extends Controller
{
    public function view(Request $request){
        $search = $request->search;
        $sort = $request->sort;
        if(!in_array($sort,['id','name'])){
            $sort = 'id';
        }

        $users = DB::table('users_tuan03')
            ->when($search,function($query) use ($search){
                $query->where('name','like','%'.$search.'%')
                    ->orWhere('id',$search);
            })
            ->orderBy($sort)
            ->get();

        return view('users.index',compact('users','search','sort'));
    }
    public function detail($id){
        $user = DB::table('users_tuan03')
        ->where('id',$id)
        ->get();

        return view('users.show',compact('user'));
    }
    public function store(Request $request){
        if(trim($request->id) == ''){

        if(trim($request->id) == '' && trim($request->name) == ''){
            return redirect('/users')
                ->with('error','Vui lòng nhập id và nhập tên')
                ->withInput();
        }

        return redirect('/users')
            ->with('error','Vui lòng nhập id')
            ->withInput();
        }

        if(!is_numeric($request->id)){

            if(!is_numeric($request->id) && trim($request->name) == ''){
                return redirect('/users')
                    ->with('error','Vui lòng nhập số cho id và nhập tên')
                    ->withInput();
            }

            return redirect('/users')
                ->with('error','Vui lòng nhập số cho id')
                ->withInput();
        }

        if(trim($request->name) == ''){
            return redirect('/users')
                ->with('error','Vui lòng nhập tên')
                ->withInput();
        }

        DB::table('users_tuan03')->insert([
            'id'=>$request->id,
            'name'=>$request->name
        ]);

        return redirect('/users')->with('success','Thêm thành công');
    }
    public function update(Request $request, $id){
        if(trim($request->name) == ''){
            return redirect('/users')
                ->with('error','Vui lòng nhập tên');
        }

        DB::table('users_tuan03')
            ->where('id',$id)
            ->update([
                'name'=>$request->name
            ]);

        return redirect('/users')
            ->with('success','Cập nhật thành công');
    }
    public function delete($id){
        DB::table('users_tuan03')
        ->where('id',$id)
        ->delete();

        return redirect('/users')->with('success','Xóa thành công');
    }
}
