<?php

namespace App\Repositories;

use App\Models\EnquiryType;
use Exception;

class EnquiryTypeRepository{
    public function __construct(EnquiryType $model)
    {
        $this->model = $model;
    }

    public function update($data, $id)
    {
        try{
            $this->model->where('id',$id)->update($data);
            return ['title' => 'Success','message' => 'Enquiry type updated', 'type' => 'success', 'redirect' => route('enquiry_type.index')];
        }
        catch (Exception $err){
            return ['title' => 'Failed', 'message' => 'failed! due to '.$err->getMessage(),'type' => 'error'];
        }
    }
    public function insert($data)
    {
        try{
            $this->model->create($data);
            return ['title' => 'Success','message' => 'New enquiry type added', 'type' => 'success', 'table' => 'enquirytypedatatables-table'];
        }
        catch (Exception $err){
            return ['title' => 'Failed', 'message' => 'failed! due to '.$err->getMessage(),'type' => 'error'];
        }
    }
    public function delete($id)
    {
        try{
            $this->model->where('id',$id)->delete();
            return ['title' => 'Success','subject' => 'Enquiry type deleted!', 'type' => 'success'];
        }
        catch (Exception $err){
            return ['title' => 'Failed', 'subject' => 'failed! due to '.$err->getMessage(),'type' => 'error'];
        }
    }

    public function Changestate($id, $status)
    {
        try {
            $bool = $status == 'active' ? '1' : '0';
            $this->model->where('id',$id)->update(['enquiry_type_status' => $bool]);
            return ['title' => 'Success', 'subject' => 'Enquiry type '.$status.'d','type' => 'success'];
        } catch (\Throwable $err) {
            return ['title' => 'Failed', 'subject' => 'failed! due to '.$err->getMessage(),'type' => 'error'];

        }
    }
}
