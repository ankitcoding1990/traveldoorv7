<?php

namespace App\Services;

use App\Repositories\CustomerMarkupRespository;

class CustomerMarkupService{
    public function __construct(CustomerMarkupRespository $repo)
    {
        $this->repo = $repo;
    }

    public function store($request)
    {
        $data = $request->only('customer_markup','customer_markup_cost','customer_markup_created_by');
        if(!empty($request->id)){
            $data['id'] = $request->id;
            $res = $this->repo->update($data);
            if($res){
                return ['Customer Markup Got Updated', 'success'];
            }
            else{
                return ['Can\'t Update the Customer Markup', 'error'];
            }
        }
        else{
            $res = $this->repo->insert($data);
            if($res){
                return ['New Customer Markup Got Added', 'success'];
            }
            else{
                return ['Can\'t Add New Customer Markup','error'];
            }
        }
    }

    public function delete($id)
    {
        $res = $this->repo->delete($id);
        if($res){
            return ['Customer Markup Deleted Successfully', 'success'];
        }
        else{
            return ['Can\'t Delete Customer Markup', 'error'];
        }
    }
}
