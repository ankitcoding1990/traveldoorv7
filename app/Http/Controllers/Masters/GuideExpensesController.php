<?php

namespace App\Http\Controllers\Masters;

use App\Models\GuideExpense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\GuideExpensesService;
use App\DataTables\GuideExpensesDatatables;

class GuideExpensesController extends Controller
{
    public $routeName;
    public function __construct(GuideExpensesService $service)
    {
        $this->service    = $service;
        $this->routeName  = 'guide_expenses.index';
    }

    public function index(GuideExpensesDatatables $datatable)
    {
        $routeName = $this->routeName;
        if(auth()->user()->hasViewPermission($this->routeName,1)){
            return $datatable->with(['routeName' => $routeName])->render('mains.masters.guide_expenses.index',compact('routeName'));
        }else if(auth()->user()->hasViewPermission($this->routeName)){
            return $datatable->with(['user_id' => auth()->user()->id, 'routeName' => $routeName])->render('mains.masters.guide_expenses.index',compact('routeName'));
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
        $request->validate([
            'guide_expense' => 'required|unique:guide_expense,guide_expense',
            'guide_expense_cost' => 'required'
        ]);
        $message = $this->service->store($request);
        return $message;
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
        $guide_expenses = GuideExpense::where('id',$id)->firstOrFail();
        return view('mains.masters.guide_expenses.index',compact('guide_expenses','routeName'));
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
        $request->validate(['guide_expense' => 'required','guide_expense_cost' => 'required|min:1']);
        $message = $this->service->store($request, $id);
        return $message;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = $this->service->delete($id);
        return $message;
    }
}
