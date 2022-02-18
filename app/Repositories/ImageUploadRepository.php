<?php

namespace App\Repositories;

use App\Models\ServiceImages;

class ImageUploadRepository{
    public function __construct(ServiceImages $model)
    {
        $this->model = $model;
    }

    public function store($files, $column, $id)
    {
        try{
            foreach($files as $key => $file){
                $this->model->create([
                    $column => $id,
                    'image' => $file,
                ]);
            }
            return ['status' => 'success','message' => 'uploaded successfully'];
        }
        catch(\Exception $err){
            return ['status' => 'error','message' => $err->getMessage()];
        }
    }

    public function fetchimages($column, $id)
    {
        try{
            return $this->model->where($column, $id)->get();
        }
        catch(\Exception $err){
            return $err->getMessage();
        }
    }

    public function delete($id)
    {
        try{
            $this->model->where('id',$id)->delete();
            return ['status' => 'success','message' => 'image got deleted'];
        }
        catch(\Exception $err){
            return ['status' => 'error','message' => 'failed: '.$err->getMessage()];
        }
    }
}
