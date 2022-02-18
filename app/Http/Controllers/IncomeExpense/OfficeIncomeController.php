<?php

namespace App\Http\Controllers\IncomeExpense;

use App\Models\Income;
use Illuminate\Http\Request;
use App\Models\IncomeExpenseCategory;
use App\Http\Controllers\Controller;
use App\Services\OfficeIncomeService;
use App\DataTables\OfficeIncomeDatatable;

class OfficeIncomeController extends Controller
{
    public function __construct(OfficeIncomeService $OfficeIncomeService)
    {
        $this->OfficeIncomeService = $OfficeIncomeService;
        $this->routeName='office_income.index';
    }

    public function index(OfficeIncomeDatatable $datatables)
    {
        $routeName=$this->routeName;
        if(auth()->user()->hasViewPermission($routeName,1)){
            $expense_type = 'office';
            $fetch_expense_category = IncomeExpenseCategory::where('expense_category_type', 'income')->where('expense_category_status', 1)->pluck('expense_category_name','id');
            return $datatables->render('mains.IncomeExpense.officeincome.index',compact('expense_type','fetch_expense_category', 'routeName'));
        }else if(auth()->user()->hasViewPermission($routeName)){
            $expense_type = 'office';
            $fetch_expense_category = IncomeExpenseCategory::where('expense_category_type', 'income')->where('expense_category_status', 1)->pluck('expense_category_name','id');
            return $datatables->with(['user_id'=>auth()->user()->id])->render('mains.IncomeExpense.officeincome.index',compact('expense_type','fetch_expense_category', 'routeName'));
        }
        return abort(403, 'You have no permission');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'incomes_category_id' => 'required',
            'incomes_occured_on'  => 'required',
            'incomes_amount'      => 'required|integer'
        ]);
        $message = $this->OfficeIncomeService->store($request);
        return response(['redirect' => route('office_income.index'),'message' => $message[0],'type' => $message[1]],200);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $routeName=$this->routeName;
        $data = Income::where('id',$id)->firstOrFail();
        $fetch_expense_category = IncomeExpenseCategory::where('expense_category_type', 'income')->where('expense_category_status', 1)->pluck('expense_category_name','id');
        $expense_type = $data['incomes_type'];
        return view('mains.IncomeExpense.officeincome.index',compact('data','expense_type','fetch_expense_category', 'routeName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->store($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
