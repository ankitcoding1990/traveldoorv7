<?php

namespace App\Repositories;

use Exception;
use App\Models\GuideExpense;

class GuideExpensesRespository{

    public function __construct(GuideExpense $model)
    {
        $this->model = $model;
    }

    public function update($data, $id)
    {
        try {
            $this->model->where('id',$id)->update($data);
            return ['title' => 'Success', 'message' => 'Expense cost Updated!', 'type' => 'success','redirect' => route('guide_expenses.index')];
        }
        catch (Exception $err) {
            return ['title' => 'Failed', 'message' => 'Failed! due to!'.$err->getMessage(), 'type' => 'success'];
        }
    }

    public function insert($data)
    {
        try{
            $this->model->create($data);
            return ['title' => 'Success', 'message' => 'New expense cost added!', 'type' => 'success','table' => 'guideexpensesdatatables-table'];
        }
        catch (Exception $err){
            return ['title' => 'Failed', 'message' => 'Failed! due to!'.$err->getMessage(), 'type' => 'success'];
        }
    }
    public function delete($id)
    {
        try{
            $this->model->where('id',$id)->delete();
            return ['title' => 'success', 'subject' => 'Expense cost removed', 'type' => 'success'];
        }
        catch(Exception $err){
            return ['title' => 'Failed', 'subject' => 'Failed! due to!'.$err->getMessage(), 'type' => 'success'];
        }
    }
}
