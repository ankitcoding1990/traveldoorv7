<?php
namespace App\Repositories;

use Exception;
use App\Models\Cities;

class CitiesRepository
{

    function __construct(Cities $model)
    {
        $this->model= $model;
    }

    function getCities($cityId = null){
        if ($this->cityId != null) {
        return $this->model->find($cityId);
        }
        return $this->model->get();
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

 ?>
