<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\RewardDiscipline;

class ManageEmployeeRewardController extends Controller
{

    //INDEX
    public function index()
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $rewards = RewardDiscipline::with('employee')->where('type','reward')->orderBy('decision_date','desc')->get();
        return view('hcns.rewards.index', compact('rewards'));
    }

    // SHOW CREATE
    public function create()
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $rewards = RewardDiscipline::all();
        $employees = Employee::all();
        return view('hcns.rewards.create', compact('rewards','employees'));
    }

    //STORE
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
            'title.required' => 'Vui lòng nhập nội dung khen thưởng.',
            'amount.required' => 'Vui lòng nhập số tiền.',
            'amount.numeric' => 'Số tiền nhập không hợp lệ, vui lòng kiểm tra lại.',
            'amount.min' => 'Số tiền nhập không hợp lệ, vui lòng kiểm tra lại.',
            'decision_date.required' => 'Vui lòng chọn ngày ra quyết định.'
        ]);
        $data = $request->all();
        $data['type'] = 'reward';
        RewardDiscipline::create($data);
        return redirect('/hcns/rewards')->with('success','Thêm khen thưởng thành công');
    }

    // EDIT
    public function edit($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $rewards = RewardDiscipline::findOrFail($id);
        return view('hcns.rewards.edit', compact('rewards'));
    }

    //UPDATE
    public function update(Request $request,$id)
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
            'title.required' => 'Vui lòng nhập nội dung khen thưởng.',
            'amount.required' => 'Vui lòng nhập số tiền.',
            'amount.numeric' => 'Số tiền nhập không hợp lệ, vui lòng kiểm tra lại.',
            'amount.min' => 'Số tiền nhập không hợp lệ, vui lòng kiểm tra lại.',
            'decision_date.required' => 'Vui lòng chọn ngày ra quyết định.'
        ]);
        RewardDiscipline::findOrFail($id)->update($request->all());
        return redirect('/hcns/rewards')->with('success','Cập nhật khen thưởng thành công');
    }

    // DELETE
    public function delete($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        RewardDiscipline::findOrFail($id)->delete();
        return back()->with('success','Xóa khen thưởng thành công');
    }

}