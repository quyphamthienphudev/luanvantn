<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Candidate;

class ManageCandidateControllerAdmin 
{
    // INDEX
    public function index()
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $candidates = DB::table('candidates')->select('candidate_id','full_name')->get();
        return view('hcns.candidates.index',compact('candidates'));
    }

    // SHOW CREATE
    public function create()
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        return view('hcns.candidates.create');
    }

    // STORE
    public function store(Request $request)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $request->validate([
        'candidate_id' => 'required|unique:candidates,candidate_id|regex:/^[A-Za-z0-9_-]+$/',
        'full_name' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        'date_of_birth' => 'required|before:' . now()->subYears(18)->format('Y-m-d'),
        // Số điện thoại bắt đầu bằng số 0
        'phone' => 'required|regex:/^0[0-9]+$/|min:10|max:11'
        ],[
            'candidate_id.required' => 'Vui lòng nhập mã hồ sơ.',
            'candidate_id.unique' => 'Mã hồ sơ đã tồn tại, vui lòng kiểm tra lại.',
            'candidate_id.regex' => 'Mã hồ sơ không được chứa chữ có dấu, khoảng trắng hoặc ký tự đặc biệt.',
            'full_name.required' => 'Vui lòng nhập họ tên ứng viên.',
            'first_name.required' => 'Vui lòng nhập tên.',
            'last_name.required' => 'Vui lòng nhập họ.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'date_of_birth.required' => 'Vui lòng chọn ngày sinh.',
            'date_of_birth.before' => 'Ngày sinh không hợp lệ, vui lòng kiểm tra lại.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.regex' => 'Số điện thoại không hợp lệ, vui lòng kiểm tra lại.',
            'phone.min' => 'Số điện thoại không hợp lệ, vui lòng kiểm tra lại.',
            'phone.max' => 'Số điện thoại không hợp lệ, vui lòng kiểm tra lại.'
        ]);
        $data = $request->all();
        Candidate::create($data);
        return redirect('/hcns/candidates')->with('success','Thêm hồ sơ thành công');
    }

    // EDIT
    public function edit($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $candidates = DB::table('candidates')->where('id',$id)->first();
        return view('hcns.candidates.edit',compact('candidates'));
    }

    // UPDATE
    public function update(Request $request,$id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $request->validate([
        'full_name' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        'date_of_birth' => 'required|before:' . now()->subYears(18)->format('Y-m-d'),
        // Số điện thoại bắt đầu bằng số 0
        'phone' => 'required|regex:/^0[0-9]+$/|min:10|max:11'
        ],[
            'full_name.required' => 'Vui lòng nhập họ tên ứng viên.',
            'first_name.required' => 'Vui lòng nhập tên.',
            'last_name.required' => 'Vui lòng nhập họ.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'date_of_birth.required' => 'Vui lòng chọn ngày sinh.',
            'date_of_birth.before' => 'Ngày sinh không hợp lệ, vui lòng kiểm tra lại.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.regex' => 'Số điện thoại không hợp lệ, vui lòng kiểm tra lại.',
            'phone.min' => 'Số điện thoại không hợp lệ, vui lòng kiểm tra lại.',
            'phone.max' => 'Số điện thoại không hợp lệ, vui lòng kiểm tra lại.'
        ]);

        DB::table('candidates')
        ->where('id',$id)
        ->update([
            'full_name'=>$request->full_name,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'gender'=>$request->gender,
            'date_of_birth'=>$request->date_of_birth,
            'phone'=>$request->phone,
            'education'=>$request->education,
            'email'=>$request->email,
            'address'=>$request->address,
            'street'=>$request->street,
            'ward'=>$request->ward,
            'province'=>$request->province
        ]);
        
        Candidate::findOrFail($id)->update($request->all());
        return redirect('/hcns/candidates')->with('success','Cập nhật hồ sơ thành công');
    }

    // DELETE
    public function delete($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        DB::table('candidates')->where('id',$id)->delete();
        return redirect('/hcns/candidates')->with('success','Xóa hồ sơ thành công');
    }

    // SHOW DETAIL
    public function show($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $candidate = Candidate::findOrFail($id);
        return view('hcns.candidates.show',compact('candidate'));
    }

    // SEARCH
    public function search(Request $request)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        
        $search = $request->search;

        $candidates = DB::table('candidates')
            ->when($search, function ($query) use ($search) {
                $query->where('candidate_id', 'like', '%' . $search . '%')
                    ->orWhere('full_name', 'like', '%' . $search . '%');
            })
            ->get();

        return view('hcns.candidates.index', compact('candidates', 'search'));
    }
}