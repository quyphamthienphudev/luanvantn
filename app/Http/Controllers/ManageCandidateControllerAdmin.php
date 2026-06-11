<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use Illuminate\Support\Facades\DB;


class ManageCandidateControllerAdmin extends Controller
{
    //INDEX
    public function index()
    {
        $candidates = DB::table('candidates')->get();
        return view('hcns.candidates.index',compact('candidates'));
    }

    // SHOW CREATE
    public function create()
    {
        return view('hcns.candidates.create');
    }

    //STORE
    public function store(Request $request)
    {
        $request->validate([
        'candidate_id' => 'required|unique:candidates,candidate_id',
        'full_name' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        'date_of_birth' => 'required|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
        'phone' => 'required|numeric'
        ],[
            'candidate_id.required' => 'Vui lòng nhập mã hồ sơ',
            'candidate_id.unique' => 'Mã hồ sơ đã tồn tại, vui lòng kiểm tra lại',
            'full_name.required' => 'Vui lòng nhập họ tên ứng viên',
            'first_name.required' => 'Vui lòng nhập tên',
            'last_name.required' => 'Vui lòng nhập họ',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'date_of_birth.required' => 'Vui lòng chọn ngày sinh',
            'date_of_birth.before_or_equal' => 'Ứng viên phải từ 18 tuổi trở lên',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại chỉ được nhập số'
        ]);
        $data = $request->all();
        $data['users_id'] = auth()->user()->id;
        Candidate::create($data);
        return redirect('/hcns/candidates')->with('success','Thêm hồ sơ thành công');
    }

    // EDIT
    public function edit($id)
    {
        $candidates = DB::table('candidates')->where('id',$id)->first();
        return view('hcns.candidates.edit',compact('candidates'));
    }

    //UPDATE
    public function update(Request $request,$id)
    {
        $request->validate([
        'full_name' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        'date_of_birth' => 'required|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
        'phone' => 'required|numeric'
        ],[
            'full_name.required' => 'Vui lòng nhập họ tên ứng viên',
            'first_name.required' => 'Vui lòng nhập tên',
            'last_name.required' => 'Vui lòng nhập họ',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'date_of_birth.required' => 'Vui lòng chọn ngày sinh',
            'date_of_birth.before_or_equal' => 'Ứng viên phải từ 18 tuổi trở lên',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại chỉ được nhập số'
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
        DB::table('candidates')->where('id',$id)->delete();
        return redirect('/hcns/candidates')->with('success','Xóa hồ sơ thành công');
    }

    // SHOW DETAIL
    public function show($id)
    {
        $candidate = Candidate::findOrFail($id);
        return view('hcns.candidates.show',compact('candidate'));
    }

    //SEARCH
    public function search(Request $request)
    {
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
