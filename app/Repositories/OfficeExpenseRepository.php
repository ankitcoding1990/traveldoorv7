<?php

namespace App\Repositories;

use App\Models\Expense;
use Exception;

class OfficeExpenseRepository{
    public function __construct(Expense $model)
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