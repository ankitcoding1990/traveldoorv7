<?php

namespace App\Http\Controllers\IncomeExpense;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\IncomeExpenseCategory;
use App\Http\Controllers\Controller;
use App\Services\OfficeExpenseService;
use App\DataTables\OfficeExpenseDatatable;

class OfficeExpenseController extends Controller
{
    public function __construct(OfficeExpenseService $OfficeExpenseService)
    {
        $this->OfficeExpenseService = $OfficeExpenseService;
        $this->routeName='office_expense.index';
    }

    public function index(OfficeExpenseDatatable $datatables)
    {
        $routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($routeName,1)){
            $expense_type = 'office';
            $fetch_expense_category = IncomeExpenseCategory::where('expense_category_type', 'expense')->where('expense_category_status', 1)->pluck('expense_category_name','id');
            return $datatables->with(['routeName'=>$routeName])->render('mains.IncomeExpense.officeexpense.index',compact('expense_type','fetch_expense_category', 'routeName'));
        }else if(auth()->user()->hasViewPermission($routeName)){
            $expense_type = 'office';
            $fetch_expense_category = IncomeExpenseCategory::where('expense_category_type', 'expense')->where('expense_category_status', 1)->pluck('expense_category_name','id');
            return $datatables->with(['user_id'=>auth()->user()->id, 'routeName'=>$routeName])->render('mains.IncomeExpense.officeexpense.index',compact('expense_type','fetch_expense_category', 'routeName'));
        }
        return abort(403, 'You have no permission');
    }

    public function store(Request $request)
    {
        $request->validate([
            'expense_category_id' => 'required',
            'expense_occured_on'  => 'required',
            'expense_amount'      => 'required|integer'
        ]);
        $message = $this->OfficeExpenseService->store($request);
        return response(['redirect' => route('office_expense.index'),'message' => $message[0],'type' => $message[1]],200);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $routeName=$this->routeName;
        $data = Expense::where('id',$id)->firstOrFail();
        $fetch_expense_category = IncomeExpenseCategory::where('expense_category_type', 'expense')->where('expense_category_status', 1)->pluck('expense_category_name','id');
        $expense_type = $data['incomes_type'];
        return view('mains.IncomeExpense.officeexpense.index',compact('data','expense_type','fetch_expense_category', 'routeName'));
    }

    public function update(Request $request, $id)
    {
        return $this->store($request);
    }

    public function destroy($id)
    {
        //
    }
}
