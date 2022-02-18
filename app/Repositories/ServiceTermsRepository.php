<?php

namespace App\Repositories;

use App\Models\AdminTermsCancellationMaster;
use Exception;

class ServiceTermsRepository{
    public function __construct(AdminTermsCancellationMaster $model)
    {
        $this->model = $model;
    }
    public function insert($data)
    {
        try{
            $this->model->insert($data);
            return 1;
        }
        catch(Exception $err){
            return 0;
        }
    }

    public function update($data)
    {
        try{
            $this->model->where('id',$data['id'])->update($data);
            return 1;
        }
        catch (Exception $err){
            return 0;
        }
    }
}
