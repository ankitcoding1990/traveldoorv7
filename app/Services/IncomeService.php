<?php
namespace App\Services;

use App\Repositories\IncomeRepository;

class IncomeService{
    protected $incomeRepository;
    public function __construct(IncomeRepository $incomeRepository)
    {
        $this->incomeRepository = $incomeRepository;
    }

    public function store($request)
    {
        $data = $request->only('id','expense_category_name','expense_category_created_by');
        if(!empty($request->id)) {
            $data['expense_category_status'] = 1;
            $res = $this->incomeRepository->update($data);
            // dd($res);
            if($res) {
                return ['Income Updated successfully!', 'success'];
            }
            else {
                return ['Fail To Update Income','error'];
            }
        } else {
            $data['expense_category_status'] = 1;
            $data['expense_category_type']   = 'income';
            
            $res = $this->incomeRepository->insert($data);
            if($res){
                return ['Income Added Successfully','success'];
            }
            else{
                return ['Fail To Add Income','error'];
            }
        }
    }

    
}