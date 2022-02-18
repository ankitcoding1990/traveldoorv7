<?php

namespace App\Services;

use App\Traits\MyUpload;
use App\Repositories\SpecialOffersRepository;

class SpecialOffersService{
    use MyUpload;

    function __construct(SpecialOffersRepository $repo){
        $this->repo = $repo;
    }
    public function store($request)
    {
        $data = $request->only('title','price','price_child','price_infant','itinerary_id','description','package');
        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = "/assets/uploads/special offers/";
            $filename = Self::singleFile($file,$path,'special offers');
            $data['image'] = $filename;
        }
        $data['inclusions'] = serialize($request->inclusions);
        $data['exclusions'] = serialize($request->exclusions);
        $data['status'] = 1;
        if($request->delimage){
            $data['image'] = $request->image;
        }
        if(!empty($request->id)){
            $data['id'] = $request->id;
            $res = $this->repo->update($data);
            if($res){
                return ['Special Offer Got Updated', 'success'];
            }
            else{
                return ['Can\'t Update the Special Offer', 'error'];
            }
        }
        else{
            $res = $this->repo->insert($data);
            if($res){
                return ['New Special Offer Got Added', 'success'];
            }
            else{
                return ['Can\'t Add New Special Offer','error'];
            }
        }
    }

    public function delete($id)
    {
        $res = $this->repo->delete($id);
        if($res){
            return ['Special Offer Deleted Successfully', 'success'];
        }
        else{
            return ['Can\'t Delete Special Offer', 'error'];
        }
    }
}
