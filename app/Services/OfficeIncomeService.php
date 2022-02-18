<?php
namespace App\Services;

use App\Repositories\OfficeIncomeRepository;

class OfficeIncomeService{
    protected $OfficeIncomeRepository;
    public function __construct(OfficeIncomeRepository $OfficeIncomeRepository)
    {
        $this->OfficeIncomeRepository = $OfficeIncomeRepository;
    }
    

    public function store($request)
    {
        $data = $request->only('incomes_type','incomes_category_id','incomes_occured_on','incomes_amount','incomes_remarks','incomes_created_by','id');
        if(!empty($request->id)) {
            $res = $this->OfficeIncomeRepository->update($data);
            if($res) {
                return ['Income Updated successfully!', 'success'];
            }
            else {
                return ['Fail To Update Income','error'];
            }
        } else {
            // dd($data);
            $res = $this->OfficeIncomeRepository->insert($data);
            if($res){
                return ['Income Added Successfully','success'];
            }
            else{
                return ['Fail To Add Income','error'];
            }
        }
    }
}