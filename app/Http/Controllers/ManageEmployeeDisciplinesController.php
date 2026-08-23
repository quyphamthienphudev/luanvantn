<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\RewardDiscipline;

class ManageEmployeeDisciplinesController 
{

    // INDEX
    public function index()
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $disciplines = RewardDiscipline::with('employee')->where('type', 'discipline')->orderBy('decision_date', 'desc')->get();
        return view('hcns.disciplines.index', compact('disciplines'));
    }

    // SHOW CREATE
    public function create()
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $disciplines = RewardDiscipline::all();
        $employees = Employee::all();
        return view('hcns.disciplines.create', compact('disciplines', 'employees'));
    }

    // STORE
    public function store(Request $request)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $request->validate([
        'title' => 'required',
        'amount' => 'required|numeric|min:0',
        'decision_date' => 'required'
        ],[
            'title.required' => 'Vui lòng nhập nội dung kỷ luật.',
            'amount.required' => 'Vui lòng nhập số tiền.',
            'amount.numeric' => 'Số tiền nhập không hợp lệ, vui lòng kiểm tra lại.',
            'amount.min' => 'Số tiền nhập không hợp lệ, vui lòng kiểm tra lại.',
            'decision_date.required' => 'Vui lòng chọn ngày ra quyết định.'
        ]);
        $data = $request->all();
        $data['type'] = 'discipline';
        RewardDiscipline::create($data);
        return redirect('/hcns/disciplines')->with('success', 'Thêm kỷ luật thành công');
    }

    // EDIT
    public function edit($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $exists = DB::table('reward_discipline')->where('id', $id)->exists();
        if($exists)
        {
            $disciplines = RewardDiscipline::findOrFail($id);
            return view('hcns.disciplines.edit', compact('disciplines'));
        }
        return back();
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $request->validate([
        'title' => 'required',
        'amount' => 'required|numeric|min:0',
        'decision_date' => 'required'
        ],[
            'title.required' => 'Vui lòng nhập nội dung kỷ luật.',
            'amount.required' => 'Vui lòng nhập số tiền.',
            'amount.numeric' => 'Số tiền nhập không hợp lệ, vui lòng kiểm tra lại.',
            'amount.min' => 'Số tiền nhập không hợp lệ, vui lòng kiểm tra lại.',
            'decision_date.required' => 'Vui lòng chọn ngày ra quyết định.'
        ]);
        RewardDiscipline::findOrFail($id)->update($request->all());
        return redirect('/hcns/disciplines')->with('success', 'Cập nhật kỷ luật thành công');
    }

    // DELETE
    public function delete($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $exists = DB::table('reward_discipline')->where('id', $id)->exists();
        if($exists)
        {
            RewardDiscipline::findOrFail($id)->delete();
            return back()->with('success', 'Xóa kỷ luật thành công');
        }
        return back();
    }

}