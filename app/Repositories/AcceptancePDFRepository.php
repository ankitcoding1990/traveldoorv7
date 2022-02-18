<?php

namespace App\Repositories;

use App\Models\AcceptancePdfMaster;
use Exception;

class AcceptancePDFRepository{
    public function __construct(AcceptancePdfMaster $model)
    {
        $this->model = $model;
    }

    public function insert($data)
    {
        try{
            $this->model->updateOrCreate(['id' => $data['id']],$data);
            return 1;
        }
        catch (Exception $err){
            return 0;
        }
    }
}