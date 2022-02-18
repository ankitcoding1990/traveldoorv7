<?php
namespace App\Services;

use App\Repositories\OfficeExpenseRepository;

class OfficeExpenseService{
    protected $OfficeExpenseRepository;
    public function __construct(OfficeExpenseRepository $OfficeExpenseRepository)
    {
        $this->OfficeExpenseRepository = $OfficeExpenseRepository;
    }
    

    public function store($request)
    {
        $data = $request->only('expense_type','expense_category_id','expense_occured_on','expense_amount','expense_remarks','expense_created_by','id');
        if(!empty($request->id)) {
            $res = $this->OfficeExpenseRepository->update($data);
            if($res) {
                return ['Expense Updated successfully!', 'success'];
            }
            else {
                return ['Fail To Update Expense','error'];
            }
        } else {
            // dd($data);
            $res = $this->OfficeExpenseRepository->insert($data);
            if($res){
                return ['Expense Added Successfully','success'];
            }
            else{
                return ['Fail To Add Expense','error'];
            }
        }
    }
}