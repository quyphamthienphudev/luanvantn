<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\RewardDiscipline;
use Illuminate\Support\Facades\DB;

class ManageEmployeeDisciplinesController extends Controller
{

    //INDEX
    public function index()
    {
        $disciplines = RewardDiscipline::with('employee')->where('type','discipline')->get();
        return view('hcns.disciplines.index', compact('disciplines'));
    }

    // SHOW CREATE
    public function create()
    {
        $disciplines = RewardDiscipline::all();
        $employees = Employee::all();
        return view('hcns.disciplines.create', compact('disciplines','employees'));
    }

    //STORE
    public function store(Request $request)
    {
        $request->validate([
        'title' => 'required',
        'amount' => 'required|numeric',
        'decision_date' => 'required'
        ],[
            'title.required' => 'Vui lòng nhập nội dung kỷ luật',
            'amount.required' => 'Vui lòng nhập số tiền',
            'amount.numeric' => 'Số tiền nhập không hợp lệ',
            'decision_date.required' => 'Vui lòng chọn ngày ra quyết định'
        ]);
        $data = $request->all();
        $data['type'] = 'discipline';
        RewardDiscipline::create($data);
        return redirect('/hcns/disciplines')->with('success','Thêm kỷ luật thành công');
    }

    // EDIT
    public function edit($id)
    {
        $disciplines = RewardDiscipline::findOrFail($id);
        return view('hcns.disciplines.edit', compact('disciplines'));
    }

    //UPDATE
    public function update(Request $request,$id)
    {
        $request->validate([
        'title' => 'required',
        'amount' => 'required|numeric',
        'decision_date' => 'required'
        ],[
            'title.required' => 'Vui lòng nhập nội dung kỷ luật',
            'amount.required' => 'Vui lòng nhập số tiền',
            'amount.numeric' => 'Số tiền nhập không hợp lệ',
            'decision_date.required' => 'Vui lòng chọn ngày ra quyết định'
        ]);
        RewardDiscipline::findOrFail($id)->update($request->all());
        return redirect('/hcns/disciplines')->with('success','Cập nhật kỷ luật thành công');
    }

    // DELETE
    public function delete($id)
    {
        RewardDiscipline::findOrFail($id)->delete();
        return back()->with('success','Xóa kỷ luật thành công');
    }

}
