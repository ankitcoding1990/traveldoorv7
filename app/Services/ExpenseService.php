<?php
namespace App\Services;

use App\Repositories\ExpenseRepository;

class ExpenseService{
    protected $expenseRepository;
    public function __construct(ExpenseRepository $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }

    public function store($request)
    {
        $data = $request->only('id','expense_category_name','expense_category_created_by');
        if(!empty($request->id)){
            $data['expense_category_status'] = 1;
            $res = $this->expenseRepository->update($data);
            if($res){
                return ['Expense Updated successfully!', 'success'];
            }
            else{
                return ['Fail To Update Expense','error'];
            }
        }
        else{
            $data['expense_category_status'] = 1;
            $data['expense_category_type']   = 'expense';
            
            $res = $this->expenseRepository->insert($data);
            if($res){
                return ['Expense Added Successfully','success'];
            }
            else{
                return ['Fail To Add Expense','error'];
            }
        }
    }

    
}