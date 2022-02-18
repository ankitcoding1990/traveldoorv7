<?php

namespace App\Repositories;

use App\Models\Income;
use Exception;

class OfficeIncomeRepository{
    public function __construct(Income $model)
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
            // dd($data);
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