<?php

namespace App\Repositories;

use App\Models\IncomeExpenseCategory;
use Exception;

class IncomeRepository{

    public function __construct(IncomeExpenseCategory $model)
    {
        $this->model = $model;
    }

    public function update($data)
    {
        try{
            $this->model->find($data['id'])->update($data);
            return 1;
        }
        catch (Exception $err){
            return 0;
        }
    }

    public function insert($data)
    {
        try{
            $this->model->create($data);
            return 1;
        }
        catch (Exception $err){
            return 0;
        }
    }
}