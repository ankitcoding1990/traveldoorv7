<?php

namespace App\Repositories;

use Exception;
use App\Models\TransferMaster;

class TransferMasterRepository{

    public function __construct(TransferMaster $model)
    {
        $this->model = $model;
    }

    public function update($data, $id)
    {
        try{
            $this->model->where('id',$id)->update($data);
            return ['title' => 'Success', 'message' => 'Transfer master updated!', 'type' => 'success', 'redirect' => route('transfer_master.index')];
        }
        catch (Exception $err){
            return ['title' => 'Failed', 'message' => 'failed! due to'. $err->getMessage(), 'type' => 'error'];
        }
    }

    public function insert($data)
    {
        try{
            $this->model->create($data);
            return ['title' => 'Success', 'message' => 'New transfer master added!', 'type' => 'success','table' => 'transfermasterdatatable-table'];
        }
        catch (Exception $err){
            return ['title' => 'Failed', 'message' => 'failed! due to'. $err->getMessage(), 'type' => 'error'];
        }
    }

    public function delete($id)
    {
        try{
            $this->model->where('id',$id)->delete();
            return ['title' => 'Success', 'subject' => 'Transfer master deleted!', 'type' => 'success'];
        }
        catch (Exception $err){
            return ['title' => 'Failed', 'subject' => 'failed! due to'. $err->getMessage(), 'type' => 'error'];
        }

    }

    public function ChangeState($id, $status)
    {
        try {
            $bool = $status == 'active' ? '1' : '0';
            $this->model->where('id', $id)->update(['master_status'=> $bool]);
            return ['title' => 'Success', 'subject' => 'Transfer master '.$status.'d', 'type' => 'success'];
        } catch (\Throwable $err) {
            return ['title' => 'Failed', 'subject' => 'failed! due to'. $err->getMessage(), 'type' => 'error'];
        }
    }
}
