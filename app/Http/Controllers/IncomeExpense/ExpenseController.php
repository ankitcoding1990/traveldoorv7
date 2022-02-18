<?php

namespace App\Http\Controllers\IncomeExpense;

use Illuminate\Http\Request;
use App\Models\IncomeExpenseCategory;
use App\DataTables\ExpenseDatatable;
use App\Http\Controllers\Controller;
use App\DataTables\IncomeExpenseDatatable;
use App\Services\ExpenseService;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct(ExpenseService $service)
    {
        $this->service = $service;
        $this->routeName = 'expense.index';
    }


    public function index(ExpenseDatatable $datatables)
    {
        $routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)){
            return $datatables->with(['routeName' => $routeName])->render('mains.IncomeExpense.ExpenseCategory.index',compact('routeName'));
        }else if(auth()->user()->hasViewPermission($this->routeName)){
            return $datatables->with(['user_id' => auth()->user()->id, 'routeName' => $routeName])->render('mains.IncomeExpense.ExpenseCategory.index',compact('routeName'));
        }
        return abort(403, 'You have no permission');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['expense_category_name' => 'required']);
        $message = $this->service->store($request);
        return response(['redirect' => route('expense.index'),'message' => $message[0],'type' => $message[1]],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $routeName = $this->routeName;
        $data = IncomeExpenseCategory::where('id',$id)->firstOrFail();
        return view('mains.IncomeExpense.ExpenseCategory.index',compact('data','routeName'));

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
        $request->validate(['expense_category_name' => 'required']);
        $message = $this->service->store($request);
        return response(['redirect' => route('expense.index'),'message' => $message[0],'type' => $message[1]],200);
        // return response(['redirect' => route('expense.index')],200);
        // return redirect()->route('');
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
