<?php

namespace App\Services;

use App\Repositories\CouponRepository;

class CouponService{

    function __construct(CouponRepository $repo){
        $this->repo = $repo;
    }
    public function store($request)
    {
        $data = $request->only('coupan_type','coupan_name','no_of_person','min_value','coupan_validity_from','coupan_validity_to','coupan_amount_type','coupan_amount','coupan_code','coupan_created_by');
        $data['coupan_status'] = 1;
        if(!empty($request->id))
        {
            $data['id'] = $request->id;
            $res = $this->repo->update($data);
            if($res){
                return ['Coupons Updated!','success'];
            }
            else{
                return ['Fail To Update Couupon','error'];
            }
        }
        else{
            $res = $this->repo->insert($data);
            if($res){
                return ['New Coupon Added!','success'];
            }
            else{
                return ['Fail To Add New Coupon','error'];
            }
        }
    }

    public function delete($id)
    {
        $res = $this->repo->delete($id);
        if($res){
            return ['Coupon Delete!','success'];
        }
        else{
            return ['Fail To Delete Coupon','error'];
        }
    }

    public function statechanger($id)
    {
        $res = $this->repo->statechanger($id);
        if($res){
            return ['Status Changed successfully!','success'];
        }
        else{
            return ['Fail To Change Status','error'];
        }
    }
}
