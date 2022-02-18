<?php

namespace App\Repositories;

use Exception;
use App\Models\Services;

class ServiceMasterRepository{
    function __construct(Services $model){
        $this->model = $model;
    }
    public function update($data)
    {
        try{
            $this->model->where('id',$data['id'])->update($data);
            return 1;
        }
        catch (Exception $err){
            // dd($err->getMessage());
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
            // dd($err->getMessage());
            return 0;
        }
    }

    public function delete($id)
    {
        try{
            $this->model->where('id',$id)->delete();
            return 1;
        }
        catch (Exception $eer){
            return 0;
        }

    }
}
